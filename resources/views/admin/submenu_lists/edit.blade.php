@extends('admin.layouts.app')

@section('title')
    {{ $submenuList->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($submenuList, ['route' => ['admin.submenu-lists.update', $submenuList->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.submenu_lists.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection