@extends('technician.layouts.app')
@section('content')
    <div class="technician-dashboard-wrap">
        @include('technician.layouts.main-header')
        <div class="technicain-dash-body technicain-home">
            @foreach($orders as $order)
                <div class="slider-card new-order-card mb-3">
                    @if($order['status'] == \App\Models\Order::ACTIVE)
                        <div class="status-tag active"><span></span>
                            <p>ACTIVE</p></div>
                    @endif
                    <div class="order-info">
                        <div class="order-info-detail-wrap">
                            <div class="order-info-detail">
                                <div class="date-time">
                                    <p class="title">Date & Time</p>
                                    <p class="desc">{{date('d/m/Y H:i',strtotime($order['date_time'])) }}</p>
                                </div>
                                <div class="order-id">
                                    <p class="title">Order</p>
                                    @foreach($order['services'] as $service)
                                        <p class="desc">{{$service['service_name']}}{{isset($service['addons'][1])?" + ". $service['addons'][1]['submenu_name']: ""}}</p>
                                    @endforeach
                                </div>
                                <div class="new-detail">
                                    <p class="title">Address</p>
                                    <p class="desc">{{$order['address']['address']}}</p>
                                </div>
                                <div class="btn-wrap">
                                    <a href="{{URL::to('/technician/order-detail/').'/'.$order['id']}}" class="gen-btn">View
                                        Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{--<div class="slider-card new-order-card mb-3">
                <div class="order-info">
                    <div class="order-info-detail-wrap">
                        <div class="order-info-detail">
                            <div class="date-time">
                                <p class="title">Date & Time</p>
                                <p class="desc">22/11/2021; 16:40</p>
                            </div>
                            <div class="order-id">
                                <p class="title">Order</p>
                                <p class="desc">Bath & Body wash (Package 1) + Addon Lorem ipsum</p>
                            </div>
                            <div class="new-detail">
                                <p class="title">Address</p>
                                <p class="desc">Azsuk Avenue, Dubai.</p>
                            </div>
                            <div class="btn-wrap">
                                <a href="technician-single-order.php" class="gen-btn">View Order</a>
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
                                <p class="title">Date & Time</p>
                                <p class="desc">22/11/2021; 16:40</p>
                            </div>
                            <div class="order-id">
                                <p class="title">Order</p>
                                <p class="desc">Bath & Body wash (Package 1) + Addon Lorem ipsum</p>
                            </div>
                            <div class="new-detail">
                                <p class="title">Address</p>
                                <p class="desc">Azsuk Avenue, Dubai.</p>
                            </div>
                            <div class="btn-wrap">
                                <a href="technician-single-order.php" class="gen-btn">View Order</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}
        </div>
    </div>
@endsection

