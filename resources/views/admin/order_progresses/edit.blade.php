@extends('admin.layouts.app')

@section('title')
    {{ $orderProgress->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($orderProgress, ['route' => ['admin.order-progresses.update', $orderProgress->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.order_progresses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection