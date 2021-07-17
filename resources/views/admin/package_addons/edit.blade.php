@extends('admin.layouts.app')

@section('title')
    {{ $packageAddon->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($packageAddon, ['route' => ['admin.package-addons.update', $packageAddon->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.package_addons.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection