<!-- Cat Service Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cat_service_id', 'Cat Service Id:') !!}
    {!! Form::select('cat_service_id', [], null, ['class' => 'form-control select2']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Enter name']) !!}
</div>

<!-- Decription Field -->
<div class="form-group col-sm-6">
    {!! Form::label('decription', 'Decription:') !!}
    {!! Form::text('decription', null, ['class' => 'form-control', 'placeholder'=>'Enter decription']) !!}
</div>

<!-- Condition Option Field -->
<div class="form-group col-sm-6">
    {!! Form::label('condition_option', 'Condition Option:') !!}
    {!! Form::text('condition_option', null, ['class' => 'form-control', 'placeholder'=>'Enter condition_option']) !!}
</div>

<!-- Select Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('select_count', 'Select Count:') !!}
    {!! Form::text('select_count', null, ['class' => 'form-control', 'placeholder'=>'Enter select_count']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    @if(!isset($submenuList))
        {!! Form::submit(__('Save And Add Translations'), ['class' => 'btn btn-primary', 'name'=>'translation']) !!}
    @endif
    {!! Form::submit(__('Save And Add More'), ['class' => 'btn btn-primary', 'name'=>'continue']) !!}
    <a href="{!! route('admin.submenu-lists.index') !!}" class="btn btn-default">Cancel</a>
</div>