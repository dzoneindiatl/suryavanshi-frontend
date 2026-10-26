@php
    $loveItems = [
        ['image' => 'love1.jpg', 'title' => 'Latest Rings'],
        ['image' => 'love2.jpg', 'title' => 'Trendy Bracelets'],
        ['image' => 'love3.jpg', 'title' => 'Must-have Earrings'],
        ['image' => 'love4.jpg', 'title' => 'All-day Chains'],
        ['image' => 'love5.jpg', 'title' => 'On-trend Necklaces'],
        ['image' => 'love6.jpg', 'title' => 'Under ₹30K Styles'],
    ];
@endphp

<section class="love_main" aria-labelledby="wrapped-with-love-title">
    <div class="love-section-heading">
        <span class="love-section-eyebrow">Curated for Every Moment</span>
        <h2 id="wrapped-with-love-title">Wrapped with Love</h2>
        <span class="love-section-accent" aria-hidden="true"></span>
        <p>Thoughtful jewellery styles to make every milestone feel a little more special.</p>
    </div>

    <div class="love_main_inner love-collection-panel">
        <div class="love-collection-grid">
            @foreach ($loveItems as $item)
                <a class="love-collection-card" href="#" aria-label="Explore {{ $item['title'] }}">
                    <span class="love-collection-card-media">
                        <img src="{{ asset('assets/image/' . $item['image']) }}" alt="{{ $item['title'] }}" loading="lazy" decoding="async">
                        <span class="love-collection-card-overlay">
                            <span class="love-collection-card-title">{{ $item['title'] }}</span>
                            <span class="love-collection-card-action">Explore Collection <span aria-hidden="true">&rarr;</span></span>
                        </span>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>
