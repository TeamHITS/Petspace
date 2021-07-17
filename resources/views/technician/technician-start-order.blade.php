@extends('technician.layouts.app')
@section('content')
<div class="technician-dashboard-wrap">
	<section class="technician-dash-top auth-top">
		<a href="{{URL::to('/technician/order-detail/').'/'.$order['id']}}" class="pg-title"><i class="fas fa-chevron-left mr-1"></i> Order #7363523</a>
		<a href="tel:{{$order["user"]["details"]['phone']}}" class="call-bth"><i class="fas fa-phone-alt"></i></a>
	</section>
	<div class="technicain-dash-body technicain-start-order">
		@if($order['progress_status'] == 10)
			<div class="start-order-wrap mb-4">
				<div class="icon-wrap">
					<div class="icon"><i class="fas fa-map-marker-alt"></i></div>
				</div>
				<div class="start-order-card">
					<div class="card-top">
						<p class="title">Order has been started!</p>
						<p class="time">{{date('H:i',strtotime($orderProgress[0]['date_time']))}}</p>
					</div>
					<div class="card-desc">
						<p class="heading">Address</p>
						<p class="desc">1431 Ciso Parkway, Lorem ips, Dubai.</p>
					</div>
					<div class="card-actions">
						<a href="http://www.google.com/maps/place/{{$order["address"]["latitude"]}},{{$order["address"]["longitude"]}}" target="_blank" class="pill">Get Directions</a>
						<a href="{{URL::to('/technician/start-order')."/".$order["id"]."/".\App\Models\Order::AT_LOCATON}}" class="pill colored-pill">At the location</a>
					</div>
				</div>
			</div>
		@elseif($order['progress_status'] > 10)
		<div class="start-order-wrap mb-4 completed-service">
			<div class="icon-wrap">
				<div class="icon"><i class="fas fa-check"></i></div>
			</div>
			<div class="start-order-card">
				<div class="card-top">
					<p class="title">Order has been started!</p>
					<p class="time">{{date('H:i',strtotime($orderProgress[0]['date_time']))}}</p>
				</div>
				<div class="card-desc">
					<p class="heading">Address</p>
					<p class="desc">1431 Ciso Parkway, Lorem ips, Dubai.</p>
				</div>
			</div>
		</div>
		@endif

		@if($order['progress_status'] < 20 )
			<div class="start-order-wrap mb-4 opacity-0-3">
			<div class="icon-wrap no-border">
					<div class="icon"><i class="fas fa-truck"></i></div>
				</div>
				<div class="start-order-card">
					<div class="card-top">
						<p class="title">Ready for Service</p>
						<p class="time"></p>
					</div>
					<div class="card-desc">
						<p class="desc">This line can be simple instructions for the technician.</p>
					</div>
					<div class="card-actions">
						<a href="#!" class="pill" disabled>Call Petspace</a>
						<a href="#!" class="pill grey-pill" disabled> disabledBegin Service</a>
					</div>
				</div>
			</div>
		@elseif($order['progress_status'] == 20)
			<div class="start-order-wrap mb-4">
				<div class="icon-wrap">
					<div class="icon"><i class="fas fa-truck"></i></div>
				</div>
				<div class="start-order-card">
					<div class="card-top">
						<p class="title">Ready for Service</p>
						<p class="time"></p>
					</div>
					<div class="card-desc">
						<p class="desc">This line can be simple instructions for the technician.</p>
					</div>
					<div class="card-actions">
						<a href="tel:+971544784391" class="pill">Call Petspace</a>
						<a href="{{URL::to('/technician/start-order')."/".$order["id"]."/".\App\Models\Order::SERVICE_IN_PROGRESS}}" class="pill colored-pill">Begin Service</a>
					</div>
				</div>
			</div>
		@elseif($order['progress_status'] > 20)
			<div class="start-order-wrap mb-4 completed-service">
				<div class="icon-wrap">
					<div class="icon"><i class="fas fa-check"></i></div>
				</div>
				<div class="start-order-card">
					<div class="card-top">
						<p class="title">Service Begin</p>
						<p class="time">{{date('H:i',strtotime($orderProgress[1]['date_time']))}}</p>
					</div>
					<div class="card-desc">
						<p class="desc">This line can be simple instructions for the technician.</p>
					</div>
					<div class="card-actions">
						<a href="#!" class="pill">Call Petspace</a>
						<a href="#!" class="pill colored-pill">Begin Service</a>
					</div>
				</div>
			</div>
		@endif

		@if($order['progress_status'] == 20 )
			<div class="start-order-wrap mb-4 opacity-0-3">
				<div class="icon-wrap no-border">
					<div class="icon"><i class="far fa-copy"></i></div>
				</div>
				<div class="start-order-card">
					<div class="card-top">
						<p class="title">Ready for Service</p>
						<p class="time"></p>
					</div>
					<div class="card-desc">
						<p class="desc">This line can be simple instructions for the technician.</p>
					</div>
					<div class="card-actions">
						<a href="#!" class="pill grey-pill" disabled>Service Complete</a>
					</div>
				</div>
			</div>
		@elseif($order['progress_status'] == 30)
			<div class="start-order-wrap mb-4">
				<div class="icon-wrap">
					<div class="icon"><i class="far fa-copy"></i></div>
				</div>
				<div class="start-order-card">
					<div class="card-top">
						<p class="title">Ready for Service</p>
						<p class="time"></p>
					</div>
					<div class="card-desc">
						<p class="desc">This line can be simple instructions for the technician.</p>
					</div>
					<div class="card-actions">
						<a href="{{URL::to('/technician/start-order')."/".$order["id"]."/".\App\Models\Order::SREVICE_COMPLETED}}" class="pill colored-pill">Service Complete</a>
					</div>
				</div>
			</div>
		@elseif($order['progress_status'] > 30)
			<div class="start-order-wrap completed-service mb-4">
				<div class="icon-wrap">
					<div class="icon"><i class="fas fa-check"></i></div>
				</div>
				<div class="start-order-card">
					<div class="card-top">
						<p class="title">Ready for Service</p>
						<p class="time">{{date('H:i',strtotime($orderProgress[2]['date_time']))}}</p>
					</div>
					<div class="card-desc">
						<p class="desc">This line can be simple instructions for the technician.</p>
					</div>
					<div class="card-actions">
						<a href="#!" class="pill colored-pill">Service Complete</a>
					</div>
				</div>
			</div>
		@endif

		@if($order['progress_status'] == 30 )
			<div class="tech-start-order-btn opacity-0-3">
				<a href="#!" class="submit-btn" disabled>End Order</a>
			</div>
		@elseif($order['progress_status'] == 40)
			<div class="start-order-wrap completed-service mb-4">
				<div class="icon-wrap">
					<div class="icon"><i class="fas fa-check"></i></div>
				</div>
				<div class="start-order-card">
					<div class="card-top mb-0">
						<p class="title">Order Completed</p>
						<p class="time">{{date('H:i',strtotime($orderProgress[3]['date_time']))}}</p>
					</div>
				</div>
			</div>
			<div class="tech-start-order-btn">
				<a href="{{URL::to('/technician/end-order')."/".$order["id"]}}" class="submit-btn">End Order</a>
			</div>
		@endif
	</div>
</div>
@endsection

