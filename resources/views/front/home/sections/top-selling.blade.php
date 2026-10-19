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

    <div class="product-carousel-shell top-selling-carousel-shell">
        <button class="product-carousel-button product-carousel-button-prev" type="button" data-carousel-prev="top-selling-carousel" aria-label="Show previous top selling products" onclick="window.slideProductCarousel ? window.slideProductCarousel(this, -1) : this.nextElementSibling.scrollBy({ left: -(this.nextElementSibling.querySelector('article').getBoundingClientRect().width + (parseFloat(getComputedStyle(this.nextElementSibling).gap) || 0)), behavior: 'smooth' })">
            <span class="carousel-btn-icon" aria-hidden="true">&larr;</span>
        </button>

        <div id="top-selling-carousel" class="top-selling-carousel" data-product-carousel>
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

        <button class="product-carousel-button product-carousel-button-next" type="button" data-carousel-next="top-selling-carousel" aria-label="Show next top selling products" onclick="window.slideProductCarousel ? window.slideProductCarousel(this, 1) : this.previousElementSibling.scrollBy({ left: this.previousElementSibling.querySelector('article').getBoundingClientRect().width + (parseFloat(getComputedStyle(this.previousElementSibling).gap) || 0), behavior: 'smooth' })">
            <span class="carousel-btn-icon" aria-hidden="true">&rarr;</span>
        </button>
    </div>
</section>

<script>
    if (window.initProductCarousels) {
        window.initProductCarousels();
    }
</script>
