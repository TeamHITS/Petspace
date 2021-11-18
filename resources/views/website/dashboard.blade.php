@extends('website.layouts.app')
@section('content')
<div class="dashboard-main-wrap">
		@include('website.layouts.side-bar')
	<div class="main-stage">
		@include('website.layouts.main-header')
		<section class="stage-content-sec dashboard-content-stage">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-9 co-sm-12">
						<div class="shadow-card slider-card-wrap mb-4">
							<div class="slider-wrap-top">
								<p class="card-title">Active Orders</p>
                                @if(!empty($activeOrders))
								<div class="slider-nav active-order-nav">
									<div class="swiper-button-prev"></div>
									<p><span id="active-slide-count">1</span> out of <span>{{count($activeOrders)}}</span></p>
									<div class="swiper-button-next"></div>
								</div>
                                    @endif
							</div>
							<div class="swiper-container dashboard-sliders dashbaord-active-order">
								<div class="swiper-wrapper">
									@foreach($activeOrders as $activeOrder)
									<div class="swiper-slide">
										<div class="slider-card-body">
											<div class="slider-card">
												<div class="slider-card-top">
													<p class="order-no">Order #{{$activeOrder['id']}}</p>
													<a href="#!" class="edit btn-active-order" data-id="{{$activeOrder['id']}}"><img
																src="{{ url('public/assets/images/icon-edit.png') }}" class="img-fluid"></a>

												</div>
												<div class="order-info">
													<div class="service-progress">
														<div class="service-progress-info">
															<div class="img">
																@if(isset($activeOrder['progress'][0]))
																	<i class="fas fa-check"></i>
																@endif
															</div>
															<div class="desc">
																<p class="title">Driver on the way</p>
																@if(isset($activeOrder['progress'][0]['date_time']))
																<p>{{date('H:i',strtotime($activeOrder['progress'][0]['date_time']))}}</p>
																	@endif
															</div>
														</div>
														<div class="service-progress-info">
															<div class="img">
																@if(isset($activeOrder['progress'][1]))
																	<i class="fas fa-check"></i>
																@endif
															</div>
															<div class="desc">
																<p class="title">At the location</p>
																@if(isset($activeOrder['progress'][1]['date_time']))
																	<p>{{date('H:i',strtotime($activeOrder['progress'][1]['date_time']))}}</p>
																@endif
															</div>
														</div>
														<div class="service-progress-info">
															<div class="img">
																@if(isset($activeOrder['progress'][2]))
																	<i class="fas fa-check"></i>
																@endif
															</div>
															<div class="desc">
																<p class="title">Service in progress</p>
																@if(isset($activeOrder['progress'][2]['date_time']))
																	<p>{{date('H:i',strtotime($activeOrder['progress'][2]['date_time']))}}</p>
																@endif
															</div>
														</div>
														<div class="service-progress-info">
															<div class="img">
																@if(isset($activeOrder['progress'][3]))
																	<i class="fas fa-check"></i>
																@endif
															</div>
															<div class="desc">
																<p class="title">Service is completed</p>
																@if(isset($activeOrder['progress'][3]['date_time']))
																	<p>{{date('H:i',strtotime($activeOrder['progress'][3]['date_time']))}}</p>
																@endif
															</div>
														</div>
													</div>
													<div class="order-info-detail-wrap">
														<div class="order-info-detail">
															<div class="text">
																<p class="title">Address</p>
																<p class="desc">{{$activeOrder['address']['address']}}</p>
															</div>
															<div class="number">
																<p class="title">Date</p>
																<p class="desc">{{date('d/m/Y', strtotime($activeOrder['date_time']))}}</p>
															</div>
														</div>
														<div class="order-info-detail">
															<div class="text">
																<p class="title">Technician Assigned</p>
																<p class="desc">{{$activeOrder['technician']['user']['name']}}</p>
															</div>
															<div class="number">
																<p class="title">Time</p>
																<p class="desc">{{date('H:i', strtotime($activeOrder['date_time']))}}</p>
															</div>
														</div>
														<div class="order-info-detail">
															<div class="text">
																<p class="title">Ordered Services</p>
																<p class="desc">{{$activeOrder['services'][0]['name']}}<br>
																	{{$activeOrder['services'][0]['addons'][0]['name']}}….</p>
															</div>
															<div class="number">
																<p class="title">Total Amount</p>
																<p class="desc">AED {{$activeOrder['total']}}</p>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									@endforeach
									{{--<div class="swiper-slide">
										<div class="slider-card-body">
											<div class="slider-card">
												<div class="slider-card-top">
													<p class="order-no">Order #1234</p>
													<a href="#!" class="edit"><i class="far fa-edit"></i></a>
												</div>
												<div class="order-info">
													<div class="service-progress">
														<div class="service-progress-info">
															<div class="img">
																<i class="fas fa-check"></i>
															</div>
															<div class="desc">
																<p class="title">Driver on the way</p>
																<p>16:10</p>
															</div>
														</div>
														<div class="service-progress-info">
															<div class="img">
																<i class="fas fa-check"></i>
															</div>
															<div class="desc">
																<p class="title">At the location</p>
																<p>16:10</p>
															</div>
														</div>
														<div class="service-progress-info">
															<div class="img">
																<i class="fas fa-check"></i>
															</div>
															<div class="desc">
																<p class="title">Service in progress</p>
																<p>16:10</p>
															</div>
														</div>
														<div class="service-progress-info">
															<div class="img">
																<i class="fas fa-check"></i>
															</div>
															<div class="desc">
																<p class="title">Service is completed</p>
																<p>16:10</p>
															</div>
														</div>
													</div>
													<div class="order-info-detail-wrap">
														<div class="order-info-detail">
															<div class="text">
																<p class="title">Address</p>
																<p class="desc">1431 Ciso Parkway, Lorem ipsum, Dubai.</p>
															</div>
															<div class="number">
																<p class="title">Date</p>
																<p class="desc">22/11/2021</p>
															</div>
														</div>
														<div class="order-info-detail">
															<div class="text">
																<p class="title">Technician Assigned</p>
																<p class="desc">Juan Bishop</p>
															</div>
															<div class="number">
																<p class="title">Time</p>
																<p class="desc">12:30</p>
															</div>
														</div>
														<div class="order-info-detail">
															<div class="text">
																<p class="title">Ordered Services</p>
																<p class="desc">Bath & Bodywash (Package 1) x1<br>
																	Addon lorem ipsum x1….</p>
															</div>
															<div class="number">
																<p class="title">Total Amount</p>
																<p class="desc">AED 300</p>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>--}}
								</div>
							</div>
						</div>

						<div class="shadow-card slider-card-wrap">
							<div class="slider-wrap-top">
								<p class="card-title">Scheduled Orders</p>
                                @if(!empty($scheduleOrders))
								<div class="slider-nav schedule-order-nav">
									<div class="swiper-button-prev"></div>
									<p><span id="schedule-slide-count">1</span> out of <span>{{count($scheduleOrders)}}</span></p>
									<div class="swiper-button-next"></div>
								</div>
                                    @endif
							</div>
							<div class="swiper-container dashboard-sliders dashboard-schedule-order">
								<div class="swiper-wrapper">
									@foreach($scheduleOrders as $scheduleOrder)
									<div class="swiper-slide">
										<div class="slider-card-body">
											<div class="slider-card">
												<div class="slider-card-top">
													<p class="order-no">Order #{{$scheduleOrder['id']}}</p>
													<a href="#!" class="edit btn-schedule-order" data-id="{{$scheduleOrder['id']}}"><img
																src="{{ url('public/assets/images/icon-edit.png') }}" class="img-fluid"></a>
												</div>
												<div class="order-info">
													<div class="order-info-detail-wrap">
														<div class="order-info-detail">
															<div class="text">
																<p class="title">Address</p>
																<p class="desc">{{$scheduleOrder['address']['address']}}</p>
															</div>
															<div class="number">
																<p class="title">Date</p>
																<p class="desc">{{date('d/m/Y', strtotime($scheduleOrder['date_time']))}}</p>
															</div>
														</div>
														<div class="order-info-detail">
															<div class="text">
																<p class="title">Technician Assigned</p>
																<p class="desc">{{$scheduleOrder['technician']['user']['name']}}</p>
															</div>
															<div class="number">
																<p class="title">Time</p>
																<p class="desc">{{date('His', strtotime($scheduleOrder['date_time']))}}</p>
															</div>
														</div>
														<div class="order-info-detail">
															<div class="text">
																<p class="title">Ordered Services</p>
																<p class="desc">{{$scheduleOrder['services'][0]['name']}}<br>
																	{{$scheduleOrder['services'][0]['addons'][0]['name']}}….</p>
															</div>
															<div class="number">
																<p class="title">Total Amount</p>
																<p class="desc">AED {{$scheduleOrder['total']}}</p>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									@endforeach
									{{--<div class="swiper-slide">
										<div class="slider-card-body">
											<div class="slider-card">
												<div class="slider-card-top">
													<p class="order-no">Order #1234</p>
													<a href="#!" class="edit"><i class="far fa-edit"></i></a>
												</div>
												<div class="order-info">
													<div class="order-info-detail-wrap">
														<div class="order-info-detail">
															<div class="text">
																<p class="title">Address</p>
																<p class="desc">1431 Ciso Parkway, Lorem ipsum, Dubai.</p>
															</div>
															<div class="number">
																<p class="title">Date</p>
																<p class="desc">22/11/2021</p>
															</div>
														</div>
														<div class="order-info-detail">
															<div class="text">
																<p class="title">Technician Assigned</p>
																<p class="desc">Juan Bishop</p>
															</div>
															<div class="number">
																<p class="title">Time</p>
																<p class="desc">12:30</p>
															</div>
														</div>
														<div class="order-info-detail">
															<div class="text">
																<p class="title">Ordered Services</p>
																<p class="desc">Bath & Bodywash (Package 1) x1<br>
																	Addon lorem ipsum x1….</p>
															</div>
															<div class="number">
																<p class="title">Total Amount</p>
																<p class="desc">AED 300</p>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>--}}
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-3 co-sm-12">
						<div class="shadow-card slider-card-wrap h-100">
							<div class="slider-wrap-top">
								<p class="card-title">New Orders</p>
                                @if(!empty($newOrders))
								<div class="slider-nav new-order-nav">
									<div class="swiper-button-prev"></div>
									<p><span id="new-slide-count">1</span> out of <span>{{ceil(count($newOrders)/3)}}</span></p>
									<div class="swiper-button-next"></div>
								</div>
                                    @endif
							</div>
							<div class="swiper-container dashboard-sliders dashboard-new-order">
								<div class="swiper-wrapper">
									@for($i = 0; $i < (ceil(count($newOrders)/3)) ;$i++)
										@if(!empty($newOrders[$i * 3 ]))
									<div class="swiper-slide">
										<div class="slider-card-body">
											@if(!empty($newOrders[$i * 3 ]))
											<div class="slider-card new-order-card mb-3">
												<div class="order-info">
													<div class="order-info-detail-wrap">
														<div class="order-info-detail">
															<div class="date-time">
																<p class="title">Apartment Number</p>
																<p class="desc">{{$newOrders[$i * 3 ]['address']['apartment_number']}}</p>
															</div>
															<div class="order-id">
																<p class="title">Date</p>
																<p class="desc">{{date('d/m/Y',strtotime($newOrders[$i * 3 ]['date_time']))}}</p>
															</div>
															<div class="new-detail">
																<p class="title">Address</p>
																<p class="desc">{{$newOrders[$i * 3 ]['address']['address']}}</p>
															</div>
															<div class="btn-wrap">
																{{--<a href="#!" class="gen-btn">Assign Order</a>--}}
																<a href="#!" class="gen-btn btn-schedule-order" data-id="{{$newOrders[$i * 3 ]['id']}}">Assign Order</a>
															</div>
														</div>
													</div>
												</div>
											</div>
											@endif
												@if(!empty($newOrders[$i * 3 + 1]))
											<div class="slider-card new-order-card mb-3">
												<div class="order-info">
													<div class="order-info-detail-wrap">
														<div class="order-info-detail">
															<div class="date-time">
																<p class="title">Apartment Number</p>
																<p class="desc">{{$newOrders[$i * 3 + 1]['address']['apartment_number']}}</p>
															</div>
															<div class="order-id">
																<p class="title">Date</p>
																<p class="desc">{{date('d/m/Y',strtotime($newOrders[$i * 3 + 1]['date_time']))}}</p>
															</div>
															<div class="new-detail">
																<p class="title">Address</p>
																<p class="desc">{{$newOrders[$i * 3 + 1]['address']['address']}}</p>
															</div>
															<div class="btn-wrap">
																{{--<a href="#!" class="gen-btn">Assign Order</a>--}}
																<a href="#!" class="gen-btn btn-schedule-order" data-id="{{$newOrders[$i * 3 + 1]['id']}}">Assign Order</a>
															</div>
														</div>
													</div>
												</div>
											</div>
											@endif
											@if(!empty($newOrders[$i * 3 + 2]))
											<div class="slider-card new-order-card mb-3">
												<div class="order-info">
													<div class="order-info-detail-wrap">
														<div class="order-info-detail">
															<div class="date-time">
																<p class="title">Apartment Number</p>
																<p class="desc">{{$newOrders[$i * 3 + 2]['address']['apartment_number']}}</p>
															</div>
															<div class="order-id">
																<p class="title">Date</p>
																<p class="desc">{{date('d/m/Y',strtotime($newOrders[$i * 3 + 2]['date_time']))}}</p>
															</div>
															<div class="new-detail">
																<p class="title">Address</p>
																<p class="desc">{{$newOrders[$i * 3 + 2]['address']['address']}}</p>
															</div>
															<div class="btn-wrap">
																{{--<a href="#!" class="gen-btn">Assign Order</a>--}}
																<a href="#!" class="gen-btn btn-schedule-order" data-id="{{$newOrders[$i*3+2]['id']}}">Assign Order</a>
															</div>
														</div>
													</div>
												</div>
											</div>
											@endif
										</div>
									</div>
										@endif
									@endfor
									{{--<div class="swiper-slide">
										<div class="slider-card-body">
											<div class="slider-card new-order-card mb-3">
												<div class="order-info">
													<div class="order-info-detail-wrap">
														<div class="order-info-detail">
															<div class="date-time">
																<p class="title">Address</p>
																<p class="desc">1431 Ciso Parkway, Lorem ipsum, Dubai.</p>
															</div>
															<div class="order-id">
																<p class="title">Date</p>
																<p class="desc">22/11/2021</p>
															</div>
															<div class="new-detail">
																<p class="title">Address</p>
																<p class="desc">1431 Ciso Parkway, Lorem ipsum, Dubai.</p>
															</div>
															<div class="btn-wrap">
																<a href="#!" class="gen-btn">Assign Order</a>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="slider-card new-order-card mb-3">
												<div class="order-info">
													<div class="order-info-detail-wrap">
														<div class="order-info-detail">
															<div class="date-time">
																<p class="title">Address</p>
																<p class="desc">1431 Ciso Parkway, Lorem ipsum, Dubai.</p>
															</div>
															<div class="order-id">
																<p class="title">Date</p>
																<p class="desc">22/11/2021</p>
															</div>
															<div class="new-detail">
																<p class="title">Address</p>
																<p class="desc">1431 Ciso Parkway, Lorem ipsum, Dubai.</p>
															</div>
															<div class="btn-wrap">
																<a href="#!" class="gen-btn">Assign Order</a>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="slider-card new-order-card mb-3">
												<div class="order-info">
													<div class="order-info-detail-wrap">
														<div class="order-info-detail">
															<div class="date-time">
																<p class="title">Address</p>
																<p class="desc">1431 Ciso Parkway, Lorem ipsum, Dubai.</p>
															</div>
															<div class="order-id">
																<p class="title">Date</p>
																<p class="desc">22/11/2021</p>
															</div>
															<div class="new-detail">
																<p class="title">Address</p>
																<p class="desc">1431 Ciso Parkway, Lorem ipsum, Dubai.</p>
															</div>
															<div class="btn-wrap">
																<a href="#!" class="gen-btn">Assign Order</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>--}}
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<!-- ACTIVE ORDER MODAL -->
<div class="modal fade gen-modal dashboard-modals" id="active-order-modal" tabindex="-1" aria-hidden="true">

</div>
<!-- SCHEDULE ORDER MODAL -->
<div class="modal fade gen-modal dashboard-modals" id="schedule-order-modal" tabindex="-1" aria-hidden="true">

</div>
@endsection

@push('scripts')
	<script>

        swiperActive.on('slideChange', function (swiper) {
            var index = swiper.activeIndex+1;
            $('#active-slide-count').html(index);
        });
        swiperSchedule.on('slideChange', function (swiper) {
            var index = swiper.activeIndex+1;
            $('#schedule-slide-count').html(index);
        });
        swiperOrder.on('slideChange', function (swiper) {
            var index = swiper.activeIndex+1;
            $('#new-slide-count').html(index);
        });

		$(".btn-active-order").click(function () {
			var orderId = $(this).data('id');
			// $('#passenger-added-alert').css('display', 'none');
			var url = "{{URL::to("/active-order-modal")}}/" + orderId;
			ajaxGet(url, "", (status, data) => {
				if (status) {

					$("#active-order-modal").html(data.data);
					// cloneRow();
					$('#active-order-modal').modal('show');
				} else {

					// $('#passenger-added-alert').css('display', 'block');
					// $('#passenger-added-alert').removeClass('alert-success');
					// $('#passenger-added-alert').addClass('alert-danger');
					//var err = [];

					//$('#passenger-added-alert').html(data.responseJSON.message);
				}
			});

		});

		$(".btn-schedule-order").click(function () {
			var orderId = $(this).data('id');
			// $('#passenger-added-alert').css('display', 'none');
			var url = "{{URL::to("/schedule-order-modal")}}/" + orderId;
			ajaxGet(url, "", (status, data) => {
				if (status) {

					$("#schedule-order-modal").html(data.data);
					// cloneRow();
					$('#schedule-order-modal').modal('show');
				} else {

					// $('#passenger-added-alert').css('display', 'block');
					// $('#passenger-added-alert').removeClass('alert-success');
					// $('#passenger-added-alert').addClass('alert-danger');
					//var err = [];

					//$('#passenger-added-alert').html(data.responseJSON.message);
				}
			});

		});

		$('body').on('submit', '#technician-form', function (e) {
			// $('.alert').css('display', 'none');

			e.preventDefault();
			var that = $(this);
			var url = $(this).attr('action');
			var method = $(this).attr('method');
			var form_data = new FormData($(this)[0]);

			ajaxPost(url, form_data, (status, data) => {
				if (status) {

					// $('#passenger-added-alert').css('display', 'block');
					// $('#passenger-added-alert').removeClass('alert-danger');
					// $('#passenger-added-alert').addClass('alert-success');
					// $('#passenger-added-alert').html(data.message);
					$('body #assignTechnicianModal').modal('hide');

					location.reload();
				} else {

					$('#modal-response-alert').css('display', 'block');
					$('#modal-response-alert').removeClass('d-none');
					$('#modal-response-alert').removeClass('alert-success');
					$('#modal-response-alert').addClass('alert-danger');

					$('#modal-response-alert').html(data.responseJSON.message);

					$('#modal-response-alert')[0].scrollIntoView({behavior: "smooth"});
					// $('html,body').animate({
					//     scrollTop: $("#response-alert").offset().top - 500
					// }, 'slow');

				}
			});

		});
	</script>
@endpush

