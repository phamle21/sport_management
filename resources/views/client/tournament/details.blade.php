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
    <style>
        .btn-add {
            border: 1px solid rgba(255, 255, 255, .1) !important;
            color: #fff;
            padding: 1rem;
            margin-left: 0.5rem;
        }

        .btn-add:hover {
            color: #fff;
            background: rgba(35, 42, 92, 0.833);
        }
    </style>
    <style>
        .accordion-button {
            padding: 2px 1rem !important;
        }

        .accordion-item:hover {
            background: blue !important;
        }

        .accordion-button:hover {
            background: rgb(0, 0, 150) !important;
        }

        .accordion-button::after {
            content: none !important;
        }

        .accordion-item-add :hover {
            background: rgb(0, 255, 17) !important;
        }

        .accordion-button-add :hover {
            background: rgb(0, 87, 150) !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.3.1/css/flag-icon.min.css">
    <link rel="stylesheet/less" type="text/css" href="/assets/css/tournament-bracket.less" />
    <script src="https://cdn.jsdelivr.net/npm/less"></script>
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

                    <li data-filter=".collection-about">
                        {{ __('message.tournament.details.collection-about') }}</li>
                    <li data-filter=".collection-notify">{{ __('message.tournament.details.collection-notify') }}</li>
                    <li data-filter=".collection-stage">{{ __('message.tournament.details.collection-stage') }}</li>
                    <li data-filter=".collection-group">{{ __('message.tournament.details.collection-group') }}</li>
                    <li data-filter=".collection-bracket">{{ __('message.tournament.details.collection-bracket') }}</li>
                </ul>
                <div class="row g-4 justify-content-center collection-grid">
                    {{-- ============================About=================================================================== --}}
                    <div class="gameListItem collection-about">
                        <div class="about-team padding-bottom">
                            <div class="container">
                                <div class="padding-bottom">
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
                                        <p class="desc">
                                            {!! $tournament->description !!}
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
                                </div>


                                <div class="container">
                                    <hr class="m-0">
                                </div>

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
                                                @foreach ($sponsor_list as $v)
                                                    <div class="col">
                                                        <a href="#abc" class="sponsor-item">
                                                            <div class="sponsor-inner">
                                                                <div class="sponsor-thumb text-center">
                                                                    <img src="{{ asset($v->logo) }}" alt="sponsor-thumb">
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach


                                            </div>
                                            <div class="text-center mt-5">
                                                <a href="{{ route('sponsor.index', ['league_id' => $tournament->id]) }}"
                                                    class="default-button"><span>{{ __('message.tournament.details.about-btn-susponsor') }}
                                                        <i class="icofont-circled-right"></i></span> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ===========Sponsor Section Ends Here========== -->

                                <div class="container">
                                    <hr class="m-0">
                                </div>

                                <!-- ===========Prize Section Start Here========== -->
                                <div class="sponsor-section padding-top padding-bottom">
                                    <div class="container">
                                        <div class="section-header">
                                            <p>{{ __('message.tournament.details.about-head-sub-3') }}</p>
                                            <h2>{{ __('message.tournament.details.about-head-3') }}</h2>
                                        </div>
                                        <div class="section-wrapper" id="show_prize">
                                            {!! $tournament->prize !!}
                                        </div>
                                    </div>
                                </div>
                                <!-- ===========Prize Section Ends Here========== -->

                            </div>
                        </div>
                    </div>

                    {{-- ============================Notify=================================================================== --}}
                    <div class="gameListItem collection-notify">
                        {!! $tournament->notify !!}
                    </div>

                    {{-- ============================Stage=================================================================== --}}
                    <div class="gameListItem collection-stage">
                        {{-- ===========Add Stage========== --}}

                        <div class="row my-2 mb-4">
                            <div class="section-header">
                                <p>{{ __('message.tournament.details.stage.head-sub-1') }}</p>
                                <h2 class="mb-3">{{ __('message.tournament.details.stage.head-1') }}</h2>
                            </div>

                            <form class="contact-form justify-content-center" action="{{ route('stage.create') }}"
                                id="frmCreateStage" name="frmCreateStage" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="league_id" value="{{ $tournament->id }}">

                                <div class="row justify-content-center align-items-center w-100 my-2">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group w-100 m-0">
                                            <input type="number" min="0" id="frm-order_stage" name="order"
                                                required
                                                placeholder="{{ __('message.tournament.details.stage.create.frm-order') }} *">
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <div class="form-group w-100 m-0">
                                            <input type="text" id="frm-name_stage" name="name" required
                                                placeholder="{{ __('message.tournament.details.stage.create.frm-name') }} *">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group w-100 text-center mt-4">
                                    <button class="default-button" id="btn-frmCreateStage" from="frmCreateStage"
                                        type="submit">
                                        <span>{{ __('message.tournament.details.stage.btn-send') }}
                                            <i class="icofont-circled-right"></i>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- ===========/Add Stage========== --}}

                        {{-- ===========Show Stage========== --}}
                        <div class="row justify-content-around mt-5">
                            <div class="section-header">
                                <p>{{ __('message.tournament.details.stage.head-sub-2') }}</p>
                                <h2 class="mb-3">{{ __('message.tournament.details.stage.head-2') }}</h2>
                            </div>
                            <div class="d-flex flex-nowrap bd-highlight">
                                @foreach ($stages as $stage)
                                    <div class="col-12 col-lg border m-3 py-3 order-{{ $stage->order }}"
                                        style="border-radius: 30px">
                                        <div class="row justify-content-center align-items-center px-3">
                                            <div class="col-2">
                                                <button class="bg-transparent btn text-white fs-6">
                                                    <i class="fa-duotone fa-pen-to-square"></i>
                                                </button>
                                            </div>
                                            <div class="col">
                                                <h5 class="my-2 text-center">
                                                    {{ $stage->order }} - {{ $stage->name }}
                                                </h5>
                                            </div>
                                            <div class="col-2">
                                                <form action="{{ route('stage.delete', ['id' => $stage->id]) }}"
                                                    id="frmDeleteStage-{{ $stage->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="league_id"
                                                        value="{{ $tournament->id }}">
                                                    <button class="bg-transparent btn text-white fs-6" type="button"
                                                        onclick="deleteStage({{ $stage->id }})">
                                                        <i class="fa-duotone fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <hr>
                                        @foreach ($stage->groups as $group)
                                            <div class="col-12 px-3 my-2">
                                                <div class="accordion-item d-flex">
                                                    <a href="#áv" class="accordion-header w-100">
                                                        <div class="accordion-button accordion-button-2 collapsed">
                                                            <span
                                                                class="accor-header-inner d-flex flex-wrap align-items-center">
                                                                <span class="accor-thumb">
                                                                    <img src="{{ asset($tournament->logo) }}"
                                                                        alt="partner-thumb">
                                                                </span>
                                                                <span class="accor-title">{{ $group->name }}</span>
                                                            </span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-12 px-3 my-2">
                                            <div class="accordion-item d-flex product-action-link">
                                                <a data-bs-toggle="modal" data-bs-target="#new_group"
                                                    data-bs-whatever="{{ $stage->id }}" style="cursor: pointer;"
                                                    class="accordion-header w-100 view-modal">
                                                    <div
                                                        class="accordion-button accordion-button-2 accordion-button-new collapsed">
                                                        <span
                                                            class="accor-header-inner d-flex flex-wrap align-items-center">
                                                            <span class="accor-thumb">
                                                                <img src="https://www.freepnglogos.com/uploads/plus-icon/plus-icon-plus-svg-png-icon-download-1.png"
                                                                    alt="partner-thumb">
                                                            </span>
                                                            <span class="accor-title">Add new group</span>
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- ===========Show Stage========== --}}

                    </div>

                    {{-- ============================Group=================================================================== --}}
                    <div class="gameListItem collection-group">
                        <div class="row my-2 mb-4">
                            <div class="section-header">
                                <p>{{ __('message.tournament.details.stage.head-sub-1') }}</p>
                                <h2 class="mb-3">{{ __('message.tournament.details.stage.head-1') }}</h2>
                            </div>
                        </div>


                    </div>

                    {{-- ============================Bracket=================================================================== --}}
                    <div class="gameListItem collection-bracket">
                        <div class="row my-2 mb-4">
                            <div class="section-header">
                                <p>{{ __('message.tournament.details.stage.head-sub-1') }}</p>
                                <h2 class="mb-3">{{ __('message.tournament.details.stage.head-1') }}</h2>
                            </div>
                        </div>
                        <div class="container">
                            <div class="tournament-bracket tournament-bracket--rounded">
                                <div class="tournament-bracket__round tournament-bracket__round--quarterfinals">
                                    <h3 class="tournament-bracket__round-title">Quarterfinals</h3>
                                    <ul class="tournament-bracket__list">
                                        <li class="tournament-bracket__item">
                                            <div class="tournament-bracket__match" tabindex="0">
                                                <table class="tournament-bracket__table">
                                                    <caption
                                                        class="tournament-bracket__caption d-flex justify-content-center">
                                                        <time datetime="1998-02-18">18 February 1998</time>
                                                    </caption>
                                                    <thead class="sr-only">
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tournament-bracket__content">
                                                        <tr
                                                            class="tournament-bracket__team tournament-bracket__team--winner">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Canada">CAN</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-ca"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">4</span>
                                                            </td>
                                                        </tr>
                                                        <tr class="tournament-bracket__team">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Kazakhstan">KAZ</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-kz"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">1</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>

                                        <li class="tournament-bracket__item">
                                            <div class="tournament-bracket__match" tabindex="0">
                                                <table class="tournament-bracket__table">
                                                    <caption class="tournament-bracket__caption">
                                                        <time datetime="1998-02-18">18 February 1998</time>
                                                    </caption>
                                                    <thead class="sr-only">
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tournament-bracket__content">
                                                        <tr
                                                            class="tournament-bracket__team tournament-bracket__team--winner">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Czech Republic">CZE</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-cz"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">4</span>
                                                            </td>
                                                        </tr>
                                                        <tr class="tournament-bracket__team">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Unitede states of America">USA</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-us"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">1</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>
                                        <li class="tournament-bracket__item">
                                            <div class="tournament-bracket__match" tabindex="0">
                                                <table class="tournament-bracket__table">
                                                    <caption class="tournament-bracket__caption">
                                                        <time datetime="1998-02-18">18 February 1998</time>
                                                    </caption>
                                                    <thead class="sr-only">
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tournament-bracket__content">
                                                        <tr
                                                            class="tournament-bracket__team tournament-bracket__team--winner">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Finland">FIN</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-fi"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">2</span>
                                                            </td>
                                                        </tr>
                                                        <tr class="tournament-bracket__team">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Sweden">SVE</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-se"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">1</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>

                                        <li class="tournament-bracket__item">
                                            <div class="tournament-bracket__match" tabindex="0">
                                                <table class="tournament-bracket__table">
                                                    <caption class="tournament-bracket__caption">
                                                        <time datetime="1998-02-18">18 February 1998</time>
                                                    </caption>
                                                    <thead class="sr-only">
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tournament-bracket__content">
                                                        <tr
                                                            class="tournament-bracket__team tournament-bracket__team--winner">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Russia">RUS</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-ru"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">4</span>
                                                            </td>
                                                        </tr>
                                                        <tr class="tournament-bracket__team">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Belarus">BEL</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-by"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">1</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tournament-bracket__round tournament-bracket__round--semifinals">
                                    <h3 class="tournament-bracket__round-title">Semifinals</h3>
                                    <ul class="tournament-bracket__list">
                                        <li class="tournament-bracket__item">
                                            <div class="tournament-bracket__match" tabindex="0">
                                                <table class="tournament-bracket__table">
                                                    <caption class="tournament-bracket__caption">
                                                        <time datetime="1998-02-20">20 February 1998</time>
                                                    </caption>
                                                    <thead class="sr-only">
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tournament-bracket__content">
                                                        <tr class="tournament-bracket__team">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Canada">CAN</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-ca"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">1</span>
                                                            </td>
                                                        </tr>
                                                        <tr
                                                            class="tournament-bracket__team tournament-bracket__team--winner">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Czech Republic">CZE</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-cz"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">2</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>

                                        <li class="tournament-bracket__item">
                                            <div class="tournament-bracket__match" tabindex="0">
                                                <table class="tournament-bracket__table">
                                                    <caption class="tournament-bracket__caption">
                                                        <time datetime="1998-02-20">20 February 1998</time>
                                                    </caption>
                                                    <thead class="sr-only">
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tournament-bracket__content">
                                                        <tr class="tournament-bracket__team">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Finland">FIN</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-fi"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">4</span>
                                                            </td>
                                                        </tr>
                                                        <tr
                                                            class="tournament-bracket__team tournament-bracket__team--winner">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Russia">RUS</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-ru"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">7</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tournament-bracket__round tournament-bracket__round--bronze">
                                    <h3 class="tournament-bracket__round-title">Bronze medal game</h3>
                                    <ul class="tournament-bracket__list">
                                        <li class="tournament-bracket__item">
                                            <div class="tournament-bracket__match" tabindex="0">
                                                <table class="tournament-bracket__table">
                                                    <caption class="tournament-bracket__caption">
                                                        <time datetime="1998-02-21">21 February 1998</time>
                                                    </caption>
                                                    <thead class="sr-only">
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tournament-bracket__content">
                                                        <tr
                                                            class="tournament-bracket__team tournament-bracket__team--winner">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Finland">FIN</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-fi"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">3</span>
                                                                <span
                                                                    class="tournament-bracket__medal tournament-bracket__medal--bronze fa fa-trophy"
                                                                    aria-label="Bronze medal"></span>
                                                            </td>
                                                        </tr>
                                                        <tr class="tournament-bracket__team">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Canada">CAN</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-ca"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">2</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tournament-bracket__round tournament-bracket__round--gold">
                                    <h3 class="tournament-bracket__round-title">Gold medal game</h3>
                                    <ul class="tournament-bracket__list">
                                        <li class="tournament-bracket__item">
                                            <div class="tournament-bracket__match" tabindex="0">
                                                <table class="tournament-bracket__table">
                                                    <caption class="tournament-bracket__caption">
                                                        <time datetime="1998-02-22">22 February 1998</time>
                                                    </caption>
                                                    <thead class="sr-only">
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tournament-bracket__content">
                                                        <tr
                                                            class="tournament-bracket__team tournament-bracket__team--winner">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Czech Republic">CZE</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-cz"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">1</span>
                                                                <span
                                                                    class="tournament-bracket__medal tournament-bracket__medal--gold fa fa-trophy"
                                                                    aria-label="Gold medal"></span>
                                                            </td>
                                                        </tr>
                                                        <tr class="tournament-bracket__team">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Russia">RUS</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-ru"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">0</span>
                                                                <span
                                                                    class="tournament-bracket__medal tournament-bracket__medal--silver fa fa-trophy"
                                                                    aria-label="Silver medal"></span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tournament-bracket tournament-bracket--rounded">

                                <div class="tournament-bracket__round tournament-bracket__round--quarterfinals">
                                    <h3 class="tournament-bracket__round-title">Quarterfinals</h3>
                                    <ul class="tournament-bracket__list">
                                        <li class="tournament-bracket__item">
                                            <div class="tournament-bracket__match" tabindex="0">
                                                <table class="tournament-bracket__table">
                                                    <caption
                                                        class="tournament-bracket__caption d-flex justify-content-center">
                                                        <time datetime="1998-02-18">18 February 1998</time>
                                                    </caption>
                                                    <thead class="sr-only">
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tournament-bracket__content">
                                                        <tr
                                                            class="tournament-bracket__team tournament-bracket__team--winner">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Canada">CAN</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-ca"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">4</span>
                                                            </td>
                                                        </tr>
                                                        <tr class="tournament-bracket__team">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Kazakhstan">KAZ</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-kz"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">1</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>

                                        <li class="tournament-bracket__item">
                                            <div class="tournament-bracket__match" tabindex="0">
                                                <table class="tournament-bracket__table">
                                                    <caption class="tournament-bracket__caption">
                                                        <time datetime="1998-02-18">18 February 1998</time>
                                                    </caption>
                                                    <thead class="sr-only">
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tournament-bracket__content">
                                                        <tr
                                                            class="tournament-bracket__team tournament-bracket__team--winner">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Czech Republic">CZE</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-cz"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">4</span>
                                                            </td>
                                                        </tr>
                                                        <tr class="tournament-bracket__team">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Unitede states of America">USA</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-us"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">1</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>
                                        <li class="tournament-bracket__item">
                                            <div class="tournament-bracket__match" tabindex="0">
                                                <table class="tournament-bracket__table">
                                                    <caption class="tournament-bracket__caption">
                                                        <time datetime="1998-02-18">18 February 1998</time>
                                                    </caption>
                                                    <thead class="sr-only">
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tournament-bracket__content">
                                                        <tr
                                                            class="tournament-bracket__team tournament-bracket__team--winner">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Finland">FIN</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-fi"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">2</span>
                                                            </td>
                                                        </tr>
                                                        <tr class="tournament-bracket__team">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Sweden">SVE</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-se"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">1</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>

                                        <li class="tournament-bracket__item">
                                            <div class="tournament-bracket__match" tabindex="0">
                                                <table class="tournament-bracket__table">
                                                    <caption class="tournament-bracket__caption">
                                                        <time datetime="1998-02-18">18 February 1998</time>
                                                    </caption>
                                                    <thead class="sr-only">
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tournament-bracket__content">
                                                        <tr
                                                            class="tournament-bracket__team tournament-bracket__team--winner">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Russia">RUS</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-ru"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">4</span>
                                                            </td>
                                                        </tr>
                                                        <tr class="tournament-bracket__team">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Belarus">BEL</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-by"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">1</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tournament-bracket__round tournament-bracket__round--semifinals">
                                    <h3 class="tournament-bracket__round-title">Semifinals</h3>
                                    <ul class="tournament-bracket__list">
                                        <li class="tournament-bracket__item">
                                            <div class="tournament-bracket__match" tabindex="0">
                                                <table class="tournament-bracket__table">
                                                    <caption class="tournament-bracket__caption">
                                                        <time datetime="1998-02-20">20 February 1998</time>
                                                    </caption>
                                                    <thead class="sr-only">
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tournament-bracket__content">
                                                        <tr class="tournament-bracket__team">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Canada">CAN</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-ca"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">1</span>
                                                            </td>
                                                        </tr>
                                                        <tr
                                                            class="tournament-bracket__team tournament-bracket__team--winner">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Czech Republic">CZE</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-cz"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">2</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>

                                        <li class="tournament-bracket__item">
                                            <div class="tournament-bracket__match" tabindex="0">
                                                <table class="tournament-bracket__table">
                                                    <caption class="tournament-bracket__caption">
                                                        <time datetime="1998-02-20">20 February 1998</time>
                                                    </caption>
                                                    <thead class="sr-only">
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tournament-bracket__content">
                                                        <tr class="tournament-bracket__team">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Finland">FIN</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-fi"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">4</span>
                                                            </td>
                                                        </tr>
                                                        <tr
                                                            class="tournament-bracket__team tournament-bracket__team--winner">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Russia">RUS</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-ru"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">7</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tournament-bracket__round tournament-bracket__round--bronze">
                                    <h3 class="tournament-bracket__round-title">Bronze medal game</h3>
                                    <ul class="tournament-bracket__list">
                                        <li class="tournament-bracket__item">
                                            <div class="tournament-bracket__match" tabindex="0">
                                                <table class="tournament-bracket__table">
                                                    <caption class="tournament-bracket__caption">
                                                        <time datetime="1998-02-21">21 February 1998</time>
                                                    </caption>
                                                    <thead class="sr-only">
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tournament-bracket__content">
                                                        <tr
                                                            class="tournament-bracket__team tournament-bracket__team--winner">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Finland">FIN</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-fi"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">3</span>
                                                                <span
                                                                    class="tournament-bracket__medal tournament-bracket__medal--bronze fa fa-trophy"
                                                                    aria-label="Bronze medal"></span>
                                                            </td>
                                                        </tr>
                                                        <tr class="tournament-bracket__team">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Canada">CAN</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-ca"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">2</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tournament-bracket__round tournament-bracket__round--gold">
                                    <h3 class="tournament-bracket__round-title">Gold medal game</h3>
                                    <ul class="tournament-bracket__list">
                                        <li class="tournament-bracket__item">
                                            <div class="tournament-bracket__match" tabindex="0">
                                                <table class="tournament-bracket__table">
                                                    <caption class="tournament-bracket__caption">
                                                        <time datetime="1998-02-22">22 February 1998</time>
                                                    </caption>
                                                    <thead class="sr-only">
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tournament-bracket__content">
                                                        <tr
                                                            class="tournament-bracket__team tournament-bracket__team--winner">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Czech Republic">CZE</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-cz"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">1</span>
                                                                <span
                                                                    class="tournament-bracket__medal tournament-bracket__medal--gold fa fa-trophy"
                                                                    aria-label="Gold medal"></span>
                                                            </td>
                                                        </tr>
                                                        <tr class="tournament-bracket__team">
                                                            <td class="tournament-bracket__country">
                                                                <abbr class="tournament-bracket__code"
                                                                    title="Russia">RUS</abbr>
                                                                <span
                                                                    class="tournament-bracket__flag flag-icon flag-icon-ru"
                                                                    aria-label="Flag"></span>
                                                            </td>
                                                            <td class="tournament-bracket__score">
                                                                <span class="tournament-bracket__number">0</span>
                                                                <span
                                                                    class="tournament-bracket__medal tournament-bracket__medal--silver fa fa-trophy"
                                                                    aria-label="Silver medal"></span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =================================MODAL===================================== --}}
    <!-- Modal New Group-->
    <div class="modal fade text-white" id="new_group" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: rgba(35, 42, 92);">
                <div class="modal-header ">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">New Group for tournament</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-white">
                    <form action="{{ route('group.create') }}" id="frmNewGroup" method="POST">
                        @csrf
                        <input type="hidden" name="league_id" value="{{ $tournament->id }}">
                        <input type="hidden" readonly id="inputStageId" name="stage_id">
                        <div class="form-group">
                            <label for="groupName">Group name *:</label>
                            <input type="text" class="text-white" id="groupName" name="name" value=""
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmNewGroup" class="btn btn-primary">Add new group</button>
                </div>
            </div>
        </div>
    </div>
    {{-- =================================/MODAL===================================== --}}


    {{-- =================================/Hidden===================================== --}}
    <form action="/test" id="frmDeleteStage" method="POST">
        @csrf
        <input type="hidden" name="league_id" value="">
    </form>
    <input type="hidden" id="collection-type" value="{{ $tournament->type_show }}">
    {{-- =================================/Hidden===================================== --}}


    <!-- ===========Collection Section Ends Here========== -->
@endsection

@section('js')
    <script>
        const newGroupModal = document.getElementById('new_group')
        newGroupModal.addEventListener('show.bs.modal', event => {

            const button = event.relatedTarget

            const recipient = button.getAttribute('data-bs-whatever')

            const modelInputStageId = newGroupModal.querySelector('.modal-body input[name=stage_id]')

            modelInputStageId.value = recipient
        })
    </script>
    <script>
        $(window).on('load', function() {
            const typeCollection = $('#collection-type').val();

            $('.collection-about').addClass('is-checked');

            var $grid = $('.collection-grid').isotope({
                itemSelector: '.gameListItem',
                layoutMode: 'fitRows',
            });

            $grid.isotope({
                filter: `.collection-${typeCollection}`
            });
        })

        function deleteStage(id) {

            Swal.fire({
                title: 'Bạn muốn xóa giai đoạn này?',
                iconHtml: '<img src="https://i.pinimg.com/originals/ff/fa/9b/fffa9b880767231e0d965f4fc8651dc2.gif" style="max-width: 12rem" alt="icon-delete"/>',
                showDenyButton: true,
                showCancelButton: true,
                showConfirmButton: false,
                denyButtonText: `Xóa`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isDenied) {
                    $('#frmDeleteStage-' + id).submit();
                }
            })

        }
    </script>
@endsection
