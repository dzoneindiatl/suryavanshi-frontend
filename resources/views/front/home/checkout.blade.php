@extends('front.layouts.app')
@section('content')

<style>
    .cart_main_top {padding: 80px 0px;}
    .customer_details_checkout_bills h3 {font-weight: bold;margin-bottom: 20px;font-size: 24px;text-transform: uppercase;letter-spacing: 0.2px;color: #444;}
    .inner_checkout_field .form-row {padding: 0px;margin: 0px 0px 25px;}
    .inner_checkout_field .form-row.form-row-first {float: left;width: 47%;overflow: visible;}
    .inner_checkout_field .form-row.form-row-last {float: right;width: 47%;overflow: visible;}
    .inner_checkout_field .form-row.form-row-wide {clear: both;}
    .inner_checkout_field .form-row label {line-height: 2;max-width: 100%;margin-bottom: 5px;font-weight: 600;display: block;color: #333;font-size: 14px;}
    abbr.required {color: #a07936;text-decoration: none;border: none;}
    .inner_checkout_field .form-row input.input-text, .inner_checkout_field .form-row select.input-text {box-sizing: border-box;width: 100%;margin: 0;color: #666;outline: 0;display: inline-block;border: 1px solid #e5e5e5;background: #fff;padding: 10px 15px;line-height: normal;}
    .inner_checkout_field .form-row input.input-text:focus, .inner_checkout_field .form-row select.input-text:focus {border: 1px solid #bb8442;}
    .order_review_box {float: left;width: 100%;position: sticky;top: 60px;border: 6px solid #e5e5e5;transition: all 0.5s ease-in-out;padding: 30px;}
    .order_review_box h3 {font-weight: bold;margin-bottom: 20px;font-size: 24px;text-transform: uppercase;letter-spacing: 0.2px;color: #444;}
    .order_review_box table.shop_table {padding: 0;margin: 0;border: none;margin-bottom: 30px;text-align: left;table-layout: fixed;width: 100%;border-collapse: separate;border-spacing: 0;}
    .order_review_box table.shop_table tr:first-child th {border-bottom: 1px solid #e5e5e5;}
    .order_review_box table.shop_table thead tr th {padding-bottom: 15px;text-transform: uppercase;}
    .product-item-thumbnail {float: left;margin-right: 15px;}
    td.product-name {display: flex;padding: 15px 0px;border-bottom: 1px solid #e5e5e5;}
    td.product-total {border-bottom: 1px solid #e5e5e5;}
    td.product-name h4 {margin: 0px;font-size: 15px;}
    td.product-total, th.product-total {text-align: right;}
    span.price-amount, span.price_subtotal, span.price_total {color: #bb8442;font-weight: 600;}
    .order_review_box table.shop_table tfoot tr td {border-bottom: 1px solid #e5e5e5;padding: 15px 0px;text-align: right;}
    .order_review_box table.shop_table tfoot th {font-weight: 500;border-bottom: 1px solid #e5e5e5;}
    span.shipping_txt_price {display: flex;align-items: center;justify-content: end;gap: 5px;color: #bb8442;font-weight: 600;}
    .flat_txt_gray {color: #888;font-weight: 300;}
    .btn_place_order {width: 100%;font-size: 16px;height: 50px;font-weight: 400;color: #fff;text-transform: uppercase;background: #444;border: 1px solid #444;padding: 7px 15px;border-radius: 10px;transition: all 0.3s ease-in-out;}
    .btn_place_order:hover, .btn_place_order:focus {color: #fff;background: #bb8442;border: 1px solid #bb8442;}
    .top_head_title {text-align: center;margin-bottom: 60px;}
    .top_head_title h2 {color: #333;font-size: 35px;letter-spacing: 0.3px;margin: 0px;}
	.shipping-address {
	background-color: #fff;
	border-radius: 4px;
	padding: 20px;
	margin-bottom: 20px;
}
.shipping-address-items {
	display: flex;
	flex-wrap: wrap;
	margin: 0 -6px -12px;
}
.shipping-address-item {	
	display: flex;
	margin-bottom: 12px;
	padding: 0 6px;
	width: 50%;
}
.shipping-address-item input {
	display: none;
}
.shipping-address-label {
	border: 2px solid #e0e0e0;
	border-radius: 4px;
	cursor: pointer;
	font-size: 13px;
	line-height: 20px;
	padding: 10px 10px 10px 35px;
	width: 100%;
	display: block;
	position: relative;
	word-wrap: break-word;
	transition: .3s border-color;
}
.shipping-address-label::before {
	content: "";
	border: 2px solid #676767;
	width: 18px;
	height: 18px;
	border-radius: 100%;
	position: absolute;
	left: 10px;
	top: 12px;
}
.shipping-address-label::after {
	content: "";
	background-color: #c2a188;
	width: 10px;
	height: 10px;
	border-radius: 100%;
	position: absolute;
	left: 14px;
	top: 16px;
	opacity: 0;
	visibility: hidden;
}
.shipping-address-input:checked ~ .shipping-address-label {
	border-color: #c2a188;
}
.shipping-address-input:checked ~ .shipping-address-label::before {
	border-color: #c2a188;
}
.shipping-address-input:checked ~ .shipping-address-label::after {
	opacity: 1;
	visibility: visible;
}
.shipping-address-input:checked ~ .shipping-address-label .btn {
	display: none;
}
.checkout-payment-section {
	background-color: #fafafa;
	border-radius: 4px;
	padding: 10px;
	margin-top: 20px; 
}
.checkout-payment-items {
	display: flex;
	flex-wrap: wrap;	
}
.checkout-payment-item {
	display: flex;
	margin-bottom: 15px;
	width: 100%;
	border-bottom: 1px solid #e0e0e0;
	padding-bottom: 15px;
}
.checkout-payment-item:last-child { 
	border-bottom: none;
	margin-bottom: 0;
}
.checkout-payment-input {
	display: none;
}
.checkout-payment-label {
	cursor: pointer;
	padding: 10px 10px 10px 40px;
	width: 100%;
	display: block;
	position: relative;
	word-wrap: break-word;
}
.checkout-payment-label::before {
	content: "";
	border: 2px solid #676767;
	width: 18px;
	height: 18px;
	border-radius: 100%;
	position: absolute;
	left: 0;
	top: 12px;
}
.checkout-payment-label::after {
	content: "";
	background-color: #c2a188;
	width: 10px;
	height: 10px;
	border-radius: 100%;
	position: absolute;
	left: 4px;
	top: 16px;
	opacity: 0;
	visibility: hidden;
}
.checkout-payment-input:checked ~ .checkout-payment-label::before {
	border-color: #c2a188;
}
.checkout-payment-input:checked ~ .checkout-payment-label::after {
	opacity: 1;
	visibility: visible;
}
.checkout-payment-title {
	margin-bottom: 0;
	display: flex;
	align-items: center;
}
.checkout-payment-title img {
	max-height: 20px;
	object-fit: contain;
	margin-right: 10px;
}
.checkout-payment-box {
	display: none;
	padding-top: 15px;
}
.checkout-payment-input:checked ~ .checkout-payment-label .checkout-payment-box {
	display: block;
}
.checkout-payment-box p:last-child {
	margin-bottom: 0;
}
/*====checkout-order revirw ===*/
.checkout-order-review {
	background-color: #fff;
	border-radius: 4px;
	margin-bottom: 0;
	padding: 20px;
	position: sticky;
	top: 80px;
}
.checkout-order-review .cart-collaterals {
	border-left: none;
	padding-left: 0;
	position: static;
}
.checkout-order-review .cart-image {
	width: 60px;
	min-width: 60px;
}
.checkout-order-review .cart-totals-table table {
	margin: 0;
}
</style>
<div class="breadcrumb_main">
	<div class="container">
		<div class="breadcrumb_inner">
			<ul>
				<li class="first">
                    <a href="{{ url('/') }}" title="Home"><span>HOME</span></a>
                </li>
				<li><a href="{{ route('front-product.checkoutBag') }}"><span>Checkout</span></a></li>
			</ul>
		</div>
	</div>
</div>

<div class="cart_main_top">
	<div class="container">
		@if(Session::has('success'))
            <div class="alert alert-info">
                {{ Session::get('success') }}
            </div>
        @endif
		<div class="shipping-address">
			<div class="error-msg"></div>
			<div class="shipping-address-items">
				@foreach($userAddress as $key => $add)
					@php
						$type = $add->type == '1' ? 'billing' : 'shipping';
					@endphp

					<div class="shipping-address-item selected-item">
						<input
							class="shipping-address-input"
							id="add-{{ $type }}-{{ $add->id }}"
							value="{{ $add->id }}"
							type="radio"
							name="address"
							data-name="{{ $add->name }}"
							data-phone="{{ $add->phone_number }}"
							data-address="{{ $add->address }}"
							data-city="{{ $add->city->name }}"
							data-state="{{ $add->state->name }}"
							data-pincode="{{ $add->postal_code }}"
							{{ $key == 0 ? 'checked' : '' }}
						>

						<label class="shipping-address-label" for="add-{{ $type }}-{{ $add->id }}">
							<p>{{ ucfirst($type) }} Address</p>
							<p>
								{{ $add->name }}
								<span class="ml-3">{{ $add->phone_number }}</span>
							</p>
							<p>
								{{ $add->address }},
								{{ $add->city->name }},
								{{ $add->state->name }} -
								<span>{{ $add->postal_code }}</span>
							</p>
						</label>
					</div>
				@endforeach		
				{{-- <div class="shipping-address-item not-selected-item">
					<input class="shipping-address-input"  id="add2" type="radio" name="ship" >
					<label class="shipping-address-label" for="add2">
						<p>Tanmay Sharma <span class="ml-3">9876543210</span></p>
						<p>A-5, Durga Colony, New Sanganer Road, Sodala, Jaipur, Rajasthan - <span>302016</span></p>      
					</label>      
				</div> --}}
			</div>
		</div>
		<div class="shipping-address p-0">
			<button id="add-new-address" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#new-address">+ Add A New Address</button>
		</div>		
		<div class="row">
			<div class="col-md-6">
				<div class="collapse mt-3" id="new-address">
					<div class="customer_details_checkout">
						<form action="{{ route('front-user.save_address') }}" method="POST">
							@csrf
							<div class="customer_details_checkout_bills">
								<h3>Billing details</h3>
								<div class="inner_checkout_field">
									<div class="form-row form-row-wide">
										<label for="billing_company" class="input-text">Type</label>
										<select name="type" class="form-control" id="">
											<option value="">Select Type</option>
											<option value="1">Shipping</option>
											<option value="2">Billing</option>
										</select>
										@error('type')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="form-row form-row-first">
										<label for="billing_first_name" class="">First name <abbr class="required" title="required">*</abbr></label>
										<input type="text" class="input-text" name="first_name" placeholder="e.g. Rahul" value="{{ old('first_name') }}">
										@error('first_name')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
											
									<div class="form-row form-row-last">
										<label for="billing_last_name" class="">Last name <abbr class="required" title="required">*</abbr></label>
										<input type="text" class="input-text" name="last_name" placeholder="e.g. sharma" value="{{ old('last_name') }}">
										@error('last_name')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
											
									<div class="form-row form-row-wide">
										<label for="Email" class="">Email address <abbr class="required" title="required">*</abbr></label>
										<input type="email" class="input-text" name="email" placeholder="e.g. test@gmail.com" value="{{ old('email') }}" autocomplete="email username">
										@error('email')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="form-row form-row-wide">
										<label for="billing_phone" class="">Phone Number<abbr class="required" title="required">*</abbr></label>
										<input type="tel" class="input-text" name="phone_number" value="{{ old('phone_number') }}" id="billing_phone_number" placeholder="e.g. 9874563210" value="" autocomplete="tel">
										@error('phone_number')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="form-row form-row-wide">
										<label for="billing_phone" class="">Alternate Phone Number</label>
										<input type="tel" class="input-text" name="alternate_number" id="billing_alternate_number" placeholder="e.g. 9874563210" value="" autocomplete="tel">
									</div>
										
									<div class="form-row form-row-wide">
										<label for="billing_country" class="">Country / Region <abbr class="required" title="required">*</abbr></label>
										<select class="input-text" name="country_id" id="country_id">
											<option value="">Select Country</option>
											@foreach($countries as $country)
												<option value="{{ $country->id }} {{ old('country_id') }}">{{ $country->name }}</option>
											@endforeach
										</select>
										@error('country_id')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="form-row form-row-wide">
										<label for="billing_country" class="">State <abbr class="required" title="required">*</abbr></label>
										<select class="input-text" name="state_id" id="state_id">
											<option value="">Select State</option>
										</select>
										@error('state_id')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="form-row form-row-wide">
										<label for="billing_city" class="">Town / City <abbr class="required" title="required">*</abbr></label>
										<select name="city_id" class="input-text" id="city_id">
											<option value="">Select City</option>
										</select>
										@error('city_id')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
							
									<div class="form-row form-row-wide">
										<label for="billing_postcode" class="">Postcode <abbr class="required" title="required">*</abbr></label>
										<input type="text" class="input-text" name="pincode" value="{{ old('pincode') }}" id="pincode" placeholder="e.g. 202032" value="" autocomplete="postal-code">
										@error('pincode')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="form-row form-row-wide">
										<label for="billing_address_2" class="screen-reader-text">Address <abbr class="required" title="required">*</abbr></label>
										<input type="text" class="input-text" name="address" id="billing_address_2" placeholder="Apartment, suite," value="">
										@error('address')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="form-row form-row-wide">
										<label for="billing_address_2" class="screen-reader-text">Landmark <abbr class="required" title="required">*</abbr></label>
										<input type="text" class="input-text" name="landmark" id="billing_address_2" placeholder="e.g. near lotus apartment..." value="">
										@error('landmark')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="form-row form-row-wide">
										<label for="billing_company" class="input-text">Type <abbr class="required" title="required">*</abbr></label>
										<select name="address_type" class="form-control" id="">
											<option value="">Select Address Type</option>
											<option value="1">Home</option>
											<option value="2">Office</option>
											<option value="3">Others</option>
										</select>
										@error('address_type')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>  
								</div>
								<button type="submit" class="btn btn-success">Submit</button>
							</div>
						</form>        
					</div>
				</div>
				
				<div class="checkout-payment-section">
					<p class="f-16 font-medium mb-1">Payment</p>
					<p class="text-secondary mb-3">All transactions are secure and encrypted.</p>
					<form action="">
						<div class="checkout-payment-items">
							<div class="checkout-payment-item">
								<input class="checkout-payment-input payment_method" id="payment1" type="radio" name="payment" value="wallet">
								<label class="checkout-payment-label" for="payment1">
									<p class="checkout-payment-title"><img src="images/icon-wallet.png" alt=""> Wallet</p>
									<div class="checkout-payment-box">
										<p>Pay with your wallet</p>
										<p>Balance : ₹ {{ $user->wallet_avl_balance }}</p>                            
									</div>
								</label>     
							</div>
							
							<div class="checkout-payment-item" id="codPaymentOption">
								<input class="checkout-payment-input payment_method" id="payment2" type="radio" name="payment" value="cod">
								<label class="checkout-payment-label" for="payment2">
									<p class="checkout-payment-title"><img src="images/icon-cod.png" alt=""> Cash on delivery</p>
									<div class="checkout-payment-box">                               
										<p>Pay with cash upon delivery.</p>                           
									</div>
								</label>     
							</div>
							
							<div class="checkout-payment-item" id="ccavenuePaymentOption">
								<input class="checkout-payment-input payment_method" id="payment3" type="radio" name="payment" value="ccavenue">
								<label class="checkout-payment-label" for="payment3">
									<p class="checkout-payment-title"><img src="images/icon-upi.png" alt=""> Pay With CC Avenue</p>
									<div class="checkout-payment-box">
										<p>Pay via CC avenue; you can pay with your credit card if you don’t have a CC Avenue account.</p>   
									</div>
								</label>     
							</div>
							
							<div class="checkout-payment-item" id="paypalPaymentOption">
								<input class="checkout-payment-input payment_method" id="payment4" type="radio" name="payment" value="paypal">
								<label class="checkout-payment-label" for="payment4">
									<p class="checkout-payment-title"><img src="images/icon-paypal.png" alt=""> Pay with PayPal</p>
										<div class="checkout-payment-box">                              
											<p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account. </p>                          
										</div>
								</label>     
							</div>
						</div>          
					</form>
				</div>
			</div>
			<div class="col-md-6">
				<div class="order_review_box">
					<h3>Your order</h3>
					<table class="shop_table">
						<thead>
							<tr>
								<th class="product-name">Product</th>
								<th class="product-total">Subtotal</th>
							</tr>
						</thead>
						<tbody>
							@foreach($carts as $cartItem)
								<tr class="cart_item">
									<td class="product-name">
										<div class="product-item-thumbnail">
											<img width="80" height="80" src="{{ $cartItem->product->images['first'] ?? asset('front/images/no-image.jpg') }}" alt="{{ $cartItem->product->name ?? '' }}"
											>
										</div>
										<h4>{{ $cartItem->product->name ?? '' }}</h4>
										<span>× {{ $cartItem->quantity }}</span>
									</td>

									<td class="product-total">
										<span class="price-amount cart-country-price" data-base-amount="{{ number_format($cartItem->item_total) }}">
											₹{{ number_format($cartItem->item_total, 2) }}
										</span>
									</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>Subtotal</th>
								<td>
									<span class="price_subtotal cart-country-price" data-base-amount="{{ number_format($subtotal, 2) }}">
										₹{{ number_format($subtotal, 2) }}
									</span>
								</td>
							</tr>

							<tr>
								<th>GST ({{ $finalTaxRate }}%)</th>
								<td>
									<span class="gst_txt_price cart-country-price" data-base-amount="{{ number_format($totalGst, 2) }}">
										₹{{ number_format($totalGst, 2) }}
									</span>
								</td>
							</tr>

						{{-- <tr>
							<th>Shipping</th>
							<td>
								<span class="shipping_txt_price">
									<div class="flat_txt_gray">Flat Rate:</div>
									₹20.00
								</span>
							</td>
						</tr> --}}

							<tr id="checkoutCouponDiscount" style="{{ $couponDiscount > 0 ? '' : 'display:none;' }}">
								<th>Coupon Discount</th>
								<td>
									<span class="discount_txt_price cart-country-price" data-base-amount="{{ number_format($couponDiscount, 2) }}" data-display-sign="-">
										-₹{{ number_format($couponDiscount, 2) }}
									</span>
								</td>
							</tr>

							<tr class="order-total">
								<th>Total</th>
								<td>
									<span class="price_total cart-country-price" data-base-amount="{{ number_format($totalPayable, 2) }}">
										₹{{ number_format($totalPayable, 2) }}
									</span>
								</td>
							</tr>
						</tfoot>
					</table>
					<button type="submit" class="btn_place_order" id="placeOrder">Place order</button>
				</div>
			</div>
		</div>	
	</div>
</div>
<script>
	window.dbCartItems = @json($checkoutData); 
	window.subtotal = @json($subtotal); 
	window.totalGst = @json($totalGst); 
	window.taxableAmount = @json($taxableAmount); 
	window.taxRate = @json($taxRate); 
	window.finalTaxRate = @json($finalTaxRate); 
	window.taxOption = @json($taxOption); 
	window.taxType = @json($taxType); 
	window.taxFrom = @json($taxFrom); 
	window.taxTo = @json($taxTo); 
	window.grandTotal = @json($grandTotal); 
	window.totalPayable = @json($totalPayable); 
	window.shippingcharge = @json($shippingcharge); 
	window.isBuyNow = @json($isBuyNow); 
	window.checkoutBaseTotals = {
		grandTotal: @json((float) $grandTotal),
		totalPayable: @json((float) $totalPayable),
		taxableAmount: @json((float) $taxableAmount)
	};
	window.couponValidationPending = false;
	window.checkoutCouponInvalid = false;
	console.log('CHECKOUT DATA:', window.dbCartItems);
</script>
<script>
	function updatePaymentMethods() {
		let country = {};

		try {
			country = JSON.parse($('#countryData').val() || '{}');
		} catch (e) {
			country = {};
		}

		const countryCode = String(country.iso2 || '').toUpperCase();
		const isIndia = countryCode === 'IN';

		$('#paypalPaymentOption').toggle(!isIndia);
		$('#ccavenuePaymentOption').toggle(isIndia);
		$('#codPaymentOption').toggle(isIndia);

		const $selectedPayment = $('input[name="payment"]:checked');

		if ($selectedPayment.length &&
			!$selectedPayment.closest('.checkout-payment-item').is(':visible')) {
			$selectedPayment.prop('checked', false);
		}
	}

	$(document).ready(function () {
		updatePaymentMethods();
	});

	$(document).on('click', '.country-option', function () {
		// Country selector ke existing click handler ke baad countryData update hona chahiye.
		setTimeout(updatePaymentMethods, 0);
	});
	function getSelectedCurrency() {
		let country = {};
		try {
			country = JSON.parse($('#countryData').val() || '{}'); 
			console.log("=========country===========",country); 
		} catch (e) {
			country = {};
		}
		const currencyCode = country.currency_code || 'INR';
		const currencySymbol = country.currency_symbol || '₹';
        const rate = country.exchange_rates || 0; 
		const countryName = country.name || 'India';
		const countryId = country.id  || 102 ;  
		return {
			code: currencyCode,
			symbol: currencySymbol,
			rate: currencyCode === 'INR' ? 1 : rate,
			cName : countryName,
			cId:countryId 
		};
	}

    function updateCartCountryPrices() {
        const currency = getSelectedCurrency();
        if (!currency.rate || currency.rate <= 0) {
            console.error('Exchange rate not found:', currency.code);
            return;
        }
        $('.cart-country-price').each(function () {
           const baseAmount = Number(String($(this).attr('data-base-amount') || 0).replace(/,/g, ''));
			const currencyRate = currency.rate; 
			const convertedAmount = baseAmount * currencyRate;
			const displaySign = $(this).attr('data-display-sign') || '';
            $(this).text(
                displaySign + currency.symbol + convertedAmount.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                })
            );
        });
    }

	function applySavedCheckoutCoupon() {
		if (window.isBuyNow) {
			return;
		}

		const couponCode = localStorage.getItem('coupon_code');
		if (!couponCode || !window.dbCartItems || window.dbCartItems.length === 0) {
			return;
		}

		window.couponValidationPending = true;
		window.checkoutCouponInvalid = false;
		$('#placeOrder').prop('disabled', true);
		$.ajax({
			url: "{{ route('apply.coupon') }}",
			type: 'POST',
			dataType: 'json',
			data: {
				coupon_code: couponCode,
				cart_total: window.subtotal,
				cart_items: window.dbCartItems,
				_token: $('meta[name="csrf-token"]').attr('content')
			},
			success: function (response) {
				if (!response.status) {
					localStorage.removeItem('coupon_id');
					localStorage.removeItem('coupon_discount');
					localStorage.removeItem('coupon_code');
					window.checkoutCouponInvalid = true;
					$('.error-msg').text(response.message || 'This coupon is no longer valid.');
					return;
				}

				localStorage.setItem('coupon_id', response.coupon.id);
				localStorage.setItem('coupon_discount', response.discount);
				localStorage.setItem('coupon_code', response.coupon.coupon_code);
				applyCheckoutCouponDiscount(response.discount);
			},
			error: function (xhr) {
				localStorage.removeItem('coupon_id');
				localStorage.removeItem('coupon_discount');
				localStorage.removeItem('coupon_code');
				window.checkoutCouponInvalid = true;
				$('.error-msg').text(
					xhr.responseJSON?.message || 'Unable to validate your coupon. Please try again.'
				);
			},
			complete: function () {
				window.couponValidationPending = false;
				$('#placeOrder').prop('disabled', false);
			}
		});
	}

	function applyCheckoutCouponDiscount(discount) {
		const couponDiscount = Math.min(
			Math.max(0, Number(discount) || 0),
			Number(window.checkoutBaseTotals.grandTotal) || 0
		);
		window.grandTotal = Math.max(0, window.checkoutBaseTotals.grandTotal - couponDiscount);
		window.totalPayable = Math.max(0, window.checkoutBaseTotals.totalPayable - couponDiscount);
		window.taxableAmount = Math.max(0, window.checkoutBaseTotals.taxableAmount - couponDiscount);

		$('#checkoutCouponDiscount')
			.show()
			.find('.discount_txt_price')
			.attr('data-base-amount', couponDiscount);
		$('.price_total').attr('data-base-amount', window.totalPayable);
		updateCartCountryPrices();
	}

	$(document).ready(applySavedCheckoutCoupon);

    $(document).ready(function () {
        updateCartCountryPrices();
    });

    $(document).on('click', '.country-option', function () {
        updateCartCountryPrices();
    });
	$('#country_id').on('change',function(){
		var countryId = $(this).val();  
		$.ajax({
			url:"{{ url('get-states') }}",
			method:"GET",
			data:{
				countryId:countryId,
			},
			success:function(response){
				console.log(response);
				$('#state_id').empty(); 
				let s = new Option("Select state","");
				$('#state_id').append(s); 
				$.each(response, function(index, state){
					$('#state_id').append(
						new Option(state, index)
					);
				});
			},
			error:function(err){
				console.log(err); 
			}
		}); 
	}); 

	$('#state_id').on('change',function(){
		var countryId = $('#country_id').val(); 
		var stateId = $(this).val(); 
		$.ajax({
			url:"{{ url('get-cities') }}",
			method:"GET",
			data:{
				countryId:countryId,
				stateId:stateId,
			},
			success:function(response){
				console.log(response); 
				$('#city_id').empty(); 
				let ci = new Option("Select Cities","");
				$.each(response,function(index,city){
					$('#city_id').append(new Option(city,index))
				}); 
			},
			error:function(err){
				console.log(err); 
			}
		});
	});

	$('#placeOrder').on('click', function (e) {
		e.preventDefault();
		$('.error-msg').html('');
		if (!window.isBuyNow && window.checkoutCouponInvalid) {
			$('.error-msg').html('Your coupon could not be validated. Please return to your cart and apply it again.');
			return false;
		}
		if (!window.isBuyNow && window.couponValidationPending) {
			$('.error-msg').html('Please wait while your coupon is validated.');
			return false;
		}
		let that = $(this);
		let paymentMethod = $('input[name="payment"]:checked').val();
		let addressInput = $('input[name="address"]:checked');
		let addressId = addressInput.val();
		let cartItems = window.dbCartItems || [];
		console.log("=======paymentMethod========",paymentMethod); 

		let countryData = getSelectedCurrency(); 
		let currencySymbol = countryData.symbol;
		let countryCode = countryData.code; 
		let countryName = countryData.cName; 
		let countryId = countryData.cId;
		let currencyRate = countryData.rate; 

		if (cartItems.length === 0) {
			$('.error-msg').html('Your cart is empty, Please add some product in cart.');
			return false;
		}

		if (!paymentMethod) {
			$('.error-msg').html('Please select payment method.');
			return false;
		}

		if (!addressId) {
			$('.error-msg').html('Please select an address.');
			return false;
		}

		let selectedAddress = {
			id: addressId,
			name: addressInput.data('name'),
			phone: addressInput.data('phone'),
			address: addressInput.data('address'),
			city: addressInput.data('city'),
			state: addressInput.data('state'),
			pincode: addressInput.data('pincode')
		};
		if (paymentMethod === 'cod') {
			let postData = {
				cartItems: window.dbCartItems,
				currencySymbol:currencySymbol,
				countryCode:countryCode,
				countryName:countryName,
				countryId:countryId,
				currencyRate:currencyRate,
				sub_total: window.totalPayable,
				total_gst: window.totalGst,
				taxable_amount: window.taxableAmount,
				tax_rate: window.taxRate,
				final_tax_rate: window.finalTaxRate,
				tax_option: window.taxOption,
				tax_type: window.taxType,
				tax_from: window.taxFrom,
				tax_to: window.taxTo,
				grand_total: window.grandTotal,
				total_payable: window.totalPayable,
				base_total_payable: window.checkoutBaseTotals.totalPayable,
				payment_mode: 'cod',
				coupon_id: window.isBuyNow ? null : localStorage.getItem('coupon_id'),
				coupon_discount: window.isBuyNow ? 0 : (parseFloat(localStorage.getItem('coupon_discount')) || 0),

				// Abhi shipping charge nahi hai
				shippingcharge: 0,

				billing_id: addressId,
				shipping_id: addressId
			};
			console.log('COD POST DATA:', postData);
			that.prop('disabled', true).text('Please wait...');

			$.ajax({
				type: 'POST',
				url: "{{ route('front-place.order') }}",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
					'Content-Type': 'application/json'
				},
				data: JSON.stringify(postData),
				success: function (data) {
					console.log('COD RESPONSE:', data);
					if (data.success === false) {
						$('.error-msg').html(
							data.message || 'Something went wrong.'
						);
						that.prop('disabled', false).text('Place Order');
						return false;
					}

					if (data.success === true) {
						localStorage.removeItem('coupon_id');
						localStorage.removeItem('coupon_discount');
						localStorage.removeItem('coupon_code');
						window.location.href = data.url;
					}
				},

				error: function (xhr) {
					console.log('COD ERROR:', xhr);
					that.prop('disabled', false).text('Place Order');
					$('.error-msg').html(xhr.responseJSON?.message || 'Something went wrong while placing order.');
				}
			});

			return false;
		}
		if (paymentMethod === 'ccavenue') {

			let postData = {
				cartItems: window.dbCartItems,
				currencySymbol:currencySymbol,
				countryCode:countryCode,
				countryName:countryName,
				countryId:countryId,
				currencyRate:currencyRate,
				sub_total: window.totalPayable,
				total_gst: window.totalGst,
				taxable_amount: window.taxableAmount,
				tax_rate: window.taxRate,
				final_tax_rate: window.finalTaxRate,
				tax_option: window.taxOption,
				tax_type: window.taxType,
				tax_from: window.taxFrom,
				tax_to: window.taxTo,
				grand_total: window.grandTotal,
				total_payable: window.totalPayable,
				base_total_payable: window.checkoutBaseTotals.totalPayable,
				payment_mode: 'ccavenue',
				coupon_id: window.isBuyNow ? null : localStorage.getItem('coupon_id'),
				coupon_discount: window.isBuyNow ? 0 : (parseFloat(localStorage.getItem('coupon_discount')) || 0),
				shippingcharge: 0,
				billing_id: addressId,
				shipping_id: addressId
			};

			console.log('CCAvenue PLACE ORDER DATA:', postData);

			that.prop('disabled', true).text('Please wait...');

			$.ajax({
				type: 'POST',
				url: "{{ route('front-place.order') }}",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
					'Content-Type': 'application/json'
				},
				data: JSON.stringify(postData),

				success: function(data) {

					console.log('CCAvenue PLACE ORDER RESPONSE:', data);

					if (data.success === false) {
						$('.error-msg').html(
							data.message || 'Something went wrong.'
						);

						that.prop('disabled', false).text('Place Order');
						return false;
					}

					if (data.success === true && data.payment_mode === 'ccavenue') {
						const paymentForm = document.createElement('form');
						paymentForm.method = 'POST';
						paymentForm.action = "{{ route('front-ccavenue.pay') }}";

						const csrfInput = document.createElement('input');
						csrfInput.type = 'hidden';
						csrfInput.name = '_token';
						csrfInput.value = $('meta[name="csrf-token"]').attr('content');
						paymentForm.appendChild(csrfInput);

						const orderInput = document.createElement('input');
						orderInput.type = 'hidden';
						orderInput.name = 'order_id';
						orderInput.value = data.data.order_id;
						paymentForm.appendChild(orderInput);

						document.body.appendChild(paymentForm);
						paymentForm.submit();
					}
				},

				error: function(xhr) {

					console.log('CCAvenue PLACE ORDER ERROR:', xhr);

					that.prop('disabled', false).text('Place Order');

					$('.error-msg').html(
						xhr.responseJSON?.message ||
						'Something went wrong while placing order.'
					);
				}
			});

			return false;
		}

		if (paymentMethod === 'paypal') {

			let postData = {
				cartItems: window.dbCartItems,
				currencySymbol:currencySymbol,
				countryCode:countryCode,
				countryName:countryName,
				countryId:countryId,
				currencyRate:currencyRate,
				sub_total: window.totalPayable,
				total_gst: window.totalGst,
				taxable_amount: window.taxableAmount,
				tax_rate: window.taxRate,
				final_tax_rate: window.finalTaxRate,
				tax_option: window.taxOption,
				tax_type: window.taxType,
				tax_from: window.taxFrom,
				tax_to: window.taxTo,
				grand_total: window.grandTotal,
				total_payable: window.totalPayable,
				base_total_payable: window.checkoutBaseTotals.totalPayable,
				payment_mode: 'paypal',

				coupon_id: window.isBuyNow ? null : localStorage.getItem('coupon_id'),
				coupon_discount: window.isBuyNow ? 0 : (parseFloat(localStorage.getItem('coupon_discount')) || 0),

				shippingcharge: 0,
				billing_id: addressId,
				shipping_id: addressId
			};

			that.prop('disabled', true).text('Please wait...');
			$.ajax({
				type: 'POST',
				url: "{{ route('front-place.order') }}",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
					'Content-Type': 'application/json'
				},
				data: JSON.stringify(postData),
				success: function (data) {
					console.log('PAYPAL PLACE ORDER RESPONSE:', data);
					if (data.success !== true) {
						$('.error-msg').html(
							data.message || 'Unable to create order.'
						);

						that.prop('disabled', false).text('Place Order');
						return;
					}

					if (data.payment_mode !== 'paypal') {
						$('.error-msg').html(
							'Unexpected payment response. Please try again.'
						);

						that.prop('disabled', false).text('Place Order');
						return;
					}
					$.ajax({
						type: 'POST',
						url: "{{ route('front-paypal.create') }}",
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
							'Content-Type': 'application/json'
						},
						data: JSON.stringify({
							order_id: data.order_id
						}),

						success: function (paypalResponse) {
							console.log('PAYPAL CREATE RESPONSE:',paypalResponse);

							if (paypalResponse.success === true && paypalResponse.approval_url) {
								window.location.href = paypalResponse.approval_url;
								return;
							}
							$('.error-msg').html(paypalResponse.message || 'Unable to start PayPal payment.');
							that.prop('disabled', false).text('Place Order');
						},

						error: function (xhr) {
							console.log('PAYPAL CREATE ERROR:', xhr);
							$('.error-msg').html(xhr.responseJSON?.message || 'Unable to start PayPal payment.');
							that.prop('disabled', false).text('Place Order');
						}
					});
				},

				error: function (xhr) {

					console.log('PAYPAL PLACE ORDER ERROR:', xhr);

					$('.error-msg').html(
						xhr.responseJSON?.message ||
						'Something went wrong while creating the order.'
					);

					that.prop('disabled', false).text('Place Order');
				}
			});

			return false;
		}

		
	});
</script>
@endsection