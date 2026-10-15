@php
    $wrapImages = ['w2.webp', 'w3.webp', 'w4.webp', 'w5.webp', 'w6.webp', 'w7.webp'];
@endphp

<div class="wrap_inner_sec">
    <div class="wrap_inner_sec_inner">
        <div class="wrap_inner_sec_left">
            <div class="wrap_inner_grid">
                <a href="#"><img src="{{ asset('assets/image/w1.webp') }}" alt=""></a>
            </div>
        </div>
        <div class="wrap_inner_sec_right">
            @foreach ($wrapImages as $wrapImage)
                <div class="wrap_inner_grid">
                    <a href="#"><img src="{{ asset('assets/image/' . $wrapImage) }}" alt=""></a>
                </div>
            @endforeach
        </div>
    </div>
</div>
