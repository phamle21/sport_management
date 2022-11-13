<header class="header-section">
    <div class="container">
        <div class="header-holder d-flex flex-wrap justify-content-between align-items-center">
            <div class="brand-logo d-none d-lg-inline-block">
                <div class="logo">
                    <a href="/">
                        <img id="header-logo" src="{{ asset('assets/images/logo.png') }}" style="max-width: 200px" alt="logo">
                    </a>
                </div>
            </div>
            <div class="header-menu-part">
                <div class="header-top">
                    <div class="header-top-area">
                        <ul class="left">
                            <li>
                                <i class="icofont-ui-call"></i> <span>+84 94 164 9826</span>
                            </li>
                            <li>
                                <i class="icofont-location-pin"></i> {{ __('message.address') }}
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
                            <a href="index"><img src="{{ asset('assets/images/logo/logo.png') }}"
                                    alt="logo"></a>
                        </div>
                        <div class="menu-area">
                            <ul class="menu">
                                <li>
                                    <a href="/">{{ __('message.header.home') }}</a>
                                </li>

                                <li>
                                    <a href="#0">Features</a>
                                    <ul class="submenu">
                                        <li><a href="/about">About</a></li>
                                        <li><a href="/gallery">gallery</a></li>
                                        <li>
                                            <a href="#0">games</a>
                                            <ul class="submenu">
                                                <li><a href="/game-list">game list 1</a></li>
                                                <li><a href="/game-list2">game list 2</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="/partners">partners</a></li>
                                        <li>
                                            <a href="#0">teams</a>
                                            <ul class="submenu">
                                                <li><a href="/team">team</a></li>
                                                <li><a href="/team-single">team single</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#0">accounts</a>
                                            <ul class="submenu">
                                                <li><a href="/login">{{ __('message.login') }}</a></li>
                                                <li><a href="/register">{{ __('message.register') }}</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#0">Shop</a>
                                            <ul class="submenu">
                                                <li><a href="/shop">shop</a></li>
                                                <li><a href="/shop-single">Shop Details</a></li>
                                                <li><a href="/cart-page">Cart Page</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="/404">404 Page</a></li>

                                    </ul>
                                </li>
                                <li><a href="/achievements">achievement</a></li>
                                <li>
                                    <a href="#0">Blog</a>
                                    <ul class="submenu">
                                        <li><a href="/blog">Blog</a></li>
                                        <li><a href="/blog-2">Blog 2</a></li>
                                        <li><a href="/blog-single">Blog Single</a></li>
                                    </ul>
                                </li>
                                <li><a href="/contact">Contact</a></li>
                            </ul>
                            <a href="login" class="login">
                                <i class="icofont-user"></i>
                                <span>{{ __('message.login') }}</span>
                            </a>
                            <a href="signup" class="signup">
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
