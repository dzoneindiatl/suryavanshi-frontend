@include('front.includes.head')
@include('front.includes.header')
<link rel="stylesheet" href="{{ asset('assets/css/magiczoomplus.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/components/product-detail/product-detail.css') }}?v={{ file_exists(public_path('assets/css/components/product-detail/product-detail.css')) ? filemtime(public_path('assets/css/components/product-detail/product-detail.css')) : time() }}">

<div class="breadcrumb_main">
	<div class="container">
		<div class="breadcrumb_inner">
			<ul>
				<li class="first"><a href="{{ url('/') }}" title="Home"><span>HOME</span></a></li>
				@if($productcat)<li><a href="{{ route('category.show',['path'=>$productcat->slug]) }}" title="{{ $productcat->name }}"><span>{{ ucfirst($productcat->name) }}</span></a></li>@endif 
                @if($productSubCat)<li><a href="{{ route('category.show',['path'=>$productcat->slug.'/'.$productSubCat->slug]) }}" title="{{ $productSubCat->name }}"><span>{{ ucfirst($productSubCat->name) }}</span></a></li> @endif 
                @if($productChildCat)<li><a href="{{ route('category.show',['path'=>$productcat->slug.'/'.$productSubCat->slug.'/'.$productChildCat->slug]) }}" title="{{ $productChildCat->name }}"><span>{{ ucfirst($productChildCat->name) }}</span></a></li> @endif 
			</ul>
		</div>
	</div>
</div>

<div id="flash-msg" class="alert alert-info d-none position-fixed top-0 start-50 translate-middle-x mt-3 shadow" style="z-index: 10005; min-width: 300px;"></div>

<div class="product_details_main_page">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-5 col-md-5 product_gallery_col mb-4 mb-md-0">
				<div class="app-figure" id="zoom-fig">
					@php
                        $primaryVariantId = \App\Models\ProductVariantValue::where('product_id', $product->id)
                            ->where('is_main', 1)
                            ->value('variant_value_id');

                        $allProductImages = $product->product_main_images
                            ->where('variant_id', $primaryVariantId)
                            ->values();

                        $sortedProductImages = $allProductImages->sortByDesc(function ($img) {
                            return (int) $img->is_front;
                        })->values();

                        $firstImage = $sortedProductImages->first();
                        $firstImageUrl = $firstImage
                            ? asset('uploads/products/' . $firstImage->graphic)
                            : ($product->images['first'] ?? asset('assets/image/placeholder.png'));
				    @endphp

					<div class="product_main_image_holder">
						<a id="Zoom-1"
							class="MagicZoom"
							href="{{ $firstImageUrl }}"
							data-zoom-image-2x="{{ $firstImageUrl }}"
							data-image-2x="{{ $firstImageUrl }}">
							<img src="{{ $firstImageUrl }}"
								alt="{{ $product->name }}" class="default-image"/>
						</a>
					</div>

					<div class="selectors" id="productImageSelectors">
						@foreach($sortedProductImages as $img)
							@php
								$imageUrl = asset('uploads/products/' . $img->graphic);
							@endphp

							<a data-zoom-id="Zoom-1"
								href="{{ $imageUrl }}"
								data-image="{{ $imageUrl }}"
								data-zoom-image-2x="{{ $imageUrl }}"
								data-image-2x="{{ $imageUrl }}"
								class="mz-thumb {{ $loop->first ? 'mz-thumb-selected' : '' }}">
								<img src="{{ $imageUrl }}"
									alt="{{ $product->name }}" class="default-image"/>
							</a>
						@endforeach
					</div>
				</div>
			</div>

			<div class="col-12 col-lg-7 col-md-7 product_info_col">
				<div class="product_detail_right">
					<h1>{{ $product->name }}</h1>

					@php
						if ($product->product_type == 1) {
							$firstImage = getActiveFrontImg($product->id, $product->id);
							$secondImage = getActiveBackImg($product->id, $product->id);
						} else {
							$activeVarientId = activeVarientByProductId($product->id);
							$firstImage = getActiveFrontImg($product->id, $activeVarientId);
							$secondImage = getActiveBackImg($product->id, $activeVarientId);
						}
										
						if ($product->product_type == 2) {
							$priceData = getPriceByActiveVarientId($product->id, $activeVarientId);
							$buying_price = $priceData['buying_price'] ?? $product->buying_price;
							$selling_price = $priceData['selling_price'] ?? $product->selling_price;
							$discount_product = $buying_price - $selling_price;
							$productImages = getActiveVarientImg($product->id, $activeVarientId);
						} else {
							$buying_price = $product->buying_price;
							$selling_price = $product->selling_price;
							$discount_product = $buying_price - $selling_price;
							$productImages = getActiveVarientImg($product->id, $product->id);
						}
										
						$discountText = '';
										
						if (!empty($product->discount) && !empty($product->discount_type)) {
							if ($product->discount_type == 'percentage') {
								$discountText = $product->discount . '% OFF';
							}
							if ($product->discount_type == 'flat') {
								$discountText = '₹' . $product->discount . ' OFF';
							}
						} elseif (!empty($buying_price) && $buying_price > $selling_price) {
							$perc = round((($buying_price - $selling_price) / $buying_price) * 100);
							if ($perc > 0) {
								$discountText = $perc . '% OFF';
							}
						}
					@endphp

					<div class="product_top_box">
						<div class="product_price_wrap">
							<span class="single_product_price" id="productPrice" data-base-price="{{ $selling_price }}">₹{{ number_format((float)$selling_price, 2) }}</span>
							@if(!empty($buying_price) && $buying_price > $selling_price)
								<span class="single_product_original_price cart-country-price" id="pdpStrikedMrp" data-base-amount="{{ $buying_price }}">₹{{ number_format((float)$buying_price, 2) }}</span>
							@endif
							@if(!empty($discountText))
								<span class="single_product_discount_badge" id="discountShow">{{ $discountText }}</span>
							@endif
							<a href="javascript:void(0)" class="open_price_breakup text-decoration-none ms-1" style="font-size: 13px; color: var(--pd-primary); font-weight: 600;">
								<i class="fa fa-info-circle"></i> Price Breakup
							</a>
						</div>

						<div class="product_share">
							<ul>
								<li>
									<a href="javascript:void(0)" class="addtoWishList" data-product-id="{{ $product->id }}" title="Wishlist">
										<i class="fa {{ (!empty($isWishlisted) || in_array($product->id, $isWishlisteddata ?? [])) ? 'fa-heart text-danger' : 'fa-heart-o' }}"></i>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)" id="shareProductBtn" title="Share Product">
										<i class="fa fa-share-alt"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>

					<p class="offer_txt">(MRP Inclusive of all taxes)</p>

					{{-- VARIANT SELECTORS --}}
					<div class="product_variants">
						@if (!empty($productvariants))
                            @foreach ($productvariants as $variant)
                                @php
                                    $variantValues = $variant['variant_values'] ?? [];
                                    $hasMain = collect($variantValues)->where('is_main', 1)->isNotEmpty();
                                    $displayType = (int) ($variant['variant_type'] ?? 0);
                                @endphp

                                @if (count($variantValues))
                                    <div class="product-option">
                                        <div class="option-title">
                                            <h5>{{ $variant['variant_name'] }}: <span class="selected-value" id="selected-value-{{ $variant['variant_id'] ?? $loop->index }}"></span></h5>
                                        </div>

                                        {{-- TYPE 1: ROUND COLOR --}}
                                        @if ($displayType === 1)
                                            <div class="colors variant-round">
                                                @foreach ($variantValues as $k => $variantValue)
                                                    @php
                                                        $isActive = ($hasMain && (int) $variantValue['is_main'] === 1) || (!$hasMain && $k === 0);
                                                        $colorCode = $variantValue['color_code'] ?? '#ddd';
                                                    @endphp

                                                    <label>
                                                        <input
                                                            type="radio"
                                                            name="variant_{{ $variant['variant_id'] ?? $variant['variant_name'] }}"
                                                            value="{{ $variantValue['variant_value_id'] }}"
                                                            class="attribute-input"
                                                            {{ $isActive ? 'checked' : '' }}>

                                                        <span
                                                            class="s-variant color-variant {{ $isActive ? 'active' : '' }}"
                                                            style="background: {{ $colorCode }};"
                                                            data-product-id="{{ $variant['product_id'] ?? $product->id }}"
                                                            data-id="{{ $variantValue['id'] }}"
                                                            data-variant-id="{{ $variant['variant_id'] ?? '' }}"
                                                            data-type="{{ $variant['variant_name'] }}"
                                                            data-value="{{ $variantValue['name'] }}"
                                                            data-vid="{{ $variantValue['variant_value_id'] }}"
                                                            data-value-id="{{ $variantValue['variant_value_id'] }}"
                                                            title="{{ $variantValue['name'] }}"
                                                            onclick="selectVariant(this);checkVariantStock(this);">
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        {{-- TYPE 2: SIZE BOX --}}
                                        @elseif ($displayType === 2)
                                            <div class="sizes variant-box">
                                                @foreach ($variantValues as $k => $variantValue)
                                                    @php
                                                        $isActive = ($hasMain && (int) $variantValue['is_main'] === 1) || (!$hasMain && $k === 0);
                                                    @endphp

                                                    <label>
                                                        <input
                                                            type="radio"
                                                            name="variant_{{ $variant['variant_id'] ?? $variant['variant_name'] }}"
                                                            value="{{ $variantValue['variant_value_id'] }}"
                                                            class="attribute-input"
                                                            {{ $isActive ? 'checked' : '' }}>

                                                        <span
                                                            class="s-variant {{ $isActive ? 'active' : '' }}"
                                                            data-product-id="{{ $variant['product_id'] ?? $product->id }}"
                                                            data-id="{{ $variantValue['id'] }}"
                                                            data-variant-id="{{ $variant['variant_id'] ?? '' }}"
                                                            data-type="{{ $variant['variant_name'] }}"
                                                            data-value="{{ $variantValue['name'] }}"
                                                            data-vid="{{ $variantValue['variant_value_id'] }}"
                                                            data-value-id="{{ $variantValue['variant_value_id'] }}"
                                                            onclick="selectVariant(this);checkVariantStock(this);">
                                                            {{ $variantValue['name'] }}
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        {{-- TYPE 3: ROUND WITH IMAGE --}}
                                        @elseif ($displayType === 3)
                                            <div class="colors variant-round variant-with-image">
                                                @foreach ($variantValues as $k => $variantValue)
                                                    @php
                                                        $isActive = ($hasMain && (int) $variantValue['is_main'] === 1) || (!$hasMain && $k === 0);
                                                        $image = $variantValue['image'] ?? null;
                                                    @endphp

                                                    <label>
                                                        <input
                                                            type="radio"
                                                            name="variant_{{ $variant['variant_id'] ?? $variant['variant_name'] }}"
                                                            value="{{ $variantValue['variant_value_id'] }}"
                                                            class="attribute-input"
                                                            {{ $isActive ? 'checked' : '' }}>

                                                        <span
                                                            class="s-variant {{ $isActive ? 'active' : '' }}"
                                                            data-product-id="{{ $variant['product_id'] ?? $product->id }}"
                                                            data-id="{{ $variantValue['id'] }}"
                                                            data-variant-id="{{ $variant['variant_id'] ?? '' }}"
                                                            data-type="{{ $variant['variant_name'] }}"
                                                            data-value="{{ $variantValue['name'] }}"
                                                            data-vid="{{ $variantValue['variant_value_id'] }}"
                                                            data-value-id="{{ $variantValue['variant_value_id'] }}"
                                                            title="{{ $variantValue['name'] }}"
                                                            onclick="selectVariant(this);checkVariantStock(this);">

                                                            @if ($image)
                                                                <img src="{{ asset('uploads/products/' . $image) }}" alt="{{ $variantValue['name'] }}">
                                                            @else
                                                                {{ $variantValue['name'] }}
                                                            @endif
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        {{-- TYPE 4: ROUND WITH COLOR --}}
                                        @elseif ($displayType === 4)
                                            <div class="colors variant-round">
                                                @foreach ($variantValues as $k => $variantValue)
                                                    @php
                                                        $isActive = ($hasMain && (int) $variantValue['is_main'] === 1) || (!$hasMain && $k === 0);
                                                        $colorCode = $variantValue['color_code'] ?? '#ddd';
                                                    @endphp

                                                    <label>
                                                        <input
                                                            type="radio"
                                                            name="variant_{{ $variant['variant_id'] ?? $variant['variant_name'] }}"
                                                            value="{{ $variantValue['variant_value_id'] }}"
                                                            class="attribute-input"
                                                            {{ $isActive ? 'checked' : '' }}>

                                                        <span
                                                            class="s-variant color-variant {{ $isActive ? 'active' : '' }}"
                                                            style="background: {{ $colorCode }};"
                                                            data-product-id="{{ $variant['product_id'] ?? $product->id }}"
                                                            data-id="{{ $variantValue['id'] }}"
                                                            data-variant-id="{{ $variant['variant_id'] ?? '' }}"
                                                            data-type="{{ $variant['variant_name'] }}"
                                                            data-value="{{ $variantValue['name'] }}"
                                                            data-vid="{{ $variantValue['variant_value_id'] }}"
                                                            data-value-id="{{ $variantValue['variant_value_id'] }}"
                                                            title="{{ $variantValue['name'] }}"
                                                            onclick="selectVariant(this);checkVariantStock(this);">
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        {{-- TYPE 5: BOX WITH COLOR --}}
                                        @elseif ($displayType === 5)
                                            <div class="sizes variant-box-color">
                                                @foreach ($variantValues as $k => $variantValue)
                                                    @php
                                                        $isActive = ($hasMain && (int) $variantValue['is_main'] === 1) || (!$hasMain && $k === 0);
                                                        $colorCode = $variantValue['color_code'] ?? '#ddd';
                                                    @endphp

                                                    <label>
                                                        <input
                                                            type="radio"
                                                            name="variant_{{ $variant['variant_id'] ?? $variant['variant_name'] }}"
                                                            value="{{ $variantValue['variant_value_id'] }}"
                                                            class="attribute-input"
                                                            {{ $isActive ? 'checked' : '' }}>

                                                        <span
                                                            class="s-variant {{ $isActive ? 'active' : '' }}"
                                                            style="background: {{ $colorCode }};"
                                                            data-product-id="{{ $variant['product_id'] ?? $product->id }}"
                                                            data-id="{{ $variantValue['id'] }}"
                                                            data-variant-id="{{ $variant['variant_id'] ?? '' }}"
                                                            data-type="{{ $variant['variant_name'] }}"
                                                            data-value="{{ $variantValue['name'] }}"
                                                            data-vid="{{ $variantValue['variant_value_id'] }}"
                                                            data-value-id="{{ $variantValue['variant_value_id'] }}"
                                                            onclick="selectVariant(this);checkVariantStock(this);">
                                                            {{ $variantValue['name'] }}
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        {{-- TYPE 6: BOX WITH IMAGE --}}
                                        @elseif ($displayType === 6)
                                            <div class="sizes variant-box-image">
                                                @foreach ($variantValues as $k => $variantValue)
                                                    @php
                                                        $isActive = ($hasMain && (int) $variantValue['is_main'] === 1) || (!$hasMain && $k === 0);
                                                        $image = $variantValue['image'] ?? null;
                                                    @endphp

                                                    <label>
                                                        <input
                                                            type="radio"
                                                            name="variant_{{ $variant['variant_id'] ?? $variant['variant_name'] }}"
                                                            value="{{ $variantValue['variant_value_id'] }}"
                                                            class="attribute-input"
                                                            {{ $isActive ? 'checked' : '' }}>

                                                        <span
                                                            class="s-variant {{ $isActive ? 'active' : '' }}"
                                                            data-product-id="{{ $variant['product_id'] ?? $product->id }}"
                                                            data-id="{{ $variantValue['id'] }}"
                                                            data-variant-id="{{ $variant['variant_id'] ?? '' }}"
                                                            data-type="{{ $variant['variant_name'] }}"
                                                            data-value="{{ $variantValue['name'] }}"
                                                            data-vid="{{ $variantValue['variant_value_id'] }}"
                                                            data-value-id="{{ $variantValue['variant_value_id'] }}"
                                                            onclick="selectVariant(this);checkVariantStock(this);">

                                                            @if ($image)
                                                                <img src="{{ asset('uploads/products/' . $image) }}" alt="{{ $variantValue['name'] }}">
                                                            @else
                                                                {{ $variantValue['name'] }}
                                                            @endif
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        {{-- TYPE 7: ONLY RECTANGLE --}}
                                        @elseif ($displayType === 7)
                                            <div class="sizes variant-rectangle">
                                                @foreach ($variantValues as $k => $variantValue)
                                                    @php
                                                        $isActive = ($hasMain && (int) $variantValue['is_main'] === 1) || (!$hasMain && $k === 0);
                                                    @endphp

                                                    <label>
                                                        <input
                                                            type="radio"
                                                            name="variant_{{ $variant['variant_id'] ?? $variant['variant_name'] }}"
                                                            value="{{ $variantValue['variant_value_id'] }}"
                                                            class="attribute-input"
                                                            {{ $isActive ? 'checked' : '' }}>

                                                        <span
                                                            class="s-variant {{ $isActive ? 'active' : '' }}"
                                                            data-product-id="{{ $variant['product_id'] ?? $product->id }}"
                                                            data-id="{{ $variantValue['id'] }}"
                                                            data-variant-id="{{ $variant['variant_id'] ?? '' }}"
                                                            data-type="{{ $variant['variant_name'] }}"
                                                            data-value="{{ $variantValue['name'] }}"
                                                            data-vid="{{ $variantValue['variant_value_id'] }}"
                                                            data-value-id="{{ $variantValue['variant_value_id'] }}"
                                                            onclick="selectVariant(this);checkVariantStock(this);">
                                                            {{ $variantValue['name'] }}
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        {{-- TYPE 8: RECTANGLE WITH IMAGE --}}
                                        @elseif ($displayType === 8)
                                            <div class="sizes variant-rectangle-image">
                                                @foreach ($variantValues as $k => $variantValue)
                                                    @php
                                                        $isActive = ($hasMain && (int) $variantValue['is_main'] === 1) || (!$hasMain && $k === 0);
                                                        $image = $variantValue['image'] ?? null;
                                                    @endphp

                                                    <label>
                                                        <input
                                                            type="radio"
                                                            name="variant_{{ $variant['variant_id'] ?? $variant['variant_name'] }}"
                                                            value="{{ $variantValue['variant_value_id'] }}"
                                                            class="attribute-input"
                                                            {{ $isActive ? 'checked' : '' }}>

                                                        <span
                                                            class="s-variant {{ $isActive ? 'active' : '' }}"
                                                            data-product-id="{{ $variant['product_id'] ?? $product->id }}"
                                                            data-id="{{ $variantValue['id'] }}"
                                                            data-variant-id="{{ $variant['variant_id'] ?? '' }}"
                                                            data-type="{{ $variant['variant_name'] }}"
                                                            data-value="{{ $variantValue['name'] }}"
                                                            data-vid="{{ $variantValue['variant_value_id'] }}"
                                                            data-value-id="{{ $variantValue['variant_value_id'] }}"
                                                            onclick="selectVariant(this);checkVariantStock(this);">

                                                            @if ($image)
                                                                <img src="{{ asset('uploads/products/' . $image) }}" alt="{{ $variantValue['name'] }}">
                                                            @else
                                                                {{ $variantValue['name'] }}
                                                            @endif
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        {{-- TYPE 9: RECTANGLE WITH COLOR --}}
                                        @elseif ($displayType === 9)
                                            <div class="sizes variant-rectangle-color">
                                                @foreach ($variantValues as $k => $variantValue)
                                                    @php
                                                        $isActive = ($hasMain && (int) $variantValue['is_main'] === 1) || (!$hasMain && $k === 0);
                                                        $colorCode = $variantValue['color_code'] ?? '#ddd';
                                                    @endphp

                                                    <label>
                                                        <input
                                                            type="radio"
                                                            name="variant_{{ $variant['variant_id'] ?? $variant['variant_name'] }}"
                                                            value="{{ $variantValue['variant_value_id'] }}"
                                                            class="attribute-input"
                                                            {{ $isActive ? 'checked' : '' }}>

                                                        <span
                                                            class="s-variant {{ $isActive ? 'active' : '' }}"
                                                            style="background: {{ $colorCode }};"
                                                            data-product-id="{{ $variant['product_id'] ?? $product->id }}"
                                                            data-id="{{ $variantValue['id'] }}"
                                                            data-variant-id="{{ $variant['variant_id'] ?? '' }}"
                                                            data-type="{{ $variant['variant_name'] }}"
                                                            data-value="{{ $variantValue['name'] }}"
                                                            data-vid="{{ $variantValue['variant_value_id'] }}"
                                                            data-value-id="{{ $variantValue['variant_value_id'] }}"
                                                            onclick="selectVariant(this);checkVariantStock(this);">
                                                            {{ $variantValue['name'] }}
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        @endif
					</div>

					{{-- QUANTITY SELECTOR --}}
                    @if($product->qty > 0)
                        <div class="product-option quantity-option">
                            <h5>Quantity</h5>
                            <div class="quantity" data-max-quantity="{{ $product->qty }}">
                                <button type="button" class="minus" aria-label="Decrease quantity">-</button>
                                <input type="text" value="1" id="quantity" readonly aria-label="Product quantity">
                                <button type="button" class="plus" aria-label="Increase quantity">+</button>
                            </div>
                        </div>

                        @if($product->qty <= 5)
                            <div class="main-product__block main-product__block-custom_liquid mb-3">
                                <div class="m-product-text">
                                    <div id="stock-notice">
                                        <p id="stock-text"><i class="fa fa-bell-o me-1"></i> Only {{ $product->qty }} left in stock - order soon!</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif  

					{{-- ACTION BUTTONS --}}
                    <div class="product_box_cart">
                        @if((int) $product->in_stock === 1 && ((int) $product->qty > 0 || $hasAvailableVariant))
                            <button type="button" class="btn_add_to_cart addToCartBtn addToCartBtnText add-to-cart"
                                {{ count($productvariants) > 0 ? 'disabled' : '' }}
                                data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}"
                                data-producttype="{{ $product->product_type }}"
                                data-sku="{{ $product->sku }}"
                                data-slug="{{ $product->slug }}"
                                data-price="{{ $buying_price }}"
                                data-salePrice="{{ $selling_price }}"
                                data-stock="{{ $product->qty }}"
                                data-product-in-stock="{{ (int) $product->in_stock }}"
                                data-variant-required="{{ count($productvariants) > 0 ? 'true' : 'false' }}"
                                data-variant-count="{{ count($productvariants) }}"
                                data-cart-state="add"
                                data-discountType="{{ $product->discount_type }}"
                                data-discount="{{ $discount_product }}"
                                data-tax-arr="{{ e(json_encode($categoryTaxes)) }}">
                                <i class="fa fa-shopping-bag"></i> <span>ADD TO CART</span>
                            </button>

                            <button type="button" class="btn_buy_now buyNowBtn"
                                data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}"
                                data-producttype="{{ $product->product_type }}"
                                data-sku="{{ $product->sku }}"
                                data-slug="{{ $product->slug }}"
                                data-price="{{ $buying_price }}"
                                data-salePrice="{{ $selling_price }}"
                                data-discountType="{{ $product->discount_type }}"
                                data-discount="{{ $discount_product }}"
                                data-tax-arr="{{ e(json_encode($categoryTaxes)) }}">
                                <i class="fa fa-bolt"></i> <span>BUY NOW</span>
                            </button>
                        @else 
                            <div class="p-3 w-100 rounded bg-light border border-danger">
                                <p class="text-danger fw-bold mb-0"><i class="fa fa-exclamation-circle me-1"></i> Sorry, this product is currently out of stock</p>
                            </div>
                        @endif 
					</div>

					{{-- PRICE BREAKUP MODAL DRAWER --}}
					<div class="price_breakup_modal" id="price_breakup_modal">
						<div class="price_breakup_modal_bg"></div>
						<div class="price_breakup_modal_inner">
							<div class="price_breakup_modal_head" id="price_breakup_modal_head">
								<p>{{ $product->name }}</p>
								<span id="closePriceBreakup" title="Close"></span>
							</div>
							<div class="price_breakup_modal_bottom">
								<h3 class="gold_breakup_title">Price Breakup Details</h3>
								<ul class="price_componet">
									<li><span class="componet_head">Component</span></li>
									<li><span class="componet_head">Rate</span></li>
									<li><span class="componet_head">Weight</span></li>
									<li><span class="componet_head">Final Value</span></li>
								</ul>
								<ul>
									<li><span>Gold Material</span></li>
									<li><span>₹7,743 / g</span></li>
									<li><span>{{ $product->weight ? $product->weight . ' g' : 'Standard' }}</span></li>
									<li><span>₹{{ number_format((float)$selling_price, 2) }}</span></li>
								</ul>
								<ul class="total_values">
									<li><span>Total Amount</span></li>
									<li><span>-</span></li>
									<li><span>-</span></li>
									<li><span>₹{{ number_format((float)$selling_price, 2) }}</span></li>
								</ul>
							</div>
						</div>
					</div>

					{{-- DELIVERY & STORES PINCODE BOX --}}
					<div class="delivery_stores_box">
						<h3><i class="fa fa-map-marker text-warning"></i> Delivery &amp; Store Availability</h3>
						<div class="delivery_stores_box_inner">
							<div class="delivery_stores_txt">
								<span class="delivery_stores_icon"></span>
								<input type="text" name="location" placeholder="Enter 6-digit Pincode" maxlength="6" value="" class="delivery_stores_input" id="pincodeInput">
								<button type="button" class="btn_delivery_locate" id="btnLocatePincode">Check</button>
							</div>
						</div>
					</div>

					{{-- BRAND TRUST BADGES --}}
					<div class="product_offer_box">
						<div class="product_offer_box_inner">
							<div class="product_offer_icon_top">
								<span class="product_offer_icon"></span>
							</div>
							<h3 class="product_offer_txt">100% Certified</h3>
						</div>
						<div class="product_offer_box_inner">
							<div class="product_offer_icon_top">
								<span class="product_offer_icon1"></span>
							</div>
							<h3 class="product_offer_txt">15 Day Returns</h3>
						</div>
						<div class="product_offer_box_inner">
							<div class="product_offer_icon_top">
								<span class="product_offer_icon2"></span>
							</div>
							<h3 class="product_offer_txt">Lifetime Exchange</h3>
						</div>
						<div class="product_offer_box_inner">
							<div class="product_offer_icon_top">
								<span class="product_offer_icon3"></span>
							</div>
							<h3 class="product_offer_txt">1 Year Warranty</h3>
						</div>
					</div>

					{{-- TABS: PRODUCT DETAILS, BREAKUP, REVIEWS --}}
					<div class="tabs_product">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="product-tab" data-bs-toggle="tab" data-bs-target="#product-tab-pane" type="button" role="tab" aria-controls="product-tab-pane" aria-selected="true">Product Details</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="price-tab" data-bs-toggle="tab" data-bs-target="#price-tab-pane" type="button" role="tab" aria-controls="price-tab-pane" aria-selected="false">Price Breakup</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-tab-pane" type="button" role="tab" aria-controls="reviews-tab-pane" aria-selected="false">Reviews</button>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="product-tab-pane" role="tabpanel" aria-labelledby="product-tab" tabindex="0">
								<div class="pd-description">
									@if(!empty($product->description))
										{!! $product->description !!}
									@elseif(!empty($product->short_description))
										{!! $product->short_description !!}
									@else
										Elegantly crafted jewellery designed to bring timeless radiance and sophistication to every moment. Each piece is meticulously finished with certified materials and uncompromising quality.
									@endif
								</div>
								<div class="product-details-attributes">
									<div class="general-details">
										<i class="fa fa-info-circle me-1"></i> Product Specifications
									</div>
									<div class="general-parent">
										@if(!empty($product->sku))
										<div class="general-desc">
											<p class="g-d mb-0"><strong>SKU Code</strong></p>
											<p class="g-d text-uppercase mb-0">{{ $product->sku }}</p>
										</div>
										@endif
										@if(!empty($product->weight))
										<div class="general-desc">
											<p class="g-d mb-0"><strong>Gross Weight</strong></p>
											<p class="g-d mb-0">{{ $product->weight }}g</p>
										</div>
										@endif
										@if(!empty($product->style))
										<div class="general-desc">
											<p class="g-d mb-0"><strong>Style</strong></p>
											<p class="g-d mb-0">{{ ucfirst($product->style) }}</p>
										</div>
										@endif
										@if(!empty($product->material))
										<div class="general-desc">
											<p class="g-d mb-0"><strong>Material</strong></p>
											<p class="g-d mb-0">{{ ucfirst($product->material) }}</p>
										</div>
										@endif
										@if(!empty($productcat))
										<div class="general-desc">
											<p class="g-d mb-0"><strong>Category</strong></p>
											<p class="g-d mb-0">{{ ucfirst($productcat->name) }}</p>
										</div>
										@endif
										<div class="general-desc">
											<p class="g-d mb-0"><strong>Certification</strong></p>
											<p class="g-d mb-0">100% Certified Authentic</p>
										</div>
									</div>
								</div>
							</div>

							<div class="tab-pane fade" id="price-tab-pane" role="tabpanel" aria-labelledby="price-tab" tabindex="0">
								<div class="product-details-attributes">
									<div class="general-details breakup-custom-header total-custom-value">
										<p class="g-d mb-0">
											<span class="width"><i class="fa fa-diamond me-1"></i> Total Price Breakup</span>
										</p>
										<p class="g-d mb-0 custom-total-value">₹{{ number_format((float)$selling_price, 2) }}</p>
									</div>
									<div class="general-parent">
										<div class="general-desc">
											<p class="g-d mb-0"><span class="width">Base Amount</span></p>
											<p class="g-d text-uppercase mb-0">₹{{ number_format((float)($buying_price ?: $selling_price), 2) }}</p>
										</div>
										@if(!empty($discount_product) && $discount_product > 0)
										<div class="general-desc">
											<p class="g-d mb-0"><span class="width">Discount</span></p>
											<p class="g-d text-uppercase mb-0 text-success">-₹{{ number_format((float)$discount_product, 2) }}</p>
										</div>
										@endif
										<div class="general-desc">
											<p class="g-d mb-0"><span class="width">Taxes</span></p>
											<p class="g-d text-uppercase mb-0">Inclusive of all taxes</p>
										</div>
										<div class="g-description1 grand-cutom-total total-custom-value">
											<p class="g-d mb-0"><span class="width">Final Amount</span></p>
											<p class="g-d mb-0">₹{{ number_format((float)$selling_price, 2) }}</p>
										</div>
									</div>
								</div>
							</div>

							<div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab" tabindex="0">
								<div class="product_rating_tab">
									<div class="product_rating_tab_top">
										<div class="bottom-line-items">
											<span class="rating-stars-container">
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
											</span>
											<span class="reviews-qa-labels-container">
												<span class="reviews-qa-label">{{ count($reviews ?? []) }} Reviews</span>
											</span>
										</div>
										<div class="write-question-review-buttons-container">
											<button type="button" class="write-question-review-button write-review-button">
												<span class="write-question-review-button-text">Write A Review</span>
											</button>
										</div>
									</div>
									<div class="product_rating_tab_bottom">
										<div class="first-review">
											<div class="first-review-stars">
												<span class="stars-wrapper">
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
												</span>
											</div>
											<div class="first-review-content">
												<button type="button" class="write-review-button">Be The First To Write A Review</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

{{-- SIMILAR PRODUCTS --}}
@if(count($similarProducts) > 0)
	<div class="similar_products">
		<div class="container">
			<div class="related_products_head">
				<h2>Similar Products</h2>
			</div>
			<div class="similar_product_inner">
				@foreach($similarProducts as $similar)
					<div class="collection_inner_box">
						<div class="collection_inner_box_img">
							<div class="shop_img_hover">
								<img class="normal_img_shop" src="{{ $similar->images['first'] }}" alt="{{ $similar->name }}">
								<img class="hover_img_shop" src="{{ $similar->images['second'] }}" alt="{{ $similar->name }}">
							</div>
							<div class="collection_inner_box_icon addtoWishList" data-product-id="{{ $similar->id }}">
								<a href="javascript:void(0)" aria-label="Add to Wishlist">
									<i class="fa fa-heart-o"></i>
								</a>
							</div>
							@if($similar->best_seller == 1)
								<div class="collection_best_seller">
									<a href="@if(!empty($similar->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $similar->slug . '.html', 'sku' => $similar->sku]) }}@endif">Best Seller</a>
								</div>
							@endif
							<a href="@if(!empty($similar->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $similar->slug . '.html', 'sku' => $similar->sku]) }}@endif" class="btn_cart_add">View Details</a>
						</div>
						<div class="collection_inner_box_txt">
							<div class="price">
								<span class="price_new cart-country-price" data-base-amount="{{ $similar->selling_price }}">₹{{ number_format((float)$similar->selling_price, 2) }}</span>
								@if(!empty($similar->buying_price) && $similar->buying_price > $similar->selling_price)
									<span class="price_new_cut cart-country-price" data-base-amount="{{ $similar->buying_price }}">₹{{ number_format((float)$similar->buying_price, 2) }}</span>
								@endif
								@php 
									$simDiscount = '';
									if(!empty($similar->discount) && !empty($similar->discount_type)){
										if($similar->discount_type == 'percentage'){
											$simDiscount = $similar->discount."% OFF"; 
										} else {
											$simDiscount = '₹'.$similar->discount.' OFF'; 
										}
									}	
								@endphp
								@if(!empty($simDiscount))	
									<div class="offer_txt1">{{ $simDiscount }}</div>
								@endif 	
							</div>
							<h5>{{ $similar->name }}</h5>
						</div>
					</div>
				@endforeach 		
			</div>
		</div>
	</div>
@endif 	

{{-- RELATED PRODUCTS --}}
@if(count($relatedProducts) > 0)	
	<div class="related_products">
		<div class="container">
			<div class="related_products_head">
				<h2>Related Products</h2>
			</div>
			<div class="related_product_inner">
				@foreach($relatedProducts as $related)
					<div class="collection_inner_box">
						<div class="collection_inner_box_img">
							<div class="shop_img_hover">
								<img class="normal_img_shop" src="{{ $related->images['first'] }}" alt="{{ $related->name }}">
								<img class="hover_img_shop" src="{{ $related->images['second'] }}" alt="{{ $related->name }}">
							</div>
							<div class="collection_inner_box_icon addtoWishList" data-product-id="{{ $related->id }}">
								<a href="javascript:void(0)" aria-label="Add to Wishlist">
									<i class="fa fa-heart-o"></i>
								</a>
							</div>
							@if($related->best_seller == 1)
								<div class="collection_best_seller">
									<a href="@if(!empty($related->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $related->slug . '.html', 'sku' => $related->sku]) }}@endif">Best Seller</a>
								</div>
							@endif 
							<a href="@if(!empty($related->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $related->slug . '.html', 'sku' => $related->sku]) }}@endif" class="btn_cart_add">View Details</a>
						</div>
						<div class="collection_inner_box_txt">
							<div class="price">
								<span class="price_new cart-country-price" data-base-amount="{{ $related->selling_price }}">₹{{ number_format((float)$related->selling_price, 2) }}</span>
								@if(!empty($related->buying_price) && $related->buying_price > $related->selling_price)
									<span class="price_new_cut cart-country-price" data-base-amount="{{ $related->buying_price }}">₹{{ number_format((float)$related->buying_price, 2) }}</span>
								@endif
								@php 
									$relDiscount = '';
									if(!empty($related->discount) && !empty($related->discount_type)){
										if($related->discount_type == 'percentage'){
											$relDiscount = $related->discount."% OFF"; 
										} else {
											$relDiscount = '₹'.$related->discount.' OFF'; 
										}
									}	
								@endphp
								@if(!empty($relDiscount))		
									<div class="offer_txt1">{{ $relDiscount }}</div>
								@endif 
							</div>
							<h5>{{ $related->name }}</h5>
						</div>
					</div>
				@endforeach  		
			</div>
		</div>
	</div>
@endif 	

{{-- RECENTLY VIEWED PRODUCTS --}}
@if(count($recentlyViewedProducts) > 0)	
	<div class="related_products">
		<div class="container">
			<div class="related_products_head">
				<h2>Recently Viewed Products</h2>
			</div>
			<div class="related_product_inner">
				@foreach($recentlyViewedProducts as $recent)
					@php
						$recentProd = Auth::guard('customer')->check() ? ($recent->product ?? $recent) : $recent;
					@endphp
					@if($recentProd)
						<div class="collection_inner_box">
							<div class="collection_inner_box_img">
								<div class="shop_img_hover">
									<img class="normal_img_shop" src="{{ $recentProd->images['first'] ?? asset('assets/image/placeholder.png') }}" alt="{{ $recentProd->name }}">
									<img class="hover_img_shop" src="{{ $recentProd->images['second'] ?? asset('assets/image/placeholder.png') }}" alt="{{ $recentProd->name }}">
								</div>
								<div class="collection_inner_box_icon addtoWishList" data-product-id="{{ $recentProd->id }}">
									<a href="javascript:void(0)" aria-label="Add to Wishlist">
										<i class="fa fa-heart-o"></i>
									</a>
								</div>
								@if(($recentProd->best_seller ?? 0) == 1)
									<div class="collection_best_seller">
										<a href="@if(!empty($recentProd->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $recentProd->slug . '.html', 'sku' => $recentProd->sku]) }}@endif">Best Seller</a>
									</div>
								@endif 
								<a href="@if(!empty($recentProd->sku)){{ route('front-product.detail', ['product' => 'product', 'title' => $recentProd->slug . '.html', 'sku' => $recentProd->sku]) }}@endif" class="btn_cart_add">View Details</a>
							</div>

							<div class="collection_inner_box_txt">
								<div class="price">
									<span class="price_new cart-country-price" data-base-amount="{{ $recentProd->selling_price }}">₹{{ number_format((float)$recentProd->selling_price, 2) }}</span>
									@if(!empty($recentProd->buying_price) && $recentProd->buying_price > $recentProd->selling_price)
										<span class="price_new_cut cart-country-price" data-base-amount="{{ $recentProd->buying_price }}">₹{{ number_format((float)$recentProd->buying_price, 2) }}</span>
									@endif
									@php 
										$recDiscount = '';
										if(!empty($recentProd->discount) && !empty($recentProd->discount_type)){
											if($recentProd->discount_type == 'percentage'){
												$recDiscount = $recentProd->discount."% OFF"; 
											} else {
												$recDiscount = '₹'.$recentProd->discount.' OFF'; 
											}
										}	
									@endphp
									@if(!empty($recDiscount))		
										<div class="offer_txt1">{{ $recDiscount }}</div>
									@endif 
								</div>
								<h5>{{ $recentProd->name }}</h5>
							</div>
						</div>
					@endif
				@endforeach  		
			</div>
		</div>
	</div>
@endif 

{{-- DYNAMIC MODULAR FOOTER --}}
@include('front.includes.footer')

@php
    $minSellingQty = 1;
    $maxSellingQty = 10;
    $couponDiscount = 0;
@endphp

<script>
	window.csrfToken = "{{ csrf_token() }}";
    var addToWish = "{{ route('front-addwish') }}";
    window.isLoggedIn = @json(Auth::guard('customer')->check());
    window.productCartVariantIds = @json($productCartVariantIds ?? []);
   	var addToCart = "{{ route('user.addToCart') }}";
    var getCouponUrl = "{{ route('get.coupon') }}";
    var wishlistUrl = "{{ route('front-user.wishlist') }}";
    var viewCartUrl = "{{ route('product.viewBag') }}";
    var headerSearchUrl = "{{ route('front-header-product-search') }}"; 
    var newBuyNowUrl = "{{ route('product.buynow') }}"; 
    var isOutOfStock = "{{ url('is-outofstock') }}"; 
    var getVarientReaminingQty  = "{{ route('get-variant-remaining-qty') }}"; 
    var minSellingQty = '{{ $minSellingQty }}';
    var maxSellingQty = '{{ $maxSellingQty }}';
    var couponDiscount = '{{ $couponDiscount }}';
    var getVarient = "{{ route('variant.combination.prices') }}";
</script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.3.15/slick.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/magiczoomplus.js') }}"></script>
<script src="{{ asset('assets/js/cart.js') }}"></script>

<script>
$(document).ready(function() {
    if (typeof AOS !== 'undefined') {
        AOS.init({ duration: 1000, once: true });
    }

    // Responsive Slick Carousels
    var slickConfig = {
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        speed: 400,
        infinite: true,
        autoplaySpeed: 5000,
        autoplay: true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    arrows: false
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false
                }
            }
        ]
    };

    if ($('.related_product_inner').length && !$('.related_product_inner').hasClass('slick-initialized')) {
        $('.related_product_inner').slick(slickConfig);
    }
    if ($('.similar_product_inner').length && !$('.similar_product_inner').hasClass('slick-initialized')) {
        $('.similar_product_inner').slick(slickConfig);
    }

    // Price Breakup Modal Toggle
    $(document).on('click', '.open_price_breakup', function(e) {
        e.preventDefault();
        $('#price_breakup_modal').addClass('active');
        $('body').css('overflow', 'hidden');
    });

    $(document).on('click', '.price_breakup_modal_bg, #closePriceBreakup', function() {
        $('#price_breakup_modal').removeClass('active');
        $('body').css('overflow', '');
    });

    // Pincode Check
    $(document).on('click', '#btnLocatePincode', function(e) {
        e.preventDefault();
        var pin = $('#pincodeInput').val().trim();
        if (/^\d{6}$/.test(pin)) {
            showFlashMessage('Delivery available to pincode ' + pin + '. Estimated delivery within 3-5 days.', 'success');
        } else {
            showFlashMessage('Please enter a valid 6-digit postal pincode.', 'warning');
        }
    });

    // Share Product
    $(document).on('click', '#shareProductBtn', function(e) {
        e.preventDefault();
        if (navigator.share) {
            navigator.share({
                title: document.title,
                url: window.location.href
            }).catch(function() {});
        } else if (navigator.clipboard) {
            navigator.clipboard.writeText(window.location.href).then(function() {
                showFlashMessage('Product link copied to clipboard!', 'success');
            }).catch(function() {
                showFlashMessage('URL: ' + window.location.href, 'info');
            });
        }
    });

    // Quantity Stepper
    $('.plus').on('click', function () {
        let quantityBox = $(this).closest('.quantity');
        let input = quantityBox.find('input');
        let maxQuantity = parseInt(quantityBox.data('max-quantity')) || 10;
        let value = parseInt(input.val()) || 1;
        if (value < maxQuantity) {
            input.val(value + 1);
        }
    });

    $('.minus').on('click', function () {
        let input = $(this).siblings('input');
        let value = parseInt(input.val()) || 1;
        if (value > 1) {
            input.val(value - 1);
        }
    });
});
</script>

<script>
    // Buy Now Handler
	$('.buyNowBtn').on('click', function(){
		let button = $(this);
		let productId = button.data('id');
        let selectedVariant = getSelectedVariantsForBuyNow();  
        let quantity = parseInt($('#quantity').val()) || 1;
		button.prop('disabled', true);
		$.ajax({
			url: newBuyNowUrl,
			type: "POST",
			data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
				product_id: productId,
				quantity: quantity,
                selectedVariant: selectedVariant
			},
			success: function(response){
				if(response.success){
					if(window.isLoggedIn){
						window.location.href = response.redirect_url;
					}else{
						window.location.href = "{{ route('front-user.login') }}";
					}
				} else {
					const message = response.message || 'Unable to start checkout. Please try again.';
					showFlashMessage($('<div>').text(message).html(), 'error');
					button.prop('disabled', false);
				}
			},
			error: function(xhr){
				const message = xhr.responseJSON?.message || 'Unable to start checkout. Please try again.';
				showFlashMessage($('<div>').text(message).html(), 'error');
				button.prop('disabled', false);
			}
		});
	});

    function getSelectedVariantsForBuyNow() {
        let selected = {};
        $('.s-variant.active[data-type]').each(function() {
            const $variant = $(this);
            const type = String($variant.attr('data-type') || '').toLowerCase();
            const value = String($variant.attr('data-value') || '');

            if (type && value) {
                selected[type] = value;
            }
        });
        return selected; 
    }

    function checkItemInCart() {
		const $button = $('.addToCartBtn').first();
		const productId = String($button.data('id') || '');
		const selected = typeof getSelectedVariants === 'function' ? getSelectedVariants([], false) : {};
		const selectedIds = typeof getSelectedVariantIds === 'function' ? getSelectedVariantIds() : [];
		let exists = false;
		if (window.isLoggedIn) {
			const selectedKey = selectedIds.slice().sort().join(',');
			exists = (window.productCartVariantIds || []).some(function(ids) {
				return ids.slice().sort().join(',') === selectedKey;
			});
		} else {
			let cartItems = [];
			try {
				cartItems = JSON.parse(localStorage.getItem('cartItems') || '[]');
				if (!Array.isArray(cartItems)) {
					cartItems = [];
				}
			} catch (error) {
				console.error('Unable to read guest cart.', error);
			}
			exists = cartItems.some(function(item) {
                if (String(item.productId) !== productId) {
                    return false;
                }

                const variant = item.selectedVariants || {};
                const existingIds = item.selectedVariantIds || [];
                if (selectedIds.length && existingIds.length) {
                    return selectedIds.slice().sort().join(',') === existingIds.slice().sort().join(',');
                }

                return typeof sameVariantSelection === 'function' ? sameVariantSelection(variant, selected) : false;
			});
		}

		if (typeof setAddToCartButtonState === 'function') {
            setAddToCartButtonState($button, exists);
        }

		return exists;
	}
   
    function formatCountryPrice(inrPrice) {
        const currency = getSelectedCurrency();
        const convertedPrice = Number(inrPrice || 0) * currency.rate;
        return currency.symbol + convertedPrice.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function updateVariantPrice(sellingPrice, buyingPrice) {
        const currency = getSelectedCurrency();
        if (!currency.rate || currency.rate <= 0) {
            return;
        }
        $('#productPrice').text(formatCountryPrice(sellingPrice));
    }
    
    function updateCartCountryPrices() {
        const currency = getSelectedCurrency();
        if (!currency.rate || currency.rate <= 0) {
            return;
        }
        $('.cart-country-price').each(function () {
            const baseAmount = Number($(this).attr('data-base-amount')) || 0;
            const convertedAmount = baseAmount * currency.rate;
            $(this).text(
                currency.symbol + convertedAmount.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                })
            );
        });
    }

    function getSelectedCurrency() {
		let country = {};
		try {
			country = JSON.parse($('#countryData').val() || '{}'); 
		} catch (e) {
			country = {};
		}
		const currencyCode = country.currency_code || 'INR';
		const currencySymbol = country.currency_symbol || '₹';
        const rate = country.exchange_rates || 0; 
		return {
			code: currencyCode,
			symbol: currencySymbol,
			rate: currencyCode === 'INR' ? 1 : rate
		};
	}
	
    window.currentSellingPriceINR = Number(@json($selling_price));
    window.currentBuyingPriceINR = Number(@json($buying_price));
    window.variantRequestVersion = 0;
    window.variantStockRequestVersion = 0;

    $(document).ready(function () {
        updateVariantPrice(
            window.currentSellingPriceINR,
            window.currentBuyingPriceINR
        );
        updateCartCountryPrices(); 
    });

    $(document).on('click', '.country-option', function () {
        updateVariantPrice(
            window.currentSellingPriceINR,
            window.currentBuyingPriceINR
        );
        updateCartCountryPrices();
    });

    function selectVariant(el) {
        const productId = el.dataset.productId;
        const variantId = el.dataset.variantId;
        const variantValueId = el.dataset.vid;
        const value = el.dataset.value;
        const valueId = el.dataset.id;
        const type = (el.dataset.type || '').toLowerCase();

        $('.s-variant[data-variant-id="' + variantId + '"]').removeClass('active');
        $(el).addClass('active');

        $('input.attribute-input[name="variant_' + variantId + '"]').prop('checked', false);
        $('input.attribute-input[name="variant_' + variantId + '"][value="' + variantValueId + '"]').prop('checked', true);

        const selectedSpan = document.getElementById('selected-value-' + variantId);
        if (selectedSpan) {
            selectedSpan.textContent = value;
        }

        const selectedVariantIds = $('.s-variant.active').map(function() {
            return $(this).data('vid');
        }).get();
        const requestVersion = ++window.variantRequestVersion;

        checkItemInCart();
        $('.addToCartBtn').prop('disabled', true);
        $.ajax({
            url: getVarient,
            type: 'POST',
            data: JSON.stringify({
                product_id: productId,
                vsku: selectedVariantIds,
                variant_id: variantId,
                _token: window.csrfToken
            }),
            contentType: 'application/json',
            success: function(response) {
                if (requestVersion !== window.variantRequestVersion) {
                    return;
                }
                const combination = response?.combination;
                if (!combination) return;
                const { selling_price, price, sku, discount, discount_type, qty, is_out_of_stock } = combination;

                const buyingPrice = Number(price) || 0;
                const sellingPrice = Number(selling_price) || 0;
                window.currentSellingPriceINR = sellingPrice;
                window.currentBuyingPriceINR = buyingPrice;
                updateVariantPrice(sellingPrice, buyingPrice);

                const $addToCartBtn = $('.addToCartBtn');
                $addToCartBtn.attr('data-price', buyingPrice);
                $addToCartBtn.attr('data-saleprice', sellingPrice);
                $addToCartBtn.attr('data-discounttype', discount_type);
                $addToCartBtn.attr('data-discount', discount);

                const stockQty = Number(is_out_of_stock) === 1 ? 0 : parseInt(qty || 0);
                $addToCartBtn.attr('data-stock', stockQty);
                $('#quantity').attr('max', stockQty);
                $('.quantity[data-max-quantity]').attr('data-max-quantity', stockQty);
                if (stockQty > 0 && (parseInt($('#quantity').val(), 10) || 1) > stockQty) {
                    $('#quantity').val(stockQty);
                }
                const minimumQty = parseInt(minSellingQty || 1);

                const productOut = Number($addToCartBtn.attr('data-product-in-stock')) !== 1;
                if (stockQty <= 0 || productOut) {
                    $('.varient_less_than_min_qty_notice').html('Out Of Stock');
                    $('.add-to-cart').addClass('d-none disabled-action');
                    $('.addToCartBtn').prop('disabled', true);
                } else if (minimumQty > stockQty) {
                    $('.varient_less_than_min_qty_notice')
                        .html('<b>Only ' + stockQty + ' items are left</b>');
                    $('.add-to-cart').removeClass('d-none disabled-action');
                    $('.addToCartBtn').prop('disabled', false);
                } else {
                    $('.varient_less_than_min_qty_notice').html('');
                    $('.add-to-cart').removeClass('d-none');
                    $('.addToCartBtn').prop('disabled', false);
                }
            },
            error: function(xhr) {
                if (requestVersion === window.variantRequestVersion) {
                    $('.addToCartBtn').prop('disabled', true);
                }
                console.error('Variant fetch error:', xhr.responseText);
            }
        });

        if (type === 'gemstone name' || type === 'gemstone' || type === 'color' || type === 'colour') {
            updateVariantImages(productId, variantValueId);
        }
    }

	$(document).ready(function () {
	    checkItemInCart();
		const $activeVariant = $('.s-variant.active').first();
		if ($activeVariant.length) {
			selectVariant($activeVariant.get(0));
			const type = ($activeVariant.data('type') || '').toLowerCase();
			const productId = $activeVariant.data('product-id'); 
			const variantValueId = $activeVariant.data('vid');
			if (type === 'color' || type === 'colour' || type === 'gemstone name') {
				updateVariantImages(productId, variantValueId);
			}
		}

        // Set initial option labels
        $('.s-variant.active').each(function() {
            const varId = $(this).data('variant-id');
            const val = $(this).data('value');
            if (varId && val) {
                $('#selected-value-' + varId).text(val);
            }
        });
	});

	function updateVariantImages(productId, variantValueId) {
        $.ajax({
            url: "{{ route('front-product-variant-image') }}",
            type: "GET",
            data: {
                product_id: productId,
                variant_value_id: variantValueId
            },
            success: function(response) {
                if (!response.images || response.images.length === 0) {
                    return;
                }

                const firstImage = response.images[0];
                const zoomLink = document.getElementById('Zoom-1');
                if (zoomLink) {
                    zoomLink.setAttribute('href', firstImage);
                    zoomLink.setAttribute('data-zoom-image-2x', firstImage);
                    zoomLink.setAttribute('data-image-2x', firstImage);

                    const zoomImg = zoomLink.querySelector('img');
                    if (zoomImg) {
                        zoomImg.setAttribute('src', firstImage);
                        zoomImg.removeAttribute('srcset');
                    }
                }

                let html = '';
                response.images.forEach(function(image, index) {
                    html += `
                        <a data-zoom-id="Zoom-1"
                           href="${image}"
                           data-image="${image}"
                           data-zoom-image-2x="${image}"
                           data-image-2x="${image}"
                           class="mz-thumb ${index === 0 ? 'mz-thumb-selected' : ''}">
                            <img src="${image}" alt="" class="default-image">
                        </a>
                    `;
                });

                $('#productImageSelectors').html(html);
                if (typeof MagicZoom !== 'undefined') {
                    try {
                        MagicZoom.refresh('Zoom-1');
                    } catch (e) {
                        try {
                            MagicZoom.refresh();
                        } catch (e2) {}
                    }
                }

                setTimeout(function() {
                    const zoomLinkAfterRefresh = document.getElementById('Zoom-1');
                    if (!zoomLinkAfterRefresh) return;
                    zoomLinkAfterRefresh.setAttribute('href', firstImage);
                    zoomLinkAfterRefresh.setAttribute('data-image', firstImage);
                    zoomLinkAfterRefresh.setAttribute('data-zoom-image-2x', firstImage);
                    zoomLinkAfterRefresh.setAttribute('data-image-2x', firstImage);
                    const imgAfterRefresh = zoomLinkAfterRefresh.querySelector('img');
                    if (imgAfterRefresh) {
                        imgAfterRefresh.setAttribute('src', firstImage);
                        imgAfterRefresh.removeAttribute('srcset');
                    }
                }, 100);
            },
            error: function(xhr) {
                console.error('Variant image error:', xhr.responseText);
            }
        });
    }

    function checkVariantStock(el) {
		const productId = el.dataset.productId || $('#product_id').val();
		const selectedVariantIds = $('.s-variant.active').map(function() {
			return $(this).data('vid');
		}).get();
		const requestVersion = ++window.variantStockRequestVersion;
		$.ajax({
			url: "{{ route('variant.stock.check') }}",
			type: "POST",
			data: {
				_token: "{{ csrf_token() }}",
				product_id: productId,
				selected_variant_ids: selectedVariantIds
			},
			success: function(res) {
				if (requestVersion !== window.variantStockRequestVersion) {
					return;
				}
				$('.s-variant').removeClass('out-of-stock');
				if (res.out_of_stock) {
					$(el).addClass('out-of-stock');
					$('#variantOutOfStock').removeClass('d-none');
					$('.add-to-cart').addClass('disabled-action');
					$('.addToCartBtn').prop('disabled', true);
				} else {
					$('#variantOutOfStock').addClass('d-none');
					$('.add-to-cart').removeClass('disabled-action');
				}
			},
			error: function(xhr) {
				console.error('Variant stock check error:', xhr.responseText);
			}
		});
	}

	function showFlashMessage(msg, type = 'success') {
        const flash = document.getElementById('flash-msg');
        if (!flash) return;

        const icons = {
            success: '<i class="fa fa-check-circle me-1"></i>',
            error: '<i class="fa fa-times-circle me-1"></i>',
            warning: '<i class="fa fa-exclamation-triangle me-1"></i>',
            info: '<i class="fa fa-info-circle me-1"></i>'
        };

        const alertTypes = {
            success: 'alert-success',
            error: 'alert-danger',
            warning: 'alert-warning',
            info: 'alert-info'
        };

        const icon = icons[type] || icons.info;
        const alertClass = alertTypes[type] || alertTypes.info;

        flash.classList.remove('d-none', 'alert-success', 'alert-danger', 'alert-warning', 'alert-info');
        flash.classList.add(alertClass);
        flash.innerHTML = `${icon} <span>${msg}</span>`;
        clearTimeout(window.flashMessageTimer);
        window.flashMessageTimer = setTimeout(function() {
            flash.classList.add('d-none');
        }, 3500);
    }

	$(document).off('click', '.addtoWishList').on('click', '.addtoWishList', function () {
        const productId = this.getAttribute('data-product-id');
        const heartIcon = this.querySelector('i');

        if (!window.isLoggedIn) {
            window.location.href = "{{ route('front-user.login') }}";
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
                showFlashMessage("Product added to wishlist", "success");
                if (heartIcon) {
                    heartIcon.classList.remove('fa-heart-o');
                    heartIcon.classList.add('fa-heart', 'text-danger');
                }
            } else if (data.status === 'removed') {
                showFlashMessage("Product removed from wishlist", "warning");
                if (heartIcon) {
                    heartIcon.classList.remove('fa-heart', 'text-danger');
                    heartIcon.classList.add('fa-heart-o');
                }
            }
            localStorage.setItem('wishlistCount', JSON.stringify(data.wishlistCount));
            $(".wishlist-count").html(data.wishlistCount || 0);
        })
        .catch(error => {
            console.error("Wishlist error:", error);
        });
    });
</script>
</body>
</html>