@php
    $categoryImages = [1, 2, 3, 4, 5, 6, 1, 2, 3, 4, 5, 6, 1, 2, 3, 4];
@endphp

<div class="grid_pattren_img">
    <div class="grid_pattren_img_inner">
        @foreach (array_chunk($categoryImages, 2) as $categoryPair)
            <div class="grid_pattren_img_inner_box">
                @foreach ($categoryPair as $imageNumber)
                    <div class="grid_img_item">
                        <a href="#">
                            <div class="grid_image_box">
                                <img src="{{ asset('assets/image/ring' . $imageNumber . '.png') }}" alt="Ring Jewellery">
                                <h3>Watch Jewellery</h3>
                            </div>
                            <h3>Watch Jewellery</h3>
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
