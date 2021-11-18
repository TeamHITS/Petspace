<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Welcome To PetSpace</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ url('public/assets/images/favicon.ico')}}" type="image/x-icon" media="all">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="title" content="PetSpace">
        <meta name="description" content="PetSpace">
        <meta name="keywords" content="PetSpace">
        <meta name="author" content="PetSpace">
    <link rel="stylesheet" href="{{ url('public/assets/css/bootstrap.min.css') }}"/>
        <link rel="stylesheet" href="{{ url('public/assets/css/normalize.css')}}">
        <link rel="stylesheet" href="{{ url('public/assets/css/home-style.css')}}">
</head>
<body>

        <!-- Navbar -->
        <nav class="custom-navbar">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <a class="navbar-brand" href="index.html">
                            <img src="{{ url('public/assets/images/logo.png')}}" class="img-fluid" alt="img" />
                        </a>
                    </div>
                    <div class="col align-self-center">
                        <ul class="socialIcons">
                            <li><a href="https://www.instagram.com/petspace_app/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="https://www.facebook.com/petspaceme/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <!-- <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li> -->
                        </ul>  
                    </div>
                </div>
            </div>
        </nav>

        <main>

            <!-- Home Section Starts -->
            <section class="homeSection">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-12 align-self-center">
                            <div class="section1box section1Left">
                                <h1>PET GROOMING <span>MADE EASY</span></h1>
                                <div class="section1innerbox">
                                    <p class="beforeSubmit">Your pet’s preferred app is just one click away 🐾</p>
                                    <p class="beforeSubmit">Join early and get 20% off your first order! 🎉</p>
                                    <p class="afterSubmit">Thank you! We will notify you when we launch. And btw are we insta buddies?  Follow <a href="https://www.instagram.com/petspace_app/" target="_blank" style="width: auto;">@petspace_app</a> for pawsome content 😻 </p>
                                    <form action="/" method="post" name="mc-embedded-subscribe-form">
                                        <div class="subscribe-form">
                                             @csrf
                                          <input type="email" value="" id="email" name="EMAIL" placeholder="Your email address" class="email" required />
                                          <input type="submit" name="subscribe" value="Notify meow" />
                                        </div>
                                    </form>
                                    <h5>Coming Soon ⌛️</h5>
                                    <a href="https://play.google.com/store/apps" target="_blank">
                                        <img src="{{ url('public/assets/images/google-play-icon.png')}}" class="img-fluid" alt="img" />
                                    </a>
                                    <a href="https://www.apple.com/app-store/" target="_blank">
                                        <img src="{{ url('public/assets/images/apple-icon.png')}}" class="img-fluid" alt="img" />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 align-self-center">
                            <div class="section1box section1right">
                                <a href="https://www.instagram.com/petspace_app/" target="_blank"><img src="{{ url('public/assets/images/home-img.png')}}" class="dog img-fluid" alt="img" /></a>
                                 <a href="https://www.facebook.com/petspaceme/" target="_blank"><img src="{{ url('public/assets/images/phone.png')}}" class="phone img-fluid" alt="img" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Home Section Ends -->

        </main>

        <!-- JavaSrcipts -->
        <script src="{{ url('public/assets/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ url('public/assets/js/bootstrap.min.js') }}"></script>
        <script>
            $(document).ready(function () {
              $(".afterSubmit").hide();
              $("form").submit(function (event) {
                $(".beforeSubmit, form").hide();
                $(".afterSubmit").show();
                var formData = {
                   email: $("#email").val()
                };
                $.ajax({
                  type: "POST",
                  url: "https://app.us17.list-manage.com/subscribe/post?u=51f28a9b7d9e5d968dda0b018&amp;id=ffa6c61ba0",
                  data: formData,
                  dataType: "json",
                  encode: true,
                }).done(function (data) {
                  console.log(data);
                  alert("Thank you")
                });

                event.preventDefault();
              });
            });
        </script>
</body>
</html>
