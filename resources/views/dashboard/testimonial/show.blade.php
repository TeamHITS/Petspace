@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Title: {{ $testimonial->title }}</div>
                    <div class="card-body">
                        <h4>Name:</h4>
                        <p> {{ $testimonial->name }}</p>
                        <br>

                        <h4>Title:</h4>
                        <p> {{ $testimonial->title }}</p>
                        <br>

                        <h4>Description:</h4>
                        <p>{{ $testimonial->desc }}</p>
                        <br>
                        <h4> Status: </h4>
                        <p>
                            <span class="badge badge-pill badge-{{ $testimonial->status ? 'success' : 'danger' }}">
                                {{ $testimonial->status ? 'Active' : 'Deactive' }}
                            </span>
                        </p>
                        <br>
                        <a href="{{ route('testimonials.index') }}" class="btn btn-block btn-primary">{{ __('Return') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{'/public/'.$testimonial->path.'/'.$testimonial->file_name}}"
                        alt="No Image Found...">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('javascript')

@endsection
