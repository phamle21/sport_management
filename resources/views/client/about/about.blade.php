@extends('client.master.template')

@section('body_content')


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
                <h2>{{ __('message.about.video-section.section-header') }}</h2>
            </div>
            <div class="section-wrapper">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="video-top">
                            <div class="row g-4 justify-content-center">
                                <div class="col-12">
                                    <div class="video-item">
                                        <div class="video-inner position-relative">
                                            <div class="video-thumb position-relative video-overlay">
                                                <img src="assets/images/video/06.jpg" alt="video-thumb" class="w-100">
                                                <div class="video-icon">
                                                    <a href="https://www.youtube.com/embed/g5eQgEuiFC8"
                                                        data-rel="lightcase">
                                                        <i class="icofont-play-alt-1"></i>
                                                        <span class="pluse"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

@endsection

@section('js')
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
@endsection
