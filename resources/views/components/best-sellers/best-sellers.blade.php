<div class="best_seller_product">
    <div class="best_seller_product_inner">
        <div class="best_seller_product_head"><h2>Best Selling Product</h2></div>
        <div class="best_seller_item">
            @foreach (array_fill(0, 4, true) as $_)
                <div class="best_seller_item_inner_item">
                    <a class="best_seller_item_inner" href="#">
                        <div class="best_hero_section"><img src="{{ asset('assets/image/dl-3.webp') }}" alt=""></div>
                        <div class="best_details_section">
                            <div class="best_img_wrap"><img src="{{ asset('assets/image/dl-p1.webp') }}" alt=""></div>
                            <h3 class="best_title">Shoulder Dusters</h3>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
