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
			{{-- <p class="f-16 font-medium mb-3">Shipping Addrress</p> --}}
			<div class="shipping-address-items">
				@foreach($userAddress as $add)	
					@php  
						if($add->type == 1){
							$type = 'billing'; 
						}
						if($add->type == 2){
							$type = 'shipping'; 
						}
					@endphp 
					<div class="shipping-address-item selected-item">
						
						<input class="shipping-address-input" id="add-{{ $type }}" value="{{ $add->id }}" type="radio" name="Addresses">
						<label class="shipping-address-label" for="add-{{ $type }}">
							 <p>{{ ucfirst($type) }} Address</p>
							<p>{{ $add->name }} <span class="ml-3">{{ $add->phone_number }}</span></p>
							<p> {{ $add->address }}, {{ $add->city->name }}, {{ $add->state->name }} - <span>{{ $add->postal_code }}</span></p>						
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
									</div>
									<div class="form-row form-row-first">
										<label for="billing_first_name" class="">First name <abbr class="required" title="required">*</abbr></label>
										<input type="text" class="input-text" name="first_name" id="billing_first_name" placeholder="e.g. Rahul" value="">
									</div>
											
									<div class="form-row form-row-last">
										<label for="billing_last_name" class="">Last name <abbr class="required" title="required">*</abbr></label>
										<input type="text" class="input-text" name="last_name" id="billing_last_name" placeholder="e.g. sharma" value="">
									</div>
											
									<div class="form-row form-row-wide">
										<label for="billing_email" class="">Email address <abbr class="required" title="required">*</abbr></label>
										<input type="email" class="input-text" name="billing_email" id="billing_email" placeholder="e.g. test@gmail.com" value="" autocomplete="email username">
									</div>

									<div class="form-row form-row-wide">
										<label for="billing_phone" class="">Phone Number<abbr class="required" title="required">*</abbr></label>
										<input type="tel" class="input-text" name="phone_number" id="billing_phone_number" placeholder="e.g. 9874563210" value="" autocomplete="tel">
									</div>

									<div class="form-row form-row-wide">
										<label for="billing_phone" class="">Alternate Phone Number<abbr class="required" title="required">*</abbr></label>
										<input type="tel" class="input-text" name="alternate_number" id="billing_alternate_number" placeholder="e.g. 9874563210" value="" autocomplete="tel">
									</div>
										
									<div class="form-row form-row-wide">
										<label for="billing_country" class="">Country / Region <abbr class="required" title="required">*</abbr></label>
										<select class="input-text" name="country_id" id="country_id">
											<option value="">Select Country</option>
											@foreach($countries as $country)
												<option value="{{ $country->id }}">{{ $country->name }}</option>
											@endforeach
										</select>
									</div>
									<div class="form-row form-row-wide">
										<label for="billing_country" class="">State <abbr class="required" title="required">*</abbr></label>
										<select class="input-text" name="state_id" id="state_id">
											<option value="">Select State</option>
										</select>
									</div>
									<div class="form-row form-row-wide">
										<label for="billing_city" class="">Town / City <abbr class="required" title="required">*</abbr></label>
										<select name="city_id" class="input-text" id="city_id">
											<option value="">Select City</option>
										</select>
									</div>
							
									<div class="form-row form-row-wide">
										<label for="billing_postcode" class="">Postcode <abbr class="required" title="required">*</abbr></label>
										<input type="text" class="input-text" name="pincode" id="pincode" placeholder="e.g. 202032" value="" autocomplete="postal-code">
									</div>

									<div class="form-row form-row-wide">
										<label for="billing_address_2" class="screen-reader-text">Address</label>
										<input type="text" class="input-text" name="address" id="billing_address_2" placeholder="Apartment, suite," value="">
									</div>

									<div class="form-row form-row-wide">
										<label for="billing_address_2" class="screen-reader-text">Landmark</label>
										<input type="text" class="input-text" name="landmark" id="billing_address_2" placeholder="e.g. near lotus apartment..." value="">
									</div>

									<div class="form-row form-row-wide">
										<label for="billing_company" class="input-text">Type</label>
										<select name="address_type" class="form-control" id="">
											<option value="">Select Address Type</option>
											<option value="1">Home</option>
											<option value="2">Office</option>
											<option value="3">Others</option>
										</select>
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
								<input class="checkout-payment-input" id="payment1" type="radio" name="payment" >
								<label class="checkout-payment-label" for="payment1">
									<p class="checkout-payment-title"><img src="images/icon-wallet.png" alt=""> Wallet</p>
									<div class="checkout-payment-box">
										<p>Pay with your wallet</p>
										<p>Balance : ₹ 1000.00</p>                            
									</div>
								</label>     
							</div>
							
							<div class="checkout-payment-item">
								<input class="checkout-payment-input" id="payment3" type="radio" name="payment" >
								<label class="checkout-payment-label" for="payment3">
									<p class="checkout-payment-title"><img src="images/icon-cod.png" alt=""> Cash on delivery</p>
									<div class="checkout-payment-box">                               
										<p>Pay with cash upon delivery.</p>                           
									</div>
								</label>     
							</div>
							
							<div class="checkout-payment-item">
								<input class="checkout-payment-input" id="payment2" type="radio" name="payment" >
								<label class="checkout-payment-label" for="payment2">
									<p class="checkout-payment-title"><img src="images/icon-upi.png" alt=""> Pay With CC Avenue</p>
									<div class="checkout-payment-box">
										<p>Pay via CC avenue; you can pay with your credit card if you don’t have a CC Avenue account.</p>   
									</div>
								</label>     
							</div>
							
							<div class="checkout-payment-item">
								<input class="checkout-payment-input" id="payment4" type="radio" name="payment" >
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
										<span class="price-amount">
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
            <span class="price_subtotal">
                ₹{{ number_format($subtotal, 2) }}
            </span>
        </td>
    </tr>

    <tr>
        <th>GST ({{ $finalTaxRate }}%)</th>
        <td>
            <span class="gst_txt_price">
                ₹{{ number_format($totalGst, 2) }}
            </span>
        </td>
    </tr>

    <tr>
        <th>Shipping</th>
        <td>
            <span class="shipping_txt_price">
                <div class="flat_txt_gray">Flat Rate:</div>
                ₹20.00
            </span>
        </td>
    </tr>

    @if($couponDiscount > 0)
        <tr>
            <th>Discount</th>
            <td>
                <span class="discount_txt_price">
                    -₹{{ number_format($couponDiscount, 2) }}
                </span>
            </td>
        </tr>
    @endif

    <tr class="order-total">
        <th>Total</th>
        <td>
            <span class="price_total">
                ₹{{ number_format($totalPayable, 2) }}
            </span>
        </td>
    </tr>
</tfoot>
					</table>
					<button type="submit" class="btn_place_order" id="place_order">Place order</button>
				</div>
			</div>
		</div>	
	</div>
</div>
<script>
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
</script>
@endsection