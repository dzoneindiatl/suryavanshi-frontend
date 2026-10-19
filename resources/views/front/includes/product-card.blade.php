<article class="new-arrival-card {{ $cardClass ?? '' }}">
    <div class="new-arrival-card-media">
        <img src="{{ asset('assets/image/' . ($product['image'] ?? 'collection_img1.webp')) }}"
            alt="{{ $product['name'] ?? 'Product' }}"
            loading="lazy" decoding="async">
        @if (!empty($product['badge']))
            <span class="new-arrival-badge {{ $product['badge_class'] ?? '' }}">{{ $product['badge'] }}</span>
        @endif
        <div class="new-arrival-actions">
            <a href="javascript:void(0);" class="wishlist_button" aria-label="Add {{ $product['name'] ?? 'product' }} to wishlist"><i
                    class="fa fa-heart-o" aria-hidden="true"></i></a>
            <a href="{{ $product['url'] ?? '#' }}" aria-label="View {{ $product['name'] ?? 'product' }}"><i class="fa fa-eye"
                    aria-hidden="true"></i></a>
        </div>
    </div>
    <div class="new-arrival-card-content">
        @if (!empty($product['category']))
            <span class="new-arrival-card-category">{{ $product['category'] }}</span>
        @endif
        <h3>{{ $product['name'] ?? 'Modern Gleam Diamond Bangle' }}</h3>
        <div class="new-arrival-card-footer">
            <span class="new-arrival-price">&#8377;{{ $product['price'] ?? '75,317' }}</span>
            <span class="new-arrival-arrow" aria-hidden="true">&rarr;</span>
        </div>
    </div>
</article>
