@php
    $fallbackImages = ['ring1.png', 'ring2.png', 'ring3.png', 'ring4.png', 'ring5.png', 'ring6.png', 'ring1.png', 'ring2.png', 'ring3.png', 'ring4.png', 'ring5.png', 'ring6.png', 'ring1.png', 'ring2.png'];
    $targetCategoryCount = 12;
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

    $collectionShortcuts = [
        [
            'name' => 'All Jewellery',
            'url' => url('/shop'),
            'image' => asset('assets/image/ring2.png'),
        ],
        [
            'name' => 'New Arrivals',
            'url' => url('/shop'),
            'image' => asset('assets/image/ring3.png'),
        ],
        [
            'name' => 'Bestsellers',
            'url' => url('/shop'),
            'image' => asset('assets/image/ring4.png'),
        ],
        [
            'name' => 'Rings',
            'url' => url('/shop'),
            'image' => asset('assets/image/ring5.png'),
        ],
        [
            'name' => 'Earrings',
            'url' => url('/shop'),
            'image' => asset('assets/image/ring6.png'),
        ],
        [
            'name' => 'Pendants',
            'url' => url('/shop'),
            'image' => asset('assets/image/ring1.png'),
        ],
        [
            'name' => 'Bracelets',
            'url' => url('/shop'),
            'image' => asset('assets/image/ring2.png'),
        ],
    ];

    foreach ($collectionShortcuts as $shortcut) {
        if ($categoryItems->count() >= $targetCategoryCount) {
            break;
        }

        $categoryItems->push($shortcut);
    }

    $categoryItems = $categoryItems->take($targetCategoryCount)->values();
    $categorySplitAt = (int) ceil($categoryItems->count() / 2);
    $categoryRows = [
        $categoryItems->slice(0, $categorySplitAt)->values(),
        $categoryItems->slice($categorySplitAt)->values(),
    ];
@endphp

<section class="jewellery-categories-section" data-category-shuffle-section aria-labelledby="jewellery-categories-title">
    <div class="jewellery-categories-heading">
        <div class="jewellery-categories-heading-copy">
            <span class="jewellery-categories-eyebrow">Explore Our Collections</span>
            <h2 id="jewellery-categories-title">Find Your Perfect Sparkle</h2>
            <span class="jewellery-categories-accent" aria-hidden="true"></span>
            <p>Discover timeless designs crafted to celebrate every style, moment, and memory.</p>
        </div>

        <div class="jewellery-categories-heading-note" aria-hidden="true">
            <span>{{ $categoryItems->count() }} collections</span>
            <i></i>
            <span>Curated for you</span>
        </div>
    </div>

    <div class="jewellery-category-shuffle" role="list" aria-label="Jewellery categories">
        @foreach ($categoryRows as $rowIndex => $row)
            <div class="jewellery-category-shuffle-row {{ $rowIndex === 1 ? 'is-offset' : '' }}" data-category-shuffle-row>
                @foreach ($row as $rowItemIndex => $category)
                    @php
                        $categoryIndex = ($rowIndex * $categorySplitAt) + $rowItemIndex;
                        $categoryName = data_get($category, 'name', 'Jewellery Category');
                        $categorySlug = data_get($category, 'slug');
                        $categoryImage = data_get($category, 'thumbnail_image') ?: data_get($category, 'image');

                        if (!$categoryImage || !filter_var($categoryImage, FILTER_VALIDATE_URL)) {
                            $categoryImage = asset('assets/image/' . $fallbackImages[$categoryIndex % count($fallbackImages)]);
                        }

                        $categoryUrl = data_get($category, 'url') ?: ($categorySlug
                            ? route('category.show', ['path' => $categorySlug])
                            : '#');
                    @endphp

                    <article
                        class="jewellery-category-card"
                        data-category-shuffle-card
                        data-category-order="{{ $categoryIndex }}"
                        style="--category-delay: {{ min($categoryIndex, 13) * 70 }}ms"
                        role="listitem"
                    >
                        <a class="jewellery-category-card-link" href="{{ $categoryUrl }}" aria-label="Explore {{ $categoryName }}">
                            <div class="jewellery-category-image-wrap">
                                <span class="jewellery-category-card-index" aria-hidden="true">{{ str_pad($categoryIndex + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <img
                                    src="{{ $categoryImage }}"
                                    alt="{{ $categoryName }}"
                                    loading="{{ $categoryIndex < 4 ? 'eager' : 'lazy' }}"
                                    decoding="async"
                                >
                                <span class="jewellery-category-image-caption" aria-hidden="true">J.J.H. Collection</span>
                            </div>
                            <div class="jewellery-category-card-content">
                                <h3>{{ $categoryName }}</h3>
                               
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        @endforeach
    </div>
</section>

<script>
    (() => {
        const section = document.querySelector('[data-category-shuffle-section]');
        const rows = section ? [...section.querySelectorAll('[data-category-shuffle-row]')] : [];
        const cards = section ? [...section.querySelectorAll('[data-category-shuffle-card]')] : [];
        const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const isMobileOrTablet = () => window.matchMedia('(max-width: 1199px)').matches || (window.innerWidth && window.innerWidth < 1200);

        if (!section || rows.length !== 2 || cards.length < 2) return;

        const revealSection = () => {
            section.classList.add('is-visible');
        };

        // Immediately reveal and disable animation on mobile and tablet
        if (isMobileOrTablet()) {
            revealSection();
            return;
        }

        const cardByOrder = new Map(cards.map((card) => [card.dataset.categoryOrder, card]));
        const splitAt = Math.ceil(cards.length / 2);
        let topRowOrder = cards.slice(0, splitAt).map((card) => card.dataset.categoryOrder);
        let bottomRowOrder = cards.slice(splitAt).map((card) => card.dataset.categoryOrder);
        let hasShuffled = false;

        const swapColumn = (columnIndex) => new Promise((resolve) => {
            const previousPositions = new Map(
                cards.map((card) => [card.dataset.categoryOrder, card.getBoundingClientRect()])
            );
            const movingKeys = [topRowOrder[columnIndex], bottomRowOrder[columnIndex]];
            const movingCards = movingKeys.map((key) => cardByOrder.get(key));

            [topRowOrder[columnIndex], bottomRowOrder[columnIndex]] = [
                bottomRowOrder[columnIndex],
                topRowOrder[columnIndex],
            ];

            rows[0].replaceChildren(...topRowOrder.map((key) => cardByOrder.get(key)));
            rows[1].replaceChildren(...bottomRowOrder.map((key) => cardByOrder.get(key)));

            movingCards.forEach((card) => {
                const previous = previousPositions.get(card.dataset.categoryOrder);
                const current = card.getBoundingClientRect();
                const offsetX = previous.left - current.left;
                const offsetY = previous.top - current.top;

                card.style.transition = 'none';
                card.style.transform = `translate(${offsetX}px, ${offsetY}px)`;
                card.classList.add('is-moving');
            });

            section.classList.add('is-shuffling');

            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    movingCards.forEach((card) => {
                        card.style.transition = 'transform 900ms linear';
                        card.style.transform = '';
                    });
                });
            });

            window.setTimeout(() => {
                movingCards.forEach((card) => {
                    card.style.transition = '';
                    card.style.transform = '';
                    card.classList.remove('is-moving');
                });
                resolve();
            }, 600);
        });

        const runInitialShuffle = async () => {
            if (hasShuffled) return;

            hasShuffled = true;
            revealSection();

            if (reducedMotion || isMobileOrTablet()) return;

            await new Promise((resolve) => window.setTimeout(resolve, 120));

            for (let columnIndex = 0; columnIndex < Math.min(topRowOrder.length, bottomRowOrder.length); columnIndex += 1) {
                await swapColumn(columnIndex);
                await new Promise((resolve) => window.setTimeout(resolve, 20));
            }

            section.classList.remove('is-shuffling');
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', runInitialShuffle, { once: true });
        } else {
            window.requestAnimationFrame(runInitialShuffle);
        }
    })();
</script>
