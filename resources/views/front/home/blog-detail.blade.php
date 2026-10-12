@extends('front.layouts.app')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Marcellus&display=swap');
    .suryavanshi_blog_main {padding: 80px 0px;}
    h2.blog_top_head {margin-bottom: 60px;text-align: center;color: #5e3607;font-style: italic;letter-spacing: 1px;font-size: 45px;}
    h6.blog_heading {margin-bottom: 20px;font-size: 16px;text-transform: uppercase;letter-spacing: 0.5px;display: flex;align-items: center;gap: 7px;}
    .blog_list_dot {background: #b98241;width: 10px;height: 10px;}
    .blog_abo_img {margin-bottom: 15px;}
    .blog_detail_sec {max-width: 1050px;margin: 0px auto;display: flex;gap: 50px;}
    .blog_detail_sec_left {width: 25%;}
    .blog_abo_img img {max-width: 100%;width: 100%;}
    .blog_detail_sec_left p {font-size: 15px;color: #343434;}
    .recent_atricle_inner {margin-bottom: 50px;}
    ul.blog_list_side {list-style: none;padding: 0px;margin: 0px;}
    .blog_list_img img {max-width: 100%;width: 100%;object-fit: cover;border-radius: 8px;height: 180px;transition: all 0.5s ease-in-out;}
    .blog_list_img {overflow: hidden;}
    .blog_list_side li:hover .blog_list_img img {transform: scale(1.1);}
    .blog_list_side li {margin-bottom: 30px;position: relative;overflow: hidden;}
    .blog_list_side li:last-child {margin-bottom: 0px;}
    h2.blog_entry_title {font-size: 18px;}
    h2.blog_entry_title a {color: #343434;text-decoration: none;transition: all 0.3s ease-in-out;}
    h2.blog_entry_title a:hover {color: #9d6b2f;text-decoration: underline;}
    .post_inner_txt {font-weight: 500;text-transform: uppercase;font-size: 14px;letter-spacing: 1px;font-style: italic;}
    .blog_list_txt {background: #fff;padding: 10px;position: absolute;left: 5px;right: 5px;bottom: -100%;border-radius: 8px;transition: all 0.6s ease-in-out;}
    .blog_list_side li:hover .blog_list_txt {bottom: 3%;}
    .det_blo_top_img img {max-width: 100%;width: 100%;border-radius: 10px;height: 450px;object-fit: cover;}
    .blog_detail_sec_right {width: 71%;}
    .blog_detail_sec_right h2 {margin-top: 20px;}
    .blog_detail_sec_right p {font-size: 15px;color: #343434;}
    .blog_nav_box {display: flex;align-items: center;justify-content: space-between;margin-top: 40px;}
    .blog_nav_box .post-more-link {color: #bb8442;text-decoration: none;text-transform: uppercase;font-size: 14px;font-weight: 400;letter-spacing: 1px;transition: all 0.3s ease-in-out;}
    .blog_nav_box .post-more-link:hover {color: #99672c;}
    .blog_nav_box .post-more-link:first-child svg {transform: rotate(180deg);}
</style>

<div class="suryavanshi_blog_main">
	<div class="container">
		<h2 class="blog_top_head">Blog Detail</h2>
		<div class="blog_detail_sec">
			<div class="blog_detail_sec_left">
				<div class="recent_atricle_inner">
					<h6 class="blog_heading"><div class="blog_list_dot"></div> Recent Articles</h6>
					<ul class="blog_list_side">
						@foreach($blogs as $blog)
                            <li>
                                <div class="blog_list_img">
                                    <img src="{{ asset('uploads/blogs/'.$blog->media) }}" alt="img">
                                </div>
                                <div class="blog_list_txt">
                                    <h2 class="blog_entry_title"><a href="{{ route('blog.detail',$blog->blog_slug) }}">{{ $blog->title }}</a></h2>
                                    <div class="post_inner_txt"><time datetime="2025-08-18T11:53:59+05:30">{{ date("M d ,Y",strtotime($blog->created_at)) }}</time></div>
                                </div>
                            </li>
						@endforeach 
                        {{-- <li>
							<div class="blog_list_img">
								<img src="image/collection_img2.webp" alt="img">
							</div>
							<div class="blog_list_txt">
								<h2 class="blog_entry_title"><a href="javascript:void(0);">How to Write a Blog Post Your Readers Will Love in 5 Steps</a></h2>
								<div class="post_inner_txt"><time datetime="2025-08-18T11:53:59+05:30">August 19, 2025</time></div>
							</div>
						</li>
						
                        <li>
							<div class="blog_list_img">
								<img src="image/collection_img4.webp" alt="img">
							</div>
							<div class="blog_list_txt">
								<h2 class="blog_entry_title"><a href="javascript:void(0);">How to Write a Blog Post Your Readers Will Love in 5 Steps</a></h2>
								<div class="post_inner_txt"><time datetime="2025-08-18T11:53:59+05:30">August 19, 2025</time></div>
							</div>
						</li> --}}
					</ul>
				</div>
				{{-- <h6 class="blog_heading"><div class="blog_list_dot"></div> About SuryaVanshi</h6>
				<div class="blog_abo_img">
					<img src="image/bm3.webp" alt="img">
				</div>
				<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary.</p> --}}
			</div>
			<div class="blog_detail_sec_right">
				<div class="det_blo_top_img">
					<img src="{{ asset('uploads/blogs/'.$details->media) }}" alt="img">
				</div>
				<h2>{{ $details->title }}</h2>
				{{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> --}}
                {!! $details->long_description !!}
				{{-- <div class="blog_nav_box">
					<a href="javascript:void(0);" class="post-more-link"><svg aria-hidden="true" class="base-svg-icon base-arrow-right-alt-svg" fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg" width="27" height="28" viewBox="0 0 27 28"><path d="M27 13.953c0 0.141-0.063 0.281-0.156 0.375l-6 5.531c-0.156 0.141-0.359 0.172-0.547 0.094-0.172-0.078-0.297-0.25-0.297-0.453v-3.5h-19.5c-0.281 0-0.5-0.219-0.5-0.5v-3c0-0.281 0.219-0.5 0.5-0.5h19.5v-3.5c0-0.203 0.109-0.375 0.297-0.453s0.391-0.047 0.547 0.078l6 5.469c0.094 0.094 0.156 0.219 0.156 0.359v0z"></path></svg> Prev Blog</a>
					<a href="javascript:void(0);" class="post-more-link">Next Blog <svg aria-hidden="true" class="base-svg-icon base-arrow-right-alt-svg" fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg" width="27" height="28" viewBox="0 0 27 28"><path d="M27 13.953c0 0.141-0.063 0.281-0.156 0.375l-6 5.531c-0.156 0.141-0.359 0.172-0.547 0.094-0.172-0.078-0.297-0.25-0.297-0.453v-3.5h-19.5c-0.281 0-0.5-0.219-0.5-0.5v-3c0-0.281 0.219-0.5 0.5-0.5h19.5v-3.5c0-0.203 0.109-0.375 0.297-0.453s0.391-0.047 0.547 0.078l6 5.469c0.094 0.094 0.156 0.219 0.156 0.359v0z"></path></svg></a>
				</div> --}}
			</div>
		</div>
	</div>
</div>

@endsection 