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
							<p>Already have an account? Sign in now!</p>
							<a class="primary-btn" href="{{ route('login') }}">Log in</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Register to enter</h3>
						@if (session('error'))
							<p>{{ session('error') }}</p>
						@endif
						<form class="row login_form" action="" method="POST" >
							@csrf
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="name" placeholder="Name"  required>
							</div>
							<div class="col-md-12 form-group">
								<input type="email" class="form-control"  name="email" placeholder="Email"  required>
								@error('email')
								<p style="font-size:small; text-align:left; padding-left:15px;height:fit-content; margin-block-end:0px">{{ $message }}</p>
								@enderror
							</div>
                            <div class="col-md-12 form-group">
								<input type="text" class="form-control"  name="address" placeholder="Address"  required>
							</div>
                            <div class="col-md-12 form-group">
								<input type="text" class="form-control"  name="phone" placeholder="Phone"  required>
								@error('phone')
								<p style="font-size:small; text-align:left; padding-left:15px;height:fit-content; margin-block-end:0px">{{ $message }}</p>
								@enderror
							</div>
                            <div class="col-md-12 form-group">
								<input type="password" class="form-control"  name="password" placeholder="Password"  required>
								@error('password')
								<p style="font-size:small; text-align:left; padding-left:15px;height:fit-content; margin-block-end:0px">{{ $message }}</p>
								@enderror
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control"  name="confirm_password" placeholder="Password Confirm" required>
								@error('confirm_password')
								<p style="font-size:small; text-align:left; padding-left:15px;height:fit-content; margin-block-end:0px">{{ $message }}</p>
								@enderror
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="primary-btn">Register</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->
@endsection