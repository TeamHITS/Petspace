@push('css')
    @include('admin.layouts.datatables_css')
@endpush


<div class="col-12">
    <div class="card card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Vendor</a>
                </li>
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Technician</a>--}}
                {{--</li>--}}
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Manager</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-supervisor" role="tab" aria-controls="custom-tabs-three-supervisor" aria-selected="false">Supervisor</a>
                </li>
            </ul>
        </div>
        <div class="card-body" style="margin-top: 12px;">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade active in" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                    {!! $dataTable->table(['width' => '100%']) !!}
                </div>
                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                    <div class="dt-buttons btn-group">
                        <a class="btn btn-default buttons-create" tabindex="0" aria-controls="dataTableBuilder" href="{{URL('admin/users/create')}}"><span><i class="fa fa-plus"></i> Create</span></a>
                    </div>
                    <table id="vendor-datatable" class="table table-bordered yajra-datatable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                {{--<div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">--}}
                    {{--<table id="technician-datatable" class="table table-bordered yajra-datatable">--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                            {{--<th>Name</th>--}}
                            {{--<th>Email</th>--}}
                            {{--<th>Roles</th>--}}
                            {{--<th>Status</th>--}}
                            {{--<th>Action</th>--}}
                        {{--</tr>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}
                        {{--</tbody>--}}
                    {{--</table>--}}
                {{--</div>--}}
                <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                    <div class="dt-buttons btn-group">
                        <a class="btn btn-default buttons-create" tabindex="0" aria-controls="dataTableBuilder" href="{{URL('admin/users/create')}}"><span><i class="fa fa-plus"></i> Create</span></a>
                    </div>
                    <table id="manager-datatable" class="table table-bordered yajra-datatable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-three-supervisor" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                    <div class="dt-buttons btn-group">
                        <a class="btn btn-default buttons-create" tabindex="0" aria-controls="dataTableBuilder" href="{{URL('admin/users/create')}}"><span><i class="fa fa-plus"></i> Create</span></a>
                    </div>
                    <table id="supervisor-datatable" class="table table-bordered yajra-datatable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@push('scripts')
    @include('admin.layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function () {

            $('#vendor-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url:"{{url('admin/get-vendor-table')}}"
                },
                bAutoWidth:false,
                columns:[
                    {
                        data:'name',
                        name:'name'
                    },
                    {
                        data:'email',
                        name:'email'
                    },
                    {
                        data:'roles',
                        name:'roles'
                    },
                    {
                        data:'status',
                        name:'status'
                    },
                    {
                        data:'action',
                        name:'action',
                        orderable:false
                    }
                ]
            });

            {{--$('#technician-datatable').DataTable({--}}
                {{--processing: true,--}}
                {{--serverSide: true,--}}
                {{--ajax:{--}}
                    {{--url:"{{url('admin/get-technician-table')}}"--}}
                {{--},--}}
                {{--bAutoWidth:false,--}}
                {{--columns:[--}}
                    {{--{--}}
                        {{--data:'name',--}}
                        {{--name:'name'--}}
                    {{--},--}}
                    {{--{--}}
                        {{--data:'email',--}}
                        {{--name:'email'--}}
                    {{--},--}}
                    {{--{--}}
                        {{--data:'roles',--}}
                        {{--name:'roles'--}}
                    {{--},--}}
                    {{--{--}}
                        {{--data:'status',--}}
                        {{--name:'status'--}}
                    {{--},--}}
                    {{--{--}}
                        {{--data:'action',--}}
                        {{--name:'action',--}}
                        {{--orderable:false--}}
                    {{--}--}}
                {{--]--}}
            {{--});--}}

            $('#manager-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url:"{{url('admin/get-manager-table')}}"
                },
                bAutoWidth:false,
                columns:[
                    {
                        data:'name',
                        name:'name'
                    },
                    {
                        data:'email',
                        name:'email'
                    },
                    {
                        data:'roles',
                        name:'roles'
                    },
                    {
                        data:'status',
                        name:'status'
                    },
                    {
                        data:'action',
                        name:'action',
                        orderable:false
                    }
                ]
            });

            $('#supervisor-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url:"{{url('admin/get-supervisor-table')}}"
                },
                bAutoWidth:false,
                columns:[
                    {
                        data:'name',
                        name:'name'
                    },
                    {
                        data:'email',
                        name:'email'
                    },
                    {
                        data:'roles',
                        name:'roles'
                    },
                    {
                        data:'status',
                        name:'status'
                    },
                    {
                        data:'action',
                        name:'action',
                        orderable:false
                    }
                ]
            });
        })
    </script>
@endpush