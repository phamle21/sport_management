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
                                <span>{{ __('message.phone') }} :
                                    {{ \App\Models\Option::where('name', 'phone_site')->first()->value }}</span>
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
                                <span>{{ __('message.email') }} :
                                    {{ \App\Models\Option::where('name', 'email_site')->first()->value }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="footer-top-item lab-item">
                        <div class="lab-inner">
                            <div class="lab-thumb">
                            </div>
                            <div class="lab-content">
                                <img class="me-2" src="{{ asset('assets/images/footer/icons/03.png') }}"
                                    alt="location-icon">
                                <span>{{ __('message.address') }} :
                                    {{ \App\Models\Option::where('name', 'address_site')->first()->value }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-middle padding-top padding-bottom"
        style="background-image: url({{ asset('assets/images/footer/bg.jpg') }});">
        <div class="container">
            <div class="row padding-lg-top justify-content-around">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="footer-middle-item-wrapper">
                        <div class="footer-middle-item mb-lg-0">
                            <div class="fm-item-title mb-4">
                                <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo">
                            </div>
                            <div class="fm-item-content">
                                <p>{{ __('message.footer.content-logo') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="footer-middle-item-wrapper">
                        <div class="footer-middle-item-3 mb-lg-0">
                            <div class="fm-item-title">
                                <h4>{{ __('message.footer.head-right') }}</h4>
                            </div>
                            <div class="fm-item-content">

                                <p class="mb-4">
                                    {{ __('message.footer.content-1') }}
                                </p>
                                <p class="mb-4">
                                    {{ __('message.footer.content-2') }}
                                </p>

                                <a href="/contact" class="default-button"><span>{{ __('message.footer.btn-right') }} <i
                                            class="icofont-circled-right"></i></span></a>
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
                        <p>&copy;2022 <a href="fb.com/phamle21">Sport Tournaments</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
