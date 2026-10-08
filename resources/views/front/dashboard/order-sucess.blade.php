@extends('front.layouts.app')
@section('content')
    <section class="site-content checkout-site-content">
      <div class="page-banner-section">
        <div class="page-banner page-banner-bg">
          <div class="container">
            <div class="page-banner-wrap">
              <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                <ul class="breadcrumb-items">
                  <li class="breadcrumb-item trail-begin"><a href="{{ env('WEBSITE_URL') }}" rel="home"><span itemprop="name">Home</span></a></li>
                  <li class="breadcrumb-item trail-end"><span itemprop="name">Order Confirmation</span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- page-banner-section -->
      <div class="content-wrapper">
        <div class="container">
          <div class="page-header text-center">
            <h1 class="page-title">Order Confirmation</h1>
          </div>
            <div class="content-area">
              <div class="thankyou-order-received">
                <i class="fa-regular fa-check-circle success"></i>
                <!-- <i class="fa-regular fa-check-circle failed"></i> -->
                <h5>Hey {{ auth()->guard('customer')->user()->name }}</h5>
                <p>Thank you. Your order has been received.</p>
                </div>
                <div style="text-align: center;"><p>We've got your order! We'll keep you updated once your order ships. Please find your order details below.
                Visit the <b>My Orders</b> section to get further updates about your order.</p>
                </div>
              <div class="row flex-row-reverse">
                  <div class="col-lg-5 col-md-12 col-12">
                    <div class="checkout-order-review">
                      <div class="cart-collaterals">                    
                        <div class="cart-totals">
                          <h4>Order Summary</h4>
                          <div class="cart-items">
                            @foreach ($order->items as $orderItems)
                            @php
                                $combination = json_decode($orderItems->combination);
                                $variantId = \App\Models\VariantValue::where(
                                    'name',
                                    'like',
                                    '%' . reset($combination) . '%',
                                )->value('id');
                                $img =
                                    \App\Models\ProductGraphics::where('product_id', $orderItems->product_id)
                                        ->where('variant_id', $variantId)
                                        ->value('graphic') ??
                                    \App\Models\ProductGraphics::where('product_id', $orderItems->product_id)->value(
                                        'graphic',
                                    );
                                $combinationData = '';
                                foreach ($combination as $key => $data) {
                                    $key = ucfirst($key);
                                    $combinationData .= "<p class='c-color'>$key: $data</p>";
                                }
                                $price = $orderItems->selling_price * $orderItems->qty;
                                $product_price = $orderItems->mrp * $orderItems->qty;
                                $product_varient_discount = getProductVariantSku(
                                    $orderItems->product_variant_combination_id,
                                );

                            @endphp
                            <div class="cart-item">
                                <div class="cart-image">
                                    <img src="{{ url('uploads/products/' . $img) }}" alt="{{ $orderItems->product->name ?? 'N/A' }}">
                                </div>
                                <div class="cart-summery">
                                    <div class="cart-summerydata">
                                    <p class="cart-title">{{ $orderItems->product->name ?? 'N/A' }}</p>                               
                                    <p>Quantity : {{ $orderItems->qty }}</p>
                                    </div>
                                    <div class="cart-summeryprice">
                                    <span class="cart-price">
                                        @if (!empty($product_varient_discount->discount) && $product_varient_discount->discount > 0)
                                            <span> <del>₹{{ $product_price }}</del></span>
                                        @endif
                                        <ins> ₹{{ $price }}</ins>
                                    </span>                           
                                    </div>                              
                                </div>
                             </div>
                            @endforeach                                       
                          </div>                           
                          <div class="cart-totals-table">
                            @php
                                $totalMrp = 0;
                                $totalSellingPrice = 0;
                                $total = 0;
                                $subTotal = 0;
                                $taxAmount = 0;
                                $shippingcharge = 0;
                            @endphp
                            @foreach ($order->items as $orderItems)
                                @php
                                    //prx($orderItems);
                                    //$totalMrp += $product_price;
                                    $totalMrp += $orderItems->mrp * $orderItems->qty;
                                    $totalSellingPrice += $orderItems->selling_price * $orderItems->qty;
                                    $total += $orderItems->total * $orderItems->qty;
                                    $taxAmount += $orderItems->tax_amount;
                                    $subTotal += $orderItems->sub_total * $orderItems->qty;
                                    if ($walletamount) {
                                        $walletamt = $walletamount->amount;
                                    }

                                @endphp
                            @endforeach
                            @php
                                $taxableAmt = $totalSellingPrice - $order->coupon_discount - $taxAmount;
                                $grandTotal = $totalSellingPrice - $order->coupon_discount;
                                $shippingcharge = $order->shippingcharge;
                            @endphp
                            <table class="shop-table">
                              <tbody>
                                <tr class="cart-subtotal">
                                  <th>Total MRP</th>
                                  <td data-title="Subtotal" class="text-end"><strong>₹{{ $totalMrp }}</strong> </td>
                                </tr>
                                <tr class="cart-subtotal">
                                  <th>Discount</th>
                                  <td data-title="Subtotal" class="text-end"><strong>-₹{{ $totalMrp - $totalSellingPrice }}</strong> </td>
                                </tr>
                                <tr class="cart-subtotal">
                                  <th>Sub Total</th>
                                  <td data-title="Subtotal" class="text-end"><strong>₹{{ $totalSellingPrice }}</strong> </td>
                                </tr>
                                <tr class="cart-subtotal">
                                  <th>Coupon Discount</th>
                                  <td data-title="Subtotal" class="text-end"><strong>-₹{{ $order->coupon_discount }}</strong> </td>
                                </tr>
                                <tr class="cart-subtotal">
                                  <th>Grand Total </th>
                                  <td data-title="Subtotal" class="text-end"><strong>₹{{ $grandTotal }}</strong> </td>
                                </tr>
                                <tr class="shipping-totals shipping">
                                  <td>Taxable Amount</td>
                                  <td data-title="Shipping" class="text-end text-green">₹{{ $taxableAmt }}</td>
                                </tr>
                                <tr class="shipping-totals shipping">
                                  <td>Total GST(Tax)</td>
                                  <td data-title="Shipping" class="text-end">₹{{ $taxAmount }}</td>
                                </tr>
                                <tr class="shipping-totals shipping">
                                  <td>Delivery Charges</td>
                                  <td data-title="Shipping" class="text-end">₹{{ $shippingcharge }}</td>
                                </tr>
                                <tr class="order-total">
                                  <th>Total Payable</b> (Tax Included)</th>
                                  <td data-title="Total" class="text-end"><strong>₹{{ $taxableAmt + $taxAmount + $shippingcharge }}</strong> </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>                          
                        </div>
                      </div> 
                      
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-12 col-12">
                    <div class="thankyou-order-section">                      
                      <div class="thankyou-order-map">
                        <iframe title="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d113874.36215608017!2d75.63466729188981!3d26.88527834347104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396c4adf4c57e281%3A0xce1c63a0cf22e09!2sJaipur%2C%20Rajasthan!5e0!3m2!1sen!2sin!4v1703757829792!5m2!1sen!2sin" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                      </div>
                      <div class="thankyou-order-details">
                        <ul class="thankyou-order-detail">
                          <li class="order">
                            Order number: <strong>{{ $order->order_number }}</strong>
                          </li>
                          <li class="date">
                            Date: <strong>{{ $order->created_at->format('jS M, Y') }}</strong>
                          </li>
                          <li class="email">
                            Status:<strong><span>Recieved</span></strong>
                          </li>
                        </ul> 
                      </div>                                      
                      <div class="thankyou-customer-details">
                        <div class="row">
                          <div class="col-md-6 col-sm-12 col-12">
                            <h4>Billing address</h4>
                            @php
                                $billing = json_decode($order->billing_address);
                            @endphp
                            <address>
                                <span>{{ $billing->billing_customer_name }} {{ $billing->billing_last_name }}</span>
                                <p>{{ $billing->billing_address }}, {{ $billing->billing_city }},
                                    {{ $billing->billing_state }}, {{ $billing->billing_country }},
                                    {{ $billing->billing_pincode }}</p>
                                <p>Phone: +{{ $billing->billing_phone }}</p>
                            </address>
                          </div>
                        </div>      
                      </div>                      
                    </div>
                    <div class="thankyou-order-button">
                      <p>Need help? <a href="{{ env('WEBSITE_URL') }}contact">Contact us</a></p>
                      <p><a href="{{ env('WEBSITE_URL') }}" class="btn btn-primary">Continue Shopping</a></p>
                    </div>
                  </div>
              </div>
            
            </div>
            <!--content-area-->
          
        </div>
        <!--container-->
      </div>
      <!--content-wrapper-->
    </section>
     <!-- order confirmation section -->                     
@endsection
