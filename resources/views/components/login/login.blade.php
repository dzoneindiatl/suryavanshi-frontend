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
				<input type="hidden" name="return_to" value="{{ old('return_to', request('return_to')) }}">
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