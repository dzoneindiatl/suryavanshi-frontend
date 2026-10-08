@extends('front.layouts.app')
@section('content')
<style>
    .suryavanshi_my_account_main {padding: 80px 0px;text-align: center;}
    .sidebar_account_left {padding: 32px;display: flex;flex-direction: column;gap: 32px;background-color: #f5f5f5;position: sticky;z-index: 50;top: 70px;-webkit-transition: all 0.3s ease;-moz-transition: all 0.3s ease;-ms-transition: all 0.3s ease;-o-transition: all 0.3s ease;transition: all 0.3s ease;}
    .author_avatar {position: relative;display: inline-flex;margin: 0px auto 25px;}
    .author_avatar .image {border-radius: 50%;overflow: hidden;max-width: 168px;height: 168px;}
    .author_avatar img {height: 100%;max-width: 100%;object-fit: cover;}
    .btn-change_img {background-color: #000000;width: 32px;height: 32px;border-radius: 50%;position: absolute;top: 0;right: 22px;color: #ffffff;display: flex;align-items: center;justify-content: center;-webkit-transition: all 0.3s ease;-moz-transition: all 0.3s ease;-ms-transition: all 0.3s ease;-o-transition: all 0.3s ease;transition: all 0.3s ease;cursor: pointer;}
    .btn-change_img .icon {font-size: 20px;}
    .account-author .author_name {margin-bottom: 4px;font-size: 24px;color: #000;}
    .author_email {font-size: 18px;line-height: 24px;color: #000;margin: 0px;}
    ul.my-account-nav {margin: 0;padding: 0;list-style: none;}
    .my-account-nav_item {display: flex;align-items: center;gap: 12px;color: #000000;padding: 16px;font-weight: 500;font-size: 16px;line-height: 22px;text-decoration: none;transition: all 0.3s ease-in-out;}
    .my-account-nav_item:hover, .my-account-nav_item.active {background: #bb8442;color: #fff;}
    .acount-order_stats {margin-bottom: 48px;display: flex;gap: 25px;justify-content: space-between;}
    .acount-order_stats .order-box {padding: 31px;border: 1px solid #e7c49a;display: flex;align-items: center;gap: 24px;width: 33.333%;background: #fde6ca;}
    .acount-order_stats .order_icon {font-size: 48px;color: #ba8341;}
    .acount-order_stats .order_info {padding-left: 25px;text-align: left;border-left: 1px solid #a5a5a5;}
    .acount-order_stats .info_label {margin-bottom: 4px;font-size: 16px;line-height: 24px;color: #383838;}
    .info_count {line-height: 120%;font-weight: 600;font-size: 35px;color: #000000;margin: 0px;}
    h2.account-title {text-align: left;margin-bottom: 30px;color: #000;}
    table.table-my_order {table-layout: fixed;overflow-x: auto;width: 100%;}
    .table-my_order thead {background: #f5f5f5;}
    .table-my_order th:first-child, .table-my_order td:first-child {width: 155px;border-left: 1px solid #ededed;}
    .table-my_order th:first-child {border-left: 1px solid #f5f5f5;}
    .table-my_order th, .table-my_order td {font-size: 15px;line-height: 20px;padding: 16px 24px;}
    .table-my_order th {color: #000000;font-weight: 600;text-align: left;}
    .table-my_order.order_recent th:nth-child(2), .table-my_order.order_recent td:nth-child(2) {width: 458px;}
    .table-my_order.order_recent th:last-child, .table-my_order.order_recent td:last-child {width: unset;}
    .table-my_order th:last-child, .table-my_order td:last-child {width: 130px;}
    .table-my_order th:last-child {border-right: 1px solid #f5f5f5;}
    .table-my_order td {height: 147px;vertical-align: middle;text-align: left;}
    .table-my_order td {border-bottom: 1px solid #ededed;}
    .table-my_order td:last-child {border-right: 1px solid #ededed;}
    .tb-order_status {max-width: 116px;display: flex;align-items: center;justify-content: center;padding: 8px;font-weight: 600;}
    .tb-order_status.stt-complete {background: rgba(44, 129, 83, 0.0509803922);color: #2C8153;}
    .tb-order_product {display: flex;align-items: center;gap: 16px;}
    .tb-order_product .img-prd {width: 100%;max-width: 90px;flex-shrink: 0;height: 90px;-webkit-transition: all 0.3s ease;-moz-transition: all 0.3s ease;-ms-transition: all 0.3s ease;-o-transition: all 0.3s ease;transition: all 0.3s ease;text-decoration: none;cursor: pointer;display: inline-block;color: #000000;}
    .tb-order_product .img-prd img {height: 100%;object-fit: cover;max-width: 100%;}
    .tb-order_product .infor-prd {display: grid;gap: 8px;}
    .tb-order_product .prd_name {-webkit-line-clamp: 2;-webkit-box-orient: vertical;display: -webkit-box;overflow: hidden;-webkit-transition: all 0.3s ease;-moz-transition: all 0.3s ease;-ms-transition: all 0.3s ease;-o-transition: all 0.3s ease;transition: all 0.3s ease;color: #000000;text-decoration: none;font-weight: 600;}
    .tb-order_product .prd_name:hover {color: #bb8442;}
    .tb-order_product .prd_select {display: flex;align-items: center;color: #5f615e;font-size: 14px;line-height: 20px;gap: 8px;}
    .tb-order_status.stt-pending {background: rgba(232, 183, 70, 0.0509803922);color: #E8B746;}
    .tb-order_status.stt-delivery {background: rgba(59, 168, 188, 0.0509803922);color: #3BA8BC;}
    .tb-order_status.stt-cancel {background: rgba(200, 16, 46, 0.0509803922);color: #C8102E;}
    .wg-pagination {display: flex;align-items: center;gap: 9px;margin-top: 30px;}
    .pagination-item.direct {border: 1px solid #ededed;}
    .pagination-item {width: 56px;height: 56px;}
    .pagination-item {display: flex;align-items: center;justify-content: center;border-radius: 50%;font-size: 18px;line-height: 24px;text-decoration: none;color: #222;}
    .pagination-item i {font-size: 32px;}
    .pagination-item.direct:hover {border-color: #ba8342;}
    .pagination-item.active, .pagination-item:hover {background-color: #ba8342;color: #ffffff;}
    .order_link {-webkit-transition: all 0.3s ease;-moz-transition: all 0.3s ease;-ms-transition: all 0.3s ease;-o-transition: all 0.3s ease;transition: all 0.3s ease;color: #000000;text-decoration: none;font-weight: 600;}
    .order_link:hover {color: #bb8442;}
    .table-my_order th:nth-child(2), .table-my_order td:nth-child(2) {width: 415px;}
    .account-my_address {display: grid;gap: 32px;}
    .account-address-item {flex-direction: row;align-items: center;padding: 24px;border: 1px solid #e3e3e3;display: flex;gap: 24px;background: #f5f5f5;}
    .account-address-item .address-item_content {gap: 24px;display: grid;flex: 1;padding-right: 24px;text-align: left;border-right: 1px solid #e3e3e3;}
    h4.address-title {font-size: 24px;line-height: 32px;color: #000000;margin: 0px;}
    .account-address-item .address-info {display: grid;gap: 8px;}
    .address-info h5 {font-size: 18px;line-height: 27px;color: #000;font-weight: 500;margin: 0px;text-transform: capitalize;}
    .address-info p {font-size: 16px;line-height: 24px;color: #5f615e;margin: 0px;}
    .account-address-item .address-item_action {display: grid;gap: 12px;}
    .account-address-item .address-item_action {min-width: 180px;}
    .btn_delete_pop {border: 1px solid #ededed;background-color: #ffffff;color: #000000;display: inline-flex;align-items: center;justify-content: center;gap: 12px;font-size: 16px;line-height: 22px;padding: 15px 40px;position: relative;border-radius: 999px;font-weight: 600;text-decoration: none;}
    .btn_delete_pop:hover {background-color: #ededed;}
    .btn_edit_pop {position: relative;overflow: hidden;display: inline-flex;align-items: center;justify-content: center;gap: 12px;font-size: 16px;line-height: 22px;text-decoration: none;padding: 15px 40px;background-color: #b97728;color: #ffffff;border-radius: 999px;font-weight: 600;}
    .btn_edit_pop:after {content: "";position: absolute;width: 100%;height: 100%;background-image: linear-gradient(120deg, rgba(0, 0, 0, 0) 20%, rgba(255, 255, 255, 0.4), rgba(0, 0, 0, 0) 70%);top: 0;left: -100%;opacity: 0.6;}
    .btn_edit_pop:hover::after {animation: shine-reverse 1s forwards;}
    .modal-open .modal-backdrop.show {opacity: 0.5;display: block !important;}
    .modal-edit_address .modal-dialog {margin: 0px auto;max-width: 700px;position: absolute;width: 700px;top: 50%;left: 50%;transform: translate(-50%, -50%) !important;}
    .modal-edit_address .modal-dialog .modal-content {padding: 40px;border: medium none;}
    h2.title_edit {margin-bottom: 30px;text-transform: capitalize;font-size: 28px;}
    .form-edit_address .form_content {display: grid;gap: 24px;}
    .form-edit_address input[type=text] {outline: 0;-webkit-box-shadow: none;-moz-box-shadow: none;box-shadow: none;width: 100%;padding: 15px 24px;font-weight: 400;font-size: 16px;line-height: 24px;border: 1px solid #f5f5f5;border-radius: 999px;color: #000000;background-color: #f5f5f5;-webkit-transition: all 0.3s ease;-moz-transition: all 0.3s ease;-ms-transition: all 0.3s ease;-o-transition: all 0.3s ease;transition: all 0.3s ease;}
    .form-edit_address input[type=text]:focus {border-color: #000;}
    .checkbox-wrap {display: flex;align-items: center;gap: 10px;}
    .tf-check {position: relative;background: transparent;cursor: pointer;outline: 0;-webkit-appearance: none;width: 24px;height: 24px;min-width: 24px;border: 1px solid #ededed;padding: 0;display: inline-flex;justify-content: center;align-items: center;background-color: #ffffff;-webkit-transition: all 0.3s ease;-moz-transition: all 0.3s ease;-ms-transition: all 0.3s ease;-o-transition: all 0.3s ease;transition: all 0.3s ease;}
    .checkbox-wrap label {cursor: pointer;font-size: 15px;color: #5f615e;line-height: 24px;margin: 0px;font-weight: 400;}
    .tf-check::before {font-weight: 500;font-family: "FontAwesome";content: "\f00c";position: absolute;color: #ffffff;opacity: 0;font-size: 16px;transform: scale(0);-webkit-transition: all 0.3s ease;-moz-transition: all 0.3s ease;-ms-transition: all 0.3s ease;-o-transition: all 0.3s ease;transition: all 0.3s ease;}
    .tf-check:checked {border-color: #ba8342;background-color: #ba8342;}
    .tf-check:checked::before {opacity: 1;transform: scale(1);}
    .btn_save_form {position: relative;overflow: hidden;display: inline-flex;align-items: center;justify-content: center;gap: 12px;font-size: 16px;line-height: 22px;text-decoration: none;padding: 15px 40px;background-color: #b97728;color: #ffffff;border-radius: 999px;font-weight: 600;border: 1px solid #b97728;}
    .btn_save_form:after {content: "";position: absolute;width: 100%;height: 100%;background-image: linear-gradient(120deg, rgba(0, 0, 0, 0) 20%, rgba(255, 255, 255, 0.4), rgba(0, 0, 0, 0) 70%);top: 0;left: -100%;opacity: 0.6;}
    .btn_save_form:hover::after {animation: shine-reverse 1s forwards;}
    .col_grids {display: flex;gap: 20px;}
    .form-change_pass input[type=text], .form-change_pass input[type=email], input.password-field {outline: 0;-webkit-box-shadow: none;-moz-box-shadow: none;box-shadow: none;width: 100%;padding: 15px 24px;font-weight: 400;font-size: 16px;line-height: 24px;border: 1px solid #f5f5f5;border-radius: 999px;color: #000000;background-color: #f5f5f5;-webkit-transition: all 0.3s ease;-moz-transition: all 0.3s ease;-ms-transition: all 0.3s ease;-o-transition: all 0.3s ease;transition: all 0.3s ease;}
    .form-change_pass input[type=text]:focus, .form-change_pass input[type=email]:focus, input.password-field:focus {border-color: #000;}
    .col_grids fieldset {width: 50%;margin-bottom: 18px;}
    .form_bottom_setting {margin-top: 50px;}
    .btn_submit_form {position: relative;overflow: hidden;display: inline-flex;align-items: center;justify-content: center;gap: 12px;font-size: 16px;line-height: 22px;text-decoration: none;padding: 15px 40px;background-color: #b97728;border: 1px solid #b97728;color: #ffffff;border-radius: 999px;font-weight: 600;margin-top: 10px;width: 100%;}
    .btn_submit_form:after {content: "";position: absolute;width: 100%;height: 100%;background-image: linear-gradient(120deg, rgba(0, 0, 0, 0) 20%, rgba(255, 255, 255, 0.4), rgba(0, 0, 0, 0) 70%);top: 0;left: -100%;opacity: 0.6;}
    .btn_submit_form:hover::after {animation: shine-reverse 1s forwards;}
    .password-wrapper {position: relative;}
    .password-wrapper {position: relative;margin-bottom: 18px;}
    i.fa.fa-eye-slash {position: absolute;top: 18px;right: 20px;color: #5f615e;cursor: pointer;transition: all 0.3s ease-in-out;}
    i.fa.fa-eye-slash:hover {opacity: 0.8;}

    @keyframes shine-reverse {
        0% {
            left: 100%;
        }

        100% {
            left: -100%;
        }
    }

    .account-order_detail {gap: 48px;margin-bottom: 48px;display: flex;}
    .account-order_detail .order-detail_image {max-width: 450px;}
    .account-order_detail .order-detail_image img {max-width: 100%;}
    .order-detail_content {row-gap: 30px;column-gap: 30px;display: grid;width: calc(100% - 498px);}
    .br-line {width: 100%;height: 1px;display: flex;background-color: #ededed;}
    .btn_view_store_txt {border: 1px solid #ededed;background-color: #ffffff;color: #000000;text-decoration: none;display: inline-flex;align-items: center;justify-content: center;gap: 12px;font-size: 15px;line-height: 24px;padding: 15px 40px;position: relative;border-radius: 999px;font-weight: 600;-webkit-transition: all 0.3s ease;-moz-transition: all 0.3s ease;-ms-transition: all 0.3s ease;-o-transition: all 0.3s ease;transition: all 0.3s ease;}
    .btn_view_store_txt:hover {background-color: #ededed;}
    .btn_view_store_txt i {font-size: 18px;}
    .account-order_detail .info-item_value {font-weight: 400;font-size: 15px;line-height: 20px;color: #000000;margin: 0px;}
    .account-order_detail .info-item_label {margin-bottom: 8px;color: #5f615e;font-size: 15px;}
    .account-order_detail .detail-content_info {display: grid;gap: 20px;}
    .account-order_detail .prd_name {margin-bottom: 4px;color: #000;font-size: 24px;line-height: 32px;}
    .price-wrap {display: inline-flex;align-items: center;flex-wrap: wrap;gap: 0px 10px;}
    .price-wrap .price-old {color: #acafab;display: inline;position: relative;font-size: 16px;line-height: 22px;font-weight: 500;text-decoration: line-through;}
    .price-wrap .price-new {color: #5f615e;font-size: 16px;line-height: 22px;font-weight: 600;}
    .detail-info_status {padding: 8px 24px;color: #ffffff;display: inline-flex;width: max-content;background: #c8102e;font-size: 18px;line-height: 24px;font-weight: 400;}
    .detail-info_prd {text-align: left;}
    .detail-info_item {text-align: left;}
    .btn_view_store {text-align: left;}
    .order_tabs_main .nav-tabs .nav-link {border: medium none;}
    .order_tabs_main .nav-tabs .nav-link {border: medium none;color: #000;font-size: 18px;letter-spacing: 0.3px;font-weight: 400;position: relative;padding: 10px 15px 16px;}
    .order_tabs_main .nav-tabs .nav-link.active, .order_tabs_main .nav-tabs .nav-link:hover {color: #b76b10;}
    .order_tabs_main .nav-tabs .nav-link::before {position: absolute;content: "";left: 0;width: 0;bottom: 0px;height: 1px;background-color: #b76b10;transition: width 0.3s linear;z-index: 1;}
    .order_tabs_main .nav-tabs .nav-link.active::before, .order_tabs_main .nav-tabs .nav-link:hover::before {width: 100%;}

    .timeline-step {gap: 40px;display: flex;}
    .order-timeline .timeline-step:not(:last-child) {padding-bottom: 40px;}
    .timeline-step.completed .timeline_icon::after {border-color: #2C8153;}
    .timeline_icon::after {content: "";position: absolute;left: 50%;top: 0;bottom: 0;width: 1px;height: 100%;border: 1px dashed #e2e2e2;}
    .timeline_icon {padding: 0px 7.5px;position: relative;}
    .order-timeline .timeline-step:not(:last-child) .timeline_icon {margin-bottom: -40px;}
    .timeline-step.completed .timeline_icon .icon_time {background-color: #bb8442;border-color: #bb8442;}
    .timeline-step.completed .timeline_icon .icon_time i {color: #fff;}
    .timeline_icon .icon_time {width: 48px;font-size: 24px;height: 48px;border-radius: 50%;color: #ffffff;display: flex;align-items: center;justify-content: center;position: relative;z-index: 2;border: 1px solid #ededed;}
    .timeline-step .step-title {margin-bottom: 10px;font-weight: 600;font-size: 18px;line-height: 25px;color: #000;text-transform: capitalize;}
    .timeline-step .step-date {margin-bottom: 16px;font-size: 15px;line-height: 20px;color: #000;}
    .timeline-step .step-detail {margin-bottom: 10px;color: #5f615e;font-size: 15px;line-height: 20px;}
    .timeline-step .step-detail span {color: #000;font-weight: 600;}
    .order_tabs_main nav {margin-bottom: 30px;}
    .timeline_content {text-align: left;}
    .timeline-step .icon_time i {color: #d5d5d5;}
    .order-item_detail .prd-info {display: flex;align-items: center;gap: 16px;padding-bottom: 32px;margin-bottom: 32px;border-bottom: 1px solid #ededed;}
    .order-item_detail .prd-price {display: grid;gap: 8px;padding-bottom: 32px;margin-bottom: 32px;border-bottom: 1px solid #ededed;}
    .order-item_detail .info_image {max-width: 90px;}
    .order-item_detail .info_image img {width: 100%;height: 100%;object-fit: cover;aspect-ratio: 1;}
    .order-item_detail .info_detail {display: grid;gap: 2px;}
    .info_detail a {-webkit-transition: all 0.3s ease;-moz-transition: all 0.3s ease;-ms-transition: all 0.3s ease;-o-transition: all 0.3s ease;transition: all 0.3s ease;font-size: 20px;line-height: 30px;color: #000;text-decoration: none;font-weight: 400;}
    .info_detail a:hover {color: #ba8342;}
    .order-item_detail .info-price, .order-item_detail .info-variant, .order-item_detail .price_total, .order-item_detail .price_dis, .order-item_detail .prd-order_total {display: flex;align-items: center;gap: 9px;color: #5f615e;font-size: 15px;margin: 0px;}
    .pri_txt_bold {color: #000;font-weight: 600;}
    .order-item_detail .price_total, .order-item_detail .price_dis, .order-item_detail .prd-order_total {justify-content: space-between;text-transform: capitalize;}
    .pri_bold {color: #000;font-weight: 600;}
    .order-receiver {display: grid;gap: 2px;}
    .order-receiver .recerver_text {display: flex;align-items: center;gap: 9px;font-size: 16px;line-height: 22px;color: #5f615e;}
    .order-receiver .text_info {font-weight: 600;color: #000;}

    @media (min-width: 1200px) and (max-width: 1500px) {
    .table-my_order th:last-child, .table-my_order td:last-child {width: 100px;}
    }
</style>
<div class="suryavanshi_my_account_main">
	<div class="container">
      <div class="row">
          @include("front.dashboard.sidebar")
          <div class="col-md-9">
              <div class="my-account-content">
                  <div class="acount-order_stats">
                      <div class="order-box">
                          <div class="order_icon">
                            <i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i>
                          </div>
                          <div class="order_info">
                            <p class="info_label">Total order</p>
                            <h2 class="info_count">{{ $orderDetails->count() }}</h2>
                          </div>
                      </div>
                  </div>

                  <div class="account-my_order">
                      <h2 class="account-title">Recent Orders</h2>
                      <div class="overflow-auto">
                          <table class="table-my_order order_recent">
                              <thead>
                                  <tr>
                                    <th>Order</th>
                                    <th>Products</th>
                                    <th>Pricing</th>
                                    <th>Status</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach($orderDetails as $order)
                                      @foreach($order->items as $product)
                                          <tr class="tb-order-item">
                                              <td class="tb-order_code">#{{ $order->order_number }}</td>
                                              <td>
                                                  <div class="tb-order_product">
                                                      <a href="@if(!empty($product->product->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $product->product->slug . '.html', 'sku' => $product->product->sku]) }}@endif" class="img-prd">
                                                          <img src="@if(!empty($product->product)){{ $product->product->images['first'] }}@endif" alt="img">
                                                      </a>
                                                      <div class="infor-prd">
                                                          <a href="@if(!empty($product->product->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $product->product->slug . '.html', 'sku' => $product->product->sku]) }}@endif" class="prd_name">@if(!empty($product->product)){{ $product->product->name }}@endif</a>
                                                          <p class="prd_select">Clothing <span>Size: XS</span></p>
                                                      </div>
                                                  </div>
                                              </td>
                                              <td class="tb-order_price">@if(!empty($product->product)){{ $product->selling_price }}@endif</td>
                                              <td>
                                                  @php 
                                                      if($product->status == 'pending'){
                                                          $html = '<div class="tb-order_status stt-pending">Pending</div>'; 
                                                      }
                                                      if($product->status == 'cancelled'){
                                                          $html = '<div class="tb-order_status stt-cancel">Canceled</div>'; 
                                                      }
                                                      if($product->status == 'delivered'){
                                                          $html = '<div class="tb-order_status stt-delivery">Delivery</div>'; 
                                                      }
                                                      if($product->status == 'shipped'){
                                                          $html = '<div class="tb-order_status stt-cancel">Shipped</div>';
                                                      }
                                                      if($product->status == 'confirmed'){
                                                          $html = '<div class="tb-order_status stt-complete">Completed</div>'; 
                                                      }
                                                      if($product->status == 'returned'){
                                                          $html = '<div class="tb-order_status stt-complete">Returned</div>'; 
                                                      }
                                                      if($product->status == 'out_for_delivery'){
                                                          $html = '<div class="tb-order_status stt-delivery">Out For Delivery</div>'; 
                                                      }
                                                  @endphp 
                                                  {!! $html !!}
                                              </td>
                                          </tr> 
                                      @endforeach               
                                  @endforeach              
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
	</div>
</div>

@endsection