@php
    $influencers = [
        ['image' => 'Influencer individual images-01.webp', 'name' => 'Saru Sharma', 'role' => 'Mom Blogger', 'quote' => 'Mia lets me be the supermom I am with jewellery as versatile and fabulous as'],
        ['image' => 'Influencer individual images-02.webp', 'name' => 'Asha Roka', 'role' => 'Professional MMA Fighter', 'quote' => "Mia embodies my fighting spirit with jewellery that's as fierce as my punches"],
        ['image' => 'Influencer individual images-03.webp', 'name' => 'Anuja Deora', 'role' => 'CEO & Founder', 'quote' => 'Mia empowers me to lead with style, confidence, and a touch of sparkle!'],
        ['image' => 'Influencer individual-04.webp', 'name' => 'Riza Reji', 'role' => 'Model & Dancer', 'quote' => "Mia's pieces reflect my spirit - they don't just sparkle, they dance"],
        ['image' => 'queenandrolast.jpg', 'name' => 'Queen Andro', 'role' => 'Fashion Superstar', 'quote' => 'Mia is my canvas for self-expression - vibrant, bold, and unapologetically me'],
    ];
    $instagramImages = [
        ['image' => 'insta1.webp', 'size' => 'small'], ['image' => 'insta2.webp', 'size' => 'medium'],
        ['image' => 'insta3.webp', 'size' => 'large'], ['image' => 'insta4.webp', 'size' => 'large'],
        ['image' => 'insta5.webp', 'size' => 'medium'], ['image' => 'insta1.webp', 'size' => 'small'],
        ['image' => 'insta2.webp', 'size' => 'small'], ['image' => 'insta3.webp', 'size' => 'large'],
        ['image' => 'insta4.webp', 'size' => 'medium'],
    ];
@endphp

<div class="influencers_main">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="influencers_slide_inner">
                    @foreach ($influencers as $influencer)
                        <div class="influencers_content">
                            <div class="influencers_img"><img src="{{ asset('assets/image/' . $influencer['image']) }}" alt=""></div>
                            <div class="influencers_txt">
                                <h6>{{ $influencer['name'] }}</h6>
                                <p>{{ $influencer['role'] }}</p>
                                <h3>{{ $influencer['quote'] }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-5">
                <div class="influencers_box">
                    <h2>Influencers</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                    <div class="influencers_box_inner">
                        <div class="influencers_img1"><img src="{{ asset('assets/image/left_img.webp') }}" alt=""></div>
                        <div class="influencers_img2"><img src="{{ asset('assets/image/image-with-text.webp') }}" alt=""></div>
                        <div class="influencers_img3"><img src="{{ asset('assets/image/image-with-text_small.webp') }}" alt=""></div>
                    </div>
                    <a href="#" class="insta_sec_txt"><h3>Take me to instagram</h3><span class="insta_arrow"><i class="fa fa-instagram"></i></span></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="insta_sec_main">
                    <div class="insta_sec">
                        @foreach ($instagramImages as $instagramImage)
                            <div class="insta_sec_img insta_sec_{{ $instagramImage['size'] }}">
                                <img src="{{ asset('assets/image/' . $instagramImage['image']) }}" alt="">
                                <div class="insta_icon"><i class="fa fa-instagram"></i></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
