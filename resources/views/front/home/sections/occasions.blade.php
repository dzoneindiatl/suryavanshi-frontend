<section class="middle_section_img" aria-label="Shop jewellery for every occasion">
    <div class="middle_section_img_inner">
        <div class="occasion-cards-grid">
            @foreach ([
                ['middle1.png', 'Your First Diamond'],
                ['middle2.png', 'Celebrating Success'],
                ['middle3.png', 'New Moms'],
                ['middle4.png', 'Golden Anniversary'],
                ['middle5.webp', 'Golden Milestone'],
                ['middle1.png', 'Timeless Favourites'],
            ] as $occasion)
                <article class="middle_img occasion-card {{ $occasion[2] ?? '' }}">
                    <a href="#" aria-label="Explore {{ $occasion[1] }} jewellery">
                        <img src="{{ asset('assets/image/' . $occasion[0]) }}" alt="{{ $occasion[1] }} jewellery">
                        <h2>{{ $occasion[1] }}</h2>
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</section>
