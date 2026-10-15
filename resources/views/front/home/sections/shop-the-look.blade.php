<div class="shop_look_main">
    <div class="shop_look_inner">
        <div class="shop_look_inner1">
            <div class="shop_look_inner_left">
                <img class="shop_img1" src="{{ asset('assets/image/look1.avif') }}" alt="">
                <img class="shop_img2" data-animate-in="right" data-animate-in-delay="100" src="{{ asset('assets/image/look2.avif') }}" alt="">
                <div class="shop_img_reveal"><img class="shop_img3" src="{{ asset('assets/image/look3.webp') }}" alt=""></div>
            </div>
            <div class="shop_look_inner_right">
                <h2>Shop The Look</h2>
                <p>Find your style. Find your aesthetic. Be who you are meant to be.</p>
                <a class="btn_shop_look" href="#">Shop This Look</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add("show");
    } else {
      entry.target.classList.remove("show");
    }
  });
});

document.querySelectorAll(".shop_img_reveal").forEach((element) => observer.observe(element));
</script>
