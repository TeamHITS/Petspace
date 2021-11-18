@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Title: {{ $faq->title }}</div>
                    <div class="card-body">
                        
                        <h4>Title:</h4>
                        <p> {{ $faq->title }}</p>
                        <br>

                        <h4>Description:</h4>
                        <p>{{ $faq->desc }}</p>
                        <br>
                        <h4> Status: </h4>
                        <p>
                            <span class="badge badge-pill badge-{{ $faq->status ? 'success' : 'danger' }}">
                                {{ $faq->status ? 'Active' : 'Deactive' }}
                            </span>
                        </p>
                        <br>
                        <a href="{{ route('faqs.index') }}" class="btn btn-block btn-primary">{{ __('Return') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('javascript')

@endsection
