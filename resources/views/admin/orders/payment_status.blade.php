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
                <?php if($card_status === 2){?> 
                      <div class="col-sm-12">
                        @if(isset($response['auth']))
                            <p>Status :  {{ !is_array($response['auth']['status']) ? $response['auth']['status'] : print_r($response['auth']['status'])}}</p>
                            <p>Message :  {{ !is_array($response['auth']['message']) ? $response['auth']['message'] : print_r($response['auth']['message'])}}</p>
                            <p>Ref :  {{ !is_array($response['auth']['tranref']) ? $response['auth']['tranref'] : print_r($response['auth']['tranref'])}}</p>

                      	 @else
                        <p>Payment Failure :  Something went wrong</p>
                        <p>Status :  {{ !is_array($response['auth']['status']) ? $response['auth']['status'] : print_r($response['auth']['status'])}}</p>
                         <p>Message :  {{ !is_array($response['auth']['message']) ? $response['auth']['message'] : print_r($response['auth']['message'])}}</p>
                            <p>Ref :  {{ !is_array($response['auth']['tranref']) ? $response['auth']['tranref'] : print_r($response['auth']['tranref'])}}</p>
                      @endif
                      </div>
                <?php } else { ?>
                    <div class="col-sm-12">
                        @if($response['order']['ref']!==null)
                            <h3>{{@$response['order']['url']}}</h3><br />
                            <p>Copy above URL and ask customer to pay as soon as possible.</p>
                        @else
                            <p>Payment Failure :  Something went wrong</p>
                        @endif
                    </div>
                <?php } ?>
           </div>
       </div>
    </div>
   
@endsection
