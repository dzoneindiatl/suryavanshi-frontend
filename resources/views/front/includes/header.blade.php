<style>
	.country-selector{position:relative;display:inline-block}
.country-toggle{display:flex;align-items:center;gap:8px;border:0;background:transparent;cursor:pointer;padding:8px}
.country-flag{width:30px;height:22px;object-fit:cover;flex-shrink:0}
.country-chevron{font-size:18px}
.country-dropdown{display:none;position:absolute;top:100%;right:0;width:280px;max-height:350px;overflow-y:auto;background:#fff;border:1px solid #ddd;box-shadow:0 4px 12px #0002;z-index:9999}
.country-selector.open .country-dropdown{display:block}
.country-option{display:flex;align-items:center;gap:10px;width:100%;padding:10px;border:0;background:#fff;text-align:left;cursor:pointer;font-size:13px}
.country-option:hover{background:#f5f1e8}
.country-option span{color:#222}
</style>

<style>
/* ── Subcategory text-reveal animation ───────────────────────── */
@keyframes subcat-reveal {
    0% {
        opacity: 0;
        transform: translateY(14px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Base hidden state — items are invisible until menu opens */
.inner_submenu_vertical .inner_submenu_vertical_inner {
    opacity: 0;
    transform: translateY(14px);
    will-change: opacity, transform;
}

/* When menu opens (.menu-open added on hover), reveal every option sequentially */
.sub_menu_main.menu-open .inner_submenu_vertical .inner_submenu_vertical_inner {
    animation: subcat-reveal 0.42s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    animation-delay: min(calc(var(--sub-i, 0) * 0.055s + 0.08s), 2.4s);
}
</style>
<div class="main_header_top">
	<div class="header_main">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="head_logo">
						<a href="{{ url('/') }}" title="Jaipur Jewellery House">
							<span class="logo-icon">
								<img class="logo-icon-holder" src="{{ asset('assets/logos/jjh-logo.png') }}" alt="logo">
							</span>
						</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="search-bar-top col-lg-6 col-12 d-none d-lg-flex">
	                    <section id="search" class="t-search-header">
							<div class="site-search">
								<form role="search" method="get" class="Search-Form">
									<div class="input-groups">
										<button type="reset" name="reset-button" class=" reset-button d-none d-md-none" aria-label="Clear search keywords">
											<svg id="Component_593_1" data-name="Component 593 – 1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
												<line id="Line_145" data-name="Line 145" x2="14.25" transform="translate(5.625 12)" fill="none" stroke="#832729" stroke-width="1"></line>
												<rect id="Rectangle_9948" data-name="Rectangle 9948" width="24" height="24" fill="none"></rect>
												<path id="Path_1438" data-name="Path 1438" d="M13.627,7,6.87,13.75l6.75,6.75" transform="translate(-1.717 -1.75)" fill="none" stroke="#832729" stroke-width="1"></path>	
											</svg>
										</button>
										<button type="submit" name="search-button" class="search-button-color hidden-sm-down d-md-block pb-1" aria-label="Submit search keywords">
											<img src="{{ asset('assets/image/searchbar-searchicon.svg') }}" alt="" class="searchcon">
										</button>
							
										<div class="search-open-mobile">
											<div class="search-pop w-100 d-flex align-items-center">
												<div class="search-input-animation">
													<div class="fixed-text">Shop for</div>
													<div class="search-label">
														<div class="search-label-animation">
															<div class="item_shop"><span>Rings</span></div>
															<div class="item_shop"><span>Earrings</span></div>
															<div class="item_shop"><span>Gifts</span></div>
															<div class="item_shop"><span>Coins</span></div>
															<div class="item_shop"><span>Anniversary</span></div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<input class="form-control search-field" type="text" id="mainSearchInput">
										<button class="image-search-popup-button" type="button" data-btntext="Search With A Pic And Find The Same Or Similar Jewelleries" data-breadcrumbtext="Best Matches">
											<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50" width="20px" height="20px">
												<path d="M 14 4 C 8.4886661 4 4 8.4886661 4 14 L 4 36 C 4 41.511334 8.4886661 46 14 46 L 36 46 C 41.511334 46 46 41.511334 46 36 L 46 14 C 46 8.4886661 41.511334 4 36 4 L 14 4 z M 14 6 L 36 6 C 40.430666 6 44 9.5693339 44 14 L 44 36 C 44 40.430666 40.430666 44 36 44 L 14 44 C 9.5693339 44 6 40.430666 6 36 L 6 14 C 6 9.5693339 9.5693339 6 14 6 z M 21.132812 12 C 20.079884 12 19.101556 12.55485 18.560547 13.457031 L 16.724609 16.513672 C 16.542289 16.815645 16.218154 17 15.867188 17 L 11 17 C 9.9069372 17 9 17.906937 9 19 L 9 35 C 9 36.093063 9.9069372 37 11 37 L 39 37 C 40.093063 37 41 36.093063 41 35 L 41 19 C 41 17.906937 40.093063 17 39 17 L 34.132812 17 C 33.779742 17 33.456382 16.817444 33.275391 16.515625 A 1.0001 1.0001 0 0 0 33.275391 16.513672 L 31.439453 13.457031 C 30.898444 12.55485 29.919615 12 28.867188 12 L 21.132812 12 z M 12 14 C 11.448 14 11 14.448 11 15 L 11 16 L 15 16 L 15 15 C 15 14.448 14.552 14 14 14 L 12 14 z M 21.132812 14 L 28.867188 14 C 29.21876 14 29.543618 14.182556 29.724609 14.484375 A 1.0001 1.0001 0 0 0 29.724609 14.486328 L 31.558594 17.542969 C 32.099603 18.445103 33.079884 19 34.132812 19 L 39 19 L 39 35 L 11 35 L 11 19 L 15.867188 19 C 16.919615 19 17.897599 18.446016 18.439453 17.544922 A 1.0001 1.0001 0 0 0 18.441406 17.542969 L 20.275391 14.486328 A 1.0001 1.0001 0 0 0 20.275391 14.484375 C 20.456335 14.18265 20.779742 14 21.132812 14 z M 25 20 C 21.145849 20 18 23.145852 18 27 C 18 30.854148 21.145849 34 25 34 C 28.854151 34 32 30.854148 32 27 C 32 23.145852 28.854151 20 25 20 z M 34 20 A 1 1 0 0 0 34 22 A 1 1 0 0 0 34 20 z M 25 22 C 27.773271 22 30 24.226731 30 27 C 30 29.773269 27.773271 32 25 32 C 22.226729 32 20 29.773269 20 27 C 20 24.226731 22.226729 22 25 22 z"/>
											</svg>
										</button>
									</div>
								</form>
							</div>
	          			</section>
	        		</div>
				</div>
				<div class="col-md-4">
					<div class="top-navbar-right">
	          			<div class="menu pb-header country-selector" id="countrySelector">
							<button type="button" class="country-toggle" id="countryToggle">
								<img id="selectedCountryFlag" src="" alt="" class="country-flag">
								<span id="selectedCountryCurrency">INR ₹</span>
								<span class="country-chevron"></span>
							</button>
							<div class="country-dropdown" id="countryDropdown">
								@foreach($newcountries as $country)
									<button type="button" class="country-option"
										data-id="{{ $country->id }}"
										data-iso2="{{ $country->iso2 }}"
										data-name="{{ $country->name }}"
										data-flag="{{ $country->flag }}"
										data-code="{{ $country->currency_code }}"
										data-rate="{{ $country->exchange_rates }}"
										data-symbol="{{ $country->currency_symbol }}">
										<img src="{{ $country->flag }}" alt="{{ $country->name }}" class="country-flag">
										<span>{{ $country->name }} ({{ $country->currency_code }} {{ $country->currency_symbol }})</span>
									</button>
								@endforeach
							</div>
							<input type="hidden" name="country_data" id="countryData">
						</div>
	          
	          			<div class="menu wishlist-nav-icon" data-name="Wishlist">
	      					<a class="px-0 whishlist-login wishlist_button" href="#">
				      			<div class="custom-img display-lg">
				        			<img src="{{ asset('assets/image/heart.svg') }}" alt="wishlist icon not load" class="wishlistmenu-icon">
				      			</div>
				    		</a>
	  					</div>
	          
	          			<div class="search p-0">
	    					<div class="minicart display-lg">
	        					<div class="minicart-total hide-link-med menu cart-icon" data-name="MiniCart">
	    							<a class="minicart-link px-0" href="{{ route('product.viewBag') }}">
	        							<div class="custom-img display-lg">
	            							<span><img src="{{ asset('assets/image/shopping-cart.svg') }}" class="cart-icon-img" alt="Close Button"></span>
	        							</div>
										@if (Auth::guard('customer')->check())
	        							<div class="cart-count minicart-quantity">{{ $cartTotal }}</div>
										@else 
										<div class="cart-count minicart-quantity cartTotal"></div>
										@endif 
									</a>
								</div>
	    					</div>
	    				</div>
	          
	          			<div class="menu account display-lg">
						@if (Auth::guard('customer')->check())
							<a class="px-0 login-menu" href="{{ route('user.dashboard') }}">
	    						<div class="d-flex head-back" id="loginButton">
	            					<div class="custom-img">
	                					<img class="pf-user" src="{{ asset('assets/image/userIcon.svg') }}" alt="Login Icon" loading="lazy">
	            					</div>
									<div>
										<span class="display-lg login-icon login-text" data-name="Login">Dashboard</span>
									</div>
	        					</div>
	  						</a>
	  					@else  
						<a class="px-0 login-menu" href="{{ route('front-user.login') }}">
	    						<div class="d-flex head-back" id="loginButton">
	            					<div class="custom-img">
	                					<img class="pf-user" src="{{ asset('assets/image/userIcon.svg') }}" alt="Login Icon" loading="lazy">
	            					</div>
									<div>
										<span class="display-lg login-icon login-text" data-name="Login">Login</span>
									</div>
	        					</div>
	  						</a>   
						@endif 
						</div>
	        		</div>
				</div>
			</div>
		</div>
	</div>

	<div class="bottom-header">
		<div class="container">
			<div class="col-md-12">
				<div class="main_menu">
					<ul> 
						@foreach($categories->where('show_on_menu', 1) as $category) 
							@php 
								$categoryId = data_get($category, 'id'); 
								$categoryName = data_get($category, 'name'); 
								$categorySlug = data_get($category, 'slug'); 
								$subCats = $subCategories->filter(function ($subCategory) use ($categoryId) 
								{ 
									return data_get($subCategory, 'parent_id') == $categoryId; 
								}); 
							@endphp 
							@if($subCats->isEmpty()) 
								<li> 
									<a href="{{ route('category.show',['path'=>$categorySlug]) }}" class="menu_item_main"> {{ $categoryName }} </a> 
								</li> 
							@else 
								<li class="sub_menu_main"> 
									<a href="{{ route('category.show',['path'=>$categorySlug]) }}" class="menu_item_main"> {{ $categoryName }} 
										<span class="submenu__icon"> <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-caret" viewBox="0 0 10 6" width="10" height="6" xmlns="http://www.w3.org/2000/svg"> <path d="M1 1L5 5L9 1" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"> </path> </svg> </span> 
									</a> 
									<div class="header_mega_menu"> 
										<div class="header_mega_menu_inner"> 
											<ul> 
												@foreach($subCats->where('show_on_menu', 1) as $subKey => $subCategory) 
													@php 
														$subCategoryId = data_get($subCategory, 'id'); 
														$subCategoryName = data_get($subCategory, 'name'); 
														$subCategorySlug = data_get($subCategory, 'slug'); 
													@endphp 
													{{-- <li class="megamenu_lists {{ $subKey === 0 ? 'active' : '' }}" data-sub-id="{{ $subCategoryId }}"> 
														<a href="{{route('category.show',['path'=>$categorySlug.'/'.$subCategorySlug]) }}" class="inner_menu_sub"> {{ $subCategoryName }} </a> 
													</li>  --}}
												@endforeach 
											</ul> 
											<div class="inner_submenu_vertical"> 
												@foreach($subCats->where('show_on_menu', 1) as $subKey => $subCategory) 
													@php 
														$subCategoryId = data_get($subCategory, 'id'); 
														$subCategoryName = data_get($subCategory, 'name'); 
														$subCategorySlug = data_get($subCategory, 'slug'); 
														$childCats = $childCategories->filter(function ($childCategory) use ($subCategoryId) 
														{ 
															return data_get($childCategory, 'parent_id') == $subCategoryId;
														}); 
													@endphp 
													<div class="inner_submenu_vertical_inner {{ $loop->first ? 'active' : '' }}" data-sub-content="{{ $subCategoryId }}" style="--sub-i: {{ $loop->index }};"> 
														<a href="{{ route('category.show',['path'=>$categorySlug.'/'.$subCategorySlug]) }}" class="inner_sub_title"> {{ $subCategoryName }} </a> 
														@if($childCats->isNotEmpty()) 
															<ul> 
																@foreach($childCats->where('show_on_menu', 1) as $childCategory) 
																	@php 
																		$childCategoryId = data_get($childCategory, 'id'); 
																		$childCategoryName = data_get($childCategory, 'name'); 
																		$childCategorySlug = data_get($childCategory, 'slug'); 
																		$childCategoryImage = data_get($childCategory, 'thumbnail_image'); 
																	@endphp 
																	<li> 
																		<h4> 
																			<a href="{{ route('category.show',['path'=>$categorySlug . '/' . $subCategorySlug . '/' . $childCategorySlug]) }}"> {{ $childCategoryName }} </a> 
																		</h4> 
																	</li> 
																@endforeach 
															</ul> 
														@endif 
													</div> 
												@endforeach 
											</div> 
										</div> 
									</div> 
								</li>
							@endif 
						@endforeach 
					</ul>	
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
	const carts = JSON.parse(localStorage.getItem('cartItems') || '[]');
	$('.cartTotal').text(carts.length);
	$('.wishlist_button').on('click',function(){
        if(window.isLoggedIn){
            window.location.href="{{ route('front-user.wishlist') }}";
        }else{
            window.location.href="{{ route('front-user.login') }}";
        }
    });

	document.addEventListener('DOMContentLoaded', async function () {
		const selector = document.getElementById('countrySelector');
		const toggle = document.getElementById('countryToggle');
		const flag = document.getElementById('selectedCountryFlag');
		const currency = document.getElementById('selectedCountryCurrency');
		const countryData = document.getElementById('countryData');

		if (!selector || !toggle) return;

		const options = [...selector.querySelectorAll('.country-option')];
		const STORAGE_KEY = 'selectedCountry';

		function applySelectedCountry(option) {
			if (!option) return;

			const country = {
				id: option.dataset.id,
				name: option.dataset.name,
				flag: option.dataset.flag,
				currency_code: option.dataset.code,
				currency_symbol: option.dataset.symbol,
				exchange_rates: option.dataset.rate,
				iso2: option.dataset.iso2
			};

			if (flag) {
				flag.src = country.flag || '';
				flag.alt = country.name || '';
			}

			if (currency) {
				currency.textContent = `${country.currency_code || ''} ${country.currency_symbol || ''}`;
			}

			if (countryData) {
				countryData.value = JSON.stringify(country);
			}

			updateProductPrices(country.exchange_rates, country.currency_symbol);
		}

		
		function updateProductPrices(rate, symbol) {
			rate = Number(rate);
			if (!Number.isFinite(rate) || rate <= 0) return;
			document.querySelectorAll('.currency-price[data-price-inr]').forEach(function (element) {
				const inrPrice = Number(element.dataset.priceInr);
				if (!Number.isFinite(inrPrice)) return;
				element.textContent = `${symbol || ''} ${(
					inrPrice * rate
				).toLocaleString('en-US', {
					minimumFractionDigits: 2,
					maximumFractionDigits: 2
				})}`;
			});
		}

		function saveManualCountry(option) {
			if (!option) return;

			localStorage.setItem(STORAGE_KEY, JSON.stringify({
				id: option.dataset.id,
				manual: true
			}));

			applySelectedCountry(option);
			selector.classList.remove('open');
		}

		function findCountryById(id) {
			return options.find(option => option.dataset.id === String(id));
		}

		function findCountryByIso2(code) {
			return options.find(option =>
				(option.dataset.iso2 || '').toUpperCase() === code.toUpperCase()
			);
		}

		toggle.addEventListener('click', function () {
			selector.classList.toggle('open');
		});

		options.forEach(function (option) {
			option.addEventListener('click', function () {
				saveManualCountry(option);
			});
		});

		document.addEventListener('click', function (event) {
			if (!selector.contains(event.target)) {
				selector.classList.remove('open');
			}
		});

		let saved = null;
		try {
			saved = JSON.parse(localStorage.getItem(STORAGE_KEY) || 'null');
		} catch (error) {
			localStorage.removeItem(STORAGE_KEY);
		}

		if (saved && saved.manual === true) {
			const selected = findCountryById(saved.id);
			if (selected) {
				applySelectedCountry(selected);
				return;
			}
		}

		try {
			const response = await fetch('https://ipapi.co/json/');
			if (!response.ok) throw new Error('Country detection failed');

			const location = await response.json();
			const detected = findCountryByIso2(location.country_code || '');

			if (detected) {
				applySelectedCountry(detected);
				return;
			}

		} catch (error) {
			console.warn('Could not detect visitor country:', error);
		}

		const india = options.find(option =>
			option.dataset.iso2?.toUpperCase() === 'IN' ||
			option.dataset.code === 'INR'
		) || options[0];

		if (india) applySelectedCountry(india);

	});
	// ── Subcategory reveal: toggle .menu-open to cleanly trigger animation ──
	document.querySelectorAll('.sub_menu_main').forEach(function (menuItem) {
		menuItem.addEventListener('mouseenter', function () {
			menuItem.classList.remove('menu-open');
			void menuItem.offsetWidth;
			menuItem.classList.add('menu-open');
		});
		menuItem.addEventListener('mouseleave', function () {
			menuItem.classList.remove('menu-open');
		});
	});

</script>