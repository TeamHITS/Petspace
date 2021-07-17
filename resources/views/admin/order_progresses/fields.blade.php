<!-- Order Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_id', 'Order Id:') !!}
    {!! Form::text('order_id', null, ['class' => 'form-control', 'placeholder'=>'Enter order_id']) !!}
</div>

<!-- Progress Stauts Field -->
<div class="form-group col-sm-6">
    {!! Form::label('progress_status', 'Progress Stauts:') !!}
    {!! Form::text('progress_status', null, ['class' => 'form-control', 'placeholder'=>'Enter progress_status']) !!}
</div>

<!-- Date Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_time', 'Date Time:') !!}
    {!! Form::text('date_time', null, ['class' => 'form-control', 'placeholder'=>'Enter date_time']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    @if(!isset($orderProgress))
        {!! Form::submit(__('Save And Add Translations'), ['class' => 'btn btn-primary', 'name'=>'translation']) !!}
    @endif
    {!! Form::submit(__('Save And Add More'), ['class' => 'btn btn-primary', 'name'=>'continue']) !!}
    <a href="{!! route('admin.order-progresses.index') !!}" class="btn btn-default">Cancel</a>
</div>