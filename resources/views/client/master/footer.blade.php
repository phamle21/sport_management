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
                                <img class="me-2" src="{{ asset('assets/images/footer/icons/03.png') }}" alt="location-icon">
                                <span>{{ __('message.address') }} :
                                    {{ \App\Models\Option::where('name', 'address_site')->first()->value }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-middle padding-top padding-bottom" style="background-image: url(assets/images/footer/bg.jpg);">
        <div class="container">
            <div class="row padding-lg-top justify-content-around">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="footer-middle-item-wrapper">
                        <div class="footer-middle-item mb-lg-0">
                            <div class="fm-item-title mb-4">
                                <img src="{{ asset('assets/images/logo/logo.png') }}"  alt="logo">
                            </div>
                            <div class="fm-item-content">
                                <p class="mb-4">Upropriate brand economca sound technolog after covalent
                                    technology enable prospective wastng markets whereas propriate and brand
                                    economca sound technolog</p>
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
                        <p>&copy;2022 <a href="fb.com/phamle21">Sport Tournaments</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
