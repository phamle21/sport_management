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
                                        <li><a href="/find-tournament">{{ __('message.header.find-tournament') }}</a>
                                        </li>
                                        <li><a
                                                href="/create-tournament">{{ __('message.header.create-tournament') }}</a>
                                        </li>
                                        @if (Auth::check())
                                            <li><a href="/find-my-tournament/{{ Auth::user()->id }}">Giải đấu của
                                                    tôi</a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>

                                <li>
                                    <a href="#0">{{ __('message.header.team') }}</a>
                                    <ul class="submenu">
                                        <li><a href="/create-team">{{ __('message.header.create-team') }}</a></li>
                                    </ul>
                                </li>

                                <li><a href="/about">{{ __('message.header.about') }}</a></li>
                                <li><a href="/contact">{{ __('message.header.contact') }}</a></li>
                            </ul>



                            @if (Auth::check())
                                <style>
                                    #avatar-user {
                                        border-style: none;
                                        width: 4rem;
                                        height: 4rem;
                                        border: 5px solid rgba(255, 255, 255, .1);
                                        border-radius: 30px;
                                    }

                                    .dropdown-menu {
                                        border: 1px solid rgba(255, 255, 255, .1);
                                        border-radius: 4px;
                                        box-shadow: 0px 2px 4px 0px rgb(0 0 0 / 6%);
                                        background: rgba(35, 42, 92, .5);
                                        color: #fff;
                                        padding: 0;
                                    }

                                    .dropdown-menu li:hover {
                                        color: rgb(77, 77, 77) !important;
                                    }
                                </style>
                                <div class="dropdown">
                                    <a href="javascript:;" id="dropdownUser" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <img class="mx-2" src="{{ Auth::user()->avatar }}" alt=""
                                            id="avatar-user">
                                        <b>{{ Auth::user()->name }} <i class="fa-solid fa-caret-down"></i></b>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownUser">
                                        <li><a class="dropdown-item text-white"
                                                href="/my-profile">{{ __('message.header.user.profile') }}</a>
                                        </li>

                                        <hr class="dropdown-divider m-0">
                                        <li><a class="dropdown-item text-white"
                                                href="/logout">{{ __('message.header.user.logout') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <a href="/login" class="login">
                                    <i class="icofont-user"></i>
                                    <span>{{ __('message.login') }}</span>
                                </a>
                                <a href="/register" class="signup">
                                    <i class="icofont-users"></i>
                                    <span>{{ __('message.register') }}</span></a>
                            @endif



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
