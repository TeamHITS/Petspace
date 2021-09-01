<style>
	.panel-info > .panel-heading {
    color: #000000;
    background-color: #fed502;
    border-color: #fed502;
}
.panel-heading .accordion-toggle:after {
    /* symbol for "opening" panels */
    font-family: 'Glyphicons Halflings';  /* essential for enabling glyphicon */
    content: "\e114";    /* adjust as needed, taken from bootstrap.css */
    float: right;        /* adjust as needed */
    color: grey;         /* adjust as needed */
        position: relative;
    bottom: 35px;
}
.panel-heading .accordion-toggle.collapsed:after {
    /* symbol for "collapsed" panels */
    content: "\e080";    /* adjust as needed, taken from bootstrap.css */
}

.subhead {

    background: #fdce38;
    font-size: 20px;
    font-weight: bold;
    border: 1px solid #a78416;
    padding: 10px;

}

.d-none {
	display : none;
}
</style>

@extends('admin.layouts.app')

@section('title')
    {{ $order->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       @include('flash::message')
       @include('admin.orders.package-modal')
       @include('admin.orders.payment')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
               	<!-- Listing -->
	               	<div class="col-xs-4">
	               			<div class="row">
								<div class="col-xs-12 text-center">
									<h4 class="product-name">
										<strong>{{$petspace['name']}}</strong>
									</h4>
									<h5>
										<small>{{$petspace['email'] .' | '.$petspace['phone'] .' | '.$petspace['address'] }}</small>
									</h5>
								</div>
							</div>
							<div class="panel-group" id="accordion">
							<?php foreach($petspace['category'] as $pkey => $petcat) { ?>
							  <div class="panel panel-default">
							    <div class="panel-heading">
							      <h4 class="panel-title">
							        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#{{$petcat['id']}}">
							          <h4 class="product-name"><strong>{{$petcat['name']}}</strong></h4>
							          <h4><small>{{$petcat['description'] }}</small></h4>
							        </a>
							      </h4>
							    </div>
							    
							    <div id="{{$petcat['id']}}" class="panel-collapse collapse {{$pkey == 0 ? 'in' : ''}}">
							      <div class="panel-body">
							        <div class="row">
										<?php foreach($petcat['service'] as $petcatservice) { ?>
											<div class="col-xs-12">
												<div class="col-xs-6">
													<h6 class="product-name">
														<strong>{{$petcatservice['name']}}</strong></h6>
													<h6>
														<small>{{$petcatservice['description'] }}</small>
													</h6>
												</div>
												<div class="col-xs-4 text-right">
													<h6><strong>AED {{$petcatservice['price']}}</strong></h6>
												</div>
												<div class="col-xs-2">
													<button 
														data-name="{{$petcatservice['name']}}"
														data-description="{{$petcatservice['description'] }}"
														data-price="{{$petcatservice['price']}}"
														data-id="{{$petcatservice['id']}}" 
														type="button" 
														class="btn btn-link btn-xs" onclick="addToCart(this)" />

														<span class="glyphicon glyphicon-plus"> </span>
													</button>
												</div>
										</div>
										<?php } ?>
									</div>
							      </div>
							    </div>

							  </div>
						<?php } ?>
						</div>
	               	</div>


               	<!-- Cart data -->
					<div class="col-xs-8">
						<div class="panel panel-info">
							<div class="panel-heading">
								<div class="panel-title">
									<div class="row">
										<div class="col-xs-12">
											<h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
										</div>
									</div>
								</div>
							</div>
							<input type="hidden" name="orderid" id="orderid" value="{{$order->id}}">
							<input type="hidden" name="user_id" id="user_id" value="{{$order->user_id}}">
							<div class="panel-body">
								<div class="dynamic-order">
								<?php foreach($order->services as $key => $services) { ?>

								<div class="row" id="{{$services->id.$key}}">
									<div class="col-xs-4">
										<h4 class="product-name">
											<strong>{{$services->getServiceNameAttribute()}}</strong></h4>
									</div>
									<div class="col-xs-6">
										<div class="col-xs-6 text-right">
											<h6><strong>AED {{$services->price}}</strong></h6>
										</div>
										<div class="col-xs-2">
											<button type="button" onclick="removeme({{$services->id.$key}},{{$services->price}},{{$services->id}},1,1)" class="btn btn-link btn-xs">
												<span class="glyphicon glyphicon-trash"> </span>
											</button>
										</div>
									</div>
								</div>
								
							<?php if(isset($services->pet) && $services->pet!=null) { ?>
								<div class="row" id="{{$services->pet->id.$key}}">
									
									<div class="col-xs-4">
										<h4 class="product-name"><strong>{{$services->pet->name}}</strong></h4><h4><small>{{$services->pet->breed .' | '.$services->pet->weight .' | '.$services->pet->gender }}</small></h4>
									</div>
<!-- 									<div class="col-xs-6">
										<div class="col-xs-6 text-right">
											<h6><strong>AED {{$services->price}}</strong></h6>
										</div>
										<div class="col-xs-2">
											<button type="button" onclick="removeme({{$services->pet->id.$key}},{{$services->price}},{{$services->pet->id}},1)" class="btn btn-link btn-xs">
												<span class="glyphicon glyphicon-trash"> </span>
											</button>
										</div>
									</div> -->
								</div>
							<?php } ?>
										<div class="order-cart">
										<?php 

											foreach($services->addons as $index => $serAddons) { ?>
											<div class="row" id="{{$serAddons->id.$index}}">
												
												<div class="col-xs-4">
													<h4 class="product-name"><strong>{{$serAddons->getSubmenuNameAttribute()}}</strong></h4><h4><small>{{$services->getServiceNameAttribute()}}</small></h4>
												</div>
												<div class="col-xs-6">
													<div class="col-xs-6 text-right">
														<h6><strong>AED {{$serAddons->price}}</strong></h6>
													</div>
													<div class="col-xs-2">
														<button type="button" onclick="removeme({{$serAddons->id.$index}},{{$serAddons->price}},{{$serAddons->id}},2,1)" class="btn btn-link btn-xs">
															<span class="glyphicon glyphicon-trash"> </span>
														</button>
													</div>
												</div>
											</div>

													
											<hr>
								<?php } ?>
								</div>
								<hr>
								<?php } ?>
							</div>
								<div class="row">
									<div class="text-center">
										
										<div class="col-xs-4">
											<h6><strong>VAT TAX</strong></h6>
										</div>

										<div class="col-xs-6">
											<h6><strong id="vat">AED {{$order->tax}}</strong></h6>
										</div>

									</div>
									<div class="text-center">
										
										<div class="col-xs-4">
											<h6><strong>Deliver Fee</strong></h6>
										</div>

										<div class="col-xs-6">
											<h6><strong id="vat">AED {{$order->delivery_fee}}</strong></h6>
										</div>

									</div>
								</div>
							</div>
							<div class="panel-footer">

								<div class="row text-center">
									<div class="col-xs-9">

										<input type="hidden" name="total_amount" id="total_amount" value="{{$order->total}}" />
										<input type="hidden" name="delivery_fee" id="delivery_fee" value="{{$order->delivery_fee}}" />
										<input type="hidden" name="total_tax" id="total_tax" value="{{$order->tax}}" />
										<input type="hidden" name="sub_total" id="sub_total" value="{{$order->sub_total}}" />
										<input type="hidden" name="net_amnt" id="net_amnt" value="" />

										<h4 class="text-right">Total <strong class="tamnt">AED {{$order->total}}</strong></h4>
									</div>
									<div class="col-xs-3">
										<button id="checkbtn"
										@if($old_total == $order->total)disabled="disabled" @endif 
											type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#GSCCModalCheckout">
											Checkout
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
           </div>
       </div>
   </div>
   
@endsection