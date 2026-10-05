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
				<button class="btn_drop_sorting dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Popular</button>
				<ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">What's New</a></li>
                    <li><a class="dropdown-item" href="#">Popular</a></li>
                    <li><a class="dropdown-item" href="#">Price Low to High</a></li>
                    <li><a class="dropdown-item" href="#">Price High to Low</a></li>
                    <li><a class="dropdown-item" href="#">Discount</a></li>
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
					<div class="filter_left_sidebar_inner">
						<div class="filter_left_sidebar_box">
							<div class="inner_filter_sec">
								<h5>Price</h5>
								<div class="filter_label_val">
									<div class="filter_toggle_button">
										<input type="checkbox" name="price" id="price1">
										<label for="price1">Below <span class="rupees"><i class="fa fa-inr" aria-hidden="true"></i></span>  10,000 <span class="filter_items_count">(26)</span></label>
									</div>
								</div>
								<div class="filter_label_val">
									<div class="filter_toggle_button">
										<input type="checkbox" name="price" id="price2">
										<label for="price2">Below <span class="rupees"><i class="fa fa-inr" aria-hidden="true"></i></span>  10,000 <span class="filter_items_count">(26)</span></label>
									</div>
								</div>
							</div>
						</div>
						<div class="filter_left_sidebar_box">
							<div class="inner_filter_sec">
								<h5>Type</h5>
								<div class="filter_label_val">
									<div class="filter_toggle_button">
										<input type="checkbox" name="price" id="type1">
										<label for="type1">Watch Accessory <span class="filter_items_count">(45)</span></label>
									</div>
								</div>
								<div class="filter_label_val">
									<div class="filter_toggle_button">
										<input type="checkbox" name="price" id="type2">
										<label for="type2">Mangalsutra <span class="filter_items_count">(2)</span></label>
									</div>
								</div>
							</div>
						</div>
						<div class="filter_left_sidebar_box">
							<div class="inner_filter_sec">
								<h5>Metal</h5>
								<div class="filter_label_val">
									<div class="filter_toggle_button">
										<input type="checkbox" name="price" id="metal1">
										<label for="metal1">Gold <span class="filter_items_count">(46)</span></label>
									</div>
								</div>
								<div class="filter_label_val">
									<div class="filter_toggle_button">
										<input type="checkbox" name="price" id="metal2">
										<label for="metal2">Rose Gold <span class="filter_items_count">(50)</span></label>
									</div>
								</div>
							</div>
						</div>
						<div class="filter_left_sidebar_box">
							<div class="inner_filter_sec">
								<h5>Gender</h5>
								<div class="filter_label_val">
									<div class="filter_toggle_button">
										<input type="checkbox" name="price" id="gender1">
										<label for="gender1">Men <span class="filter_items_count">(6)</span></label>
									</div>
								</div>
								<div class="filter_label_val">
									<div class="filter_toggle_button">
										<input type="checkbox" name="price" id="gender2">
										<label for="gender2">Women <span class="filter_items_count">(4)</span></label>
									</div>
								</div>
							</div>
						</div>
					</div>
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
                                        <div class="collection_inner_box_icon addtoWishList">
                                            <a href="#">
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                        </div>
										@if($result->best_seller == 1)
											<div class="collection_best_seller">
												<a href="@if(!empty($result->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $result->slug . '.html', 'sku' => $result->sku]) }}@endif">  Best Seller  </a>
											</div>
										@endif
                                        	<a href="@if(!empty($result->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $result->slug . '.html', 'sku' => $result->sku]) }}@endif" class="btn_cart_add">Add To Cart</a>
                                    </div>
                                    <div class="collection_inner_box_txt">
                                        <div class="price">
                                            <span class="price_new">₹ {{ $result->buying_price }}</span>
                                            <span class="price_new_cut">₹ {{ $result->selling_price }}</span>
                                            <div class="offer_txt1">
                                            @php 
                                                $discount ="";
                                                if(!empty($result->discount) && !empty($result->discount_type)){
                                                    if($result->discount_type == 'percentage'){
                                                        $discount = $result->discount.'% OFF'; 
                                                    }
                                                    else{
                                                        $discount ='₹'.$result->discount. ' OFF'; 
                                                    }
                                                    
                                                }
                                            @endphp    
                                                {{ $discount }}</div>
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
</body>
</html>