@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ __('Edit') }}: {{ $faq->title }}
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
                        <form method="POST" action="/websiteadmin/faqs/{{ $faq->id }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <div class="col">
                                    <label>Title</label>
                                    <input class="form-control" type="text" placeholder="{{ __('Title') }}" name="title"
                                        value="{{ $faq->title }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label>Description</label>
                                    <textarea class="form-control" id="textarea-input" name="desc" rows="5"
                                        placeholder="{{ __('Description..') }}"
                                        required>{{ $faq->desc }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option {{ $faq->status ? 'selected' : '' }} value="0">Deactive</option>
                                    <option {{ $faq->status ? 'selected' : '' }} value="1">Active</option>
                                </select>
                            </div>

                            <button class="btn btn-block btn-success" type="submit">{{ __('Update') }}</button>
                            <a href="{{ route('faqs.index') }}"
                                class="btn btn-block btn-primary">{{ __('Return') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection
