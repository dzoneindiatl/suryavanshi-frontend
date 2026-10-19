<div class="bottom_sec_last">
    <div class="container">
        <div class="row">
            <div class="col-md-7" >
                <div class="l-band">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @foreach (range(1, 10) as $slide)
                                <div class="swiper-slide swiper-slide--{{ $slide }}"></div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="instagram-swiper-button">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
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
                                        <div class="con"><h3>WhatsApp</h3></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="inner_stay_connected">
                            <h5>Stay Connected</h5>
                            <ul class="footer_social_links">
                                @foreach (['facebook', 'twitter', 'youtube', 'instagram'] as $social)
                                    <li class="{{ $social === 'twitter' ? 'icon_twitter' : '' }}">
                                        <a target="_blank" href="#">@include('front.home.partials.svg-icon', ['name' => $social])</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
