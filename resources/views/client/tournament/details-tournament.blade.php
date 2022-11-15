@extends('client.master.template')

@section('css')
    <style>
        .tour_details-logo {
            width: 100%;
            height: 100%;
            max-width: 300px;
            border-radius: 50%;
        }

        .tour_details-thum {
            max-width: 300px;
            border-radius: 50%;
        }

        .tour_details-banner {
            padding: 1rem 0;
        }
    </style>
@endsection

@section('body_content')
    <!-- ===========Banner Section start Here========== -->
    <section class="pageheader-section tour_details-banner"
        style="background-image: url({{ asset('assets/images/video/bg.jpg') }});">
        <div class="container">
            <div class="section-wrapper text-center text-uppercase">
                <div class="pageheader-thumb mb-5 tour_details-thumb">
                    <img src="{{ asset($tournament->logo) }}" alt="team" class="tour_details-logo">
                </div>
                <h2 class="pageheader-title mt-5 pt-3">{{ $tournament->name }}</h2>
            </div>
        </div>
    </section>
    <!-- ===========Banner Section Ends Here========== -->

    <!-- ===========Collection Section Start Here========== -->
    <section class="collection-section padding-top padding-bottom">
        <div class="container">
            <div class="section-wrapper">
                <ul
                    class="collection-filter-button-group common-filter-button-group d-flex flex-wrap justify-content-center mb-5 text-uppercase">

                    <li class="is-checked" data-filter=".collection-about">
                        {{ __('message.tournament.details.collection-about') }}</li>
                    <li data-filter=".collection-notify">{{ __('message.tournament.details.collection-notify') }}</li>
                    <li data-filter=".collection-stage">{{ __('message.tournament.details.collection-stage') }}</li>
                </ul>
                <div class="row g-4 justify-content-center collection-grid">

                    <div class="gameListItem collection-about">
                        <div class="about-team padding-bottom">
                            <div class="container">
                                <div class="section-header">
                                    <p>{{ __('message.tournament.details.about-head-sub-1') }}</p>
                                    <h2 class="mb-3">{{ __('message.tournament.details.about-head-1') }}</h2>
                                    <p class="desc">
                                        {{ __('message.tournament.details.about-startat') }}:
                                        <b>{{ date('d/m/Y', strtotime($tournament->start)) }}</b>
                                        &nbsp;&nbsp;<b>-</b>&nbsp;&nbsp;
                                        {{ __('message.tournament.details.about-endat') }}:
                                        <b>{{ date('d/m/Y', strtotime($tournament->end)) }}</b>
                                    </p>
                                </div>
                                <ul class="d-flex flex-wrap justify-content-center player-meta mb-0">
                                    <li class="d-flex align-items-center">
                                        <span class="left me-3"><i class="fa-regular fa-diagram-sankey"></i></span>
                                        <span class="right">{{ $tournament->total_stage }}
                                            {{ __('message.tournament.details.total-stage') }}</span>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <span class="left me-3"><i class="fa-solid fa-users-rectangle"></i></span>
                                        <span class="right">{{ $tournament->total_group }}
                                            {{ __('message.tournament.details.total-group') }}</span>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <span class="left me-3"><i class="icofont-game"></i></span>
                                        <span class="right">{{ $tournament->total_match }}
                                            {{ __('message.tournament.details.total-match') }}</span>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <span class="left me-3"><i class="icofont-workers-group"></i></span>
                                        <span class="right">{{ $tournament->total_team }}
                                            {{ __('message.tournament.details.total-team') }}</span>
                                    </li>
                                </ul>
                                <!-- ===========Sponsor Section Start Here========== -->
                                <div class="sponsor-section padding-top padding-bottom">
                                    <div class="container">
                                        <div class="section-header">
                                            <p>{{ __('message.tournament.details.about-head-sub-2') }}</p>
                                            <h2>{{ __('message.tournament.details.about-head-2') }}</h2>
                                        </div>
                                        <div class="section-wrapper">
                                            <div
                                                class="row g-5 justify-content-center row-cols-xl-5 row-cols-md-3 row-cols-2">
                                                <div class="col">
                                                    <div class="sponsor-item">
                                                        <div class="sponsor-inner">
                                                            <div class="sponsor-thumb text-center">
                                                                <img src="{{ asset('assets/images/sponsor/01.png') }}"
                                                                    alt="sponsor-thumb">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center mt-5">
                                                <a href="partners.html"
                                                    class="default-button"><span>{{ __('message.tournament.details.about-btn-susponsor') }}
                                                        <i class="icofont-circled-right"></i></span> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ===========Sponsor Section Ends Here========== -->
                            </div>
                        </div>
                    </div>

                    <div class="gameListItem collection-notify">
                        {!! $tournament->notify !!}
                    </div>

                    <div class="gameListItem collection-stage"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===========Collection Section Ends Here========== -->
@endsection

@section('js')
    <script>
        $(window).on('load', function() {
            var $grid = $('.collection-grid').isotope({
                itemSelector: '.gameListItem',
                layoutMode: 'fitRows',
            });

            $grid.isotope({
                filter: '.collection-about'
            });
        })
    </script>
@endsection
