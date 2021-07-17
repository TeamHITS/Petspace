{{--<!-- Id Field -->--}}
{{--<dt>{!! Form::label('id', 'Id:') !!}</dt>--}}
{{--<dd>{!! $petspaceTechnician->id !!}</dd>--}}

<!-- User Id Field -->
<dt>{!! Form::label('user_id', 'Name:') !!}</dt>
<dd>{!! $petspaceTechnician->user->name !!}</dd>

<dt>{!! Form::label('email', 'Email:') !!}</dt>
<dd>{!! $petspaceTechnician->user->email !!}</dd>

<dt>{!! Form::label('phone', 'Phone:') !!}</dt>
<dd>{!! $petspaceTechnician->user->details->phone !!}</dd>

{{--<!-- Petspace Id Field -->--}}
{{--<dt>{!! Form::label('petspace_id', 'Shop:') !!}</dt>--}}
{{--<dd>{!! $petspaceTechnician->shop->name !!}</dd>--}}

<!-- Status Field -->
<dt>{!! Form::label('status', 'Status:') !!}</dt>
<dd>{!! $petspaceTechnician->status_text !!}</dd>

{{--<!-- Created At Field -->--}}
{{--<dt>{!! Form::label('created_at', 'Created At:') !!}</dt>--}}
{{--<dd>{!! $petspaceTechnician->created_at !!}</dd>--}}

{{--<!-- Updated At Field -->--}}
{{--<dt>{!! Form::label('updated_at', 'Updated At:') !!}</dt>--}}
{{--<dd>{!! $petspaceTechnician->updated_at !!}</dd>--}}

{{--<!-- Deleted At Field -->--}}
{{--<dt>{!! Form::label('deleted_at', 'Deleted At:') !!}</dt>--}}
{{--<dd>{!! $petspaceTechnician->deleted_at !!}</dd>--}}

