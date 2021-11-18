<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control', 'placeholder'=>'Enter user_id']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Enter name']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control', 'placeholder'=>'Enter type']) !!}
</div>

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', 'Gender:') !!}
    {!! Form::text('gender', null, ['class' => 'form-control', 'placeholder'=>'Enter gender']) !!}
</div>

<!-- Breed Field -->
<div class="form-group col-sm-6">
    {!! Form::label('breed', 'Breed:') !!}
    {!! Form::text('breed', null, ['class' => 'form-control', 'placeholder'=>'Enter breed']) !!}
</div>

<!-- Weight Field -->
<div class="form-group col-sm-6">
    {!! Form::label('weight', 'Weight:') !!}
    {!! Form::text('weight', null, ['class' => 'form-control', 'placeholder'=>'Enter weight']) !!}
</div>

<!-- Color Field -->
<div class="form-group col-sm-6">
    {!! Form::label('color', 'Color:') !!}
    {!! Form::text('color', null, ['class' => 'form-control', 'placeholder'=>'Enter color']) !!}
</div>

<!-- Chip Id Num Field -->
<div class="form-group col-sm-6">
    {!! Form::label('chip_id_num', 'Chip Id Num:') !!}
    {!! Form::text('chip_id_num', null, ['class' => 'form-control', 'placeholder'=>'Enter chip_id_num']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::text('image', null, ['class' => 'form-control', 'placeholder'=>'Enter image']) !!}
</div>

<!-- Birthdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('birthdate', 'Birthdate:') !!}
    {!! Form::text('birthdate', null, ['class' => 'form-control', 'placeholder'=>'Enter birthdate']) !!}
</div>

<!-- Neutered Field -->
<div class="form-group col-sm-6">
    {!! Form::label('neutered', 'Neutered:') !!}
    {!! Form::text('neutered', null, ['class' => 'form-control', 'placeholder'=>'Enter neutered']) !!}
</div>

<!-- Instruction Field -->
<div class="form-group col-sm-6">
    {!! Form::label('instruction', 'Instruction:') !!}
    {!! Form::text('instruction', null, ['class' => 'form-control', 'placeholder'=>'Enter instruction']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    @if(!isset($orderServicePet))
        {!! Form::submit(__('Save And Add Translations'), ['class' => 'btn btn-primary', 'name'=>'translation']) !!}
    @endif
    {!! Form::submit(__('Save And Add More'), ['class' => 'btn btn-primary', 'name'=>'continue']) !!}
    <a href="{!! route('admin.order-service-pets.index') !!}" class="btn btn-default">Cancel</a>
</div>