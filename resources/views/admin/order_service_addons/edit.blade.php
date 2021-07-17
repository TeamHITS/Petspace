@extends('admin.layouts.app')

@section('title')
    {{ $orderServiceAddon->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($orderServiceAddon, ['route' => ['admin.order-service-addons.update', $orderServiceAddon->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.order_service_addons.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection