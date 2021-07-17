@extends('admin.layouts.app')

@section('title')
    {{ $submenuService->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($submenuService, ['route' => ['admin.submenu-services.update', $submenuService->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.submenu_services.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection