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
						<a href="">Reset Password</a>
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
							<a class="primary-btn" href="{{ route('login') }}">Login</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Reset Password</h3>
						<form class="row login_form" action="" method="post" >
							@csrf
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="code" placeholder="Code" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Code'">
								@error('code')
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
								<button type="submit" value="submit" class="primary-btn">Reset Password</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->
@endsection