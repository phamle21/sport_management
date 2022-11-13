<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ __('message.title') }} </title>
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
    @yield('css')
</head>

<body>
    <!-- preloader start here -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- preloader ending here -->

    <!-- scrollToTop start here -->
    <a href="#" class="scrollToTop"><i class="icofont-rounded-up"></i></a>
    <!-- scrollToTop ending here -->

    <!-- ==========shape image Starts Here========== -->
    <div class="body-shape">
        <img src="{{ asset('assets/images/shape/body-shape.png') }}" alt="shape">
    </div>
    <!-- ==========shape image end Here========== -->

    <!-- ==========Header Section Starts Here========== -->
    @include('client.master.header')
    <!-- ==========Header Section Ends Here========== -->





    <!-- ================ Body Content =============== -->
    @yield('body_content')
    <!-- ================ /Body Content =============== -->





    <!-- ================ footer Section start Here =============== -->
    <footer class="footer-section">
        <div class="footer-top">
            <div class="container">
                <div class="row g-3 justify-content-center g-lg-0">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="footer-top-item lab-item">
                            <div class="lab-inner">
                                <div class="lab-thumb">
                                    <img src="{{ asset('assets/images/footer/icons/01.png') }}" alt="Phone-icon">
                                </div>
                                <div class="lab-content">
                                    <span>Phone Number : +88019 339 702 520</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="footer-top-item lab-item">
                            <div class="lab-inner">
                                <div class="lab-thumb">
                                    <img src="{{ asset('assets/images/footer/icons/02.png') }}" alt="email-icon">
                                </div>
                                <div class="lab-content">
                                    <span>Email : youremail@gmail.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="footer-top-item lab-item">
                            <div class="lab-inner">
                                <div class="lab-thumb">
                                    <img src="{{ asset('assets/images/footer/icons/03.png') }}" alt="location-icon">
                                </div>
                                <div class="lab-content">
                                    <span>Address : 30 North West New York 240</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-middle padding-top padding-bottom"
            style="background-image: url(assets/images/footer/bg.jpg);">
            <div class="container">
                <div class="row padding-lg-top">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="footer-middle-item-wrapper">
                            <div class="footer-middle-item mb-lg-0">
                                <div class="fm-item-title mb-4">
                                    <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo">
                                </div>
                                <div class="fm-item-content">
                                    <p class="mb-4">Upropriate brand economca sound technolog after covalent
                                        technology enable prospective wastng markets whereas propriate and brand
                                        economca sound technolog</p>
                                    <ul class="match-social-list d-flex flex-wrap align-items-center">
                                        <li><a href="#"><img
                                                    src="{{ asset('assets/images/match/social-1.png') }}"
                                                    alt="vimeo"></a></li>
                                        <li><a href="#"><img
                                                    src="{{ asset('assets/images/match/social-2.png') }}"
                                                    alt="youtube"></a></li>
                                        <li><a href="#"><img
                                                    src="{{ asset('assets/images/match/social-3.png') }}"
                                                    alt="twitch"></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="footer-middle-item-wrapper">
                            <div class="footer-middle-item mb-lg-0">
                                <div class="fm-item-title">
                                    <h4>Top jackpot games</h4>
                                </div>
                                <div class="fm-item-content">
                                    <div class="fm-item-widget lab-item">
                                        <div class="lab-inner">
                                            <div class="lab-thumb">
                                                <a href="#"> <img
                                                        src="{{ asset('assets/images/footer/01.jpg') }}"
                                                        alt="footer-widget-img"></a>
                                            </div>
                                            <div class="lab-content">
                                                <h6><a href="blog-single.html">free Poker Game</a></h6>
                                                <p>Poker: <b>$230</b></p>
                                                <div class="rating">
                                                    <i class="icofont-ui-rating"></i>
                                                    <i class="icofont-ui-rating"></i>
                                                    <i class="icofont-ui-rating"></i>
                                                    <i class="icofont-ui-rating"></i>
                                                    <i class="icofont-ui-rating"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fm-item-widget lab-item">
                                        <div class="lab-inner">
                                            <div class="lab-thumb">
                                                <a href="#"><img
                                                        src="{{ asset('assets/images/footer/02.jpg') }}"
                                                        alt="footer-widget-img"></a>
                                            </div>
                                            <div class="lab-content">
                                                <h6><a href="blog-single.html">CLUB Poker Game</a></h6>
                                                <p>Poker: <b>$290</b></p>
                                                <div class="rating">
                                                    <i class="icofont-ui-rating"></i>
                                                    <i class="icofont-ui-rating"></i>
                                                    <i class="icofont-ui-rating"></i>
                                                    <i class="icofont-ui-rating"></i>
                                                    <i class="icofont-ui-rating"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fm-item-widget lab-item">
                                        <div class="lab-inner">
                                            <div class="lab-thumb">
                                                <a href="#"><img
                                                        src="{{ asset('assets/images/footer/03.jpg') }}"
                                                        alt="footer-widget-img"></a>
                                            </div>
                                            <div class="lab-content">
                                                <h6><a href="blog-single.html">ROYAL Poker Game</a></h6>
                                                <p>Poker: <b>$330</b></p>
                                                <div class="rating">
                                                    <i class="icofont-ui-rating"></i>
                                                    <i class="icofont-ui-rating"></i>
                                                    <i class="icofont-ui-rating"></i>
                                                    <i class="icofont-ui-rating"></i>
                                                    <i class="icofont-ui-rating"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="footer-middle-item-wrapper">
                            <div class="footer-middle-item-3 mb-lg-0">
                                <div class="fm-item-title">
                                    <h4>Our Newsletter</h4>
                                </div>
                                <div class="fm-item-content">
                                    <p>Bigamer esports organization supported by community leaders</p>
                                    <form>
                                        <div class="form-group mb-4">
                                            <input type="text" class="form-control" placeholder="Your Name">
                                        </div>
                                        <div class="form-group mb-2">
                                            <input type="email" class="form-control" placeholder="Your Email">
                                        </div>
                                        <button type="submit" class="default-button"><span>Send Massage <i
                                                    class="icofont-circled-right"></i></span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-bottom-content text-center">
                            <p>&copy;2021 <a href="index.html">BiGamer</a> - eSpost And Gameing HTML Template.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ================ footer Section end Here =============== -->

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
    @yield('js')

    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
        window.ga = function() {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('set', 'anonymizeIp', true);
        ga('set', 'transport', 'beacon');
        ga('send', 'pageview');
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async></script>

</body>

</html>
