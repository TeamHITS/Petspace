@extends('website.layouts.app')
@section('content')
    <div class="dashboard-main-wrap">
        @include('website.layouts.side-bar')
        <div class="main-stage">
            @include('website.layouts.main-header')
            <section class="stage-content-sec order-sec-2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="shadow-card mb-3">
                                <div class="order-number-info">
                                    <p class="number">Order #{{$order['id']}}</p>
                                    <p class="status"><span
                                                class="tag {{$order['status_color']}}"></span>{{$order['status_text']}}
                                    </p>
                                </div>
                            </div>
                            @if($order['note'])
                                <div class="shadow-card mb-3">
                                    <div class="order-instrustion">
                                        <p class="title">Special Instructions </p>
                                        <p>{{$order['note']}}</p>
                                    </div>
                                </div>
                            @endif
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
                                    @endforeach
                                    <div class="time-box">
                                        <p><i class="far fa-clock"></i>Total Service Duration: {{$total_duration}}mins
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
                                        @if($order['status'] != \App\Models\Order::COMPLETE )
                                        <a href="#!" class="assign-tech" id="assign-tech"
                                           data-id="{{$order['id']}}"><i
                                                    class="fas fa-pencil-alt"></i></a>
                                            @endif
                                    </div>
                                    <div class="selected-technician">
                                        <div class="technician-item {{ (isset($order['technician']))?"":"not"}}">
                                            <div class="img">
                                                <i class="fas fa-user"></i>
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
                                    <p class="title">SERVICE PROGRESS</p>
                                    @if($order['progress_status'] == NULL)
                                    <div class="service-progress-info">
                                        <div class="img">
                                            <i class="far fa-calendar"></i>
                                        </div>
                                        <div class="desc">
                                            <p class="title">Service is scheduled for</p>
                                            <p>{{date('d/m/Y H:i',strtotime($order['date_time']))}}</p>
                                        </div>
                                    </div>
                                    @else

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- ASSIGN TECHNICIAN MODAL -->
    <div class="modal fade gen-modal" id="assignTechnicianModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">

    </div>
@endsection
@push('scripts')
    <script>

        $("#assign-tech").click(function () {
            var techId = $(this).data('id');
            // $('#passenger-added-alert').css('display', 'none');
            var url = "{{URL::to("/assign-tech-modal")}}/" + techId;
            ajaxGet(url, "", (status, data) => {
                if (status) {

                    $("#assignTechnicianModal").html(data.data);
                    // cloneRow();
                    $('#assignTechnicianModal').modal('show');
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
