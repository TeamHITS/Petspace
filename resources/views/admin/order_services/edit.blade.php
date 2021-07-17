@extends('admin.layouts.app')

@section('title')
    {{ $orderService->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($orderService, ['route' => ['admin.order-services.update', $orderService->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.order_services.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection