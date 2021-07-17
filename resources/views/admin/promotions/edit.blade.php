@extends('admin.layouts.app')

@section('title')
    {{ $promotion->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($promotion, ['route' => ['admin.promotions.update', $promotion->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.promotions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection