@extends('layouts.master')

@section('content')
<section class="about-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 col-sm-12">
                <div class="inner-banner-text">
                    <p class="heading">Meet Petspace</p>
                    <p>Petspace is here to lead the pet care industry into the future!</p>

<p >Food, transportation, travel, and shopping are industries that have all been transformed through the use of technology. Through the use of smart tech, we aim to revolutionize the traditional way of pet caring.
Our mobile app was created to serve pet parents and their furbabies in the UAE by allowing you to browse, compare, and book services to your home based on your pet’s preferences.</p>

<p class="mb-0">Our secure and easy-to-use platforms are designed specifically for the comfort and convenience of pet parents and service providers, our pet partners.</p>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="abs-img abs-1">
        <img src="{{ asset('public') }}/web/images/about-banner-abs.png" alt="abs-img">
    </div>
    <div class="abs-img abs-2">
        <img src="{{ asset('public') }}/web/images/about-banner-abs-1.png" alt="abs-img">
    </div>
    <div class="abs-img abs-3">
        <img src="{{ asset('public') }}/web/images/about-banner-abs-2.png" alt="abs-img">
    </div>
    <div class="abs-img abs-4">
        <img src="{{ asset('public') }}/web/images/about-banner-lines-1.png" alt="abs-img">
    </div>
    <div class="abs-img abs-5">
        <img src="{{ asset('public') }}/web/images/about-banner-lines-2.png" alt="abs-img">
    </div>
    <div class="abs-img abs-6">
        <img src="{{ asset('public') }}/web/images/about-banner-lines-3.png" alt="abs-img">
    </div>
</section>

<section class="about-sec-2">
    <div class="container">
        <div class="about-2-wrap">
            <div class="about-2-text">
                <p class="heading">Who we are</p>
                <p>As pet owners born and bred in the United Arab Emirates, the Petspace founders understand the struggles associated with the pet care industry in the region. </p>

<p>We believe that pet parents should not stress about providing the best care for their pets. Less time spent organizing and transporting pets to their appointments means more time spent loving and bonding with your furry family members.</p>

<p>We also believe that a successful marketplace includes taking care of our pet partners by prioritizing their challenges in the pet care industry and solving them.</p>
                
            </div>

            <div class="about-2-img text-center">
                <img src="{{ asset('public') }}/web/images/about-2-img-1.png" alt="img" class="img-fluid">
            </div>

            <div class="about-2-text">
                <p class="heading">Our Commitment</p>
               <p> Our team is dedicated to saving pets the stress and fear of moving away from their comfort, and allowing pet owners to safely and reliably book their favorite pet services anytime, anywhere. </p>

<p>Our mission is to make the lives of pet owners easier, and pets healthier and happier.</p>

<p>Our vision is to revolutionize the pet care industry and lead it into the digital era.</p>
               
            </div>

            <div class="about-2-img text-center">
                <img src="{{ asset('public') }}/web/images/about-2-img-2.png" alt="img" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<section class="about-sec-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="about-3-text">
                    <p class="heading">Subscribe to our Pawsletter</p>
                    <p>Subscribe today to stay updated and fetch the best offers! 🐾  </p>
                    <form method="post" id="sendToMail1" class="subscribe-form">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Your email address" required>
                            <button type="submit" class="submit">Subscribe</button>
                            <div class="spinner-border mx-3 none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="form-success none">
                            <p>Thank you for subscribing 😄 </p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="about-3-img">
                    <img src="{{ asset('public') }}/web/images/about-3-img.png" alt="img" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <div class="abs-img abs-1">
        <img src="{{ asset('public') }}/web/images/about-3-lines-1.png" alt="abs-img">
    </div>
    <div class="abs-img abs-2">
        <img src="{{ asset('public') }}/web/images/about-3-lines-2.png" alt="abs-img">
    </div>
</section>

<section class="about-sec-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="about-4-text">
                    <p class="heading">Try Petspace for free today!</p>
                    <p>What are you waiting for? 👇</p>
                    <div class="get-app-box ms-0 mt-4">
                        <p class="text-start">Get the App <img src="{{ asset('public') }}/web/images/dog-cat.png" alt="icon"
                                class="img-fluid"></p>
                        <div class="store-img justify-content-start">
                            <a href="#!" class="ms-0"><img src="{{ asset('public') }}/web/images/google-btn.png" class="img-fluid"
                                    alt="icon"></a>
                            <a href="#!"><img src="{{ asset('public') }}/web/images/apple-btn.png" class="img-fluid" alt="icon"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="about-4-img text-end">
                    <img src="{{ asset('public') }}/web/images/about-4-img.png" alt="img" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <div class="abs-img abs-1">
        <img src="{{ asset('public') }}/web/images/about-4-lines-1.png" alt="abs-img">
    </div>
    <div class="abs-img abs-2">
        <img src="{{ asset('public') }}/web/images/about-4-lines-2.png" alt="abs-img">
    </div>
</section>
@endsection
