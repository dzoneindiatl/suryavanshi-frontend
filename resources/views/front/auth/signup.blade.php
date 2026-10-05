@extends('front.layouts.app')
@section('content')
<style>
.suryavanshi_signup_main {padding: 80px 0px;text-align: center;}
.login_inner_main h2 {font-weight: 600;position: relative;margin: 0px 0px 16px;font-size: 22px;line-height: 18px;text-align: center;display: inline-block;color: #ba8341;}
.login_txt {max-width: 350px;margin: 0px auto;padding-bottom: 44px;font-size: 14px;color: #3c3c3c;text-align: center;}
.bottom_txt_login p {color: #3c3c3c;font-size: 14px;margin: 0px;}
a.btn_create_acc {color: #8d5615;}
.login_google_btn {position: relative;outline: none;cursor: pointer;user-select: none;-webkit-tap-highlight-color: transparent;box-sizing: border-box;margin: 5px 0px;font-size: 1.4rem;color: rgb(173, 169, 173);border-radius: 50%;border: none;background: rgb(255, 255, 255);box-shadow: rgb(219, 219, 219) 2px 2px 4px;width: 52px;height: 52px;}
.login_google_btn::before {content: "";position: absolute;width: 35px;height: 35px;top: 55%;transform: translateY(-50%);left: 9px;display: inline-block !important;background: url("{{ asset('assets/image/auth_sprite.png') }}") 0% 0% / 340px no-repeat;background-position: -296px -151px;}
.login_facebook_btn {position: relative;outline: none;cursor: pointer;user-select: none;-webkit-tap-highlight-color: transparent;box-sizing: border-box;margin: 5px 0px 5px 16px;font-size: 1.4rem;color: rgb(173, 169, 173);border-radius: 50%;border: none;background: rgb(255, 255, 255);box-shadow: rgb(219, 219, 219) 2px 2px 4px;width: 52px;height: 52px;}
.login_facebook_btn::before {content: "";position: absolute;width: 35px;height: 35px;top: 25px;transform: translateY(-50%);left: 9px;display: inline-block;background: url("{{ asset('assets/image/auth_sprite.png') }}") 0% 0% / 340px no-repeat;background-position: -251px -148px;}
.signup_action {margin-top: 30px;}
.signup_action {color: #000;font-size: 14px;line-height: 18px;margin: 30px 0px 55px;text-align: center;}
.signup_action span {position: relative;}
.signup_action span::before {content: "";width: 132px;height: 3px;position: absolute;top: 50%;left: -146px;background: linear-gradient(269.97deg, rgb(241 187 122) 4.18%, rgba(196, 196, 196, 0) 77.28%);}
.signup_action span::after {content: "";width: 132px;height: 3px;position: absolute;top: 50%;background: linear-gradient(269.97deg, rgb(241 187 122) 4.18%, rgba(196, 196, 196, 0) 77.28%);transform: rotate(-180deg);right: -146px;}
.signup_form_main {max-width: 720px;margin: 0px auto;}
.input_form input.form-control {font-size: 14px;text-align: left;color: rgb(79, 50, 103);padding: 0px 16px;margin: 0px;line-height: 48px;width: 100%;height: 48px;border: 1px solid rgb(246, 243, 249); border-radius: 12px;cursor: text;outline: none;background: rgb(246, 243, 249);}
.input_form input.form-control::-webkit-input-placeholder {color: rgb(79, 50, 103);}
.input_form input.form-control::-moz-placeholder {color: rgb(79, 50, 103);}
.input_form input.form-control:-ms-input-placeholder {color: rgb(79, 50, 103);}
.input_form input.form-control:-moz-placeholder {color: rgb(79, 50, 103);}
.signup_form_inner {display: flex;gap: 25px;margin-bottom: 25px;}
.input_form {width: 50%;}
.radio_int {margin: 0.5rem;}
.radio_int input[type="radio"] {position: absolute;opacity: 0;}
.radio_int input[type=radio] + .radio-label:before {content: "";background: #fff;border-radius: 100%;border: 2px solid #b4b4b4;display: inline-block;width: 1.4em;height: 1.4em;position: relative;top: 1px;margin-right: 6px;vertical-align: top;cursor: pointer;text-align: center;transition: all 250ms ease;}
.radio_int input[type=radio]:checked + .radio-label:before {background-color: #ba8442;border: 2px solid #bb8442;box-shadow: inset 0 0 0 4px #fff;}
.signup_form_radio {display: flex;align-items: center;}
label.radio-label {font-size: 14px;font-weight: 400;cursor: pointer;}
.whatsapp_support_box {position: relative;background-color: rgb(229, 244, 224);padding: 14px;border-radius: 24px;width: 100%;margin-bottom: 20px;margin-top: 20px;text-align: left;}
label.checkbox-label {font-size: 14px;font-weight: 400;cursor: pointer;padding-left: 30px;position: relative;text-align: left;}
.check_int input[type="checkbox"] {position: absolute;opacity: 0;}
.check_int input[type=checkbox] + .checkbox-label:before {content: "";background: #fff;border-radius: 4px;border: 2px solid #939393;display: inline-block;width: 1.4em;height: 1.4em;position: absolute;top: 4px;left: 0px;margin-right: 6px;vertical-align: top;cursor: pointer;text-align: center;transition: all 250ms ease;}
.check_int input[type=checkbox]:checked + .checkbox-label:before {background-color: #ba8442;border: 2px solid #bb8442;box-shadow: inset 0 0 0 4px #fff;}
.opt_inner_text {display: block;font-size: 10px;}
.opt_support_txt {font-weight: 600;}
.opt_whatsapp_img {display: block;position: absolute;top: 4px;right: 5px;width: 35px;height: 35px;background-color: rgb(244, 254, 241);border-radius: 12px;cursor: pointer;}
.opt_whatsapp_img::after {content: "";background: url("{{ asset('assets/image/auth_sprite.png') }}") -217px -156px / 340px no-repeat;width: 21px;height: 23px;position: absolute;display: inline-block;top: 6px;left: 7px;}
.check_int {position: relative;}
.txt_privacy {font-size: 13px;}
.txt_privacy a {color: #8d5615;}
.btn_sign_me {position: relative;outline: none;user-select: none;-webkit-tap-highlight-color: transparent;width: 100%;box-sizing: border-box;color: rgb(255, 255, 255);background: linear-gradient(to right, rgb(186 131 66), rgb(145 92 31));border: none;font-size: 16px;line-height: 42px;border-radius: 12px;margin: 15px 0px 13px;height: 48px;max-width: 290px;}
</style>
<div class="suryavanshi_signup_main">
	<div class="container">
		<div class="login_inner_main">
			<h2>Signup to Suryavanshi</h2>
			<p class="login_txt">Unlock Best prices and become an insider for our exclusive launches & offers. Complete your profile and get ₹250 worth of xCLusive Points</p>
			
            <div class="login_another_btn">
                <button type="button" class="login_google_btn"
                    onclick="window.location.href='{{ url('/auth/google') }}'">
                </button>

                <button type="button" class="login_facebook_btn"
                    onclick="window.location.href='{{ url('/auth/facebook') }}'">
                </button>
            </div>
			
            <h3 class="signup_action"><span>Or continue with</span></h3>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul class="mt-2 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('front-user.postSignup') }}" method="POST" enctype="multipart/form-data">
                @csrf 
                <div class="signup_form_main">
                    <div class="signup_form_inner">
                        <div class="input_form">
                            <input id="mobilenumber" class="form-control" name="phone_number" type="text" placeholder="Mobile Number">
                        </div>
                        <div class="input_form">
                            <input id="enteremail" class="form-control" name="email" type="text" placeholder="Enter Email">
                        </div>
                    </div>
                    <div class="signup_form_inner">
                        <div class="input_form">
                            <input id="firstname" class="form-control" type="text" name="first_name" placeholder="First Name">
                        </div>
                        <div class="input_form">
                            <input id="lastname" class="form-control" type="text" name="last_name" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="signup_form_inner">
                        <div class="input_form">
                            <input id="password" class="form-control" type="password" name="password" placeholder="Enter Password">
                        </div>
                        <div class="input_form">
                            <input id="password" class="form-control" type="password" name="confirm_password" placeholder="Enter Confirm Password">
                        </div>
                    </div>
                    <div class="signup_form_radio">
                        
                        <div class="radio_int">
                            <input id="radiomale" name="gender" type="radio" value="M">
                            <label for="radiomale" class="radio-label">Male</label>
                        </div>

                        <div class="radio_int">
                            <input id="radiofemale" name="gender" type="radio" value="F">
                            <label for="radiofemale" class="radio-label">Female</label>
                        </div>

                        <div class="radio_int">
                            <input id="radioother" name="gender" type="radio" value="O">
                            <label for="radioother" class="radio-label">Others</label>
                        </div>
                    </div>
                    {{-- <div class="whatsapp_support_box">
                        <div class="check_int">
                            <input id="checkwhatspp" name="checkwhatspp" type="checkbox">
                            <label for="checkwhatspp" class="checkbox-label">
                                <span class="opt_support_txt">Opt for Whatsapp Support</span>
                                <span class="opt_inner_text">We will be sharing Delivery &amp; precious order related communication. Also provide you with an interactive whatsapp support</span>
                            </label>
                            <span class="opt_whatsapp_img"></span>
                        </div>
                    </div> --}}
                   
                    <div class="txt_privacy">By continuing you acknowledge that you are at least 18 years old and have read and agree to CaratLane's <a href="#" target="_blank">terms and conditions</a> &amp; <a href="#" target="_blank">privacy policy</a>.</div>
                    <button type="submit" class="btn_sign_me">SIGN ME UP</button>
                </div>
            </form>
			
			<div class="bottom_txt_login">
				<p>Already have an account? <a href="{{ route('front-user.login') }}" class="btn_create_acc">LOG IN</a></p>
			</div>
		</div>
	</div>
</div>

@endsection