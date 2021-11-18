@extends('technician.layouts.app')
@section('content')
<div class="technician-dashboard-wrap tech-dash-login">

	<section class="auth-main-sec">
		<div class="container">
			<div class="auth-card technician-login-form">
				<div class="logo-wrap text-center">
					<img src="{{ url('public/assets/images/logo.png') }}" alt="logo" class="img-fluid">
				</div>
				<form  id="submit-form"  action="{{URL::to('/technician/logining')}}" method="POST">
					<div class="form-top">
					    <p class="title mb-3">Sign In</p>
					    <p class="sub-title">Please enter your credentials to proceed.</p>
					</div>
					<div class="error-notification" id="response-alert" style="display: none;">
						<p>You entered an incorrect email/password.</p>
					</div>
					<div class="form-group">
						{{--<label>STORE UNIQUE ID</label>--}}
						<label>EMAIL</label>
						<input type="email" name="email" class="form-control">
						<input type="hidden" name="device_type" value="web">
					</div>
					<div class="form-group">
						<label class="d-flex justify-content-between">
							<span>PASSWORD PIN</span>
						</label>
						<input type="password" name="password" class="form-control">
					</div>
					<div class="form-group">
						<div class="sm-check-box">Keep me logged in
						  <input type="checkbox" name="chk-keep-login" checked>
						  <span class="checkmark"></span>
						</div>
					</div>
					<div class="form-group mb-0">
						<button type="submit" class="submit-btn">Sign In</button>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>
@endsection

