<!-- Id Field -->
<dt>{!! Form::label('id', 'Order Id:') !!}</dt>
<dd>{!! $order->id !!}</dd>

<!-- User Id Field -->
<dt>{!! Form::label('user_id', 'Customer Name:') !!}</dt>
<dd>{!! $order->user->name !!}</dd>

<!-- Petspace Id Field -->
<dt>{!! Form::label('petspace_id', 'Petspace Id:') !!}</dt>
<dd>{!! $order->shop->name !!}</dd>

<!-- Status Field -->
<dt>{!! Form::label('status', 'Status:') !!}</dt>
<dd>{!! $order->status_text !!}</dd>

<!-- Address Field -->
<dt>{!! Form::label('address', 'Address:') !!}</dt>
<dd>{!! $order->address->address !!}</dd>

{{--<!-- Latitude Field -->--}}
{{--<dt>{!! Form::label('latitude', 'Latitude:') !!}</dt>--}}
{{--<dd>{!! $order->latitude !!}</dd>--}}

{{--<!-- Longitude Field -->--}}
{{--<dt>{!! Form::label('longitude', 'Longitude:') !!}</dt>--}}
{{--<dd>{!! $order->longitude !!}</dd>--}}

<!-- Date Time Field -->
<dt>{!! Form::label('date_time', 'Date Time:') !!}</dt>
<dd>{!! $order->date_time !!}</dd>

<!-- Rating Field -->

<!-- Delivery Fee Field -->
<dt>{!! Form::label('delivery_fee', 'Delivery Fee:') !!}</dt>
<dd>{!! $order->delivery_fee !!}</dd>

<!-- Total Field -->
<dt>{!! Form::label('total', 'Total:') !!}</dt>
<dd>{!! $order->total !!}</dd>

<!-- Note Field -->
<dt>{!! Form::label('note', 'Note:') !!}</dt>
<dd>{!! $order->note !!}</dd>
<dt>{!! Form::label('rating', 'Rating:') !!}</dt>
<dd>{!! $order->rating !!}</dd>
<dt>{!! Form::label('rating_comment', 'Review:') !!}</dt>
<dd>{!! $order->rating_comment !!}</dd>


{{--<!-- Created At Field -->--}}
{{--<dt>{!! Form::label('created_at', 'Created At:') !!}</dt>--}}
{{--<dd>{!! $order->created_at !!}</dd>--}}

{{--<!-- Updated At Field -->--}}
{{--<dt>{!! Form::label('updated_at', 'Updated At:') !!}</dt>--}}
{{--<dd>{!! $order->updated_at !!}</dd>--}}

{{--<!-- Deleted At Field -->--}}
{{--<dt>{!! Form::label('deleted_at', 'Deleted At:') !!}</dt>--}}
{{--<dd>{!! $order->deleted_at !!}</dd>--}}

