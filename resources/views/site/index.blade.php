@extends('layouts.master')

@section("css")
<style>
    .index-sec-2 {
        padding-bottom: 90px !important;
    }
</style>
@endsection

@section('content')
<section class="index-sec-1">
    <div class="container">
        <div class="index-banner-text">
            <p class="heading">PET GROOMING MADE EASY</p>
            <div class="get-app-box">
                <p>Get the App <img src="{{ asset('public') }}/web/images/dog-cat.png" alt="icon" class="img-fluid"></p>
                <div class="store-img">
                    <a href="#!"><img src="{{ asset('public') }}/web/images/google-btn.png" class="img-fluid" alt="icon"></a>
                    <a href="#!"><img src="{{ asset('public') }}/web/images/apple-btn.png" class="img-fluid" alt="icon"></a>
                </div>
            </div>
            <div class="index-banner-phone text-center">
                <img src="{{ asset('public') }}/web/images/index-banner-img.png" alt="img" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="abs-img abs-1">
        <img src="{{ asset('public') }}/web/images/index-banner-abs-1.png" alt="abs-img">
    </div>
    <div class="abs-img abs-2">
        <img src="{{ asset('public') }}/web/images/index-banner-abs-2.png" alt="abs-img">
    </div>
    <div class="abs-img abs-3">
        <img src="{{ asset('public') }}/web/images/index-banner-lines-1.png" alt="abs-img">
    </div>
    <div class="abs-img abs-4">
        <img src="{{ asset('public') }}/web/images/index-banner-lines-2.png" alt="abs-img">
    </div>
    <div class="abs-img abs-5">
        <img src="{{ asset('public') }}/web/images/index-banner-lines-3.png" alt="abs-img">
    </div>
    <div class="abs-img abs-6">
        <img src="{{ asset('public') }}/web/images/index-banner-lines-4.png" alt="abs-img">
    </div>
</section>

<section class="index-sec-2">
    <div class="container">
        <form method="post" id="sendToMail1">
            @csrf
            <p>Subscribe to our pawsletter to fetch the best offers! 🐾  </p>
            <div class="form-group subscriptionform">
                <input type="email" name="email" placeholder="Your email address" required>
                <button type="submit" class="submit">Notify Me</button>
                <div class="spinner-border mx-3 none" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="form-success none">
                <p>Thank you for subscribing 😄<span><img src="{{ asset('public') }}/web/images/smiley-icon.png" alt="icon"
                            class="img-fluid"></span></p>
            </div>
        </form>
    </div>
</section>

<section class="index-sec-3" id="how-it-works">
    <div class="container">
        <div class="gen-sec-top mx-490 pb-3">
            <p class="heading">How it works</p>
            <p>Compare top rated mobile groomers and book your pet’s preferred groomer. <strong>Anytime. Anywhere.</strong></p>
        </div>
        @forelse ($how_it_works as $key => $how_it_work)
        @if (($key+1)%2)
        <div class="row img-text-row img-text-row-{{($key+1)}} pb-5">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 img-col">
                <div class="img-box text-end">
                    <img src="{{'/public/'.$how_it_work->path.'/'.$how_it_work->file_name}}" alt="img" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-col">
                <div class="text-box">
                    <p class="heading">{{$how_it_work->title}}</p>
                    <p>{{$how_it_work->desc}}</p>
                </div>
            </div>
        </div>
        @else
        <div class="row img-text-row img-text-row-{{($key+1)}}">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-col">
                <div class="text-box">
                    <p class="heading">{{$how_it_work->title}}</p>
                    <p>{{$how_it_work->desc}}</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 img-col">
                <div class="img-box text-end">
                    <img src="{{'/public/'.$how_it_work->path.'/'.$how_it_work->file_name}}" alt="img" class="img-fluid">
                </div>
            </div>
        </div>
        @endif
        @empty
        <div class="row img-text-row img-text-row-3">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 img-col">
                <div class="img-box">
                    <img src="{{ asset('public') }}/web/images/index-3-3.png" alt="img" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-col">
                <div class="text-box">
                    <p class="heading">Select time slots that suits you the best</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mattis et sed nam sem tellus erat.</p>
                </div>
            </div>
        </div>
        <div class="row img-text-row img-text-row-4">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-col">
                <div class="text-box">
                    <p class="heading">Select as many services you like</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mattis et sed nam sem tellus erat.</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 img-col">
                <div class="img-box text-end">
                    <img src="{{ asset('public') }}/web/images/index-3-4.png" alt="img" class="img-fluid">
                </div>
            </div>
        </div>
        @endforelse
    </div>
</section>

<section class="index-sec-4">
    <div class="container">
        <div class="gen-sec-top mx-490">
            <p class="heading">Your pet's preferred app is one click away!</p>
            <p>👇</p>
        </div>
        <div class="get-app-box mt-4">
            <p>Get the App <img src="{{ asset('public') }}/web/images/dog-cat.png" alt="icon" class="img-fluid"></p>
            <div class="store-img">
                <a href="#!"><img src="{{ asset('public') }}/web/images/google-btn.png" class="img-fluid" alt="icon"></a>
                <a href="#!"><img src="{{ asset('public') }}/web/images/apple-btn.png" class="img-fluid" alt="icon"></a>
            </div>
        </div>
    </div>
</section>

<section class="index-sec-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 col-sm-12">
                <div class="index-5-text">
                    <p class="heading">Groom your business with us!</p>
                    <ul>
                        <li>Expand Revenue Streams</li>
                        <li>Strengthen Customer Relationship</li>
                        <li>Exploit Latest Technologies</li>
                    </ul>
                    <a href="become-partner" class="green-btn mt-4">Grow Now</a>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-abs">
        <img src="{{ asset('public') }}/web/images/index-5-abs.png" alt="img" class="img-fluid">
    </div>
    <div class="abs-img abs-1">
        <img src="{{ asset('public') }}/web/images/index-5-lines-1.png" alt="icon" class="img-fluid">
    </div>
    <div class="abs-img abs-2">
        <img src="{{ asset('public') }}/web/images/index-5-lines-2.png" alt="icon" class="img-fluid">
    </div>
</section>

<section class="index-sec-6">
    <div class="container">
        <div class="gen-sec-top mx-490 mb-3">
            <p class="heading">Happy Pet Parents</p>
            <p>We have been working with pet parents and their furbabies across the UAE</p>
        </div>
        <div class="client-slider-wrap">
            <div class="swiper-container client-slider">
                <div class="swiper-wrapper">
                    @forelse ($testimonials as $testimonial)
                    <div class="swiper-slide">
                        <div class="client-card">
                            <div class="text-box">
                                <p class="heading">{{ $testimonial->title }}</p>
                                <p>{{ $testimonial->desc }}</p>
                            </div>
                            <div class="img-box">
                                <img src="{{ 'public/'.$testimonial->path.'/'.$testimonial->file_name }}" alt="client-image">
                                <p>{{ $testimonial->name }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="swiper-slide">
                        <div class="client-card">
                            <div class="text-box">
                                <p class="heading">Great Offers</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Auctor neque sed imperdiet
                                    nibh lectus feugiat nunc sem.</p>
                            </div>
                            <div class="img-box">
                                <img src="{{ asset('public') }}/web/images/client-img.png" alt="client-image">
                                <p>Jane Cooper</p>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>

<section class="index-sec-7">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-12 col-sm-12 index-7-text-col">
                <div class="index-7-text">
                    <p class="heading">Subscribe to our Pawsletter</p>
                    <p>Subscribe today to stay updated and fetch the best offers! 🐾  </p>
                </div>
                <form method="post" id="sendToMail2">
                    @csrf
                    <!--<p>Get notified with new offers and discounts </p>-->
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Your email address" required>
                        <button type="submit" class="submit">Subscribe</button>
                        <div class="spinner-border mx-3 none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="form-success none">
                        <p>Thank you for subscribing  <span><img src="{{ asset('public') }}/web/images/smiley-icon.png" alt="icon"
                                    class="img-fluid"></span></p>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 text-center">
                <div class="img-box">
                    <img src="{{ asset('public') }}/web/images/index-7-img.png" class="img-fluid" alt="img">
                </div>
            </div>
        </div>
    </div>
    <div class="abs-img abs-1">
        <img src="{{ asset('public') }}/web/images/index-7-lines-1.png" alt="" class="img-fluid">
    </div>
    <div class="abs-img abs-2">
        <img src="{{ asset('public') }}/web/images/index-7-lines-2.png" alt="" class="img-fluid">
    </div>
</section>

<section class="index-sec-8" id="faq-sec">
    <div class="container">
        <p class="sec-title">FAQs</p>
        <div class="faq-wrap">
            <div class="accordion" id="accordionExample">
                @forelse ($faqs as $key => $faq)
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq-{{$key}}" aria-expanded="false" aria-controls="faq-{{$key}}">
                            {{ $faq->title ?? '' }}
                        </button>
                    </div>
                    <div id="faq-{{$key}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>{{ $faq->desc }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq-2" aria-expanded="false" aria-controls="faq-2">
                            Lorem ipsum dolor sit amet, consectetur ?
                        </button>
                    </div>
                    <div id="faq-2" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. At officia nemo quis iure
                                blanditiis pariatur, quasi consequatur. Eveniet sed, incidunt alias voluptates quod
                                corporis necessitatibus quo, ipsum, laudantium asperiores non. Lorem ipsum, dolor sit
                                amet consectetur adipisicing elit. At officia nemo quis iure blanditiis pariatur, quasi
                                consequatur. Eveniet sed, incidunt alias voluptates quod corporis necessitatibus quo,
                                ipsum, laudantium asperiores non.</p>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
@endsection
