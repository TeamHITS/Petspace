<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo getenv('APP_NAME');?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{ url('/public/assets/images/favicon.png') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="{{ url('/public/assets/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('/public/assets/css/stellarnav.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('/public/assets/css/font-awesome.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/public/assets/css/style.css') }}"/>
    <link rel="stylesheet" href="{{ url('/public/assets/css/responsive.css') }}"/>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ url('/public/assets/css/daterangepicker.css') }}" />

    <!-- SWIPER SLIDER -->
    <link rel="stylesheet" href="{{ url('/public/assets/css/swiper-bundle.min.css') }}" />

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    @stack('css')
</head>

<body>

@yield('content')

<!-- SWIPER SLIDER -->
<script src="{{ url('/public/assets/js/swiper-bundle.min.js') }}"></script>

<script src="{{ url('/public/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ url('/public/assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ url('/public/assets/js/stellarnav.min.js') }}"></script>
<script src="{{ url('/public/assets/js/custom.js') }}"></script>
<script src="{{ asset('public/js/website/custom.js') }}"></script>


{{--<script--}}
        {{--src="https://maps.googleapis.com/maps/api/js?key={{config('constants.google.maps.api_key')}}&callback=initAutocomplete&libraries=places&v=weekly"--}}
        {{--async--}}
{{--></script>--}}

<!-- DATATABLE LIBRARY -->
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<!-- DATE RANGE LIBRARIES -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
<script src="{{ url('/public/assets/js/daterangepicker.js') }}"></script>

@stack('scripts')
<!-- Optional JavaScript -->
<script>
    // Initialize tooltip component
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();


        /* ajax post form submit */
        $('body #submit-form').submit(function (e) {
            e.preventDefault();
            $('.setup-submit-btn').prop('disabled', true);


            var that = $(this);
            var url = $(this).attr('action');
            var method = $(this).attr('method');
            var form_data = new FormData($(this)[0]);
            if (method == "POST") {

                if($('#response-alert').length) {
                    $('#response-alert').css('display', 'none');
                }
                ajaxPost(url, form_data, (status, data) => {
                    if (status) {

                        if($('#response-alert').length) {
                            $('#response-alert').css('display', 'block');
                            $('#response-alert').addClass('success-notification');
                            $('#response-alert').removeClass('error-notification');
                            $('#response-alert').html(data.message);
                            //$('#response-alert').removeClass('d-none');

                            $('html,body').animate({
                                scrollTop: $("#response-alert").offset().top - 500
                            }, 'slow');
                        }

                        if (data.data.hasOwnProperty('url')) {
                            setTimeout(function () {
                                window.location.href = "{{URL::to('/')}}/" + data.data.url;
                            }, 2000);
                        }

                    } else {

                        $('#response-alert').addClass('error-notification');
                        $('#response-alert').removeClass('success-notification');
                        $('#response-alert').css('display', 'block');
                        var err = [];

                        // $('#response-alert').html(data.responseJSON.message);
                        if (data.status == 422) {

                            if($('#response-alert').length){
                                $('#response-alert').html("");
                            }
                            if (!$.isArray(data.responseJSON.errors)) {
                                $.each(data.responseJSON.errors, function (key, value) {
                                    err.push(value[0]);
                                });

                                $.each(err, function (key, value) {
                                    $('#response-alert').append(value + "<br />");
                                });

                            } else if ($.isArray(data.responseJSON.errors)) {

                                $.each(data.responseJSON.errors, function (key, value) {
                                    err.push(value.message);
                                });

                                $.each(err, function (key, value) {
                                    $('#response-alert').append(value + "<br />");
                                });
                            }


                            // $('#response-alert').html(data.responseJSON.message);
                        } else {
                            $('#response-alert').html(data.responseJSON.message);
                        }


                        $('html,body').animate({
                            scrollTop: $("#response-alert").offset().top - 500
                        }, 'slow');
                        $('.setup-submit-btn').prop('disabled', false);
                    }
                });
            } else if (method == "GET") {
                ajaxGet(url, null, (status, data) => {
                    if (status) {

                    } else {

                    }
                });
            }
        });
        //Home Page end
    });


</script>

</body>
</html>
