@extends('website.layouts.app')
@push('css')
    <style>
        div#order-table_length {
            display: none;
        }
    </style>
@endpush
@section('content')
    <div class="dashboard-main-wrap">
        @include('website.layouts.side-bar')
        <div class="main-stage">
            @include('website.layouts.main-header')
            <section class="stage-content-sec order-sec-2">
                <div class="container">
                    <div class="order-table-wrap">
                        <div class="order-table-top">
                            <div class="search">
                                <i class="fas fa-search"></i>
                                <input placeholder="Search by order no." class="order-search">
                            </div>
                            <div class="calender">
                                <div class="date-range-box" id="reportrange">
                                    <img src="{{ url('public/assets/images/icon-calender-grey.png') }}"
                                         class="img-fluid">
                                    <span>Today</span>
                                </div>
                            </div>
                            <div class="filter">
                                <button type="button" id="filter-side-toggle"><img
                                            src="{{ url('public/assets/images/icon-filter.png') }}" class="img-fluid">Filters
                                </button>
                            </div>
                            <div class="filter-list">
                                {{--<ul>
                                    <li><p>Selected Filters</p></li>
                                    <li class="filter-pill">
                                        <p>Schedule</p>
                                        <button class="btn-close" onclick="deleteFilterBtn(this)"></button>
                                    </li>
                                    <li class="filter-pill">
                                        <p>Schedule</p>
                                        <button class="btn-close" onclick="deleteFilterBtn(this)"></button>
                                    </li>
                                </ul>--}}
                            </div>
                        </div>
                        <table class="table gen-table gen-datatable shadow-card" id="order-table">
                            <thead>
                            <tr>
                                <th scope="col">NO.</th>
                                <th scope="col">ORDER</th>
                                <th scope="col">DATE</th>
                                <th scope="col">TIME</th>
                                <th scope="col">TECHNICIAN</th>
                                <th scope="col">STATUS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($orders))
                                @foreach($orders as $order)
                                    <tr onclick="orderDetail({{$order['id']}})">
                                        <td>{{$order['id']}}</td>
                                        <td>{{(!empty($order['services'])) ?$order['services'][0]['name']:""}}</td>
                                        <td>{{date('d-m-Y', strtotime($order['date_time']))  }}</td>
                                        <td>{{date('H:i', strtotime($order['date_time']))  }}</td>
                                        <td>{{(isset($order['technician']))? $order['technician']['user']['email']: ""}}</td>
                                        <td>
                                            <span class="pill {{$order['status_lable_color']}}">{{$order['status_text']}}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" style="text-align: center;">No Record Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- FILTER SIDEBAR -->
    <div id="filter-sidebar">
        <div class="filter-sidebar-inner">
            <a id="close-filter-sidebar"><i class="fas fa-times"></i></a>
            <p class="sidebar-title">Filter</p>
            <form id="order-filter-from" class="filter-form">
                <div class="form-group">
                    <label>Status</label>
                    <select id="status-filter" class="gen-input">
                        <option value="">Select Status</option>
                        @foreach(\App\Models\Order::$STATUS_TEXT as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Technician</label>
                    <select id="technician-filter" class="gen-input">
                        <option value="">Select Technician</option>
                        @foreach($technicians as $technician)
                            <option value="{{$technician['id']}}">{{$technician['user']['details']['first_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="button-wrap">
                    <button class="gen-btn cancel-btn" onclick="tempFunction()">Cancel</button>
                    <button type="submit" class="gen-btn" onclick="addFilter()">Apply</button>
                </div>
            </form>
        </div>
    </div>
    <div class="filter-sidebar-overlay"></div>
@endsection
@push('scripts')
    <script>

        $('#order-filter-from').on('submit', function (e) {
            e.preventDefault();
            var start = $('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-D');
            var end = $('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-D');
            var status = $('#status-filter').val()
            var tech = $('#technician-filter').val()
            getData(status, tech, start, end);
            filterSidebar.classList.remove('active');
            filterOverlay.classList.remove('active');

        })
        $('#reportrange').on('apply.daterangepicker', (e, picker) => {
            var start = $('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-D');
            var end = $('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-D');
            var status = $('#status-filter').val()
            var tech = $('#technician-filter').val()
            getData(status, tech, start, end);

        });

        function getData(status, tech, start, end) {
            console.log("status: " + status);
            console.log("tech: " + tech);
            console.log("Start: " + start);
            console.log("End: " + end);

            $.ajax({
                method: "GET",
                url: '{{url('/get-order-list')}}',
                data: {"status": status, "tech": tech, "start": start, "end": end},
                dataType: 'json',
                success: function (data) {
                    $('.table').DataTable().clear();
                    $('.table').DataTable().destroy();
                    $.each(data.data.orders, function (key, value) {
                        var row = ' <tr onclick="orderDetail(' + value['order_id'] + ')">\n' +
                            '<td>' + value['order_id'] + '</td>\n' +
                            '<td>' + value['service'] + '</td>\n' +
                            '<td>' + value['date'] + '</td>\n' +
                            '<td>' + value['time'] + '</td>\n' +
                            '<td>' + value['technician'] + '</td>\n' +
                            '<td>' + value['status'] + '</td>\n' +
                            '</tr>'
                        $('.table').find('tbody').append(row);
                        console.log(value['order_id'])
                    });
                    $('.table').DataTable().draw();

                }, error: function (edata) {

                    callback(false, edata)

                }
            });
        }

        // $('#reportrange').click(function(){
        //     var start = $('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-D') ;
        //     var end = $('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-D') ;
        //     console.log("Start: "+start);
        //     console.log("End: "+end);
        // });

        function orderDetail(order_id) {
            var url = "{!! url('/order/') !!}" + "/" + order_id;
            $(location).attr('href', url)
            // window.location.replace(url);
        }

        function deleteFilterBtn(param) {
            $(param).closest('.filter-pill').remove();
            // var start = $('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-D') ;
            // var end = $('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-D') ;
            // var status =$('#status-filter').val()
            // var tech =$('#technician-filter').val()
            // getData(status,tech,start,end);
        }

        function tempFunction() {
            filterSidebar.classList.remove('active');
            filterOverlay.classList.remove('active');
        }

        function addFilter() {
            var ftstatus = $("#status-filter option:selected").text();
            var ftTech = $("#technician-filter option:selected").text();

            var filter = '<ul> <li><p>Selected Filters</p></li>';
            if ($("#status-filter option:selected").val() > 0) {
                filter += '<li class="filter-pill"> <p>' + ftstatus + '</p> <button class="btn-close" onclick="deleteFilterBtn(this)"></button></li>';
            }
            if ($("#technician-filter option:selected").val() > 0) {
                filter += '<li class="filter-pill"><p>' + ftTech + '</p><button class="btn-close" onclick="deleteFilterBtn(this)"></button> </li> </ul>';
            }


            $(".filter-list").html("");
            $(".filter-list").html(filter);

        }
    </script>
@endpush
