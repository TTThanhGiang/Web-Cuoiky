@extends('layouts.mainWeb')

@section('title', 'Home Page')

@section('content')
    <!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Login/Register</h1>
					<nav class="d-flex align-items-center">
						<a href="{{ route('home.index')}}">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="">Login/Register</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="assets/web/img/login.jpg" alt="">
						<div class="hover">
							<h4>New to our website?</h4>
							<p>Don't have an account? Sign up now!</p>
							<a class="primary-btn" href="{{ route('register') }}">Create an Account</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Log in to enter</h3>
						<form class="row login_form" action="" method="post" >
							@csrf
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
								@error('email')
								<p style="font-size:small; text-align:left; padding-left:15px;height:fit-content; margin-block-end:0px">{{ $message }}</p>
								@enderror
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
								@error('password')
								<p style="font-size:small; text-align:left; padding-left:15px;height:fit-content; margin-block-end:0px">{{ $message }}</p>
								@enderror
							</div>
							<!-- <div class="col-md-12 form-group">
								<div class="create_account">
									<input type="checkbox" id="f-option2" name="selector">
									<label for="f-option2">Keep me logged in</label>
								</div>
							</div> -->
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="primary-btn">Log In</button>
								<a href="{{ route('forgotPassword')}}">Forgot Password?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->
@endsection