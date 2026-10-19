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