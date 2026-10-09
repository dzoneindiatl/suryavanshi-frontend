@include('front.includes.head')
@include('front.includes.header')
<link rel="stylesheet" href="{{ asset('assets/css/magiczoomplus.css') }}">
<style>
/* ================================
   PRODUCT VARIANT WRAPPER
================================ */
.product_variants {
    width: 100%;
    margin-top: 15px;
}

.product-option {
    margin-bottom: 20px;
}

.option-title {
    margin-bottom: 10px;
}

.option-title h5 {
    font-size: 15px;
    font-weight: 600;
    margin: 0;
    color: #222;
}


/* ================================
   COMMON VARIANT
================================ */
.s-variant {
    cursor: pointer;
    transition: all 0.2s ease;
    user-select: none;
}

.s-variant:hover {
    opacity: 0.85;
}


/* ================================
   RADIO HIDE
================================ */
.attribute-input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}


/* ================================
   ROUND COLOR VARIANT
================================ */
.variant-round {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

.variant-round label {
    display: inline-flex;
    margin: 0;
}

.color-variant {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    border: 2px solid transparent;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    position: relative;
}


/* Active color */
.color-variant.active {
    border-color: #222;
    box-shadow: 0 0 0 2px #fff, 0 0 0 4px #222;
}


/* ================================
   NORMAL SIZE BOX
================================ */
.variant-box {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.variant-box label {
    margin: 0;
}

.variant-box .s-variant {
    min-width: 45px;
    height: 40px;
    padding: 0 14px;
    border: 1px solid #ddd;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    font-size: 14px;
    border-radius: 4px;
}

.variant-box .s-variant.active {
    border-color: #222;
    background: #222;
    color: #fff;
}


/* ================================
   IMAGE VARIANTS
================================ */
.variant-with-image,
.variant-box-image,
.variant-rectangle-image {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

.variant-with-image label,
.variant-box-image label,
.variant-rectangle-image label {
    margin: 0;
}

.variant-with-image .s-variant,
.variant-box-image .s-variant,
.variant-rectangle-image .s-variant {
    width: 65px;
    height: 65px;
    padding: 3px;
    border: 1px solid #ddd;
    border-radius: 6px;
    overflow: hidden;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
}

.variant-with-image .s-variant img,
.variant-box-image .s-variant img,
.variant-rectangle-image .s-variant img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.variant-with-image .s-variant.active,
.variant-box-image .s-variant.active,
.variant-rectangle-image .s-variant.active {
    border: 2px solid #222;
}


/* ================================
   RECTANGLE VARIANT
================================ */
.variant-rectangle {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.variant-rectangle label {
    margin: 0;
}

.variant-rectangle .s-variant {
    min-width: 70px;
    height: 42px;
    padding: 0 15px;
    border: 1px solid #ddd;
    background: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 3px;
}

.variant-rectangle .s-variant.active {
    background: #222;
    color: #fff;
    border-color: #222;
}


/* ================================
   COLOR BOX
================================ */
.variant-box-color,
.variant-rectangle-color {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.variant-box-color label,
.variant-rectangle-color label {
    margin: 0;
}

.variant-box-color .s-variant,
.variant-rectangle-color .s-variant {
    min-width: 60px;
    height: 40px;
    padding: 0 15px;
    border: 1px solid #ddd;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
}

.variant-box-color .s-variant.active,
.variant-rectangle-color .s-variant.active {
    border: 2px solid #222;
}


/* ================================
   MOBILE
================================ */
@media (max-width: 575px) {

    .variant-round,
    .variant-box,
    .variant-with-image,
    .variant-box-image,
    .variant-rectangle,
    .variant-box-color,
    .variant-rectangle-color {
        gap: 8px;
    }

    .color-variant {
        width: 32px;
        height: 32px;
    }

    .variant-with-image .s-variant,
    .variant-box-image .s-variant,
    .variant-rectangle-image .s-variant {
        width: 55px;
        height: 55px;
    }

    .variant-box .s-variant {
        min-width: 40px;
        height: 36px;
        padding: 0 10px;
        font-size: 13px;
    }
}
    .slideshow-items {width: 500px;}
    .slideshow-thumbnails {width: 100px;}
    #slideshow-items-container { display: inline-block; position: relative; }

    #lens { background-color: rgba( 233, 233, 233, 0.4 ) }
    #lens, #result { position: absolute; display: none; z-index: 1; }
    .slideshow-items { display: none; }
    .slideshow-items.active { display: block; }
    .slideshow-thumbnails { opacity: 0.5; }
    .slideshow-thumbnails.active { opacity: 1; }
    #lens, .slideshow-items, .slideshow-thumbnails, #result { border: 1px solid #222; }

    .product_detail_right h1 {font-size: 1.4rem;color: #4F3267;display: block;margin-bottom: 25px;}
    .single_product_price {font-size: 2rem;line-height: 20px;color: #4f3267;padding: 0px;font-weight: 600;}
    .offer_txt {font-size: 14px;color: #6f7377;padding: 4px 0 8px 0;}
    .customise_box {display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;width: 100%;margin-bottom: 25px;}
    .customise_box_left {display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;border: 1px solid #d59d5b;height: 56px;width: calc(100% - 120px);border-radius: 12px 0 0 12px;}
    .customise_box_left ul {list-style: none;padding: 0px;margin: 0px;display: flex;}
    .customise_box_left ul li {padding: 7px 15px 7px 15px;text-align: left;border-right: 1px solid #d59d5b;position: relative;width: 120px;display: flex;align-items: center;justify-content: space-between;}
    .customise_title {font-size: 13px;color: #4F3267;display: flex;align-items: center;justify-content: space-between;width: 100%;cursor: pointer;}
    .customise_value {font-size: 13px;padding-right: 5px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;color: #4F3267;margin: 0px;font-weight: 600;}
    .dropdown_text_customise {display: none;background: #fff;position: absolute;top: 55px;left: 0px;right: 0px;z-index: 1;padding: 5px;text-align: center;border-radius: 5px;box-shadow: 0px 5px 5px rgba(0,0,0,0.2);}
    .dropdown_text_customise.active {display: block;}
    .btn_customise {position: relative;outline: none;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;-webkit-tap-highlight-color: transparent;width: 100%;height: 56px;color: #fff;background: #d59d5b;padding: 0 14px;font-size: 15px;margin: 0;border: none;border-radius: 0 12px 12px 0;max-width: 120px;text-transform: uppercase;}
    .product_box_cart {display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;width: 100%;gap: 15px;}
    button.btn_add_to_cart {position: relative;outline: none;cursor: pointer;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;-webkit-tap-highlight-color: transparent;box-sizing: border-box;border: none;font-weight: 600;font-size: 16px;height: 44px;width: 156px;border-radius: 8px;background: linear-gradient(90deg,#E56EEB -13.59%,#8863FB 111.41%);color: #ffffff;padding: 0px 20px;margin: 0;}
    button.btn_add_to_cart span {position: relative;padding-left: 0;}
    /*button.btn_add_to_cart span::before {content: '';position: absolute;left: -1.3rem;top: 50%;-webkit-transform: translateY(-44%);-ms-transform: translateY(-44%);transform: translateY(-44%);background: url(image/pdp-firstfold-sprite.png) no-repeat;background-size: 280px auto;background-position: -221px -14px;width: 20px;height: 20px;display: block;}*/
    .product_share ul {display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;padding: 0 0 0 10px;margin: 0px;list-style: none;}
    .product_share ul li a {margin-right: 8px;width: 44px;height: 44px;border: 1px solid #4F3267;display: block;border-radius: 8px;background: #4F3267;padding: 12px 10px;}
    .heart_icon {background: url("{{ asset('assets/image/pdp-firstfold-sprite.png') }}") -96px -10px / 280px no-repeat;width: 22px;height: 18px;display: inline-block;cursor: pointer;filter: brightness(0) invert(1);}
    .product_share ul li:last-child a {margin-right: 0px;}
    .share_icon {background: url("{{ asset('assets/image/pdp-firstfold-sprite.png') }}") top left no-repeat;background-size: 280px auto;background-position: -131px -10px;width: 18px;height: 20px;display: inline-block;cursor: pointer;filter: brightness(0) invert(1);}
    .product_box_buy {display: flex;width: 100%;margin-bottom: 25px;gap: 10px;}
    p.price_breakup_txt {font-size: 15px;margin: 0px;}
    .price_breakup_txt::before {content: "+";color: rgb(79, 50, 103);font-size: 1.4rem;display: inline-block;left: 10px;top: 50%;transform: translateY(-50%);position: absolute;height: 5px;line-height: 4px;}
    .product_top_box {position: relative;}
    .product_share {position: absolute;top: -8px;right: 0px;}
    button.btn_buy_now {position: relative;outline: none;cursor: pointer;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;-webkit-tap-highlight-color: transparent;box-sizing: border-box;border: 1px solid #d16cee;font-weight: 600;font-size: 16px;height: 44px;width: 156px;border-radius: 8px;background: #fff;color: #d06cef;padding: 0px 20px;margin: 0;}
    button.btn_buy_now span {position: relative;padding-left: 0;}
    /*button.btn_buy_now span::before {content: '';position: absolute;left: -1.3rem;top: 50%;-webkit-transform: translateY(-44%);-ms-transform: translateY(-44%);transform: translateY(-44%);background: url(image/pdp-firstfold-sprite.png) no-repeat;background-size: 280px auto;background-position: -221px -14px;width: 20px;height: 20px;display: block;}*/
    .price_breakup_modal {position: fixed;top: 0px;left: 0px;width: 100%;height: 100%;z-index: 1001;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;display: none;}
    .price_breakup_modal.active {display: flex;}
    .price_breakup_modal_bg {position: fixed;top: 0px;left: 0px;margin-top: 0px;width: 100%;height: 100%;background-color: rgba(0, 0, 0, 0.7);animation-duration: 400ms;animation-fill-mode: both;animation-name: animation-1acbpvw;}

    @keyframes animation-1acbpvw {
        0% {
        opacity:0;
        }
        100% {
        opacity:1;
        }
    }

    @-webkit-keyframes animation-1acbpvw {
        0% {
        opacity:0;
        }
        100% {
        opacity:1;
        }
    }

    .price_breakup_modal_inner {background: white;max-width: 90%;overflow: hidden auto;z-index: 10001;transition: transform 0.3s linear;width: 550px;height: 100vh;max-height: 100%;right: 0px;position: absolute;border-radius: 12px 0px 0px 12px;animation-duration: 500ms;animation-fill-mode: both;animation-name: animation-3izfwu;}

    @keyframes animation-3izfwu {
        0% {
        -webkit-transform: translateX(100%);
        -ms-transform: translateX(100%);
        transform: translateX(100%);
        }
        100% {
        -webkit-transform: translateX(0);
        -ms-transform: translateX(0);
        transform: translateX(0);
        }
    }

    @-webkit-keyframes animation-3izfwu {
        0% {
        -webkit-transform: translateX(100%);
        -ms-transform: translateX(100%);
        transform: translateX(100%);
        }
        100% {
        -webkit-transform: translateX(0);
        -ms-transform: translateX(0);
        transform: translateX(0);
        }
    }

    .price_breakup_modal_head {display: flex;-webkit-box-pack: justify;justify-content: space-between;height: 90px;background: rgb(246, 243, 249); position: relative;padding: 44px 15px 16px 36px;z-index: 100;}
    .price_breakup_modal_head > p {font-size: 1.4rem;color: rgb(79, 50, 103);margin: 0px;}
    .price_breakup_modal_head > span {background: url("{{ asset('assets/image/pdp-firstfold-sprite.png') }}") -89px -52px / 280px no-repeat;display: inline-block;width: 24px;height: 24px;margin-top: 4px;cursor: pointer;position: absolute;right: 40px;top: 16px;}
    .price_breakup_modal_bottom {width: 100%;padding-top: 20px;}
    h3.gold_breakup_title {font-size: 14px;color: rgb(78, 85, 94);padding: 0px 20px 14px 40px;}
    .price_breakup_modal_bottom > ul {padding: 10px 36px;list-style: none;margin: 0px;display: flex;flex: 1 1 0%;text-transform: uppercase;}
    .price_breakup_modal_bottom > ul li {flex: 1 1 0%;font-size: 12px;color: rgb(79, 50, 103);line-height: 24px;}
    .price_breakup_modal_bottom > ul li .componet_head {font-size: 12px;color: rgb(136, 99, 251);}
    .anchor_wet {position: relative;vertical-align: middle;margin-left: 10px;display: inline-block;line-height: 20px;}
    .css-1e5ungy i {background: url("{{ asset('assets/image/pdp-firstfold-sprite.png') }}") -150px -51px / 280px;width: 16px;height: 16px;margin-top: 4px;display: inline-block;cursor: pointer;}
    .total_values {border-bottom: 1px solid rgb(233, 233, 233);}
    .total_values li span {font-weight: 600;}
    .product_details_main_page {padding-bottom: 50px;}
    .delivery_stores_box_inner {-webkit-align-items: center;-webkit-box-align: center;-ms-flex-align: center;align-items: center;width: 100%;position: relative;margin-top: 0px;margin-bottom: 0px;}
    .delivery_stores_txt {width: 100%;margin: 0px auto;max-height: 48px;display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;-webkit-align-items: center;-webkit-box-align: center;-ms-flex-align: center;align-items: center;font-size: 1.2rem;padding: 12px 12px 12px 10px;border: 1px solid #d59d5b;border-radius: 12px;}
    .delivery_stores_icon {background: url("{{ asset('assets/image/pdp-sprite.png') }}") top left no-repeat;background-size: 600px auto;background-position: -519px -53px;width: 16px;height: 16px;display: block;margin: 0 4px;}
    input.delivery_stores_input {width: 350px;height: 42px;line-height: 42px;margin: 0 4px;font-size: 14px;color: #4f3267;border: none;font-weight: 600;}
    input.delivery_stores_input::-webkit-input-placeholder {color: #4f3267;}
    input.delivery_stores_input::-moz-placeholder {color: #4f3267;}
    input.delivery_stores_input:-ms-input-placeholder {color: #4f3267;}
    input.delivery_stores_input:-moz-placeholder {color: #4f3267;}
    .btn_delivery_locate {height: 46px;line-height: 46px;cursor: pointer;background: #d59d5b;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;color: #fff;font-size: 15px;margin-right: -12px;font-weight: 600;border-radius: 0px 12px 12px 0px;text-align: right;-webkit-letter-spacing: 0.1px;-moz-letter-spacing: 0.1px;-ms-letter-spacing: 0.1px;letter-spacing: 0.1px;margin-left: auto;border: none;padding: 0px 15px;}
    .delivery_stores_box {padding-top: 40px;}
    .delivery_stores_box h3 {color: #4F3267;font-size: 20px;margin-bottom: 15px;}

    .product_offer_box {display: flex;position: relative;overflow: hidden;flex-flow: wrap;-webkit-box-align: center;align-items: center;font-size: 1.4rem;justify-content: space-around;}
    .product_offer_box_inner {position: relative;max-width: 50%;padding: 30px 0px 20px;}
    .product_offer_box_inner a {text-decoration: none;}
    .product_offer_icon_top {text-align: center;}
    .product_offer_icon {background: url("{{ asset('assets/image/cl-advantage-sprite.png') }}") -56px -10px / 200px no-repeat;width: 40px;height: 40px;display: inline-block;cursor: pointer;}
    .product_offer_txt_top {display: flex;flex-direction: column;flex: 0 0 65%;}
    .product_offer_txt {font-size: 12px;line-height: 16px;color: rgb(79, 50, 103);padding: 8px 0px;margin: 0px;max-width: 75px;font-weight: 600;text-align: center;}
    .product_offer_icon1 {background: url("{{ asset('assets/image/cl-advantage-sprite.png') }}") -9px -10px / 200px no-repeat;width: 40px;height: 40px;display: inline-block;cursor: pointer;}
    .product_offer_icon2 {background: url("{{ asset('assets/image/cl-advantage-sprite.png') }}") -99px -10px / 200px no-repeat;width: 40px;height: 40px;display: inline-block;cursor: pointer;}
    .product_offer_icon3 {background: url("{{ asset('assets/image/cl-advantage-sprite.png') }}") -145px -10px / 200px no-repeat;width: 40px;height: 40px;display: inline-block;cursor: pointer;}
    .tabs_product {display: -webkit-box;display: -ms-flexbox;display: flex;padding: 20px;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;-webkit-box-pack: center;-ms-flex-pack: center;justify-content: center;-webkit-box-align: start;-ms-flex-align: start;align-items: flex-start;-ms-flex-item-align: stretch;align-self: stretch;border-radius: 20px;background: #fbf3ea;-webkit-box-shadow: 0 24px 36px -20px rgba(0,0,0,0.08);box-shadow: 0 24px 36px -20px rgba(0,0,0,0.08);}
    .tabs_product ul.nav-tabs {width: 100%;border-bottom: 1px solid #f5c893;align-items: center;justify-content: center;}
    .tabs_product ul.nav-tabs .nav-link {border: none;color: #222;}
    .tabs_product ul.nav-tabs .nav-link.active, .tabs_product ul.nav-tabs .nav-link:focus {background: #c38235;color: #fff;}
    .pd-description {-ms-flex-item-align: stretch;align-self: stretch;color: #3c3c3c;font-size: 14px;font-style: normal;font-weight: 400;line-height: 150%;padding-top: 15px;text-align: justify;}
    .general-details {display: -webkit-box;display: -ms-flexbox;display: flex;padding: 14px 12px;-webkit-box-align: center;-ms-flex-align: center;align-items: center;gap: 8px;-ms-flex-item-align: stretch;align-self: stretch;border-radius: 10px;background: #fbe7ce;margin-bottom: 4px;font-weight: 600;margin-top: 15px;}
    .product-details-attributes .general-parent .general-desc:first-child {border-radius: 10px 10px 0 0;}
    .product-details-attributes .general-parent .general-desc:last-child {border-radius: 0 0 10px 10px;border: none;}
    .product-details-attributes .general-parent .general-desc {display: -webkit-box;display: -ms-flexbox;display: flex;padding: 16px 12px;-webkit-box-pack: justify;-ms-flex-pack: justify;justify-content: space-between;-webkit-box-align: center;-ms-flex-align: center;align-items: center;-ms-flex-item-align: stretch;align-self: stretch;background: #fbe7ce;border-bottom: 1px solid #c9adad;border-bottom-style: dashed;}
    .product-details-attributes .g-d {color: #212121;font-size: 14px;font-style: normal;font-weight: 400;line-height: 150%;}
    .breakup-custom-header {font-weight: 600 !important;margin-top: 15px;}
    .price-breakup-desktop img {margin-right: 4px;}
    .grand-cutom-total {border-radius: 10px !important;background: #e5c7a3 !important;display: -webkit-box;display: -ms-flexbox;display: flex;padding: 16px 12px;-webkit-box-pack: justify;-ms-flex-pack: justify;justify-content: space-between;-webkit-box-align: center;-ms-flex-align: center;align-items: center;-ms-flex-item-align: stretch;align-self: stretch;margin-top: 10px;}
    #myTabContent {width: 100%;}
    span.width {display: flex;gap: 5px;}
    .product-details-attributes .general-parent .general-desc.gst_last {border: none;border-radius: 0px 0px 10px 10px;}

    .selectors {margin-top: 10px;}
    .selectors a.mz-thumb {border: 1px solid #dadada;margin: 0px 4px;}
    .selectors a.mz-thumb img {width: 90px;height: 90px;object-fit: cover;padding: 0px;border: none;}
    .mz-hint {display: none;}
    a#mzCrA802756030200 {display: none !important;}
    /*.MagicZoom {width: 100%;}
    figure.mz-figure {width: 100%;}
    .MagicZoom .mz-figure img {max-width: 100% !important;max-height: 100% !important;}*/

    .product_rating_tab_top {background-color: #fbe7ce;border-radius: .625rem;margin-left: 0;margin-right: 0;padding: 0px;margin-top: 10px;}
    .bottom-line-items {display: grid;grid-template-columns: repeat(2, auto);grid-template-rows: repeat(2, 1fr);grid-template-areas: "rating stars" "rating reviews";grid-column-gap: .125rem;grid-row-gap: 0;-webkit-box-align: center;-ms-flex-align: center;align-items: center;width: 50%;padding: 1rem 0.5rem;border-right: 1px solid #f5c893;text-align: center;margin-bottom: 10px;}
    .rating-stars-container {height: 30px;line-height: 30px;vertical-align: middle;grid-area: stars;display: -webkit-box;display: -ms-flexbox;display: flex;gap: 5px;}
    .rating-stars-container .fa-star {height: 30px;line-height: 30px;vertical-align: middle;width: 22.7px;font-size: 22px;}
    .bottom-line-items .fa-star:before {background: -webkit-gradient(linear, left top, left bottom, from(#000), to(#000));background: linear-gradient(#000, #000);-webkit-background-clip: text;-webkit-text-fill-color: transparent;}
    .bottom-line-items .reviews-qa-labels-container {display: block;height: unset;grid-area: reviews;text-align: left;padding-left: .25rem;position: relative;top: -0.4rem;line-height: 34px;vertical-align: middle;}
    .bottom-line-items-container .reviews-qa-labels-container .reviews-qa-label {font-weight: normal;font-style: normal;font-stretch: normal;letter-spacing: normal;color: #6A6C77;font-size: 14px;line-height: 1.47;}
    .write-question-review-buttons-container {position: relative;top: -5rem;width: 50%;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-pack: center;-ms-flex-pack: center;justify-content: center;float: right;padding-right: 10px !important;}
    .write-question-review-buttons-container button.write-question-review-button {background-color: #fff !important;border-radius: 18.75rem;border: none;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-pack: center;-ms-flex-pack: center;justify-content: center;-webkit-box-align: center;-ms-flex-align: center;align-items: center;gap: 0.3rem;height: 35px;padding: 8px 11px !important;}
    .write-question-review-buttons-container button.write-question-review-button .write-question-review-button-text {color: #a16218;font-size: 14px;font-weight: 600;}

    .product_rating_tab_bottom {background: #fbe7ce;border-radius: .625rem;padding: 1rem 0;}
    .first-review {margin-top: 50px;position: relative;}
    .first-review .first-review-stars {margin-bottom: 20px;text-align: center;margin-top: 20px;}
    .first-review .first-review-stars .fa {font-size: 22px;}
    .first-review .first-review-stars .fa:before {background: linear-gradient(28deg, #ff9a00 28%, #fff281 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;}
    .first-review-content {text-align: center;}
    .first-review-content button.write-review-button {background-color: #bb8442;border-radius: 18.75rem;border: none;color: #fff;height: auto;margin: 0px;text-transform: uppercase;text-align: center;font-size: 12px;padding: 10px 15px;display: inline-block;text-overflow: ellipsis;}

    .related_products, .similar_products {padding-bottom: 50px;}
    .related_products_head {margin-bottom: 20px;}
    .related_products_head h2 {font-size: 25px;margin: 0px;}
    .related_product_inner .collection_inner_box, .similar_product_inner .collection_inner_box {margin-right: 10px;margin-left: 10px;}
    .quantity-option h5{ font-size:18px; color:#38271e; font-weight: 500;}
    .quantity {width:140px; height:40px; border:1px solid #E7DDD4; border-radius:1rem; display:flex; overflow:hidden; background:#fff;}
    .quantity button{ width:40px; border:none; background:none; cursor:pointer; font-size:22px; transition:.3s;}
    .quantity button:hover{ background:#F2D7D5;}
    .quantity input{ flex:1; border:none; outline:none; text-align:center; font-size:18px; background:none; width: 100%;}
</style>
<div class="breadcrumb_main">
	<div class="container">
		<div class="breadcrumb_inner">
			<ul>
				<li class="first"><a href="{{ url('/') }}" title="Home"><span>HOME</span></a></li>
				@if($productcat)<li><a href="{{ route('category.show',['path'=>$productcat->slug]) }}" title="{{ $productcat->name }}"><span>{{ ucfirst($productcat->name) }}</span></a></li>@endif 
                @if($productSubCat)<li><a href="{{ route('category.show',['path'=>$productcat->slug.'/'.$productSubCat->slug]) }}" title="{{ $productSubCat->name }}"><span>{{ ucfirst($productSubCat->name) }}</span></a></li> @endif 
                @if($productChildCat)<li><a href="{{ route('category.show',['path'=>$productcat->slug.'/'.$productSubCat->slug.'/'.$productChildCat->slug]) }}" title="{{ $productChildCat->name }}"><span>{{ ucfirst($productChildCat->name) }}</span></a></li> @endif 
			</ul>
		</div>
	</div>
</div>
<div id="flash-msg" class="alert alert-info d-none"></div>
<div class="product_details_main_page">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<div class="app-figure" id="zoom-fig">
					@php
					$primaryVariantId = \App\Models\ProductVariantValue::where('product_id', $product->id)
						->where('is_main', 1)
						->value('variant_value_id');

					$allProductImages = $product->product_main_images
						->where('variant_id', $primaryVariantId)
						->values();

					$sortedProductImages = $allProductImages->sortByDesc(function ($img) {
						return (int) $img->is_front;
					})->values();

					$firstImage = $sortedProductImages->first();
					$firstImageUrl = $firstImage
						? asset('uploads/products/' . $firstImage->graphic)
						: $product->images['first'];
				@endphp

				<a id="Zoom-1"
				class="MagicZoom"
				href="{{ $firstImageUrl }}"
				data-zoom-image-2x="{{ $firstImageUrl }}"
				data-image-2x="{{ $firstImageUrl }}">
					<img src="{{ $firstImageUrl }}"
						alt="{{ $product->name }}" class="default-image"/>
				</a>

				<div class="selectors" id="productImageSelectors">
					@foreach($sortedProductImages as $img)
						@php
							$imageUrl = asset('uploads/products/' . $img->graphic);
						@endphp

						<a data-zoom-id="Zoom-1"
						href="{{ $imageUrl }}"
						data-image="{{ $imageUrl }}"
						data-zoom-image-2x="{{ $imageUrl }}"
						data-image-2x="{{ $imageUrl }}">
							<img src="{{ $imageUrl }}"
								alt="{{ $product->name }}" class="default-image"/>
						</a>
					@endforeach
				</div>
			</div>
			</div>
			<div class="col-md-5">
				<div class="product_detail_right">
					<h1>{{ $product->name }}</h1>
					<div class="product_top_box">
						<span class="single_product_price">₹{{ $product->selling_price }}</span>
						<div class="product_share">
							<ul>
								<li>
									<a href="#"><span class="heart_icon addtoWishList"></span></a>
								</li>
								<li>
									<a href="#"><span class="share_icon"></span></a>
								</li>
							</ul>
						</div>
					</div>
					 @php
                    if ($product->product_type == 1) {
                        $firstImage = getActiveFrontImg($product->id, $product->id);
                        $secondImage = getActiveBackImg($product->id, $product->id);
                    } else {
                        $activeVarientId = activeVarientByProductId($product->id);
                        $firstImage = getActiveFrontImg($product->id, $activeVarientId);
                        $secondImage = getActiveBackImg($product->id, $activeVarientId);
                    }
                                    
                    if ($product->product_type == 2) {
                        $priceData = getPriceByActiveVarientId($product->id, $activeVarientId);
                        $buying_price = $priceData['buying_price'];
                        $selling_price = $priceData['selling_price'];
                        $discount_product = $buying_price - $selling_price;
                        $productImages = getActiveVarientImg($product->id, $activeVarientId);
                    } else {
                        $buying_price = $product->buying_price;
                        $selling_price = $product->selling_price;
                        $discount_product = $buying_price - $selling_price;
                        $productImages = getActiveVarientImg($product->id, $product->id);
                    }
                                    
                    $discountText = '';
                                    
                    if (!empty($product->discount) && !empty($product->discount_type)) {
                        if ($product->discount_type == 'percentage') {
                            $discountText = $product->discount . '% Off';
                        }
                        if ($product->discount_type == 'flat') {
                            $discountText = '₹' . $product->discount . 'Off';
                        }
                    }
                                    
                @endphp
					<p class="offer_txt">(MRP Inclusive of all taxes)</p>
					<div class="product_variants">
						@if (!empty($productvariants))
                            @foreach ($productvariants as $variant)
                                @php
                                    $variantValues = $variant['variant_values'] ?? [];
                                    $hasMain = collect($variantValues)->where('is_main', 1)->isNotEmpty();
                                    $displayType = (int) ($variant['variant_type'] ?? 0);
                                @endphp

                                @if (count($variantValues))
                                    <div class="product-option">
                                        <div class="option-title">
                                            <h5>{{ $variant['variant_name'] }}</h5>
                                        </div>

                                        {{-- TYPE 1 : ONLY ROUND --}}
                                        @if ($displayType === 1)
                                            <div class="colors variant-round">
                                                @foreach ($variantValues as $k => $variantValue)
                                                    @php
                                                        $isActive = ($hasMain && (int) $variantValue['is_main'] === 1) || (!$hasMain && $k === 0);
                                                        $colorCode = $variantValue['color_code'] ?? '#ddd';
                                                    @endphp

                                                    <label>
                                                        <input
                                                            type="radio"
                                                            name="variant_{{ $variant['variant_id'] ?? $variant['variant_name'] }}"
                                                            value="{{ $variantValue['variant_value_id'] }}"
                                                            class="attribute-input"
                                                            {{ $isActive ? 'checked' : '' }}>

                                                        <span
                                                            class="s-variant color-variant {{ $isActive ? 'active' : '' }}"
                                                            style="background: {{ $colorCode }};"
                                                            data-product-id="{{ $variant['product_id'] ?? $product->id }}"
                                                            data-id="{{ $variantValue['id'] }}"
                                                            data-variant-id="{{ $variant['variant_id'] ?? '' }}"
                                                            data-type="{{ $variant['variant_name'] }}"
                                                            data-value="{{ $variantValue['name'] }}"
                                                            data-vid="{{ $variantValue['variant_value_id'] }}"
                                                            data-value-id="{{ $variantValue['variant_value_id'] }}"
                                                            title="{{ $variantValue['name'] }}"
                                                            onclick="selectVariant(this);checkVariantStock(this);">
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        @elseif ($displayType === 2)
                                            <div class="sizes variant-box">
                                                @foreach ($variantValues as $k => $variantValue)
                                                    @php
                                                        $isActive = ($hasMain && (int) $variantValue['is_main'] === 1) || (!$hasMain && $k === 0);
                                                    @endphp

                                                    <label>
                                                        <input
                                                            type="radio"
                                                            name="variant_{{ $variant['variant_id'] ?? $variant['variant_name'] }}"
                                                            value="{{ $variantValue['variant_value_id'] }}"
                                                            class="attribute-input"
                                                            {{ $isActive ? 'checked' : '' }}>

                                                        <span
                                                            class="s-variant {{ $isActive ? 'active' : '' }}"
                                                            data-product-id="{{ $variant['product_id'] ?? $product->id }}"
                                                            data-id="{{ $variantValue['id'] }}"
                                                            data-variant-id="{{ $variant['variant_id'] ?? '' }}"
                                                            data-type="{{ $variant['variant_name'] }}"
                                                            data-value="{{ $variantValue['name'] }}"
                                                            data-vid="{{ $variantValue['variant_value_id'] }}"
                                                            data-value-id="{{ $variantValue['variant_value_id'] }}"
                                                            onclick="selectVariant(this);checkVariantStock(this);">
                                                            {{ $variantValue['name'] }}
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        {{-- TYPE 3 : ROUND WITH IMAGE --}}
                                        @elseif ($displayType === 3)
                                            <div class="colors variant-round variant-with-image">
                                                @foreach ($variantValues as $k => $variantValue)
                                                    @php
                                                        $isActive = ($hasMain && (int) $variantValue['is_main'] === 1) || (!$hasMain && $k === 0);
                                                        $image = $variantValue['image'] ?? null;
                                                    @endphp

                                                    <label>
                                                        <input
                                                            type="radio"
                                                            name="variant_{{ $variant['variant_id'] ?? $variant['variant_name'] }}"
                                                            value="{{ $variantValue['variant_value_id'] }}"
                                                            class="attribute-input"
                                                            {{ $isActive ? 'checked' : '' }}>

                                                        <span
                                                            class="s-variant {{ $isActive ? 'active' : '' }}"
                                                            data-product-id="{{ $variant['product_id'] ?? $product->id }}"
                                                            data-id="{{ $variantValue['id'] }}"
                                                            data-variant-id="{{ $variant['variant_id'] ?? '' }}"
                                                            data-type="{{ $variant['variant_name'] }}"
                                                            data-value="{{ $variantValue['name'] }}"
                                                            data-vid="{{ $variantValue['variant_value_id'] }}"
                                                            data-value-id="{{ $variantValue['variant_value_id'] }}"
                                                            onclick="selectVariant(this);checkVariantStock(this);">

                                                            @if ($image)
                                                                <img src="{{ asset('uploads/products/' . $image) }}" alt="{{ $variantValue['name'] }}">
                                                            @else
                                                                {{ $variantValue['name'] }}
                                                            @endif
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        {{-- TYPE 4 : ROUND WITH COLOR --}}
                                        @elseif ($displayType === 4)
                                            <div class="colors variant-round">
                                                @foreach ($variantValues as $k => $variantValue)
                                                    @php
                                                        $isActive = ($hasMain && (int) $variantValue['is_main'] === 1) || (!$hasMain && $k === 0);
                                                        $colorCode = $variantValue['color_code'] ?? '#ddd';
                                                    @endphp

                                                    <label>
                                                        <input
                                                            type="radio"
                                                            name="variant_{{ $variant['variant_id'] ?? $variant['variant_name'] }}"
                                                            value="{{ $variantValue['variant_value_id'] }}"
                                                            class="attribute-input"
                                                            {{ $isActive ? 'checked' : '' }}>

                                                        <span
                                                            class="s-variant color-variant {{ $isActive ? 'active' : '' }}"
                                                            style="background: {{ $colorCode }};"
                                                            data-product-id="{{ $variant['product_id'] ?? $product->id }}"
                                                            data-id="{{ $variantValue['id'] }}"
                                                            data-variant-id="{{ $variant['variant_id'] ?? '' }}"
                                                            data-type="{{ $variant['variant_name'] }}"
                                                            data-value="{{ $variantValue['name'] }}"
                                                            data-vid="{{ $variantValue['variant_value_id'] }}"
                                                            data-value-id="{{ $variantValue['variant_value_id'] }}"
                                                            title="{{ $variantValue['name'] }}"
                                                            onclick="selectVariant(this);checkVariantStock(this);">
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        {{-- TYPE 5 : BOX WITH COLOR --}}
                                        @elseif ($displayType === 5)
                                            <div class="sizes variant-box-color">
                                                @foreach ($variantValues as $k => $variantValue)
                                                    @php
                                                        $isActive = ($hasMain && (int) $variantValue['is_main'] === 1) || (!$hasMain && $k === 0);
                                                        $colorCode = $variantValue['color_code'] ?? '#ddd';
                                                    @endphp

                                                    <label>
                                                        <input
                                                            type="radio"
                                                            name="variant_{{ $variant['variant_id'] ?? $variant['variant_name'] }}"
                                                            value="{{ $variantValue['variant_value_id'] }}"
                                                            class="attribute-input"
                                                            {{ $isActive ? 'checked' : '' }}>

                                                        <span
                                                            class="s-variant {{ $isActive ? 'active' : '' }}"
                                                            style="background: {{ $colorCode }};"
                                                            data-product-id="{{ $variant['product_id'] ?? $product->id }}"
                                                            data-id="{{ $variantValue['id'] }}"
                                                            data-variant-id="{{ $variant['variant_id'] ?? '' }}"
                                                            data-type="{{ $variant['variant_name'] }}"
                                                            data-value="{{ $variantValue['name'] }}"
                                                            data-vid="{{ $variantValue['variant_value_id'] }}"
                                                            data-value-id="{{ $variantValue['variant_value_id'] }}"
                                                            onclick="selectVariant(this);checkVariantStock(this);">
                                                            {{ $variantValue['name'] }}
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        {{-- TYPE 6 : BOX WITH IMAGE --}}
                                        @elseif ($displayType === 6)
                                            <div class="sizes variant-box-image">
                                                @foreach ($variantValues as $k => $variantValue)
                                                    @php
                                                        $isActive = ($hasMain && (int) $variantValue['is_main'] === 1) || (!$hasMain && $k === 0);
                                                        $image = $variantValue['image'] ?? null;
                                                    @endphp

                                                    <label>
                                                        <input
                                                            type="radio"
                                                            name="variant_{{ $variant['variant_id'] ?? $variant['variant_name'] }}"
                                                            value="{{ $variantValue['variant_value_id'] }}"
                                                            class="attribute-input"
                                                            {{ $isActive ? 'checked' : '' }}>

                                                        <span
                                                            class="s-variant {{ $isActive ? 'active' : '' }}"
                                                            data-product-id="{{ $variant['product_id'] ?? $product->id }}"
                                                            data-id="{{ $variantValue['id'] }}"
                                                            data-variant-id="{{ $variant['variant_id'] ?? '' }}"
                                                            data-type="{{ $variant['variant_name'] }}"
                                                            data-value="{{ $variantValue['name'] }}"
                                                            data-vid="{{ $variantValue['variant_value_id'] }}"
                                                            data-value-id="{{ $variantValue['variant_value_id'] }}"
                                                            onclick="selectVariant(this);checkVariantStock(this);">

                                                            @if ($image)
                                                                <img src="{{ asset('uploads/products/' . $image) }}" alt="{{ $variantValue['name'] }}">
                                                            @else
                                                                {{ $variantValue['name'] }}
                                                            @endif
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        {{-- TYPE 7 : ONLY RECTANGLE --}}
                                        @elseif ($displayType === 7)
                                            <div class="sizes variant-rectangle">
                                                @foreach ($variantValues as $k => $variantValue)
                                                    @php
                                                        $isActive = ($hasMain && (int) $variantValue['is_main'] === 1) || (!$hasMain && $k === 0);
                                                    @endphp

                                                    <label>
                                                        <input
                                                            type="radio"
                                                            name="variant_{{ $variant['variant_id'] ?? $variant['variant_name'] }}"
                                                            value="{{ $variantValue['variant_value_id'] }}"
                                                            class="attribute-input"
                                                            {{ $isActive ? 'checked' : '' }}>

                                                        <span
                                                            class="s-variant {{ $isActive ? 'active' : '' }}"
                                                            data-product-id="{{ $variant['product_id'] ?? $product->id }}"
                                                            data-id="{{ $variantValue['id'] }}"
                                                            data-variant-id="{{ $variant['variant_id'] ?? '' }}"
                                                            data-type="{{ $variant['variant_name'] }}"
                                                            data-value="{{ $variantValue['name'] }}"
                                                            data-vid="{{ $variantValue['variant_value_id'] }}"
                                                            data-value-id="{{ $variantValue['variant_value_id'] }}"
                                                            onclick="selectVariant(this);checkVariantStock(this);">
                                                            {{ $variantValue['name'] }}
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        {{-- TYPE 8 : RECTANGLE WITH IMAGE --}}
                                        @elseif ($displayType === 8)
                                            <div class="sizes variant-rectangle-image">
                                                @foreach ($variantValues as $k => $variantValue)
                                                    @php
                                                        $isActive = ($hasMain && (int) $variantValue['is_main'] === 1) || (!$hasMain && $k === 0);
                                                        $image = $variantValue['image'] ?? null;
                                                    @endphp

                                                    <label>
                                                        <input
                                                            type="radio"
                                                            name="variant_{{ $variant['variant_id'] ?? $variant['variant_name'] }}"
                                                            value="{{ $variantValue['variant_value_id'] }}"
                                                            class="attribute-input"
                                                            {{ $isActive ? 'checked' : '' }}>

                                                        <span
                                                            class="s-variant {{ $isActive ? 'active' : '' }}"
                                                            data-product-id="{{ $variant['product_id'] ?? $product->id }}"
                                                            data-id="{{ $variantValue['id'] }}"
                                                            data-variant-id="{{ $variant['variant_id'] ?? '' }}"
                                                            data-type="{{ $variant['variant_name'] }}"
                                                            data-value="{{ $variantValue['name'] }}"
                                                            data-vid="{{ $variantValue['variant_value_id'] }}"
                                                            data-value-id="{{ $variantValue['variant_value_id'] }}"
                                                            onclick="selectVariant(this);checkVariantStock(this);">

                                                            @if ($image)
                                                                <img src="{{ asset('uploads/products/' . $image) }}" alt="{{ $variantValue['name'] }}">
                                                            @else
                                                                {{ $variantValue['name'] }}
                                                            @endif
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        {{-- TYPE 9 : RECTANGLE WITH COLOR --}}
                                        @elseif ($displayType === 9)
                                            <div class="sizes variant-rectangle-color">
                                                @foreach ($variantValues as $k => $variantValue)
                                                    @php
                                                        $isActive = ($hasMain && (int) $variantValue['is_main'] === 1) || (!$hasMain && $k === 0);
                                                        $colorCode = $variantValue['color_code'] ?? '#ddd';
                                                    @endphp

                                                    <label>
                                                        <input
                                                            type="radio"
                                                            name="variant_{{ $variant['variant_id'] ?? $variant['variant_name'] }}"
                                                            value="{{ $variantValue['variant_value_id'] }}"
                                                            class="attribute-input"
                                                            {{ $isActive ? 'checked' : '' }}>

                                                        <span
                                                            class="s-variant {{ $isActive ? 'active' : '' }}"
                                                            style="background: {{ $colorCode }};"
                                                            data-product-id="{{ $variant['product_id'] ?? $product->id }}"
                                                            data-id="{{ $variantValue['id'] }}"
                                                            data-variant-id="{{ $variant['variant_id'] ?? '' }}"
                                                            data-type="{{ $variant['variant_name'] }}"
                                                            data-value="{{ $variantValue['name'] }}"
                                                            data-vid="{{ $variantValue['variant_value_id'] }}"
                                                            data-value-id="{{ $variantValue['variant_value_id'] }}"
                                                            onclick="selectVariant(this);checkVariantStock(this);">
                                                            {{ $variantValue['name'] }}
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        @endif
					</div>
                    <div class="product-option quantity-option">
                        <h5 class="mb-10">
                            Quantity
                        </h5>

                        <div class="quantity" data-max-quantity="{{ $product->qty }}">
                            <button class="minus">-</button>
                            <input type="text" value="1" id="quantity">
                            <button class="plus">+</button>
                        </div>
                    </div>
					
                    <div class="product_box_cart">
						<button class="btn_add_to_cart addToCartBtn addToCartBtnText"
							data-id="{{ $product->id }}"
							data-name="{{ $product->name }}"
							data-producttype="{{ $product->product_type }}"
							data-sku="{{ $product->sku }}"
							data-slug="{{ $product->slug }}"
							data-price="{{ $buying_price }}"
							data-salePrice="{{ $selling_price }}"
							data-discountType="{{ $product->discount_type }}"
							data-discount="{{ $discount_product }}"
							data-tax-arr="{{ e(json_encode($categoryTaxes)) }}"><span>ADD TO CART</span>
						</button>

						<button class="btn_buy_now buyNowBtn" 
							data-id="{{ $product->id }}"
							data-name="{{ $product->name }}"
							data-producttype="{{ $product->product_type }}"
							data-sku="{{ $product->sku }}"
							data-slug="{{ $product->slug }}"
							data-price="{{ $buying_price }}"
							data-salePrice="{{ $selling_price }}"
							data-discountType="{{ $product->discount_type }}"
							data-discount="{{ $discount_product }}"
							data-tax-arr="{{ e(json_encode($categoryTaxes)) }}"><span>BUY NOW</span>
						</button>
					</div>

					<div class="price_breakup_modal" id="price_breakup_modal">
						<div class="price_breakup_modal_bg"></div>
						<div class="price_breakup_modal_inner">
							<div class="price_breakup_modal_head" id="price_breakup_modal_head"><p>Ring1</p><span></span></div>
							<div class="price_breakup_modal_bottom">
								<h3 class="gold_breakup_title">GOLD PRICE BREAKUP</h3>
								<ul class="price_componet">
									<li>
										<span class="componet_head">Component</span>
									</li>
									<li>
										<span class="componet_head">Rate</span>
									</li>
									<li>
										<span class="componet_head">Weight</span>
									</li>
									<li>
										<span class="componet_head">Final Value</span>
									</li>
								</ul>
								<ul>
									<li>
										<span>18 KT Yellow Gold</span>
									</li>
									<li>
										<span>₹7,743 </span> / g
									</li>
									<li>
										<span>3.800 g<a class="anchor_wet"><i></i></a></span>
									</li>
									<li>
										<span>₹29,423 </span>
									</li>
								</ul>
								<ul class="total_values">
									<li>
										<span>Total Gold Value</span>
									</li>
									<li>
										<span>-</span>
									</li>
									<li>
										<span>-</span>
									</li>
									<li>
										<span>₹29,423</span>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="delivery_stores_box">
						<h3>Delivery, Stores &amp; Trial</h3>
						<div class="delivery_stores_box_inner">
							<div class="delivery_stores_txt">
								<span class="delivery_stores_icon"></span>
								<input type="text" name="location" placeholder="Enter Pincode" border="none" maxlength="6" value="" locatemelength="9" class="delivery_stores_input">
								<button class="btn_delivery_locate">Locate Me</button>
							</div>
						</div>
					</div>

					<div class="product_offer_box">
						<div class="product_offer_box_inner">
							<a href="#" target="_blank">
								<div class="product_offer_icon_top">
									<span width="40px" height="40px" class="product_offer_icon"></span>
								</div>
								<div class="product_offer_txt_top">
									<h3 class="product_offer_txt">100% Certified</h3>
								</div>
							</a>
						</div>
						<div class="product_offer_box_inner">
							<a href="#" target="_blank">
								<div class="product_offer_icon_top">
									<span width="40px" height="40px" class="product_offer_icon1"></span>
								</div>
								<div class="product_offer_txt_top">
									<h3 class="product_offer_txt">15 Day Money-Back</h3>
								</div>
							</a>
						</div>
						<div class="product_offer_box_inner">
							<a href="#" target="_blank">
								<div class="product_offer_icon_top">
									<span width="40px" height="40px" class="product_offer_icon2"></span>
								</div>
								<div class="product_offer_txt_top">
									<h3 class="product_offer_txt">Lifetime Exchange</h3>
								</div>
							</a>
						</div>
						<div class="product_offer_box_inner">
							<a href="#" target="_blank">
								<div class="product_offer_icon_top">
									<span width="40px" height="40px" class="product_offer_icon3"></span>
								</div>
								<div class="product_offer_txt_top">
									<h3 class="product_offer_txt">One Year Warranty</h3>
								</div>
							</a>
						</div>
					</div>

					<div class="tabs_product">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
						  <li class="nav-item" role="presentation">
						    <button class="nav-link active" id="product-tab" data-bs-toggle="tab" data-bs-target="#product-tab-pane" type="button" role="tab" aria-controls="product-tab-pane" aria-selected="true">Product Details</button>
						  </li>
						  <li class="nav-item" role="presentation">
						    <button class="nav-link" id="price-tab" data-bs-toggle="tab" data-bs-target="#price-tab-pane" type="button" role="tab" aria-controls="price-tab-pane" aria-selected="false">Price Breakup</button>
						  </li>
						  <li class="nav-item" role="presentation">
						    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-tab-pane" type="button" role="tab" aria-controls="reviews-tab-pane" aria-selected="false">Reviews</button>
						  </li>
						</ul>
						<div class="tab-content" id="myTabContent">
						  <div class="tab-pane fade show active" id="product-tab-pane" role="tabpanel" aria-labelledby="product-tab" tabindex="0">
						  	<div class="pd-description">The dual bands elegantly crafted in 18K rose gold create a harmonious balance of modernity and classic charm. The rich rosy tones of the gold complement the deep velvety colour of the Iolite resulting in a piece that captivates with every glance.</div>
						  	<div class="product-details-attributes">
						  		<div class="general-details">
						  			<img src="image/general-mob.svg" alt="Order">General
    							</div>
    							<div class="general-parent">
    								<div class="general-desc">
                			<p class="g-d mb-0">
                    		<span class="width">Design Code</span>
                    	</p>
                			<p class="g-d text-uppercase mb-0 pd-design">4922fmy</p>
            				</div>
            				<div class="general-desc">
                			<p class="g-d mb-0">
                    		<span class="width">Gross Weight</span>
                    	</p>
                			<p class="g-d mb-0">1.99g</p>
            				</div>
        						<div class="general-desc">
                			<p class="g-d mb-0">
                    		<span class="width">Style</span>
                    	</p>
                			<p class="g-d mb-0">Minimal</p>
            				</div>
            			</div>
						  	</div>
						  </div>
						  <div class="tab-pane fade" id="price-tab-pane" role="tabpanel" aria-labelledby="price-tab" tabindex="0">
						  	<div class="product-details-attributes">
							  	<div class="general-details breakup-custom-header total-custom-value">
							  		<p class="g-d mb-0">
	            				<span class="width"><img src="image/gold-icon.svg" class="" alt="Order">Total Gold Value</span>
	            			</p>
	        					<p class="g-d mb-0 custom-total-value">₹ 15101.93</p>
	    						</div>
	    						<div class="general-parent">
	    							<div class="general-desc">
                			<p class="g-d mb-0">
                    		<span class="width">Weight</span>
                    	</p>
                			<p class="g-d text-uppercase mb-0 pd-design">1.972g</p>
            				</div>
            				<div class="general-desc">
                			<p class="g-d mb-0">
                    		<span class="width">Rate</span>
                    	</p>
                			<p class="g-d text-uppercase mb-0 pd-design">₹ 7658.18/g</p>
            				</div>
	    						</div>
	    						<div class="general-details breakup-custom-header total-custom-value">
							  		<p class="g-d mb-0">
	            				<span class="width"><img src="image/gemstone-icon.svg" class="" alt="Order">Stone Detail</span>
	            			</p>
	        					<p class="g-d mb-0 custom-total-value">₹ 171</p>
	    						</div>
	    						<div class="general-parent">
	    							<div class="general-desc">
                			<p class="g-d mb-0">
                    		<span class="width">Count</span>
                    	</p>
                			<p class="g-d text-uppercase mb-0 pd-design">1</p>
            				</div>
            				<div class="general-desc">
                			<p class="g-d mb-0">
                    		<span class="width">Weight</span>
                    	</p>
                			<p class="g-d text-uppercase mb-0 pd-design">0.018 g</p>
            				</div>
            				<div class="general-desc">
                			<p class="g-d mb-0">
                    		<span class="width">Making Charges</span>
                    	</p>
                			<p class="g-d text-uppercase mb-0 pd-design">₹ 2742.00</p>
            				</div>
            				<div class="general-desc">
                			<p class="g-d mb-0">
                    		<span class="width">Gross Weight</span>
                    	</p>
                			<p class="g-d text-uppercase mb-0 pd-design">1.99g</p>
            				</div>
            				<div class="general-desc gst_last">
                			<p class="g-d mb-0">
                    		<span class="width">GST</span>
                    	</p>
                			<p class="g-d text-uppercase mb-0 pd-design">₹ 540.45</p>
            				</div>
            				<div class="g-description1 grand-cutom-total total-custom-value">
        							<p class="g-d mb-0">
            						<span class="width">Grand Total</span>
            					</p>
        							<p class="g-d mb-0">₹ 18555</p>
    								</div>
	    						</div>
	  						</div>
						  </div>
						  <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab" tabindex="0">
						  	<div class="product_rating_tab">
						  		<div class="product_rating_tab_top">
						  			<div class="bottom-line-items">
						  				<span class="rating-stars-container">
						  					<span class="fa fa-star"></span>
						  					<span class="fa fa-star"></span>
						  					<span class="fa fa-star"></span>
						  					<span class="fa fa-star"></span>
						  					<span class="fa fa-star"></span>
						  				</span>
						  				<span class="reviews-qa-labels-container">
						  					<span class="reviews-qa-label">0 Reviews</span>
						  				</span>
						  			</div>
						  			<div class="write-question-review-buttons-container">
						  				<button type="button" class="yotpo-default-button yotpo-icon-btn write-question-review-button write-button write-review-button" role="tab" aria-expanded="false">
						  					<img src="image/download.png" alt="img">
						  					<span class="write-question-review-button-text font-color-gray-darker">Write A Review</span>
						  				</button>
						  			</div>
						  		</div>
						  		<div class="product_rating_tab_bottom">
						  			<div class="first-review">
						  				<div class="first-review-stars">
						  					<span class="stars-wrapper">
						  						<span class="fa fa-star"></span>
						  						<span class="fa fa-star"></span>
						  						<span class="fa fa-star"></span>
						  						<span class="fa fa-star"></span>
						  						<span class="fa fa-star"></span>
						  					</span>
						  				</div>
						  				<div class="first-review-content">
						  					<button type="button" class="write-review-button">be the first to write a review</button>
						  				</div>
						  			</div>
						  		</div>
						  	</div>
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@if(count($similarProducts) > 0)
	<div class="similar_products">
		<div class="container">
			<div class="related_products_head">
				<h2>Similar Products</h2>
			</div>
			<div class="similar_product_inner">
				@foreach($similarProducts as $similar)
					<div class="collection_inner_box">
						<div class="collection_inner_box_img">
							<div class="shop_img_hover">
								<img class="normal_img_shop" src="{{ $similar->images['first'] }}" alt="img">
								<img class="hover_img_shop" src="{{ $similar->images['second'] }}" alt="img">
							</div>
							<div class="collection_inner_box_icon">
								<a href="#">
									<i class="fa fa-heart-o addtoWishList"></i>
								</a>
							</div>
							@if($similar->best_seller == 1)
								<div class="collection_best_seller">
									<a href="@if(!empty($similar->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $similar->slug . '.html', 'sku' => $similar->sku]) }}@endif"">Best Seller</a>
								</div>
							@endif
							<a href="@if(!empty($similar->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $similar->slug . '.html', 'sku' => $similar->sku]) }}@endif"" class="btn_cart_add">Add To Cart</a>
						</div>
						<div class="collection_inner_box_txt">
							<div class="price">
								<span class="price_new">₹ {{ $similar->buying_price }}</span>
								<span class="price_new_cut">₹ {{ $similar->selling_price }}</span>
								@php 
									if(!empty($similar->discount) && !empty($similar->discount_type)){
										if($similar->discount_type == 'percentage'){
											$discountText = $similar->discount." % OFF"; 
										}else{
											$discountText = '₹ '.$similar->discount.' OFF'; 
										}
									}	
								@endphp
								@if(!empty($discountText))	
									<div class="offer_txt1">{{ $discountText }}</div>
								@endif 	
							</div>
							<h5>{{ $similar->name }}</h5>
						</div>
					</div>
				@endforeach 		
			</div>
		</div>
	</div>
@endif 	

@if(count($relatedProducts) > 0)	
	<div class="related_products">
		<div class="container">
			<div class="related_products_head">
				<h2>Related Products</h2>
			</div>
			<div class="related_product_inner">
				@foreach($relatedProducts as $related)
					<div class="collection_inner_box">
						<div class="collection_inner_box_img">
							<div class="shop_img_hover">
								<img class="normal_img_shop" src="{{ $related->images['first'] }}" alt="img">
								<img class="hover_img_shop" src="{{ $related->images['second'] }}" alt="img">
							</div>
							<div class="collection_inner_box_icon">
								<a href="#">
									<i class="fa fa-heart-o addtoWishList"></i>
								</a>
							</div>
							@if($related->best_seller == 1)
								<div class="collection_best_seller">
									<a href="@if(!empty($related->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $related->slug . '.html', 'sku' => $related->sku]) }}@endif">Best Seller</a>
								</div>
							@endif 
							<a href="@if(!empty($related->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $related->slug . '.html', 'sku' => $related->sku]) }}@endif" class="btn_cart_add">Add To Cart</a>
						</div>
						<div class="collection_inner_box_txt">
							<div class="price">
								<span class="price_new">₹{{ $related->buying_price }}</span>
								<span class="price_new_cut">₹{{ $related->selling_price }}</span>
								@php 
									if(!empty($related->discount) && !empty($related->discount_type)){
										if($related->discount_type == 'percentage'){
											$discountText = $related->discount." % OFF"; 
										}else{
											$discountText = '₹ '.$related->discount.' OFF'; 
										}
									}	
									@endphp
								@if(!empty($discountText))		
									<div class="offer_txt1">
									{{ $discountText }}
									</div>
								@endif 
							</div>
							<h5>{{ $related->name }}</h5>
						</div>
					</div>
				@endforeach  		
			</div>
		</div>
	</div>
@endif 	


@if(count($recentlyViewedProducts) > 0)	
	<div class="related_products">
		<div class="container">
			<div class="related_products_head">
				<h2>Recent Viewed Products</h2>
			</div>
			<div class="related_product_inner">
				@foreach($recentlyViewedProducts as $recent)
					<div class="collection_inner_box">
						<div class="collection_inner_box_img">
							<div class="shop_img_hover">
								{{-- <img class="normal_img_shop" src="{{ $recent->images['first'] }}" alt="img">
								<img class="hover_img_shop" src="{{ $recent->images['second'] }}" alt="img"> --}}
							</div>
							<div class="collection_inner_box_icon">
								<a href="#">
									<i class="fa fa-heart-o addtoWishList"></i>
								</a>
							</div>
							@if($recent->best_seller == 1)
								<div class="collection_best_seller">
									<a href="@if(!empty($recent->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $recent->slug . '.html', 'sku' => $recent->sku]) }}@endif">Best Seller</a>
								</div>
							@endif 
							<a href="@if(!empty($recent->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $recent->slug . '.html', 'sku' => $recent->sku]) }}@endif" class="btn_cart_add">Add To Cart</a>
						</div>
						<div class="collection_inner_box_txt">
							<div class="price">
								<span class="price_new">₹{{ $recent->buying_price }}</span>
								<span class="price_new_cut">₹{{ $recent->selling_price }}</span>
								@php 
									if(!empty($recent->discount) && !empty($recent->discount_type)){
										if($recent->discount_type == 'percentage'){
											$discountText = $recent->discount." % OFF"; 
										}else{
											$discountText = '₹ '.$recent->discount.' OFF'; 
										}
									}	
									@endphp
								@if(!empty($discountText))		
									<div class="offer_txt1">
									{{ $discountText }}
									</div>
								@endif 
							</div>
							<h5>{{ $recent->name }}</h5>
						</div>
					</div>
				@endforeach  		
			</div>
		</div>
	</div>
@endif 

<div class="footer_main">
	<div class="container">
		<div class="row footer_main_inner">
			<div class="col-md-3">
				<h2>Our Collections</h2>
				<ul>
				<li><a href="#">Gold</a></li>
				<li><a href="#">Silver </a></li>
				<li><a href="#">Men's Wear </a></li>
				<li><a href="#">Womens Wear</a></li>
				</ul>
			</div>
			<div class="col-md-3">
				<h2>Customer Service</h2>
				<ul>
				<li><a href="#">Return Policy</a></li>
				<li><a href="#">Order Status</a></li>
				<li><a href="#">Commitment</a></li>
				</ul>
			</div>
			<div class="col-md-2">
				<h2>About Us</h2>
				<ul>
				<li><a href="#">Our Story</a></li>
				<li><a href="#">Terms &amp; Conditions</a></li>
				<li><a href="#">Privacy Policy</a></li>
				<li><a href="#">Contact Us</a></li>
				<li><a href="#">Blog</a></li>
				</ul>
			</div>
			<div class="col-md-4">
				<div class="addrGrp">
				<h2>Office Address</h2>
				<p>SB-155 A, Gandhi Nagar Mode, Main Tonk Road, Jaipur-302015, Rajasthan, INDIA</p>
				</div>
				<div class="addrGrp">
				<h2>Contact Us</h2>
				<p>+918302581569, +919636714869</p>
				<p>info@jaipurJewelleryhouse.net</p>
				</div>
			</div>
  		</div>
	</div>
</div>

<div class="copyright_txt">
    <div class="container">
        <p>Copyright @ 2026. jaipur Jewellery House All rights reserved. Developed &amp; Designed by <a href="#" target="_blank">Dzone India</a></p>
    </div>
</div>

<div class="footer_bottom_sec">
	<div class="container">
		<h2><span style="font-size:18px"><strong>jaipur Jewellery House: A Timeless Treasure</strong></span></h2>
		<p><span style="font-size:18px">People worldwide have always loved gold jewellery. It is a form of personal expression and a symbol of elegance and status; it can be traditional or contemporary. We will cover topics related to gold jewellery, ways to buy it online, current designs, and ways to choose appropriate gold jewellery for yourself or someone else.</span></p>
		<h2><span style="font-size:18px"><strong>The Allure of Gold Jewellery</strong></span></h2>
		<p><span style="font-size:18px"><strong>Why Choose Gold?</strong></span></p>
		<p><span style="font-size:18px">For centuries, gold has been valued for its beauty and its strength. Gold doesn’t tarnish or corrode like other metals; therefore, it is an investment you can enjoy long-term. Furthermore, you can wear gold jewellery for all occasions, whether it’s for a casual occasion or a more formal event.</span></p>
		<h2><span style="font-size:18px"><strong>Types of Gold Jewellery</strong></span></h2>
		<p><span style="font-size:18px">Gold jewellery can be made in different forms, including necklaces, earrings, bracelets, rings and a variety of other options. Each piece can be constructed to fit different hobbies and styles. Here are a few common types of gold jewellery:</span></p>
		<p><span style="font-size:18px"><strong>Necklaces:</strong> Ranging from plain chains to major statement pieces, gold necklaces can elevate any look.</span></p>
		<p><span style="font-size:18px"><strong>Earrings:</strong> Gold earrings come in many variations - from stud to hoop to chandelier to ld to diamond. They are the accessory that accentuates any occasion.</span></p>
		<p><span style="font-size:18px"><strong>Bracelets:</strong> Gold bracelets work equally well as a stand-alone piece, or they can be stacked with other jewellery pieces. Great investment for a lot of use with a trendy look.</span></p>
		<p><span style="font-size:18px"><strong>Rings</strong>: Simple band, Ornate styles, gold rings are a classic accessory for everyday and special occasions.</span></p>
		<h2><span style="font-size:18px"><strong>Buying Gold Jewellery Online</strong></span></h2>
		<p><span style="font-size:18px">Nowadays, with the rise of the digital world, most people buy gold jewellery online. Buying jewellery online enables the convenience of online shopping with access to a wider variety and possibly better prices than the traditional in-person shopping experience. Below are some tips to keep in mind while buying gold jewellery online:</span></p>
		<h3><span style="font-size:18px"><strong>Research Reputable Retailers: </strong></span></h3>
		<p><span style="font-size:18px">Find a well-known online jewellery retailer that has positive reviews, so you can reasonably trust that they are selling real gold jewellery.</span></p>
		<h3><span style="font-size:18px"><strong>Hallmark Gold: </strong></span></h3>

		<p><span style="font-size:18px">Hallmarking gold certifies the purity of the gold. By looking for hallmark gold when buying jewellery online, you can reasonably trust that you are getting genuine gold.</span></p>

		<h3><span style="font-size:18px"><strong>Explore the Collection: </strong></span></h3>

		<p><span style="font-size:18px">Many online retailers have huge collections of jewellery in gold. You may want to take your time to look at various designs and styles when considering your purchase.</span></p>

		<h3><span style="font-size:18px"><strong>Product Detail: </strong></span></h3>

		<p><span style="font-size:18px">The product details should provide information about the karat value, weight and any specifications of the design.</span></p>

		<p><span style="font-size:18px"><strong>Return Policy: </strong></span></p>

		<p><span style="font-size:18px">Before you buy from the online retailer, check the return policy so that you can feel comfortable about making a purchase and potentially returning the item if the purchase does not meet your expectations.</span></p>

		<h2><span style="font-size:18px"><strong>Latest Gold Jewellery Designs:</strong></span></h2>

		<h2><span style="font-size:18px"><strong>Trends in Gold Jewellery:</strong></span></h2>

		<p><span style="font-size:18px">The framework of gold jewellery design changes rapidly with fresh styles emerging throughout the year. Here are some of the current trends in gold jewellery that you will soon be seeing.</span></p>

		<p><span style="font-size:18px">Minimalist Designs: Elegant and minimalist gold jewellery is growing in popularity. Minimalist gold jewellery can easily be worn daily and can be worn with virtually any outfit.</span></p>

		<p><span style="font-size:18px">Layering: Stacking rings, bracelets, and necklaces is one of the trendy, fun ways to achieve a unique and individualised look. The art of mixing and matching different gold items for ladies creates layering depth, yet can still enhance a style.</span></p>

		<p><span style="font-size:18px">Designs Inspired by Nature: Floral and natural-themed jewellery designs are making a comeback. These pieces often showcase fine detail and are perfect for someone who loves nature. Geometric Shapes: Bold geometric designs are becoming more prevalent in gold jewellery. These modern pieces can modernise your collection.</span></p>

		<h2><span style="font-size:18px"><strong>Gold Accessories for Women</strong></span></h2>

		<p><span style="font-size:18px">Gold accessories for women can elevate any outfit. Here are some must-have gold items for ladies:</span></p>

		<p><span style="font-size:18px"><strong>Gold Hoops:</strong> A classic choice, gold hoop earrings can be worn with casual or formal attire.<br>
			<strong>Gold Chains:</strong> A simple <a href="#">gold chain for men</a> can be a versatile addition to your jewellery collection. It can be worn alone or adorned with a pendant.<br>
			<strong>Gold Bangles:</strong> Stacking gold bangles can create a beautiful and eye-catching look.<br>
			<strong>Gold Statement Rings:</strong> A bold gold ring can serve as a conversation starter and add flair to your outfit.</span>
		</p>

		<h3><span style="font-size:18px"><strong>Tips for Choosing the Right Pieces</strong></span></h3>

		<p><span style="font-size:18px">When building your gold jewellery collection, consider the following tips:</span></p>

		<p><span style="font-size:18px"><strong>Know Your Style: </strong>Understand your style and preferences. This will help you choose pieces that you will love and wear often.</span></p>

		<p><span style="font-size:18px"><strong>Invest in Classics:</strong> Classic gold jewellery pieces, such as stud earrings and simple necklaces, are timeless.</span></p>

		<h2><span style="font-size:18px"><strong>Silver jewellery&nbsp;Kada for Men &amp; Silver Jewellery</strong></span></h2>

		<p><span style="font-size:18px">Check out our exclusive selection of <strong>silver kada for men, </strong>handcrafted with care and tradition. Our stylish and well-made silver kada design for men means your style can embrace tradition and modernity. Whatever your look and whatever the occasion or personality, you can elevate it with premium quality kada for men.</span></p>

		<h2><span style="font-size:18px"><strong>Elegant Silver Payal Designs</strong></span></h2>

		<p><span style="font-size:18px">Step gracefully with our unique silver payal design collection, offering beautiful patterns and craftsmanship to accentuate your feet during weddings, festivals, and daily wear.</span></p>

		<h2><span style="font-size:18px"><strong>Tradition Meets Style – Pathani Suits</strong></span></h2>

		<p><span style="font-size:18px">Our curated collection of pathani suits for men conveys an aura of comfort mixed with class, perfect for ethnic celebrations or formal occasions. Likewise, ladies have stylish options to consider with our women's pathani suit and ladies' pathani suit collections, which aim to deliver elegance while making sure to stay within the bounds of tradition.</span></p>

		<h2><span style="font-size:18px"><strong>Complete Your Look with Mojari for Men</strong></span></h2>

		<p><span style="font-size:18px">Pair your outfit with our classic mojari for men footwear, crafted to perfection for cultural authenticity and supreme comfort.</span></p>

		<h2><strong><span style="font-size:18px">Spiritual &amp; Traditional Gold Accessories</span></strong></h2>

		<p><span style="font-size:18px"><strong>Golden &amp; Navratna Yantras:&nbsp;</strong>Enrich your spiritual journey with our intricate golden navratna yantra and navratna yantra designs that symbolise prosperity and protection.</span></p>

		<p><span style="font-size:18px"><strong>Gold Baju Band Designs:&nbsp;</strong>Our elegant baju band design gold accessories add a regal touch to your traditional wear, perfect for ceremonies and festive occasions.</span></p>

		<h2><span style="font-size:18px"><strong>Graceful Jewellery Sets for Sarees</strong></span></h2>

		<p><span style="font-size:18px">Enhance your saree ensembles with our simple jewellery set for saree, crafted with a delicate blend of minimalism and tradition for everyday and special events.</span></p>

		<p><span style="font-size:18px"><strong>Why Choose jaipur Jewellery House?</strong></span></p>

		<p><span style="font-size:18px">Authentic craftsmanship blending tradition with modern style.<br>
			High-quality materials, including sterling silver and 22K gold plating.<br>
			Wide range of products from jewellery to ethnic apparel.<br>
			Customer satisfaction with timely delivery and reliable service.</span>
		</p>
	</div>
</div>

<script>
	window.csrfToken = "{{ csrf_token() }}";
    var addToWish = "{{ route('front-addwish') }}";
    const isLoggedIn = "{{ Auth::guard('customer')->check() ? true : false }}";
   	var addToCart = "{{ route('user.addToCart') }}";
    var getCouponUrl = "{{ route('get.coupon') }}";
    var wishlistUrl = "{{ route('front-user.wishlist') }}";
    var viewCartUrl = "{{ route('product.viewBag') }}";
    var headerSearchUrl = "{{ route('front-header-product-search') }}"; 
    var newBuyNowUrl = "{{ route('product.buynow') }}"; 
</script>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.3.15/slick.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
<script src="{{ asset('assets/js/magiczoomplus.js') }}"></script>
<script src="{{ asset('assets/js/cart.js') }}"></script>
@php
    $minSellingQty = 1;
    $maxSellingQty = 10;
@endphp
<script>
  $(document).on('ready', function () {
    AOS.init({
		  duration: 1200,
		})
  });
</script>
<script>
	$(document).ready(function(){
	  	$('.related_product_inner').slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			arrows: false,
			dots: false,
			speed: 300,
			infinite: true,
			autoplaySpeed: 5000,
			autoplay: true
	  	});
	});
</script>
<script>
	$('.buyNowBtn').on('click', function(){
		let button = $(this);
		let productId = button.data('id');
		let price = button.data('price');
		let salePrice = button.data('saleprice');
        let selectedVariant = getSelectedVariantsForBuyNow();  
		$.ajax({
			url:newBuyNowUrl,
			type:"POST",
			data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
				product_id: productId,
				price: price,
				sale_price: salePrice,
				quantity: 1,
                selectedVariant:selectedVariant
			},
			success: function(response){
				if(response.success){
					if(isLoggedIn){
						window.location.href = response.redirect_url;
					}else{
						window.location.href = "{{ route('front-user.login') }}";
					}
				}
			},
			error: function(xhr){
				console.log(xhr.responseText);
			}
		});
	});

    function getSelectedVariantsForBuyNow() {
        let selected = {};
        $('.s-variant.active[data-type]').each(function() {
            const $variant = $(this);
            const type = String($variant.attr('data-type') || '').toLowerCase();
            const value = String($variant.attr('data-value') || '');

            if (type && value) {
                selected[type] = value;
            }
        });
        console.log('Selected Variants: data====', selected);
        return selected; 
    }
</script>
<script>
	$(document).ready(function(){
	  	$('.similar_product_inner').slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			arrows: false,
			dots: false,
			speed: 300,
			infinite: true,
			autoplaySpeed: 5000,
			autoplay: true
	  	});
	});
</script>
<script>
    var minSellingQty = '{{ $minSellingQty }}';
    var maxSellingQty = '{{ $maxSellingQty }}';
    var getVarient = "{{ route('variant.combination.prices') }}";
		console.log("=======getVariant===========",getVarient); 
    $(document).on('click', '.customise_title', function(e) {
        e.preventDefault();

        let $title = $(this);
        let $dropdown = $title.next('.dropdown_text_customise');
        let $icon = $title.find('i');

        $dropdown.stop(true, true).slideToggle(300);

        $icon.toggleClass('fa-plus fa-minus');
    });
    $('.plus').on('click', function () {
        let quantityBox = $(this).closest('.quantity');
        let input = quantityBox.find('input');
        let maxQuantity = parseInt(quantityBox.data('max-quantity')) || 1;
        let value = parseInt(input.val()) || 1;

        if (value < maxQuantity) {
            input.val(value + 1);
        }
    });

    $('.minus').on('click', function () {
        let input = $(this).siblings('input');
        let value = parseInt(input.val()) || 1;

        if (value > 1) {
            input.val(value - 1);
        }
    });

    function checkItemInCart() {
		const productId = String($('#product_id').val() || '');
		const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
		const selected = getSelectedVariants([], false);
		const exists = cartItems.some(function(item) {
			if (String(item.productId) !== productId) {
				return false;
			}

			const variant = item.selectedVariants || {};
			const selectedKeys = Object.keys(selected);
			const variantKeys = Object.keys(variant);

			if (selectedKeys.length !== variantKeys.length) {
				return false;
			}

			return selectedKeys.every(function(key) {
				return String(variant[key]) === String(selected[key]);
			});
		});

		$('.addToCartText').html(exists ? 'Go To Cart' : 'Add To Cart');

		return exists;
	}
        
    function selectVariant(el) {
            const productId = el.dataset.productId;
            const variantId = el.dataset.variantId;
            const variantValueId = el.dataset.vid;
            const value = el.dataset.value;
            const valueId = el.dataset.id;
            const type = (el.dataset.type || '').toLowerCase();

            console.log('Selected variant:', {
                productId,
                variantId,
                variantValueId,
                valueId,
                type,
                value
            });

            $('.s-variant[data-variant-id="' + variantId + '"]').removeClass('active');
            $(el).addClass('active');

            $('input.attribute-input[name="variant_' + variantId + '"]').prop('checked', false);
            $('input.attribute-input[name="variant_' + variantId + '"][value="' + variantValueId + '"]').prop('checked', true);

            const selectedSpan = document.getElementById('selected-value-' + valueId);

            if (selectedSpan) {
                selectedSpan.textContent = value;
            }

            const selectedVariantIds = $('.s-variant.active').map(function() {
                return $(this).data('vid');
            }).get();

            console.log('Selected Variant IDs:', selectedVariantIds);

            checkItemInCart();

            $.ajax({
                url: getVarient,
                type: 'POST',
                data: JSON.stringify({
                    product_id: productId,
                    vsku: selectedVariantIds,
                    variant_id: variantId,
                    _token: window.csrfToken
                }),
                contentType: 'application/json',
                success: function(response) {
                    const combination = response?.combination;
                    if (!combination) return;

                    const {
                        selling_price,
                        price,
                        sku,
                        discount,
                        discount_type,
                        qty
                    } = combination;

                    const buyingPrice = Number(price) || 0;
                    const sellingPrice = Number(selling_price) || 0;

                    $('#productSku').html(sku || '');
                    $('#productPrice').text(`₹${Math.floor(sellingPrice)}`);
                    $('#pdpStrikedMrp').text(`₹${Math.floor(buyingPrice)}`);

                    const discountProduct = buyingPrice - sellingPrice;

                    $('#discountShow').text(
                        `₹ ${Math.max(Math.floor(discountProduct), 0)} OFF`
                    );

                    const $addToCartBtn = $('.addToCartBtn');

                    $addToCartBtn.attr('data-price', buyingPrice);
                    $addToCartBtn.attr('data-saleprice', sellingPrice);
                    $addToCartBtn.attr('data-discounttype', discount_type);
                    $addToCartBtn.attr('data-discount', discount);

                    const stockQty = parseInt(qty || 0);
                    const minimumQty = parseInt(minSellingQty || 1);

                    if (stockQty <= 0) {
                        $('.varient_less_than_min_qty_notice').html('Out Of Stock');
                        $('.add-to-cart').addClass('d-none disabled-action');
                    } else if (minimumQty > stockQty) {
                        $('.varient_less_than_min_qty_notice')
                            .html('<b>Only ' + stockQty + ' items are left</b>');
                        $('.add-to-cart').removeClass('d-none disabled-action');
                    } else {
                        $('.varient_less_than_min_qty_notice').html('');
                        $('.add-to-cart').removeClass('d-none');
                    }
                },
                error: function(xhr) {
                    console.error('Variant fetch error:', xhr.responseText);
                }
            });

            if (type === 'gemstone name' || type == 'gemstone name') {
                updateVariantImages(productId, variantValueId);
            }
        }
    
	$(document).ready(function () {
		const $activeVariant = $('.s-variant.active').first();
			console.log("===========active variant=================",$activeVariant); 
		if ($activeVariant.length) {
			const type = ($activeVariant.data('type') || '').toLowerCase();
			const productId = $activeVariant.data('product-id'); 
			const variantValueId = $activeVariant.data('vid');
			console.log('Initial active variant:', {
				type: type,
				variantValueId: variantValueId
			});
			if (
				type === 'color' ||
				type === 'colour'
			) {
				updateVariantImages(productId,variantValueId);
			}
		}
	});
	function updateVariantImages(productId, variantValueId) {
        console.log('Changing color image:', {
            productId: productId,
            variantValueId: variantValueId
        });
    
        $.ajax({
            url: "{{ route('front-product-variant-image') }}",
            type: "GET",
            data: {
                product_id: productId,
                variant_value_id: variantValueId
            },
            success: function(response) {
    
                console.log('Variant Images Response:', response);
    
                if (!response.images || response.images.length === 0) {
                    console.log('No images found for this variant');
                    return;
                }
    
                const firstImage = response.images[0];
    
                console.log('First Variant Image:', firstImage);
    
                /*
                |--------------------------------------------------------------------------
                | MAIN IMAGE
                |--------------------------------------------------------------------------
                */
    
                const zoomLink = document.getElementById('Zoom-1');
    
                if (zoomLink) {
    
                    zoomLink.setAttribute('href', firstImage);
                    zoomLink.setAttribute('data-zoom-image-2x', firstImage);
                    zoomLink.setAttribute('data-image-2x', firstImage);
    
                    const zoomImg = zoomLink.querySelector('img');
    
                    if (zoomImg) {
                        zoomImg.setAttribute('src', firstImage);
                        zoomImg.removeAttribute('srcset');
                    }
                }
    
                /*
                |--------------------------------------------------------------------------
                | THUMBNAILS
                |--------------------------------------------------------------------------
                */
    
                let html = '';
    
                response.images.forEach(function(image, index) {
    
                    html += `
                        <a data-zoom-id="Zoom-1"
                           href="${image}"
                           data-image="${image}"
                           data-zoom-image-2x="${image}"
                           data-image-2x="${image}">
    
                            <img src="${image}"
                                 alt=""
                                 class="default-image">
                        </a>
                    `;
                });
    
                $('#productImageSelectors').html(html);
    
                if (typeof MagicZoom !== 'undefined') {
    
                    try {
                        MagicZoom.refresh('Zoom-1');
                    } catch (e) {
                        console.log('MagicZoom refresh error:', e);
    
                        try {
                            MagicZoom.refresh();
                        } catch (e2) {
                            console.log('MagicZoom general refresh error:', e2);
                        }
                    }
                }

                setTimeout(function() {
                    const zoomLinkAfterRefresh = document.getElementById('Zoom-1');
                    if (!zoomLinkAfterRefresh) {
                        return;
                    }
                    zoomLinkAfterRefresh.setAttribute('href', firstImage);
                    zoomLinkAfterRefresh.setAttribute('data-image', firstImage);
                    zoomLinkAfterRefresh.setAttribute('data-zoom-image-2x', firstImage);
                    zoomLinkAfterRefresh.setAttribute('data-image-2x', firstImage);
    
                    const imgAfterRefresh =
                        zoomLinkAfterRefresh.querySelector('img');
    
                    if (imgAfterRefresh) {
                        imgAfterRefresh.setAttribute('src', firstImage);
                        imgAfterRefresh.removeAttribute('srcset');
                    }
    
                    console.log('Main image forced:', firstImage);
    
                }, 100);
    
            },
    
            error: function(xhr) {
                console.log('Variant image error:', xhr.responseText);
            }
        });
    }
	
    function checkVariantStock(el) {
		const productId = el.dataset.productId || $('#product_id').val();
		const variantId = el.dataset.variantId;
		const variantValueId = el.dataset.variantValueId;

		console.log('Checking variant stock:', {
			productId: productId,
			variantId: variantId,
			variantValueId: variantValueId
		});

		$.ajax({

			url: "{{ route('variant.stock.check') }}",

			type: "POST",

			data: {
				_token: "{{ csrf_token() }}",
				product_id: productId,
				variant_id: variantId,
				variant_value_id: variantValueId
			},

			success: function(res) {
				console.log('Variant stock response:', res);
				const productOut = $('#variantOutOfStock').data('product-out');

				if (productOut == 1) {
					$('#variantOutOfStock').removeClass('d-none');
					$('.add-to-cart').addClass('disabled-action');
					return;
				}
				$('.s-variant').removeClass('out-of-stock');
				if (res.out_of_stock) {
					$(el).addClass('out-of-stock');
					$('#variantOutOfStock').removeClass('d-none');
					$('.add-to-cart').addClass('disabled-action');
				} else {
					$('#variantOutOfStock').addClass('d-none');
					$('.add-to-cart').removeClass('disabled-action');
				}
			},

			error: function(xhr) {
				console.error('Variant stock check error:',xhr.responseText);
			}
		});
	}
	
	function showFlashMessage(msg, type = 'success') {
        const flash = document.getElementById('flash-msg');
        if (!flash) {
            console.warn('Flash message element not found.');
            return;
        }
        const icons = {
            success: '<i class="fas fa-check-circle"></i>',
            error: '<i class="fas fa-times-circle"></i>',
            warning: '<i class="fas fa-exclamation-circle"></i>',
            info: '<i class="fas fa-info-circle"></i>'
        };

        const alertTypes = {
            success: 'alert-success',
            error: 'alert-danger',
            warning: 'alert-warning',
            info: 'alert-info'
        };

        const icon = icons[type] || icons.info;
        const alertClass = alertTypes[type] || alertTypes.info;

        flash.classList.remove(
            'd-none',
            'alert-success',
            'alert-danger',
            'alert-warning',
            'alert-info'
        );

        flash.classList.add(alertClass);

        flash.innerHTML = `${icon} <span>${msg}</span>`;

        clearTimeout(window.flashMessageTimer);

        window.flashMessageTimer = setTimeout(function() {
            flash.classList.add('d-none');
        }, 3000);
    }

	$(document).off('click', '.addtoWishList').on('click', '.addtoWishList', function () {
        const productId = this.getAttribute('data-product-id');
        const heartIcon = this.querySelector('i');
    
        if (!isLoggedIn) {
            window.location.href = '/login';
            return;
        }
        
        fetch(addToWish, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => {
            if (!response.ok) throw new Error("Something went wrong");
            return response.json();
        })
        .then(data => { 
            if (data.status === 'added') {
                showFlashMessage("Product added in wishlist");
                heartIcon.classList.remove('fa-regular');
                heartIcon.classList.add('fa-solid');
            } else if (data.status === 'removed') {
                showFlashMessage("Product remove in wishlist", "warning");
                heartIcon.classList.remove('fa-solid');
                heartIcon.classList.add('fa-regular');
            }
            localStorage.setItem('wishlistCount', JSON.stringify(data.wishlistCount));
            displayWishlistItem();
        })
        .catch(error => {
            console.error("Wishlist error:", error);
        });
    });
</script>
<script>
  jQuery(document).on('ready', function () {
    AOS.init({
		  duration: 1200,
		})
  });
</script>


<script>
	$(document).ready(function(){
	  	$('.search-label-animation').slick({
			slidesToShow: 1,
			autoplay: true,
			speed: 1000,
			arrows: false,
			dots: false,
			// vertical: true,
				// verticalSwiping: true
	  	});
	});
</script>

<script>
	$(document).ready(function(){
	  	$('.influencers_slide_inner').slick({
			slidesToShow: 1,
			autoplay: true,
			arrows: false,
			dots: true,
			speed: 1000,
	  	});
	});
</script>

<script>
	$(document).ready(function(){
	  $('.best_seller_item').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			centerMode: true,
			arrows: false,
			dots: false,
			speed: 300,
			centerPadding: '15px',
			infinite: true,
			autoplaySpeed: 5000,
			autoplay: true
		});
	});
</script>

<script>
	$(document).ready(function(){
	  	$('.middle_sell_item_img').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			dots: true,
			speed: 300,
			infinite: true,
			autoplaySpeed: 5000,
			autoplay: true
	  	});
	});
</script>

<script>
	$(document).ready(function(){
	  $('.related_product_inner').slick({
	  		slidesToShow: 4,
			slidesToScroll: 1,
			arrows: false,
			dots: false,
			speed: 300,
			infinite: true,
			autoplaySpeed: 5000,
			autoplay: true
	  	});
	});
</script>

<script>
	$(document).ready(function(){
	  	$('.similar_product_inner').slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			arrows: false,
			dots: false,
			speed: 300,
			infinite: true,
			autoplaySpeed: 5000,
			autoplay: true
	  	});
	});
</script>

<script>
	$(window).scroll(function(){
  		var sticky = $('.main_header_top'),
    	scroll = $(window).scrollTop();

  		if (scroll >= 50) sticky.addClass('header_fixed');
  		else sticky.removeClass('header_fixed');
	});
</script>

<script>


$.getDocHeight = function(){
  return Math.max(
      $(document).height(),
      $(window).height(),
      document.documentElement.clientHeight
  );
};

$.getScrollPercentage = function(){
  return 100 * Math.min(
    ($(window).height() + $(window).scrollTop()) / $.getDocHeight(),
    $(window).scrollTop()
    );
};

</script>


<script>
$(function() {
  
  var html = $('html');
  	if (!("ontouchstart" in window)) {
    	html.addClass("noTouch");
  	}
  	if ("ontouchstart" in window) {
   		html.addClass("isTouch");
  	}
  	if ("ontouchstart" in window) {
    	html.addClass("isTouch");
  	}
  	if (document.documentMode || /Edge/.test(navigator.userAgent)) {
    	if (navigator.appVersion.indexOf("Trident") === -1) {
      		html.addClass("isEDGE");
    	} else {
      		html.addClass("isIE isIE11");
    	}
  	}
  	if (navigator.appVersion.indexOf("MSIE") !== -1) {
    	html.addClass("isIE");
  	}
  	if (navigator.userAgent.indexOf("Safari") != -1 && navigator.userAgent.indexOf("Chrome") == -1) {
    	html.addClass("isSafari");
  	}

  // On Screen

  $.fn.isOnScreen = function() {
    	var elementTop = $(this).offset().top,
      	elementBottom = elementTop + $(this).outerHeight(),
      	viewportTop = $(window).scrollTop(),
      	viewportBottom = viewportTop + $(window).height();
    	return elementBottom > viewportTop && elementTop < viewportBottom;
  	};

  	function detection() {
    	for (var i = 0; i < items.length; i++) {
      		var el = $(items[i]);

      		if (el.isOnScreen()) {
        		el.addClass("in-view");
      		} else {
        		el.removeClass("in-view");
      		}
    	}
  	}

  var items = document.querySelectorAll("*[data-animate-in], *[data-detect-viewport]"),
    waiting = false,
    w = $(window);

  w.on("resize scroll", function() {
		if (waiting) {
		return;
		}
		waiting = true;
		detection();

		setTimeout(function() {
		waiting = false;
		}, 100);
	});

	$(document).ready(function() {
		setTimeout(function() {
		detection();
		}, 500);

		for (var i = 0; i < items.length; i++) {
			var d = 0,
			el = $(items[i]);
			if (items[i].getAttribute("data-animate-in-delay")) {
				d = items[i].getAttribute("data-animate-in-delay") / 1000 + "s";
			} else {
				d = 0;
			}
			el.css("transition-delay", d);
		}
	});
});

</script>


<script>
 	var swiper = new Swiper('.swiper-container', {
   		slidesPerView: 3,
		loop: true,
		spaceBetween: 0,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
 	});
</script>

<script>
   var swiper = new Swiper(".swiper", {
		effect: "coverflow",
		grabCursor: true,
		centeredSlides: true,
		coverflowEffect: {
			rotate: 0,
			stretch: 0,
			depth: 100,
			modifier: 3,
			slideShadows: true
		},
     	loop: true,
     	autoplay: true, // Enable auto-slide
    	autoplayTimeout: 3000, // Set slide interval (in milliseconds)
        autoplayHoverPause: true, // Pause on hover

        navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		breakpoints: {
			640: {
				slidesPerView: 2
			},
			768: {
				slidesPerView: 2
			},
			1024: {
				slidesPerView: 3
			},
			1560: {
				slidesPerView: 4
			}
		}
   });
   
</script>

<script>
	$(document).ready(function(){
		var element_to_animate = $('.grid_pattren_img_inner_box');
		var $window = $(window);

	function check_view_area() {
		var window_height = $window.height();
		var window_top_position = $window.scrollTop();
		var window_bottom_position = (window_top_position + window_height);

		$.each(element_to_animate, function() {
			var element_height = $(this).outerHeight();
			var element_top_position = $(this).offset().top;
			var element_bottom_position = (element_top_position + element_height);
	
			if ((element_bottom_position >= window_top_position) && (element_top_position <= window_bottom_position)) {
				$(this).addClass('in-view');
			}
			else {
				$(this).removeClass('in-view');
			}
		});
	}

	$window.on('scroll resize', check_view_area);
	$window.trigger('scroll');
});
</script>
<script>
    var mzOptions = {};
    mzOptions = {
        onZoomReady: function() {
            console.log('onReady', arguments[0]);
        },
        onUpdate: function() {
            console.log('onUpdated', arguments[0], arguments[1], arguments[2]);
        },
        onZoomIn: function() {
            console.log('onZoomIn', arguments[0]);
        },
        onZoomOut: function() {
            console.log('onZoomOut', arguments[0]);
        },
        onExpandOpen: function() {
            console.log('onExpandOpen', arguments[0]);
        },
        onExpandClose: function() {
            console.log('onExpandClosed', arguments[0]);
        }
    };
    var mzMobileOptions = {};

    function isDefaultOption(o) {
        return magicJS.$A(magicJS.$(o).byTag('option')).filter(function(opt){
            return opt.selected && opt.defaultSelected;
        }).length > 0;
    }

    function toOptionValue(v) {
        if ( /^(true|false)$/.test(v) ) {
            return 'true' === v;
        }
        if ( /^[0-9]{1,}$/i.test(v) ) {
            return parseInt(v,10);
        }
        return v;
    }

    function makeOptions(optType) {
        var  value = null, isDefault = true, newParams = Array(), newParamsS = '', options = {};
        magicJS.$(magicJS.$A(magicJS.$(optType).getElementsByTagName("INPUT"))
            .concat(magicJS.$A(magicJS.$(optType).getElementsByTagName('SELECT'))))
            .forEach(function(param){
                value = ('checkbox'==param.type) ? param.checked.toString() : param.value;

                isDefault = ('checkbox'==param.type) ? value == param.defaultChecked.toString() :
                    ('SELECT'==param.tagName) ? isDefaultOption(param) : value == param.defaultValue;

                if ( null !== value && !isDefault) {
                    options[param.name] = toOptionValue(value);
                }
        	});
        	return options;
    }

    function updateScriptCode() {
        var code = '&lt;script&gt;\nvar mzOptions = ';
        code += JSON.stringify(mzOptions, null, 2).replace(/\"(\w+)\":/g,"$1:")+';';
        code += '\n&lt;/script&gt;';
        magicJS.$('app-code-sample-script').changeContent(code);
    }

    function updateInlineCode() {
        var code = '&lt;a class="MagicZoom" data-options="';
        code += JSON.stringify(mzOptions).replace(/\"(\w+)\":(?:\"([^"]+)\"|([^,}]+))(,)?/g, "$1: $2$3; ").replace(/\{([^{}]*)\}/,"$1").replace(/\s*$/,'');
        code += '"&gt;';
        magicJS.$('app-code-sample-inline').changeContent(code);
    }

    function applySettings() {
        MagicZoom.stop('Zoom-1');
        mzOptions = makeOptions('params');
        mzMobileOptions = makeOptions('mobile-params');
        MagicZoom.start('Zoom-1');
        updateScriptCode();
        updateInlineCode();
        try {
            prettyPrint();
        } catch(e) {}
    }

    function copyToClipboard(src) {
        var copyNode,range, success;

        if (!isCopySupported()) {
            disableCopy();
            return;
        }
        copyNode = document.getElementById('code-to-copy');
        copyNode.innerHTML = document.getElementById(src).innerHTML;

        range = document.createRange();
        range.selectNode(copyNode);
        window.getSelection().addRange(range);

        try {
            success = document.execCommand('copy');
        } catch(err) {
            success = false;
        }
        window.getSelection().removeAllRanges();
        if (!success) {
            disableCopy();
        } else {
            new magicJS.Message('Settings code copied to clipboard.', 3000,
                document.querySelector('.app-code-holder'), 'copy-msg');
        }
    }

    function disableCopy() {
        magicJS.$A(document.querySelectorAll('.cfg-btn-copy')).forEach(function(node) {
            node.disabled = true;
        });
        new magicJS.Message('Sorry, cannot copy settings code to clipboard. Please select and copy code manually.', 3000,
            document.querySelector('.app-code-holder'), 'copy-msg copy-msg-failed');
    }

    function isCopySupported() {
        if ( !window.getSelection || !document.createRange || !document.queryCommandSupported ) { return false; }
        return document.queryCommandSupported('copy');
    }
</script>
</body>
</html>