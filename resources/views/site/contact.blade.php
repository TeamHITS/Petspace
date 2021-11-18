@extends('layouts.master')

@section('content')

<section class="contact-banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="inner-banner-text">
                    <p class="sub-heading">Need help?</p>
                    <p class="heading">Contact us</p>
                    <p class="mb-0">If you've a question about Petspace® in general, or your mindfulness practice in
                        particular, chances are you can find the answer in our <a href="/home-web#faq">FAQs</a> section.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="abs-img abs-1">
        <img src="{{ asset('public') }}/web/images/contact-banner-dog.png" class="img-fluid" alt="abs-img">
    </div>
    <div class="abs-img abs-2">
        <img src="{{ asset('public') }}/web/images/contact-banner-abs-1.png" alt="abs-img">
    </div>
    <div class="abs-img abs-3">
        <img src="{{ asset('public') }}/web/images/contact-banner-abs-2.png" alt="abs-img">
    </div>
    <div class="abs-img abs-4">
        <img src="{{ asset('public') }}/web/images/contact-banner-lines-1.png" alt="abs-img">
    </div>
    <div class="abs-img abs-5">
        <img src="{{ asset('public') }}/web/images/contact-banner-lines-2.png" alt="abs-img">
    </div>
</section>

<section class="contact-sec-2">
    <div class="container">
        <div class="form-wrap">
            <form class="mb-4 becomeapasrter" method="POST" action="/sendmail2">
             @csrf
                <div class="form-group mb-4">
                    <p class="sec-title">Drop your info <span><img src="{{ asset('public') }}/web/images/email-icon.png" alt="icon"
                                class="img-fluid"></span></p>
                </div>
                
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
                    <input type="text" name="mobile_number" placeholder="Mobile Number">
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
                <div class="form-group text-center mt-5 mb-0">
                    <button class="gen-green-btn">Submit</button>
                </div>
            </form>
            <div class="follow-box">
                <p class="heading">Follow us <span><img src="{{ asset('public') }}/web/images/walking-dog-icon.png" alt="icon"
                            class="img-fluid"></span></p>
                <p>Follow us on our Instagram page to get all the latest, exciting promotions and updates.</p>
                <ul class="social-list justify-content-center mt-4">
                    <li><a href="#!"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#!"><i class="fab fa-facebook-f"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="row align-items-center contact-2-row">
            <div class="col-lg-6 col-md-6 col-sm-12 pt-4 pb-4">
                <div class="contact-2-box">
                    <p class="heading">Petspace Office</p>
                    <p>Technohub 1,<br>
DTEC, Dubai Silicon Oasis,<br> 
Dubai ,UAE</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="img-box">
                    <img src="{{ asset('public') }}/web/images/contact-2-img.jpg" alt="img" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('javascript')
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endsection
