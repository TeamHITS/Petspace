<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'placeholder'=>'Enter code']) !!}
</div>

<!-- Discount Percentage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('discount_percentage', 'Discount Percentage:') !!}
    {!! Form::number('discount_percentage', null, ['class' => 'form-control']) !!}
</div>

<!-- Discount Percentage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valid_from', 'Valid From:') !!}
    {!! Form::date('valid_from', null, ['class' => 'form-control']) !!}
</div>


<!-- Discount Percentage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valid_to', 'Valid To:') !!}
    {!! Form::date('valid_to', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.promo-codes.index') !!}" class="btn btn-default">Cancel</a>
</div>