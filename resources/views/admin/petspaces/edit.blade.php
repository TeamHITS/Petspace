@extends('admin.layouts.app')

@section('title')
    {{ $petspace->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($petspace, ['route' => ['admin.petspaces.update', $petspace->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.petspaces.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection