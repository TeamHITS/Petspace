@extends('website.layouts.app')
@section('content')

	<section class="auth-top">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-3">
					<div class="logo-wrap">
						<img src="{{ url('public/assets/images/logo.png') }}" alt="logo" class="img-fluid">
					</div>
				</div>
				<div class="col-lg-8 col-md-8 col-9">
					<ul class="auth-top-btn">
						<li><a href="#!">Need assistance?</a></li>
						<li><a href="#!" class="gen-btn">Contact Petspace</a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section class="auth-main-sec">
		<div class="container">
			<div class="auth-card">
				<form id="submit-form" action="{{URL::to('/reset-password')}}" method="POST">
					<div class="form-top">
					    <p class="title">New Password</p>
					    <p class="sub-title">Please enter your credentials to proceed.</p>
					</div>
					<div class="error-notification" id="response-alert" style="display: none;">
						<p>You entered an incorrect email/password.</p>
					</div>
					<div class="form-group">
						<label>New Password</label>
						<input type="password" name="password" class="form-control" required>
						<input type="hidden" name="verification_code" value="{{$data['key']}}">
						<input type="hidden" name="email" value="{{$data['email']}}">
						<ul class="password-criteria">
							<li>• 	At least 8 characters</li>
							<li>• 	Invalid email format.</li>
							<li>• 	One number or special character</li>
						</ul>
					</div>
					<div class="form-group">
						<label>Confirm Password</label>
						<input type="password"  name="password_confirmation" class="form-control" required>
					</div>
					<div class="form-group mb-0">
						<button type="submit" class="submit-btn">Sign In</button>
					</div>
				</form>
			</div>
		</div>
	</section>
@endsection
