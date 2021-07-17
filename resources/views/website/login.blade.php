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
                        <li><a href="#!" data-bs-toggle="modal" data-bs-target="#contactPetspace" class="gen-btn">Contact Petspace</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="auth-main-sec">
        <div class="container">
            <div class="auth-card">
                <form  id="submit-form"  action="{{URL::to('/logining')}}" method="POST">
                    <div class="form-top">
                        <p class="title">Sign In</p>
                        <p class="sub-title">Please enter your credentials top proceed.</p>
                    </div>
                    <div class="error-notification" id="response-alert" style="display: none;">
                        <p>You entered an incorrect email/password.</p>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                        <input type="hidden" name="device_type" value="web">
                    </div>

                    <div class="form-group">
                        <label class="d-flex justify-content-between">
                            <span>Password</span>
                            <a href="{{ url('/forgot-password') }}" class="forgot-pass">Forgot Password?</a>
                        </label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="submit-btn">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div class="modal fade gen-modal contact-petspace-modal" id="contactPetspace" tabindex="-1" aria-hidden="true">
        <!-- EDIT TECHNICIAN MODAL -->
        <div class="modal-dialog modal-dialog-centered" style="width: max-content;">
            <div class="modal-content" style="width: auto !important">
                <div class="modal-header">
                    <h5 class="modal-title">Contact Petspace</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="gen-input"
                                       disabled
                                       value="woof@petspace.app" >
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Number</label>
                                <input type="text" class="gen-input"
                                       value="+971 55 598 5588" disabled>
                                @csrf
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div>
                        <button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


