<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control', 'placeholder'=>'Enter user_id']) !!}
</div>

<!-- Ref Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ref', 'Ref:') !!}
    {!! Form::text('ref', null, ['class' => 'form-control', 'placeholder'=>'Enter ref']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control', 'placeholder'=>'Enter type']) !!}
</div>

<!-- First Digits Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_digits', 'First Digits:') !!}
    {!! Form::text('first_digits', null, ['class' => 'form-control', 'placeholder'=>'Enter first_digits']) !!}
</div>

<!-- Last Digits Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_digits', 'Last Digits:') !!}
    {!! Form::text('last_digits', null, ['class' => 'form-control', 'placeholder'=>'Enter last_digits']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country', 'Country:') !!}
    {!! Form::text('country', null, ['class' => 'form-control', 'placeholder'=>'Enter country']) !!}
</div>

<!-- Expire Month Field -->
<div class="form-group col-sm-6">
    {!! Form::label('expire_month', 'Expire Month:') !!}
    {!! Form::text('expire_month', null, ['class' => 'form-control', 'placeholder'=>'Enter expire_month']) !!}
</div>

<!-- Expire Year Field -->
<div class="form-group col-sm-6">
    {!! Form::label('expire_year', 'Expire Year:') !!}
    {!! Form::text('expire_year', null, ['class' => 'form-control', 'placeholder'=>'Enter expire_year']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    @if(!isset($userCard))
        {!! Form::submit(__('Save And Add Translations'), ['class' => 'btn btn-primary', 'name'=>'translation']) !!}
    @endif
    {!! Form::submit(__('Save And Add More'), ['class' => 'btn btn-primary', 'name'=>'continue']) !!}
    <a href="{!! route('admin.user-cards.index') !!}" class="btn btn-default">Cancel</a>
</div>