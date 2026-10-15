@php
    $fallbackImages = ['ring1.png', 'ring2.png', 'ring3.png', 'ring4.png', 'ring5.png', 'ring6.png', 'ring1.png'];
    $categoryItems = collect($homeCategories ?? []);

    if ($categoryItems->isEmpty()) {
        $categoryItems = collect($fallbackImages)->map(function ($image, $index) {
            return [
                'name' => 'Jewellery Category ' . ($index + 1),
                'slug' => null,
                'image' => asset('assets/image/' . $image),
            ];
        });
    }
@endphp

<section class="jewellery-categories-section" aria-labelledby="jewellery-categories-title">
    <div class="jewellery-categories-heading">
        <div class="jewellery-categories-heading-copy">
            <span class="jewellery-categories-eyebrow">Explore Our Collections</span>
            <h2 id="jewellery-categories-title">Find Your Perfect Sparkle</h2>
            <span class="jewellery-categories-accent" aria-hidden="true"></span>
            <p>Discover timeless designs crafted to celebrate every style, moment, and memory.</p>
        </div>
    </div>

    <div class="jewellery-category-carousel-shell">
        <button class="jewellery-category-carousel-button jewellery-category-carousel-button-prev" type="button" data-category-carousel-prev aria-label="Previous categories" aria-controls="jewellery-category-carousel">
            <span aria-hidden="true">&larr;</span>
        </button>

        <div class="jewellery-category-carousel" id="jewellery-category-carousel" role="region" aria-label="Jewellery categories" tabindex="0">
            <div class="jewellery-category-track">
                @foreach ($categoryItems as $index => $category)
                    @php
                        $categoryName = data_get($category, 'name', 'Jewellery Category');
                        $categorySlug = data_get($category, 'slug');
                        $categoryImage = data_get($category, 'thumbnail_image') ?: data_get($category, 'image');

                        if (!$categoryImage || !filter_var($categoryImage, FILTER_VALIDATE_URL)) {
                            $categoryImage = asset('assets/image/' . $fallbackImages[$index % count($fallbackImages)]);
                        }

                        $categoryUrl = $categorySlug
                            ? route('category.show', ['path' => $categorySlug])
                            : '#';
                    @endphp

                    <article class="jewellery-category-card" style="--category-delay: {{ min($index, 7) * 70 }}ms">
                        <a class="jewellery-category-card-link" href="{{ $categoryUrl }}" aria-label="Explore {{ $categoryName }}">
                            <div class="jewellery-category-image-wrap">
                                <img
                                    src="{{ $categoryImage }}"
                                    alt="{{ $categoryName }}"
                                    loading="{{ $index < 4 ? 'eager' : 'lazy' }}"
                                    decoding="async"
                                >
                            </div>
                            <div class="jewellery-category-card-content">
                                <h3>{{ $categoryName }}</h3>
                                <span class="jewellery-category-explore">
                                    <span>Explore Collection</span>
                                    <span class="jewellery-category-explore-arrow" aria-hidden="true">&rarr;</span>
                                </span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>

        <button class="jewellery-category-carousel-button jewellery-category-carousel-button-next" type="button" data-category-carousel-next aria-label="Next categories" aria-controls="jewellery-category-carousel">
            <span aria-hidden="true">&rarr;</span>
        </button>
    </div>
</section>

<script>
    (() => {
        const section = document.querySelector('.jewellery-categories-section');
        const carousel = document.querySelector('#jewellery-category-carousel');
        const previousButton = document.querySelector('[data-category-carousel-prev]');
        const nextButton = document.querySelector('[data-category-carousel-next]');

        if (!section || !carousel) return;

        const scrollCategories = (direction) => {
            carousel.scrollBy({
                left: direction * carousel.clientWidth * 0.82,
                behavior: 'smooth'
            });
        };

        previousButton?.addEventListener('click', () => scrollCategories(-1));
        nextButton?.addEventListener('click', () => scrollCategories(1));

        carousel.addEventListener('keydown', (event) => {
            if (event.key === 'ArrowLeft') scrollCategories(-1);
            if (event.key === 'ArrowRight') scrollCategories(1);
        });

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
