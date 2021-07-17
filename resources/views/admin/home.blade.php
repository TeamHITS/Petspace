@extends('admin.layouts.app')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                @include("admin.counter_widget", [
                    "bgColor" => "teal",
                    "counter" => $usersCount-1,
                    "title" => "Users",
                    "icon" => 'fa fa-user',
                    "route" => route('admin.users.index')
                ])
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                @include("admin.counter_widget", [
                    "bgColor" => "aqua",
                    "counter" => $orderCount,
                    "title" => "Active Orders",
                    "icon" => 'fa fa-shopping-cart',
                    "route" => route('admin.orders.index')
                ])
            </div>
            <div class="col-lg-3 col-xs-6">
                @include("admin.counter_widget", [
                    "bgColor" => "light-blue",
                    "counter" => 0,
                    "title" => "Daily Sale",
                    "icon" => 'fa fa-money',
                    "route" => url('admin/')
                ])
            </div>
            <div class="col-lg-3 col-xs-6">
                @include("admin.counter_widget", [
                    "bgColor" => "blue",
                    "counter" => 0,
                    "title" => "Monthly Sale",
                    "icon" => 'fa fa-money',
                    "route" =>url('admin/')
                ])
            </div>
        </div>
        {{--<div class="row">--}}
            {{--<div class="col-lg-6">--}}
                {{--<div class="box box-success">--}}
                    {{--<div class="box-header with-border">`--}}
                        {{--<h3 class="box-title">Devices Registered</h3>--}}
                    {{--</div>--}}
                    {{--<div class="box-body chart-responsive">--}}
                        {{--<div class="chart" id="deviceGraph" style="height: 300px;"></div>--}}
                    {{--</div>--}}
                    {{--<!-- /.box-body -->--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </section>
@endsection
@push("scripts")
    <script>

        var deviceData =
                {!! json_encode($deviceGraph) !!}
        var device = new Morris.Bar({
                element: 'deviceGraph',
                resize: true,
                deviceData,
                barColors: ['#00a65a', '#f56954'],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Android', 'iOS'],
                hideHover: 'auto'
            });

    </script>
@endpush