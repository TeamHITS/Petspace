@extends('layouts.master')

@section('content')

<section class="partner-sec-1" id="becomepartner">
    <div class="container">
        <div class="partner-banner-text">
            <p class="heading">Become a Pet Partner</p>
            <a href="/contact" class="green-btn m-auto mt-3 mb-5">Join Now</a>
        </div>
        <div class="partner-banner-img">
            <img src="{{ asset('public') }}/web/images/partner-banner-img.png" alt="img" class="img-fluid">
        </div>
    </div>
    <div class="abs-img abs-1">
        <img src="{{ asset('public') }}/web/images/partner-banner-abs-1.png" alt="abs-img">
    </div>
    <div class="abs-img abs-2">
        <img src="{{ asset('public') }}/web/images/partner-banner-abs-2.png" alt="abs-img">
    </div>
    <div class="abs-img abs-3">
        <img src="{{ asset('public') }}/web/images/partner-banner-lines-1.png" alt="abs-img">
    </div>
    <div class="abs-img abs-4">
        <img src="{{ asset('public') }}/web/images/partner-banner-lines-2.png" alt="abs-img">
    </div>
</section>

<section class="partner-sec-2">
    <div class="container">
        <div class="gen-sec-top mx-490 mb-5">
            <p class="heading">Grow your Business</p>
            <p>Take your business to the next level with Petspace’s advanced tech platform!</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="partner-2-card">
                    <div class="icon">
                        <img src="{{ asset('public') }}/web/images/partner-card-1.png" alt="icon" class="img-fluid">
                    </div>
                    <div class="desc">
                        <p class="heading">Increase your Sales</p>
                        <p>Expose your business to thousands of pet parents who can book directly to your calendar 24/7 and secure payments
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="partner-2-card">
                    <div class="icon">
                        <img src="{{ asset('public') }}/web/images/partner-card-2.png" alt="icon" class="img-fluid">
                    </div>
                    <div class="desc">
                        <p class="heading">Flexible Work Terms</p>
                        <p>Take advantage of Petspace’s free marketing and customer support while focusing on what you do best
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="partner-2-card">
                    <div class="icon">
                        <img src="{{ asset('public') }}/web/images/partner-card-3.png" alt="icon" class="img-fluid">
                    </div>
                    <div class="desc">
                        <p class="heading">Easy Bookings</p>
                        <p>Our booking management system allows you to facilitate your operations and manage your groomers’ order assignments
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="#becomepartnersection" class="gen-brown-btn">Grow Now</a>
        </div>
    </div>
</section>

<section class="partner-sec-3">
    <div class="container">
        <p class="sec-title">Amplify your business</p>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 mb-5">
                <div class="partner-3-card">
                    <div class="img">
                        <img src="{{ asset('public') }}/web/images/partner-3-1.png" alt="icon" class="img-fluid">
                    </div>
                    <div class="desc">
                        <p class="heading">Recieve & Assign Orders</p>
                        <p>Don’t waste anymore time on the phone! Your confirmed orders are received directly to your platform. Just view them and assign a groomer
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-5">
                <div class="partner-3-card">
                    <div class="img">
                        <img src="{{ asset('public') }}/web/images/partner-3-2.png" alt="icon" class="img-fluid">
                    </div>
                    <div class="desc">
                        <p class="heading">Manage Orders & Groomers</p>
                        <p>Our technician platform allows your orders to be sent directly to your groomer’s through their special platform
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-5">
                <div class="partner-3-card">
                    <div class="img">
                        <img src="{{ asset('public') }}/web/images/partner-3-3.png" alt="icon" class="img-fluid">
                    </div>
                    <div class="desc">
                        <p class="heading">Monthly Sales Report</p>
                        <p>Receive a monthly report from Petspace to understand your strengths and optimize your business
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-5">
                <div class="partner-3-card">
                    <div class="img">
                        <img src="{{ asset('public') }}/web/images/partner-3-4.png" alt="icon" class="img-fluid">
                    </div>
                    <div class="desc">
                        <p class="heading">Secure Payments</p>
                        <p>Our smart online payment solution allows your business to secure payments at the time of service
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="#becomepartnersection" class="gen-green-btn">Grow your business</a>
        </div>
    </div>
    <div class="abs-img abs-1">
        <img src="{{ asset('public') }}/web/images/partner-3-lines-1.png" alt="" class="img-fluid">
    </div>
    <div class="abs-img abs-2">
        <img src="{{ asset('public') }}/web/images/partner-3-lines-2.png" alt="" class="img-fluid">
    </div>
</section>

<section class="partner-sec-4">
    <div class="container">
        <div class="gen-sec-top mx-490 mb-5">
            <p class="heading">How it works</p>
            <p>As easy as 1 2 3!</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-4 col-sm-12 mb-4">
                <div class="partner-4-card">
                    <p class="heading"><img src="{{ asset('public') }}/web/images/number-1.png" alt="img" class="img-fluid"><span>Sign
                            Up</span></p>
                    <p>Contact Petspace to sign up 100% free! </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12 mb-4">
                <div class="partner-4-card">
                    <p class="heading"><img src="{{ asset('public') }}/web/images/number-2.png" alt="img" class="img-fluid"><span>Set-up Shop</span></p>
                    <p>Set-up your shop details  to start receiving orders</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12 mb-4">
                <div class="partner-4-card">
                    <p class="heading"><img src="{{ asset('public') }}/web/images/number-3.png" alt="img" class="img-fluid"><span>Receive Orders</span>
                    </p>
                    <p>Assign a groomer and view live order statuses</p>
                </div>
            </div>
        </div>
    </div>
    <div class="abs-img">
        <img src="{{ asset('public') }}/web/images/partner-4-abs.png" alt="img" class="img-fluid">
    </div>
</section>

<section class="partner-sec-5" id="becomepartnersection">
    <div class="container">
        <p class="sec-title">Become a Pet Partner</p>
        <p class="sec-sub-text">Grow your business today!</p>
        <form method="POST" class="becomeapasrter" action="/sendmail2">
        @csrf
            
           
            <div class="form-success">
            <p class="message_success">
               
            </p>    
            </div>
           
            <div class="form-group">
                <input type="text" name="name" placeholder="Name">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <input type="text" name="business_name" placeholder="Business Name">
                @if ($errors->has('business_name'))
                    <span class="text-danger">{{ $errors->first('business_name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <input type="number" name="mobile_number" maxlength="10" placeholder="Mobile Number">
                @if ($errors->has('mobile_number'))
                    <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                @endif
            </div>
            <div class="form-group">
                <input type="text" name="email" placeholder="Email Address">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group">
                <textarea name="business" placeholder="Describe your business"></textarea>
            </div>
            <div class="form-group">
                @if(config('services.recaptcha.key'))
                    <div class="g-recaptcha"
                        data-sitekey="{{config('services.recaptcha.key')}}">
                    </div>
                @endif
            </div>
            <div class="form-group text-center mb-0">
                <button class="gen-green-btn">Submit</button>
            </div>
        </form>
    </div>
    <div class="abs-img abs-1">
        <img src="{{ asset('public') }}/web/images/partner-5-lines-1.png" alt="" class="img-fluid">
    </div>
    <div class="abs-img abs-2">
        <img src="{{ asset('public') }}/web/images/partner-5-lines-2.png" alt="" class="img-fluid">
    </div>
</section>

<section class="partner-sec-6">
    <div class="container text-center">
        <p class="sec-title">Questions? Contact us</p>
        <p class="sec-sub-text">Our team is here to escort your business into the future</p>
        <a href="contact" class="gen-brown-btn m-auto">Contact Us</a>
    </div>
    <div class="abs-img">
        <img src="{{ asset('public') }}/web/images/partner-6-abs.png" alt="img" class="img-fluid">
    </div>
</section>


@endsection

@section('javascript')
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endsection