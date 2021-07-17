<!-- Id Field -->
<dt>{!! Form::label('id', 'Id:') !!}</dt>
<dd>{!! $transaction->id !!}</dd>

<!-- User Id Field -->
<dt>{!! Form::label('user_id', 'User Id:') !!}</dt>
<dd>{!! $transaction->user_id !!}</dd>

<!-- Order Id Field -->
<dt>{!! Form::label('order_id', 'Order Id:') !!}</dt>
<dd>{!! $transaction->order_id !!}</dd>

<!-- Transaction Id Field -->
<dt>{!! Form::label('transaction_id', 'Transaction Id:') !!}</dt>
<dd>{!! $transaction->transaction_id !!}</dd>

<!-- Payment Status Field -->
<dt>{!! Form::label('payment_status', 'Payment Status:') !!}</dt>
<dd>{!! $transaction->payment_status !!}</dd>

<!-- Amount Field -->
<dt>{!! Form::label('amount', 'Amount:') !!}</dt>
<dd>{!! $transaction->amount !!}</dd>

<!-- Created At Field -->
<dt>{!! Form::label('created_at', 'Created At:') !!}</dt>
<dd>{!! $transaction->created_at !!}</dd>

<!-- Updated At Field -->
<dt>{!! Form::label('updated_at', 'Updated At:') !!}</dt>
<dd>{!! $transaction->updated_at !!}</dd>

<!-- Delated At Field -->
<dt>{!! Form::label('delated_at', 'Delated At:') !!}</dt>
<dd>{!! $transaction->delated_at !!}</dd>

