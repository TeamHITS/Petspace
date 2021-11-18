<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{ asset('public/web/images/favicon.png') }}" sizes="32x32" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="{{ asset('public/web/css/bootstrap.min.css') }}" />
    <!-- <link rel="stylesheet" href="{{ URL::to('/') }}/web/css/stellarnav.min.css" /> -->
    <link rel="stylesheet" href="{{ asset('public/web/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('public/web/css/swiper-bundle.min.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/web/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/web/css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/web/css/parsley.css') }}" />
    <style type="text/css">
    	.cookies-popup-wrap
    	{
    		display : none;
    	}
    </style>

    @yield('css')

</head>

<body>
    <header>
        <div class="container">
            <div class="header-row">
                <div class="navigation-wrap">
                    <div id="main-nav" class="stellarnav custom-nav">
                        <ul>
                            <li><a href="{{ (Request::segment(1) == '' || Request::segment(1) == '/') ? '' : '/home-web' }}#how-it-works"
                                    class="active">How it works</a></li>
                            <li><a href="become-partner">Pet partners</a></li>
                            <li><a href="about">About Us</a></li>
                            <li><a href="contact">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="logo-box">
                    <a href="/"><img src="{{ asset('public/web/images/logo.png') }}" class="img-fluid"
                            alt="{{ config('app.name', 'Laravel') }}"></a>
                </div>
                <div class="header-socials">
                    <ul class="social-list">
                        <li><a href="#!"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#!"><i class="fab fa-facebook-f"></i></a></li>
                    </ul>
                </div>
                <a class="nav-btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                    aria-controls="offcanvasExample"><span></span></a>
            </div>
        </div>
        <!-- RESPONSIVE NAVIGATION -->
    </header>
    <!-- MOBILE NAVIGATION -->
    <div class="offcanvas offcanvas-start mobile-nav" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="offcanvas-body-inner">
                <ul class="nav-list">
                    <li><a
                            href="{{ (Request::segment(1) == '' || Request::segment(1) == '/home-web') ? '/home-web' : 'home-web' }}#how-it-works">How
                            it works</a></li>
                    <li><a href="{{ (Request::segment(1) == '' || Request::segment(1) == '/') ? '' : '/' }}become-partner">Partners</a></li>
                    <li><a href="{{ (Request::segment(1) == '' || Request::segment(1) == '/') ? '' : '/' }}about">About Us</a></li>
                    <li><a href="{{ (Request::segment(1) == '' || Request::segment(1) == '/') ? '' : '/' }}contact">Contact Us</a></li>
                </ul>
                <div class="get-app-box">
                    <div class="store-img">
                        <a href="#!"><img src="{{ asset('public/web/images/google-btn.png') }}" class="img-fluid" alt="icon"></a>
                        <a href="#!"><img src="{{ asset('public/web/images/apple-btn.png') }}" class="img-fluid" alt="icon"></a>
                    </div>
                </div>
                <ul class="social-list">
                    <li><a href="https://instagram.com/petspace_app?utm_medium=copy_link"  target="_blank"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="https://www.facebook.com/petspaceme/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    @yield('content')
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-xxl-7 col-lg-6 col-md-12">
                    <div class="footer-group-1">
                        <div class="footer-logo">
                            <a href="#!"><img src="{{ asset('public/web/images/footer-logo.png') }}" alt="logo" class="img-fluid"></a>
                        </div>
                        <ul class="footer-nav">
                            <li><a
                                    href="{{ (Request::segment(1) == '' || Request::segment(1) == '/home-web') ? '' : '/home-web' }}#how-it-works">How
                                    it Works</a></li>
                            <li><a href="become-partner">Pet partners</a></li>
                        </ul>
                        <ul class="footer-nav">
                            <li><a href="about">About Us</a></li>
                            <li><a href="contact">Contact Us</a></li>
                            <li><a href="terms">Terms & Conditions</a></li>
                            <li><a
                                    href="{{ (Request::segment(1) == '' || Request::segment(1) == '/home-web') ? '' : '/home-web' }}#faq-sec">FAQ</a>
                            </li>
                            <li><a href="privacy-policy">Privacy Policy</a></li>
                        </ul>
                        <div class="payment-box">
                            <p>Supported Payment Systems</p>
                            <ul>
                                <li><a href="#!"><img src="{{ asset('public/web/images/visa-icon.png') }}" alt="icon" class="img-fluid"></a>
                                </li>
                                <li><a href="#!"><img src="{{ asset('public/web/images/master-card-icon.png') }}" alt="icon"
                                            class="img-fluid"></a></li>
                                <li><a href="#!"><img src="{{ asset('public/web/images/apple-pay-icon.png') }}" alt="icon"
                                            class="img-fluid"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-12">
                    <div class="footer-group-2">
                        <p class="group-title">Get the App</p>
                        <div class="mb-3">
                            <a href="#!">
                                <img src="{{ asset('public/web/images/apple-btn.png') }}" alt="icon" class="img-fluid">
                            </a>
                        </div>
                        <div class="mb-3">
                            <a href="#!">
                                <img src="{{ asset('public/web/images/google-btn.png') }}" alt="icon" class="img-fluid">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-2 col-lg-3 col-md-6 col-sm-12">
                    <div class="footer-group-3">
                        <p class="group-title">Reach us</p>
                        <ul class="info-list">
                            <li>
                                <div class="img">
                                    <img src="{{ asset('public/web/images/email-icon.png') }}" alt="icon" class="img-fluid">
                                </div>
                                <p>Woof@petspace.com</p>
                            </li>
                            <li>
                                <div class="img">
                                    <img src="{{ asset('public/web/images/mobile-icon.png') }}" alt="icon" class="img-fluid">
                                </div>
                                <p>+971 999909990</p>
                            </li>
                            <li>
                                <div class="img">
                                    <img src="{{ asset('public/web/images/location-icon.png') }}" alt="icon" class="img-fluid">
                                </div>
                                <p>Technohub 1, <br>DTEC, Dubai Silicon Oasis,<br> Dubai , UAE</p>
                            </li>
                        </ul>
                        <ul class="footer-social">
                            <li><a href="https://instagram.com/petspace_app?utm_medium=copy_link" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="https://www.facebook.com/petspaceme/" target="_blank"><i class="fab fa-facebook"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <p class="copyright">© 2021 Petspace. All rights reserved</p>
                </div>
            </div>
        </div>
    </footer>
    <div class="cookies-popup-wrap">
        <div class="cookies-wrap">
            <div class="img">
                <img src="{{ asset('public/web/images/cookie.png') }}" alt="icon" class="img-fluid">
            </div>
            <div class="desc">
                <p class="heading">We use cookies as part of our services.</p>
                <p>To find out more about the cookies we use, <a href="#!">please click here</a>. By using our website
                    you agree to the use of cookies.</p>
            </div>
            <div class="btns">
                <a href="#!" class="agree">Agree</a>
                <a href="#!" class="disagree">Disagree</a>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/web/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/web/js/jquery-3.5.1.min.js') }}"></script>
    <!-- <script src="{{ URL::to('/') }}/web/js/stellarnav.min.js"></script> -->
    <script src="{{ asset('public/web/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('public/web/js/parsley.min.js') }}"></script>
    <script src="{{ asset('public/web/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('public/web/js/additional-methods.js') }}"></script>
    <script src="{{ asset('public/web/js/custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/web/js/jquery.cookie.min.js') }}"></script>
    <script>
        $(".agree, .disagree").click(function () {
            $(".cookies-popup-wrap").hide();
            // check cookie
	        var visited = $.cookie("visited")


	        // set cookie
	        $.cookie('visited', 'yes', { expires: 1, path: '/' });
           
        });
 		$(document).ready(function(){
 			 var visited = $.cookie("visited");
 			 console.log(visited);
 			 if(visited == null)
 			 {
 			 	$(".cookies-popup-wrap").css('display','flex');
 			 }
 		})

    </script>

    @yield('javascript')

</body>

</html>
