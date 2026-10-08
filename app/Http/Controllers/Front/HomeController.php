<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\SizeChartManager;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category; 
use App\Models\PriceDrop; 
use App\Models\Variant; 
use App\Models\VariantValue; 
use App\Models\ProductGraphics; 
use App\Models\Attribute; 
Use App\Models\CategoryAttribute; 
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\RecentlyViewed; 
use App\Models\ProductDetailManager;
use App\Models\Setting; 
use App\Models\Coupon; 
use App\Models\ProductVariant; 
use App\Models\ProductVariantCombination;
use App\Models\CategoryTax;  
use App\Models\Cart; 
use App\Models\ProductVariantValue; 
use App\Models\State; 
use App\Models\City;
class HomeController extends Controller
{
    public function index(){
        return view('front.home.index'); 
    }

    public function productListing(Request $request, $path)
    {   
        $segments = array_values(array_filter(explode('/', $path)));
        $category = null;
        $subCategory = null;
        $subChildCategory = null;
        
        if(count($segments) === 1){
            $category = Category::select('id','parent_id','slug','name')->whereNull('parent_id')->where('slug', $segments[0])->firstOrFail();
        }
        elseif (count($segments) === 2) {
            $category = Category::select('id','parent_id','slug','name')->whereNull('parent_id')->where('slug', $segments[0])->firstOrFail();
            $subCategory = Category::select('id','parent_id','slug','name')->where('parent_id', $category->id)->where('slug', $segments[1])->firstOrFail();

        } 
        elseif (count($segments) === 3) {
            $category = Category::select('id','parent_id','slug','name')->whereNull('parent_id')->where('slug', $segments[0])->firstOrFail();
            $subCategory = Category::select('id','parent_id','slug','name')->where('parent_id', $category->id)->where('slug', $segments[1])->firstOrFail();
            $subChildCategory = Category::select('id','parent_id','slug','name')->where('parent_id', $subCategory->id)->where('slug', $segments[2])->firstOrFail();

        } else {
            abort(404);
        }
        $isWishlisteddata = [];
        $parent = '';
        $grandParent = '';
        $today = now()->toDateString();
        $priceDrop = PriceDrop::whereDate('start_date', '<=', $today)->whereDate('end_date', '>=', $today)->where('is_deleted',0)->latest()->first();
        
        $DB = Product::select('id','name','slug','buying_price','selling_price','discount','discount_type','sku','best_seller')->where('is_deleted', 0)
            ->where('is_active', "1")->orderBy('id','DESC'); 

        $hasCategoryFilter = $request->filled('category_id') || $request->filled('sub_category_id') ||  $request->filled('sub_child_category_id');
        
        if (!$hasCategoryFilter) {
            if (count($segments) === 1) {
                $DB->where('main_category_id', $category->id)->orWhere('main_collection_id',$category->id);
                $categoriesData = Category::where('is_active', 1)
                    ->where('is_deleted', 0)
                    ->where('parent_id', $category->id)
                    ->get();
            }
            elseif (count($segments) === 2) {

                $DB->where(function ($q) use ($subCategory) {
                    $q->where('main_sub_category_id', $subCategory->id)
                        ->orWhere(function ($query) use ($subCategory) {
                            $query->whereNotNull('sub_category_id')
                                ->whereRaw('JSON_VALID(sub_category_id)')
                                ->whereJsonContains('sub_category_id', (string) $subCategory->id);
                        });
                });

                $categoriesData = Category::where('is_active', 1)
                    ->where('is_deleted', 0)
                    ->where('parent_id', $subCategory->id)
                    ->get();
            }
            elseif (count($segments) === 3) {
                $DB->where(function ($q) use ($subChildCategory) {
                    $q->where('main_child_category_id', $subChildCategory->id)
                        ->orWhere(function ($query) use ($subChildCategory) {
                            $query->whereNotNull('child_category_id')
                                ->whereRaw('JSON_VALID(child_category_id)')
                                ->whereJsonContains('child_category_id', (string) $subChildCategory->id);
                        });
                });
                 $categoriesData = collect();
            }
        } else {
            $categoriesData = collect();
        } 
        $categoryIds = (array) $request->input('category_id', []);
        if (!empty($categoryIds)) {
            $DB->whereIn('main_category_id', $categoryIds);
        }

        $subCategoryIds = (array) $request->input('sub_category_id', []);
        if (!empty($subCategoryIds)) {
            $DB->where(function ($q) use ($subCategoryIds) {
                $q->whereIn('main_sub_category_id',$subCategoryIds);
                foreach ($subCategoryIds as $id) {
                    $q->orWhereJsonContains('sub_category_id',(string) $id);
                }
            });
        }

        $subChildCategoryIds = (array) $request->input('sub_child_category_id',[]);
        if (!empty($subChildCategoryIds)) {
            $DB->where(function ($q) use ($subChildCategoryIds) {
                $q->whereIn('main_child_category_id',$subChildCategoryIds);
                foreach ($subChildCategoryIds as $id) {
                    $q->orWhereJsonContains('child_category_id',(string) $id);
                }
            });
        }

        $selectedVariantValuesColor = (array) $request->input('variantValuesColor',[]);
        if (!empty($selectedVariantValuesColor)) {
            $DB->whereHas('getProductVariantValue',function ($query) use ($selectedVariantValuesColor) {
                    $query->whereIn('variant_value_id',$selectedVariantValuesColor);
                }
            );
        }

        if ($request->filled('price_range')) {
            $range = explode('-',$request->input('price_range'));
            if (count($range) === 2) {
                $min = (int) $range[0];
                $max = (int) $range[1];
                if ($min <= $max) {
                    $DB->whereBetween('selling_price',[$min, $max]);
                }
            }
        }

        switch ($request->input('sortBy')) {
            case 'new_arrivals':
                $DB->where('is_new_arrivals', 1);
                break;

            case 'best_seller':
                $DB->where('best_seller', 1);
                break;

            case 'featured':
                $DB->where('is_featured', 1);
                break;

            case 'trending':
                $DB->where('trending', 1);
                break;
            case 'low_high':
                $DB->orderBy('selling_price','asc');
                break;

            case 'high_low':
                $DB->orderBy('selling_price','desc');
                break;

            default:
                $DB->orderBy('product_order','asc');
                break;
        }

        $offset = (int) $request->input('offset', 0);
        $limit = (int) $request->input('limit',config('Reading.records_per_page'));
        $totalResults = (clone $DB)->count();
        $results = $DB->offset($offset)->limit($limit)->get();
        $hasMore = ($offset + $results->count()) < $totalResults;       
        if ($category->parent_id !== null) {
            $parent = Category::find($category->parent_id);
            $grandParent = $parent ? Category::find($parent->parent_id): null;
            $catAttributeIds = CategoryAttribute::where( 'category_id', $category->parent_id);
            if ($grandParent) {
                $catAttributeIds->orWhere('category_id',$grandParent->id);
            }
            $catAttributeIds = $catAttributeIds->pluck('attribute_id');
        } else {
            $catAttributeIds = CategoryAttribute::where('category_id',$category->id)->pluck('attribute_id');
        }

        $attributes = Attribute::whereIn('id',$catAttributeIds)->where('is_active', 1)->where('is_deleted', 0)->get();
        $AllMainCategory = Category::select('id','name','slug','parent_id')->whereNull('parent_id')->where('is_active', 1)->where('is_deleted', 0)->get();
        $allSubCategory = Category::select('id','name','slug','parent_id')->where('is_active', 1)->where('is_deleted', 0)->whereIn('parent_id',$AllMainCategory->pluck('id'))->get();
        $allChildCategory = Category::select('id','name','slug','parent_id')->where('is_active',1)->where('is_deleted',0)->whereIn('parent_id',$allSubCategory->pluck('id'))->get(); 
    
        $variants = Variant::where('is_active', 1)
            ->where('is_deleted', 0)
            ->get();
        $variantColor = VariantValue::whereIn('variant_id',$variants->pluck('id'))->get();
        $results->each(function ($product) {

            $product->primary_variant_value = null;

            $colorVariants = [];
            $sizeVariants = [];

            foreach ($product->productVariants as $productVariant) {
                $variantName = strtolower($productVariant->variant->name ?? '');
                foreach ($productVariant->variantValues as $variantValue) {
                    if ($variantName === 'color') {
                        $colorVariants[] = [
                            'name' => $variantValue->variant_value->name ?? null,
                            'color_code' => $variantValue->variant_value->color_code ?? null,
                        ];
                    }
                    if ($variantName === 'size') {
                        $sizeVariants[] = $variantValue->variant_value->name ?? null;
                    }
                    if ((int) $variantValue->is_main === 1) {
                        $product->primary_variant_value = $variantValue;
                    }
                }
            }

            $product->color_variants = $colorVariants;
            $product->size_variants = $sizeVariants;
        });
        $user = Auth::guard('customer')->user();
        if ($user) {
            $isWishlisteddata =Wishlist::where('user_id',$user->id)->pluck('product_id')->toArray();
        }
        if ($request->ajax()) {
            return response()->json([
                'html' => view('front.home.product_list',compact('results','isWishlisteddata','totalResults','category','grandParent','parent','categoriesData','variants','attributes','limit','allSubCategory','AllMainCategory','variantColor','path','priceDrop'))->render(),
                'totalResults' => $totalResults,
                'hasMore' => $hasMore,
                'nextOffset' => $offset + $results->count(),
            ]);
        } 
        return view('front.home.product_list',compact('results','categoriesData','totalResults','variants','attributes','limit','category','isWishlisteddata','parent','grandParent','AllMainCategory','allSubCategory','variantColor','hasMore','allChildCategory','path','priceDrop','subCategory','subChildCategory'));
    }

    public function productDetail(Request $request, $product, $title, $sku)
    {
        $isWishlisted = null;
        $isWishlisteddata = [];
        $productcat = '';
        $productSubCat = '';
        $productChildCat = '';
        $user = Auth::guard('customer')->user();
        $product = Product::where('sku', $sku)->first();
        if(!$product){
            abort(404); 
        }
        if ($user) {
            RecentlyViewed::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'product_id' => $product->id
                ],
                [
                    'updated_at' => now()
                ]
            );
        } else {
            $recent = session()->get('recently_viewed', []);

            if (!is_array($recent)) {
                $recent = [];
            }

            $recent = array_values(array_diff($recent, [$product->id]));

            array_unshift($recent, $product->id);

            $recent = array_slice($recent, 0, 10);

            session()->put('recently_viewed', $recent);
        }

        $today = now()->toDateString();
        $priceDrop = PriceDrop::whereDate('start_date', '<=', $today)->whereDate('end_date', '>=', $today)->where('is_deleted',0)->latest()->first();
        $productcat = Category::where('id', $product->main_category_id)->orWhere('id',$product->main_collection_id)->first();
        $sizeChartData = SizeChartManager::with([ 'sizes', 'sections.measurements.values' ])->where('id',$productcat->size_chart_id)->first(); 
        $productDetailId = explode(',',$productcat->product_detail_manager); 
        $productDetailManager = ProductDetailManager::whereIn('id',$productDetailId)->select('id','section_name','content','order')->orderBy('order','asc')->get(); 
        $productSubCat = Category::where('id', $product->main_sub_category_id)->first(); 
        $productChildCat = Category::where('id', $product->main_child_category_id)->first();
        $productreview = Product::with(['reviews.user'])->where('sku', $sku)->where('is_active', "1")->first();
        $reviews = $productreview->reviews()->latest()->get();
       $productvariants = ProductVariant::with([
            'variant:id,name,type',
            'variantValues.variant_value:id,name,color_code',
            'variantValues.first_image' => function ($q) use ($product) {
                $q->where('product_id', $product->id)
                ->where('is_variant_icon', 1);
            }
        ])
        ->select('id', 'variant_id', 'product_id')
        ->where('product_id', $product->id)
        ->get()
        ->map(function ($item) {

            return [
                'id' => $item->id,
                'variant_id' => $item->variant_id,
                'product_id' => $item->product_id,
                'variant_name' => $item->variant->name ?? null,
                'variant_type' => $item->variant->type ?? null,
                'variant_values' => $item->variantValues->map(function ($v) {
                    return [
                        'id' => $v->id,
                        'product_variant_id' => $v->product_variant_id,
                        'is_main' => $v->is_main,
                        'variant_value_id' => $v->variant_value_id,
                        'name' => $v->variant_value->name ?? null,
                        'color_code' => $v->variant_value->color_code ?? null,
                        'image' => $v->first_image?->graphic ?? null,

                        'is_variant_icon' => $v->first_image?->is_variant_icon ?? 0,
                    ];

                })->toArray()

            ];

        })->toArray();
        $productVarientCom = ProductVariantCombination::where('product_id', $product->id)->get();
        $bestproduct = Product::where('best_seller', 1)->where('is_active', "1")->where("is_deleted",  0)->where(['best_seller' => true, 'draf' => false])->orderBy('id', 'desc')->get();
        $returnexchangeProduct = Setting::where('id', 28)->first();
        $contactDetails = Setting::whereIn('key', ['Contact.contact_email', 'Contact.contact_number', 'Contact.whatsapp_number'])->get();
        $productCategoryId = Product::where('id', $product->id ?? 0)->pluck('main_category_id')->first();
        $categoryTaxes = CategoryTax::where('category_taxes.category_id', $productCategoryId ?? 0)
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
            ->get()->toArray();
        $recentlyViewedProducts = []; 
        if ($user) {
            $recentlyViewedProducts = RecentlyViewed::with(['product'])->where('user_id',$user->id)->get(); 
        } else {
            $recentIds = session()->get('recently_viewed', []);
            $recentlyViewedProducts = Product::where('is_active','1')->whereIn('id',$recentIds)->get(); 
        } 
        // return $recentlyViewedProducts; 
        if ($user) {
            $isWishlisted = Wishlist::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->exists();

            $isWishlisteddata = Wishlist::where('user_id', $user->id)
                ->pluck('product_id')
                ->toArray();
        }
     
        $best_seller_products = Product::where('best_seller', 1)->where('is_active', "1")->orderBy('id', 'desc')->get();
        $couponOnDetail = Coupon::where('show_on_detail',1)->where('is_active',1)->first();         
        $facebook = Setting::select('id','value')->where('key','Social.facebook')->first();
        $instagram = Setting::select('id','value')->where('key','Social.instagram')->first(); 
        $pinterst = Setting::select('id','value')->where('key','Social.pinterest')->first(); 
        $youtube = Setting::select('id','value')->where('key','Social.youtube')->first(); 
        $twitter = Setting::select('id','value')->where('key','Social.twitter')->first();        

        $relatedProducts = []; 
        $relatedProduct = $product->related_products; 
        if(!empty($relatedProduct)){
            $relatedIds = explode(',',$relatedProduct); 
            $relatedProducts = Product::select('id','best_seller','name','slug','buying_price','selling_price','discount','discount_type','sku')->where('is_active','1')->whereIn('id',$relatedIds)->get(); 
        }
        $similarProducts = []; 
        $similarProducts = Product::select('id','best_seller','name','slug','buying_price','selling_price','discount','discount_type','sku')
                ->where('is_active', '1')
                ->where('id', '!=', $product->id)
                ->where(function ($query) use ($product) {
                    $query->where('main_category_id', $product->main_category_id);
                    if (!empty($product->main_sub_category_id)) {
                        $query->orWhere('main_sub_category_id',$product->main_sub_category_id);
                    }
                })->get();

        return view('front.home.product_detail', compact('product','productChildCat', 'productcat', 'productSubCat', 'productvariants', 'bestproduct', 'returnexchangeProduct', 'contactDetails', 'productVarientCom', 'isWishlisted', 'isWishlisteddata', 'categoryTaxes',  'recentlyViewedProducts','facebook','instagram','pinterst','youtube','twitter','productDetailManager', 'best_seller_products','priceDrop','couponOnDetail','sizeChartData','relatedProducts','similarProducts'));

    }

    public function viewBag(Request $request)
    {
        $user = Auth::guard('customer')->user();
        if (!$user) {
            $carts = collect();
        } else {
            $carts = Cart::with('product')->where('user_id', $user->id)->get();
        }
        $today = now()->toDateString();
        $priceDrop = PriceDrop::whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->where('is_deleted', 0)
            ->latest()
            ->first();
        $totalMRP = 0;
        $totalDiscount = 0;
        $subtotal = 0;
        $taxableAmount = 0;
        $totalGst = 0;
        $taxRate = 0;
        $taxOption = '';
        $taxType = '';
        $taxId = '';
        $taxFrom = 0;
        $taxTo = 0;
        $categoryTaxes = [];
        $carts->each(function ($cartItem) use ($priceDrop,&$totalMRP,&$totalDiscount,&$subtotal,&$taxRate,&$taxOption,&$taxType,&$taxId,&$taxFrom,&$taxTo,&$categoryTaxes) {
            $combination = ProductVariantCombination::find($cartItem->product_variant_combination_id);
            if (!$combination || !$cartItem->product) {
                return;
            }
            $originalSellingPrice = (float) $combination->selling_price;
            $mainPrice = $originalSellingPrice;
            if ($priceDrop) {
                $productId = $priceDrop->product_id;
                $discountAmount = (float) $priceDrop->amount;
                $applyPriceDrop = false;
                if ($productId == 'all') {
                    $applyPriceDrop = true;
                } else {
                    $productIdArray = explode(',', $productId);
                    $productIdArray = array_map(
                        'trim',
                        $productIdArray
                    );

                    if (in_array((string) $cartItem->product_id,$productIdArray)) {
                        $applyPriceDrop = true;
                    }
                }

                if ($applyPriceDrop) {
                    if ($priceDrop->gain_type == 'drop') {
                        if ($priceDrop->drop_type == 'percentage') {
                            $mainPrice = $originalSellingPrice - (($discountAmount / 100)* $originalSellingPrice);
                        } elseif ($priceDrop->drop_type == 'flat') {
                            $mainPrice = $originalSellingPrice - $discountAmount;
                        }
                    }
                    elseif ($priceDrop->gain_type == 'gain') {
                        if ($priceDrop->drop_type == 'percentage') {
                            $mainPrice = $originalSellingPrice + (($discountAmount / 100)* $originalSellingPrice);
                        } elseif ($priceDrop->drop_type == 'flat') {
                            $mainPrice = $originalSellingPrice + $discountAmount;
                        }
                    }
                }
            }
            $quantity = (int) ($cartItem->quantity ?? 1);
            if ($quantity < 1) {
                $quantity = 1;
            }

            $price = (float) ($combination->price ?? 0);
            $sellingPrice = max(0,(float) $mainPrice);
            $itemMRP = $price * $quantity;
            $itemSellingTotal = $sellingPrice * $quantity;
            $itemDiscount = max(0,$itemMRP - $itemSellingTotal);
            $totalMRP += $itemMRP;
            $totalDiscount += $itemDiscount;
            $subtotal += $itemSellingTotal;
            $selectedVariants = [];
            if ($combination->combination_id) {
                $combinationIds = json_decode($combination->combination_id,true);
                foreach ($combinationIds ?? [] as $variantValueId) {
                    $variantValue = VariantValue::with('variant')->find($variantValueId);
                    if ($variantValue && $variantValue->variant) {
                        $selectedVariants[strtolower($variantValue->variant->name)] = $variantValue->name;
                    }
                }
            }

            $productCategoryId = $cartItem->product->main_category_id ?? 0;
            $categoryTaxes = CategoryTax::where('category_taxes.category_id',$productCategoryId)
                ->leftJoin('taxes','taxes.id','=','category_taxes.tax_id')
                ->select(
                    'category_taxes.id',
                    'category_taxes.category_id',
                    'taxes.tax_type',
                    'taxes.tax_option',
                    'taxes.tax_from',
                    'taxes.tax_to',
                    'taxes.tax_rate'
                )
                ->get()
                ->toArray();
            if (!empty($categoryTaxes)) {
                foreach ($categoryTaxes as $tax) {
                    $taxOption = $tax['tax_option'] ?? '';
                    $taxType = $tax['tax_type'] ?? '';
                    $taxId = $tax['id'] ?? '';
                    $taxRate = (float) ($tax['tax_rate'] ?? 0);
                    $taxFrom = (float) ($tax['tax_from'] ?? 0);
                    $taxTo = (float) ($tax['tax_to'] ?? 0);
                    break;
                }
            }
            $cartItem->selectedVariants = $selectedVariants;
            $cartItem->sku = $combination->sku;
            $cartItem->image = $cartItem->product->images['first'] ?? '';
            $cartItem->productType = $cartItem->product->product_type;
            $cartItem->sellingPrice = $sellingPrice;
            $cartItem->discountAmount = $combination->discount ?? 0;
            $cartItem->discountType = $combination->discount_type ?? '';
            $cartItem->quantity =$quantity;
            $cartItem->price =$price;
            $cartItem->name =$cartItem->product->name;
            $cartItem->tax_price = 0;
            $cartItem->tax_option = $taxOption;
            $cartItem->tax_type = $taxType;
            $cartItem->tax_id = $taxId;
            $cartItem->tax_rate = $taxRate;
            $cartItem->tax_from = $taxFrom;
            $cartItem->tax_to = $taxTo;
            $cartItem->rawTaxArr =$categoryTaxes;
        });

        $finalTaxRate = 0;
        if ($taxType === 'flat') {
            $finalTaxRate = (float) $taxRate;
        } 

        elseif ($taxType === 'floating') {
            if ($subtotal >= $taxFrom && $subtotal <= $taxTo) {
                $finalTaxRate = (float) $taxRate;
            }
        }
        $totalGst = ($subtotal * $finalTaxRate) / 100;
        if ($taxOption === 'inclusive') {
            $taxableAmount = $subtotal - $totalGst;
        } else {
            $taxableAmount = $subtotal;
        }

        $couponDiscount = 0;
        if ($taxOption === 'inclusive') {
            $grandTotal = $subtotal - $couponDiscount;
        } else {
            $grandTotal =$subtotal + $totalGst  - $couponDiscount;
        }

        $totalPayable = $grandTotal;
        return view('front.home.cart',compact('carts','totalMRP','totalDiscount','subtotal','couponDiscount','grandTotal','taxableAmount','totalGst','totalPayable')
        );
    }

    public function checkoutBag(Request $request) 
    { 
        $user = Auth::guard('customer')->user(); 
        if (!$user) 
        { 
            return redirect()->route('front-user.login'); 
        }
        $isBuyNow = session()->has('buy_now'); 
        $buyNow = session('buy_now'); 
        if ($isBuyNow) 
        { 
            $productId = $buyNow['product_id'] ?? null; 
            $productType = $buyNow['product_type'] ?? null; 
            $sku = $buyNow['sku'] ?? null; 
            $quantity = (int) ($buyNow['quantity'] ?? 1); 
            $price = (float) ($buyNow['price'] ?? 0); 
            $salePrice = (float) ($buyNow['sale_price'] ?? 0); 
            $selectedVariant = $buyNow['selectedVariant'] ?? []; 
            $variantIds = []; 
            foreach ($selectedVariant as $variantName => $variantValue)
            { 
                $variant = Variant::whereRaw( 'LOWER(name) = ?', [strtolower($variantName)] )->first(); 
                if (!$variant) 
                { 
                    continue; 
                } 
                $variantValueData = VariantValue::where('variant_id', $variant->id)->whereRaw( 'LOWER(name) = ?', [strtolower($variantValue)] ) ->first(); 
                if ($variantValueData) 
                { 
                    $variantIds[] = $variantValueData->id; 
                }
            } 
            $combinationIds = json_encode($variantIds); 
            $variantCombination = ProductVariantCombination::where( 'combination_id', $combinationIds )->first(); $product = Product::find($productId); 
            if (!$product) 
            { 
                return redirect()->route('front-user.cart')->with('error', 'Product not found.'); 
            } 
            $cartItem = new Cart(); 
            $cartItem->product = $product; 
            $cartItem->product_id = $productId; 
            $cartItem->product_variant_combination_id = $variantCombination->id ?? null; 
            $cartItem->quantity = $quantity;
            $cartItem->selectedVariants = $selectedVariant; 
            $carts = collect([$cartItem]); 
        } 
        else { 
            $carts = Cart::with('product') ->where('user_id', $user->id) ->get(); 
        } 
        $userAddress = UserAddress::with([ 'user', 'city', 'state', 'country' ])->where('user_id', $user->id)->get(); 
        $countries = Country::select('id', 'name') ->where('is_active', 1) ->get();
        $subtotal = 0; 
        $totalGst = 0; 
        $taxableAmount = 0; 
        $taxRate = 0; 
        $taxOption = null; 
        $taxType = null; 
        $taxId = null; 
        $taxFrom = 0; 
        $taxTo = 0; 
        $checkoutData = []; 
        foreach ($carts as $cartItem) 
        { 
            $quantity = (int) $cartItem->quantity; 
            $sellingPrice = 0; 
            if ($cartItem->product_variant_combination_id) 
            { 
                $variant = ProductVariantCombination::find( $cartItem->product_variant_combination_id ); 
                if ($variant) 
                { 
                    $sellingPrice = (float) $variant->selling_price;
                } 
            } 
            if ($sellingPrice <= 0) 
            { 
                $sellingPrice = (float) ( $cartItem->product->selling_price ?? 0 ); 
            }  
            $mrp = (float) ( $cartItem->product->price ?? $cartItem->product->mrp ?? $sellingPrice );  
            $itemTotal = $sellingPrice * $quantity; 
            $productCategoryId = $cartItem->product->main_category_id ?? 0; 
            $categoryTax = CategoryTax::where( 'category_taxes.category_id', $productCategoryId ) ->leftJoin( 'taxes', 'taxes.id', '=', 'category_taxes.tax_id' ) ->select( 'category_taxes.id', 'category_taxes.category_id', 'taxes.id as tax_id', 'taxes.tax_type', 'taxes.tax_option', 'taxes.tax_from', 'taxes.tax_to', 'taxes.tax_rate' ) ->first(); 
            $itemTaxRate = 0; 
            $itemTaxOption = null; 
            $itemTaxType = null; 
            $itemTaxId = null; 
            $itemTaxFrom = 0; 
            $itemTaxTo = 0; 
            if ($categoryTax) { 
                $itemTaxRate = (float) $categoryTax->tax_rate; 
                $itemTaxOption = $categoryTax->tax_option; 
                $itemTaxType = $categoryTax->tax_type; 
                $itemTaxId = $categoryTax->tax_id; 
                $itemTaxFrom = (float) $categoryTax->tax_from; 
                $itemTaxTo = (float) $categoryTax->tax_to; 
            } 
            $itemFinalTaxRate = 0; 
            if ($itemTaxType === 'flat') 
            { 
                $itemFinalTaxRate = $itemTaxRate; 
            } 
            elseif ($itemTaxType === 'floating') 
            { 
                if ( $itemTotal >= $itemTaxFrom && $itemTotal <= $itemTaxTo ) 
                    { 
                        $itemFinalTaxRate = $itemTaxRate; 
                    } 
            } 
            $itemTaxPrice = ( $itemTotal * $itemFinalTaxRate ) / 100; 
            $totalGst += $itemTaxPrice;
            $subtotal += $itemTotal;
            if ($categoryTax) 
            { 
                $taxRate = $itemTaxRate; 
                $taxOption = $itemTaxOption;
                $taxType = $itemTaxType; 
                $taxId = $itemTaxId; 
                $taxFrom = $itemTaxFrom; 
                $taxTo = $itemTaxTo; 
            } 
            $selectedVariants = []; 
            if (!empty($cartItem->selectedVariants)) 
            { 
                $selectedVariants = $cartItem->selectedVariants; 
            } 
            elseif ( !empty($cartItem->combination) ) 
            { 
                $selectedVariants = is_array($cartItem->combination) ? $cartItem->combination : json_decode( $cartItem->combination, true ); 
            } 
            $image = ''; 
            if ( isset($cartItem->product->image) && !empty($cartItem->product->image) ) 
            { 
                $image = $cartItem->product->image; 
            }  
            $checkoutData[] = [ 'product_id' => $cartItem->product_id, 'productId' => $cartItem->product_id, 'product_type' => $productType ?? ( $cartItem->product->product_type ?? null ), 'sku' => $cartItem->product->sku ?? $sku ?? '', 'name' => $cartItem->product->name ?? '', 'quantity' => $quantity, 'price' => $mrp, 'sellingPrice' => $sellingPrice, 'tax_price' => round($itemTaxPrice, 2), 'tax_id' => $itemTaxId, 'tax_rate' => $itemFinalTaxRate, 'tax_option' => $itemTaxOption, 'tax_type' => $itemTaxType, 'tax_from' => $itemTaxFrom, 'tax_to' => $itemTaxTo, 'selectedVariants' => $selectedVariants, 'image' => $image, 'item_total' => round($itemTotal, 2), 'product_variant_combination_id' => $cartItem->product_variant_combination_id, ]; 
            $cartItem->final_selling_price = $sellingPrice; 
            $cartItem->item_total = $itemTotal; 
            $cartItem->tax_price = round($itemTaxPrice, 2); 
            $cartItem->tax_id = $itemTaxId; 
            $cartItem->tax_rate = $itemFinalTaxRate; 
            $cartItem->tax_option = $itemTaxOption; 
            $cartItem->tax_type = $itemTaxType; 
        } 
        $finalTaxRate = 0; 
        if ($taxType === 'flat') 
        { 
            $finalTaxRate = (float) $taxRate; 
        } 
        elseif ($taxType === 'floating') 
        { 
            if ( $subtotal >= $taxFrom && $subtotal <= $taxTo ) 
            { 
                $finalTaxRate = (float) $taxRate;
            } 
        }  
        $totalGst = round( ($subtotal * $finalTaxRate) / 100, 2 ); 
        if ($taxOption === 'inclusive') 
        { 
            $taxableAmount = $subtotal - $totalGst;
        } 
        else { 
            $taxableAmount = $subtotal; 
        } 
        $couponDiscount = 0;  
        if ($taxOption === 'inclusive') 
        { 
        $grandTotal = $subtotal - $couponDiscount;
        } 
        else 
        { 
            $grandTotal = $subtotal + $totalGst - $couponDiscount;
        } 
        $totalPayable = $grandTotal;
        $shippingcharge = 0; 
        return view( 'front.home.checkout', compact( 'user', 'countries', 'userAddress', 'carts', 'checkoutData', 'subtotal', 'totalGst', 'taxableAmount', 'taxRate', 'finalTaxRate', 'taxOption', 'taxType', 'taxId', 'taxFrom', 'taxTo', 'couponDiscount', 'grandTotal', 'totalPayable', 'shippingcharge', 'isBuyNow' ) ); 
    }
    
    public function variantCombinationPrices(Request $request)
    {   
        try {
            $data = $request->json()->all();
            $productId = $data['product_id'] ?? null;
            $skuIds    = $data['vsku'] ?? null;
            $variantId = $data['variant_id'] ?? null;

            if (!$productId || !$skuIds) {
                return response()->json(['error' => 'Missing required data'], 422);
            }
            
            
            $today = now()->toDateString();
            $priceDrop = PriceDrop::whereDate('start_date', '<=', $today)->whereDate('end_date', '>=', $today)->where('is_deleted',0)->latest()->first();

            
            $combination = ProductVariantCombination::select('price', 'selling_price', 'sku', 'discount', 'discount_type','qty')
                ->where('product_id', $productId)
                ->where('combination_id', json_encode($skuIds))
                ->first();


            if (!$combination) {
                return response()->json(['error' => 'Combination not found'], 404);
            }

            if(isset($priceDrop) && !empty($priceDrop)){
                $productId = $priceDrop->product_id;
                $discountAmount = $priceDrop->amount;
                if($priceDrop->gain_type == "drop"){
                    if($productId == "all"){
                        if($priceDrop->drop_type == "percentage"){
                            $mainPrice =$combination->selling_price - (($discountAmount/100) * $combination->selling_price) ; 
                        }
                        if($priceDrop->drop_type == "flat"){
                            $mainPrice = $combination->selling_price - $discountAmount ; 
                        }
                    }
                    else{
                        $productIdArray = explode(",",$productId); 
                        if(in_array($productId,$productIdArray)){
                            if ($priceDrop->drop_type == "percentage") {
                                $mainPrice = $combination->selling_price - (($priceDrop->amount / 100) * $combination->selling_price);
                            } 
                            if ($priceDrop->drop_type == "flat") {
                                $mainPrice = $combination->selling_price - $priceDrop->amount;
                            }
                        }
                    }
                }
                if($priceDrop->gain_type == "gain"){
                    if($productId == "all"){
                        if($priceDrop->drop_type == "percentage"){
                            $mainPrice = $combination->selling_price + (($discountAmount/100) * $combination->selling_price) ; 
                        }
                        if($priceDrop->drop_type == "flat"){
                            $mainPrice = $combination->selling_price + $discountAmount ; 
                        }
                    }
                    else{
                        $productIdArray = explode(",",$productId); 
                        if(in_array($productId,$productIdArray)){
                            if ($priceDrop->drop_type == "percentage") {
                                $mainPrice = $combination->selling_price + (($priceDrop->amount / 100) * $combination->selling_price);
                            } 
                            if ($priceDrop->drop_type == "flat") {
                                $mainPrice = $combination->selling_price + $priceDrop->amount;
                            }
                        }
                    }
                }    
            }               
            $combination->selling_price = (isset($priceDrop) && !empty($priceDrop)) ? $mainPrice : $combination->selling_price;  

            $images = ProductGraphics::where([
                'product_id' => $productId,
                'variant_id' => $variantId
            ])
            ->orderBy('is_front', 'desc')   // front first
            ->orderBy('is_back', 'desc')    // back second
            ->orderBy('updated_at', 'asc')  // optional: stable order for rest
            ->get(['graphic', 'graphic_type', 'is_front', 'is_back']);

            return response()->json([
                'combination'   => $combination,
                'images'        => $images->map(fn($img) => [
                    'graphic'      => asset('uploads/products/' . $img->graphic),
                    'graphic_type' => $img->graphic_type,
                ]),
            ]);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()], 500);
        }
    }

    public function variantStockCheck(Request $request)
    {
        $stock = ProductVariantCombination::where('product_id', $request->product_id)
            ->whereJsonContains('combination_id',  (int) $request->variant_value_id)->where('is_out_of_stock', 1)
            ->count();
        return response()->json([
            'out_of_stock' => $stock > 0
        ]);
    }

    public function getProductVariantImages(Request $request)
    {
        $productId = $request->product_id;
        $variantValueId = $request->variant_value_id;

        $productVariant = ProductVariantValue::where('product_id', $productId)
            ->where('variant_value_id', $variantValueId)
            ->first();

        if (!$productVariant) {
            return response()->json([
                'status' => false,
                'images' => [],
                'first_image' => null,
            ]);
        }

        $graphics = ProductGraphics::where('product_id', $productId)
            ->where('variant_id', $productVariant->variant_value_id)
            ->where('graphic_type', 'image')
            ->orderByDesc('is_front')
            ->get();

        $images = $graphics->pluck('graphic')
            ->filter()
            ->values()
            ->map(function ($image) {
                return asset('uploads/products/' . $image);
            })
            ->values();

        return response()->json([
            'status' => true,
            'images' => $images,
            'first_image' => $images->first(),
        ]);
    }

    public function removeCartProduct(Request $request)
    {
        $cart = Cart::where('id', $request->cartId)
            ->where('user_id', auth()->guard('customer')->user()->id)
            ->first();

        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found'
            ], 404);
        }

        $cart->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product removed from cart'
        ]);
    }

    public function getStates(Request $request)
    {
        $countryId = $request->countryId; 
        $states = State::where('country_id', $countryId)->where('is_active', 1)->pluck('name', 'id');
        return response()->json($states);
    }

    public function getCities(Request $request)
    {   
        $countryId = $request->countryId; 
        $stateId = $request->stateId; 
        $cities = City::where('country_id',$countryId)->where('state_id', $stateId)->where('is_active',1)->pluck('name', 'id');
        return response()->json($cities);
    }
    
}
