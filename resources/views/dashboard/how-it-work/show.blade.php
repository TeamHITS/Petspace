@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Title: {{ $how_it_work->title }}</div>
                    <div class="card-body">
                        <br>
                        <h4>Title:</h4>
                        <p> {{ $how_it_work->title }}</p>
                        <br>

                        <h4>Description:</h4>
                        <p>{{ $how_it_work->desc }}</p>
                        <br>
                        <h4> Status: </h4>
                        <p>
                            <span class="badge badge-pill badge-{{ $how_it_work->status ? 'success' : 'danger' }}">
                                {{ $how_it_work->status ? 'Active' : 'Deactive' }}
                            </span>
                        </p>
                        <br>
                        <a href="{{ route('how-it-works.index') }}" class="btn btn-block btn-primary">{{ __('Return') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{'/storage/'.$how_it_work->path.'/'.$how_it_work->file_name}}"
                        alt="No Image Found...">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('javascript')

@endsection
