@extends('website.layouts.app')
@section('content')
<div class="dashboard-main-wrap">
	@include('website.layouts.side-bar')
	<div class="main-stage">
		@include('website.layouts.main-header')
		@if(empty($categories))
		<section class="stage-content-sec empty-stage">
			<div class="container">
				<div class="gen-text-box mw-490 m-0-auto text-center">
					<p class="heading">Lorem ipsum</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
				</div>
			</div>
		</section>
			@else
			<section class="stage-content-sec service-men-sec-2">
				<div class="container">
					<div class="service-menu-card-wrap">
						<div class="service-menu-card service-menu-card-1">
							<div class="text">
								<p class="title">Publish Changes</p>
								<p>These can be instructions to publish changes</p>
							</div>
							<div class="button-box">
								<a id="publish-btn" style="cursor: pointer" class="gen-btn"><img src="{{ url('/public/assets/images/icon-upload.png') }}" class="img-fluid">Publish changes</a>
							</div>
						</div>

						<div class="service-menu-card service-menu-card-2">
							<div class="img" style="background: none !important;">
								<img src="{{ $petspace['image_url'] }}" alt="icon" class="img-fluid"
									 style="width: 300px;border-radius: 13px;">
							</div>
							<div class="text">
								<p class="title">{{$petspace['name']}}</p>
								<p>{{$petspace['grooming_text']}}</p>
								<ul class="info-list">
									<li>{{$petspace['rating']}} <i class="fas fa-star"></i> (200) <img src="{{ url('/public/assets/images/google-icon.png') }}" alt="icon" class="img-fluid"></li>
									@if($petspace['min_order'] != 0 )
										<li>AED {{$petspace['min_order']}} min.</li>
									@endif
									<li>{{$petspace['delivery_text']}}</li>
								</ul>
								<p class="sub-text">{{$petspace['pick_drop_text']}}</p>
							</div>
						</div>

						@foreach($categories as $category)
						<div class="service-menu-card service-menu-card-1 full-text">
							<div class="text">
								<p class="title">{{$category['name']}}</p>
								<p>{{$category['description']}}</p>
							</div>
						</div>

							@foreach($category['service'] as $service)
								<div class="service-menu-card service-menu-card-3">
									<div class="top">
										<div class="text">
											<p class="name">{{$service['name']}}</p>
											<p>{{$service['description']}}</p>
											<p class="price">AED {{($service['discount'] > 0 )? ($service['price'] - $service['discount'] ): $service['price']}}  <span class="cut-price">{{($service['discount'] > 0 )? "AED ".($service['price'] ): ""}} </span>• Duration: {{$service['service_duration']}}mins</p>
											<a href="{{URL::to('/submenu').'/'.$service['id']}}" class="sub-menu">View Submenu <i class="fas fa-arrow-right"></i></a>
										</div>
										<div class="img">
											<img src="{{ $service['image_url'] }}" alt="icon" class="img-fluid"
												 style="width: 105px; border-radius: 13px; height: 105px;">
										</div>
									</div>
									<div class="bottom">
										<div class="form-check form-switch">
											<input data-id="{{$service['id']}}" class="form-check-input service-stock-btn" type="checkbox"  {{ ($service['in_stock'])? "checked": ""}}>
											<label class="form-check-label">In Stock</label>
										</div>
									</div>
								</div>
							@endforeach
						@endforeach
					</div>
				</div>
			</section>
		@endif
	</div>
</div>
@endsection
@push("scripts")
	<script>
		$('#publish-btn').click(function () {
			var data = new Array();
			$('.service-stock-btn').each(function () {
				var temp = new Object();
				temp.id =  $(this).data('id');
				if(this.checked){
					temp.in_stock = 1;
				}else{
					temp.in_stock = 0;
				}
				data.push(temp);
			});
			var url = "{{URL::to('update-services-stock')}}";
			var method = 'POST';
			$.ajax({
				method: "POST",
				url: url,
				data: {
					"_token": "{{ csrf_token() }}",
					"data": data
				},
				dataType: 'json',
				success: function (rdata) {
					location.reload()
				}, error: function (edata) {
					callback(false, edata)
				}
			});
		})
	</script>
	@endpush
