{{--<!-- Id Field -->--}}
{{--<dt>{!! Form::label('id', 'Id:') !!}</dt>--}}
{{--<dd>{!! $petspace->id !!}</dd>--}}

<!-- Name Field -->
<dt>{!! Form::label('name', 'Name:') !!}</dt>
<dd>{!! $petspace->name !!}</dd>

<dt>{!! Form::label('email', 'Email:') !!}</dt>
<dd>{!! $petspace->email !!}</dd>

<dt>{!! Form::label('phone', 'Phone:') !!}</dt>
<dd>{!! $petspace->phone !!}</dd>

<dt>{!! Form::label('address', 'Address:') !!}</dt>
<dd>{!! $petspace->address !!}</dd>

<!-- Grooming Field -->
<dt>{!! Form::label('grooming', 'Grooming:') !!}</dt>
<dd>{!! \App\Models\Petspace::$GROOMING_TEXT[$petspace->grooming] !!}</dd>

<!-- Is Delivery Fee Field -->
<dt>{!! Form::label('is_delivery_fee', 'Is Delivery Fee:') !!}</dt>
<dd>{!! \App\Models\Petspace::$DELIVERY_TEXT[$petspace->is_delivery_fee]!!}</dd>

<!-- Is Pick Drop Available Field -->
{{--<dt>{!! Form::label('is_pick_drop_available', 'Is Pick Drop Available:') !!}</dt>--}}
{{--<dd>{!! ($petspace->is_pick_drop_available)? "Yes" : "No" !!}</dd>--}}

<!-- Delivery Fee Field -->
<dt>{!! Form::label('delivery_fee', 'Delivery Fee:') !!}</dt>
<dd>{!! $petspace->delivery_fee !!}</dd>

<dt>{!! Form::label('min_order', 'Min Order:') !!}</dt>
<dd>{!! $petspace->min_order !!}</dd>

<!-- Rating Field -->
<dt>{!! Form::label('rating', 'Rating:') !!}</dt>
<dd>{!! $petspace->rating !!}</dd>

<dt>{!! Form::label('google_rating', 'Google Rating:') !!}</dt>
<dd>{!! $petspace->google_rating !!}</dd>

<!-- Latitude Field -->
{{--<dt>{!! Form::label('latitude', 'Latitude:') !!}</dt>--}}
{{--<dd>{!! $petspace->latitude !!}</dd>--}}

{{--<!-- Longitude Field -->--}}
{{--<dt>{!! Form::label('longitude', 'Longitude:') !!}</dt>--}}
{{--<dd>{!! $petspace->longitude !!}</dd>--}}

<!-- Image Field -->
<dt>{!! Form::label('image', 'Image:') !!}</dt>
{{--<dd>{!! $petspace->image !!}</dd>--}}
<img class="img-responsive" width="250" height="250" style="padding-left: 20px !important;" src="{{$petspace->image_url}}"
     alt="image">

