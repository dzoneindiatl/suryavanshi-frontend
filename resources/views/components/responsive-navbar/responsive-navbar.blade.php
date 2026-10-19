<!-- ═══════════════════════════════════════════════════════════════
     RESPONSIVE NAVBAR (VISIBLE ON < 992px)
     ═══════════════════════════════════════════════════════════════ -->
<div class="mobile-navbar-wrapper d-block d-lg-none" id="mobileNavbar">
    <div class="mobile-top-bar">
        <!-- Column 1: Hamburger Button (Left) -->
        <div class="mobile-top-left">
            <button type="button" class="mobile-hamburger-btn" id="mobileHamburgerBtn" aria-label="Open categories menu" aria-controls="mobileCategoryDrawer" aria-expanded="false">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>

        <!-- Column 2: Brand Logo (Exact Center) -->
        <div class="mobile-top-center">
            <a href="{{ url('/') }}" class="mobile-brand-logo" title="Jaipur Jewellery House">
                <img src="{{ asset('assets/logos/jjh-logo.png') }}" alt="Jaipur Jewellery House">
            </a>
        </div>

        <!-- Column 3: Mobile Action Icons (Right) -->
        <div class="mobile-top-right mobile-nav-actions">
            <!-- Search Toggle -->
            <button type="button" class="mobile-action-btn" id="mobileSearchToggle" aria-label="Search">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>

            <!-- Wishlist -->
            <a href="javascript:void(0);" class="mobile-action-btn wishlist_button" aria-label="Wishlist">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
            </a>

            <!-- Mini Cart with badge -->
            <a href="{{ route('product.viewBag') }}" class="mobile-action-btn" aria-label="Shopping Cart">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
                <span class="cart-badge minicart-quantity cartTotal">{{ $cartTotal ?? 0 }}</span>
            </a>
        </div>
    </div>

    <!-- Collapsible Search Bar (toggled by Search button) -->
    <div class="mobile-search-dropdown" id="mobileSearchDropdown">
        <form role="search" method="get" action="{{ url('/') }}" class="mobile-search-form" id="mobileSearchForm">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#936023" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" name="search" class="mobile-search-input" id="mobileSearchInputField" placeholder="Search for Rings, Necklaces, Coins..." autocomplete="off">
            <button type="submit" class="mobile-search-submit" aria-label="Search">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════════
     BACKDROP OVERLAY
     ═══════════════════════════════════════════════════════════════ -->
<div class="mobile-drawer-overlay" id="mobileDrawerOverlay" aria-hidden="true"></div>

<!-- ═══════════════════════════════════════════════════════════════
     SLIDE-OUT CATEGORY NAVIGATION DRAWER
     ═══════════════════════════════════════════════════════════════ -->
<aside class="mobile-category-drawer" id="mobileCategoryDrawer" aria-label="Categories Navigation" role="dialog" aria-modal="true">
    <!-- Drawer Header -->
    <div class="drawer-header">
        <a href="{{ url('/') }}" class="drawer-header-brand" title="Jaipur Jewellery House">
            <img src="{{ asset('assets/logos/jjh-logo.png') }}" alt="Jaipur Jewellery House">
        </a>
        <button type="button" class="drawer-close-btn" id="mobileDrawerClose" aria-label="Close categories menu">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    <!-- User Account Section inside Hamburger Sidebar (Moved from navbar) -->
    <div class="drawer-user-card">
        @if(Auth::guard('customer')->check())
            <div class="drawer-user-profile">
                <div class="drawer-user-avatar">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div class="drawer-user-meta">
                    <span class="drawer-user-tag">Welcome Back</span>
                    <span class="drawer-user-name">{{ Auth::guard('customer')->user()->name ?? 'Customer' }}</span>
                </div>
            </div>
            <div class="drawer-user-quick-links">
                <a href="{{ route('user.dashboard') }}" class="drawer-user-btn primary">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    <span>My Dashboard</span>
                </a>
                @if(Route::has('user.myPurchase'))
                    <a href="{{ route('user.myPurchase') }}" class="drawer-user-btn">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                        </svg>
                        <span>Orders</span>
                    </a>
                @endif
            </div>
        @else
            <div class="drawer-user-profile">
                <div class="drawer-user-avatar">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div class="drawer-user-meta">
                    <span class="drawer-user-tag">My Account</span>
                    <span class="drawer-user-name">Sign in for best experience</span>
                </div>
            </div>
            <div class="drawer-user-quick-links">
                <a href="{{ route('front-user.login') }}" class="drawer-user-btn primary">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                        <polyline points="10 17 15 12 10 7"></polyline>
                        <line x1="15" y1="12" x2="3" y2="12"></line>
                    </svg>
                    <span>Login / Register</span>
                </a>
            </div>
        @endif
    </div>

    <!-- Quick Search inside Drawer -->
    <div class="drawer-search-box">
        <div class="drawer-search-input-wrap">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" id="drawerCategorySearch" placeholder="Find in categories..." aria-label="Filter categories">
        </div>
    </div>

    <!-- Drawer Scrollable Body -->
    <div class="drawer-body">
        <div class="drawer-section-title">
            <span>Shop By Category</span>
        </div>

        <!-- Category Accordion List -->
        <ul class="drawer-cat-list" id="drawerCatList">
            @foreach($categories->where('show_on_menu', 1) as $category)
                @php
                    $categoryId = data_get($category, 'id');
                    $categoryName = data_get($category, 'name');
                    $categorySlug = data_get($category, 'slug');
                    $categoryThumb = data_get($category, 'thumbnail_image');
                    $subCats = $subCategories->filter(function ($subCategory) use ($categoryId) {
                        return data_get($subCategory, 'parent_id') == $categoryId;
                    });
                @endphp

                @if($subCats->isEmpty())
                    <!-- Category with NO subcategories -->
                    <li class="drawer-cat-item" data-cat-name="{{ strtolower($categoryName) }}">
                        <div class="drawer-cat-row">
                            <a href="{{ route('category.show', ['path' => $categorySlug]) }}" class="drawer-cat-link">
                                @if(!empty($categoryThumb))
                                    <img src="{{ asset($categoryThumb) }}" alt="{{ $categoryName }}" class="cat-thumb-icon">
                                @endif
                                <span>{{ $categoryName }}</span>
                            </a>
                        </div>
                    </li>
                @else
                    <!-- Category WITH subcategories (Accordion) -->
                    <li class="drawer-cat-item has-subcategories" data-cat-name="{{ strtolower($categoryName) }}" data-cat-id="{{ $categoryId }}">
                        <div class="drawer-cat-row">
                            <a href="{{ route('category.show', ['path' => $categorySlug]) }}" class="drawer-cat-link">
                                @if(!empty($categoryThumb))
                                    <img src="{{ asset($categoryThumb) }}" alt="{{ $categoryName }}" class="cat-thumb-icon">
                                @endif
                                <span>{{ $categoryName }}</span>
                            </a>
                            <button type="button" class="drawer-toggle-btn mobile-cat-toggle" aria-expanded="false" aria-label="Expand {{ $categoryName }} menu">
                                <svg width="12" height="8" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="1 1.5 6 6.5 11 1.5"></polyline>
                                </svg>
                            </button>
                        </div>

                        <!-- Subcategory Collapse -->
                        <div class="drawer-subcat-collapse">
                            <a href="{{ route('category.show', ['path' => $categorySlug]) }}" class="drawer-view-all-link">
                                <span>View All {{ $categoryName }}</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>

                            <ul class="drawer-subcat-list">
                                @foreach($subCats->where('show_on_menu', 1) as $subCategory)
                                    @php
                                        $subCategoryId = data_get($subCategory, 'id');
                                        $subCategoryName = data_get($subCategory, 'name');
                                        $subCategorySlug = data_get($subCategory, 'slug');
                                        $childCats = $childCategories->filter(function ($childCategory) use ($subCategoryId) {
                                            return data_get($childCategory, 'parent_id') == $subCategoryId;
                                        });
                                    @endphp

                                    @if($childCats->isEmpty())
                                        <!-- Subcategory without children -->
                                        <li class="drawer-subcat-item">
                                            <div class="drawer-subcat-row">
                                                <a href="{{ route('category.show', ['path' => $categorySlug . '/' . $subCategorySlug]) }}" class="drawer-subcat-link">
                                                    {{ $subCategoryName }}
                                                </a>
                                            </div>
                                        </li>
                                    @else
                                        <!-- Subcategory WITH child categories -->
                                        <li class="drawer-subcat-item has-children" data-sub-id="{{ $subCategoryId }}">
                                            <div class="drawer-subcat-row">
                                                <a href="{{ route('category.show', ['path' => $categorySlug . '/' . $subCategorySlug]) }}" class="drawer-subcat-link">
                                                    {{ $subCategoryName }}
                                                </a>
                                                <button type="button" class="drawer-subcat-toggle-btn mobile-subcat-toggle" aria-expanded="false" aria-label="Expand {{ $subCategoryName }}">
                                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Child Categories Collapse -->
                                            <div class="drawer-childcat-collapse">
                                                <ul class="drawer-childcat-list">
                                                    @foreach($childCats->where('show_on_menu', 1) as $childCategory)
                                                        @php
                                                            $childCategoryName = data_get($childCategory, 'name');
                                                            $childCategorySlug = data_get($childCategory, 'slug');
                                                            $childCategoryImage = data_get($childCategory, 'thumbnail_image');
                                                        @endphp
                                                        <li>
                                                            <a href="{{ route('category.show', ['path' => $categorySlug . '/' . $subCategorySlug . '/' . $childCategorySlug]) }}" class="drawer-childcat-link">
                                                                @if(!empty($childCategoryImage))
                                                                    <img src="{{ asset($childCategoryImage) }}" alt="{{ $childCategoryName }}" class="drawer-child-thumb" loading="lazy">
                                                                @endif
                                                                <span>{{ $childCategoryName }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>

        <!-- Drawer Country & Currency Selector -->
        <div class="drawer-country-box" id="drawerCountryBox">
            <button type="button" class="drawer-country-toggle" id="drawerCountryToggle" aria-haspopup="true" aria-expanded="false">
                <span style="display: flex; align-items: center;">
                    <img id="drawerSelectedFlag" src="" alt="" class="current-flag">
                    <span id="drawerSelectedCurrency">INR ₹</span>
                </span>
                <svg width="12" height="8" viewBox="0 0 12 8" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="1 1.5 6 6.5 11 1.5"></polyline>
                </svg>
            </button>
            <div class="drawer-country-dropdown" id="drawerCountryDropdown">
                @if(isset($newcountries))
                    @foreach($newcountries as $country)
                        <button type="button" class="drawer-country-option"
                            data-id="{{ $country->id }}"
                            data-iso2="{{ $country->iso2 }}"
                            data-name="{{ $country->name }}"
                            data-flag="{{ $country->flag }}"
                            data-code="{{ $country->currency_code }}"
                            data-rate="{{ $country->exchange_rates }}"
                            data-symbol="{{ $country->currency_symbol }}">
                            <img src="{{ $country->flag }}" alt="{{ $country->name }}" loading="lazy">
                            <span>{{ $country->name }} ({{ $country->currency_code }} {{ $country->currency_symbol }})</span>
                        </button>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Drawer Footer Navigation Links -->
        <div class="drawer-user-section">
            <ul class="drawer-user-menu">
                @if(Auth::guard('customer')->check())
                    <li>
                        <a href="{{ route('user.dashboard') }}">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span>Dashboard & Profile</span>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('front-user.login') }}">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                <polyline points="10 17 15 12 10 7"></polyline>
                                <line x1="15" y1="12" x2="3" y2="12"></line>
                            </svg>
                            <span>Login / Register</span>
                        </a>
                    </li>
                @endif
                <li>
                    <a href="javascript:void(0);" class="wishlist_button">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                        <span>My Wishlist</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('product.viewBag') }}">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                        <span>Shopping Bag (<span class="minicart-quantity cartTotal">{{ $cartTotal ?? 0 }}</span>)</span>
                    </a>
                </li>
                @if(Route::has('store-locator'))
                    <li>
                        <a href="{{ route('store-locator') }}">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <span>Store Locator</span>
                        </a>
                    </li>
                @endif
                @if(Route::has('contact.index'))
                    <li>
                        <a href="{{ route('contact.index') }}">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            <span>Contact Us</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</aside>

<!-- ═══════════════════════════════════════════════════════════════
     RESPONSIVE NAVBAR JAVASCRIPT
     ═══════════════════════════════════════════════════════════════ -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const hamburgerBtn = document.getElementById('mobileHamburgerBtn');
    const drawer = document.getElementById('mobileCategoryDrawer');
    const overlay = document.getElementById('mobileDrawerOverlay');
    const closeBtn = document.getElementById('mobileDrawerClose');
    const searchToggle = document.getElementById('mobileSearchToggle');
    const searchDropdown = document.getElementById('mobileSearchDropdown');
    const searchInput = document.getElementById('mobileSearchInputField');
    const drawerCatSearch = document.getElementById('drawerCategorySearch');

    // ── Open / Close Drawer ─────────────────────────────────────
    function openDrawer() {
        if (!drawer || !overlay) return;
        drawer.classList.add('is-active');
        overlay.classList.add('is-active');
        if (hamburgerBtn) hamburgerBtn.classList.add('is-active');
        document.body.classList.add('mobile-drawer-open');
        if (hamburgerBtn) hamburgerBtn.setAttribute('aria-expanded', 'true');
    }

    function closeDrawer() {
        if (!drawer || !overlay) return;
        drawer.classList.remove('is-active');
        overlay.classList.remove('is-active');
        if (hamburgerBtn) hamburgerBtn.classList.remove('is-active');
        document.body.classList.remove('mobile-drawer-open');
        if (hamburgerBtn) hamburgerBtn.setAttribute('aria-expanded', 'false');
    }

    if (hamburgerBtn) {
        hamburgerBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            if (drawer.classList.contains('is-active')) {
                closeDrawer();
            } else {
                openDrawer();
            }
        });
    }

    if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
    if (overlay) overlay.addEventListener('click', closeDrawer);

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && drawer && drawer.classList.contains('is-active')) {
            closeDrawer();
        }
    });

    // Also support any element with .open-category-drawer
    document.querySelectorAll('.open-category-drawer').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            openDrawer();
        });
    });

    // ── Search Dropdown Toggle ──────────────────────────────────
    if (searchToggle && searchDropdown) {
        searchToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            searchDropdown.classList.toggle('is-open');
            if (searchDropdown.classList.contains('is-open') && searchInput) {
                setTimeout(function () {
                    searchInput.focus();
                }, 100);
            }
        });

        // Close search if clicked outside
        document.addEventListener('click', function (e) {
            if (!searchDropdown.contains(e.target) && !searchToggle.contains(e.target)) {
                searchDropdown.classList.remove('is-open');
            }
        });
    }

    // ── Accordion: Level 1 (Categories) ─────────────────────────
    document.querySelectorAll('.mobile-cat-toggle').forEach(function (toggleBtn) {
        toggleBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const parentItem = this.closest('.drawer-cat-item');
            if (!parentItem) return;

            const isExpanded = parentItem.classList.contains('is-expanded');

            // Close other open category items for clean single-open accordion
            document.querySelectorAll('.drawer-cat-item.is-expanded').forEach(function (item) {
                if (item !== parentItem) {
                    item.classList.remove('is-expanded');
                    const btn = item.querySelector('.mobile-cat-toggle');
                    if (btn) btn.setAttribute('aria-expanded', 'false');
                }
            });

            if (isExpanded) {
                parentItem.classList.remove('is-expanded');
                this.setAttribute('aria-expanded', 'false');
            } else {
                parentItem.classList.add('is-expanded');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // ── Accordion: Level 2 (Subcategories) ──────────────────────
    document.querySelectorAll('.mobile-subcat-toggle').forEach(function (toggleBtn) {
        toggleBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const parentItem = this.closest('.drawer-subcat-item');
            if (!parentItem) return;

            const isExpanded = parentItem.classList.contains('is-expanded');
            if (isExpanded) {
                parentItem.classList.remove('is-expanded');
                this.setAttribute('aria-expanded', 'false');
            } else {
                parentItem.classList.add('is-expanded');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // ── Live Filter Categories in Drawer ────────────────────────
    if (drawerCatSearch) {
        drawerCatSearch.addEventListener('input', function () {
            const query = this.value.trim().toLowerCase();
            const items = document.querySelectorAll('.drawer-cat-item');

            items.forEach(function (item) {
                const name = item.getAttribute('data-cat-name') || '';
                if (!query || name.includes(query)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }

    // ── Drawer Country Selector Sync ────────────────────────────
    const drawerCountryBox = document.getElementById('drawerCountryBox');
    const drawerCountryToggle = document.getElementById('drawerCountryToggle');
    const drawerSelectedFlag = document.getElementById('drawerSelectedFlag');
    const drawerSelectedCurrency = document.getElementById('drawerSelectedCurrency');

    if (drawerCountryToggle && drawerCountryBox) {
        drawerCountryToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            drawerCountryBox.classList.toggle('is-open');
        });

        // Close country dropdown if clicked outside
        document.addEventListener('click', function (e) {
            if (!drawerCountryBox.contains(e.target)) {
                drawerCountryBox.classList.remove('is-open');
            }
        });

        // Forward drawer country click to desktop country option handler
        document.querySelectorAll('.drawer-country-option').forEach(function (opt) {
            opt.addEventListener('click', function () {
                const countryId = this.dataset.id;
                // Trigger the matching desktop option if it exists
                const desktopOpt = document.querySelector(`.country-dropdown .country-option[data-id="${countryId}"]`);
                if (desktopOpt) {
                    desktopOpt.click();
                } else {
                    // Fallback direct apply
                    if (drawerSelectedFlag) drawerSelectedFlag.src = this.dataset.flag || '';
                    if (drawerSelectedCurrency) drawerSelectedCurrency.textContent = `${this.dataset.code || ''} ${this.dataset.symbol || ''}`;
                }
                drawerCountryBox.classList.remove('is-open');
            });
        });

        // Keep drawer flag & currency in sync with desktop selector
        const observer = new MutationObserver(function () {
            const desktopFlag = document.getElementById('selectedCountryFlag');
            const desktopCurrency = document.getElementById('selectedCountryCurrency');
            if (desktopFlag && drawerSelectedFlag) {
                drawerSelectedFlag.src = desktopFlag.src;
                drawerSelectedFlag.alt = desktopFlag.alt;
            }
            if (desktopCurrency && drawerSelectedCurrency) {
                drawerSelectedCurrency.textContent = desktopCurrency.textContent;
            }
        });

        const desktopFlag = document.getElementById('selectedCountryFlag');
        const desktopCurrency = document.getElementById('selectedCountryCurrency');
        if (desktopFlag) {
            observer.observe(desktopFlag, { attributes: true, attributeFilter: ['src', 'alt'] });
            if (drawerSelectedFlag) {
                drawerSelectedFlag.src = desktopFlag.src;
                drawerSelectedFlag.alt = desktopFlag.alt;
            }
        }
        if (desktopCurrency) {
            observer.observe(desktopCurrency, { characterData: true, childList: true, subtree: true });
            if (drawerSelectedCurrency) {
                drawerSelectedCurrency.textContent = desktopCurrency.textContent;
            }
        }
    }
});
</script>
