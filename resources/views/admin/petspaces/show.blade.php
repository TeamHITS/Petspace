@extends('admin.layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    <dl class="dl-horizontal">
                        @include('admin.petspaces.show_fields')
                    </dl>
                    {!! Form::open(['route' => ['admin.petspaces.destroy', $petspace->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @ability('super-admin' ,'petspaces.show')
                        <a href="{!! route('admin.petspaces.index') !!}" class="btn btn-default">
                            <i class="glyphicon glyphicon-arrow-left"></i> Back
                        </a>
                        @endability
                    </div>
                    <div class='btn-group'>
                        <a href="{!! url('admin/petspaces/service-menu').'/'.$petspace->id !!}" class="btn btn-default">
                            Menu Builder
                        </a>
                    </div>
                    <div class='btn-group'>
                        <a href="{!! url('admin/map-restriction').'/'.$petspace->id !!}" class="btn btn-default">
                            Map Restriction
                        </a>
                    </div>
                    <div class='btn-group'>
                        <a href="{!! url('admin/petspaces/reviews').'/'.$petspace->id !!}" class="btn btn-default">
                            Reviews
                        </a>
                    </div>
                    <div class='btn-group'>
                        @ability('super-admin' ,'petspaces.edit')
                        <a href="{{ route('admin.petspaces.edit', $petspace->id) }}" class='btn btn-default'>
                            <i class="glyphicon glyphicon-edit"></i> Edit
                        </a>
                        @endability
                    </div>
                    <div class='btn-group'>
                        @ability('super-admin' ,'petspaces.destroy')
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Delete', [
                            'type' => 'submit',
                            'class' => 'btn btn-danger',
                            'onclick' => "confirmDelete($(this).parents('form')[0]); return false;"
                        ]) !!}
                        @endability
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Technicians</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12 datatable-action-urls"
                         data-action-create="{{route('admin.petspace-technicians.create', ['petspace_id'=>$petspace->id])}}">
                        @push('css')
                            @include('admin.layouts.datatables_css')
                        @endpush
                        {!! $dataTable->table(['width' => '100%']) !!}
                        @push('scripts')
                            @include('admin.layouts.datatables_js')
                            {!! $dataTable->scripts() !!}
                        @endpush
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection