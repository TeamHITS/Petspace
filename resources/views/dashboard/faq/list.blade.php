@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>{{ __('FAQs') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <a href="{{ route('faqs.create') }}" class="btn btn-primary m-2">{{ __('Add FAQ') }}</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($faqs as $faq)
                                <tr>
                                    <td><strong>{{ $faq->title }}</strong></td>
                                    <td>{{ $faq->desc }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-{{ $faq->status ? 'success' : 'danger' }}">
                                            {{ $faq->status ? 'Active' : 'Deactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ url('/websiteadmin/faqs/' . $faq->id) }}"
                                            class="btn btn-block btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/websiteadmin/faqs/' . $faq->id . '/edit') }}"
                                            class="btn btn-block btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('faqs.destroy', $faq->id ) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-block btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $faqs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection
