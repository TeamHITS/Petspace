@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>{{ __('Testimonials') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <a href="{{ route('testimonials.create') }}" class="btn btn-primary m-2">{{ __('Add Testimonial') }}</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($testimonials as $testimonial)
                                <tr>
                                    <td><strong>{{ $testimonial->name }}</strong></td>
                                    <td>{{ $testimonial->title }}</td>
                                    <td>{{ $testimonial->desc }}</td>
                                    <td>{{ $testimonial->file_name }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-{{ $testimonial->status ? 'success' : 'danger' }}">
                                            {{ $testimonial->status ? 'Active' : 'Deactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ url('/websiteadmin/testimonials/' . $testimonial->id) }}"
                                            class="btn btn-block btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/websiteadmin/testimonials/' . $testimonial->id . '/edit') }}"
                                            class="btn btn-block btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('testimonials.destroy', $testimonial->id ) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-block btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $testimonials->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection
