@extends('admin.layouts.app')

@section('title')
    {{ $order->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       @include('flash::message')

       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                @if($card_status == 'oldcard') 
                      <div class="col-sm-12">
                        <p>Status :  {{$response['auth']['status']}}</p>
                        <p>Message :  {{$response['auth']['message']}}</p>
                        <p>Ref :  {{$response['auth']['tranref']}}</p>
                        <p>Detail :  {{$response['payment']['description']}}</p>
                        <p>Card ending :  {{$response['payment']['card_end']}}</p>
                      </div>
                @else
                    <div class="col-sm-12">
                        <h3>{{$response['order']['url']}}</h3>
                        <p>Copy above URL and ask customer to pay as soon as possible.</p>
                    </div>
                @endif
           </div>
       </div>
    </div>
   
@endsection