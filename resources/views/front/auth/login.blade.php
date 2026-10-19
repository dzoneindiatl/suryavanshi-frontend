@extends('front.layouts.app')
@section('content')
<style>
.suryavanshi_login_main {
    padding: clamp(35px, 6vw, 75px) 15px;
    background: linear-gradient(180deg, #fdfbf8 0%, #faf6f0 100%);
    min-height: calc(100vh - 180px);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow-x: hidden;
}

.suryavanshi_login_main .container {
    max-width: 1200px;
    width: 100%;
    margin: 0 auto;
    padding: 0 10px;
}

.login_inner_main {
    max-width: 480px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 24px;
    padding: 44px 38px;
    box-shadow: 0 15px 45px rgba(186, 131, 65, 0.08), 0 2px 8px rgba(0, 0, 0, 0.02);
    border: 1px solid rgba(186, 131, 65, 0.16);
    text-align: center;
    box-sizing: border-box;
    width: 100%;
}

.login_inner_main h2 {
    font-weight: 700;
    margin: 0 0 12px;
    font-size: clamp(22px, 3.5vw, 28px);
    line-height: 1.3;
    text-align: center;
    color: #ba8341;
    letter-spacing: -0.2px;
}

.login_txt {
    max-width: 380px;
    margin: 0 auto 24px;
    font-size: clamp(13px, 2.4vw, 14.5px);
    line-height: 1.6;
    color: #555555;
    text-align: center;
}

/* Social Login Buttons */
.login_another_btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 18px;
    margin: 0 0 24px;
}

.login_google_btn,
.login_facebook_btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 52px;
    height: 52px;
    border-radius: 50%;
    border: 1px solid rgba(0, 0, 0, 0.08);
    background: #ffffff;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
    cursor: pointer;
    outline: none;
    padding: 0;
    margin: 0;
    position: relative;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    -webkit-tap-highlight-color: transparent;
    text-decoration: none;
}

.login_google_btn:hover,
.login_facebook_btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(186, 131, 65, 0.28);
    border-color: rgba(186, 131, 65, 0.4);
}

.login_google_btn:active,
.login_facebook_btn:active {
    transform: translateY(0);
}

.login_google_btn::before {
    content: "";
    display: block;
    width: 35px;
    height: 35px;
    background: url("{{ asset('assets/image/auth_sprite.png') }}") 0% 0% / 340px no-repeat;
    background-position: -296px -151px;
}

.login_facebook_btn::before {
    content: "";
    display: block;
    width: 35px;
    height: 35px;
    background: url("{{ asset('assets/image/auth_sprite.png') }}") 0% 0% / 340px no-repeat;
    background-position: -251px -148px;
}

/* Responsive Divider */
.login_divider {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    margin: 0 auto 24px;
    max-width: 340px;
    width: 100%;
    padding: 0 10px;
    color: #777777;
    font-size: 13.5px;
    font-weight: 500;
    box-sizing: border-box;
}

.login_divider::before,
.login_divider::after {
    content: "";
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(186, 131, 65, 0.4), transparent);
}

.login_divider span {
    white-space: nowrap;
}

/* Alerts */
.auth_alert {
    max-width: 480px;
    margin: 0 auto 22px;
    text-align: left;
    border-radius: 12px;
    font-size: 14px;
}

/* Form Inputs */
.login_form_inner {
    max-width: 380px;
    margin: 0 auto;
    width: 100%;
}

.input_login_btn {
    margin-bottom: 18px;
    width: 100%;
}

input.input_txt_login {
    font-size: 15px;
    text-align: left;
    color: #333333;
    padding: 0 18px;
    margin: 0;
    line-height: 50px;
    width: 100%;
    height: 50px;
    border: 1.5px solid #ece7f2;
    border-radius: 12px;
    cursor: text;
    outline: none;
    background: #fbfafc;
    box-shadow: none;
    box-sizing: border-box;
    transition: all 0.25s ease;
}

input.input_txt_login::-webkit-input-placeholder { color: #8c8299; }
input.input_txt_login::-moz-placeholder { color: #8c8299; }
input.input_txt_login:-ms-input-placeholder { color: #8c8299; }
input.input_txt_login:-moz-placeholder { color: #8c8299; }

input.input_txt_login:hover {
    border-color: #d6b27e;
    background: #ffffff;
}

input.input_txt_login:focus {
    border-color: #ba8341;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(186, 131, 65, 0.15);
}

/* Submit Button */
.btn_con_login {
    position: relative;
    outline: none;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    width: 100%;
    max-width: 380px;
    height: 50px;
    box-sizing: border-box;
    color: #ffffff;
    background: linear-gradient(135deg, #ba8341 0%, #8d5615 100%);
    border: none;
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 0.5px;
    border-radius: 12px;
    margin: 6px auto 24px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(186, 131, 65, 0.25);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn_con_login:hover {
    background: linear-gradient(135deg, #c9914e 0%, #9e631d 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(186, 131, 65, 0.38);
    color: #ffffff;
}

.btn_con_login:active {
    transform: translateY(0);
    box-shadow: 0 2px 6px rgba(186, 131, 65, 0.25);
}

/* Bottom Text */
.bottom_txt_login {
    margin-top: 6px;
}

.bottom_txt_login p {
    color: #555555;
    font-size: 14px;
    margin: 0;
}

.bottom_txt_login a.btn_create_acc {
    color: #ba8341;
    font-weight: 600;
    text-decoration: none;
    margin-left: 4px;
    transition: color 0.2s;
}

.bottom_txt_login a.btn_create_acc:hover {
    color: #8d5615;
    text-decoration: underline;
}

/* Responsive Breakpoints */
@media (max-width: 767px) {
    .suryavanshi_login_main {
        padding: 30px 12px 45px;
    }

    .login_inner_main {
        padding: 30px 20px;
        border-radius: 18px;
    }

    input.input_txt_login {
        font-size: 16px; /* Prevents auto-zoom on iOS */
        height: 48px;
        line-height: 48px;
    }

    .btn_con_login {
        height: 48px;
        font-size: 14.5px;
    }
}

@media (max-width: 420px) {
    .suryavanshi_login_main {
        padding: 20px 8px 35px;
    }

    .login_inner_main {
        padding: 24px 14px;
        border-radius: 16px;
    }

    .login_txt {
        font-size: 13px;
        margin-bottom: 20px;
    }

    .login_divider {
        gap: 10px;
        font-size: 12.5px;
        margin-bottom: 20px;
    }
}
</style>

<div class="suryavanshi_login_main">
    <div class="container">
        <div class="login_inner_main">
            <h2>Login to Suryavanshi</h2>
            <p class="login_txt">Login to unlock best prices and become an insider for our exclusive launches &amp; offers. Complete your profile and get ₹250 worth of xCLusive Points.</p>
            
            <div class="login_another_btn">
                <a href="{{ url('/auth/google') }}" class="login_google_btn" title="Continue with Google" aria-label="Continue with Google"></a>
                <a href="{{ url('/auth/facebook') }}" class="login_facebook_btn" title="Continue with Facebook" aria-label="Continue with Facebook"></a>
            </div>

            <div class="login_divider"><span>Or continue with email</span></div>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show auth_alert" role="alert">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul class="mt-2 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show auth_alert" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show auth_alert" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form id="loginForm" class="login_form_inner" action="{{ route('front-user.postLogin') }}" autocomplete="off" method="POST">
                @csrf
                <div class="input_login_btn">
                    <input id="inputmobileemail" class="input_txt_login form-control" type="email" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Enter Email" required>
                </div>
                <div class="input_login_btn">
                    <input type="password" class="input_txt_login form-control" name="password" placeholder="Enter Password" autocomplete="current-password" required>
                </div>
                <button type="submit" class="btn_con_login">CONTINUE TO LOGIN</button>
            </form>

            <div class="bottom_txt_login">
                <p>New to Suryavanshi? <a href="{{ route('front-user.signup') }}" class="btn_create_acc">Create an Account</a></p>
            </div>
        </div>
    </div>
</div>
@endsection