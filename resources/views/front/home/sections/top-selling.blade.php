@php
    $topSellingLabels = ['Best Seller', 'Treding', 'Best Seller', 'Treding', 'Best Seller', 'Best Seller'];
@endphp

<div class="caratlane_collection_main">
    <h2>Top Selling Products</h2>
    <div class="caratlane_collection_main_inner">
        @foreach ($topSellingLabels as $index => $label)
            <div class="collection_inner_box">
                <div class="collection_inner_box_img">
                    <img src="{{ asset('assets/image/collection_img1.webp') }}" alt="img">
                    <div class="collection_inner_box_icon">
                        <a href="#"><i class="fa fa-heart-o"></i></a>
                        <a href="#"><i class="fa fa-eye"></i></a>
                    </div>
                    <div class="{{ $index % 2 === 0 ? 'collection_best_seller' : 'collection_treding_seller' }}"><a href="#">{{ $label }}</a></div>
                </div>
                <div class="collection_inner_box_txt">
                    <div class="price"><span>₹75,317</span></div>
                    <h5>Modern Gleam Diamond Bangle</h5>
                </div>
            </div>
        @endforeach
    </div>
</div>
