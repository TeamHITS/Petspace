@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ __('Edit') }}: {{ $templates->name ?? '' }}
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
                        <form method="POST" action="/websiteadmin/templates/{{$page}}"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{$templates->id ?? ''}}">

                            <div class="form-group row">
                                <div class="col">
                                    <label>Name</label>
                                    <input class="form-control" type="text" placeholder="{{ __('Name') }}" name="name"
                                        value="{{ $page ?? '' }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label>Html</label>
                                    <textarea class="ckeditor form-control" id="textareaHtml" name="html"
                                        required>{{ $templates->html ?? '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option {{ $templates && $templates->status ? 'selected' : '' }} value="0">Deactive</option>
                                    <option {{ $templates && $templates->status ? 'selected' : '' }} value="1">Active</option>
                                </select>
                            </div>

                            <button class="btn btn-block btn-success" type="submit">{{ __('Update') }}</button>
                            <a href="{{ url('templates/'.$page) }}"
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
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection
