<style>
/* ═════════════════════════════════════════════════════════════════
   RESPONSIVE NAVBAR & CATEGORY DRAWER STYLES
   Jaipur Jewellery House (JJH)
   ═════════════════════════════════════════════════════════════════ */

:root {
    --jjh-gold: #bb8442;
    --jjh-gold-dark: #936023;
    --jjh-gold-deep: #603502;
    --jjh-gold-light: #fff9f3;
    --jjh-gold-subtle: #f7ede2;
    --jjh-gold-border: #ead9c6;
    --jjh-text: #222222;
    --jjh-text-muted: #666666;
    --jjh-bg-cream: #faf7f2;
}

/* ── Mobile Navbar Wrapper (visible on < 992px) ───────────────── */
.mobile-navbar-wrapper {
    position: relative;
    width: 100%;
    background: #ffffff;
    z-index: 1030;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
}

/* ── 3-Column Symmetrical Top Bar ─────────────────────────────── */
.mobile-top-bar {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    align-items: center;
    height: 60px;
    padding: 0 14px;
    background: #ffffff;
    position: relative;
    box-sizing: border-box;
}

.mobile-top-left {
    justify-self: start;
    display: flex;
    align-items: center;
}

.mobile-top-center {
    justify-self: center;
    display: flex;
    align-items: center;
    justify-content: center;
}

.mobile-top-right {
    justify-self: end;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 6px;
}

/* ── Hamburger Button ─────────────────────────────────────────── */
.mobile-hamburger-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    padding: 0;
    background: transparent;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    color: var(--jjh-gold-deep);
    transition: background-color 0.2s ease, color 0.2s ease, transform 0.15s ease;
}

.mobile-hamburger-btn:hover,
.mobile-hamburger-btn:focus-visible {
    background-color: var(--jjh-gold-light);
    color: var(--jjh-gold-dark);
    outline: none;
}

.mobile-hamburger-btn svg {
    width: 24px;
    height: 24px;
    stroke: currentColor;
    display: block;
    transition: transform 0.2s ease;
}

.mobile-hamburger-btn.is-active svg {
    transform: rotate(90deg);
}

/* ── Mobile Brand Logo (Dead Center) ──────────────────────────── */
.mobile-brand-logo {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    max-height: 44px;
}

.mobile-brand-logo img {
    height: 42px;
    max-width: 125px;
    object-fit: contain;
    display: block;
    transition: transform 0.2s ease;
}

.mobile-brand-logo:hover img {
    transform: scale(1.02);
}

/* ── Mobile Actions Row (Right Side) ──────────────────────────── */
.mobile-action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: transparent;
    border: none;
    color: var(--jjh-text);
    cursor: pointer;
    position: relative;
    text-decoration: none;
    transition: background-color 0.2s ease, color 0.2s ease, transform 0.15s ease;
}

.mobile-action-btn:hover {
    background-color: var(--jjh-gold-light);
    color: var(--jjh-gold-deep);
    transform: scale(1.05);
}

.mobile-action-btn svg {
    width: 20px;
    height: 20px;
    stroke: currentColor;
    display: block;
}

.mobile-action-btn .cart-badge {
    position: absolute;
    top: 1px;
    right: 0px;
    min-width: 16px;
    height: 16px;
    padding: 0 4px;
    border-radius: 8px;
    background: var(--jjh-gold-deep);
    color: #ffffff;
    font-size: 10px;
    font-weight: 700;
    line-height: 16px;
    text-align: center;
    border: 1.5px solid #ffffff;
    pointer-events: none;
}

/* ── Mobile Collapsible Search Dropdown ───────────────────────── */
.mobile-search-dropdown {
    display: none;
    background: #ffffff;
    border-top: 1px solid var(--jjh-gold-border);
    padding: 10px 14px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
    animation: slideDownSearch 0.22s ease forwards;
}

.mobile-search-dropdown.is-open {
    display: block;
}

@keyframes slideDownSearch {
    from {
        opacity: 0;
        transform: translateY(-6px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.mobile-search-form {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
    background: #faf7f2;
    border: 1px solid var(--jjh-gold-border);
    border-radius: 25px;
    padding: 2px 8px 2px 14px;
}

.mobile-search-form input.mobile-search-input {
    border: none;
    background: transparent;
    width: 100%;
    padding: 8px 6px;
    font-size: 13.5px;
    color: var(--jjh-text);
    outline: none;
}

.mobile-search-form input.mobile-search-input::placeholder {
    color: #999999;
}

.mobile-search-submit {
    background: transparent;
    border: none;
    padding: 6px 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--jjh-gold-dark);
}

/* ═════════════════════════════════════════════════════════════════
   MOBILE CATEGORY DRAWER (OFFCANVAS)
   ═════════════════════════════════════════════════════════════════ */
.mobile-drawer-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(18, 12, 6, 0.55);
    backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
    z-index: 1040;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.3s ease;
}

.mobile-drawer-overlay.is-active {
    opacity: 1;
    visibility: visible;
}

.mobile-category-drawer {
    position: fixed;
    top: 0;
    left: 0;
    width: min(88vw, 390px);
    height: 100vh;
    height: 100dvh;
    background: #ffffff;
    z-index: 1050;
    box-shadow: 4px 0 28px rgba(0, 0, 0, 0.2);
    transform: translateX(-100%);
    transition: transform 0.32s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.mobile-category-drawer.is-active {
    transform: translateX(0);
}

/* ── Drawer Header ────────────────────────────────────────────── */
.drawer-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 18px;
    background: linear-gradient(135deg, #faf7f2 0%, #fff9f3 100%);
    border-bottom: 1px solid var(--jjh-gold-border);
    flex-shrink: 0;
}

.drawer-header-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}

.drawer-header-brand img {
    height: 36px;
    max-width: 125px;
    object-fit: contain;
}

.drawer-close-btn {
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    border: 1px solid var(--jjh-gold-border);
    border-radius: 50%;
    color: var(--jjh-gold-deep);
    cursor: pointer;
    font-size: 18px;
    transition: background 0.2s ease, transform 0.2s ease;
}

.drawer-close-btn:hover {
    background: var(--jjh-gold);
    color: #ffffff;
    border-color: var(--jjh-gold);
    transform: rotate(90deg);
}

/* ── Drawer User Account Card ─────────────────────────────────── */
.drawer-user-card {
    padding: 14px 18px;
    background: linear-gradient(135deg, #fdfbf8 0%, #faf4ec 100%);
    border-bottom: 1px solid var(--jjh-gold-border);
    flex-shrink: 0;
}

.drawer-user-profile {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 10px;
}

.drawer-user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #ffffff;
    border: 1.5px solid var(--jjh-gold);
    color: var(--jjh-gold-deep);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 6px rgba(187, 132, 66, 0.15);
    flex-shrink: 0;
}

.drawer-user-avatar svg {
    width: 20px;
    height: 20px;
    stroke: currentColor;
}

.drawer-user-meta {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.drawer-user-tag {
    font-size: 11px;
    color: var(--jjh-gold-dark);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    line-height: 1.2;
}

.drawer-user-name {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--jjh-text);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.3;
}

.drawer-user-quick-links {
    display: flex;
    gap: 8px;
}

.drawer-user-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    flex: 1;
    padding: 8px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    background: #ffffff;
    color: var(--jjh-gold-deep);
    border: 1px solid var(--jjh-gold-border);
    transition: all 0.2s ease;
}

.drawer-user-btn:hover {
    background: var(--jjh-gold-light);
    color: var(--jjh-gold-deep);
    border-color: var(--jjh-gold);
}

.drawer-user-btn.primary {
    background: var(--jjh-gold);
    color: #ffffff;
    border-color: var(--jjh-gold);
}

.drawer-user-btn.primary:hover {
    background: var(--jjh-gold-dark);
    border-color: var(--jjh-gold-dark);
    color: #ffffff;
}

/* ── Drawer Search ────────────────────────────────────────────── */
.drawer-search-box {
    padding: 12px 18px 8px;
    background: #ffffff;
    border-bottom: 1px solid #f3e9de;
    flex-shrink: 0;
}

.drawer-search-input-wrap {
    position: relative;
    display: flex;
    align-items: center;
    background: var(--jjh-bg-cream);
    border: 1px solid var(--jjh-gold-border);
    border-radius: 20px;
    padding: 0 12px;
}

.drawer-search-input-wrap input {
    width: 100%;
    border: none;
    background: transparent;
    padding: 7px 6px;
    font-size: 13px;
    outline: none;
    color: var(--jjh-text);
}

.drawer-search-input-wrap svg {
    color: var(--jjh-gold-dark);
    flex-shrink: 0;
}

/* ── Drawer Scrollable Body ───────────────────────────────────── */
.drawer-body {
    flex: 1 1 auto;
    overflow-y: auto;
    overflow-x: hidden;
    -webkit-overflow-scrolling: touch;
    padding: 8px 0 24px;
}

.drawer-section-title {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    color: var(--jjh-gold-dark);
    padding: 10px 18px 6px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.drawer-section-title::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--jjh-gold-border);
}

/* ── Category Accordion Tree ──────────────────────────────────── */
.drawer-cat-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.drawer-cat-item {
    border-bottom: 1px solid #f3eee7;
    position: relative;
}

.drawer-cat-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: 0;
    transition: background-color 0.15s ease;
}

.drawer-cat-row:hover {
    background-color: var(--jjh-gold-light);
}

.drawer-cat-link {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 1;
    padding: 13px 16px 13px 18px;
    color: var(--jjh-text);
    text-decoration: none;
    font-size: 13.5px;
    font-weight: 500;
    letter-spacing: 0.3px;
    text-transform: uppercase;
    transition: color 0.2s ease;
}

.drawer-cat-link:hover {
    color: var(--jjh-gold-dark);
}

.drawer-cat-link .cat-thumb-icon {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    object-fit: cover;
    background: #f0e6da;
    border: 1px solid var(--jjh-gold-border);
    flex-shrink: 0;
}

.drawer-toggle-btn {
    width: 48px;
    height: 48px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: transparent;
    border: none;
    color: var(--jjh-gold-dark);
    cursor: pointer;
    font-size: 13px;
    transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), color 0.2s ease;
    flex-shrink: 0;
}

.drawer-toggle-btn:hover {
    color: var(--jjh-gold-deep);
}

.drawer-toggle-btn svg {
    transition: transform 0.25s ease;
}

.drawer-cat-item.is-expanded > .drawer-cat-row > .drawer-toggle-btn svg {
    transform: rotate(180deg);
}

.drawer-cat-item.is-expanded > .drawer-cat-row {
    background-color: var(--jjh-gold-light);
}

.drawer-cat-item.is-expanded > .drawer-cat-row .drawer-cat-link {
    color: var(--jjh-gold-dark);
    font-weight: 600;
}

/* ── Subcategory Collapse ─────────────────────────────────────── */
.drawer-subcat-collapse {
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    transition: max-height 0.35s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.25s ease;
    background: #faf7f2;
}

.drawer-cat-item.is-expanded > .drawer-subcat-collapse {
    max-height: 2000px;
    opacity: 1;
}

.drawer-subcat-list {
    list-style: none;
    padding: 6px 0 10px 14px;
    margin: 0;
    border-left: 3px solid var(--jjh-gold);
    margin-left: 18px;
}

.drawer-view-all-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 18px 10px 14px;
    font-size: 12px;
    font-weight: 700;
    color: var(--jjh-gold-dark);
    text-transform: uppercase;
    letter-spacing: 0.6px;
    text-decoration: none;
    border-bottom: 1px dashed var(--jjh-gold-border);
}

.drawer-view-all-link:hover {
    color: var(--jjh-gold-deep);
    text-decoration: underline;
}

.drawer-subcat-item {
    border-bottom: 1px solid #f0e7dd;
}

.drawer-subcat-item:last-child {
    border-bottom: none;
}

.drawer-subcat-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.drawer-subcat-link {
    display: flex;
    align-items: center;
    flex: 1;
    padding: 11px 16px 11px 10px;
    color: #444444;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    letter-spacing: 0.2px;
    transition: color 0.15s ease, padding-left 0.15s ease;
}

.drawer-subcat-link:hover {
    color: var(--jjh-gold-deep);
    padding-left: 14px;
}

.drawer-subcat-toggle-btn {
    width: 40px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: transparent;
    border: none;
    color: var(--jjh-gold-dark);
    cursor: pointer;
    font-size: 11px;
    flex-shrink: 0;
    transition: transform 0.2s ease;
}

.drawer-subcat-item.is-expanded > .drawer-subcat-row > .drawer-subcat-toggle-btn svg {
    transform: rotate(45deg);
}

/* ── Child Category Collapse ──────────────────────────────────── */
.drawer-childcat-collapse {
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    transition: max-height 0.3s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.2s ease;
    background: #ffffff;
    border-radius: 4px;
    margin: 4px 12px 8px 10px;
}

.drawer-subcat-item.is-expanded > .drawer-childcat-collapse {
    max-height: 1200px;
    opacity: 1;
    border: 1px solid var(--jjh-gold-border);
}

.drawer-childcat-list {
    list-style: none;
    padding: 6px 8px;
    margin: 0;
}

.drawer-childcat-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 10px;
    color: #555555;
    text-decoration: none;
    font-size: 12.5px;
    border-radius: 4px;
    transition: background 0.15s ease, color 0.15s ease;
}

.drawer-childcat-link:hover {
    background: var(--jjh-gold-light);
    color: var(--jjh-gold-deep);
}

.drawer-child-thumb {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    object-fit: cover;
    border: 1px solid #e0d2c2;
    background: #f7f3ee;
    flex-shrink: 0;
}

/* ── Drawer Quick Links Section ───────────────────────────────── */
.drawer-user-section {
    padding: 14px 18px 8px;
    background: #ffffff;
    border-top: 1px solid var(--jjh-gold-border);
    margin-top: 12px;
}

.drawer-user-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.drawer-user-menu li {
    margin-bottom: 4px;
}

.drawer-user-menu a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 12px;
    border-radius: 6px;
    color: var(--jjh-text);
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    transition: background 0.15s ease, color 0.15s ease;
}

.drawer-user-menu a:hover {
    background: var(--jjh-gold-light);
    color: var(--jjh-gold-deep);
}

.drawer-user-menu a svg {
    width: 18px;
    height: 18px;
    stroke: currentColor;
    color: var(--jjh-gold-dark);
}

/* ── Drawer Currency Selector ─────────────────────────────────── */
.drawer-country-box {
    padding: 14px 18px;
    background: #faf7f2;
    border-top: 1px solid var(--jjh-gold-border);
}

.drawer-country-toggle {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: 9px 12px;
    background: #ffffff;
    border: 1px solid var(--jjh-gold-border);
    border-radius: 6px;
    cursor: pointer;
    font-size: 13px;
    color: var(--jjh-text);
}

.drawer-country-toggle .current-flag {
    width: 24px;
    height: 16px;
    object-fit: cover;
    margin-right: 8px;
}

.drawer-country-dropdown {
    display: none;
    margin-top: 6px;
    max-height: 200px;
    overflow-y: auto;
    background: #ffffff;
    border: 1px solid var(--jjh-gold-border);
    border-radius: 6px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.drawer-country-box.is-open .drawer-country-dropdown {
    display: block;
}

.drawer-country-option {
    display: flex;
    align-items: center;
    gap: 8px;
    width: 100%;
    padding: 8px 12px;
    border: none;
    background: transparent;
    text-align: left;
    font-size: 12px;
    cursor: pointer;
    transition: background 0.15s ease;
}

.drawer-country-option:hover {
    background: var(--jjh-gold-light);
}

.drawer-country-option img {
    width: 22px;
    height: 15px;
    object-fit: cover;
}

/* ── Prevent body scrolling when drawer is open ──────────────── */
body.mobile-drawer-open {
    overflow: hidden !important;
    touch-action: none;
}
</style>

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
