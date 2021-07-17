@extends('admin.layouts.app')

@section('title')
    {{ $bannerManagement->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($bannerManagement, ['route' => ['admin.banner-managements.update', $bannerManagement->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.banner_managements.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection