<!-- Order Service Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_service_id', 'Order Service Id:') !!}
    {!! Form::select('order_service_id', [], null, ['class' => 'form-control select2']) !!}
</div>

<!-- Submenu Service Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('submenu_service_id', 'Submenu Service Id:') !!}
    {!! Form::select('submenu_service_id', [], null, ['class' => 'form-control select2']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::text('price', null, ['class' => 'form-control', 'placeholder'=>'Enter price']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    @if(!isset($orderServiceAddon))
        {!! Form::submit(__('Save And Add Translations'), ['class' => 'btn btn-primary', 'name'=>'translation']) !!}
    @endif
    {!! Form::submit(__('Save And Add More'), ['class' => 'btn btn-primary', 'name'=>'continue']) !!}
    <a href="{!! route('admin.order-service-addons.index') !!}" class="btn btn-default">Cancel</a>
</div>