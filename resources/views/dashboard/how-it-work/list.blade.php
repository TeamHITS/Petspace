@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>{{ __('How It Works') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <a href="{{ route('how-it-works.create') }}" class="btn btn-primary m-2">{{ __('Add How It Work') }}</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($howitworks as $howitwork)
                                <tr>
                                    <td><strong>{{ $howitwork->title }}</strong></td>
                                    <td>{{ $howitwork->desc }}</td>
                                    <td>{{ $howitwork->file_name }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-{{ $howitwork->status ? 'success' : 'danger' }}">
                                            {{ $howitwork->status ? 'Active' : 'Deactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ url('/websiteadmin/how-it-works/' . $howitwork->id) }}"
                                            class="btn btn-block btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/websiteadmin/how-it-works/' . $howitwork->id . '/edit') }}"
                                            class="btn btn-block btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('how-it-works.destroy', $howitwork->id ) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-block btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $howitworks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection
