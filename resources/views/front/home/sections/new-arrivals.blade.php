@php
    $newArrivalProducts = array_fill(0, 6, [
        'image' => 'collection_img1.webp',
        'price' => '75,317',
        'name' => 'Modern Gleam Diamond Bangle',
        'category' => 'Diamond Bangles',
    ]);
@endphp

<section class="new-arrivals-section new_collection_main" aria-labelledby="new-arrivals-title">
    <div class="new-arrivals-heading">
        <span class="new-arrivals-eyebrow">New Arrivals</span>
        <h2 id="new-arrivals-title">Meet Your Next Favourite</h2>
        <span class="new-arrivals-accent" aria-hidden="true"></span>
        <p>Fresh silhouettes and timeless sparkle, selected for the moments you are about to make memorable.</p>
    </div>

    <div class="product-carousel-shell new-arrivals-carousel-shell">
        <button class="product-carousel-button product-carousel-button-prev" type="button"
            data-carousel-prev="new-arrivals-carousel" aria-label="Show previous new arrivals"
            onclick="window.slideProductCarousel ? window.slideProductCarousel(this, -1) : this.nextElementSibling.scrollBy({ left: -(this.nextElementSibling.querySelector('article').getBoundingClientRect().width + (parseFloat(getComputedStyle(this.nextElementSibling).gap) || 0)), behavior: 'smooth' })">
            <span class="carousel-btn-icon" aria-hidden="true">&larr;</span>
        </button>

        <div id="new-arrivals-carousel" class="new-arrivals-carousel" data-product-carousel>
            @foreach ($newArrivalProducts as $product)
                <article class="new-arrival-card">
                    <div class="new-arrival-card-media">
                        <img src="{{ asset('assets/image/' . $product['image']) }}" alt="{{ $product['name'] }}"
                            loading="lazy" decoding="async">
                        {{-- <span class="new-arrival-badge">New Arrival</span> --}}
                        <div class="new-arrival-actions">
                            <a href="#" aria-label="Add {{ $product['name'] }} to wishlist"><i
                                    class="fa fa-heart-o" aria-hidden="true"></i></a>
                            <a href="#" aria-label="View {{ $product['name'] }}"><i class="fa fa-eye"
                                    aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="new-arrival-card-content">
                        <span class="new-arrival-card-category">{{ $product['category'] }}</span>
                        <h3>{{ $product['name'] }}</h3>
                        <div class="new-arrival-card-footer">
                            <span class="new-arrival-price">&#8377;{{ $product['price'] }}</span>
                            <span class="new-arrival-arrow" aria-hidden="true">&rarr;</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <button class="product-carousel-button product-carousel-button-next" type="button"
            data-carousel-next="new-arrivals-carousel" aria-label="Show next new arrivals"
            onclick="window.slideProductCarousel ? window.slideProductCarousel(this, 1) : this.previousElementSibling.scrollBy({ left: this.previousElementSibling.querySelector('article').getBoundingClientRect().width + (parseFloat(getComputedStyle(this.previousElementSibling).gap) || 0), behavior: 'smooth' })">
            <span class="carousel-btn-icon" aria-hidden="true">&rarr;</span>
        </button>
    </div>
</section>

<script>
    if (window.initProductCarousels) {
        window.initProductCarousels();
    }
</script>
