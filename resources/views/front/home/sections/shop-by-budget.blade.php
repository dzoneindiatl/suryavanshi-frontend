@php
    $budgetItems = [
        ['class' => 'shop_budget_list1', 'image' => 'dl-3.webp'],
        ['class' => 'shop_budget_list2', 'image' => 'w2.webp'],
        ['class' => 'shop_budget_list3', 'image' => 'w7.webp'],
        ['class' => 'shop_budget_list4', 'image' => 'w6.webp'],
    ];
@endphp

<div class="shop_by_budget_main">
    <div class="shop_by_budget_main_inner">
        <div class="best_seller_product_head"><h2>Shop By Budget</h2></div>
        <div class="shop_budget_list">
            @foreach ($budgetItems as $item)
                <div class="shop_budget_list_inner {{ $item['class'] }}">
                    <div class="shop_budget_list_img"><img src="{{ asset('assets/image/' . $item['image']) }}" alt=""></div>
                    <h3>Diamond Bangles</h3>
                </div>
            @endforeach
        </div>
    </div>
</div>
