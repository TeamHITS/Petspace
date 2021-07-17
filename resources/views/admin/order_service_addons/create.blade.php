@extends('admin.layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'admin.order-service-addons.store', 'files' => true]) !!}

                        @include('admin.order_service_addons.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
