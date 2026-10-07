@extends('front.layouts.app')
@section('content')
<style>
    .cart_main_top {padding: 80px 0px;}
    .cart_main_item {width: 100%;border-radius: 0px 0px 12px 12px;background: #f9f9fa;box-shadow: rgba(153, 153, 153, 0.4) 0px 0px 8px;padding: 22px 12px;display: flex;position: relative;flex-direction: row;margin-bottom: 20px;}
    .cart_item_left {background: #ffffff;width: 154px;height: 154px;border-radius: 12px;border: 1px solid #ba8342;align-content: center;position: relative;overflow: hidden;}
    .cart_item_left > a {display: flex;-webkit-box-align: center;align-items: center;height: 100%;}
    .cart_item_left img {display: block;width: 100%;object-fit: cover;}
    .cart_item_right {margin-left: 20px;display: flex;flex-direction: column;overflow-y: visible;-webkit-box-pack: start;justify-content: flex-start;}
    .cart-item-product-name {overflow: hidden;white-space: nowrap;text-overflow: ellipsis;color: rgb(78, 85, 94);font-size: 18px;line-height: 25px;}
    .cart-item-price {font-size: 18px;color: #ba8341;padding-bottom: 3px;font-weight: 500;}
    .cart-item-sku {line-height: 22px;font-size: 0.8rem;color: rgb(79, 50, 103);padding-bottom: 8px;padding-top: 5px;}
    .cart_delivery_txt a {text-decoration: underline;cursor: pointer;color: #ba8341;}
    .cart_item_select span {font-weight: 500;}
    .cart_item_select select {padding: 2px 5px;}
    .cart_item_close {position: absolute;top: 30px;right: 25px;font-size: 0px;background: url("{{ asset('assets/image/cart-checkout.png') }}") -293px -253px / 340px;width: 18px;height: 18px;border: none;padding: 0px;}
    .cart_apply_coupon {background: rgb(209 148 76 / 28%);box-shadow: rgba(178, 178, 202, 0.5) 2px 2px 6px;border-radius: 12px;width: 100%;text-align: left;padding: 0px 14px;line-height: 48px;cursor: pointer;font-size: 16px;color: #141414;margin-bottom: 24px;position: relative;border: none;font-weight: 500;}
    .cart_apply_coupon::before {content: "";background: url("{{ asset('assets/image/cart-checkout.png') }}") -176px -288px / 340px;width: 22px;height: 22px;display: inline-block;margin-right: 10px;vertical-align: middle;filter: brightness(0.2);}
    .apply_coup_arrow {position: relative;display: inline-block;margin: 7px 0px;float: right;width: 34px;height: 34px;border-radius: 50%;box-shadow: rgb(185, 178, 209) 2px 2px 4px, rgb(241, 237, 255) -3px -3px 6px;}
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
    .coupon_apply_popup {
        position: fixed;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        z-index: 1001;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        display: flex;
    }
    .coupon_apply_popup_bg {
        position: fixed;
        top: 0px;
        left: 0px;
        margin-top: 0px;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        animation-duration: 400ms;
        animation-fill-mode: both;
        animation-name: animation-1acbpvw;
    }
    .coupon_apply_popup_inner {
        position: relative;
        background: white;
        max-height: 90%;
        max-width: 90%;
        height: auto;
        width: auto;
        border-radius: 24px;
        overflow: hidden auto;
        z-index: 10001;
        transition: transform 0.3s linear;
        animation-duration: 500ms;
        animation-fill-mode: both;
        animation-name: animation-32xti;
    }
    .coupon_apply_popup_box {
        width: 390px;
        max-height: 70vh;
        overflow: hidden;
    }
    .coupon_apply_popup_top {
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        flex-flow: column;
        padding: 31px 20px 22px;
    }
    .coupon_title {
        width: 100%;
        font-size: 1.2rem;
        text-align: start;
        color: rgb(79, 50, 103);
        margin-bottom: 17px;
        margin-left: 4px;
    }
    .coupon_int {
        position: relative;
        border-radius: 12px;
        margin: 0px auto;
        width: 100%;
    }
    .btn_coupon_apply {
        font-size: 1.2rem;
        color: rgb(222, 87, 229);
        position: absolute;
        top: 18px;
        right: 21px;
        cursor: pointer;
        border: none;
        padding: 0px;
    }
    .coupon_int_wra {
        position: relative;
        border-radius: 12px;
        background: rgb(246, 243, 249);
        width: 100%;
        height: 48px;
    }
    .int_coup_txt {
        font-size: 1.4rem;
        text-align: left;
        color: rgb(79, 50, 103);
        padding: 0px 16px;
        margin: 0px;
        line-height: 2;
        width: 100%;
        height: inherit;
        border: 1px solid rgb(246, 243, 249);
        border-radius: 12px;
        cursor: text;
        outline: none;
        background: transparent;
    }
    .coupon_other_box {
        background: rgb(246, 243, 249);
        border-radius: 24px 24px 0px 0px;
        padding: 0px 5px;
        overflow: hidden;
    }
    .coupon_other_box_inner {
        max-height: calc(-136px + 70vh);
        padding-bottom: 30px;
        overflow: hidden auto;
    }
    .coupon_other_box1 {
        padding: 0px 15px 16px;
    }
    .new_txt_coupon {
        font-size: 1.2rem;
        color: rgb(78, 85, 94);
        margin-bottom: 11px;
        text-align: center;
    }
    .not_applicable {
        min-height: 110px;
        background: rgb(255, 255, 255);
        box-shadow: rgba(206, 194, 205, 0.5) 0px 0px 5px;
        border-radius: 20px;
        display: flex;
        cursor: pointer;
        position: relative;
        margin-bottom: 24px;
    }
    .not_applicable::before {
        content: "";
        z-index: 1;
        position: absolute;
        background: rgb(246, 243, 249);
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: inline-block;
        top: 50%;
        transform: translate(-50%, -50%);
    }
    .not_applicable::after {
        content: "";
        position: absolute;
        background: rgb(246, 243, 249);
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: inline-block;
        top: 50%;
        right: 0px;
        transform: translate(50%, -50%);
    }
    .not_app_txt {
        color: rgb(175, 174, 176);
        font-size: 1rem;
        position: absolute;
        right: 16px;
        top: 12px;
    }
</style>

<div class="cart_main_top">
	<div class="container">
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
                                        <div class="cart-item-price">₹{{ $cart->product->selling_price }}</div>
                                        <div class="cart-item-sku">{{ $cart->product->sku }}</div>
                                        <div class="cart_item_select">
                                            <span>Quantity: </span>
                                            <select>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select>
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
						<div class="order_summary_txt1">
                            <p class="totalMRP">Total MRP<span class="price-values">₹{{ $totalMRP }} </span></p>
                            <p class="discount">Discount<span class="price-values">₹ {{ $totalDiscount }} </span> </p>
							<p class="subtotal">Subtotal<span class="price-values">₹ {{ $subtotal }}</span></p>
                            <p class="grandTotal"> Grand Total <span class="price-values">₹{{ $grandTotal }}</span></p>
                            <p class="taxableAmount">Taxable Amount <span class="price-values">₹ {{ $taxableAmount }}</span></p>
                            <p class="totalGst">TotalGst(Tax) <span class="price-values">₹ {{ $totalGst }}</span> </p>
                            <p class="totalPayable">Total Payable (Tax Included) <span class="price-values">₹{{ $totalPayable }}</span> </p>
						</div>
					</div>
                    {{-- <a href="{{ route('front-product.checkoutBag') }}" class="btn_place_order">CHECKOUT</a> --}}
					<button class="btn_place_order">CHECKOUT</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    const cartData = localStorage.getItem('cartItems'); 
     if (cartData) {
        const cartItems = JSON.parse(cartData);
        let html = '';
        cartItems.forEach(function(item,index) {
            const productUrl = item.sku ? "{{ route('front-product.detail', ['product' => 'product', 'title' => 'SLUG.html', 'sku' => 'SKU']) }}".replace('SLUG.html', item.slug + '.html').replace('SKU', item.sku): '#';
            html += `
                <div class="cart_main_item">

                    <div class="cart_item_left">
                        <a href="${productUrl}">
                            <img class="cart_left_img"
                                 src="${item.image || ''}"
                                 alt="${item.name}">
                        </a>
                    </div>

                    <div class="cart_item_right">
                        <div class="cart_item_top">
                            <div class="cart-item-product-name">
                                <a href="${productUrl}" style="text-decoration:none;color:#000">
                                ${item.name} </a>
                            </div>

                            <div class="cart-item-price">
                                ₹${item.sellingPrice}
                            </div>

                            <div class="cart-item-sku">
                                ${item.sku}
                            </div>

                            <div class="cart_item_select">
                                <span>Quantity: </span>
                                <select class="cart-quantity"
                                        data-random-id="${item.randomId}">
                                    <option value="1" ${item.quantity == 1 ? 'selected' : ''}>1</option>
                                    <option value="2" ${item.quantity == 2 ? 'selected' : ''}>2</option>
                                    <option value="3" ${item.quantity == 3 ? 'selected' : ''}>3</option>
                                </select>
                            </div>
                        </div>

                        <button class="cart_item_close remove-cart-product"
                                data-randomId="${item.randomId}" data-index="${index}" data-productId="${item.productId}">
                            Close
                        </button>
                    </div>
                </div>
            `;
        });
        $('.localCartData').html(html);
    }

    $(document).on('click', '.remove-cart-product', function(){
        if(isLoggedIn){
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

    $('.btn_place_order').on('click',function(){
        if(isLoggedIn){
			window.location.href = "{{ route('front-product.checkoutBag') }}";
		}else{
			window.location.href = "{{ route('front-user.login') }}";
		}
    }); 

</script>
@endsection 