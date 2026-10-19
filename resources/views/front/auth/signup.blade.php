@extends('front.layouts.app')
@section('content')
<style>
.suryavanshi_signup_main {
    padding: clamp(35px, 6vw, 75px) 15px;
    background: linear-gradient(180deg, #fdfbf8 0%, #faf6f0 100%);
    min-height: calc(100vh - 180px);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow-x: hidden;
}

.suryavanshi_signup_main .container {
    max-width: 1200px;
    width: 100%;
    margin: 0 auto;
    padding: 0 10px;
}

.login_inner_main {
    max-width: 740px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 24px;
    padding: 44px 40px;
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
    max-width: 520px;
    margin: 0 auto 28px;
    font-size: clamp(13px, 2.4vw, 14.5px);
    line-height: 1.6;
    color: #555555;
    text-align: center;
}

/* Social Buttons */
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
.signup_action {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    margin: 0 auto 28px;
    max-width: 380px;
    width: 100%;
    padding: 0 10px;
    color: #777777;
    font-size: 13.5px;
    font-weight: 500;
    box-sizing: border-box;
}

.signup_action::before,
.signup_action::after {
    content: "";
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(186, 131, 65, 0.4), transparent);
}

.signup_action span {
    white-space: nowrap;
}

/* Alerts */
.auth_alert {
    max-width: 640px;
    margin: 0 auto 22px;
    text-align: left;
    border-radius: 12px;
    font-size: 14px;
}

/* Form Layout */
.signup_form_main {
    max-width: 640px;
    margin: 0 auto;
    width: 100%;
}

.signup_form_inner {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.input_form {
    width: 100%;
}

.input_form input.form-control {
    font-size: 15px;
    text-align: left;
    color: #333333;
    padding: 0 18px;
    margin: 0;
    height: 50px;
    line-height: 50px;
    width: 100%;
    border: 1.5px solid #ece7f2;
    border-radius: 12px;
    background: #fbfafc;
    outline: none;
    box-shadow: none;
    box-sizing: border-box;
    transition: all 0.25s ease;
}

.input_form input.form-control::-webkit-input-placeholder { color: #8c8299; }
.input_form input.form-control::-moz-placeholder { color: #8c8299; }
.input_form input.form-control:-ms-input-placeholder { color: #8c8299; }
.input_form input.form-control:-moz-placeholder { color: #8c8299; }

.input_form input.form-control:hover {
    border-color: #d6b27e;
    background: #ffffff;
}

.input_form input.form-control:focus {
    border-color: #ba8341;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(186, 131, 65, 0.15);
}

/* Radio Buttons */
.signup_form_radio {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    gap: 24px;
    margin: 18px 0 22px;
}

.radio_int {
    margin: 0;
    display: inline-flex;
    align-items: center;
}

.radio_int input[type="radio"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.radio_int input[type="radio"] + .radio-label {
    display: inline-flex;
    align-items: center;
    cursor: pointer;
    font-size: 14.5px;
    font-weight: 500;
    color: #444444;
    user-select: none;
    transition: color 0.2s ease;
    min-height: 36px;
}

.radio_int input[type="radio"] + .radio-label:before {
    content: "";
    background: #ffffff;
    border-radius: 50%;
    border: 2px solid #b8b8b8;
    display: inline-block;
    width: 20px;
    height: 20px;
    margin-right: 8px;
    box-sizing: border-box;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    flex-shrink: 0;
}

.radio_int input[type="radio"]:checked + .radio-label:before {
    background-color: #ba8442;
    border: 2px solid #bb8442;
    box-shadow: inset 0 0 0 4px #ffffff;
}

.radio_int input[type="radio"]:checked + .radio-label {
    color: #ba8442;
    font-weight: 600;
}

/* Privacy Text */
.txt_privacy {
    font-size: 12.5px;
    line-height: 1.6;
    color: #666666;
    max-width: 560px;
    margin: 0 auto 20px;
    padding: 0 10px;
    box-sizing: border-box;
}

.txt_privacy a {
    color: #ba8341;
    font-weight: 600;
    text-decoration: underline;
    transition: color 0.2s;
}

.txt_privacy a:hover {
    color: #8d5615;
}

/* Submit Button */
.btn_sign_me {
    position: relative;
    outline: none;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    width: 100%;
    max-width: 320px;
    height: 50px;
    box-sizing: border-box;
    color: #ffffff;
    background: linear-gradient(135deg, #ba8341 0%, #8d5615 100%);
    border: none;
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 0.5px;
    border-radius: 12px;
    margin: 8px auto 22px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(186, 131, 65, 0.25);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn_sign_me:hover {
    background: linear-gradient(135deg, #c9914e 0%, #9e631d 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(186, 131, 65, 0.38);
    color: #ffffff;
}

.btn_sign_me:active {
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
    .suryavanshi_signup_main {
        padding: 30px 12px 45px;
    }

    .login_inner_main {
        padding: 30px 20px;
        border-radius: 18px;
    }

    .signup_form_inner {
        grid-template-columns: 1fr;
        gap: 14px;
        margin-bottom: 14px;
    }

    .input_form input.form-control {
        font-size: 16px; /* Prevents auto-zoom on iOS */
        height: 48px;
        line-height: 48px;
    }

    .signup_form_radio {
        gap: 16px;
        margin: 14px 0 18px;
    }

    .btn_sign_me {
        max-width: 100%;
        height: 48px;
        font-size: 14.5px;
    }
}

@media (max-width: 420px) {
    .suryavanshi_signup_main {
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

    .signup_action {
        gap: 10px;
        font-size: 12.5px;
        margin-bottom: 22px;
    }

    .signup_form_radio {
        gap: 12px;
    }

    .radio_int input[type="radio"] + .radio-label {
        font-size: 13.5px;
    }

    .txt_privacy {
        font-size: 12px;
    }
}
</style>

<div class="suryavanshi_signup_main">
    <div class="container">
        <div class="login_inner_main">
            <h2>Signup to Suryavanshi</h2>
            <p class="login_txt">Unlock best prices and become an insider for our exclusive launches &amp; offers. Complete your profile and get ₹250 worth of xCLusive Points.</p>
            
            <div class="login_another_btn">
                <a href="{{ url('/auth/google') }}" class="login_google_btn" title="Continue with Google" aria-label="Continue with Google"></a>
                <a href="{{ url('/auth/facebook') }}" class="login_facebook_btn" title="Continue with Facebook" aria-label="Continue with Facebook"></a>
            </div>
            
            <h3 class="signup_action"><span>Or continue with</span></h3>

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

            <form action="{{ route('front-user.postSignup') }}" method="POST" enctype="multipart/form-data">
                @csrf 
                <div class="signup_form_main">
                    <div class="signup_form_inner">
                        <div class="input_form">
                            <input id="mobilenumber" class="form-control" name="phone_number" type="tel" value="{{ old('phone_number') }}" placeholder="Mobile Number" required>
                        </div>
                        <div class="input_form">
                            <input id="enteremail" class="form-control" name="email" type="email" value="{{ old('email') }}" placeholder="Enter Email" required>
                        </div>
                    </div>
                    <div class="signup_form_inner">
                        <div class="input_form">
                            <input id="firstname" class="form-control" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required>
                        </div>
                        <div class="input_form">
                            <input id="lastname" class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="signup_form_inner">
                        <div class="input_form">
                            <input id="signup_password" class="form-control" type="password" name="password" placeholder="Enter Password" required>
                        </div>
                        <div class="input_form">
                            <input id="signup_confirm_password" class="form-control" type="password" name="confirm_password" placeholder="Enter Confirm Password" required>
                        </div>
                    </div>
                    <div class="signup_form_radio">
                        <div class="radio_int">
                            <input id="radiomale" name="gender" type="radio" value="M" {{ old('gender') == 'M' ? 'checked' : '' }}>
                            <label for="radiomale" class="radio-label">Male</label>
                        </div>

                        <div class="radio_int">
                            <input id="radiofemale" name="gender" type="radio" value="F" {{ old('gender', 'F') == 'F' ? 'checked' : '' }}>
                            <label for="radiofemale" class="radio-label">Female</label>
                        </div>

                        <div class="radio_int">
                            <input id="radioother" name="gender" type="radio" value="O" {{ old('gender') == 'O' ? 'checked' : '' }}>
                            <label for="radioother" class="radio-label">Others</label>
                        </div>
                    </div>
                   
                    <div class="txt_privacy">By continuing you acknowledge that you are at least 18 years old and agree to Suryavanshi's <a href="#" target="_blank">terms and conditions</a> &amp; <a href="#" target="_blank">privacy policy</a>.</div>
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