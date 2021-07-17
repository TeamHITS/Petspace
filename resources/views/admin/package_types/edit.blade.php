@extends('admin.layouts.app')

@section('title')
    {{ $packageType->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($packageType, ['route' => ['admin.package-types.update', $packageType->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.package_types.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection