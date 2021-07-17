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
                        @include('admin.submenu_services.show_fields')
                    </dl>
                    {!! Form::open(['route' => ['admin.submenu-services.destroy', $submenuService->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @ability('super-admin' ,'submenu-services.show')
                        <a href="{!! route('admin.submenu-services.index') !!}" class="btn btn-default">
                            <i class="glyphicon glyphicon-arrow-left"></i> Back
                        </a>
                        @endability
                    </div>
                    <div class='btn-group'>
                        @ability('super-admin' ,'submenu-services.edit')
                        <a href="{{ route('admin.submenu-services.edit', $submenuService->id) }}" class='btn btn-default'>
                            <i class="glyphicon glyphicon-edit"></i> Edit
                        </a>
                        @endability
                    </div>
                    <div class='btn-group'>
                        @ability('super-admin' ,'submenu-services.destroy')
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
    </div>
@endsection