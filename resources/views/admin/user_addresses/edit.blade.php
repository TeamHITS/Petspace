@extends('admin.layouts.app')

@section('title')
    {{ $userAddress->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userAddress, ['route' => ['admin.user-addresses.update', $userAddress->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.user_addresses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection