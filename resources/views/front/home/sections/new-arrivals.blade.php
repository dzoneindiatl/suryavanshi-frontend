@php
    $newArrivalProducts = array_fill(0, 6, [
        'image' => 'collection_img1.webp',
        'price' => '₹75,317',
        'name' => 'Modern Gleam Diamond Bangle',
    ]);
@endphp

<div class="new_collection_main">
    <h2>New Arrival Products</h2>
    <div class="new_collection_main_inner">
        @foreach ($newArrivalProducts as $product)
            <div class="collection_inner_box">
                <div class="collection_inner_box_img">
                    <img src="{{ asset('assets/image/' . $product['image']) }}" alt="img">
                    <div class="collection_inner_box_icon">
                        <a href="#"><i class="fa fa-heart-o"></i></a>
                        <a href="#"><i class="fa fa-eye"></i></a>
                    </div>
                    <div class="collection_arrival_seller"><a href="#">New Arrival</a></div>
                </div>
                <div class="collection_inner_box_txt">
                    <div class="price"><span>{{ $product['price'] }}</span></div>
                    <h5>{{ $product['name'] }}</h5>
                </div>
            </div>
        @endforeach
    </div>
</div>
