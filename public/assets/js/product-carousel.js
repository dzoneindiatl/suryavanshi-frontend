/**
 * Suryavanshi Jewellery - Product Carousel Smooth Slider & Animation Controller
 * Handles animated sliding, directional card inertia tilt, gold sparkle shimmer,
 * tactile mouse-drag & touch-swipe, and seamless wrap-around navigation.
 */
(function () {
    'use strict';

    const carouselStates = new WeakMap();

    function getCarouselState(carousel) {
        if (!carouselStates.has(carousel)) {
            carouselStates.set(carousel, {
                targetIndex: null,
                timer: null,
                isSliding: false
            });
        }
        return carouselStates.get(carousel);
    }

    function findCarousel(trigger) {
        if (!trigger) return null;
        if (trigger.hasAttribute && trigger.hasAttribute('data-product-carousel')) {
            return trigger;
        }
        const targetId = trigger.getAttribute('data-carousel-prev') || trigger.getAttribute('data-carousel-next');
        if (targetId) {
            const found = document.getElementById(targetId);
            if (found) return found;
        }
        const shell = trigger.closest ? trigger.closest('.product-carousel-shell') : null;
        if (shell) {
            return shell.querySelector('[data-product-carousel]');
        }
        return null;
    }

    /**
     * Smoothly slide carousel in given direction (+1 for next, -1 for prev)
     * with luxury card animations, button feedback, and seamless looping.
     */
    window.slideProductCarousel = function (triggerBtn, direction) {
        const carousel = findCarousel(triggerBtn);
        if (!carousel) return;

        const cards = carousel.querySelectorAll('article');
        if (!cards.length) return;

        const card = cards[0];
        const style = window.getComputedStyle(carousel);
        const gap = parseFloat(style.gap) || parseFloat(style.columnGap) || 20;
        const cardWidth = card.getBoundingClientRect().width;
        const step = cardWidth + gap;

        if (step <= 0) return;

        const maxScroll = Math.max(0, carousel.scrollWidth - carousel.clientWidth);
        if (maxScroll <= 0) return;

        const visibleCards = Math.max(1, Math.round(carousel.clientWidth / step));
        const maxIndex = Math.max(0, cards.length - visibleCards);

        const state = getCarouselState(carousel);
        const currentIndex = Math.round(carousel.scrollLeft / step);

        let targetIndex = state.targetIndex !== null ? state.targetIndex : currentIndex;
        targetIndex += direction;

        // Wrap around seamlessly if reaching past boundaries
        if (targetIndex > maxIndex) {
            targetIndex = 0;
        } else if (targetIndex < 0) {
            targetIndex = maxIndex;
        }

        state.targetIndex = targetIndex;
        state.isSliding = true;

        const targetLeft = Math.min(maxScroll, Math.max(0, targetIndex * step));

        // Button press & arrow nudge micro-interaction
        if (triggerBtn && triggerBtn.classList) {
            const animClass = direction > 0 ? 'is-clicked-next' : 'is-clicked-prev';
            triggerBtn.classList.remove('is-clicked-next', 'is-clicked-prev');
            void triggerBtn.offsetWidth; // trigger reflow for animation restart
            triggerBtn.classList.add(animClass);
            setTimeout(function () {
                triggerBtn.classList.remove(animClass);
            }, 420);
        }

        // Apply directional sliding & card motion animation classes
        carousel.classList.remove('is-sliding-next', 'is-sliding-prev');
        carousel.classList.add('is-sliding');
        if (direction > 0) {
            carousel.classList.add('is-sliding-next');
        } else {
            carousel.classList.add('is-sliding-prev');
        }

        // Perform animated smooth scroll
        try {
            carousel.scrollTo({
                left: targetLeft,
                behavior: 'smooth'
            });
        } catch (e) {
            carousel.scrollLeft = targetLeft;
        }

        // Reset sliding classes once slide completes
        clearTimeout(state.timer);
        state.timer = setTimeout(function () {
            carousel.classList.remove('is-sliding', 'is-sliding-next', 'is-sliding-prev');
            state.targetIndex = null;
            state.isSliding = false;
        }, 580);
    };

    /**
     * Initialize interactive drag-to-scroll, keyboard navigation, and touch enhancements
     */
    function initCarouselInteractions(carousel) {
        if (!carousel || carousel.dataset.carouselInitialized === 'true') return;
        carousel.dataset.carouselInitialized = 'true';

        let isDown = false;
        let startX = 0;
        let scrollStart = 0;
        let hasMoved = false;
        let dragDistance = 0;

        carousel.addEventListener('mousedown', function (e) {
            if (e.button !== 0) return;
            // Don't hijack clicks on buttons or action icons inside cards
            if (e.target.closest('button, a, input, select')) return;

            isDown = true;
            hasMoved = false;
            dragDistance = 0;
            startX = e.pageX - carousel.getBoundingClientRect().left;
            scrollStart = carousel.scrollLeft;
            carousel.classList.add('is-dragging');
        });

        window.addEventListener('mousemove', function (e) {
            if (!isDown) return;
            const currentX = e.pageX - carousel.getBoundingClientRect().left;
            const walk = currentX - startX;
            dragDistance = Math.abs(walk);

            if (dragDistance > 6) {
                hasMoved = true;
                carousel.classList.add('is-sliding');
                if (walk < 0) {
                    carousel.classList.add('is-sliding-next');
                    carousel.classList.remove('is-sliding-prev');
                } else {
                    carousel.classList.add('is-sliding-prev');
                    carousel.classList.remove('is-sliding-next');
                }
            }

            carousel.scrollLeft = scrollStart - (walk * 1.15);
        });

        function finishDrag() {
            if (!isDown) return;
            isDown = false;
            carousel.classList.remove('is-dragging');

            if (hasMoved) {
                const card = carousel.querySelector('article');
                if (card) {
                    const style = window.getComputedStyle(carousel);
                    const gap = parseFloat(style.gap) || parseFloat(style.columnGap) || 20;
                    const step = card.getBoundingClientRect().width + gap;
                    const targetIndex = Math.round(carousel.scrollLeft / step);
                    try {
                        carousel.scrollTo({
                            left: targetIndex * step,
                            behavior: 'smooth'
                        });
                    } catch (err) {
                        carousel.scrollLeft = targetIndex * step;
                    }
                }
            }

            setTimeout(function () {
                carousel.classList.remove('is-sliding', 'is-sliding-next', 'is-sliding-prev');
                hasMoved = false;
            }, 360);
        }

        window.addEventListener('mouseup', finishDrag);

        // Prevent unintentional link navigations during dragging
        carousel.addEventListener('click', function (e) {
            if (hasMoved) {
                e.preventDefault();
                e.stopPropagation();
                hasMoved = false;
            }
        }, true);

        // Mobile touch scroll detection for dynamic sliding states
        let touchTimer;
        carousel.addEventListener('scroll', function () {
            if (!carousel.classList.contains('is-sliding')) {
                carousel.classList.add('is-scrolling');
            }
            clearTimeout(touchTimer);
            touchTimer = setTimeout(function () {
                carousel.classList.remove('is-scrolling');
            }, 180);
        }, { passive: true });

        // Keyboard arrow navigation when carousel has focus
        carousel.setAttribute('tabindex', '0');
        carousel.setAttribute('role', 'region');
        carousel.setAttribute('aria-roledescription', 'carousel');

        carousel.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowRight') {
                e.preventDefault();
                window.slideProductCarousel(carousel, 1);
            } else if (e.key === 'ArrowLeft') {
                e.preventDefault();
                window.slideProductCarousel(carousel, -1);
            }
        });
    }

    /**
     * Wire up all product carousels found on the page
     */
    window.initProductCarousels = function () {
        const carousels = document.querySelectorAll('[data-product-carousel]');
        carousels.forEach(function (carousel) {
            initCarouselInteractions(carousel);
        });

        // Attach event listeners to prev/next buttons
        const prevButtons = document.querySelectorAll('[data-carousel-prev]');
        prevButtons.forEach(function (btn) {
            if (btn.dataset.listenerAttached === 'true') return;
            btn.dataset.listenerAttached = 'true';
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                window.slideProductCarousel(btn, -1);
            });
        });

        const nextButtons = document.querySelectorAll('[data-carousel-next]');
        nextButtons.forEach(function (btn) {
            if (btn.dataset.listenerAttached === 'true') return;
            btn.dataset.listenerAttached = 'true';
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                window.slideProductCarousel(btn, 1);
            });
        });
    };

    // Auto-init on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', window.initProductCarousels);
    } else {
        window.initProductCarousels();
    }
})();
