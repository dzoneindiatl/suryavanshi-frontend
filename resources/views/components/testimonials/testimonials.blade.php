@php
    $testimonial = [
        'name' => 'Nutan Mishra, 33',
        'image' => 'bm3.webp',
        'description' => "I got a Nazariya for my baby boy from BlueStone. It's so cute seeing it on my little one's wrist, and it gives me a sense of security knowing it's there. Thanks, BlueStone, for making such lovely pieces for our little ones!",
    ];
@endphp

<div class="custom_testimonial_main">
    <div class="custom_testimonial_head"><h2>Customer Testimonials</h2></div>
    <div class="teatimonial_card_inner">
        @foreach (range(1, 5) as $number)
            <div class="testimonial_line testimonial_line{{ $number }}">
                <div class="testimonial_border_line"></div>
                <div class="testimonial_clip"><img src="{{ asset('assets/image/ribbon1.png') }}" alt="" width="28" height="30"></div>
                <div class="testimonial_item">
                    <div class="testimonial_image"><img src="{{ asset('assets/image/' . $testimonial['image']) }}" alt="{{ $testimonial['name'] }}" width="277" height="242" loading="lazy"></div>
                    <div class="testimonial_rating" aria-label="5 out of 5 stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <div class="testimonial_title">{{ $testimonial['name'] }}</div>
                    <div class="testimonial_desc">{{ $testimonial['description'] }}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    (function () {
        function initTestimonialDrag() {
            var slider = document.querySelector('.teatimonial_card_inner');
            if (!slider || slider.dataset.dragInit === 'true') return;
            slider.dataset.dragInit = 'true';

            var isDown = false;
            var startX = 0;
            var scrollLeft = 0;

            slider.addEventListener('mousedown', function (e) {
                isDown = true;
                slider.style.cursor = 'grabbing';
                startX = e.pageX - slider.offsetLeft;
                scrollLeft = slider.scrollLeft;
            });

            window.addEventListener('mouseup', function () {
                if (isDown) {
                    isDown = false;
                    if (slider) slider.style.cursor = '';
                }
            });

            slider.addEventListener('mousemove', function (e) {
                if (!isDown) return;
                e.preventDefault();
                var x = e.pageX - slider.offsetLeft;
                var walk = (x - startX) * 1.4;
                slider.scrollLeft = scrollLeft - walk;
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initTestimonialDrag);
        } else {
            initTestimonialDrag();
        }
    })();
</script>

