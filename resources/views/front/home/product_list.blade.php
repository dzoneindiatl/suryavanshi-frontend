@include('front.includes.head')
@include('front.includes.header')

<div class="breadcrumb_main">
	<div class="container">
		<div class="breadcrumb_inner">
			<ul>
				<li class="first"><a href="{{ url('/') }}" title="Home"><span>HOME</span></a></li>
				@if($category)<li><a href="{{ route('category.show',['path'=>$category->slug]) }}" title="{{ $category->name }}"><span>{{ ucfirst($category->name) }}</span></a></li>@endif 
                @if($subCategory)<li><a href="{{ route('category.show',['path'=>$category->slug.'/'.$subCategory->slug]) }}" title="{{ $subCategory->name }}"><span>{{ ucfirst($subCategory->name) }}</span></a></li> @endif 
                @if($subChildCategory)<li><a href="{{ route('category.show',['path'=>$category->slug.'/'.$subCategory->slug.'/'.$subChildCategory->slug]) }}" title="{{ $subChildCategory->name }}"><span>{{ ucfirst($subChildCategory->name) }}</span></a></li> @endif 
			</ul>
		</div>
	</div>
</div>
<div id="flash-msg" class="alert alert-info d-none"></div>
<div class="banner_top_main">
	<div class="container">
		<div class="banner_top_inner">
			<a href="#">
				<img src="{{ asset('assets/image/top_banner.webp') }}" alt="img">
			</a>
		</div>
	</div>
</div>

<div class="shop_top_head">
	<div class="container">
		<div class="shop_top_head_left">
	    <h1 class="shop_category_name">
	      <span class="c-name"></span>
	    </h1>
	    <div class="collection_product_count">
	      <div class="shop_product_count_block">
	          (<span class="shop_items_quantity">{{ $totalResults }}</span>
	          <span class="shop_product_count">Results</span>)
	      </div>
	    </div>
	    <div class="shop_right_sorting">
	    	<div class="dropdown">
				<button class="btn_drop_sorting dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{ ['new_arrivals' => "What's New", 'low_high' => 'Price Low to High', 'high_low' => 'Price High to Low'][request('sortBy')] ?? 'Popular' }}</button>
				<ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" data-sort-by="new_arrivals">What's New</a></li>
                    <li><a class="dropdown-item" href="#" data-sort-by="">Popular</a></li>
                    <li><a class="dropdown-item" href="#" data-sort-by="low_high">Price Low to High</a></li>
                    <li><a class="dropdown-item" href="#" data-sort-by="high_low">Price High to Low</a></li>
				</ul>
			</div>
	    </div>
	  </div>
	</div>
</div>
<div class="collection_main_page">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
					<div class="filter_left_sidebar">
						<h4 class="filter_head">Filters</h4>
						<form id="collection-filter-form" method="GET" action="{{ url()->current() }}">
							<input type="hidden" name="sortBy" value="{{ request('sortBy', '') }}">
							<div class="filter_left_sidebar_inner">
							<div class="filter_left_sidebar_box">
								<div class="inner_filter_sec">
									<h5>Price</h5>
									<div class="filter_label_val">
										<div class="filter_toggle_button">
											<input type="radio" name="price_range" id="price1" value="0-10000" {{ request('price_range') === '0-10000' ? 'checked' : '' }}>
											<label for="price1">Under ₹10,000</label>
										</div>
									</div>
									<div class="filter_label_val">
										<div class="filter_toggle_button">
											<input type="radio" name="price_range" id="price2" value="10001-25000" {{ request('price_range') === '10001-25000' ? 'checked' : '' }}>
											<label for="price2">₹10,001 – ₹25,000</label>
										</div>
									</div>
									<div class="filter_label_val">
										<div class="filter_toggle_button">
											<input type="radio" name="price_range" id="price3" value="25001-50000" {{ request('price_range') === '25001-50000' ? 'checked' : '' }}>
											<label for="price3">₹25,001 – ₹50,000</label>
										</div>
									</div>
									<div class="filter_label_val">
										<div class="filter_toggle_button">
											<input type="radio" name="price_range" id="price4" value="50001-99999999" {{ request('price_range') === '50001-99999999' ? 'checked' : '' }}>
											<label for="price4">Above ₹50,000</label>
										</div>
									</div>
								</div>
							</div>
							@if($variantColor->isNotEmpty())
							<div class="filter_left_sidebar_box">
								<div class="inner_filter_sec">
									<h5>Color</h5>
									@foreach($variantColor as $color)
										<div class="filter_label_val">
											<div class="filter_toggle_button">
												<input type="checkbox" name="variantValuesColor[]" id="color-{{ $color->id }}" value="{{ $color->id }}" {{ in_array($color->id, (array) request('variantValuesColor', [])) ? 'checked' : '' }}>
												<label for="color-{{ $color->id }}">{{ $color->name }}</label>
											</div>
										</div>
									@endforeach
								</div>
							</div>
							@endif
							
							@foreach($attributes as $attribute)
								@if($attribute->attribute_values->isNotEmpty())
							<div class="filter_left_sidebar_box">
								<div class="inner_filter_sec">
									<h5>{{ $attribute->name }}</h5>
									@foreach($attribute->attribute_values as $attributeValue)
										<div class="filter_label_val">
											<div class="filter_toggle_button">
												<input type="checkbox" name="attribute_values[{{ $attribute->id }}][]" id="attribute-{{ $attribute->id }}-{{ $attributeValue->id }}" value="{{ $attributeValue->id }}" {{ in_array($attributeValue->id, (array) request('attribute_values.'.$attribute->id, [])) ? 'checked' : '' }}>
												<label for="attribute-{{ $attribute->id }}-{{ $attributeValue->id }}">{{ $attributeValue->name }}</label>
											</div>
										</div>
									@endforeach
									</div>
								</div>
								@endif
							@endforeach
							</div>
							<button type="button" id="clear-collection-filters" class="btn btn-link">Clear filters</button>
						</form>
						</div>
			</div>
			<div class="col-md-9">
				<div class="row">
                    @if(count($results) > 0)
                        @foreach($results as $result)
							<div class="col-md-4">
								<div class="collection_inner_box">
									<div class="collection_inner_box_img">
										<div class="shop_img_hover">
											<img class="normal_img_shop" src="{{ $result->images['first'] }}" alt="img">
											<img class="hover_img_shop" src="{{ $result->images['second'] }}" alt="img">
										</div>
										<div class="collection_inner_box_icon addtoWishList" data-product-id="{{ $result->id }}">
											<a href="#"><i class="fa fa-heart-o"></i></a>
										</div>
										@if($result->best_seller == 1)
											<div class="collection_best_seller">
												<a href="@if(!empty($result->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $result->slug . '.html', 'sku' => $result->sku]) }}@endif">Best Seller</a>
											</div>
										@endif
										@if($result->qty >= 1)
											<a href="@if(!empty($result->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $result->slug . '.html', 'sku' => $result->sku]) }}@endif" class="btn_cart_add">Add To Cart</a>
										@endif	
									</div>
									<div class="collection_inner_box_txt">
										@if($result->qty < 1)
											<p class="text-danger fw-bold" style="padding-top:10px; ">  Sorry This Product is Out Of Stock !</p>
										@endif 
										<div class="price">
											<span class="price_new currency-price" data-price-inr="{{ $result->selling_price }}">₹ {{ number_format($result->selling_price,  2) }}</span>
											<span class="price_new_cut currency-price" data-price-inr="{{ $result->buying_price }}">₹ {{ number_format($result->buying_price, 2) }}</span>
											<div class="offer_txt1">
												@php
													$discount = "";
													if (!empty($result->discount) && !empty($result->discount_type)) {
														if ($result->discount_type == 'percentage') {
															$discount = $result->discount . '% OFF';
														} else {
															$discount = '₹' . $result->discount . ' OFF';
														}
													}
												@endphp
												{{ $discount }}
											</div>
										</div>
										<h5>{{ $result->name }}</h5>
									</div>
								</div>
							</div>
						@endforeach  
					@else  
                        <div class="col-md-4">
                            <h4>NO Product Found</h4>    
                        </div>    
                    @endif 
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.3.15/slick.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
@include('front.includes.script')
<script>
	document.getElementById('collection-filter-form').addEventListener('change', function (event) {
		if (event.target.matches('input[type="checkbox"], input[type="radio"]')) {
			this.submit();
		}
	});

	document.querySelectorAll('[data-sort-by]').forEach(function (sortOption) {
		sortOption.addEventListener('click', function (event) {
			event.preventDefault();
			var filterForm = document.getElementById('collection-filter-form');
			filterForm.querySelector('[name="sortBy"]').value = this.dataset.sortBy;
			filterForm.submit();
		});
	});

	document.getElementById('clear-collection-filters').addEventListener('click', function () {
		window.location.href = "{{ url()->current() }}";
	});
</script>
{{-- <script>
	isLoggedIn = "{{ Auth::guard('customer')->check() ? true : false }}";
</script> --}}
{{-- <script>
	$(document).off('click', '.addtoWishList').on('click', '.addtoWishList', function () {
        const productId = this.getAttribute('data-product-id');
        const heartIcon = this.querySelector('i');
        if (!isLoggedIn) {
            window.location.href = '/login';
            return;
        }
        
        fetch(addToWish, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => {
            if (!response.ok) throw new Error("Something went wrong");
            return response.json();
        })
        .then(data => { 
            if (data.status === 'added') {
                showFlashMessage("Product added in wishlist");
                heartIcon.classList.remove('fa-regular');
                heartIcon.classList.add('fa-solid');
            } else if (data.status === 'removed') {
                showFlashMessage("Product remove in wishlist", "warning");
                heartIcon.classList.remove('fa-solid');
                heartIcon.classList.add('fa-regular');
            }
            localStorage.setItem('wishlistCount', JSON.stringify(data.wishlistCount));
            displayWishlistItem();
        })
        .catch(error => {
            console.error("Wishlist error:", error);
        });
    });
</script> --}}
</body>
</html>