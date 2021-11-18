@extends('layouts.master')

@section('content')

<section class="privacy-banner">
    <div class="container text-center">
        <p class="heading">Privacy Policy</p>
    </div>
    <div class="abs-img abs-1">
        <img src="{{ asset('public') }}/web/images/privacy-banner-abs-1.png" alt="abs-img">
    </div>
    <div class="abs-img abs-2">
        <img src="{{ asset('public') }}/web/images/privacy-banner-abs-2.png" alt="abs-img">
    </div>
    <div class="abs-img abs-3">
        <img src="{{ asset('public') }}/web/images/privacy-banner-lines-1.png" alt="abs-img">
    </div>
</section>

<section class="privacy-sec-2">
    <div class="container">
        {!! $templates->html ?? '' !!}
    </div>
</section>

@endsection
