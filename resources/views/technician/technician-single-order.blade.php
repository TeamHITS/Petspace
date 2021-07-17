@extends('technician.layouts.app')
@section('content')
<div class="technician-dashboard-wrap">
	<section class="technician-dash-top auth-top">
		<a href="{{URL::to('/technician/home')}}" class="pg-title"><i class="fas fa-chevron-left mr-1"></i> Order #{{$order['id']}}</a>
	</section>
	<div class="technicain-dash-body technicain-single-order">
		<div class="technicain-card mb-3">
			<div class="top mb-3">
				<div class="img">
					<img src="{{$order['user']['details']['image_url']}}" alt="icon" class="img-fluid" style="width: 300px;border-radius: 13px;">
				</div>
				<p>{{$order['user']['details']['full_name']}}</p>
			</div>
			<div class="card-desc mb-3">
				<p class="heading">Date & Time</p>
				<p class="desc">{{date('d/m/Y H:i',strtotime($order['date_time'])) }}</p>
			</div>
			<div class="card-desc">
				<p class="heading">Address</p>
				<p class="desc">{{$order['address']['address'] }}</p>
			</div>
		</div>
		@if(isset($order['note']))
		<div class="shadow-card mb-3 bor-rad-0">
			<div class="order-instrustion">
				<p class="title">Special Instructions </p>
				<p>{{$order['note']}}</p>
			</div>
		</div>
		@endif
		<div class="shadow-card mb-3 bor-rad-0">
			<div class="ordered-services">
				<p class="heading">Ordered Services</p>
				@foreach($order['services'] as $service)
				<div class="ordered-service">
					<div class="desc">
						<p class="name">{{$service['service_name']}}</p>
						<p>For {{ strtolower($service['addons'][0]['submenu_name'])}} sized pet</p>
						<p>Service Duration: {{$service['duration']}}m</p>
					</div>
					<div class="ordered-service addons">
						@for($i = 1; $i < count($service['addons']); $i++)
						<div class="desc">
							<p class="name">{{$service['addons'][$i]['submenu_name']}}</p>
							<p>Addon</p>
							<p>Service Duration: {{$service['addons'][$i]['duration']}}m</p>
						</div>
							@endfor
					</div>
					<div class="profile">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#order-profile-1" aria-expanded="false" aria-controls="order-profile-1">
							Pet Profile <i class="fas fa-chevron-down"></i>
						</button>
						<div id="order-profile-1" class="accordion-collapse collapse" style="">
							<div class="accordion-body">
								<div class="profile-info">
									<div class="name">
										<p class="title">NAME</p>
										<p class="info">{{$service['pet']['name']}}</p>
									</div>
									<div class="age">
										<p class="title">TYPE</p>
										<p class="info">{{$service['pet']['type_text']}}</p>
									</div>
									<div class="breed">
										<p class="title">BREED</p>
										<p class="info">{{$service['pet']['breed']}}</p>
									</div>
									{{--<div class="weight">
										<p class="title">WEIGHT</p>
										<p class="info">{{$service['pet']['weight']}} kgs</p>
									</div>--}}
									<div class="weight">
										<p class="title">GENDER</p>
										<p class="info">{{$service['pet']['gender_text']}}</p>
									</div>
									@if(isset($service['pet']['instruction']))
									<div class="allergies">
										<p class="title">ALLERGIES</p>
										<p class="info">{{$service['pet']['instruction']}}</p>
									</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
				{{--<div class="ordered-service">
					<div class="desc">
						<p class="name">Bath &amp; Bodywash (Package 1)  x1</p>
						<p>For medium sized pet</p>
						<p>Service Duration: 50m</p>
					</div>
					<div class="ordered-service addons">
						<div class="desc">
							<p class="name">Pawdicure</p>
							<p>Addon</p>
							<p>Service Duration: 50m</p>
						</div>
					</div>
					<div class="profile">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#order-profile-2" aria-expanded="false" aria-controls="order-profile-2">
							Pet Profile <i class="fas fa-chevron-down"></i>
						</button>
						<div id="order-profile-2" class="accordion-collapse collapse">
							<div class="accordion-body">
								<div class="profile-info">
									<div class="name">
										<p class="title">NAME</p>
										<p class="info">Archie</p>
									</div>
									<div class="age">
										<p class="title">AGE</p>
										<p class="info">4months</p>
									</div>
									<div class="breed">
										<p class="title">BREED</p>
										<p class="info">German Shepard</p>
									</div>
									<div class="weight">
										<p class="title">WEIGHT</p>
										<p class="info">4 kgs</p>
									</div>
									<div class="allergies">
										<p class="title">ALLERGIES</p>
										<p class="info">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>--}}
			</div>
		</div>
	</div>
	<div class="tech-start-order-btn">
		@if($order["status"] == 10)
			<a href="{{URL::to('/technician/start-order')."/".$order["id"]."/".\App\Models\Order::DRIVER_ON_WAY}}" class="submit-btn">Start Order</a>
		@else
			<a href="{{URL::to('/technician/start-order')."/".$order["id"]."/".$order["progress_status"]}}" class="submit-btn">Continue To Order</a>
		@endif
	</div>
</div>
@endsection

