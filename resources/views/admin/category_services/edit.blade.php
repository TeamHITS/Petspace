@extends('admin.layouts.app')

@section('title')
    {{ $categoryService->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($categoryService, ['route' => ['admin.category-services.update', $categoryService->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.category_services.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection