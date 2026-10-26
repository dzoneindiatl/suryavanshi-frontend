<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CouponUse;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariantCombination;
use Illuminate\Support\Facades\DB;

class PaymentCancellationService
{
    public function cancelUnpaidOrder(int $orderId): bool
    {
        return DB::transaction(function () use ($orderId) {
            $order = Order::whereKey($orderId)->lockForUpdate()->first();
            if (!$order) {
                return false;
            }

            if ($order->payment_status === 'cancelled') {
                return true;
            }

            if ($order->payment_status !== 'unpaid') {
                return false;
            }

            $orderItems = $order->items;
            $buyNow = session('buy_now');
            $isBuyNowOrder = is_array($buyNow)
                && count($orderItems) === 1
                && (int) $orderItems->first()->product_id === (int) ($buyNow['product_id'] ?? 0);

            foreach ($orderItems as $orderItem) {
                $quantity = (int) $orderItem->qty;
                if ($quantity < 1) {
                    continue;
                }

                $product = Product::whereKey($orderItem->product_id)
                    ->lockForUpdate()
                    ->first();
                if (!$product) {
                    continue;
                }

                $product->increment('qty', $quantity);

                $combinationId = $orderItem->product_variant_combination_id;
                if ($combinationId) {
                    ProductVariantCombination::whereKey($combinationId)
                        ->where('product_id', $product->id)
                        ->lockForUpdate()
                        ->increment('qty', $quantity);
                }

                if (!$isBuyNowOrder) {
                    $cartQuery = Cart::where('user_id', $order->user_id)
                        ->where('product_id', $product->id);
                    if ($combinationId) {
                        $cartQuery->where('product_variant_combination_id', $combinationId);
                    } else {
                        $cartQuery->whereNull('product_variant_combination_id');
                    }

                    if (!$cartQuery->exists()) {
                        Cart::create([
                            'user_id' => $order->user_id,
                            'product_id' => $product->id,
                            'product_variant_combination_id' => $combinationId,
                            'quantity' => $quantity,
                        ]);
                    }
                }
            }

            $couponUses = CouponUse::where('order_id', $order->id)->get();
            foreach ($couponUses as $couponUse) {
                $coupon = Coupon::whereKey($couponUse->coupon_id)
                    ->lockForUpdate()
                    ->first();
                if ($coupon && !(bool) $coupon->is_unlimited && $coupon->available_coupons !== null) {
                    $coupon->increment('available_coupons');
                }
                $couponUse->delete();
            }

            $order->status = 'cancelled';
            $order->save();

            return true;
        });
    }
}
