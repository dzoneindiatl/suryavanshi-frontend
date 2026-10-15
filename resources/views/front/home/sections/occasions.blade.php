<div class="middle_section_img">
    <div class="middle_section_img_inner">
        <div class="col_left_3">
            <div class="giftcard-section">
                <div class="giftcard-wrap">
                    <div class="bg-img-wrap">
                        <img class="bg-img" src="{{ asset('assets/image/g-h.webp') }}" alt="Gift Finder under 50K">
                        <img class="left-h-img" src="{{ asset('assets/image/g-hl.webp') }}" alt="Gift Finder under 50K">
                        <img class="right-h-img" src="{{ asset('assets/image/g-hr.webp') }}" alt="Gift Finder under 50K">
                        <div class="gift-wrap">
                            @foreach (['u-10k_v4.webp' => 'Under 10k', 'u-30k_v4.webp' => 'Under 30k', 'u-50k_v4.webp' => 'Under 50k'] as $image => $alt)
                                <a class="gift-item" href="#"><img src="{{ asset('assets/image/' . $image) }}" alt="{{ $alt }}"></a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col_left_1">
            @foreach ([['middle1.png', 'Your First Diamond'], ['middle3.png', 'Celebrating Success']] as $occasion)
                <div class="middle_img"><a href="#"><img src="{{ asset('assets/image/' . $occasion[0]) }}" alt="img"><h2>{{ $occasion[1] }}</h2></a></div>
            @endforeach
        </div>
        <div class="col_left_2">
            @foreach ([['middle2.png', 'New Moms'], ['middle4.png', 'Golden Anniversary']] as $occasion)
                <div class="middle_img"><a href="#"><img src="{{ asset('assets/image/' . $occasion[0]) }}" alt="img"><h2>{{ $occasion[1] }}</h2></a></div>
            @endforeach
        </div>
    </div>
</div>
