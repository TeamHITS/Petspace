<!-- Id Field -->
<dt>{!! Form::label('id', 'Id:') !!}</dt>
<dd>{!! $bannerManagement->id !!}</dd>

<dt>{!! Form::label('name', 'Name:') !!}</dt>
<dd>{!! $bannerManagement->name !!}</dd>

<!-- Image Field -->
<dt>{!! Form::label('image', 'Image:') !!}</dt>
<img class="img-responsive" width="500" height="500" src="{{$bannerManagement->image_url}}"
     alt="banner image">

