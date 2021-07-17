@extends('technician.layouts.app')
@section('content')
<div class="technician-dashboard-wrap">
	<section class="technician-dash-top auth-top">
		<a href="{{URL::to('/technician/home')}}" class="pg-title"><i class="fas fa-chevron-left mr-1"></i>My Account</a>
	</section>
	<div class="technicain-dash-body technicain-account">
		<div class="technician-account-img">
			<p>{{$user['user']['details']['full_name'][0]}}</p>
		</div>
		<div class="account-info-wrap">
			<div class="account-info">
				<p>Name</p>
				<p>{{$user['user']['details']['full_name']}}</p>
			</div>
			<div class="account-info">
				{{--<p>Store unique ID</p>--}}
				<p>Email</p>
				<p>{{$user['user']['email']}}</p>
			</div>
			<div class="account-info">
				<p>Mobile Number</p>
				<p>{{$user['user']['details']['phone']}}</p>
			</div>
		</div>
		<div class="text-center">
			<a href="{{URL::to('/technician/logout')}}" class="sign-out">SIGN OUT</a>
		</div>
	</div>
</div>
@endsection

