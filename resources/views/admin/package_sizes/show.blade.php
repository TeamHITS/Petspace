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
                        @include('admin.package_sizes.show_fields')
                    </dl>
                    {!! Form::open(['route' => ['admin.package-sizes.destroy', $packageSize->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @ability('super-admin' ,'package-sizes.show')
                        <a href="{!! route('admin.package-sizes.index') !!}" class="btn btn-default">
                            <i class="glyphicon glyphicon-arrow-left"></i> Back
                        </a>
                        @endability
                    </div>
                    <div class='btn-group'>
                        @ability('super-admin' ,'package-sizes.edit')
                        <a href="{{ route('admin.package-sizes.edit', $packageSize->id) }}" class='btn btn-default'>
                            <i class="glyphicon glyphicon-edit"></i> Edit
                        </a>
                        @endability
                    </div>
                    <div class='btn-group'>
                        @ability('super-admin' ,'package-sizes.destroy')
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