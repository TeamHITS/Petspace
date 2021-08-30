<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="shadow-card mb-3">
                                <div class="order-number-info">
                                    <p class="number">Order #{{$order['id']}}</p>
                                    <p class="status"><span class="tag active"></span>Active</p>
                                </div>
                            </div>
                            <div class="shadow-card mb-3">
                                <div class="order-instrustion">
                                    <p class="title">Special Instructions </p>
                                    <p>{{$order['note']}}</p>
                                </div>
                            </div>
                            <div class="shadow-card mb-3">
                                <div class="ordered-services">
                                    <p class="heading">Ordered Services</p>
                                    <?php $total_duration = 0;?>
                                    @foreach($order['services'] as $service)
                                        <div class="ordered-service">
                                            <div class="img"></div>
                                            <div class="desc">
                                                <p class="name">{{$service['service_name']}}</p>
                                                <?php    $duration = 0;
                                                $addons_price = 0;
                                                ?>
                                                @foreach($service['addons'] as $addon)
                                                    <p>+ {{$addon['submenu_name']}}</p>
                                                    <?php $duration += $addon['duration'];
                                                    $addons_price += $addon['price'];
                                                    ?>
                                                @endforeach
                                                <p>Service Duration: {{$duration+$service['duration']}}m</p>
                                            </div>
                                            <div class="price">
                                                <p>AED {{$addons_price+$service['price']}}</p>
                                                <?php $total_duration += $duration + $service['duration'];?>
                                            </div>
                                            <div class="profile">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#order-profile-1"
                                                        aria-expanded="false" aria-controls="order-profile-1">
                                                    Pet Profile <i class="fas fa-chevron-down"></i>
                                                </button>
                                                <div id="order-profile-1" class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                        <div class="profile-info">
                                                            <div class="name">
                                                                <p class="title">NAME</p>
                                                                <p class="info">{{$service['pet']['name']}}</p>
                                                            </div>
                                                            {{--<div class="age">--}}
                                                            {{--<p class="title">AGE</p>--}}
                                                            {{--<p class="info">4months</p>--}}
                                                            {{--</div>--}}
                                                            <div class="breed">
                                                                <p class="title">BREED</p>
                                                                <p class="info">{{$service['pet']['breed']}}</p>
                                                            </div>
                                                            <div class="weight">
                                                                <p class="title">WEIGHT</p>
                                                                <p class="info">{{$service['pet']['weight']}} kg</p>
                                                            </div>
                                                            <div class="allergies">
                                                                <p class="title">ALLERGIES</p>
                                                                <p class="info">{{$service['pet']['instruction']}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--<div class="ordered-service">
                                            <div class="img"></div>
                                            <div class="desc">
                                                <p class="name">Bath & Bodywash (Package 1)  x1</p>
                                                <p>For medium sized pet</p>
                                                <p>Service Duration: 50m</p>
                                            </div>
                                            <div class="price">
                                                <p>AED 200</p>
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
                                                                <p class="info">{{$service['pet']['name']}}</p>
                                                            </div>
                                                            --}}{{--<div class="age">--}}{{--
                                                            --}}{{--<p class="title">AGE</p>--}}{{--
                                                            --}}{{--<p class="info">4months</p>--}}{{--
                                                            --}}{{--</div>--}}{{--
                                                            <div class="breed">
                                                                <p class="title">BREED</p>
                                                                <p class="info">{{$service['pet']['breed']}}</p>
                                                            </div>
                                                            <div class="weight">
                                                                <p class="title">WEIGHT</p>
                                                                <p class="info">{{$service['pet']['weight']}} kg</p>
                                                            </div>
                                                            <div class="allergies">
                                                                <p class="title">ALLERGIES</p>
                                                                <p class="info">{{$service['pet']['instruction']}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>--}}
                                    @endforeach
                                    <div class="time-box">
                                        <p><img
                                                    src="{{ url('/public/assets/images/icon-clock.png') }}"
                                                    class="img-fluid">Total Service Duration: {{$total_duration}}mins
                                        </p>
                                    </div>
                                    <div class="amount-box">
                                        <ul class="amount-list">
                                            <li><span>Sub Total</span><span>AED {{$order['sub_total']}}</span></li>
                                            <li><span>Tax</span><span>AED {{$order['tax']}}</span></li>
                                            <li><span>Delivery</span><span>AED {{$order['delivery_fee']}}</span></li>
                                            <li><span>Total</span><span>AED {{$order['total']}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="shadow-card mb-3">
                                <div class="order-detail">
                                    <div class="order-info mb-3">
                                        <p class="title">Address</p>
                                        <p>{{$order['address']['address'] }}</p>
                                    </div>
                                    <div class="order-info mb-3">
                                        <p class="title">Date</p>
                                        <p>{{date('d/m/Y',strtotime($order['date_time']))}}</p>
                                    </div>
                                    <div class="order-info mb-1">
                                        <p class="title">TIME</p>
                                        <p>{{date('H:i',strtotime($order['date_time'])) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="shadow-card mb-3">
                                <div class="assign-technician-card">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="title">Technician Assigned</p>
                                        {{--<a href="#!" class="assign-tech" id="assign-tech"
                                           data-id="{{$order['id']}}"><i
                                                    class="fas fa-pencil-alt"></i></a>--}}
                                    </div>
                                    <div class="selected-technician">
                                        <div class="technician-item {{ (isset($order['technician']))?"":"not"}}">
                                            <div class="img">
                                                <img
                                                        src="{{ url('/public/assets/images/icon-user.png') }}"
                                                        class="img-fluid">
                                            </div>
                                            @if($order['technician'])
                                                <p>{{$order['technician']['user']['name']}}</p>
                                            @else
                                                <p>Not Assigned</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="shadow-card mb-3">
                                <div class="service-progress">
                                    <p class="title">SERVICE History</p>
                                    @if($order['progress_status'] == NULL)
                                        <div class="service-progress-info">
                                            <div class="img">
                                                <img
                                                        src="{{ url('/public/assets/images/icon-calender-green.png') }}"
                                                        class="img-fluid">
                                            </div>
                                            <div class="desc">
                                                <p class="title">Service is scheduled for</p>
                                                <p>{{date('d/m/Y H:i',strtotime($order['date_time']))}}</p>
                                            </div>
                                        </div>
                                    @else
                                        @if(isset($order['progress'][0]))
                                            <div class="service-progress-info">
                                                <div class="img">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <div class="desc">
                                                    <p class="title">Driver on the way</p>
                                                    <p>{{date('H:i',strtotime($order['progress'][0]['date_time']))}}</p>
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($order['progress'][1]))
                                            <div class="service-progress-info">
                                                <div class="img">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <div class="desc">
                                                    <p class="title">At the location</p>
                                                    <p>{{date('H:i',strtotime($order['progress'][1]['date_time']))}}</p>
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($order['progress'][2]))
                                            <div class="service-progress-info">
                                                <div class="img">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <div class="desc">
                                                    <p class="title">Service in progress</p>
                                                    <p>{{date('H:i',strtotime($order['progress'][2]['date_time']))}}</p>
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($order['progress'][3]))
                                            <div class="service-progress-info">
                                                <div class="img">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <div class="desc">
                                                    <p class="title">Service is completed</p>
                                                    <p>{{date('H:i',strtotime($order['progress'][3]['date_time']))}}</p>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
            {{--<button type="button" class="gen-btn">Apply</button>--}}
        </div>
    </div>
</div>