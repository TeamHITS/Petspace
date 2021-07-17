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
                    {!! Form::open(['route' => 'admin.petspaces.store', 'files' => true]) !!}

                        @include('admin.petspaces.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
