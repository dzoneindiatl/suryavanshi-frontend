@extends('front.layouts.app')
@section('content')
<div id="carouselExampleIndicators" class="carousel slide home_main_slider" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('assets/image/new-slider1.jpg') }}" alt="slide 1">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('assets/image/new-slider2.jpg') }}" alt="slide 2">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('assets/image/slide_ring4.png') }}" alt="slide 3">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="grid_pattren_img">
	<div class="grid_pattren_img_inner">
		<div class="grid_pattren_img_inner_box">
			<div class="grid_img_item">
				<a href="#">
					<div class="grid_image_box">
						<img src="{{ asset('assets/image/ring1.png') }}" alt="Ring Jewellery">
						<h3>Watch Jewellery</h3>
					</div>
					<h3>Watch Jewellery</h3>
				</a>
			</div>
			<div class="grid_img_item">
				<a href="#">
					<div class="grid_image_box">
						<img src="{{ asset('assets/image/ring2.png') }}" alt="Ring Jewellery">
						<h3>Watch Jewellery</h3>
					</div>
					<h3>Watch Jewellery</h3>
				</a>
			</div>
		</div>
		<div class="grid_pattren_img_inner_box">
			<div class="grid_img_item">
				<a href="#">
					<div class="grid_image_box">
						<img src="{{ asset('assets/image/ring3.png') }}" alt="Ring Jewellery">
						<h3>Watch Jewellery</h3>
					</div>
					<h3>Watch Jewellery</h3>
				</a>
			</div>
			<div class="grid_img_item">
				<a href="#">
					<div class="grid_image_box">
						<img src="{{ asset('assets/image/ring4.png') }}" alt="Ring Jewellery">
						<h3>Watch Jewellery</h3>
					</div>
					<h3>Watch Jewellery</h3>
				</a>
			</div>
		</div>
		<div class="grid_pattren_img_inner_box">
			<div class="grid_img_item">
				<a href="#">
					<div class="grid_image_box">
						<img src="{{ asset('assets/image/ring5.png') }}" alt="Ring Jewellery">
						<h3>Watch Jewellery</h3>
					</div>
					<h3>Watch Jewellery</h3>
				</a>
			</div>
			<div class="grid_img_item">
				<a href="#">
					<div class="grid_image_box">
						<img src="{{ asset('assets/image/ring6.png') }}" alt="Ring Jewellery">
						<h3>Watch Jewellery</h3>
					</div>
					<h3>Watch Jewellery</h3>
				</a>
			</div>
		</div>
		<div class="grid_pattren_img_inner_box">
			<div class="grid_img_item">
				<a href="#">
					<div class="grid_image_box">
						<img src="{{ asset('assets/image/ring1.png') }}" alt="Ring Jewellery">
						<h3>Watch Jewellery</h3>
					</div>
					<h3>Watch Jewellery</h3>
				</a>
			</div>
			<div class="grid_img_item">
				<a href="#">
					<div class="grid_image_box">
						<img src="{{ asset('assets/image/ring2.png') }}" alt="Ring Jewellery">
						<h3>Watch Jewellery</h3>
					</div>
					<h3>Watch Jewellery</h3>
				</a>
			</div>
		</div>
		<div class="grid_pattren_img_inner_box">
			<div class="grid_img_item">
				<a href="#">
					<div class="grid_image_box">
						<img src="{{ asset('assets/image/ring3.png') }}" alt="Ring Jewellery">
						<h3>Watch Jewellery</h3>
					</div>
					<h3>Watch Jewellery</h3>
				</a>
			</div>
			<div class="grid_img_item">
				<a href="#">
					<div class="grid_image_box">
						<img src="{{ asset('assets/image/ring4.png') }}" alt="Ring Jewellery">
						<h3>Watch Jewellery</h3>
					</div>
					<h3>Watch Jewellery</h3>
				</a>
			</div>
		</div>
		<div class="grid_pattren_img_inner_box">
			<div class="grid_img_item">
				<a href="#">
					<div class="grid_image_box">
						<img src="{{ asset('assets/image/ring5.png') }}" alt="Ring Jewellery">
						<h3>Watch Jewellery</h3>
					</div>
					<h3>Watch Jewellery</h3>
				</a>
			</div>
			<div class="grid_img_item">
				<a href="#">
					<div class="grid_image_box">
						<img src="{{ asset('assets/image/ring6.png') }}" alt="Ring Jewellery">
						<h3>Watch Jewellery</h3>
					</div>
					<h3>Watch Jewellery</h3>
				</a>
			</div>
		</div>
		<div class="grid_pattren_img_inner_box">
			<div class="grid_img_item">
				<a href="#">
					<div class="grid_image_box">
						<img src="{{ asset('assets/image/ring1.png') }}" alt="Ring Jewellery">
						<h3>Watch Jewellery</h3>
					</div>
					<h3>Watch Jewellery</h3>
				</a>
			</div>
			<div class="grid_img_item">
				<a href="#">
					<div class="grid_image_box">
						<img src="{{ asset('assets/image/ring2.png') }}" alt="Ring Jewellery">
						<h3>Watch Jewellery</h3>
					</div>
					<h3>Watch Jewellery</h3>
				</a>
			</div>
		</div>
		<div class="grid_pattren_img_inner_box">
			<div class="grid_img_item">
				<a href="#">
					<div class="grid_image_box">
						<img src="{{ asset('assets/image/ring3.png') }}" alt="Ring Jewellery">
						<h3>Watch Jewellery</h3>
					</div>
					<h3>Watch Jewellery</h3>
				</a>
			</div>
			<div class="grid_img_item">
				<a href="#">
					<div class="grid_image_box">
						<img src="{{ asset('assets/image/ring4.png') }}" alt="Ring Jewellery">
						<h3>Watch Jewellery</h3>
					</div>
					<h3>Watch Jewellery</h3>
				</a>
			</div>
		</div>
	</div>
</div>

<div class="home_collection_sec" id="home_collection_sec">
	<div class="home_collection_sec_inner">
		<div class="home_collection_img">
			<a href="#">
				<img src="{{ asset('assets/image/mh-hsf_v1.webp') }}" alt="img 1">
			</a>
		</div>
		<div class="home_collection_img">
			<a href="#">
				<img src="{{ asset('assets/image/mh-barbie.webp') }}" alt="img 2">
			</a>
			<div class="btn_button">
				<a class="btn_collection_all" href="#">Browse all Collections</a>
			</div>
		</div>
		<div class="home_collection_img">
			<a href="#">
				<img src="{{ asset('assets/image/evil_eye_dcs.webp') }}" alt="img 3">
			</a>
		</div>
	</div>
</div>

<div class="middle_sell_item_img">
	<div class="middle_sell_item_img_slide">
		<a href="#">
			<img src="{{ asset('assets/image/middle_img1.webp') }}" alt="slide 1">
		</a>
	</div>
	<div class="middle_sell_item_img_slide">
		<a href="#">
			<img src="{{ asset('assets/image/middle_img2.webp') }}" alt="slide 2">
		</a>
	</div>
	<div class="middle_sell_item_img_slide">
		<a href="#">
			<img src="{{ asset('assets/image/middle_img3.webp') }}" alt="slide 3">
		</a>
	</div>
</div>

<div class="wrap_inner_sec">
	<div class="wrap_inner_sec_inner">
		<div class="wrap_inner_sec_left">
			<div class="wrap_inner_grid">
				<a href="#">
					<img src="{{ asset('assets/image/w1.webp') }}" alt="">
				</a>
			</div>
		</div>
		<div class="wrap_inner_sec_right">
			<div class="wrap_inner_grid">
				<a href="#">
					<img src="{{ asset('assets/image/w2.webp') }}" alt="">
				</a>
			</div>
			<div class="wrap_inner_grid">
				<a href="#">
					<img src="{{ asset('assets/image/w3.webp') }}" alt="">
				</a>
			</div>
			<div class="wrap_inner_grid">
				<a href="#">
					<img src="{{ asset('assets/image/w4.webp') }}" alt="">
				</a>
			</div>
			<div class="wrap_inner_grid">
				<a href="#">
					<img src="{{ asset('assets/image/w5.webp') }}" alt="">
				</a>
			</div>
			<div class="wrap_inner_grid">
				<a href="#">
					<img src="{{ asset('assets/image/w6.webp') }}" alt="">
				</a>
			</div>
			<div class="wrap_inner_grid">
				<a href="#">
					<img src="{{ asset('assets/image/w7.webp') }}" alt="">
				</a>
			</div>
		</div>
	</div> 

<div class="caratla')
<ne_collection_main">
	<h2>New Arrival Products</h2>
	<div class="new_collection_main_inner">
		<div class="collection_inner_box">
			<div class="collection_inner_box_img">
				<img src="{{ asset('assets/image/collection_img1.webp')}}" alt="img">
				<div class="collection_inner_box_icon">
					<a href="#">
						<i class="fa fa-heart-o"></i>
					</a>
					<a href="#">
						<i class="fa fa-eye"></i>
					</a>
				</div>
				<div class="collection_arrival_seller">
					<a href="#">New Arrival</a>
				</div>
			</div>
			<div class="collection_inner_box_txt">
				<div class="price">
					<span>₹75,317</span>
				</div>
				<h5>Modern Gleam Diamond Bangle</h5>
			</div>
		</div>
		<div class="collection_inner_box">
			<div class="collection_inner_box_img">
				<img src="{{ asset('assets/image/collection_img1.webp')}}" alt="img">
				<div class="collection_inner_box_icon">
					<a href="#">
						<i class="fa fa-heart-o"></i>
					</a>
					<a href="#">
						<i class="fa fa-eye"></i>
					</a>
				</div>
				<div class="collection_arrival_seller">
					<a href="#">New Arrival</a>
				</div>
			</div>
			<div class="collection_inner_box_txt">
				<div class="price">
					<span>₹75,317</span>
				</div>
				<h5>Modern Gleam Diamond Bangle</h5>
			</div>
		</div>
		<div class="collection_inner_box">
			<div class="collection_inner_box_img">
				<img src="{{ asset('assets/image/collection_img1.webp')}}" alt="img">
				<div class="collection_inner_box_icon">
					<a href="#">
						<i class="fa fa-heart-o"></i>
					</a>
					<a href="#">
						<i class="fa fa-eye"></i>
					</a>
				</div>
				<div class="collection_arrival_seller">
					<a href="#">New Arrival</a>
				</div>
			</div>
			<div class="collection_inner_box_txt">
				<div class="price">
					<span>₹75,317</span>
				</div>
				<h5>Modern Gleam Diamond Bangle</h5>
			</div>
		</div>
		<div class="collection_inner_box">
			<div class="collection_inner_box_img">
				<img src="{{ asset('assets/image/collection_img1.webp')}}" alt="img">
				<div class="collection_inner_box_icon">
					<a href="#">
						<i class="fa fa-heart-o"></i>
					</a>
					<a href="#">
						<i class="fa fa-eye"></i>
					</a>
				</div>
				<div class="collection_arrival_seller">
					<a href="#">New Arrival</a>
				</div>
			</div>
			<div class="collection_inner_box_txt">
				<div class="price">
					<span>₹75,317</span>
				</div>
				<h5>Modern Gleam Diamond Bangle</h5>
			</div>
		</div>
		<div class="collection_inner_box">
			<div class="collection_inner_box_img">
				<img src="{{ asset('assets/image/collection_img1.webp')}}" alt="img">
				<div class="collection_inner_box_icon">
					<a href="#">
						<i class="fa fa-heart-o"></i>
					</a>
					<a href="#">
						<i class="fa fa-eye"></i>
					</a>
				</div>
				<div class="collection_arrival_seller">
					<a href="#">New Arrival</a>
				</div>
			</div>
			<div class="collection_inner_box_txt">
				<div class="price">
					<span>₹75,317</span>
				</div>
				<h5>Modern Gleam Diamond Bangle</h5>
			</div>
		</div>
		<div class="collection_inner_box">
			<div class="collection_inner_box_img">
				<img src="{{ asset('assets/image/collection_img1.webp')}}" alt="img">
				<div class="collection_inner_box_icon">
					<a href="#">
						<i class="fa fa-heart-o"></i>
					</a>
					<a href="#">
						<i class="fa fa-eye"></i>
					</a>
				</div>
				<div class="collection_arrival_seller">
					<a href="#">New Arrival</a>
				</div>
			</div>
			<div class="collection_inner_box_txt">
				<div class="price">
					<span>₹75,317</span>
				</div>
				<h5>Modern Gleam Diamond Bangle</h5>
			</div>
		</div>
	</div>
</div>

<div class="middle_section_img">
	<div class="middle_section_img_inner">
		<div class="col_left_3">
			<div class="giftcard-section">
				<div class="giftcard-wrap">
					<div class="bg-img-wrap">
						<img class="bg-img" src="{{ asset('assets/image/g-h.webp') }}" alt="Gift Finder under 50K">
						<img class="left-h-img" src="{{ asset('assets/image/g-hl.webp') }}" alt="Gift Finder under 50K">
						<img class="right-h-img" src="{{ asset('assets/image/g-hr.webp') }}" alt="Gift Finder under 50K">
						<div class="gift-wrap">
							<a class="gift-item" href="#">
								<img src="{{ asset('assets/image/u-10k_v4.webp') }}" alt="Under 10k">
							</a>
							<a class="gift-item" href="#">
								<img src="{{ asset('assets/image/u-30k_v4.webp') }}" alt="Under 30k">
							</a>
							<a class="gift-item" href="#">
								<img src="{{ asset('assets/image/u-50k_v4.webp') }}" alt="Under 50k">
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col_left_1">
			<div class="middle_img">
  			<a href="#">
					<img src="{{ asset('assets/image/middle1.png') }}" alt="img">
					<h2>Your First Diamond</h2>
				</a>
			</div>
			<div class="middle_img">
  			<a href="#">
					<img src="{{ asset('assets/image/middle3.png') }}" alt="img">
					<h2>Celebrating Success</h2>
				</a>
			</div>
		</div>
		<div class="col_left_2">
			<div class="middle_img">
  			<a href="#">
					<img src="{{ asset('assets/image/middle2.png') }}" alt="img">
					<h2>New Moms</h2>
				</a>
			</div>
			<div class="middle_img">
  			<a href="#">
					<img src="{{ asset('assets/image/middle4.png') }}" alt="img">
					<h2>Golden Anniversary</h2>
				</a>
			</div>
		</div>		
	</div>
</div>

<div class="best_seller_product">
	<div class="best_seller_product_inner">
		<div class="best_seller_product_head">
			<h2>Best Selling Product</h2>
		</div>
		<div class="best_seller_item">
			<div class="best_seller_item_inner_item">
				<a class="best_seller_item_inner" href="#">
					<div class="best_hero_section">
						<img src="{{ asset('assets/image/dl-3.webp') }}" alt="">
					</div>
					<div class="best_details_section">
						<div class="best_img_wrap">
							<img src="{{ asset('assets/image/dl-p1.webp') }}" alt="">
						</div>
						<h3 class="best_title">Shoulder Dusters</h3>
					</div>
				</a>
			</div>
			<div class="best_seller_item_inner_item">
				<a class="best_seller_item_inner" href="#">
					<div class="best_hero_section">
						<img src="{{ asset('assets/image/dl-3.webp') }}" alt="">
					</div>
					<div class="best_details_section">
						<div class="best_img_wrap">
							<img src="{{ asset('assets/image/dl-p1.webp') }}" alt="">
						</div>
						<h3 class="best_title">Shoulder Dusters</h3>
					</div>
				</a>
			</div>
			<div class="best_seller_item_inner_item">
				<a class="best_seller_item_inner" href="#">
					<div class="best_hero_section">
						<img src="{{ asset('assets/image/dl-3.webp') }}" alt="">
					</div>
					<div class="best_details_section">
						<div class="best_img_wrap">
							<img src="{{ asset('assets/image/dl-p1.webp') }}" alt="">
						</div>
						<h3 class="best_title">Shoulder Dusters</h3>
					</div>
				</a>
			</div>
			<div class="best_seller_item_inner_item">
				<a class="best_seller_item_inner" href="#">
					<div class="best_hero_section">
						<img src="{{ asset('assets/image/dl-3.webp') }}" alt="">
					</div>
					<div class="best_details_section">
						<div class="best_img_wrap">
							<img src="{{ asset('assets/image/dl-p1.webp') }}" alt="">
						</div>
						<h3 class="best_title">Shoulder Dusters</h3>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>

<div class="shop_by_budget_main">
	<div class="shop_by_budget_main_inner">
		<div class="best_seller_product_head">
			<h2>Shop By Budget</h2>
		</div>
		<div class="shop_budget_list">
			<div class="shop_budget_list_inner shop_budget_list1">
				<div class="shop_budget_list_img">
					<img src="{{ asset('assets/image/dl-3.webp') }}" alt="">
				</div>
				<h3>Diamond Bangles</h3>
			</div>
			<div class="shop_budget_list_inner shop_budget_list2">
				<div class="shop_budget_list_img">
					<img src="{{ asset('assets/image/w2.webp') }}" alt="">
				</div>
				<h3>Diamond Bangles</h3>
			</div>
			<div class="shop_budget_list_inner shop_budget_list3">
				<div class="shop_budget_list_img">
					<img src="{{ asset('assets/image/w7.webp') }}" alt="">
				</div>
				<h3>Diamond Bangles</h3>
			</div>
			<div class="shop_budget_list_inner shop_budget_list4">
				<div class="shop_budget_list_img">
					<img src="{{ asset('assets/image/w6.webp') }}" alt="">
				</div>
				<h3>Diamond Bangles</h3>
			</div>
		</div>
	</div>
</div>

<div class="shop_look_main">
	<div class="shop_look_inner">
		<div class="shop_look_inner1">
			<div class="shop_look_inner_left">
				<img class="shop_img1" src="{{ asset('assets/image/look1.avif') }}" alt="">
				<img class="shop_img2" data-animate-in="right" data-animate-in-delay="100" src="{{ asset('assets/image/look2.avif') }}" alt="">
				<div class="shop_img_reveal">
					<img class="shop_img3" src="{{ asset('assets/image/look3.webp') }}" alt="">
				</div>
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

const sections = document.querySelectorAll(".shop_img_reveal");
sections.forEach((el) => observer.observe(el));
</script>

<div class="custom_testimonial_main">
	<div class="custom_testimonial_head">
		<h2>Customer Testimonials</h2>
	</div>
	<div class="teatimonial_card_inner">
		<div class="testimonial_line testimonial_line1">
			<div class="testimonial_border_line"></div>
			<div class="testimonial_clip">
				<img src="{{ asset('assets/image/ribbon1.png') }}" width="28" height="30">
			</div>
			<div class="testimonial_item">
				<div class="testimonial_image">
					<img src="{{ asset('assets/image/bm3.webp') }}" alt="img1" width="277" height="242">
				</div>
				<div class="testimonial_title">Nutan Mishra, 33</div>
				<div class="testimonial_desc">I got a Nazariya for my baby boy from BlueStone. It's so cute seeing it on my little one's wrist, and it gives me a sense of security knowing it's there. Thanks, BlueStone, for making such lovely pieces for our little ones!</div>
			</div>
		</div>
		<div class="testimonial_line testimonial_line2">
			<div class="testimonial_border_line"></div>
			<div class="testimonial_clip">
				<img src="{{ asset('assets/image/ribbon1.png') }}" width="28" height="30">
			</div>
			<div class="testimonial_item">
				<div class="testimonial_image">
					<img src="{{ asset('assets/image/bm3.webp') }}" alt="img1" width="277" height="242">
				</div>
				<div class="testimonial_title">Nutan Mishra, 33</div>
				<div class="testimonial_desc">I got a Nazariya for my baby boy from BlueStone. It's so cute seeing it on my little one's wrist, and it gives me a sense of security knowing it's there. Thanks, BlueStone, for making such lovely pieces for our little ones!</div>
			</div>
		</div>
		<div class="testimonial_line testimonial_line3">
			<div class="testimonial_border_line"></div>
			<div class="testimonial_clip">
				<img src="{{ asset('assets/image/ribbon1.png') }}" width="28" height="30">
			</div>
			<div class="testimonial_item">
				<div class="testimonial_image">
					<img src="{{ asset('assets/image/bm3.webp') }}" alt="img1" width="277" height="242">
				</div>
				<div class="testimonial_title">Nutan Mishra, 33</div>
				<div class="testimonial_desc">I got a Nazariya for my baby boy from BlueStone. It's so cute seeing it on my little one's wrist, and it gives me a sense of security knowing it's there. Thanks, BlueStone, for making such lovely pieces for our little ones!</div>
			</div>
		</div>
		<div class="testimonial_line testimonial_line4">
			<div class="testimonial_border_line"></div>
			<div class="testimonial_clip">
				<img src="{{ asset('assets/image/ribbon1.png') }}" width="28" height="30">
			</div>
			<div class="testimonial_item">
				<div class="testimonial_image">
					<img src="{{ asset('assets/image/bm3.webp') }}" alt="img1" width="277" height="242">
				</div>
				<div class="testimonial_title">Nutan Mishra, 33</div>
				<div class="testimonial_desc">I got a Nazariya for my baby boy from BlueStone. It's so cute seeing it on my little one's wrist, and it gives me a sense of security knowing it's there. Thanks, BlueStone, for making such lovely pieces for our little ones!</div>
			</div>
		</div>
		<div class="testimonial_line testimonial_line5">
			<div class="testimonial_border_line"></div>
			<div class="testimonial_clip">
				<img src="{{ asset('assets/image/ribbon1.png') }}" width="28" height="30">
			</div>
			<div class="testimonial_item">
				<div class="testimonial_image">
					<img src="{{ asset('assets/image/bm3.webp') }}" alt="img1" width="277" height="242">
				</div>
				<div class="testimonial_title">Nutan Mishra, 33</div>
				<div class="testimonial_desc">I got a Nazariya for my baby boy from BlueStone. It's so cute seeing it on my little one's wrist, and it gives me a sense of security knowing it's there. Thanks, BlueStone, for making such lovely pieces for our little ones!</div>
			</div>
		</div>
	</div>
</div>

<div class="caratlane_collection_main">
	<h2>Top Selling Products</h2>
	<div class="caratlane_collection_main_inner">
		<div class="collection_inner_box">
			<div class="collection_inner_box_img">
				<img src="{{ asset('assets/image/collection_img1.webp') }}" alt="img">
				<div class="collection_inner_box_icon">
					<a href="#">
						<i class="fa fa-heart-o"></i>
					</a>
					<a href="#">
						<i class="fa fa-eye"></i>
					</a>
				</div>
				<div class="collection_best_seller">
					<a href="#">Best Seller</a>
				</div>
			</div>
			<div class="collection_inner_box_txt">
				<div class="price">
					<span>₹75,317</span>
				</div>
				<h5>Modern Gleam Diamond Bangle</h5>
			</div>
		</div>
		<div class="collection_inner_box">
			<div class="collection_inner_box_img">
				<img src="{{ asset('assets/image/collection_img1.webp') }}" alt="img">
				<div class="collection_inner_box_icon">
					<a href="#">
						<i class="fa fa-heart-o"></i>
					</a>
					<a href="#">
						<i class="fa fa-eye"></i>
					</a>
				</div>
				<div class="collection_treding_seller">
					<a href="#">Treding</a>
				</div>
			</div>
			<div class="collection_inner_box_txt">
				<div class="price">
					<span>₹75,317</span>
				</div>
				<h5>Modern Gleam Diamond Bangle</h5>
			</div>
		</div>
		<div class="collection_inner_box">
			<div class="collection_inner_box_img">
				<img src="{{ asset('assets/image/collection_img1.webp') }}" alt="img">
				<div class="collection_inner_box_icon">
					<a href="#">
						<i class="fa fa-heart-o"></i>
					</a>
					<a href="#">
						<i class="fa fa-eye"></i>
					</a>
				</div>
				<div class="collection_best_seller">
					<a href="#">Best Seller</a>
				</div>
			</div>
			<div class="collection_inner_box_txt">
				<div class="price">
					<span>₹75,317</span>
				</div>
				<h5>Modern Gleam Diamond Bangle</h5>
			</div>
		</div>
		<div class="collection_inner_box">
			<div class="collection_inner_box_img">
				<img src="{{ asset('assets/image/collection_img1.webp') }}" alt="img">
				<div class="collection_inner_box_icon">
					<a href="#">
						<i class="fa fa-heart-o"></i>
					</a>
					<a href="#">
						<i class="fa fa-eye"></i>
					</a>
				</div>
				<div class="collection_treding_seller">
					<a href="#">Treding</a>
				</div>
			</div>
			<div class="collection_inner_box_txt">
				<div class="price">
					<span>₹75,317</span>
				</div>
				<h5>Modern Gleam Diamond Bangle</h5>
			</div>
		</div>
		<div class="collection_inner_box">
			<div class="collection_inner_box_img">
				<img src="{{ asset('assets/image/collection_img1.webp') }}" alt="img">
				<div class="collection_inner_box_icon">
					<a href="#">
						<i class="fa fa-heart-o"></i>
					</a>
					<a href="#">
						<i class="fa fa-eye"></i>
					</a>
				</div>
				<div class="collection_best_seller">
					<a href="#">Best Seller</a>
				</div>
			</div>
			<div class="collection_inner_box_txt">
				<div class="price">
					<span>₹75,317</span>
				</div>
				<h5>Modern Gleam Diamond Bangle</h5>
			</div>
		</div>
		<div class="collection_inner_box">
			<div class="collection_inner_box_img">
				<img src="{{ asset('assets/image/collection_img1.webp') }}" alt="img">
				<div class="collection_inner_box_icon">
					<a href="#">
						<i class="fa fa-heart-o"></i>
					</a>
					<a href="#">
						<i class="fa fa-eye"></i>
					</a>
				</div>
				<div class="collection_best_seller">
					<a href="#">Best Seller</a>
				</div>
			</div>
			<div class="collection_inner_box_txt">
				<div class="price">
					<span>₹75,317</span>
				</div>
				<h5>Modern Gleam Diamond Bangle</h5>
			</div>
		</div>
	</div>
</div>

<div class="love_main">
	<div class="love_main_inner">
		<div class="love_top_left">
			<img src="{{ asset('assets/image/love7.png') }}" class="love_top_left_img">
			<p>Wrapped with Love</p>
		</div>
		<div class="love_main_right">
			<div class="love_main_right_inner">
				<a href="#">
					<div class="right_img_inn">
						<img src="{{ asset('assets/image/love1.jpg') }}">
						<p class="love_right_txt">Latest Rings</p>
					</div>
				</a>
			</div>
			<div class="love_main_right_inner">
				<a href="#">
					<div class="right_img_inn">
						<img src="{{ asset('assets/image/love2.jpg') }}">
						<p class="love_right_txt">Trendy Bracelets</p>
					</div>
				</a>
			</div>
			<div class="love_main_right_inner">
				<a href="#">
					<div class="right_img_inn">
						<img src="{{ asset('assets/image/love3.jpg') }}">
						<p class="love_right_txt">Must-have Earrings</p>
					</div>
				</a>
			</div>
			<div class="love_main_right_inner">
				<a href="#">
					<div class="right_img_inn">
						<img src="{{ asset('assets/image/love4.jpg') }}">
						<p class="love_right_txt">All-day Chains</p>
					</div>
				</a>
			</div>
			<div class="love_main_right_inner">
				<a href="#">
					<div class="right_img_inn">
						<img src="{{ asset('assets/image/love5.jpg') }}">
						<p class="love_right_txt">On-trend Necklaces</p>
					</div>
				</a>
			</div>
			<div class="love_main_right_inner">
				<a href="#">
					<div class="right_img_inn">
						<img src="{{ asset('assets/image/love6.jpg') }}">
						<p class="love_right_txt">Under ₹30K Styles</p>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>

<div class="influencers_main">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="influencers_slide_inner">
          <div class="influencers_content">
			    	<div class="influencers_img">
			    		<img src="{{ asset('assets/image/Influencer individual images-01.webp') }}" alt="">
			    	</div>
			    	<div class="influencers_txt">
			    		<h6>Saru Sharma</h6>
			      	<p>Mom Blogger</p>
			      	<h3>Mia lets me be the supermom I am with jewellery as versatile and fabulous as</h3>
			      </div>
			    </div>
          <div class="influencers_content">
			    	<div class="influencers_img">
			    		<img src="{{ asset('assets/image/Influencer individual images-02.webp') }}" alt="">
			    	</div>
			    	<div class="influencers_txt">
			    		<h6>Asha Roka</h6>
			      	<p>Professional MMA Fighter</p>
			      	<h3>Mia embodies my fighting spirit with jewellery that's as fierce as my punches</h3>
			      </div>
			    </div>
          <div class="influencers_content">
			    	<div class="influencers_img">
			    		<img src="{{ asset('assets/image/Influencer individual images-03.webp') }}" alt="">
			    	</div>
			    	<div class="influencers_txt">
			    		<h6>Anuja Deora</h6>
			      	<p>CEO & Founder</p>
			      	<h3>Mia empowers me to lead with style, confidence, and a touch of sparkle!</h3>
			      </div>
			    </div>
          <div class="influencers_content">
			    	<div class="influencers_img">
			    		<img src="{{ asset('assets/image/Influencer individual-04.webp') }}" alt="">
			    	</div>
			    	<div class="influencers_txt">
			    		<h6>Riza Reji</h6>
			      	<p>Model & Dancer</p>
			      	<h3>Mia's pieces reflect my spirit - they don't just sparkle, they dance</h3>
			      </div>
			    </div>
          <div class="influencers_content">
			    	<div class="influencers_img">
			    		<img src="{{ asset('assets/image/queenandrolast.jpg') }}" alt="">
			    	</div>
			    	<div class="influencers_txt">
			    		<h6>Queen Andro</h6>
			      	<p>Fashion Superstar</p>
			      	<h3>Mia is my canvas for self-expression - vibrant, bold, and unapologetically me</h3>
			      </div>
			    </div>
        </div>
			</div>
			<div class="col-md-5">
				<div class="influencers_box">
					<h2>Influencers</h2>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
					<div class="influencers_box_inner">
						<div class="influencers_img1">
		      		<img src="{{ asset('assets/image/left_img.webp') }}" alt="">
		      	</div>
		      	<div class="influencers_img2">
		      		<img src="{{ asset('assets/image/image-with-text.webp') }}" alt="">
		      	</div>
		      	<div class="influencers_img3">
		      		<img src="{{ asset('assets/image/image-with-text_small.webp') }}" alt="">
		      	</div>
		      </div>
		      <a href="#" class="insta_sec_txt">
						<h3>Take me to instagram</h3>
						<span class="insta_arrow">
							<i class="fa fa-instagram"></i>
						</span>
					</a>
				</div>
			</div>
			<div class="col-md-4">
				<div class="insta_sec_main">
					<div class="insta_sec">
						<div class="insta_sec_img insta_sec_small">
							<img src="{{ asset('assets/image/insta1.webp') }}" alt="">
							<div class="insta_icon">
								<i class="fa fa-instagram"></i>
							</div>
						</div>
						<div class="insta_sec_img insta_sec_medium">
							<img src="{{ asset('assets/image/insta2.webp') }}" alt="">
							<div class="insta_icon">
								<i class="fa fa-instagram"></i>
							</div>
						</div>
						<div class="insta_sec_img insta_sec_large">
							<img src="{{ asset('assets/image/insta3.webp') }}" alt="">
							<div class="insta_icon">
								<i class="fa fa-instagram"></i>
							</div>
						</div>
						<div class="insta_sec_img insta_sec_large">
							<img src="{{ asset('assets/image/insta4.webp') }}" alt="">
							<div class="insta_icon">
								<i class="fa fa-instagram"></i>
							</div>
						</div>
						<div class="insta_sec_img insta_sec_medium">
							<img src="{{ asset('assets/image/insta5.webp') }}" alt="">
							<div class="insta_icon">
								<i class="fa fa-instagram"></i>
							</div>
						</div>
						<div class="insta_sec_img insta_sec_small">
							<img src="{{ asset('assets/image/insta1.webp') }}" alt="">
							<div class="insta_icon">
								<i class="fa fa-instagram"></i>
							</div>
						</div>
						<div class="insta_sec_img insta_sec_small">
							<img src="{{ asset('assets/image/insta2.webp') }}" alt="">
							<div class="insta_icon">
								<i class="fa fa-instagram"></i>
							</div>
						</div>
						<div class="insta_sec_img insta_sec_large">
							<img src="{{ asset('assets/image/insta3.webp') }}" alt="">
							<div class="insta_icon">
								<i class="fa fa-instagram"></i>
							</div>
						</div>
						<div class="insta_sec_img insta_sec_medium">
							<img src="{{ asset('assets/image/insta4.webp') }}" alt="">
							<div class="insta_icon">
								<i class="fa fa-instagram"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="bottom_sec_last">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="l-band">
          <div class="swiper">
             <div class="swiper-wrapper">
                <div class="swiper-slide swiper-slide--1"></div>
                <div class="swiper-slide swiper-slide--2"></div>
                <div class="swiper-slide swiper-slide--3"></div>
                <div class="swiper-slide swiper-slide--4"></div>
                <div class="swiper-slide swiper-slide--5"></div>
                <div class="swiper-slide swiper-slide--6"></div>
                <div class="swiper-slide swiper-slide--7"></div>
                <div class="swiper-slide swiper-slide--8"></div>
                <div class="swiper-slide swiper-slide--9"></div>
                <div class="swiper-slide swiper-slide--10"></div>
             </div>
             <!-- Add Pagination -->
             <div class="swiper-pagination"></div>
          </div>
          <div class="instagram-swiper-button">
             <div class="swiper-button-next"></div>
             <div class="swiper-button-prev"></div>
          </div>
       </div>
			</div>
			<div class="col-md-4">
				<div class="bottom_sec_last_right">
					<h3>Stay in Touch & Get Latest <b>Updates and Offers</b></h3>
					<form method="post" id="banner_subscribe">
        		<input type="email" class="int_email_btn" name="email" id="email" placeholder="Enter Your Email">
        		<input type="submit" value="Submit" class="btn_subs">
      		</form>
      		<div class="bottom_sec_last_icon">
      			<div class="whatsapp-main">
      				<div class="whatsapp">
      					<a target="_blank" href="#">
      						<div class="whatsapp-in">
      							<img alt="whatsapp" width="40" height="40" src="{{ asset('assets/image/whatsapp.webp') }}">
      							<div class="con">
      								<p>Chat with us in</p>
      								<h3>WhatsApp</h3>
      							</div>
      						</div>
      					</a>
      				</div>
      			</div>
      			<div class="inner_stay_connected">
      				<h5>Stay Connected</h5>
		      		<ul class="footer_social_links">
		      			<li>
		      				<a target="_blank" href="#">
		      					<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path></svg>
		      				</a>
		      			</li>
		      			<li class="icon_twitter">
		      				<a target="_blank" href="#">
		      					<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 16 16"><g id="Twitter_New" data-name="Twitter New" transform="translate(-9.652 -9.456)"><path id="Path_9098" data-name="Path 9098" d="M270.282,259.467l5.957-6.775h-1.412l-5.176,5.882-4.131-5.882h-4.763l6.245,8.9-6.245,7.1h1.412l5.463-6.212L272,268.692h4.763l-6.479-9.225Zm-7.6-5.735h2.172l9.981,13.971h-2.174Z" transform="translate(-251.106 -243.236)" fill="#000"></path></g></svg>
		      				</a>
		      			</li>
		      			<li>
		      				<a target="_blank" href="#">
		      					<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="youtube" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path></svg>
		      				</a>
		      			</li>
		      			<li>
		      				<a target="_blank" href="#">
		      					<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>
		      				</a>
		      			</li>
		      			<li>
		      				<a target="_blank" href="#">
		      					<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="whatsapp" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path></svg>
		      				</a>
		      			</li>
		      		</ul>
		      	</div>
	      	</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection