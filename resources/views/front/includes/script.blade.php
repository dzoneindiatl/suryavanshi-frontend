<script>
    window.csrfToken = "{{ csrf_token() }}";
    window.isLoggedIn = @json(Auth::guard('customer')->check());
    var addToWish = "{{ route('front-addwish') }}";
    var addToCart = "{{ route('user.addToCart') }}";
    var isOutOfStock = "{{ url('is-outofstock') }}"; 
    var getCouponUrl = "{{ route('get.coupon') }}";
    var wishlistUrl = "{{ route('front-user.wishlist') }}";
    var viewCartUrl = "{{ route('product.viewBag') }}";
    var headerSearchUrl = "{{ route('front-header-product-search') }}"; 
    window.mergeAddToCart = "{{ route('merge.localcart') }}"; 

</script>
<script>
    $('.wishlist_button').on('click',function(){
        if(window.isLoggedIn){
            window.location.href="{{ route('front-user.wishlist') }}";
        }else{
            window.location.href="{{ route('front-user.login') }}";
        }
    }); 
</script>
<script>
    function showFlashMessage(msg, type = 'success') {
        const flash = document.getElementById('flash-msg');
        if (!flash) {
            console.warn('Flash message element not found.');
            return;
        }
        const icons = {
            success: '<i class="fas fa-check-circle"></i>',
            error: '<i class="fas fa-times-circle"></i>',
            warning: '<i class="fas fa-exclamation-circle"></i>',
            info: '<i class="fas fa-info-circle"></i>'
        };
        const alertTypes = {
            success: 'alert-success',
            error: 'alert-danger',
            warning: 'alert-warning',
            info: 'alert-info'
        };
        const icon = icons[type] || icons.info;
        const alertClass = alertTypes[type] || alertTypes.info;
        flash.classList.remove(
            'd-none',
            'alert-success',
            'alert-danger',
            'alert-warning',
            'alert-info'
        );

        flash.classList.add(alertClass);
        flash.innerHTML = `${icon} <span>${msg}</span>`;
        clearTimeout(window.flashMessageTimer);
        window.flashMessageTimer = setTimeout(function() {
            flash.classList.add('d-none');
        }, 3000);
    }

    $(document).off('click', '.addtoWishList').on('click', '.addtoWishList', function () {
    
        const productId = this.getAttribute('data-product-id');
        const heartIcon = this.querySelector('i');
        if (!window.isLoggedIn) {
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
    function displayWishlistItem() {
        let wishlistCount = (localStorage.getItem('wishlistCount') && localStorage.getItem('wishlistCount') != "undefined") ? JSON.parse(localStorage.getItem('wishlistCount')) : 0;
        $(".wishlist-count").html(wishlistCount);
    }

</script>

<script>
    (function mergeGuestCartAfterLogin() {
        if (!window.isLoggedIn || window.guestCartMergeInProgress) {
            return;
        }

        const skipCartMergeReload = sessionStorage.getItem('skipGuestCartMergeReload') === '1';
        if (skipCartMergeReload) {
            sessionStorage.removeItem('skipGuestCartMergeReload');
        }

        let cartItems;
        try {
            cartItems = JSON.parse(localStorage.getItem('cartItems') || '[]');
            if (!Array.isArray(cartItems) || cartItems.length === 0) {
                return;
            }
        } catch (error) {
            console.error('Unable to read guest cart for account merge.', error);
            return;
        }

        window.guestCartMergeInProgress = true;
        cartItems.forEach(function(item, index) {
            if (!item.randomId) {
                item.randomId = 'legacy_' + Date.now() + '_' + index;
            }
        });
        localStorage.setItem('cartItems', JSON.stringify(cartItems));

        $.ajax({
            url: window.mergeAddToCart,
            method: 'POST',
            data: {
                _token: window.csrfToken,
                cart_items: cartItems
            },
            success: function(response) {
                const databaseCartCount = parseInt(response.cart_count, 10) || 0;
                const mergedItems = response.merged_items || [];
                if (mergedItems.length === 0) {
                    const localItems = JSON.parse(localStorage.getItem('cartItems') || '[]');
                    $('.center-main, .cartTotal').text(databaseCartCount + localItems.length);
                    if (response.errors && response.errors.length) {
                        showFlashMessage(response.errors[0].message, 'warning');
                    }
                    return;
                }

                const mergedById = new Map(mergedItems.map(function(item) {
                    return [String(item.random_id), parseInt(item.quantity, 10) || 0];
                }));
                const latestItems = JSON.parse(localStorage.getItem('cartItems') || '[]');
                const remainingItems = latestItems.reduce(function(remaining, item) {
                    const importedQuantity = mergedById.get(String(item.randomId));
                    if (importedQuantity === undefined) {
                        remaining.push(item);
                        return remaining;
                    }

                    const currentQuantity = parseInt(item.quantity, 10) || 0;
                    if (currentQuantity > importedQuantity) {
                        item.quantity = currentQuantity - importedQuantity;
                        remaining.push(item);
                    }
                    return remaining;
                }, []);

                localStorage.setItem('cartItems', JSON.stringify(remainingItems));
                $('.center-main, .cartTotal').text(databaseCartCount + remainingItems.length);
                const cartPath = new URL(window.viewCartUrl, window.location.origin).pathname.replace(/\/+$/, '');
                const currentPath = window.location.pathname.replace(/\/+$/, '');
                if (mergedItems.length && currentPath === cartPath && !skipCartMergeReload) {
                    sessionStorage.setItem('skipGuestCartMergeReload', '1');
                    window.location.reload();
                    return;
                }
                if (response.errors && response.errors.length) {
                    showFlashMessage(response.errors[0].message, 'warning');
                }
            },
            error: function(xhr) {
                console.error('Unable to merge guest cart.', xhr.responseText);
                showFlashMessage(
                    xhr.responseJSON?.message || 'Unable to merge your cart. Please try again.',
                    'error'
                );
            }
        });
    })();
</script>