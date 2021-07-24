<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Enter name']) !!}
</div>

{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('email', 'Email:') !!}--}}
    {{--{!! Form::text('email', null, ['class' => 'form-control', 'placeholder'=>'Enter email']) !!}--}}
{{--</div>--}}

<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder'=>'Enter phone']) !!}
</div>



<!-- Grooming Field -->
<div class="form-group col-sm-6">
    {!! Form::label('grooming', 'Grooming:') !!}
    {!! Form::select('grooming', \App\Models\Petspace::$GROOMING_TEXT, null, ['class' => 'form-control ']) !!}
</div>
<!-- Is Pick Drop Available Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_pick_drop_available', 'Is Pick Drop Available:') !!}
    {!! Form::select('is_pick_drop_available', \App\Models\Petspace::$DELIVERY_TEXT, null, ['class' => 'form-control ']) !!}
</div>
<!-- Min Order Field -->
<div class="form-group col-sm-6">
    {!! Form::label('min_order', 'Min Order:') !!}
    {!! Form::text('min_order', null, ['class' => 'form-control', 'placeholder'=>'Enter min order']) !!}
</div>

<!-- Delivery Fee Field -->
<div class="form-group col-sm-6">
    {!! Form::label('delivery_fee', 'Delivery Fee:') !!}
    {!! Form::text('delivery_fee', null, ['class' => 'form-control', 'placeholder'=>'Enter delivery_fee']) !!}
</div>
{{--<!-- Is Delivery Fee Field -->--}}
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('is_delivery_fee', 'Is Delivery Fee:') !!}--}}
    {{--{!! Form::select('is_delivery_fee', [], null, ['class' => 'form-control select2']) !!}--}}
{{--</div>--}}





<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::file('image') !!}
</div>

<div class="form-group col-sm-6">
     {!! Form::label('is_temporary_closed', 'Temporarily Closed:') !!}
    <input name="is_temporary_closed" data-toggle="toggle" type="checkbox"
           id="is_temporary_closed" {{($petspace['is_temporary_closed']) ? 'checked="checked"':''}}/>
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    {{--@if(!isset($petspace))--}}
        {{--{!! Form::submit(__('Save And Add Translations'), ['class' => 'btn btn-primary', 'name'=>'translation']) !!}--}}
    {{--@endif--}}
    {{--{!! Form::submit(__('Save And Add More'), ['class' => 'btn btn-primary', 'name'=>'continue']) !!}--}}
    <a href="{!! route('admin.petspaces.index') !!}" class="btn btn-default">Cancel</a>
</div>