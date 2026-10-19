@extends('front.layouts.app')
@section('content')
<style>
.suryavanshi_login_main {padding: 80px 0px;text-align: center;}
.login_inner_main h2 {font-weight: 600;position: relative;margin: 0px 0px 16px;font-size: 22px;line-height: 18px;text-align: center;display: inline-block;color: #ba8341;}
.login_txt {max-width: 350px;margin: 0px auto;padding-bottom: 44px;font-size: 14px;color: #3c3c3c;text-align: center;}
.input_login_btn {margin-bottom: 25px;}
input.input_txt_login {font-size: 14px;text-align: left;color: rgb(79, 50, 103);padding: 0px 16px;margin: 0px;line-height: 48px;width: 290px;height: 48px;border: 1px solid rgb(246, 243, 249);border-radius: 12px;cursor: text;outline: none;background: rgb(246, 243, 249);}
input.input_txt_login::-webkit-input-placeholder {color: rgb(79, 50, 103);}
input.input_txt_login::-moz-placeholder {color: rgb(79, 50, 103);}
input.input_txt_login:-ms-input-placeholder {color: rgb(79, 50, 103);}
input.input_txt_login:-moz-placeholder {color: rgb(79, 50, 103);}
.btn_con_login {position: relative;outline: none;user-select: none;-webkit-tap-highlight-color: transparent;width: 100%;box-sizing: border-box;color: rgb(255, 255, 255);background: linear-gradient(to right, rgb(186 131 66), rgb(145 92 31));border: none;font-size: 16px;line-height: 42px;border-radius: 12px;margin: 0px 0px 32px;height: 48px;max-width: 290px;}
.bottom_txt_login p {color: #3c3c3c;font-size: 14px;margin: 0px;}
a.btn_create_acc {color: #8d5615;}
.login_google_btn {position: relative;outline: none;cursor: pointer;user-select: none;-webkit-tap-highlight-color: transparent;box-sizing: border-box;margin: 5px 0px;font-size: 1.4rem;color: rgb(173, 169, 173);border-radius: 50%;border: none;background: rgb(255, 255, 255);box-shadow: rgb(219, 219, 219) 2px 2px 4px;width: 52px;height: 52px;}
.login_google_btn::before {content: "";position: absolute;width: 35px;height: 35px;top: 10%;transform: translateY(-50%);left: 9px;display: inline-block !important;background: url("{{ asset('assets/image/auth_sprite.png') }}") 0% 0% / 340px no-repeat;background-position: -296px -151px;margin-left: -45px;}
.login_facebook_btn {position: relative;outline: none;cursor: pointer;user-select: none;-webkit-tap-highlight-color: transparent;box-sizing: border-box;margin: 5px 0px 5px 16px;font-size: 1.4rem;color: rgb(173, 169, 173);border-radius: 50%;border: none;background: rgb(255, 255, 255);box-shadow: rgb(219, 219, 219) 2px 2px 4px;width: 52px;height: 52px;}
.login_facebook_btn::before {content: "";position: absolute;width: 40px;height: 40px;top: 5px;transform: translateY(-50%);left: 9px;display: inline-block;background: url("{{ asset('assets/image/auth_sprite.png') }}") 0% 0% / 340px no-repeat;background-position: -251px -148px;}
</style>
<div class="suryavanshi_login_main">
	<div class="container">
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
		<div class="login_inner_main">
			<form id="loginForm" action="{{ route('front-user.postLogin') }}" autocomplete="off" method="POST">
                @csrf
				<h2>Login to </h2>
				<p class="login_txt">Login to unlock best prices and become an insider for our exclusive launches &amp; offers. Complete your profile and get ₹250 worth of xCLusive Points.</p>
				<div class="input_login_btn">
					<input id="inputmobileemail" class="input_txt_login" type="text" name="email" autocomplete="off" placeholder="Enter Email">
				</div>
				<div class="input_login_btn">
					<input type="password" class="input_txt_login" name="password" placeholder="Enter Password">
				</div>
				<button type="submit" class="btn_con_login">CONTINUE TO LOGIN</button>
				<div class="login_another_btn">
					{{-- <button class="login_google_btn" onclick="window.location.href='{{ url('/auth/google') }}'"></button> --}}
					<a href="{{ url('/auth/google') }}" class="login_google_btn"></a>
					<a href="{{ url('/auth/facebook') }}" class="login_facebook_btn"></a>
				</div>
				<div class="bottom_txt_login">
					<p>New to jaipur Jewellery House? <a href="{{ route('front-user.signup') }}" class="btn_create_acc">Create an Account</a></p>
				</div>
			</form>		
		</div>
	</div>
</div>




@endsection