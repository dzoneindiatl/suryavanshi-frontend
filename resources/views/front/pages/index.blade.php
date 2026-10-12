@extends('front.layouts.app')
@section('content')
 
  <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style type="text/css">
.about_main_sec .container {max-width: 1270px;margin: 0px auto;}
.about_main_sec_inner {display: flex;width: 100%;}
.about-sidebar {justify-content: flex-start;display: flex;flex-direction: column;background-position: left top;background-size: cover;background-repeat: no-repeat;background-attachment: scroll;width: 25%;align-self: stretch;box-shadow: 1px 0px 0px rgba(0, 0, 0, 0.12);padding: 204px 15px 20px;position: relative;box-sizing: border-box;}
.about-sidebar:after {content: '';background-color: rgb(253, 246, 237);width: 100vw;position: absolute;right: 0;top: 0px;bottom: 0px;z-index: -1;margin-left: -50vw;}
.about-side-links {border-top: 1px solid rgba(0, 0, 0, 0.08);margin: 0px;padding: 0px;list-style: none;}
.about-side-links li {position: relative;border-bottom: 1px solid rgba(0, 0, 0, 0.08);padding: 0px;}
.about-side-links li:after {content: '';padding: 6px;border: solid rgba(0, 0, 0, 0.75);border-width: 0px 2px 2px 0px;transform: rotate(-45deg);cursor: pointer;pointer-events: none;position: absolute;right: 1rem;top: 50%;margin-top: -6px;}
.about-side-links li a, .about-side-links li strong {display: flex;justify-content: flex-end;padding: 20px 2rem 20px 1rem;color: #000000;font-size: 1.1rem;line-height: 1;box-sizing: border-box;}
.about-side-links li span {position: relative;}
.about-side-links li span:after {content: '';position: absolute;right: 0px;bottom: -6px;width: 100%;height: 2px;background-color: #EB7C78;}
.about-content-right {width: 75%;justify-content: flex-start;display: flex;flex-direction: column;background-position: left top;background-size: cover;background-repeat: no-repeat;background-attachment: scroll;align-self: stretch;padding: 50px 100px;box-sizing: border-box;}
.content_inner_txt h2 {font-size: 2.2rem;line-height: 2.5rem;margin-top: 0;margin-bottom: .5em;color: #222;font-weight: 600;font-style: normal;letter-spacing: .12px;}
.content_inner_txt p {font-size: 0.875rem;line-height: 1.25rem;margin-bottom: 20px;color: #172026;}
.content_inner_txt hr {width: 80%;border-width: 1px;border-color: rgba(0,0,0,.08);display: inline-block;margin-bottom: 0px;border-top: 1px solid #d1d1d1;margin-top: 24px;}
.content_inner_txt h4 {font-size: 0.875rem;line-height: 1.25rem;margin-bottom: 20px;text-transform: uppercase;font-weight: 400;color: #172026;margin-top: 1.5rem;}
.content_inner_txt ul, .content_inner_txt ol {margin-top: 0;margin-bottom: 1.875rem;}
.content_inner_txt li {font-size: 0.875rem;line-height: 1.25rem;padding: 1px 0.5rem;margin-bottom: 0px !important;color: #172026;}
.content_inner_txt p a {color: #eb7c78;text-decoration: none;}
.about-side-links li a, .about-side-links li strong {text-decoration: none;}
.about-side-links li.active-link a {background: #bf312e;color: #fff;}
.about-side-links li.active-link:after {border-color: #fff;}

@media (max-width: 767px) {
.about_main_sec_inner {flex-direction: column;}
.about-sidebar {width: 100%;box-shadow: none;padding: 60px 15px 20px 3px;}
.about-side-links li a, .about-side-links li strong {justify-content: flex-start;}
.about-content-right {width: 100%;padding: 50px 0px;}
.content_inner_txt h2 {font-size: 1.7rem;line-height: 2rem;}
}

@media (min-width: 768px) and (max-width: 991px) {
.about-content-right {padding: 50px 20px;width: 65%;}
.content_inner_txt h2 {font-size: 1.7rem;line-height: 2rem;}
.about-sidebar {width: 35%;padding: 50px 10px 20px;}
.about-side-links li a, .about-side-links li strong {font-size: 14px;}
.about-side-links li:after {padding: 4px;}
}

@media (min-width: 992px) and (max-width: 1199px) {
.about-content-right {width: 70%;padding: 50px 25px;}
.about-sidebar {width: 30%;padding: 50px 15px 20px;}
.about-side-links li a, .about-side-links li strong {font-size: 16px;}
.about-side-links li:after {padding: 5px;}
}
</style>

<div class="about_main_sec">
	<div class="container">
		<div class="about_main_sec_inner">
			<div class="about-sidebar">
				<ul class="about-side-links">
	                @foreach ($relatedSubcategories as $relatedSubcategorie)
                    <li><a href="{{ route('page.details', $relatedSubcategorie->slug ?? '#') }}">{{ $relatedSubcategorie->title }}</a></li>
                    @endforeach
	            </ul>
	        </div>
    	    <div class="about-content-right">
    	    	<div class="content_inner_txt">
    	    		<h2>{{ $page->title }}</h2>
    	    		<p>{!! $page->description !!}</p>
    	    	</div>
    	    </div>
	    </div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
