@php
    $featuredCollections = [
        ['image' => 'mh-hsf_v1.webp', 'title' => 'Heart So Full', 'eyebrow' => 'Sentimental favourites'],
        ['image' => 'mh-barbie.webp', 'title' => 'The Barbie Edit', 'eyebrow' => 'Playful icons'],
        ['image' => 'evil_eye_dcs.webp', 'title' => 'Evil Eye', 'eyebrow' => 'Good energy, beautifully worn'],
    ];
@endphp

<section class="featured-collections-section" id="home_collection_sec" aria-labelledby="featured-collections-title">
    <div class="featured-collections-heading">
        <span class="featured-collections-eyebrow">Curated Collections</span>
        <h2 id="featured-collections-title">Stories Worth Wearing</h2>
        <span class="featured-collections-accent" aria-hidden="true"></span>
        <p>Discover expressive pieces designed to turn the moments you treasure into something unforgettable.</p>
    </div>

    <div class="featured-collections-grid">
        @foreach ($featuredCollections as $index => $collection)
            <article class="featured-collection-card" style="--collection-delay: {{ $index * 100 }}ms">
                <a class="featured-collection-card-link" href="#" aria-label="Explore {{ $collection['title'] }} collection">
                    <div class="featured-collection-media">
                        <img
                            src="{{ asset('assets/image/' . $collection['image']) }}"
                            alt="{{ $collection['title'] }} jewellery collection"
                            loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                            decoding="async"
                        >
                        <span class="featured-collection-number" aria-hidden="true">0{{ $index + 1 }}</span>
                    </div>
                    <div class="featured-collection-content">
                        <span class="featured-collection-card-eyebrow">{{ $collection['eyebrow'] }}</span>
                        <h3>{{ $collection['title'] }}</h3>
                        <span class="featured-collection-explore">
                            <span>Explore Collection</span>
                            <span class="featured-collection-arrow" aria-hidden="true">&rarr;</span>
                        </span>
                    </div>
                </a>
            </article>
        @endforeach
    </div>
</section>

<script>
    (() => {
        const section = document.querySelector('.featured-collections-section');
        if (!section) return;

        if (!('IntersectionObserver' in window)) {
            section.classList.add('is-visible');
            return;
        }

        const observer = new IntersectionObserver((entries, currentObserver) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    currentObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        observer.observe(section);
    })();
</script>
