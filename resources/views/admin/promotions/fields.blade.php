<!-- Message Field -->
<div class="form-group col-sm-6">
    {!! Form::label('message', 'Message:') !!}
    {!! Form::text('message', null, ['class' => 'form-control', 'placeholder'=>'Enter message']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.promotions.index') !!}" class="btn btn-default">Cancel</a>
</div>