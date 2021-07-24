@extends('admin.layouts.app')

@section('title')
    {{ $title }}
    <input name="is_shops_open" data-toggle="toggle" type="checkbox"
           id="checkbox1" {{($is_shops_open) ? 'checked="checked"':''}}/><br/>
    <input type="text" hidden id="textbox1"/>
@endsection

@section('content')
   <!--  <div class="content" style="min-height: 0px !important;">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <form action="{{url('admin/shop-timings')}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                        <div class="form-group col-sm-3">
                            <label for="start_time">Start Time</label>
                            <input name="start_time" type="time" id="start_time" style="margin: 10px;" value="{{$settings->start_time}}" required/>
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="close_time">Close Time</label>
                            <input name="close_time" type="time" id="close_time" style="margin: 10px;" value="{{$settings->close_time}}" required/>
                        </div>
                        <div class="form-group col-sm-4">
                            @csrf
                            <button type="submit" class="btn btn-primary" style="margin: 10px;">Apply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('admin.petspaces.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
@push('scripts')

    <script>
        $(document).ready(function () {
            //set initial state.
            $('#textbox1').val(this.checked);

            $('#checkbox1').change(function () {

                var temp = 0;
                if (this.checked) {
                    console.log("checked")
                    temp = 1;
                } else {
                    console.log("unchecked")
                    temp = 2;
                }

                var url = "{{url('admin/shop-open-close').'/'}}" + temp;

                $.ajax({
                    method: "GET",
                    url: url,
                    success: function (rdata) {
                        callback(true, rdata)
                    }, error: function (edata) {

                        callback(false, edata)

                    }
                });
                $('#textbox1').val(this.checked);
            });
        });
    </script>
@endpush()
