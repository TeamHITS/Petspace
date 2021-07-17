@extends('admin.layouts.app')

@section('title')
    {{ $promoCode->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($promoCode, ['route' => ['admin.promo-codes.update', $promoCode->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.promo_codes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection