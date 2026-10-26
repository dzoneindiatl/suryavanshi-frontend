<?php

namespace App\Http\Controllers\Front;

use Session;
use Exception;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Pincodes;
use App\Models\Wishlist;
use App\Models\CouponUse;
use App\Models\CategoryTax;
use App\Models\PriceDrop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\ProductVariantCombinationImage;
use App\Models\{ProductVariantCombination, VariantValue, Coupon, ProductGraphics};

class CartController extends Controller
{

    public function index(Request $request)
    {
        try {
            if (!empty($request->checkoutFrom)) { 
                if (auth()->check()) {
                    $cartData = Cart::where('user_id', auth()->user()->id)->select('product_id', 'quantity')->get()->toArray();
                } else {

                    $cartData = session()->get('cartData', []);
                }

                moveCartSessionDataToCheckoutSessionData($cartData, $request->checkoutFrom);

                return redirect()->route('front-product.checkoutBag');
            }

            $cartData = getCartData();
            if (count($cartData) == 0) {
                return redirect()->route('front-home.index')->with('error', 'Cart is empty');
            }
            
            return view('front.modules.cart.index', compact('cartData'));
        } catch (\Throwable $e) {
            Log::error($e);
            return redirect()->back()->with(['error' => 'Something is wrong', 'error_msg' => $e->getMessage()]);
        }
    }


    public function addToCart(Request $request)
    {
        $userId = Auth::guard('customer')->id();

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'User not logged in'
            ], 401);
        }

        if ($request->input('addType') === 'remove') {
            $request->validate(['cart_id' => 'required|integer']);

            $deleted = Cart::where('id', $request->input('cart_id'))
                ->where('user_id', $userId)
                ->delete();

            if (!$deleted) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart item not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart'
            ]);
        }

        $validated = $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'selected_variants' => 'sometimes|array',
            'selected_variants.*' => 'string',
            'selected_variant_ids' => 'sometimes|array',
            'selected_variant_ids.*' => 'integer|min:1',
        ]);

        $product = Product::find($validated['product_id']);
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }
        if ((int) $product->in_stock !== 1) {
            return response()->json([
                'success' => false,
                'message' => 'This product is currently unavailable.'
            ], 422);
        }

        $selectedVariants = $validated['selected_variants'] ?? [];
        $variantIds = $validated['selected_variant_ids'] ?? [];
        $combination = $this->resolveCartCombination(
            (int) $product->id,
            $variantIds,
            $selectedVariants
        );
        $availableQuantity = $combination
            ? ((int) $combination->is_out_of_stock === 1 ? 0 : (int) $combination->qty)
            : (int) ($product->qty ?? 0);

        if ($availableQuantity < 1) {
            return response()->json([
                'success' => false,
                'message' => 'This product is out of stock.'
            ], 422);
        }

        try {
            return DB::transaction(function () use (
                $userId,
                $product,
                $combination,
                $availableQuantity,
                $validated
            ) {
                $cartQuery = Cart::where('user_id', $userId)
                    ->where('product_id', $product->id);

                if ($combination) {
                    $cartQuery->where('product_variant_combination_id', $combination->id);
                } else {
                    $cartQuery->whereNull('product_variant_combination_id');
                }

                $cartItem = $cartQuery->lockForUpdate()->first();
                $newQuantity = (int) $validated['quantity'];

                if ($newQuantity > $availableQuantity) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Only ' . $availableQuantity . ' item(s) are available.',
                        'available_quantity' => $availableQuantity,
                        'quantity' => (int) ($cartItem->quantity ?? 0)
                    ], 422);
                }

                if (!$cartItem) {
                    $cartItem = Cart::create([
                        'user_id' => $userId,
                        'product_id' => $product->id,
                        'product_variant_combination_id' => $combination->id ?? null,
                        'quantity' => $newQuantity,
                    ]);
                } else {
                    $cartItem->quantity = $newQuantity;
                    $cartItem->save();
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Cart updated successfully',
                    'quantity' => $cartItem->quantity
                ]);
            });
        } catch (\Throwable $exception) {
            Log::error('Add to cart failed.', [
                'product_id' => $product->id,
                'user_id' => $userId,
                'exception' => $exception->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Unable to update your cart. Please try again.'
            ], 500);
        }
    }

    public function mergeLocalCartData(Request $request)
    {
        $userId = Auth::guard('customer')->id();
        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'User not logged in'
            ], 401);
        }

        $validated = $request->validate([
            'cart_items' => 'required|array',
            'cart_items.*.productId' => 'required|integer',
            'cart_items.*.quantity' => 'required|integer|min:1',
            'cart_items.*.selectedVariants' => 'sometimes|array',
            'cart_items.*.selectedVariants.*' => 'string',
            'cart_items.*.selectedVariantIds' => 'sometimes|array',
            'cart_items.*.selectedVariantIds.*' => 'integer|min:1',
            'cart_items.*.randomId' => 'required|string|max:100',
        ]);

        try {
            $alreadyMergedItems = session()->get('merged_guest_cart_items_' . $userId, []);
            $alreadyMergedItems = is_array($alreadyMergedItems) ? $alreadyMergedItems : [];

            [$mergedItems, $errors, $newlyMergedItems] = DB::transaction(function () use (
                $validated,
                $userId,
                $alreadyMergedItems
            ) {
                $mergedItems = [];
                $errors = [];
                $newlyMergedItems = [];

                foreach ($validated['cart_items'] as $item) {
                    if (array_key_exists($item['randomId'], $alreadyMergedItems)) {
                        $mergedItems[] = [
                            'random_id' => $item['randomId'],
                            'quantity' => (int) $alreadyMergedItems[$item['randomId']]
                        ];
                        continue;
                    }

                    $product = Product::where('id', $item['productId'])
                        ->where('is_active', 1)
                        ->where('is_deleted', 0)
                        ->first();
                       
                    if (!$product) {
                        $errors[] = [
                            'random_id' => $item['randomId'],
                            'message' => 'Product no longere exists.'
                        ];
                        continue;
                    }
                    if ((int) $product->in_stock !== 1) {
                        $errors[] = [
                            'random_id' => $item['randomId'],
                            'message' => 'This product is currently unavailable.'
                        ];
                        continue;
                    }

                    try {
                        $combination = $this->resolveCartCombination(
                            (int) $product->id,
                            $item['selectedVariantIds'] ?? [],
                            $item['selectedVariants'] ?? []
                        );
                    } catch (ValidationException $exception) {
                        $errors[] = [
                            'random_id' => $item['randomId'],
                            'message' => 'The selected product options are no longer available.'
                        ];
                        continue;
                    }

                    $availableQuantity = $combination
                        ? ((int) $combination->is_out_of_stock === 1 ? 0 : (int) $combination->qty)
                        : (int) ($product->qty ?? 0);
                    if ($availableQuantity < 1) {
                        $errors[] = [
                            'random_id' => $item['randomId'],
                            'message' => 'This product is out of stock.'
                        ];
                        continue;
                    }

                    $cartQuery = Cart::where('user_id', $userId)
                        ->where('product_id', $product->id);

                    if ($combination) {
                        $cartQuery->where('product_variant_combination_id', $combination->id);
                    } else {
                        $cartQuery->whereNull('product_variant_combination_id');
                    }

                    $cartItem = $cartQuery->lockForUpdate()->first();
                    $newQuantity = (int) $item['quantity'] + (int) ($cartItem->quantity ?? 0);

                    if ($newQuantity > $availableQuantity) {
                        $errors[] = [
                            'random_id' => $item['randomId'],
                            'message' => 'Only ' . $availableQuantity . ' item(s) are available.'
                        ];
                        continue;
                    }

                    if (!$cartItem) {
                        Cart::create([
                            'user_id' => $userId,
                            'product_id' => $product->id,
                            'product_variant_combination_id' => $combination->id ?? null,
                            'quantity' => $newQuantity,
                        ]);
                    } else {
                        $cartItem->quantity = $newQuantity;
                        $cartItem->save();
                    }

                    $mergedItems[] = [
                        'random_id' => $item['randomId'],
                        'quantity' => (int) $item['quantity']
                    ];
                    $newlyMergedItems[$item['randomId']] = (int) $item['quantity'];
                }

                return [$mergedItems, $errors, $newlyMergedItems];
            });
            session()->put(
                'merged_guest_cart_items_' . $userId,
                array_replace($alreadyMergedItems, $newlyMergedItems)
            );

            return response()->json([
                'success' => empty($errors),
                'message' => empty($errors)
                    ? 'Guest cart merged successfully.'
                    : 'Some cart items could not be merged.',
                'merged_items' => $mergedItems,
                'errors' => $errors,
                'cart_count' => Cart::where('user_id', $userId)->count()
            ]);
        } catch (\Throwable $exception) {
            Log::error('Merge local cart failed.', [
                'user_id' => $userId,
                'exception' => $exception->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Unable to merge your cart. Please try again.'
            ], 500);
        }
    }

    private function resolveCartCombination(int $productId, array $variantIds, array $selectedVariants): ?ProductVariantCombination
    {
        $variantIds = array_values(array_map('intval', $variantIds));

        if ($variantIds) {
            if (count($variantIds) !== count(array_unique($variantIds))) {
                throw ValidationException::withMessages([
                    'selected_variant_ids' => 'The selected product options are invalid.'
                ]);
            }

            $combination = ProductVariantCombination::where('product_id', $productId)
                ->where('status', '1')
                ->where('combination_id', json_encode($variantIds))
                ->first();

            if (!$combination) {
                throw ValidationException::withMessages([
                    'selected_variant_ids' => 'The selected product options are unavailable.'
                ]);
            }

            return $combination;
        }

        if ($selectedVariants) {
            $selectedNames = array_values($selectedVariants);
            $combinations = ProductVariantCombination::where('product_id', $productId)
                ->where('status', '1')
                ->get(['id', 'combination_id']);
            $combinationIds = $combinations
                ->flatMap(function ($combination) {
                    return json_decode($combination->combination_id, true) ?: [];
                })
                ->unique()
                ->values();
            $variantNames = VariantValue::whereIn('id', $combinationIds)->pluck('name', 'id');

            foreach ($combinations as $combination) {
                $ids = json_decode($combination->combination_id, true) ?: [];
                $names = collect($ids)
                    ->map(function ($id) use ($variantNames) {
                        return $variantNames[$id] ?? null;
                    })
                    ->values()
                    ->all();

                if ($names === $selectedNames) {
                    return $combination;
                }
            }

            throw ValidationException::withMessages([
                'selected_variants' => 'The selected product options are unavailable.'
            ]);
        }

        if (ProductVariantCombination::where('product_id', $productId)->exists()) {
            throw ValidationException::withMessages([
                'selected_variant_ids' => 'Please select all product options.'
            ]);
        }

        return null;
    }

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = Auth::guard('customer')->id();
        if (!$userId) {
            return response()->json([
                'status' => false,
                'message' => 'User not logged in.'
            ], 401);
        }

        $cart = Cart::with('product')
            ->where('id', $request->cart_id)
            ->where('user_id', $userId)
            ->first();

        if (!$cart || !$cart->product) {
            return response()->json([
                'status' => false,
                'message' => 'Cart item not found.'
            ], 404);
        }

        $combination = $cart->product_variant_combination_id
            ? ProductVariantCombination::find($cart->product_variant_combination_id)
            : null;
        if (
            (int) $cart->product->in_stock !== 1
            || (int) $cart->product->is_active !== 1
            || (int) $cart->product->is_deleted !== 0
            || ($cart->product_variant_combination_id && (!$combination || (string) $combination->status !== '1'))
        ) {
            return response()->json([
                'status' => false,
                'message' => 'This product option is no longer available.',
                'quantity' => $cart->quantity
            ], 422);
        }
        $maxQuantity = $combination
            ? ((int) $combination->is_out_of_stock === 1 ? 0 : (int) $combination->qty)
            : (int) ($cart->product->qty ?? 0);

        if ($request->quantity > $maxQuantity) {
            return response()->json([
                'status' => false,
                'message' => 'Maximum available quantity is ' . $maxQuantity,
                'quantity' => $cart->quantity
            ]);
        }

        $cart->quantity = $request->quantity;
        $cart->save();

        return response()->json([
            'status' => true,
            'message' => 'Quantity updated successfully.',
            'quantity' => $cart->quantity
        ]);
    }
    public function getCartItems(Request $request)
    {
        try {
            $userId = Auth::guard('customer')->id();
            $carts = Cart::where('user_id', $userId)->get();
            $cartItems = [];
            foreach ($carts as $cart) {
                $product = $cart->product;
                //$productVariantCombinationId = $cart->product_variant_combination_id ? $cart->productVariantCombination->product : null;

                $categoryTaxes = CategoryTax::where('category_taxes.category_id', $product->main_category_id ?? 0)
                    ->leftJoin('taxes', 'taxes.id', '=', 'category_taxes.tax_id')
                    ->select(
                        'category_taxes.id',
                        'category_taxes.category_id',
                        'taxes.tax_type',
                        'taxes.tax_option',
                        'taxes.tax_from',
                        'taxes.tax_to',
                        'taxes.tax_rate'
                    )
                    ->get();
                $combination = $cart?->productVariantCombination;
                $combinationIds = []; 
                $selectedVariants = [];
                $image = "";
                if(!empty($combination->combination_id)) {
                    $combinationIds = json_decode($combination->combination_id, true);
                    $img = ProductGraphics::whereIn('variant_id', $combinationIds)->where('product_id', $product?->id)->where('graphic_type', 'image')->where('status', 1)->first();
                    if($img) {
                        $image = $img->graphic;
                    }

                    $variantValue = VariantValue::whereIn('id', $combinationIds)
                    ->get()
                    ->sortBy(function ($item) use ($combinationIds) {
                        return array_search($item->id, $combinationIds);
                    })
                    ->values();
                    foreach ($variantValue as $value) {
                        $variantName = $value->variant->name ?? null;
                        if ($variantName) {
                            $selectedVariants[lcfirst($variantName)] = $value->name;
                        }
                    }
                }
                
                if(empty($image)) {
                    $variantImage = $combination->variant_images->where('product_id', $product->id)->first();                
                    if ($variantImage) {
                        $image = $variantImage?->graphic;
                    } else {
                        $productImages = $product->product_main_images->first();
                        $image = $productImages?->graphic;
                    }
                }                
                
                $tax_option = "inclusive";
                $tax_type = 'flat';
                $tax_price_total = 0;
                $tax_id = "";
                $tax_rate = 0;
                $finalTax = 0;
                if (count($categoryTaxes) > 0) {
                    foreach ($categoryTaxes as $taxKey => $tax) {
                        $tax_type = $tax->tax_type;
                        $taxprice = 0;
                        $tax_price = 0;
                        if ($tax->tax_type == "flat") {
                            $tax_id = $tax->id;
                            $tax_rate = $tax->tax_rate;
                            $tax_option = $tax->tax_option;
                            if ($tax_option == "inclusive") {
                                $taxprice = 1 + ($tax_rate / 100);
                                $tax_price = ($tax->tax_rate > 0 || strToLower($tax->tax_rate) != "no tax") ? ($combination->selling_price / $taxprice) : 0;
                                $tax_price = $combination->selling_price - $tax_price;
                            } else {
                                $tax_price = ($tax->tax_rate > 0 || strToLower($tax->tax_rate) != "no tax") ? (($combination->selling_price * $tax->tax_rate) / 100) : 0;
                            }
                        } else if ($tax->tax_type == "floating") {
                            if (((int)$combination->selling_price >= (int)$tax->tax_from) && ((int)$combination->selling_price <= (int)$tax->tax_to)) {
                                $tax_id = $tax->id;
                                $tax_rate = $tax->tax_rate;
                                $tax_option = $tax->tax_option;
                                $rate = ($tax->tax_rate > 0 || strToLower($tax->tax_rate) != "no tax") ? $tax->tax_rate : 0;
                                if ($tax_option == "inclusive") {
                                    $taxprice = 1 + ($rate / 100);
                                    $tax_price = ($rate > 0) ? ($combination->selling_price / $taxprice) : 0;
                                    $tax_price = $combination->selling_price - $tax_price;
                                    break; // exit loop once match is found
                                } else {
                                    $tax_price = ($rate > 0) ? (($combination->selling_price * $rate) / 100) : 0;
                                    break; // exit loop once match is found
                                }
                            }
                        }
                    }
                }
                $finalTax = $tax_price * $cart->quantity;
                $cartItems[] = [
                    'randomId'          => 'prod_' . time() . '_' . rand(1000, 9999),
                    'productId'         => $product->id,
                    'name'              => $product->name,
                    'sku'               => $product->sku,
                    'quantity'          => $cart->quantity,
                    'price'             => $combination->price,
                    'sellingPrice'      => $combination->selling_price,
                    'discountType'      => $combination->discount_type,
                    'discountAmount'    => $combination->discount,
                    'image'             => Config('constant.PRODUCT_IMAGE_PATH') . $image,
                    'image2'             => $image,
                    'selectedVariants'  => $selectedVariants,
                    'tax_option'        => $tax_option,
                    'tax_id'            => $tax_id,
                    'tax_rate'          => $tax_rate,
                    'tax_price'         => $finalTax,
                    'tax_type'          => $tax_type,
                    'rawTaxArr'         => e(json_encode($categoryTaxes)),
                ];
            }
            return response()->json([
                'success' => true,
                'cartItems' => $cartItems

            ]);
        } catch (\Exception $e) {
            Log::error('Add to cart error: ' . $e->getMessage());
            return response()->json([
                'success'   => false,
                'message'   => 'An error occurred',
                'error_msg' => $e->getMessage()
            ], 500);
        }
    }

    public function addToWishlist(Request $request)
    {
        try {

            $productId = $request->input('product_id');
            if (!empty($request->action) && $request->action == 'move') {
                Cart::where('user_id', auth()->guard('customer')->user()->id)->where('product_id', $productId)->delete();
            }

            $isProductAddedInWishlistAlready = Wishlist::where('user_id', auth()->guard('customer')->user()->id)->where('product_id', $productId)->first();
            if (empty($isProductAddedInWishlistAlready)) {
                $obj   = new Wishlist;
                $obj->user_id = auth()->guard('customer')->user()->id;
                $obj->product_id = $productId;
                $obj->save();
            }


            if ($request->ajax()) {
                $count = Wishlist::where('user_id', auth()->guard('customer')->user()->id)->count();
                return response()->json(['success' => true, 'data' => ['count' => $count]]);
            } else {

                return Redirect()->back()->with(['success' => 'Product has been added to wishlist successfully']);
            }
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->with(['error' => 'Something is wrong', 'error_msg' => $e->getMessage()]);
        }
    }

    public function removeFromWishlist(Request $request)
    {
        try {
            $productId = $request->input('product_id');

            Wishlist::where('user_id', auth()->guard('customer')->user()->id)->where('product_id', $productId)->delete();

            if ($request->ajax()) {
                $count = Wishlist::where('user_id', auth()->guard('customer')->user()->id)->count();
                return response()->json(['success' => true, 'data' => ['count' => $count]]);
            } else {
                return redirect()->route('front-user.wishlist')->with('success', 'Product removed from wishlist successfully');
            }
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->with(['error' => 'Something is wrong', 'error_msg' => $e->getMessage()]);
        }
    }

    public function checkDelevery(Request $request)
    {
        // try {
        $pincode = $request->pincode;
        $checkpincode = Pincodes::where('pincode', $pincode)->first();
        if ($checkpincode->delivery == 1) {
            $message = "<span style='color:green; font-weight:600;'> Great news! Delivery is available to your area.</span>";
        } elseif ($checkpincode->delivery == 2) {
            $message = "<span style='color:red; font-weight:600;'> Sorry, we currently do not deliver to this location.</span>";
        } elseif ($checkpincode->delivery == 3) {
            $extracharge = $checkpincode->extra_charge ? ' of ₹' . $checkpincode->extra_charge : '';
            $message = "<span style='color:orange; font-weight:600;'> Delivery available with an extra charge{$extracharge}.</span>";
        } else {
            $message = "<span style='color:#555;'> Delivery not available for this pincode.</span>";
        }
        return response()->json([
            'success' => true,
            'data' => [
                'extra_charge' => $checkpincode->extra_charge,
                'message' => $message,
            ]
        ]);
    }

    public function applyCoupon(Request $request)
    {
        $userId = Auth::guard('customer')->id();
        $today = now()->toDateString();

        $request->validate([
            'coupon_code' => 'required|string',
            'cart_total' => $userId ? 'nullable|numeric' : 'required|numeric|min:0',
            'cart_items' => $userId ? 'nullable|array' : 'required|array',
        ]);

        $coupon = Coupon::where('coupon_code', $request->coupon_code)
            ->where('is_active', 1)
            ->where(function ($q) use ($today) {
                $q->whereDate('end_date', '>=', $today)
                ->orWhereNull('end_date');
            })->where(function ($q) use ($today) {
                $q->whereDate('start_date', '<=', $today)
                ->orWhereNull('start_date');
            })->with('coupon_user')->first();
    
        if (!$coupon) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or inactive coupon.'
            ]);
        }

        $cartItems = [];
        $subTotal = 0;
        $discountSubtotal = 0;

        if ($userId) {
            $carts = Cart::with('product')
                ->where('user_id', $userId)
                ->get();

            $priceDrop = PriceDrop::whereDate('start_date', '<=', $today)
                ->whereDate('end_date', '>=', $today)
                ->where('is_deleted', 0)
                ->latest()
                ->first();

            foreach ($carts as $cartItem) {
                if (!$cartItem->product) {
                    continue;
                }

                $combination = $cartItem->product_variant_combination_id
                    ? ProductVariantCombination::where('product_id', $cartItem->product_id)
                        ->find($cartItem->product_variant_combination_id)
                    : null;
                $sellingPrice = (float) (
                    $combination->selling_price
                    ?? $cartItem->product->selling_price
                    ?? 0
                );

                if ($priceDrop) {
                    $appliesToProduct = $priceDrop->product_id === 'all'
                        || in_array(
                            (string) $cartItem->product_id,
                            array_map('trim', explode(',', (string) $priceDrop->product_id)),
                            true
                        );

                    if ($appliesToProduct && $priceDrop->gain_type === 'drop') {
                        if ($priceDrop->drop_type === 'percentage') {
                            $sellingPrice -= ($sellingPrice * (float) $priceDrop->amount) / 100;
                        } elseif ($priceDrop->drop_type === 'flat') {
                            $sellingPrice -= (float) $priceDrop->amount;
                        }
                    } elseif ($appliesToProduct && $priceDrop->gain_type === 'gain') {
                        if ($priceDrop->drop_type === 'percentage') {
                            $sellingPrice += ($sellingPrice * (float) $priceDrop->amount) / 100;
                        } elseif ($priceDrop->drop_type === 'flat') {
                            $sellingPrice += (float) $priceDrop->amount;
                        }
                    }
                }

                $quantity = max(1, (int) ($cartItem->quantity ?? 1));
                $lineTotal = max(0, $sellingPrice) * $quantity;
                $subTotal += $lineTotal;
                $cartItems[] = [
                    'productId' => $cartItem->product_id,
                    'quantity' => $quantity,
                    'sellingPrice' => max(0, $sellingPrice)
                ];
            }
            $discountSubtotal = $subTotal;
        } else {
            $cartItems = $request->cart_items;
            $subTotal = (float) $request->cart_total;
            $discountSubtotal = $subTotal;
        }

        if (empty($cartItems)) {
            return response()->json([
                'status' => false,
                'message' => 'Your cart is empty.'
            ]);
        }

        if ($coupon->coupon_type === 'private') {
            if (!$userId) {
                return response()->json([
                    'status' => false,
                    'message' => 'Login required to apply this coupon.'
                ]);
            }

            $assignedUsers = $coupon->coupon_user
                ->pluck('user_id')
                ->map(fn ($id) => (int) $id)
                ->toArray();

            if (!in_array((int) $userId, $assignedUsers, true)) {
                return response()->json([
                    'status' => false,
                    'message' => 'You are not allowed to use this private coupon.'
                ]);
            }
        }

        if (in_array($coupon->user_type, ['new', 'existing'], true)) {
            if (!$userId) {
                return response()->json([
                    'status' => false,
                    'message' => 'Login required to apply this coupon.'
                ]);
            }

            $hasOrdered = Order::where('user_id', $userId)->exists();

            if ($coupon->user_type === 'new' && $hasOrdered) {
                return response()->json([
                    'status' => false,
                    'message' => 'This coupon is only valid for new users.'
                ]);
            }

            if ($coupon->user_type === 'existing' && !$hasOrdered) {
                return response()->json([
                    'status' => false,
                    'message' => 'This coupon is only valid for existing users.'
                ]);
            }
        }

        if ($userId && $coupon->per_user_avalibity > 0) {
            $usedCount = CouponUse::where('user_id', $userId)
                ->where('coupon_id', $coupon->id)
                ->count();

            if ($usedCount >= $coupon->per_user_avalibity) {
                return response()->json([
                    'status' => false,
                    'message' => 'Coupon limit reached.'
                ]);
            }
        }

        if (!$coupon->is_unlimited && $coupon->available_coupons <= 0) {
            return response()->json([
                'status' => false,
                'message' => 'Coupon limit reached.'
            ]);
        }

        // Minimum cart value
        if ($subTotal < (float) $coupon->min_cart_value) {
            return response()->json([
                'status' => false,
                'message' => 'Cart total is below the minimum required for this coupon.'
            ]);
        }

        $productIds = collect($cartItems)
            ->pluck('productId')
            ->filter()
            ->unique()
            ->values()
            ->toArray();
        info("====productIds-====",[$productIds]); 
        $checkSubCat = is_array($coupon->sub_categories)
            ? $coupon->sub_categories
            : (json_decode($coupon->sub_categories ?? '[]', true) ?: []);

        $checkSubCat = array_filter($checkSubCat);

        if ($coupon->category_id || !empty($checkSubCat)) {
            $products = Product::select('id', 'main_category_id', 'main_sub_category_id')
                ->whereIn('id', $productIds)
                ->where('is_active', '1')
                ->where('is_deleted', 0)
                ->get();
            if ($products->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cart contains no valid public products.'
                ]);
            }

            $allowedSubCats = array_map('strval', $checkSubCat);
            $eligibleProducts = $products->filter(function ($product) use ($coupon, $allowedSubCats) {
                if ($coupon->category_id && (int) $product->main_category_id !== (int) $coupon->category_id) {
                    return false;
                }

                return empty($allowedSubCats)
                    || in_array((string) $product->main_sub_category_id, $allowedSubCats, true);
            });

            if ($eligibleProducts->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => $coupon->category_id
                        ? 'Coupon is not valid for the selected product category or subcategories.'
                        : 'Coupon is not valid for the selected subcategories.'
                ]);
            }

            if ($userId) {
                $eligibleProductIds = $eligibleProducts->pluck('id')->map(fn ($id) => (int) $id)->all();
                $discountSubtotal = collect($cartItems)
                    ->filter(fn ($item) => in_array((int) $item['productId'], $eligibleProductIds, true))
                    ->sum(fn ($item) => (float) $item['sellingPrice'] * (int) $item['quantity']);
            }
        }
        
        // Discount calculation
        if ($discountSubtotal < (float) $coupon->min_cart_value) {
            return response()->json([
                'status' => false,
                'message' => 'Eligible cart total is below the minimum required for this coupon.'
            ]);
        }

        $discount = $coupon->discount_type === 'flat'
            ? (float) $coupon->discount_value
            : ($discountSubtotal * (float) $coupon->discount_value) / 100;

        if ($coupon->max_discount) {
            $discount = min($discount, (float) $coupon->max_discount);
        }

        if ($coupon->min_discount) {
            $discount = max($discount, (float) $coupon->min_discount);
        }

        $discount = min($discount, $discountSubtotal);

        return response()->json([
            'status' => true,
            'message' => 'Coupon applied successfully.',
            'discount' => round($discount, 2),
            'coupon' => $coupon->only(
                'id',
                'coupon_code',
                'discount_type',
                'discount_value'
            )
        ]);
    }

    public function getCoupon(Request $request)
    {
        $cartItems = $request->cart_items;

        $userId =  Auth::guard('customer')->check() ? Auth::guard('customer')->id() : '';
        if (!$cartItems || !is_array($cartItems)) {
            return response()->json(['status' => false, 'message' => 'Cart information required.']);
        }

        // Step 1: Gather Product Info
        $productIds = collect($cartItems)->pluck('productId')->unique()->toArray();
        $products = Product::whereIn('id', $productIds)->get();

        $categoryIds = $products->pluck('main_category_id')->unique()->toArray();
        $subCategoryIds = $products->pluck('main_sub_category_id')->unique()->toArray();
        $today = now()->toDateString();
        // Step 2: Fetch Active Coupons with Valid Date Range
        $coupons = Coupon::where('is_active', 1)
            ->where(function ($q) use ($today) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', $today);
            })
            ->where(function ($q) use ($userId) {
                if ($userId) {
                    $q->whereDoesntHave('customers')
                        ->orWhereHas('customers', function ($subQ) use ($userId) {
                            $subQ->where('users.id', $userId);
                        });
                } else {
                    $q->where('coupon_type', 'public');
                }
            })
            ->where(function ($q) use ($today) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', $today);
            })
            ->where(function ($q) use ($today) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', $today);
            })
            ->get()
            ->filter(function ($coupon) use ($categoryIds, $subCategoryIds) {
                if ($coupon->category_id && !in_array($coupon->category_id, $categoryIds)) {
                    return false;
                }

                if (!empty($coupon->sub_categories)) {
                    $allowed = is_array($coupon->sub_categories)
                        ? $coupon->sub_categories
                        : json_decode($coupon->sub_categories, true);
                    if (!array_intersect($allowed, $subCategoryIds)) {
                        return false;
                    }
                }

                // Add more user-based filtering if needed (user_id, user_type, etc.)

                return true;
            })->values();

        if ($coupons->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'No applicable coupons found.']);
        }

        $cartTotal = collect($cartItems)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        // Step 4: Transform coupons
        $transformedCoupons = $coupons->map(function ($coupon) use ($cartTotal) {
            $isApplicable = true;
            $reason = '';

            if ($coupon->min_order_amount && $cartTotal < $coupon->min_order_amount) {
                $isApplicable = false;
                $reason = 'Minimum order amount ₹' . $coupon->min_order_amount . ' not met.';
            }

            $discountAmount = 0;
            if ($coupon->discount_type === 'flat') {
                $discountAmount = $coupon->discount_value;
            } elseif ($coupon->discount_type === 'percentage') {
                $discountAmount = ($cartTotal * $coupon->discount_value) / 100;
                if ($coupon->max_discount) {
                    $discountAmount = min($discountAmount, $coupon->max_discount);
                }
            }

            $description = '';

            if (!$coupon->min_discount && !$coupon->max_discount) {
                if ($coupon->discount_type === 'flat') {
                    $description = 'Get Rs. ' . $coupon->discount_value . ' off';
                } elseif ($coupon->discount_type === 'percentage') {
                    $description = 'Get' . $coupon->discount_value . '% off';
                }
            }


            if ($coupon->min_discount && $coupon->max_discount) {
                /* $description .= 'Between Rs.' . $coupon->max_discount . ' and Rs. ' . $coupon->min_discount; */
                $description .= 'Get Rs.' . $coupon->min_discount . ' to Rs. ' . $coupon->max_discount . ' off ';
            } elseif ($coupon->max_discount) {
                $description .= ' Up to Rs.' . $coupon->max_discount;
            } elseif ($coupon->min_discount) {
                $description .= 'Minimum Rs.' . $coupon->min_discount;
            }



            if ($coupon->min_cart_value) {
                $description .= ' on minimum purchase of Rs. ' . $coupon->min_cart_value;
                if ($cartTotal < $coupon->min_cart_value) {
                    $isApplicable = false;
                    $difference = $coupon->min_cart_value - $cartTotal;
                    $reason = 'Shop for Rs. ' . $difference . ' more to apply';
                }
            }

            if ($coupon->user_type === 'new') {
                $description .= '(Only for new users)';
            }

            if ($coupon->end_date) {
                $description .= '</br> Expires on: ' . \Carbon\Carbon::parse($coupon->end_date)->format('jS F Y');
            }
            $per_user_avalibity = '';
            if ($coupon->per_user_avalibity) {
                $per_user_avalibitys = $coupon->per_user_avalibity;
                $per_user_avalibity .= $per_user_avalibitys;
            }


            return [
                'code'            => $coupon->coupon_code,
                'name'            => $coupon->name,
                'description'            => $coupon->description,
                'discount_type'   => $coupon->discount_type,
                'discount_value'  => $coupon->discount_value,
                'discount_amount' => round($discountAmount),
                'description'     => $description ?? 'Discount available',
                'is_applicable'   => $isApplicable,
                'reason'          => $reason,
                'per_user_avalibity' => $per_user_avalibity,
            ];
        })->values();

        return response()->json([
            'status'  => true,
            'message' => 'Valid coupons fetched.',
            'coupons' => $transformedCoupons
        ]);
    }
}
