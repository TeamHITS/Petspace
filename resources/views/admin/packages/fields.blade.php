<!-- Petspace Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('petspace_id', 'Petspace Id:') !!}
    {!! Form::text('petspace_id', null, ['class' => 'form-control', 'placeholder'=>'Enter petspace_id']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Enter name']) !!}
</div>

<!-- Package Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('package_type', 'Package Type:') !!}
    {!! Form::select('package_type', [], null, ['class' => 'form-control select2']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder'=>'Enter description']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::file('image') !!}
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    @if(!isset($package))
        {!! Form::submit(__('Save And Add Translations'), ['class' => 'btn btn-primary', 'name'=>'translation']) !!}
    @endif
    {!! Form::submit(__('Save And Add More'), ['class' => 'btn btn-primary', 'name'=>'continue']) !!}
    <a href="{!! route('admin.packages.index') !!}" class="btn btn-default">Cancel</a>
</div>