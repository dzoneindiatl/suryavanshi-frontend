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

<div class="love_main">
    <div class="love_main_inner">
        <div class="love_top_left">
            <img src="{{ asset('assets/image/love7.png') }}" class="love_top_left_img">
            <p>Wrapped with Love</p>
        </div>
        <div class="love_main_right">
            @foreach ($loveItems as $item)
                <div class="love_main_right_inner">
                    <a href="#"><div class="right_img_inn"><img src="{{ asset('assets/image/' . $item['image']) }}"><p class="love_right_txt">{{ $item['title'] }}</p></div></a>
                </div>
            @endforeach
        </div>
    </div>
</div>
