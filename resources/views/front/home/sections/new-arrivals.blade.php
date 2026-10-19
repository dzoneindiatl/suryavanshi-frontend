@php
    $newArrivalProducts = [
        [
            'image' => 'collection_img1.webp',
            'price' => '75,317',
            'name' => 'Modern Gleam Diamond Bangle',
            'category' => 'Diamond Bangles',
        ],
        [
            'image' => 'collection_img1.webp',
            'price' => '82,450',
            'name' => 'Eternal Grace Diamond Necklace',
            'category' => 'Diamond Necklaces',
        ],
        [
            'image' => 'collection_img1.webp',
            'price' => '64,190',
            'name' => 'Classic Solitaire Diamond Ring',
            'category' => 'Solitaire Rings',
        ],
        [
            'image' => 'collection_img1.webp',
            'price' => '91,200',
            'name' => 'Celestial Radiance Earrings',
            'category' => 'Diamond Earrings',
        ],
        [
            'image' => 'collection_img1.webp',
            'price' => '79,900',
            'name' => 'Opulent Petal Diamond Bracelet',
            'category' => 'Diamond Bracelets',
        ],
        [
            'image' => 'collection_img1.webp',
            'price' => '88,600',
            'name' => 'Royal Heritage Diamond Choker',
            'category' => 'Diamond Chokers',
        ],
    ];
@endphp

<style>
/* ── New Arrivals Section & Responsive Polish ────────────────── */
.new-arrivals-section {
    position: relative;
    padding: clamp(40px, 5vw, 78px) clamp(18px, 4vw, 68px) clamp(48px, 6vw, 88px);
    overflow: hidden;
    background: #ffffff;
}

.new-arrivals-heading {
    margin: 0 auto clamp(24px, 3.5vw, 46px);
    max-width: var(--homepage-content-max, 1600px);
}

.new-arrivals-header-flex {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 16px;
}

.new-arrivals-heading-text {
    flex: 1 1 auto;
}

.new-arrivals-header-nav {
    display: none;
    gap: 8px;
    align-items: center;
    flex-shrink: 0;
    margin-bottom: 4px;
}

.new-arrivals-header-nav .product-carousel-button {
    width: 36px;
    height: 36px;
    font-size: 16px;
    border: 1px solid rgba(198, 161, 91, 0.5);
    background: #ffffff;
    color: #252321;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
    transition: all 0.25s ease;
}

.new-arrivals-header-nav .product-carousel-button:hover,
.new-arrivals-header-nav .product-carousel-button:focus-visible {
    background: #c6a15b;
    border-color: #c6a15b;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(198, 161, 91, 0.35);
}

/* Mobile Progress Bar */
.new-arrivals-mobile-progress {
    display: none;
    width: 100%;
    max-width: 180px;
    height: 3px;
    background: #f0e7dc;
    border-radius: 3px;
    margin: 16px auto 0;
    overflow: hidden;
    position: relative;
}

.new-arrivals-progress-bar {
    height: 100%;
    width: 33%;
    background: #bb8442;
    border-radius: 3px;
    transition: width 0.15s ease-out;
}

/* ── Mobile Layout (< 768px) ─────────────────────────────────── */
@media (max-width: 767px) {
    .new-arrivals-section {
        padding: 34px 14px 40px;
    }

    .new-arrivals-heading {
        margin-bottom: 18px;
    }

    .new-arrivals-eyebrow {
        font-size: 9px;
        letter-spacing: 0.18em;
        margin-bottom: 8px;
    }

    .new-arrivals-heading h2 {
        font-size: clamp(21px, 5.8vw, 26px);
        line-height: 1.22;
    }

    .new-arrivals-accent {
        margin: 12px 0 10px;
        width: 38px;
    }

    .new-arrivals-heading p {
        font-size: 12.5px;
        line-height: 1.5;
        color: #716b65;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin: 0;
    }

    /* Show top-right nav buttons on mobile */
    .new-arrivals-header-nav {
        display: flex;
    }

    /* Show mobile scroll progress bar */
    .new-arrivals-mobile-progress {
        display: block;
    }

    /* Hide the overlapping side buttons on mobile */
    .desktop-carousel-btn {
        display: none !important;
    }

    /* Carousel shell takes 100% width with no button squeeze */
    .product-carousel-shell.new-arrivals-carousel-shell {
        display: block !important;
        width: 100% !important;
        margin: 0 !important;
        gap: 0 !important;
    }

    .new-arrivals-carousel {
        display: flex !important;
        flex-wrap: nowrap !important;
        gap: 12px !important;
        overflow-x: auto !important;
        scroll-snap-type: x mandatory !important;
        -webkit-overflow-scrolling: touch !important;
        scrollbar-width: none !important;
        padding: 4px 1px 8px !important;
        margin: 0 !important;
        width: 100% !important;
    }

    .new-arrivals-carousel::-webkit-scrollbar {
        display: none !important;
    }

    /* 2 equal, beautifully sized cards per view */
    .new-arrivals-carousel .new-arrival-card {
        flex: 0 0 calc((100% - 12px) / 2) !important;
        min-width: calc((100% - 12px) / 2) !important;
        max-width: calc((100% - 12px) / 2) !important;
        scroll-snap-align: start !important;
        box-sizing: border-box !important;
    }

    /* Media photo wrapper */
    .new-arrival-card-media {
        border-radius: 6px !important;
        overflow: hidden !important;
        background: #faf7f2 !important;
        border: 1px solid rgba(198, 161, 91, 0.2) !important;
    }

    /* Subtle inner line on photo so jewelry is never blocked */
    .new-arrival-card-media::after {
        inset: 4px !important;
        border-color: rgba(255, 255, 255, 0.45) !important;
    }

    /* Compact glassmorphic action buttons (heart & eye) */
    .new-arrival-actions {
        top: 7px !important;
        right: 7px !important;
        gap: 5px !important;
    }

    .new-arrival-actions a {
        width: 28px !important;
        height: 28px !important;
        font-size: 11px !important;
        background: rgba(255, 255, 255, 0.9) !important;
        backdrop-filter: blur(4px) !important;
        -webkit-backdrop-filter: blur(4px) !important;
        border: 1px solid rgba(198, 161, 91, 0.3) !important;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08) !important;
        color: #333333 !important;
    }

    .new-arrival-actions a:hover,
    .new-arrival-actions a:active {
        background: #bb8442 !important;
        color: #ffffff !important;
        border-color: #bb8442 !important;
    }

    /* Card content typography */
    .new-arrival-card-content {
        padding: 10px 2px 12px !important;
        border-bottom: 1px solid rgba(198, 161, 91, 0.22) !important;
    }

    .new-arrival-card-category {
        font-size: 9px !important;
        letter-spacing: 0.12em !important;
        margin-bottom: 3px !important;
        color: #bb8442 !important;
    }

    .new-arrival-card-content h3 {
        font-size: 13.5px !important;
        line-height: 1.35 !important;
        margin: 0 0 8px !important;
        min-height: 36px !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
        font-weight: 500 !important;
        color: #222222 !important;
    }

    .new-arrival-card-footer {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
    }

    .new-arrival-price {
        font-size: 13.5px !important;
        font-weight: 700 !important;
        color: #222222 !important;
    }

    .new-arrival-arrow {
        font-size: 16px !important;
        color: #bb8442 !important;
    }
}

/* Extra small mobile screens (<= 360px) */
@media (max-width: 360px) {
    .new-arrivals-carousel .new-arrival-card {
        flex: 0 0 76vw !important;
        min-width: 76vw !important;
        max-width: 76vw !important;
    }
}
</style>

<section class="new-arrivals-section new_collection_main" aria-labelledby="new-arrivals-title">
    <div class="new-arrivals-heading">
        <div class="new-arrivals-header-flex">
            <div class="new-arrivals-heading-text">
                <span class="new-arrivals-eyebrow">New Arrivals</span>
                <h2 id="new-arrivals-title">Meet Your Next Favourite</h2>
                <span class="new-arrivals-accent" aria-hidden="true"></span>
                <p>Fresh silhouettes and timeless sparkle, selected for the moments you are about to make memorable.</p>
            </div>
            <!-- Header navigation arrows (shown on mobile, right beside title) -->
            <div class="new-arrivals-header-nav">
                <button class="product-carousel-button product-carousel-button-prev" type="button"
                    data-carousel-prev="new-arrivals-carousel" aria-label="Show previous new arrivals"
                    onclick="window.slideProductCarousel ? window.slideProductCarousel(this, -1) : document.getElementById('new-arrivals-carousel').scrollBy({ left: -(document.getElementById('new-arrivals-carousel').querySelector('article').getBoundingClientRect().width + 12), behavior: 'smooth' })">
                    <span class="carousel-btn-icon" aria-hidden="true">&larr;</span>
                </button>
                <button class="product-carousel-button product-carousel-button-next" type="button"
                    data-carousel-next="new-arrivals-carousel" aria-label="Show next new arrivals"
                    onclick="window.slideProductCarousel ? window.slideProductCarousel(this, 1) : document.getElementById('new-arrivals-carousel').scrollBy({ left: document.getElementById('new-arrivals-carousel').querySelector('article').getBoundingClientRect().width + 12, behavior: 'smooth' })">
                    <span class="carousel-btn-icon" aria-hidden="true">&rarr;</span>
                </button>
            </div>
        </div>
    </div>

    <div class="product-carousel-shell new-arrivals-carousel-shell">
        <!-- Desktop side button prev (shown on >= 768px) -->
        <button class="product-carousel-button product-carousel-button-prev desktop-carousel-btn" type="button"
            data-carousel-prev="new-arrivals-carousel" aria-label="Show previous new arrivals"
            onclick="window.slideProductCarousel ? window.slideProductCarousel(this, -1) : document.getElementById('new-arrivals-carousel').scrollBy({ left: -(document.getElementById('new-arrivals-carousel').querySelector('article').getBoundingClientRect().width + (parseFloat(getComputedStyle(document.getElementById('new-arrivals-carousel')).gap) || 20)), behavior: 'smooth' })">
            <span class="carousel-btn-icon" aria-hidden="true">&larr;</span>
        </button>

        <div id="new-arrivals-carousel" class="new-arrivals-carousel" data-product-carousel>
            @foreach ($newArrivalProducts as $product)
                @include('front.includes.product-card', ['product' => $product])
            @endforeach
        </div>

        <!-- Desktop side button next (shown on >= 768px) -->
        <button class="product-carousel-button product-carousel-button-next desktop-carousel-btn" type="button"
            data-carousel-next="new-arrivals-carousel" aria-label="Show next new arrivals"
            onclick="window.slideProductCarousel ? window.slideProductCarousel(this, 1) : document.getElementById('new-arrivals-carousel').scrollBy({ left: document.getElementById('new-arrivals-carousel').querySelector('article').getBoundingClientRect().width + (parseFloat(getComputedStyle(document.getElementById('new-arrivals-carousel')).gap) || 20), behavior: 'smooth' })">
            <span class="carousel-btn-icon" aria-hidden="true">&rarr;</span>
        </button>
    </div>


</section>
