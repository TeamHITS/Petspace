@extends('admin.layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="content">
        @include('admin.orders.latepayment')
        @include('admin.orders.viewdetails')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    <dl class="dl-horizontal">
                        @include('admin.orders.show_fields')
                    </dl>
                    {!! Form::open(['route' => ['admin.orders.destroy', $order->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @ability('super-admin' ,'orders.show')
                        <a href="{!! route('admin.orders.index') !!}" class="btn btn-default">
                            <i class="glyphicon glyphicon-arrow-left"></i> Back
                        </a>
                        @endability
                    </div>
                    <div class='btn-group'>
                        @ability('super-admin' ,'orders.edit')

                        @php
                            $hlink = route('admin.orders.edit', $order->id);
                            if($order->status == 30 || $order->status == 40){
                                 $hlink =  "javascript:void(0)";
                             } 
                        @endphp
                        <a @if($order->status == 30 || $order->status == 40) disabled="disabled" @endif href="{{ $hlink }}" class='btn btn-default'>
                            <i class="glyphicon glyphicon-edit"></i> Edit
                        </a>
                        @endability
                    </div>
                    <div class='btn-group'>
                        <a href="javascript:void(0)" id="viewOrderDetails" data-id="{{$order->id}}" class='btn btn-default'>
                            <i class="glyphicon glyphicon-eye-open"></i> View order detail
                        </a>
                    </div>
                    <div class='btn-group'>
                        @ability('super-admin' ,'orders.destroy')
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Delete', [
                            'type' => 'submit',
                            'class' => 'btn btn-danger',
                            'onclick' => "confirmDelete($(this).parents('form')[0]); return false;"
                        ]) !!}
                        @endability
                    </div>
                     <div class='btn-group'>
                        <a href="javascript:void(0)" id="confirm_payment" data-id="{{$order->id}}" class='btn btn-default'>
                            <i class="glyphicon glyphicon-ok"></i> Confirm Payment
                        </a>
                    </div>
                    @if($transactions==null)
                    <div class="btn-group">
                        <a href="javascript:void(0)" id="late_payment" data-id="{{$order->id}}" class='btn btn-default'>
                            <i class="glyphicon glyphicon-ok"></i> Make Payment
                        </a>
                    </div>
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection