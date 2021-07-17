@extends('admin.layouts.app')

@section('title')
    {{ $userCard->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userCard, ['route' => ['admin.user-cards.update', $userCard->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.user_cards.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection