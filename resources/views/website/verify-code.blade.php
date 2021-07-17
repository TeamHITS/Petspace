@extends('website.layouts.app')
@section('content')

    <section class="auth-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-3">
                    <div class="logo-wrap">
                        <img src="{{ url('/public/assets/images/logo.png') }}" alt="logo" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-9">
                    <ul class="auth-top-btn">
                        <li><a href="#!">Need assistance?</a></li>
                        <li><a href="#!" class="gen-btn">Contact Petspace</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="auth-main-sec">
        <div class="container">
            <div class="auth-card">
                <form id="submit-form" action="{{URL::to('/verify-code')}}" method="POST">
                    <div class="form-top">
                        <p class="title">Verify Code</p>
                        <p class="sub-title">Enter verification code recieved on email</p>
                    </div>
                    <div class="error-notification" id="response-alert" style="display: none;">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <label>Code</label>
                        <input type="text" name="verification_code" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" class="submit-btn">Continue</button>
                    </div>
                    <div class="form-group mb-0 text-center">
                        <a href="{{ url('/login') }}" class="back-btn">Back to sign in</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
