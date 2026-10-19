@include('front.includes.head')
@include('components.header.header')

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
				<img src="{{ asset('assets/image/top_banner.webp') }}" alt="Top Banner" loading="lazy">
			</a>
		</div>
	</div>
</div>

<div class="shop_top_head">
	<div class="container">
		<div class="shop_top_head_wrap">
			<div class="shop_title_and_count">
				<h1 class="shop_category_name">
					{{ $subChildCategory->name ?? $subCategory->name ?? $category->name ?? 'Jewellery Collection' }}
				</h1>
				<span class="shop_items_badge">({{ $totalResults }} {{ $totalResults === 1 ? 'item' : 'items' }})</span>
			</div>

			<div class="shop_actions_bar">
				<button type="button" class="btn_filter_mobile_trigger" id="openMobileFilterBtn" aria-label="Open filter sidebar">
					<i class="fa fa-sliders" aria-hidden="true"></i>
					<span>Filters</span>
					<span class="filter_active_indicator" id="filterActiveCount" style="display: none;">0</span>
				</button>

				<div class="dropdown shop_sort_dropdown">
					<button class="btn_drop_sorting dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-sort-amount-desc d-inline-block d-md-none me-1" aria-hidden="true"></i>
						<span>
							@switch(request('sortBy'))
								@case('new_arrivals') What's New @break
								@case('best_seller') Best Seller @break
								@case('low_high') Price: Low to High @break
								@case('high_low') Price: High to Low @break
								@case('trending') Trending @break
								@default Popular
							@endswitch
						</span>
					</button>
					<ul class="dropdown-menu dropdown-menu-end">
						<li><a class="dropdown-item {{ !request('sortBy') || request('sortBy') == 'popular' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['sortBy' => 'popular']) }}">Popular</a></li>
						<li><a class="dropdown-item {{ request('sortBy') == 'new_arrivals' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['sortBy' => 'new_arrivals']) }}">What's New</a></li>
						<li><a class="dropdown-item {{ request('sortBy') == 'best_seller' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['sortBy' => 'best_seller']) }}">Best Seller</a></li>
						<li><a class="dropdown-item {{ request('sortBy') == 'low_high' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['sortBy' => 'low_high']) }}">Price: Low to High</a></li>
						<li><a class="dropdown-item {{ request('sortBy') == 'high_low' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['sortBy' => 'high_low']) }}">Price: High to Low</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Backdrop for Mobile/Tablet Filter Drawer -->
<div class="filter_drawer_backdrop" id="filterDrawerBackdrop"></div>

<div class="collection_main_page">
	<div class="container">
		<div class="collection_layout_grid">
			<!-- Modern Filter Drawer / Left Sidebar -->
			<aside class="filter_sidebar_drawer" id="filterSidebarDrawer" aria-label="Filters">
				<form id="filterForm" method="GET" action="{{ url()->current() }}">
					@if(request('sortBy'))
						<input type="hidden" name="sortBy" value="{{ request('sortBy') }}">
					@endif

					<div class="filter_drawer_header">
						<div class="filter_header_title">
							<i class="fa fa-sliders" aria-hidden="true"></i>
							<span>Filters</span>
							<span class="filter_applied_badge" id="filterAppliedBadge"></span>
						</div>
						<div class="filter_header_actions">
							<a href="{{ url()->current() }}" class="btn_filter_clear_link">Reset</a>
							<button type="button" class="btn_filter_close" id="closeMobileFilterBtn" aria-label="Close filters">
								<i class="fa fa-times" aria-hidden="true"></i>
							</button>
						</div>
					</div>

					<div class="filter_sidebar_scroll">
						<!-- Price Filter Accordion -->
						<div class="filter_group_box">
							<div class="filter_group_header">
								<h6>Price</h6>
								<i class="fa fa-chevron-down filter_chevron"></i>
							</div>
							<div class="filter_group_content">
								@php $selectedPrice = request('price_range'); @endphp
								<div class="filter_option_item">
									<label class="custom_radio_label">
										<input type="radio" name="price_range" value="" {{ empty($selectedPrice) ? 'checked' : '' }}>
										<span class="radio_custom"></span>
										<span class="filter_text">All Prices</span>
									</label>
								</div>
								<div class="filter_option_item">
									<label class="custom_radio_label">
										<input type="radio" name="price_range" value="0-10000" {{ $selectedPrice == '0-10000' ? 'checked' : '' }}>
										<span class="radio_custom"></span>
										<span class="filter_text">Below ₹10,000</span>
									</label>
								</div>
								<div class="filter_option_item">
									<label class="custom_radio_label">
										<input type="radio" name="price_range" value="10000-25000" {{ $selectedPrice == '10000-25000' ? 'checked' : '' }}>
										<span class="radio_custom"></span>
										<span class="filter_text">₹10,000 - ₹25,000</span>
									</label>
								</div>
								<div class="filter_option_item">
									<label class="custom_radio_label">
										<input type="radio" name="price_range" value="25000-50000" {{ $selectedPrice == '25000-50000' ? 'checked' : '' }}>
										<span class="radio_custom"></span>
										<span class="filter_text">₹25,000 - ₹50,000</span>
									</label>
								</div>
								<div class="filter_option_item">
									<label class="custom_radio_label">
										<input type="radio" name="price_range" value="50000-100000" {{ $selectedPrice == '50000-100000' ? 'checked' : '' }}>
										<span class="radio_custom"></span>
										<span class="filter_text">₹50,000 - ₹1,00,000</span>
									</label>
								</div>
								<div class="filter_option_item">
									<label class="custom_radio_label">
										<input type="radio" name="price_range" value="100000-1000000" {{ $selectedPrice == '100000-1000000' ? 'checked' : '' }}>
										<span class="radio_custom"></span>
										<span class="filter_text">Above ₹1,00,000</span>
									</label>
								</div>
							</div>
						</div>

						<!-- Subcategories if available -->
						@if(isset($categoriesData) && $categoriesData->isNotEmpty())
							<div class="filter_group_box">
								<div class="filter_group_header">
									<h6>Categories</h6>
									<i class="fa fa-chevron-down filter_chevron"></i>
								</div>
								<div class="filter_group_content">
									@foreach($categoriesData as $catItem)
										<div class="filter_option_item">
											<a href="{{ route('category.show', ['path' => ($category ? $category->slug . '/' : '') . $catItem->slug]) }}" class="filter_cat_link">
												<span>{{ $catItem->name }}</span>
												<i class="fa fa-angle-right"></i>
											</a>
										</div>
									@endforeach
								</div>
							</div>
						@endif

						<!-- Metal / Color Accordion -->
						<div class="filter_group_box">
							<div class="filter_group_header">
								<h6>Metal & Color</h6>
								<i class="fa fa-chevron-down filter_chevron"></i>
							</div>
							<div class="filter_group_content">
								@php
									$metals = [
										['name' => 'Gold', 'color' => '#E5C158'],
										['name' => 'Rose Gold', 'color' => '#E8A598'],
										['name' => 'White Gold', 'color' => '#EFEFEF'],
										['name' => 'Platinum', 'color' => '#D8D8D8'],
										['name' => 'Silver', 'color' => '#C4C4C4'],
									];
								@endphp
								@foreach($metals as $m)
									<div class="filter_option_item">
										<label class="custom_checkbox_label">
											<input type="checkbox" name="metal[]" value="{{ $m['name'] }}">
											<span class="checkbox_custom"></span>
											<span class="metal_swatch" style="background-color: {{ $m['color'] }};"></span>
											<span class="filter_text">{{ $m['name'] }}</span>
										</label>
									</div>
								@endforeach
							</div>
						</div>

						<!-- Product Type Accordion -->
						<div class="filter_group_box">
							<div class="filter_group_header">
								<h6>Jewellery Type</h6>
								<i class="fa fa-chevron-down filter_chevron"></i>
							</div>
							<div class="filter_group_content">
								@php
									$types = ['Rings', 'Earrings', 'Pendants', 'Bracelets', 'Bangles', 'Mangalsutra', 'Necklaces', 'Watch Accessories'];
								@endphp
								@foreach($types as $t)
									<div class="filter_option_item">
										<label class="custom_checkbox_label">
											<input type="checkbox" name="type[]" value="{{ $t }}">
											<span class="checkbox_custom"></span>
											<span class="filter_text">{{ $t }}</span>
										</label>
									</div>
								@endforeach
							</div>
						</div>

						<!-- Gender Accordion -->
						<div class="filter_group_box">
							<div class="filter_group_header">
								<h6>Gender</h6>
								<i class="fa fa-chevron-down filter_chevron"></i>
							</div>
							<div class="filter_group_content">
								@foreach(['Women', 'Men', 'Unisex', 'Kids'] as $g)
									<div class="filter_option_item">
										<label class="custom_checkbox_label">
											<input type="checkbox" name="gender[]" value="{{ $g }}">
											<span class="checkbox_custom"></span>
											<span class="filter_text">{{ $g }}</span>
										</label>
									</div>
								@endforeach
							</div>
						</div>
					</div>

					<!-- Mobile Sticky Footer -->
					<div class="filter_drawer_footer">
						<button type="button" class="btn_drawer_clear" id="drawerClearBtn">Clear All</button>
						<button type="submit" class="btn_drawer_apply" id="drawerApplyBtn">Apply Filters</button>
					</div>
				</form>
			</aside>

			<!-- Products Listing Column -->
			<main class="products_listing_column">
				@if(count($results) > 0)
					<div class="products_cards_grid">
						@foreach($results as $result)
							@php
								$detailUrl = !empty($result->sku) 
									? route('front-product.detail', ['product' => 'product', 'title' => $result->slug . '.html', 'sku' => $result->sku]) 
									: '#';
								$isFav = in_array($result->id, $isWishlisteddata ?? []);
							@endphp
							<div class="product_card_item">
								<div class="collection_inner_box">
									<div class="collection_inner_box_img">
										<a href="{{ $detailUrl }}" class="shop_img_hover">
											<img class="normal_img_shop" src="{{ $result->images['first'] }}" alt="{{ $result->name }}" loading="lazy">
											<img class="hover_img_shop" src="{{ $result->images['second'] ?? $result->images['first'] }}" alt="{{ $result->name }}" loading="lazy">
										</a>

										<div class="collection_inner_box_icon addtoWishList" data-product-id="{{ $result->id }}" role="button" aria-label="Add to wishlist">
											<a href="javascript:void(0)" aria-label="Wishlist">
												<i class="fa {{ $isFav ? 'fa-heart text-danger' : 'fa-heart-o' }}"></i>
											</a>
										</div>

										@if($result->best_seller == 1)
											<div class="collection_best_seller">
												<span>Best Seller</span>
											</div>
										@endif

										@if($result->qty >= 1)
											<a href="{{ $detailUrl }}" class="btn_cart_add">View Details</a>
										@endif
									</div>

									<div class="collection_inner_box_txt">
										<div class="price">
											<span class="price_new currency-price" data-price-inr="{{ $result->selling_price }}">₹ {{ number_format($result->selling_price, 2) }}</span>
											@if($result->buying_price > $result->selling_price)
												<span class="price_new_cut currency-price" data-price-inr="{{ $result->buying_price }}">₹ {{ number_format($result->buying_price, 2) }}</span>
											@endif
											@php
												$discount = "";
												if (!empty($result->discount) && !empty($result->discount_type)) {
													if ($result->discount_type == 'percentage') {
														$discount = round($result->discount) . '% OFF';
													} else {
														$discount = '₹' . number_format($result->discount) . ' OFF';
													}
												} elseif($result->buying_price > $result->selling_price && $result->buying_price > 0) {
													$pct = round((($result->buying_price - $result->selling_price) / $result->buying_price) * 100);
													if ($pct > 0) {
														$discount = $pct . '% OFF';
													}
												}
											@endphp
											@if($discount)
												<div class="offer_txt1">{{ $discount }}</div>
											@endif
										</div>

										<h5>
											<a href="{{ $detailUrl }}" title="{{ $result->name }}">{{ $result->name }}</a>
										</h5>

										@if($result->qty < 1)
											<div class="stock_status text-danger">Out of Stock</div>
										@endif
									</div>
								</div>
							</div>
						@endforeach
					</div>
				@else
					<div class="empty_products_state">
						<div class="empty_icon_box">
							<i class="fa fa-search" aria-hidden="true"></i>
						</div>
						<h3>No Products Found</h3>
						<p>We couldn't find any products matching your selection. Try adjusting your filters or browse our complete collection.</p>
						<div class="empty_action_btns">
							<a href="{{ url('/') }}" class="btn_empty_browse">Explore Collections</a>
							@if(request()->hasAny(['price_range', 'sortBy', 'metal', 'type', 'gender']))
								<a href="{{ url()->current() }}" class="btn_empty_reset">Clear Filters</a>
							@endif
						</div>
					</div>
				@endif
			</main>
		</div>
	</div>
</div>

@include('components.footer.footer')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@include('front.includes.script')

<script>
	document.addEventListener('DOMContentLoaded', function () {
		// Drawer elements
		const drawer = document.getElementById('filterSidebarDrawer');
		const backdrop = document.getElementById('filterDrawerBackdrop');
		const openBtn = document.getElementById('openMobileFilterBtn');
		const closeBtn = document.getElementById('closeMobileFilterBtn');
		const drawerClearBtn = document.getElementById('drawerClearBtn');
		const filterForm = document.getElementById('filterForm');
		const activeIndicator = document.getElementById('filterActiveCount');
		const filterAppliedBadge = document.getElementById('filterAppliedBadge');

		// Open / Close Drawer
		function openDrawer() {
			if (drawer && backdrop) {
				drawer.classList.add('is-open');
				backdrop.classList.add('is-open');
				document.body.style.overflow = 'hidden';
			}
		}

		function closeDrawer() {
			if (drawer && backdrop) {
				drawer.classList.remove('is-open');
				backdrop.classList.remove('is-open');
				document.body.style.overflow = '';
			}
		}

		if (openBtn) openBtn.addEventListener('click', openDrawer);
		if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
		if (backdrop) backdrop.addEventListener('click', closeDrawer);

		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && drawer && drawer.classList.contains('is-open')) {
				closeDrawer();
			}
		});

		// Accordion collapse toggles
		document.querySelectorAll('.filter_group_header').forEach(function (header) {
			header.addEventListener('click', function () {
				const box = this.closest('.filter_group_box');
				if (box) {
					box.classList.toggle('is-collapsed');
				}
			});
		});

		// Count active filters
		function updateActiveFilterBadge() {
			let count = 0;
			const priceRadio = document.querySelector('input[name="price_range"]:checked');
			if (priceRadio && priceRadio.value !== '') count++;

			const checkboxes = document.querySelectorAll('#filterForm input[type="checkbox"]:checked');
			count += checkboxes.length;

			if (count > 0) {
				if (activeIndicator) {
					activeIndicator.textContent = count;
					activeIndicator.style.display = 'inline-flex';
				}
				if (filterAppliedBadge) {
					filterAppliedBadge.textContent = count + ' active';
					filterAppliedBadge.style.display = 'inline-block';
				}
			} else {
				if (activeIndicator) activeIndicator.style.display = 'none';
				if (filterAppliedBadge) filterAppliedBadge.style.display = 'none';
			}
		}

		updateActiveFilterBadge();

		// Auto-update badge on change
		if (filterForm) {
			filterForm.addEventListener('change', function () {
				updateActiveFilterBadge();
				// If desktop, can auto-submit on change
				if (window.innerWidth >= 992) {
					filterForm.submit();
				}
			});
		}

		// Clear all filters
		if (drawerClearBtn) {
			drawerClearBtn.addEventListener('click', function () {
				if (filterForm) {
					filterForm.querySelectorAll('input[type="checkbox"]').forEach(function (cb) {
						cb.checked = false;
					});
					const allPriceRadio = filterForm.querySelector('input[name="price_range"][value=""]');
					if (allPriceRadio) allPriceRadio.checked = true;
					updateActiveFilterBadge();
					filterForm.submit();
				}
			});
		}
	});
</script>
</body>
</html>