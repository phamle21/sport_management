<header class="header-section">
    <div class="container">
        <div class="header-holder d-flex flex-wrap justify-content-between align-items-center">
            <div class="brand-logo d-none d-lg-inline-block">
                <div class="logo">
                    <a href="/">
                        <img id="header-logo"
                            src="{{ asset(\App\Models\Option::where('name', 'logo_site_path')->first()->value) }}"
                            style="max-width: 200px" alt="logo">
                    </a>
                </div>
            </div>
            <div class="header-menu-part">
                <div class="header-top">
                    <div class="header-top-area">
                        <ul class="left">
                            <li>
                                <i class="icofont-ui-call"></i>
                                <span>{{ \App\Models\Option::where('name', 'phone_site')->first()->value }}</span>
                            </li>
                            <li>
                                <i class="icofont-location-pin"></i>
                                {{ \App\Models\Option::where('name', 'address_site')->first()->value }}
                            </li>
                        </ul>
                        <ul class="social-icons d-flex align-items-center">
                            <li><a>&nbsp;</a></li>
                            <li>
                                <a href="{!! route('settings.change-language', ['en']) !!}">En</a>
                            </li>
                            <li>
                                <a href="{!! route('settings.change-language', ['vi']) !!}">Vi</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="header-bottom">
                    <div class="header-wrapper justify-content-lg-end">
                        <div class="mobile-logo d-lg-none">
                            <a href="/"><img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo"></a>
                        </div>
                        <div class="menu-area">
                            <ul class="menu">
                                <li><a href="/">{{ __('message.header.home') }}</a></li>

                                <li>
                                    <a href="#0">{{ __('message.header.tournament') }}</a>
                                    <ul class="submenu">
                                        <li><a href="/find-tournament">{{ __('message.header.find-tournament') }}</a></li>
                                        <li><a href="/create-tournament">{{ __('message.header.create-tournament') }}</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="#0">{{ __('message.header.team') }}</a>
                                    <ul class="submenu">
                                        <li><a href="/create-tournament">{{ __('message.header.create-team') }}</a></li>
                                    </ul>
                                </li>

                                <li><a href="/about">{{ __('message.header.about') }}</a></li>
                                <li><a href="/contact">{{ __('message.header.contact') }}</a></li>
                            </ul>
                            <a href="/login" class="login">
                                <i class="icofont-user"></i>
                                <span>{{ __('message.login') }}</span>
                            </a>
                            <a href="/register" class="signup">
                                <i class="icofont-users"></i>
                                <span>{{ __('message.register') }}</span></a>

                            <!-- toggle icons -->
                            <div class="header-bar d-lg-none">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="ellepsis-bar d-lg-none">
                                <i class="icofont-info-square"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
