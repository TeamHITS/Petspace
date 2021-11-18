@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Title: {{ $templates->name ?? '' }}</div>
                    <div class="card-body">
                        <h4>Name:</h4>
                        <p> {{ $templates->name ?? '' }}</p>
                        <br>

                        <h4>Html:</h4>
                        <p>{{ $templates->html ?? '' }}</p>
                        <br>
                        <h4> Status: </h4>
                        <p>
                            <span class="badge badge-pill badge-{{ $templates && $templates->status ? 'success' : 'danger' }}">
                                {{ $templates && $templates->status ? 'Active' : 'Deactive' }}
                            </span>
                        </p>
                        <br>
                        <a href="{{ url('templates/'.$page) }}" class="btn btn-block btn-primary">{{ __('Return') }}</a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection


@section('javascript')

@endsection
