@extends('front.layouts.app')
@section('content')
<style>
.cart_main_top {padding: 80px 0px;}
.cart_main_item {width: 100%;border-radius: 0px 0px 12px 12px;background: #f9f9fa;box-shadow: rgba(153, 153, 153, 0.4) 0px 0px 8px;padding: 22px 12px;display: flex;position: relative;flex-direction: row;margin-bottom: 20px;}
.cart_item_left {background: #ffffff;width: 154px;height: 154px;border-radius: 12px;border: 1px solid #ba8342;align-content: center;position: relative;overflow: hidden;}
.cart_item_left > a {display: flex;-webkit-box-align: center;align-items: center;height: 100%;}
.cart_item_left img {display: block;width: 100%;object-fit: cover;}
.cart_item_right {margin-left: 20px;display: flex;flex-direction: column;overflow-y: visible;-webkit-box-pack: start;justify-content: flex-start;}
.cart-item-product-name {overflow: hidden;white-space: nowrap;text-overflow: ellipsis;color: #2e2e2e;font-size: 18px;line-height: 25px;font-weight: 400;}
.cart-item-price {font-size: 18px;color: #ba8341;padding-bottom: 3px;font-weight: 500;}
.cart-item-sku {line-height: 22px;font-size: 0.8rem;color: rgb(79, 50, 103);padding-bottom: 8px;padding-top: 5px;}
.cart_delivery_txt a {text-decoration: underline;cursor: pointer;color: #ba8341;}
.cart_item_select span {font-weight: 500;}
.cart_item_select select {padding: 2px 5px;}
.cart_item_close {position: absolute;top: 30px;right: 25px;font-size: 0px;background: url("{{ asset('assets/image/cart-checkout.png') }}") -293px -253px / 340px;width: 18px;height: 18px;border: none;padding: 0px;}
.cart_apply_coupon {background: rgb(209 148 76 / 28%);box-shadow: rgba(178, 178, 202, 0.5) 2px 2px 6px;border-radius: 12px;width: 100%;text-align: left;padding: 0px 14px;line-height: 48px;cursor: pointer;font-size: 16px;color: #141414;margin-bottom: 24px;position: relative;border: none;font-weight: 500;}
.cart_apply_coupon::before {content: "";background: url("{{ asset('assets/image/cart-checkout.png') }}") -176px -288px / 340px;width: 22px;height: 22px;display: inline-block;margin-right: 10px;vertical-align: middle;filter: brightness(0.2);}
.apply_coup_arrow {position:relative;display:inline-block;margin:7px 0px;float:right;width:34px;height:34px;border-radius:50%;box-shadow:rgb(185, 178, 209) 2px 2px 4px, rgb(241, 237, 255) -3px -3px 6px;}
.apply_coup_arrow::after {content: "";position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);background: url("{{ asset('assets/image/cart-checkout.png') }}") -270px -343px / 340px;width: 16px;height: 16px;filter: brightness(0.2);}
.order_summary_txt {background: rgb(249, 249, 250);box-shadow: rgba(153, 153, 153, 0.25) 2px 2px 6px;border-radius: 12px;margin-bottom: 36px;}
.order_summary_txt > div:first-child {padding: 12px 12px 8px;border-bottom: 2px solid rgb(255, 255, 255);}
.order_summary_txt > div {padding: 10px 12px;}
.order_summary_txt > div > p:last-child {margin-bottom: 0px;}
.order_summary_txt .order_summary_txt2 .price-breakup-final {font-size: 16px;color: #202020;margin-bottom: 0px;line-height: 22px;font-weight: 600;}
.order_summary_txt .order_summary_txt2 p .price-values {float: right;}
.order_summary_txt .order_summary_txt1 p {line-height: 22px;margin-bottom: 5px;font-size: 13px;color: #1c1c1c;font-weight: 500;}
.order_summary_txt .order_summary_txt1 p .price-values {float: right;}
.order_summary_txt1 p.discount a {color: #c91010;text-decoration: none;cursor: pointer;}
.order_summary_txt1 p:last-child {margin-bottom: 0px;}
.order_summary_txt1 p.shipping-charge .price-values > span.free {color: #9b6423;font-size: 14px;}
.btn_place_order {position: relative;outline: none;user-select: none;-webkit-tap-highlight-color: transparent;width: 100%;box-sizing: border-box;color: rgb(255, 255, 255);background: linear-gradient(to right, rgb(186 131 66), rgb(145 92 31));border: none;font-size: 16px;line-height: 42px;border-radius: 12px;margin: 5px 0px 0px;height: 48px;}
.coupon_apply_popup {position:fixed;top:0px;left:0px;width: 100%;height: 100%;z-index: 9999;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;display: flex;}
.coupon_apply_popup_bg {position: fixed;top: 0px;left: 0px;margin-top: 0px;width: 100%;height: 100%;background-color: rgba(0, 0, 0, 0.7);animation-duration: 400ms;animation-fill-mode: both;animation-name: animation-1acbpvw;}
.coupon_apply_popup_inner {position: relative;background: white;max-height: 90%;max-width: 90%;height: auto;width: auto;border-radius: 24px;overflow: hidden auto;z-index: 10001;transition: transform 0.3s linear;animation-duration: 500ms;animation-fill-mode: both;animation-name: animation-32xti;}
.coupon_apply_popup_box {width: 390px;max-height: 70vh;overflow: hidden;}
.coupon_apply_popup_top {display: flex;-webkit-box-align: center;align-items: center;flex-flow: column;padding: 31px 20px 22px;}
.coupon_title {width: 100%;font-size: 15px;text-align: start;color: #2c2c2c;margin-bottom: 17px;margin-left: 4px;}
.coupon_int {position: relative;border-radius: 12px;margin: 0px auto;width: 100%;}
.btn_coupon_apply {font-size: 14px;color: #bf1313;position: absolute;top: 15px;right: 20px;cursor: pointer;border: none;padding: 0px;background: transparent;}
.coupon_int_wra {position: relative;border-radius: 12px;background: rgb(246, 243, 249);width: 100%;height: 48px;}
.int_coup_txt {font-size: 15px;text-align: left;color: #2c2c2c;padding: 0px 16px;margin: 0px;line-height: 2;width: 100%;height: inherit;border: 1px solid rgb(246, 243, 249);border-radius: 12px;cursor: text;outline: none;background: transparent;}
.coupon_other_box {background: rgb(246, 243, 249);border-radius: 24px 24px 0px 0px;padding: 0px 5px;overflow: hidden;}
.coupon_other_box_inner {max-height: calc(-136px + 70vh);padding-bottom: 30px;overflow: hidden auto;}
.coupon_other_box1 {padding: 15px 15px 16px;}
.new_txt_coupon {font-size: 16px;color: #404040;margin-bottom: 11px;text-align: center;}
.not_applicable {min-height:110px;background: rgb(255, 255, 255);box-shadow: rgba(206, 194, 205, 0.5) 0px 0px 5px;border-radius:20px;display: flex;cursor: pointer;position: relative;margin-bottom:24px;border: 3px solid #E91E63;}
.coupon_other_box1 .not_applicable:last-child {margin-bottom: 0px;}
/*.not_applicable::before {content: "";z-index:1;position:absolute;background: rgb(246, 243, 249);width:20px;height:20px;border-radius:50%;display: inline-block;top:50%;transform: translate(-50%, -50%);}
.not_applicable::after {content: "";position:absolute;background: rgb(246, 243, 249);width:20px;height:20px;border-radius:50%;display: inline-block;top: 50%;right: 0px;transform: translate(50%, -50%);}*/
.not_app_txt {color: #3e3e3e;font-size: 11px;position: absolute;right: 16px;top: 13px;font-weight: 400;}
/*.not_applicable_inner {display: flex;-webkit-box-pack: center;justify-content: center;-webkit-box-align: center;align-items: center;background: #8b8b8b;border-radius: 0px 20px 20px 0px;-webkit-writing-mode: vertical-rl;writing-mode: vertical-rl;transform: rotate(-180deg);width: 55px;}*/
.not_applicable_inner {display: flex;-webkit-box-pack: center;justify-content: center;-webkit-box-align: center;align-items: center;background: #E91E63;border-radius: 0px 16px 16px 0px;-webkit-writing-mode: vertical-rl;writing-mode: vertical-rl;transform: rotate(-180deg);width: 55px;}
.not_applicable_inner_per {color: #ffffff;padding: 5px 0px;font-size: 16px;font-weight: 600;}
.not_applicable_inner_des {position: relative;padding: 12px;display: flex;flex-flow: column;width: 100%;max-width: 70%;-webkit-box-pack: justify;justify-content: space-between;word-break: break-word;}
.not_applicable_inner_shop {color: #404040;font-size: 14px;font-weight: 500;}
.not_applicable_inner_shop > p {font-size: 11px;color: #4b4c4c;margin: 0px;font-weight: 400;}
.not_applicable_inner_desp {color: #323232;font-size: 11px;font-weight: 300;margin: 0px;line-height: 14px;}
.coupon_close_icon {flex: 1 1 0%;text-align: right;position: absolute;top: 20px;right: 20px;z-index: 1;}
.coupon_close_icon1 {width: 30px;height: 30px;}
.coupon_span {background: url("image/common-sprite.png") -188px -442px / 850px no-repeat;cursor: pointer;width: 33px;height: 33px;position: relative;display: inline-block;}
.coupon_apply_popup.active {display: flex !important;}

@-webkit-keyframes animation-32xti {
	0% {
    bottom: -100%;
	}
	100% {
	    bottom: 0;
	}
}

@keyframes animation-32xti {
	0% {
    bottom: -100%;
	}
	100% {
	    bottom: 0;
	}
}

@-webkit-keyframes animation-1acbpvw {
	0% {
    opacity: 0;
	}
	100% {
	    opacity: 1;
	}
}
@keyframes animation-1acbpvw {
	0% {
    opacity: 0;
	}
	100% {
	    opacity: 1;
	}
}

.coupon_other_box_inner::-webkit-scrollbar {width: 8px;background-color: #fff;}
.coupon_other_box_inner::-webkit-scrollbar-thumb {background-color: #626262;}
.cart_delivery_txt {margin-top: 5px;}
.cart_item_select {display: flex;align-items: center;gap: 7px;}
.quantity_field {display: flex;align-items: center;}
.quantity_field input[type="number"] {width: 45px;text-align: center;border: 1px solid #dfdfdf;padding: 3px 7px;font-size: 16px;outline: none;border-radius: 4px;margin: 0px 5px;}
.quantity_field input[type="number"]::-webkit-inner-spin-button, .quantity_field input[type="number"]::-webkit-outer-spin-button {-webkit-appearance: none;margin: 0;}
.quantity_field input[type="number"] {-moz-appearance: textfield;}
button.sub {background-color: #b47d3d;color: #fff;border: none;cursor: pointer;font-size: 20px;border-radius: 50%;width: 32px;height: 32px;text-align: center;transition: background-color 0.2s;}
button.add {background-color: #b47d3d;color: #fff;border: none;cursor: pointer;font-size: 20px;border-radius: 50%;width: 32px;height: 32px;text-align: center;transition: background-color 0.2s;}
    .quantity-option h5{ font-size:18px; color:#38271e; font-weight: 500;}
    .quantity {width:140px; height:40px; border:1px solid #E7DDD4; border-radius:1rem; display:flex; overflow:hidden; background:#fff;}
    .quantity button{ width:40px; border:none; background:none; cursor:pointer; font-size:22px; transition:.3s;}
    .quantity button:hover{ background:#F2D7D5;}
    .quantity input{ flex:1; border:none; outline:none; text-align:center; font-size:18px; background:none; width: 100%;}
</style>
<div class="coupon_apply_popup" style="display: none;" id="coupon_apply_popup">
	<div class="coupon_apply_popup_bg"></div>
	<div class="coupon_apply_popup_inner">
		<div class="coupon_apply_popup_box">
			<div class="coupon_close_icon" id="coupon_close_icon">
				<div class="coupon_close_icon1">
					<span class="coupon_span"></span>
				</div>
			</div>
			<div class="coupon_apply_popup_top">
				<h2 class="coupon_title">Apply Coupon</h2>
				<div class="coupon_int">
					<div class="coupon_int_wra">
						<input id="couponCode" class="int_coup_txt" type="text" name="couponCode" width="100%" autocomplete="off" placeholder="Enter coupon code">
					</div>
					<button type="button" class="btn_coupon_apply">APPLY</button>
				</div>
			</div>
			<div class="coupon_other_box">
				<div class="coupon_other_box_inner">
					<div class="coupon_other_box1">
						<h6 class="new_txt_coupon">Other Offers at Jaipur Jewellery House</h6>
                        @foreach($allCoupons as $couponUser)
                            @php
                                $coupon = $couponUser->coupon;
                                if (!$coupon) continue;

                                $discount = '';
                                if ($coupon->discount_type == 'percentage') {
                                    $discount = $coupon->discount_value . '% OFF';
                                } elseif ($coupon->discount_type == 'flat') {
                                    $discount = $coupon->discount_value . ' Rs OFF';
                                }

                                $isApplicable = $subtotal >= (float) $coupon->min_cart_value;
                            @endphp

                            <div class="not_applicable">
                                <div class="not_applicable_inner">
                                    <div class="not_applicable_inner_per">{{ $discount }}</div>
                                </div>

                                <div class="not_applicable_inner_des">
                                    <div class="not_applicable_inner_shop">
                                        <span>{{ $coupon->coupon_code }}</span>
                                        <p>Valid till {{ date('M d Y', strtotime($coupon->end_date)) }}</p>
                                    </div>
                                </div>

                                <div class="not_app_txt">
                                    {{ $isApplicable ? 'Applicable' : 'Not Applicable' }}
                                </div>
                            </div>
                        @endforeach    
                            {{-- <div class="not_applicable">
                                <div class="not_applicable_inner">
                                    <div class="not_applicable_inner_per">13% OFF</div>
                                </div>
                                <div class="not_applicable_inner_des">
                                    <div class="not_applicable_inner_shop">
                                        <span>SHAYASPL30</span>
                                        <p>Valid till June 30 2025</p>
                                    </div>
                                    <p class="not_applicable_inner_desp">Buy 2 or More get 30% off on MRP</p>
                                </div>
                                <div class="not_app_txt">Not Applicable</div>
                            </div> --}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="cart_main_top">
	<div class="container">
        @if (Auth::guard('customer')->check())
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-2 mb-2">
                    <a href="{{ route('user.cart.export') }}" class="btn btn-secondary">Export</a>
                </div>
                <div class="col-md-2"></div>
            </div>
        @endif 
		<div class="row">
			<div class="col-md-8">
                @if (Auth::guard('customer')->check())
                    <div class="cart_main_inner">
                        @foreach($carts as $cart)    
                            <div class="cart_main_item">
                                <div class="cart_item_left">
                                    <a href="@if(!empty($cart->product->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $cart->product->slug . '.html', 'sku' => $cart->product->sku]) }}@endif">
                                        <img class="cart_left_img" src="{{ $cart->product->images['first'] }}" alt="product-image">
                                    </a>
                                </div>
                                <div class="cart_item_right">
                                    <div class="cart_item_top">
                                        <div class="cart-item-product-name">{{ $cart->product->name }}</div>
                                        <div class="cart-item-price cart-country-price" data-base-amount="{{ $cart->sellingPrice }}">₹{{ $cart->sellingPrice }}</div>
                                        <div class="cart-item-sku">{{ $cart->sku }}</div>
                                        <div class="dbCartData">
                                            <div class="cart_item_select">
                                                <div class="quantity"
                                                    data-cart-id="{{ $cart->id }}"
                                                    data-max-quantity="{{ $cart->product->qty }}">
                                                    <button type="button" class="minus">-</button>
                                                    <input type="text" class="cart-quantity" value="{{ $cart->quantity }}" readonly>
                                                    <button type="button" class="plus">+</button>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                    <button class="cart_item_close remove-cart-product" data-cartId ="{{ $cart->id }}" data-productId = {{ $cart->product->id }}>Close</button>
                                </div>
                            </div>
                        @endforeach     
                    </div>
                @else       
                    <div class="cart_main_inner localCartData"></div>
                @endif 
			</div>
			<div class="col-md-4">
				<div class="cart_item_right_box">
					<button class="cart_apply_coupon">Apply Coupon<div class="apply_coup_arrow"></div></button>
					<div class="order_summary_txt">
                        @if (Auth::guard('customer')->check())
                            <div class="order_summary_txt1">
                                <p class="totalMRP">Total MRP<span class="price-values cart-country-price" data-base-amount="{{ $totalMRP }}">₹{{ $totalMRP }} </span></p>
                                <p class="discount">Discount<span class="price-values cart-country-price" data-base-amount="{{ $totalDiscount }}">₹ {{ $totalDiscount }} </span> </p>
                                <p class="couponDiscount">Coupon Discount <span class="price-values cart-country-price" data-base-amount="0" data-display-sign="-">-₹0.00</span> </p>
                                <p class="subtotal">Subtotal<span class="price-values cart-country-price" data-base-amount="{{ $subtotal }}">₹ {{ $subtotal }}</span></p>
                                <p class="grandTotal"> Grand Total <span class="price-values cart-country-price" data-base-amount="{{ $grandTotal }}">₹{{ $grandTotal }}</span></p>
                                <p class="taxableAmount">Taxable Amount <span class="price-values cart-country-price" data-base-amount="{{ $taxableAmount }}">₹ {{ $taxableAmount }}</span></p>
                                <p class="totalGst">TotalGst(Tax) <span class="price-values cart-country-price" data-base-amount="{{ $totalGst }}">₹ {{ $totalGst }}</span> </p>
                                <p class="totalPayable">Total Payable (Tax Included) <span class="price-values cart-country-price" data-base-amount="{{ $totalPayable }}">₹{{ $totalPayable }}</span> </p>
                            </div>
                        @else 
                            <div class="order_summary_txt1">
                                <p class="totalMRP">Total MRP <span class="price-values cart-country-price">₹0</span></p>
                                <p class="discount">Discount <span class="price-values cart-country-price">₹0</span></p>
                                <p class="couponDiscount">Coupon Discount <span class="price-values cart-country-price" data-base-amount="0" data-display-sign="-">-₹0.00</span></p>
                                <p class="subtotal">Subtotal <span class="price-values cart-country-price">₹0</span></p>
                                <p class="grandTotal">Grand Total <span class="price-values cart-country-price">₹0</span></p>
                                <p class="taxableAmount">Taxable Amount <span class="price-values cart-country-price">₹0</span></p>
                                <p class="totalGst">TotalGst(Tax) <span class="price-values cart-country-price">₹0</span></p>
                                <p class="totalPayable">Total Payable (Tax Included) <span class="price-values cart-country-price">₹0</span></p>
                            </div>
                        @endif     
					</div>
                    {{-- <a href="{{ route('front-product.checkoutBag') }}" class="btn_place_order">CHECKOUT</a> --}}
					<button class="btn_place_order">CHECKOUT</button>
				</div>
			</div>
		</div>
	</div>
</div>
@php
    $minSellingQty = 1;
    $maxSellingQty = 10;
    $couponDiscount = 0;
@endphp
<script>
    var isOutOfStock = "{{ url('is-outofstock') }}"; 
    var getVarientReaminingQty  = "{{ route('get-variant-remaining-qty') }}"; 
    var minSellingQty = '{{ $minSellingQty }}';
    var maxSellingQty = '{{ $maxSellingQty }}';
    window.isLoggedIn = @json(Auth::guard('customer')->check());
    var couponDiscount = '{{ $couponDiscount }}';
    window.dbCartItems = @json($carts);
    window.cartSummaryBase = {
        grandTotal: @json((float) $grandTotal),
        totalPayable: @json((float) $totalPayable)
    };
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('assets/js/cart.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const couponPopup = document.getElementById('coupon_apply_popup');
        const closeButton = document.getElementById('coupon_close_icon');

        document.querySelectorAll('.cart_apply_coupon').forEach(function (button) {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                couponPopup.style.display = 'block';
                couponPopup.classList.add('active');
            });
        });

        closeButton.addEventListener('click', function () {
            couponPopup.classList.remove('active');
            couponPopup.style.display = 'none';
        });

        const popupBg = couponPopup.querySelector('.coupon_apply_popup_bg');
        popupBg.addEventListener('click', function () {
            couponPopup.classList.remove('active');
            couponPopup.style.display = 'none';
        });
    });
</script>

<script>
    $(document).on('click', '.btn_coupon_apply', function(e) {
        e.preventDefault();
        if(!window.isLoggedIn){
            window.location.href="{{ route('front-user.login') }}";
            return;
        }
        var couponCode = $('#couponCode').val();
        applyCoupon(couponCode);
    });


    function applyCoupon(couponCode, isRestoringCoupon = false) {
        couponCode = (couponCode || '').trim();
        if (!window.isLoggedIn) {
            window.location.href="{{ route('front-user.login') }}";
            return;
        }
        if (!couponCode) {
            showFlashMessage('Please enter coupon code!', 'error');
            return;
        }
        let cartItems = window.dbCartItems || []; 
        if (!Array.isArray(cartItems) || cartItems.length === 0) {
            showFlashMessage('Your cart is empty!', 'error');
            return;
        }
        let subTotal = 0;
        cartItems.forEach(function(item) {
            let price = parseFloat(String(item.sellingPrice || 0).replace(/,/g, '')) || 0;
            let quantity = parseInt(item.quantity, 10) || 1;
            subTotal += price * quantity;
        });
        $.ajax({
            url: "{{ route('apply.coupon') }}",
            type: "POST",
            dataType: "json",
            data: {
                coupon_code: couponCode,
                cart_total: subTotal,
                cart_items: cartItems,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status) {
                    if (!isRestoringCoupon) {
                        showFlashMessage(response.message);
                    }
                    let couponHTML = 
                            `<figure>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 512.035 512.035">
                                    <g>
                                        <path d="m488.502 256.035 22.464-58.592c2.464-6.464.544-13.792-4.864-18.176l-48.704-39.488-9.856-61.984c-1.088-6.848-6.464-12.192-13.312-13.28l-61.984-9.856L332.79 5.923c-4.352-5.408-11.84-7.328-18.144-4.864l-58.624 22.496L197.43 1.091c-6.496-2.496-13.76-.512-18.144 4.864l-39.488 48.736-61.984 9.856a16.033 16.033 0 0 0-13.28 13.28l-9.856 61.984-48.736 39.488c-5.376 4.352-7.328 11.68-4.864 18.144l22.464 58.592-22.464 58.592c-2.496 6.464-.512 13.792 4.864 18.144l48.736 39.456 9.856 61.984c1.088 6.848 6.432 12.224 13.28 13.312l61.984 9.856 39.488 48.704a15.923 15.923 0 0 0 18.176 4.864l58.56-22.432 58.592 22.464a16.066 16.066 0 0 0 5.728 1.056c4.704 0 9.344-2.08 12.448-5.952l39.456-48.704 61.984-9.856a16.03 16.03 0 0 0 13.312-13.312l9.856-61.984 48.704-39.456c5.408-4.384 7.328-11.68 4.864-18.144z" fill="#fc2424"/>
                                        <path d="M208.022 224.035c-26.464 0-48-21.536-48-48s21.536-48 48-48 48 21.536 48 48-21.536 48-48 48zm0-64c-8.832 0-16 7.168-16 16s7.168 16 16 16 16-7.168 16-16-7.168-16-16-16zM304.022 384.035c-26.464 0-48-21.536-48-48s21.536-48 48-48 48 21.536 48 48-21.536 48-48 48zm0-64c-8.8 0-16 7.2-16 16s7.2 16 16 16-7.2-7.2-16-16zM176.022 384.035c-3.232 0-6.464-.96-9.28-2.976-7.2-5.152-8.864-15.136-3.712-22.336l160-224c5.152-7.2 15.136-8.864 22.336-3.712 7.2 5.12 8.832 15.136 3.712 22.304l-160 224c-3.168 4.384-8.064 6.72-13.056 6.72z" fill="#fafafa"/>
                                    </g>
                                </svg>
                            </figure>
                            <figcaption>
                                <h4>${$('<div>').text(response.coupon.coupon_code).html()}<span>Best Offer For You Only</span></h4>
                                <p>Save ${response.discount} on this order</p>
                            </figcaption>`;
                    $('.flate-off-l').html(couponHTML);
                    localStorage.setItem('coupon_id', response.coupon.id);
                    localStorage.setItem('coupon_discount', response.discount);
                    localStorage.setItem('coupon_code', response.coupon.coupon_code);
                    couponDiscount = parseFloat(response.discount) || 0;
                    updateCouponOrderSummary(couponDiscount);
                    $('#view-coupon').modal('hide');
                } else {
                    if (isRestoringCoupon) {
                        clearStoredCoupon();
                        couponDiscount = 0;
                        updateCouponOrderSummary(0);
                    }
                    if (!isRestoringCoupon) {
                        showFlashMessage(response.message, 'error');
                    }
                    $('.coupon_error').text(response.message);
                    setTimeout(function() {
                        $('.coupon_error').text('');
                    }, 3000);
                }
            },
            error: function(xhr) {
                let message = xhr.responseJSON?.message || 'Unable to apply coupon. Please try again.';
                if (isRestoringCoupon) {
                    clearStoredCoupon();
                    couponDiscount = 0;
                    updateCouponOrderSummary(0);
                }
                if (!isRestoringCoupon) {
                    showFlashMessage(message, 'error');
                }
                $('.coupon_error').text(message);
                setTimeout(function() {
                    $('.coupon_error').text('');
                }, 3000);
            }
        });
    }

    function updateCouponOrderSummary(discount) {
        const couponAmount = Math.max(0, Number(discount) || 0);
        const totals = window.cartSummaryBase || {};
        const grandTotal = Math.max(0, (Number(totals.grandTotal) || 0) - couponAmount);
        const totalPayable = Math.max(0, (Number(totals.totalPayable) || 0) - couponAmount);

        $('.couponDiscount .price-values')
            .attr('data-base-amount', couponAmount)
            .attr('data-display-sign', '-');
        $('.grandTotal .price-values').attr('data-base-amount', grandTotal);
        $('.totalPayable .price-values').attr('data-base-amount', totalPayable);

        if (typeof updateCartCountryPrices === 'function') {
            updateCartCountryPrices();
        }
    }

    function clearStoredCoupon() {
        localStorage.removeItem('coupon_id');
        localStorage.removeItem('coupon_discount');
        localStorage.removeItem('coupon_code');
    }

    $(function() {
        const savedCouponCode = localStorage.getItem('coupon_code');
        if (window.isLoggedIn && savedCouponCode) {
            $('#couponCode').val(savedCouponCode);
            applyCoupon(savedCouponCode, true);
        }
    });


    const cartData = localStorage.getItem('cartItems'); 
    if (cartData) {
        const cartItems = JSON.parse(cartData);
        let html = '';
        cartItems.forEach(function(item,index) {
            const productUrl = item.sku ? "{{ route('front-product.detail', ['product' => 'product', 'title' => 'SLUG.html', 'sku' => 'SKU']) }}".replace('SLUG.html', item.slug + '.html').replace('SKU', item.sku): '#';
            var newSellingPrice = item.sellingPrice * item.quantity ; 
            html += `
                <div class="cart_main_item" data-random-id="${item.randomId}">
                    <div class="cart_item_left">
                        <a href="${productUrl}">
                            <img class="cart_left_img" src="${item.image || ''}" alt="${item.name}">
                        </a>
                    </div>

                    <div class="cart_item_right">
                        <div class="cart_item_top">

                            <div class="cart-item-product-name">
                                <a href="${productUrl}" style="text-decoration:none;color:#000">
                                    ${item.name}
                                </a>
                            </div>

                            <div class="cart-item-price">
                                ₹${(parseFloat(item.sellingPrice))}
                            </div>

                            <div class="cart-item-sku">
                                ${item.sku}
                            </div>

                            <div class="cart_item_select">
                                <div class="quantity">
                                    <button type="button" class="minus">-</button>
                                    <input type="text" class="cart-quantity" value="${item.quantity}" readonly>
                                    <button type="button" class="plus">+</button>
                                </div>
                            </div>

                        </div>

                        <button class="cart_item_close remove-cart-product"
                            data-randomId="${item.randomId}"
                            data-index="${index}"
                            data-productId="${item.productId}">
                            Close
                        </button>
                    </div>
                </div>
            `;
        });
        $('.localCartData').html(html);
    }

    $(document).on('click', '.remove-cart-product', function(){
        if(window.isLoggedIn){
            let cartId = $(this).data('cartid'); 
            $.ajax({
                url: "{{ route('front-remove-cart-product') }}",
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    cartId: cartId
                },
                success: function(response) {
                    console.log('Remove cart response:', response);
                    if (response.success) {
                        $(this).closest('.cart_main_item').remove();
                        showFlashMessage("Product removed from cart", "warning");
                    }
                },
                error: function(error) {
                    console.log('Remove cart error:', error);
                }
            });
        }
        else{
            let productId = $(this).data('productId'); 
            let randomId = $(this).data('randomId');
            let index = $(this).data('index'); 
            removeCartItem(index); 
            $(this).closest('.cart_main_item').remove();
        }
    });
    function removeCartItem(index) {
        let cartData = localStorage.getItem('cartItems');
        if (!cartData) {
            return;
        }
        let cartItems = JSON.parse(cartData);
        if(cartItems[index]){
            cartItems.splice(index,1); 
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
        }
    } 
    
    function getSelectedCurrency() {
		let country = {};
		try {
			country = JSON.parse($('#countryData').val() || '{}'); 
		} catch (e) {
			country = {};
		}
		const currencyCode = country.currency_code || 'INR';
		const currencySymbol = country.currency_symbol || '₹';
        const rate = country.exchange_rates || 0; 
		return {
			code: currencyCode,
			symbol: currencySymbol,
			rate: currencyCode === 'INR' ? 1 : rate
		};
	}

    function updateCartCountryPrices() {
        const currency = getSelectedCurrency();
        if (!currency.rate || currency.rate <= 0) {
            console.error('Exchange rate not found:', currency.code);
            return;
        }
        $('.cart-country-price').each(function () {
            const baseAmount = Number($(this).attr('data-base-amount')) || 0;
            const convertedAmount = baseAmount * currency.rate;
            const displaySign = $(this).attr('data-display-sign') || '';
            $(this).text(
                displaySign + currency.symbol + convertedAmount.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                })
            );
        });
    }

    $(document).ready(function () {
        updateCartCountryPrices();
    });

    $(document).on('click', '.country-option', function () {
        updateCartCountryPrices();
    });

    $('.btn_place_order').on('click',function(){
        if(window.isLoggedIn){
			window.location.href = "{{ route('front-product.checkoutBag') }}";
		}else{
			window.location.href = "{{ route('front-user.login') }}";
		}
    }); 
   
    $(document).on('click', '.localCartData .plus', function () {

        let cartItem = $(this).closest('.cart_main_item');
        let randomId = cartItem.data('random-id');

        let input = $(this).siblings('.cart-quantity');
        let quantity = parseInt(input.val()) || 1;

        quantity++;

        input.val(quantity);

        updateLocalCartQuantity(randomId, quantity);
    });

    $(document).on('click', '.localCartData .minus', function () {
        let cartItem = $(this).closest('.cart_main_item');
        let randomId = cartItem.data('random-id');
        let input = $(this).siblings('.cart-quantity');
        let quantity = parseInt(input.val()) || 1;
        if (quantity <= 1) {
            return;
        }
        quantity--;
        input.val(quantity);
        updateLocalCartQuantity(randomId, quantity);
    });
    
    function updateLocalCartQuantity(randomId, quantity) {
        let cartItems = JSON.parse(localStorage.getItem('cartItems') || '[]');
        let item = cartItems.find(function (cartItem) {
            return String(cartItem.randomId) === String(randomId);
        });
        if (!item) {
            return;
        }
        item.quantity = quantity;
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        displayCartItems();
        priceCalculation();
    }
    
    $(document).on('click', '.dbCartData .plus', function () {
        let quantityBox = $(this).closest('.quantity');
        let cartId = quantityBox.data('cart-id');
        let input = quantityBox.find('.cart-quantity');
        let maxQuantity = parseInt(quantityBox.data('max-quantity')) || 1;
        let quantity = parseInt(input.val()) || 1;

        if (quantity >= maxQuantity) {
            return;
        }
        quantity++;
        updateDbCartQuantity(cartId, quantity, input);
    });

    $(document).on('click', '.dbCartData .minus', function () {
        let quantityBox = $(this).closest('.quantity');
        let cartId = quantityBox.data('cart-id');
        let input = quantityBox.find('.cart-quantity');
        let quantity = parseInt(input.val()) || 1;
        if (quantity <= 1) {
            return;
        }
        quantity--;
        updateDbCartQuantity(cartId, quantity, input);
    });
    
    function updateDbCartQuantity(cartId, quantity, input) {
        $.ajax({
            url: "{{ route('cart.update.quantity') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                cart_id: cartId,
                quantity: quantity
            },
            success: function (response) {

                if (response.status) {

                    input.val(response.quantity);
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    alert(xhr.responseJSON.message);
                } else {
                    alert('Something went wrong.');
                }
            }
        });
    }
</script>
@endsection 