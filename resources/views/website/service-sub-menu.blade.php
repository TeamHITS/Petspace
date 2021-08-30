@extends('website.layouts.app')
@section('content')
    <div class="dashboard-main-wrap">
        @include('website.layouts.side-bar')
        <div class="main-stage">
            @include('website.layouts.main-header')
            <section class="stage-content-sec service-men-sec-2">
                <div class="container">
                    <div class="service-menu-card-wrap">
                        <div class="service-menu-card service-menu-card-1">
                            <div class="text">
                                <p class="title">Publish Changes</p>
                                <p>These can be instructions to publish changes</p>
                            </div>
                            <div class="button-box">
                                <a id="publish-btn" style="cursor: pointer" class="gen-btn"><img
                                            src="{{ url('/public/assets/images/icon-upload.png') }}" class="img-fluid">Publish
                                    changes</a>
                            </div>
                        </div>

                        <div class="service-menu-card service-menu-card-3 sub-menu-card-1">
                            <div class="top">
                                <div class="text">
                                    <p class="name">{{ $service['name'] }}</p>
                                    <p>{{ $service['description'] }}</p>
                                    <p class="price">AED {{ $service['price'] }} <span
                                                class="cut-price">{{($service['discount'] > 0 )? "AED ".($service['price'] - $service['discount'] ): ""}} </span>•
                                        Duration: {{ $service['service_duration'] }}mins</p>
                                </div>
                                <div class="img">
                                    <img src="{{ $service['image_url'] }}" alt="icon" class="img-fluid"
                                         style="width: 105px; border-radius: 13px; height: 105px;">
                                </div>
                            </div>
                        </div>

                        @foreach($submenus as $submenu)
                            <div class="service-menu-card sub-menu-card-3">
                                <div class="text">
                                    <p class="title">{{$submenu['name']}}</p>
                                    <p>{{$submenu['description']}}</p>
                                </div>
                                @if($submenu['condition_option'] != null)
                                    <div class="bottom">
                                        <p>•Optional Items • {{$submenu['condition_text'] }} 01 Item</p>
                                    </div>
                                @endif
                            </div>
                            @foreach($submenu['service'] as $service)
                                <div class="service-menu-card service-menu-card-3 sub-menu-card-2">
                                    <div class="top">
                                        <div class="text">
                                            <p class="name">{{$service['name']}}</p>
                                            <p>{{$service['description']}}</p>
                                            <p class="price">AED {{$service['price']}} <span
                                                        class="cut-price">{{($service['discount'] > 0 )? "AED ".($service['price'] - $service['discount'] ): ""}} </span>•
                                                Duration: {{$service['service_duration']}}mins</p>
                                        </div>
                                    </div>
                                    <div class="bottom">
                                        <div class="form-check form-switch">
                                            <input data-id="{{$service['id']}}"
                                                   class="form-check-input service-stock-btn"
                                                   type="checkbox" {{ ($service['in_stock'])? "checked": ""}}>
                                            <label class="form-check-label">In Stock</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@push("scripts")
    <script>
        $('#publish-btn').click(function () {
            var data = new Array();
            $('.service-stock-btn').each(function () {
                var temp = new Object();
                temp.id = $(this).data('id');
                if (this.checked) {
                    temp.in_stock = 1;
                } else {
                    temp.in_stock = 0;
                }
                data.push(temp);
            });
            var url = "{{URL::to('update-sub-services-stock')}}";
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
