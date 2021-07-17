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
                    {!! Form::open(['route' => 'admin.user-pets.store', 'files' => true]) !!}

                        @include('admin.user_pets.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
