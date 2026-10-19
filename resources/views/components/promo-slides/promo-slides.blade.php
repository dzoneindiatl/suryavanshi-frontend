@php
    $promoImages = ['middle_img1.webp', 'middle_img2.webp', 'middle_img3.webp'];
@endphp

<div class="middle_sell_item_img">
    @foreach ($promoImages as $index => $promoImage)
        <div class="middle_sell_item_img_slide">
            <a href="#"><img src="{{ asset('assets/image/' . $promoImage) }}" alt="slide {{ $index + 1 }}"></a>
        </div>
    @endforeach
</div>
