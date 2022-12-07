@extends('client.master.template')

@section('body_content')
    <!-- ===========Banner Section start Here========== -->
    <section class="banner-section" id="banner-index" style="background-image: url(assets/images/banner/bg.jpg);">
        <div class="container">
            <div class="">
                <div class="banner-content text-center">
                    <h4 class="fw-normal theme-color mb-4">NƠI CÁC GIẢI ĐẤU BẮT ĐẦU</h4>
                    <img src="https://labartisan.net/demo/bigamer/assets/images/banner/01.png" alt="banner text thumb"
                        class="mb-4">
                    <p>Time : 08:30Pm - 30 December 2021</p>
                    <a href="https://www.youtube.com/embed/g5eQgEuiFC8" class="default-button reverse-effect"
                        data-rel="lightcase"><span>Watch Now <i class="icofont-play-alt-1"></i></span> </a>
                </div>
                <div
                    class="banner-thumb d-flex flex-wrap justify-content-center justify-content-between align-items-center align-items-lg-end">
                    <div class="banner-thumb-img ml-xl-50-none">
                        <a href="team-single.html"><img
                                src="https://labartisan.net/demo/bigamer/assets/images/banner/02.png"
                                alt="banner-thumb"></a>
                    </div>
                    <div class="banner-thumb-vs">
                        <img src="https://png.pngtree.com/png-vector/20220914/ourmid/pngtree-red-blue-vs-glowing-metal-transparent-font-png-image_6174880.png"
                            style="max-width: 250px" alt="banner-thumb">
                    </div>
                    <div class="banner-thumb-img mr-xl-50-none">
                        <a href="team-single.html"><img
                                src="https://labartisan.net/demo/bigamer/assets/images/banner/03.png"
                                alt="banner-thumb"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===========Banner Section Ends Here========== -->

        <!-- ===========About Section start Here========== -->
        <section class="about-section">
            <div class="container">
                <div class="section-wrapper padding-top">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="about-image">
                                <img src="{{ asset('images/system/about.png') }}" alt="about-image">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-10">
                            <div class="about-wrapper">
                                <div class="section-header">
                                    <h2>{{ __('message.about.about-section.section-header') }}</h2>
                                </div>
                                <div class="about-content">
                                    <p>{{ __('message.about.about-section.about-content') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ===========About Section Ends Here========== -->



        <!-- ===========Video Section Start Here========== -->
        <div class="video-section padding-top padding-bottom" style="background-image:url(assets/images/video/bg.jpg)">
            <div class="container">
                <div class="section-header">
                    <h2>{{ __('home.says') }}</h2>
                </div>
                <div class="section-wrapper">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="video-bottom">
                                <div class="testimonial-slider overflow-hidden">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="testimonial-item">
                                                <div class="testimonial-inner">
                                                    <div class="testimonial-head">
                                                        <div class="testi-top">
                                                            <div class="testimonial-thumb">
                                                                <img src="{{ asset('images/system/Pele.jpg') }}" alt="Pele-image">
                                                            </div>
                                                            <div class="name-des">
                                                                <h5>Pelé</h5>
                                                                <p>{{ __('message.about.video-section.name-des-1') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="testimonial-body">
                                                        <p>{{ __('message.about.video-section.testimonial-body-1') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="testimonial-item">
                                                <div class="testimonial-inner">
                                                    <div class="testimonial-head">
                                                        <div class="testi-top">
                                                            <div class="testimonial-thumb">
                                                                <img src="{{ asset('images/system/Carlsen.jpg') }}" alt="Carlsen-image">
                                                            </div>
                                                            <div class="name-des">
                                                                <h5>Magnus Carlsen</h5>
                                                                <p>{{ __('message.about.video-section.name-des-2') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="testimonial-body">
                                                        <p>{{ __('message.about.video-section.testimonial-body-2') }}</p>
                                                    </div>
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="testimonial-item">
                                                <div class="testimonial-inner">
                                                    <div class="testimonial-head">
                                                        <div class="testi-top">
                                                            <div class="testimonial-thumb">
                                                                <img src="{{ asset('images/system/jerry.jpg') }}" alt="jerry-image">
                                                            </div>
                                                            <div class="name-des">
                                                                <h5>Jerry West</h5>
                                                                <p>{{ __('message.about.video-section.name-des-3') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="testimonial-body">
                                                        <p>{{ __('message.about.video-section.testimonial-body-3') }} </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ===========Video Section Ends Here========== -->


    <!-- ===========match schedule Section start Here========== -->
    <section class="match-section padding-top padding-bottom" style="background-image:url(assets/images/match/bg.jpg)">
        <div class="container">
            <div class="section-header">
                <p>Anywhere, Anytime</p>
                <h2>All matches schedule</h2>
            </div>
            <div class="section-wrapper">
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="match-item item-layer">
                            <div class="match-inner">
                                <div class="match-header d-flex flex-wrap justify-content-between align-items-center">
                                    <p class="match-team-info">
                                        2 group <span class="fw-bold">32 Players</span>
                                    </p>
                                    <p class="match-prize">Prize Pool <span class="fw-bold">$3200</span></p>
                                </div>
                                <div class="match-content gradient-bg-yellow">
                                    <div class="row gy-4 align-items-center justify-content-center">
                                        <div class="col-xl-4 col-md-6 order-md-2">
                                            <div class="match-game-team">
                                                <ul
                                                    class="match-team-list d-flex flex-wrap align-items-center justify-content-center">
                                                    <li class="match-team-thumb"><a href="team-single.html"><img
                                                                src="https://labartisan.net/demo/bigamer/assets/images/match/team-1.png"
                                                                alt="team-img"></a>
                                                    </li>
                                                    <li class="text-center"><img class="w-75 w-md-100"
                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/vs.png"
                                                            alt="vs"></li>
                                                    <li class="match-team-thumb"><a href="team-single.html"><img
                                                                src="https://labartisan.net/demo/bigamer/assets/images/match/team-2.png"
                                                                alt="team-img"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 order-md-1">
                                            <div class="match-game-info">
                                                <h4><a href="team-single.html">Battlefield-4 tournament</a> </h4>
                                                <p
                                                    class="d-flex flex-wrap justify-content-center  justify-content-md-start">
                                                    <span class="match-date">30
                                                        April 2021 </span><span class="match-time">Time: 08:30PM</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 order-md-3">
                                            <div class="match-game-social">
                                                <ul
                                                    class="match-social-list d-flex flex-wrap align-items-center justify-content-center justify-content-xl-start">
                                                    <li><a href="#"><img
                                                                src="https://labartisan.net/demo/bigamer/assets/images/match/social-1.png"
                                                                alt="vimeo"></a></li>
                                                    <li><a href="#"><img
                                                                src="https://labartisan.net/demo/bigamer/assets/images/match/social-2.png"
                                                                alt="youtube"></a></li>
                                                    <li><a href="#"><img
                                                                src="https://labartisan.net/demo/bigamer/assets/images/match/social-3.png"
                                                                alt="twitch"></a></li>
                                                    <li><a href="#"
                                                            class="default-button reverse-effect"><span>Watch
                                                                Now <i class="icofont-play-alt-1"></i></span> </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-lg-6">
                        <div class="upcome-matches">
                            <h3 class="upcome-match-header">Upcoming Matches</h3>
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="match-item-2 item-layer">
                                        <div class="match-inner">
                                            <div
                                                class="match-header d-flex flex-wrap justify-content-between align-items-center">
                                                <p class="match-team-info">
                                                    2 group <span class="fw-bold">32 Players</span>
                                                </p>
                                                <p class="match-prize">Prize Pool <span class="fw-bold">$3200</span></p>
                                            </div>
                                            <div class="match-content gradient-bg-orange">
                                                <div class="row align-items-center justify-content-center">
                                                    <div class="col-md-2 col-5 p-0">
                                                        <div class="match-team-thumb text-center">
                                                            <a href="team-single.html" class="text-center"><img
                                                                    src="https://labartisan.net/demo/bigamer/assets/images/match/teamsm/teamsm-1.png"
                                                                    alt="team-img"></a>
                                                        </div>

                                                    </div>
                                                    <div class="col-2 d-md-none">
                                                        <img src="https://labartisan.net/demo/bigamer/assets/images/match/vs.png"
                                                            alt="vs">
                                                    </div>
                                                    <div class="col-md-2 col-5 order-md-3 p-0">
                                                        <div class="match-team-thumb text-center">
                                                            <a href="team-single.html"><img
                                                                    src="https://labartisan.net/demo/bigamer/assets/images/match/teamsm/teamsm-2.png"
                                                                    alt="team-img"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 order-md-2 mt-4 mt-md-0">
                                                        <div class="match-game-info text-center">
                                                            <h4><a href="team-single.html">call of duty TOURNAMENT</a>
                                                            </h4>
                                                            <p class="d-flex flex-wrap justify-content-center">
                                                                <span class="match-date">30
                                                                    April 2021 </span><span class="match-time">Time:
                                                                    08:30PM</span>
                                                            </p>
                                                            <ul
                                                                class="match-social-list d-flex flex-wrap align-items-center justify-content-center">
                                                                <li><a href="#"><img
                                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/social-1.png"
                                                                            alt="vimeo"></a></li>
                                                                <li><a href="#"><img
                                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/social-2.png"
                                                                            alt="youtube"></a></li>
                                                                <li><a href="#"><img
                                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/social-3.png"
                                                                            alt="twitch"></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="match-item-2 item-layer">
                                        <div class="match-inner">
                                            <div
                                                class="match-header d-flex flex-wrap justify-content-between align-items-center">
                                                <p class="match-team-info">
                                                    2 group <span class="fw-bold">32 Players</span>
                                                </p>
                                                <p class="match-prize">Prize Pool <span class="fw-bold">$3200</span></p>
                                            </div>
                                            <div class="match-content gradient-bg-blue">
                                                <div class="row align-items-center justify-content-center">
                                                    <div class="col-md-2 col-5 p-0">
                                                        <div class="match-team-thumb text-center">
                                                            <a href="team-single.html" class="text-center"><img
                                                                    src="https://labartisan.net/demo/bigamer/assets/images/match/teamsm/teamsm-3.png"
                                                                    alt="team-img"></a>
                                                        </div>

                                                    </div>
                                                    <div class="col-2 d-md-none">
                                                        <img src="https://labartisan.net/demo/bigamer/assets/images/match/vs.png"
                                                            alt="vs">
                                                    </div>
                                                    <div class="col-md-2 col-5 order-md-3 p-0">
                                                        <div class="match-team-thumb text-center">
                                                            <a href="team-single.html"><img
                                                                    src="https://labartisan.net/demo/bigamer/assets/images/match/teamsm/teamsm-4.png"
                                                                    alt="team-img"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 order-md-2 mt-4 mt-md-0">
                                                        <div class="match-game-info text-center">
                                                            <h4><a href="team-single.html">LEAGUE BATTLE tournament</a>
                                                            </h4>
                                                            <p class="d-flex flex-wrap justify-content-center">
                                                                <span class="match-date">30
                                                                    April 2021 </span><span class="match-time">Time:
                                                                    08:30PM</span>
                                                            </p>
                                                            <ul
                                                                class="match-social-list d-flex flex-wrap align-items-center justify-content-center">
                                                                <li><a href="#"><img
                                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/social-1.png"
                                                                            alt="vimeo"></a></li>
                                                                <li><a href="#"><img
                                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/social-2.png"
                                                                            alt="youtube"></a></li>
                                                                <li><a href="#"><img
                                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/social-3.png"
                                                                            alt="twitch"></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="match-item-2 item-layer">
                                        <div class="match-inner">
                                            <div
                                                class="match-header d-flex flex-wrap justify-content-between align-items-center">
                                                <p class="match-team-info">
                                                    2 group <span class="fw-bold">32 Players</span>
                                                </p>
                                                <p class="match-prize">Prize Pool <span class="fw-bold">$3200</span></p>
                                            </div>
                                            <div class="match-content gradient-bg-pink">
                                                <div class="row align-items-center justify-content-center">
                                                    <div class="col-md-2 col-5 p-0">
                                                        <div class="match-team-thumb text-center">
                                                            <a href="team-single.html" class="text-center"><img
                                                                    src="https://labartisan.net/demo/bigamer/assets/images/match/teamsm/teamsm-5.png"
                                                                    alt="team-img"></a>
                                                        </div>

                                                    </div>
                                                    <div class="col-2 d-md-none">
                                                        <img src="https://labartisan.net/demo/bigamer/assets/images/match/vs.png"
                                                            alt="vs">
                                                    </div>
                                                    <div class="col-md-2 col-5 order-md-3 p-0">
                                                        <div class="match-team-thumb text-center">
                                                            <a href="team-single.html"><img
                                                                    src="https://labartisan.net/demo/bigamer/assets/images/match/teamsm/teamsm-6.png"
                                                                    alt="team-img"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 order-md-2 mt-4 mt-md-0">
                                                        <div class="match-game-info text-center">
                                                            <h4><a href="team-single.html">pubg classic tournament</a>
                                                            </h4>
                                                            <p class="d-flex flex-wrap justify-content-center">
                                                                <span class="match-date">30
                                                                    April 2021 </span><span class="match-time">Time:
                                                                    08:30PM</span>
                                                            </p>
                                                            <ul
                                                                class="match-social-list d-flex flex-wrap align-items-center justify-content-center">
                                                                <li><a href="#"><img
                                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/social-1.png"
                                                                            alt="vimeo"></a></li>
                                                                <li><a href="#"><img
                                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/social-2.png"
                                                                            alt="youtube"></a></li>
                                                                <li><a href="#"><img
                                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/social-3.png"
                                                                            alt="twitch"></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="upcome-matches">
                            <h3 class="upcome-match-header">Previous Matches</h3>
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="match-item-2 item-layer">
                                        <div class="match-inner">
                                            <div
                                                class="match-header d-flex flex-wrap justify-content-between align-items-center">
                                                <p class="match-team-info">
                                                    2 group <span class="fw-bold">32 Players</span>
                                                </p>
                                                <p class="match-prize">Prize Pool <span class="fw-bold">$3200</span></p>
                                            </div>
                                            <div class="match-content gradient-bg-pink">
                                                <div class="row align-items-center justify-content-center">
                                                    <div class="col-md-2 col-5 p-0">
                                                        <div class="match-team-thumb text-center">
                                                            <a href="team-single.html" class="text-center"><img
                                                                    src="https://labartisan.net/demo/bigamer/assets/images/match/teamsm/teamsm-7.png"
                                                                    alt="team-img"></a>
                                                        </div>

                                                    </div>
                                                    <div class="col-2 d-md-none">
                                                        <img src="https://labartisan.net/demo/bigamer/assets/images/match/vs.png"
                                                            alt="vs">
                                                    </div>
                                                    <div class="col-md-2 col-5 order-md-3 p-0">
                                                        <div class="match-team-thumb text-center">
                                                            <a href="team-single.html"><img
                                                                    src="https://labartisan.net/demo/bigamer/assets/images/match/teamsm/teamsm-8.png"
                                                                    alt="team-img"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 order-md-2 mt-4 mt-md-0">
                                                        <div class="match-game-info text-center">
                                                            <h4><a href="team-single.html">4 - 2</a>
                                                            </h4>
                                                            <p class="d-flex flex-wrap justify-content-center">
                                                                <span class="match-date">30
                                                                    April 2021 </span><span class="match-time">Time:
                                                                    08:30PM</span>
                                                            </p>
                                                            <ul
                                                                class="match-social-list d-flex flex-wrap align-items-center justify-content-center">
                                                                <li><a href="#"><img
                                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/social-1.png"
                                                                            alt="vimeo"></a>
                                                                </li>
                                                                <li><a href="#"><img
                                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/social-2.png"
                                                                            alt="youtube"></a></li>
                                                                <li><a href="#"><img
                                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/social-3.png"
                                                                            alt="twitch"></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="match-item-2 item-layer">
                                        <div class="match-inner">
                                            <div
                                                class="match-header d-flex flex-wrap justify-content-between align-items-center">
                                                <p class="match-team-info">
                                                    2 group <span class="fw-bold">32 Players</span>
                                                </p>
                                                <p class="match-prize">Prize Pool <span class="fw-bold">$3200</span></p>
                                            </div>
                                            <div class="match-content gradient-bg-yellow">
                                                <div class="row align-items-center justify-content-center">
                                                    <div class="col-md-2 col-5 p-0">
                                                        <div class="match-team-thumb text-center">
                                                            <a href="team-single.html" class="text-center"><img
                                                                    src="https://labartisan.net/demo/bigamer/assets/images/match/teamsm/teamsm-9.png"
                                                                    alt="team-img"></a>
                                                        </div>

                                                    </div>
                                                    <div class="col-2 d-md-none">
                                                        <img src="https://labartisan.net/demo/bigamer/assets/images/match/vs.png"
                                                            alt="vs">
                                                    </div>
                                                    <div class="col-md-2 col-5 order-md-3 p-0">
                                                        <div class="match-team-thumb text-center">
                                                            <a href="team-single.html"><img
                                                                    src="https://labartisan.net/demo/bigamer/assets/images/match/teamsm/teamsm-10.png"
                                                                    alt="team-img"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 order-md-2 mt-4 mt-md-0">
                                                        <div class="match-game-info text-center">
                                                            <h4><a href="team-single.html">8 - 4</a>
                                                            </h4>
                                                            <p class="d-flex flex-wrap justify-content-center">
                                                                <span class="match-date">30
                                                                    April 2021 </span><span class="match-time">Time:
                                                                    08:30PM</span>
                                                            </p>
                                                            <ul
                                                                class="match-social-list d-flex flex-wrap align-items-center justify-content-center">
                                                                <li><a href="#"><img
                                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/social-1.png"
                                                                            alt="vimeo"></a>
                                                                </li>
                                                                <li><a href="#"><img
                                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/social-2.png"
                                                                            alt="youtube"></a></li>
                                                                <li><a href="#"><img
                                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/social-3.png"
                                                                            alt="twitch"></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="match-item-2 item-layer">
                                        <div class="match-inner">
                                            <div
                                                class="match-header d-flex flex-wrap justify-content-between align-items-center">
                                                <p class="match-team-info">
                                                    2 group <span class="fw-bold">32 Players</span>
                                                </p>
                                                <p class="match-prize">Prize Pool <span class="fw-bold">$3200</span></p>
                                            </div>
                                            <div class="match-content gradient-bg-blue">
                                                <div class="row align-items-center justify-content-center">
                                                    <div class="col-md-2 col-5 p-0">
                                                        <div class="match-team-thumb text-center">
                                                            <a href="team-single.html" class="text-center"><img
                                                                    src="https://labartisan.net/demo/bigamer/assets/images/match/teamsm/teamsm-11.png"
                                                                    alt="team-img"></a>
                                                        </div>

                                                    </div>
                                                    <div class="col-2 d-md-none">
                                                        <img src="https://labartisan.net/demo/bigamer/assets/images/match/vs.png"
                                                            alt="vs">
                                                    </div>
                                                    <div class="col-md-2 col-5 order-md-3 p-0">
                                                        <div class="match-team-thumb text-center">
                                                            <a href="team-single.html"><img
                                                                    src="https://labartisan.net/demo/bigamer/assets/images/match/teamsm/teamsm-12.png"
                                                                    alt="team-img"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 order-md-2 mt-4 mt-md-0">
                                                        <div class="match-game-info text-center">
                                                            <h4><a href="team-single.html">3 - 4</a>
                                                            </h4>
                                                            <p class="d-flex flex-wrap justify-content-center">
                                                                <span class="match-date">30
                                                                    April 2021 </span><span class="match-time">Time:
                                                                    08:30PM</span>
                                                            </p>
                                                            <ul
                                                                class="match-social-list d-flex flex-wrap align-items-center justify-content-center">
                                                                <li><a href="#"><img
                                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/social-1.png"
                                                                            alt="vimeo"></a>
                                                                </li>
                                                                <li><a href="#"><img
                                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/social-2.png"
                                                                            alt="youtube"></a></li>
                                                                <li><a href="#"><img
                                                                            src="https://labartisan.net/demo/bigamer/assets/images/match/social-3.png"
                                                                            alt="twitch"></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button-wrapper text-center mt-5">
                    <a href="game-list.html" class="default-button"><span>Browse All Matches <i
                                class="icofont-circled-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- ===========match schedule Section Ends Here========== -->



    <div class="container">
        <hr class="m-0">
    </div>

    <!-- ===========Sponsor Section Start Here========== -->
    {{-- <div class="sponsor-section padding-top padding-bottom">
        <div class="container">
            <div class="section-header">
                <p>WE OUR PARTNERS</p>
                <h2>BECOME A PARTNER of bigamer</h2>
            </div>
            <div class="section-wrapper">
                <div class="row g-5 justify-content-center row-cols-xl-5 row-cols-md-3 row-cols-2">
                    <div class="col">
                        <div class="sponsor-item">
                            <div class="sponsor-inner">
                                <div class="sponsor-thumb text-center">
                                    <img src="https://labartisan.net/demo/bigamer/assets/images/sponsor/01.png"
                                        alt="sponsor-thumb">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="sponsor-item">
                            <div class="sponsor-inner">
                                <div class="sponsor-thumb text-center">
                                    <img src="https://labartisan.net/demo/bigamer/assets/images/sponsor/02.png"
                                        alt="sponsor-thumb">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="sponsor-item">
                            <div class="sponsor-inner">
                                <div class="sponsor-thumb text-center">
                                    <img src="https://labartisan.net/demo/bigamer/assets/images/sponsor/03.png"
                                        alt="sponsor-thumb">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="sponsor-item">
                            <div class="sponsor-inner">
                                <div class="sponsor-thumb text-center">
                                    <img src="https://labartisan.net/demo/bigamer/assets/images/sponsor/04.png"
                                        alt="sponsor-thumb">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="sponsor-item">
                            <div class="sponsor-inner">
                                <div class="sponsor-thumb text-center">
                                    <img src="https://labartisan.net/demo/bigamer/assets/images/sponsor/05.png"
                                        alt="sponsor-thumb">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="sponsor-item">
                            <div class="sponsor-inner">
                                <div class="sponsor-thumb text-center">
                                    <img src="https://labartisan.net/demo/bigamer/assets/images/sponsor/06.png"
                                        alt="sponsor-thumb">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="sponsor-item">
                            <div class="sponsor-inner">
                                <div class="sponsor-thumb text-center">
                                    <img src="https://labartisan.net/demo/bigamer/assets/images/sponsor/07.png"
                                        alt="sponsor-thumb">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="sponsor-item">
                            <div class="sponsor-inner">
                                <div class="sponsor-thumb text-center">
                                    <img src="https://labartisan.net/demo/bigamer/assets/images/sponsor/08.png"
                                        alt="sponsor-thumb">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <a href="partners.html" class="default-button"><span>BECOME A PARTNER <i
                                class="icofont-circled-right"></i></span> </a>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- ===========Sponsor Section Ends Here========== -->

@endsection

@section('js')
    <script>
        $('#body-content').css('padding-top', 0);
    </script>
@endsection
