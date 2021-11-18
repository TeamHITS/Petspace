@extends('admin.layouts.app')

@section('title')
    {{ $orderServicePet->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($orderServicePet, ['route' => ['admin.order-service-pets.update', $orderServicePet->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.order_service_pets.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection