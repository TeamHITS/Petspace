@push('css')
    @include('admin.layouts.datatables_css')
@endpush


<div class="col-12">
    <div class="card card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Reviews</a>
                </li>
            </ul>
        </div>
        <div class="card-body" style="margin-top: 12px;">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade active in" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                    <table id="vendor-datatable" class="table table-bordered yajra-datatable">
                        <thead>
                        <tr>
                            <th>Order No</th>
                            <th>Rating</th>
                            <th>Comment</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--@foreach($reviews as $review)--}}
                        {{--<tr>--}}
                            {{--<td>{{$review->id}}</td>--}}
                            {{--<td>{{$review->rating}}</td>--}}
                            {{--<td>{{$review->rating_comment}}</td>--}}
                        {{--</tr>--}}
                        {{--@endforeach--}}
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

    <script>
        $(document).ready(function () {

            $('#vendor-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url:"{{url('admin/get-reviews-table').'/'.$petspace_id}}"
                },
                bAutoWidth:false,
                columns:[
                    {
                        data:'id',
                        name:'id'
                    },
                    {
                        data:'rating',
                        name:'rating'
                    },
                    {
                        data:'rating_comment',
                        name:'rating_comment'
                    }
                ]
            });
        })
    </script>
@endpush