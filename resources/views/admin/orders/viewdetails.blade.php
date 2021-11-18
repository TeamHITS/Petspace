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

<div id="ordersetails" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
        <h4 class="modal-title" id="myModalLabel">Order Details</h4>
      </div>
      <div class="modal-body">
   <div class="content">
       <div class="box box-primary">
           <div class="box-body">
               	<!-- Cart data -->
					<div class="col-xs-12">
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
							<div class="panel-body">
								<div class="dynamic-order">
								<?php foreach($order->services as $key => $services) { ?>

								<div class="row" id="{{$services->id.$key}}">
									<div class="col-xs-4">
										<h4 class="product-name">
											<strong>{{$services->name}}</strong></h4>
									</div>
									<div class="col-xs-6">
										<div class="col-xs-6 text-right">
											<h6><strong>AED {{$services->price}}</strong></h6>
										</div>
										<div class="col-xs-2">

											<?php

												$servicePrice = $services->price;
												foreach($services->addons as $index => $serAddons) {
													$servicePrice+=$serAddons->price;
												}
											 ?>
										</div>
									</div>
								
							<?php if(isset($services->pet) && $services->pet!=null) { ?>
							<div class="row" id="{{$services->pet->id.$key}}">
								<div style="margin-left:25px" class="col-xs-8">
									<h4 class="product-name"><strong>{{$services->pet->name}}</strong></h4><h4><small>{{$services->pet->breed .' | '.$services->pet->weight .' | '.$services->pet->gender }}</small></h4>
								</div>
							</div>
							<?php } ?>
										<div class="order-cart">
										<?php 
											foreach($services->addons as $index => $serAddons) { ?>
											<div style="margin-left:10px" class="row" id="{{$serAddons->id.$index}}">
												
												<div class="col-xs-4">
													<h4 class="product-name"><strong>{{$serAddons->name}}</strong></h4><h4><small>{{$services->name}}</small></h4>
												</div>
												<div class="col-xs-6">
													<div class="col-xs-6 text-right">
														<h6><strong>AED {{$serAddons->price}}</strong></h6>
													</div>
												</div>
											</div>

													
											<hr>
								<?php } ?>
								</div>
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
										<h4 class="text-right">Total <strong class="tamnt">AED {{$order->total}}</strong></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
           </div>
       </div>
   </div>
    </div>
  </div>
</div>