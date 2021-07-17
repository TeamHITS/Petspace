@extends('admin.layouts.app')

@section('title')
    {{ $userPet->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userPet, ['route' => ['admin.user-pets.update', $userPet->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.user_pets.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection