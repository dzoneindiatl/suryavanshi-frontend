@extends('front.layouts.app')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Marcellus&display=swap');

    .suryavanshi_faqs_main {padding: 80px 0px;}
    h2.faqs_top_head {margin-bottom: 60px;text-align: center;color: #5e3607;font-style: italic;letter-spacing: 1px;font-size: 45px;}
    .accordions__list {display: flex;flex-direction: column;gap: 1.8rem;}
    .accordions__item {background-color: #f3f3f3;border-radius: 2.8rem;overflow: hidden;transition: 0.5s cubic-bezier(0.65, 0.2, 0.65, 1);box-shadow: 0px 0.3125rem 0px 0px /*#ba8342*/ #5e3607;border: 0.0625rem solid #5e3607;}
    .accordions__control {display: flex;align-items: center;padding: 20px 60px;width: 100%;background: transparent;position: relative;border: medium none;color: #5e3607;}
    .accordions__number {font-size: 60px;padding-right: 1.5625rem;font-weight: 500;}
    .accordions__title {font-size: 30px;font-weight: 500;text-transform: capitalize;flex: 1 1 auto;display: flex;line-height: 120%;padding-right: 1.25rem;justify-content: flex-start;text-align: left;}
    .accordions__icon {flex: 0 0 58px;isplay: flex;width: 58px;height: 58px;background-color: #f3f3f3;border: 1px solid #5e3607;border-radius: 50%;position: relative;transition: 0.5s cubic-bezier(0.65, 0.2, 0.65, 1);}
    .accordions__icon::before {content: "";width: 1.5625rem;height: 0.3125rem;background-color: #5e3607;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);}
    .accordions__icon::after {content: "";width: 1.5625rem;height: 0.3125rem;background-color: #5e3607;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%) rotate(90deg);}
    .accordions__content {padding: 0 60px 0 60px;max-height: 0;overflow: hidden;will-change: max-height;transition: 0.5s cubic-bezier(0.65, 0.2, 0.65, 1);box-sizing: content-box;position: relative;z-index: 5;color: #5e3607;}
    .accordions__content {padding: 0 30px 0 30px;}
    .open .accordions__content {padding: 20px 60px 40px 60px;}
    .open .accordions__content {padding:20px 30px;}
    .accordions__item.open {background-color: #fff0df;}
    .open .accordions__icon {transform: rotate(225deg);}

    @media (max-width: 767px) {
    .accordions__number { font-size: 40px;padding-right: 0.625rem;}
    .accordions__control {padding: 30px;}
    .accordions__title {font-size: 20px;}
    .accordions__content {padding: 0 30px 0 30px;}
    .open .accordions__content {padding:20px 30px;}
    }

    @media (max-width: 479px) {
    .accordions__list {gap: 1.25rem;}
    .accordions__item {border-radius: 1.5rem;}
    .accordions__control {padding: 20px;}
    .accordions__number {font-size: 20px;}
    .accordions__icon {flex: 0 0 32px;display: flex;width: 32px;height: 32px;}
    .accordions__icon::before {width: 15px;height: 2px;}
    .accordions__icon::after {width: 15px;height: 2px;}
    .accordions__content {padding: 0 20px 0 20px;}
    .open .accordions__content {padding:0px 20px 20px 20px;}
    }
</style>

<div class="suryavanshi_faqs_main">
	<div class="container">
		<div class="faqs_inner_main">
			<h2 class="faqs_top_head">FAQs</h2>
		  <div class="process__container">
		    <div class="process__accordions">
		      <ul class="accordions__list">
                @foreach($faqs as $key => $faq)
                    <li class="accordions__item">
                    <button class="accordions__control" aria-expanded="false">
                        <span class="accordions__number">{{ $key+1 }}</span>
                        <span class="accordions__title">{{ $faq->question }}</span>
                        <span class="accordions__icon"></span>
                    </button>
                    <div class="accordions__content text" aria-hidden="true">
                        {!! $faq->answer !!}
                    </div>
                    </li>
                @endforeach 
		        {{-- <li class="accordions__item">
		          <button class="accordions__control" aria-expanded="false">
		            <span class="accordions__number">02</span>
		            <span class="accordions__title">Research and Strategy Development</span>
		            <span class="accordions__icon"></span>
		          </button>
		          <div class="accordions__content text" aria-hidden="true">
		            <p>In today's marketplace, R&D strategy helps a business take a leading position and keeps it competitive, agile, adaptable, and profitable. The research and development concept is one of the earliest stages in creating a business strategy, but the commercial success of the entire project depends on its successful introduction.</p>
		          </div>
		        </li>
		        <li class="accordions__item">
		          <button class="accordions__control" aria-expanded="false">
		            <span class="accordions__number">03</span>
		            <span class="accordions__title">Implementation</span>
		            <span class="accordions__icon"></span>
		          </button>
		          <div class="accordions__content text" aria-hidden="true">
		            <p>Strategy implementation is the process of turning your strategic plan into action. Whether you're executing a new marketing plan to increase sales or introducing a new work management software to increase efficiency—your plan is only as valuable as the implementation.</p>  
		          </div>
		        </li> --}}
		      </ul>
		    </div>
		  </div>
		</div>
	</div>
</div>
<script>
document.addEventListener('DOMContentLoaded',() => {
const accordions = document.querySelectorAll('.accordions__item');

accordions.forEach(el => {
    el.addEventListener('click', (e) =>{
        const self = e.currentTarget;
        const control = self.querySelector('.accordions__control');
        const content = self.querySelector('.accordions__content');

        self.classList.toggle('open');

        if(self.classList.contains('open')){
            control.setAttribute('aria-expanded', true);
            content.setAttribute('aria-hidden', false);
            content.style.maxHeight = content.scrollHeight + 'px';
        }else{
            control.setAttribute('aria-expanded', false);
            content.setAttribute('aria-hidden', true);
            content.style.maxHeight = null;
        }
    });
    });
})
</script>
@endsection 