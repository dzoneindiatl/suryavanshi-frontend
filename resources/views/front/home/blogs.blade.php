@extends('front.layouts.app')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Marcellus&display=swap');
    .suryavanshi_blog_main {padding: 80px 0px;}
    h2.faqs_top_head {margin-bottom: 60px;text-align: center;color: #ba8342;font-style: italic;letter-spacing: 1px;font-size: 45px;}
    .blog_inner_img img {max-width: 100%;width: 100%;object-fit: cover;}
    .blog_inner_content {padding: 15px 20px 25px;}
    .inner_blog_list {background: #fffbf5;transition: all 0.3s ease-in-out;}
    .inner_blog_list:hover {background: #f5ede2;box-shadow: 0px 5px 15px rgb(227 194 155);}
    .category_links a {color: #222;text-decoration: none;font-size: 13px;text-transform: uppercase;letter-spacing: 1px;transition: all 0.3s ease-in-out;}
    .category_links a:hover {color: #764810;text-decoration: underline;}
    .entry_taxonomies {margin-bottom: 5px;}
    h2.entry_title a {color: #222;text-decoration: none;}
    h2.entry_title {font-size: 25px;margin-bottom: 10px;}
    .entry_meta {margin-bottom: 10px;color: #888;font-size: 14px;}
    .entry_meta>:after {margin-left: .5rem;margin-right: .5rem;content: "";display: inline-block;background-color: currentColor;height: .25rem;width: .25rem;opacity: .8;border-radius: 9999px;vertical-align: .1875em;}
    .entry_meta a {color: #888;text-decoration: none;transition: all 0.3s ease-in-out;}
    .entry_meta a:hover {color: #764810;text-decoration: underline;}
    .blog_inner_content p {font-size: 15px;}
    a.post-more-link {color: #bb8442;text-decoration: none;text-transform: uppercase;font-size: 14px;font-weight: 400;letter-spacing: 1px;transition: all 0.3s ease-in-out;}
    a.post-more-link:hover {color: #7c501b;}
    .entry_meta>:last-child:after {display: none;}
</style>
<div class="suryavanshi_blog_main">
	<div class="container">
		<h2 class="faqs_top_head">Blog</h2>
		<div class="row">
			@foreach($blogs as $blog)	
				<div class="col-md-4">
					<div class="inner_blog_list">
						<div class="blog_inner_img">
							<img src="{{ asset('uploads/blogs/'.$blog->media) }}" alt="img">
						</div>
						<div class="blog_inner_content">
							<h2 class="entry_title"><a href="{{ route('blog.detail',$blog->blog_slug) }}">{{ $blog->title }}</a></h2>
							<div class="entry_meta">
								<span class="posted-by">
									<span class="meta-label">By</span>
									<span class="author vcard">
										<a href="javascript:void(0);">Editor</a>
									</span>
								</span>
								<span class="posted-on">
									<time class="entry-date published updated" datetime="2024-02-09T00:00:00+00:00">{{ date("M d ,Y",strtotime($blog->created_at)) }}</time>
								</span>
							</div>
							{!! $blog->short_description !!}
							<a href="{{ route('blog.detail',$blog->blog_slug) }}" class="post-more-link">Read More <svg aria-hidden="true" class="base-svg-icon base-arrow-right-alt-svg" fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg" width="27" height="28" viewBox="0 0 27 28"><title>Continue</title><path d="M27 13.953c0 0.141-0.063 0.281-0.156 0.375l-6 5.531c-0.156 0.141-0.359 0.172-0.547 0.094-0.172-0.078-0.297-0.25-0.297-0.453v-3.5h-19.5c-0.281 0-0.5-0.219-0.5-0.5v-3c0-0.281 0.219-0.5 0.5-0.5h19.5v-3.5c0-0.203 0.109-0.375 0.297-0.453s0.391-0.047 0.547 0.078l6 5.469c0.094 0.094 0.156 0.219 0.156 0.359v0z"></path></svg></a>
						</div>
					</div>
				</div>
			@endforeach 
		</div>
	</div>
</div>
@endsection 