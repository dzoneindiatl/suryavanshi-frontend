@php
    $topSellingLabels = ['Best Seller', 'Treding', 'Best Seller', 'Treding', 'Best Seller', 'Best Seller'];
@endphp

<section class="top-selling-section" aria-labelledby="top-selling-title">
    <div class="top-selling-heading">
        <span class="top-selling-eyebrow">Curated Favourites</span>
        <h2 id="top-selling-title">Top Selling Products</h2>
        <span class="top-selling-accent" aria-hidden="true"></span>
        <p>Discover the pieces customers are choosing to wear, gift, and treasure.</p>
    </div>

    <div class="top-selling-carousel">
        @foreach ($topSellingLabels as $index => $label)
            <article class="top-selling-card collection_inner_box">
                <div class="top-selling-card-media collection_inner_box_img">
                    <img src="{{ asset('assets/image/collection_img1.webp') }}" alt="img">
                    <div class="top-selling-card-actions collection_inner_box_icon">
                        <a href="#"><i class="fa fa-heart-o"></i></a>
                        <a href="#"><i class="fa fa-eye"></i></a>
                    </div>
                    <span class="top-selling-badge {{ $index % 2 === 0 ? 'is-best-seller' : 'is-trending' }}">{{ $label }}</span>
                </div>
                <div class="top-selling-card-content collection_inner_box_txt">
                    <div class="price"><span>₹75,317</span></div>
                    <h3>Modern Gleam Diamond Bangle</h3>
                </div>
            </article>
        @endforeach
    </div>
</section>
