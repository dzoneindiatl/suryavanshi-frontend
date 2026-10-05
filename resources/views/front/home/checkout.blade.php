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
		<form name="checkout" method="post" class="checkout_inner_page">
		    <div class="row">
    		    <div class="col-md-6">
    		        <div class="customer_details_checkout">
    		            <div class="customer_details_checkout_bills">
    		                <h3>Billing details</h3>
    		                <div class="inner_checkout_field">
    		                    <div class="form-row form-row-first">
    		                        <label for="billing_first_name" class="">First name <abbr class="required" title="required">*</abbr></label>
    		                        <input type="text" class="input-text" name="billing_first_name" id="billing_first_name" placeholder="" value="">
    		                    </div>
    		                    <div class="form-row form-row-last">
    		                        <label for="billing_last_name" class="">Last name <abbr class="required" title="required">*</abbr></label>
    		                        <input type="text" class="input-text" name="billing_last_name" id="billing_last_name" placeholder="" value="">
    		                    </div>
    		                    <div class="form-row form-row-wide">
    		                        <label for="billing_company" class="">Company name <span class="optional">(optional)</span></label>
    		                        <input type="text" class="input-text" name="billing_company" id="billing_company" placeholder="" value="">
    		                    </div>
    		                    <div class="form-row form-row-wide">
    		                        <label for="billing_country" class="">Country / Region <abbr class="required" title="required">*</abbr></label>
    		                        <select class="input-text" name="billing_country" id="billing_country">
    		                            <option>India</option>
    		                            <option>England</option>
    		                        </select>
    		                    </div>
    		                    <div class="form-row form-row-wide">
    		                        <label for="billing_address_1" class="">Street address <abbr class="required" title="required">*</abbr></label>
    		                        <input type="text" class="input-text" name="billing_address_1" id="billing_address_1" placeholder="House number and street name" value="">
    		                    </div>
    		                    <div class="form-row form-row-wide">
    		                        <label for="billing_address_2" class="screen-reader-text">Apartment, suite, unit, etc. <span class="optional">(optional)</span></label>
    		                        <input type="text" class="input-text" name="billing_address_2" id="billing_address_2" placeholder="Apartment, suite, unit, etc. (optional)" value="">
    		                    </div>
    		                    <div class="form-row form-row-wide">
    		                        <label for="billing_city" class="">Town / City <abbr class="required" title="required">*</abbr></label>
    		                        <input type="text" class="input-text" name="billing_city" id="billing_city" placeholder="" value="">
    		                    </div>
    		                    <div class="form-row form-row-wide">
    		                        <label for="billing_state" class="">County <span class="optional">(optional)</span></label>
    		                        <input type="text" class="input-text" value="" placeholder="" name="billing_state" id="billing_state" autocomplete="address-level1" data-input-classes="">
    		                    </div>
    		                    <div class="form-row form-row-wide">
    		                        <label for="billing_postcode" class="">Postcode <abbr class="required" title="required">*</abbr></label>
    		                        <input type="text" class="input-text" name="billing_postcode" id="billing_postcode" placeholder="" value="" autocomplete="postal-code">
    		                    </div>
    		                    <div class="form-row form-row-wide">
    		                        <label for="billing_phone" class="">Phone <abbr class="required" title="required">*</abbr></label>
    		                        <input type="tel" class="input-text" name="billing_phone" id="billing_phone" placeholder="" value="" autocomplete="tel">
    		                    </div>
    		                    <div class="form-row form-row-wide">
    		                        <label for="billing_email" class="">Email address <abbr class="required" title="required">*</abbr></label>
    		                        <input type="email" class="input-text" name="billing_email" id="billing_email" placeholder="" value="" autocomplete="email username">
    		                    </div>
    		                </div>
    		            </div>
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
						        <tr class="cart_item">
					                <td class="product-name">
						                <div class="product-item-thumbnail">
						                    <img width="80" height="80" src="https://karo.themeftc.com/elementor/wp-content/uploads/2017/07/10-100x100.jpg" alt="img">
						                </div>
						                <h4>Wedding Ring</h4>
						            </td>
					                <td class="product-total">
						                <span class="price-amount">₹172.00</span>
						            </td>
				                </tr>
					        </tbody>
	                        <tfoot>
                                <tr>
			                        <th>Subtotal</th>
			                        <td><span class="price_subtotal">₹172.00</span></td>
		                        </tr>
                                <tr>
	                                <th>Shipping</th>
	                                <td><span class="shipping_txt_price"><div class="flat_txt_gray">Flat Rate:</div> ₹20.00</span></td>
                                </tr>
                                <tr class="order-total">
			                        <th>Total</th>
			                        <td><span class="price_total">₹172.00</span></td>
		                        </tr>
                            </tfoot>
                        </table>
                        <button type="submit" class="btn_place_order" id="place_order">Place order</button>
    		        </div>
    		    </div>
		    </div>
		</form>
	</div>
</div>


@endsection