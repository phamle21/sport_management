<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>404 | {{ __('message.title') }} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- site favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    <!-- Place favicon.ico in the root directory -->

    <!-- All stylesheet and icons css  -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">

</head>

<body>


    <!-- ===========404 Section start Here========== -->
    <section class="fore-zero" style="height: 100vh; background: #232a5c;">
        <div class="section-wrapper">
            <div class="zero-item" style="padding: 0!important">
                <div class="zero-thumb">
                    <img src="{{ asset('assets/images/404.png') }}" alt="404">
                </div>
                <div class="zero-content">
                    <h2>{{__('message.404.head')}}</h2>
                    <p>{{__('message.404.head-sub')}} <i class="icofont-worried"></i>
                    </p>
                    <a href="/" class="default-button reverse-effect"><span>{{__('message.404.btn-gohome')}} <i
                                class="icofont-double-right"></i></span> </a>
                </div>
            </div>
        </div>
    </section>
    <!-- ===========404 Section Ends Here========== -->

    <!-- All Needed JS -->
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>
    <script src="{{ asset('assets/js/circularProgressBar.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/js/lightcase.js') }}"></script>
    <script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>



</body>

</html>
