@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ __('Edit') }}: {{ $testimonial->title }}
                    </div>
                    <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <form method="POST" action="/websiteadmin/testimonials/{{ $testimonial->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <div class="col">
                                    <label>Name</label>
                                    <input class="form-control" type="text" placeholder="{{ __('Name') }}" name="name"
                                        value="{{ $testimonial->name }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label>Title</label>
                                    <input class="form-control" type="text" placeholder="{{ __('Title') }}" name="title"
                                        value="{{ $testimonial->title }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label>Description</label>
                                    <textarea class="form-control" id="textarea-input" name="desc" rows="5"
                                        placeholder="{{ __('Description..') }}"
                                        required>{{ $testimonial->desc }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label>Image</label>
                                <input type="file" class="form-control" name="img" />
                            </div>

                            <div class="form-group row">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option {{ $testimonial->status ? 'selected' : '' }} value="0">Deactive</option>
                                    <option {{ $testimonial->status ? 'selected' : '' }} value="1">Active</option>
                                </select>
                            </div>

                            <button class="btn btn-block btn-success" type="submit">{{ __('Update') }}</button>
                            <a href="{{ route('testimonials.index') }}"
                                class="btn btn-block btn-primary">{{ __('Return') }}</a>
                        </form>
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
