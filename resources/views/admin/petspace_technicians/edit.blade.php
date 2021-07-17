@extends('admin.layouts.app')

@section('title')
    {{ $petspaceTechnician->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($petspaceTechnician, ['route' => ['admin.petspace-technicians.update', $petspaceTechnician->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.petspace_technicians.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection