@extends('admin.layouts.app')

@section('title')
    {{ $packageSize->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($packageSize, ['route' => ['admin.package-sizes.update', $packageSize->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.package_sizes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection