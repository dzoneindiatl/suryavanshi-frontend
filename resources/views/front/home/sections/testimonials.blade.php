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
                <div class="testimonial_clip"><img src="{{ asset('assets/image/ribbon1.png') }}" width="28" height="30"></div>
                <div class="testimonial_item">
                    <div class="testimonial_image"><img src="{{ asset('assets/image/' . $testimonial['image']) }}" alt="img1" width="277" height="242"></div>
                    <div class="testimonial_title">{{ $testimonial['name'] }}</div>
                    <div class="testimonial_desc">{{ $testimonial['description'] }}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
