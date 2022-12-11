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
    <style>
        .select2-container {
            width: 100% !important;
            color: white !important;
        }

        .select2-selection {
            -webkit-border-radius: 3px !important;
            -moz-border-radius: 3px !important;
            border-radius: 3px !important;
            outline: none !important;
            border: 1px solid rgba(255, 255, 255, .1) !important;
            background: rgba(255, 255, 255, .1) !important;
            color: white !important;
        }

        .select2-selection__rendered,
        .select2-search__field {
            color: white !important;

        }

        .select2-dropdown--below {
            background: #282b48 !important;

        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.3.1/css/flag-icon.min.css">
    <link rel="stylesheet/less" type="text/css" href="/assets/css/tournament-bracket.less" />
    <script src="https://cdn.jsdelivr.net/npm/less"></script>

    <style>
        .form-group select {
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 4px;
            box-shadow: 0px 2px 4px 0px rgb(0 0 0 / 6%);
            height: 57px;
            padding: 0;
            background: rgba(35, 42, 92, .5);
            color: #fff;
            padding-left: 2rem;
        }

        .form-group option {
            padding: 5px 0;
            background: rgba(35, 42, 92);
            font-size: 15px;
            padding-left: 2rem;
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

                    <li data-filter=".collection-about">
                        {{ __('message.tournament.details.collection-about') }}</li>
                    <li data-filter=".collection-notify">{{ __('message.tournament.details.collection-notify') }}</li>
                    <li data-filter=".collection-stage">{{ __('message.tournament.details.collection-stage') }}</li>
                    <li data-filter=".collection-group" id="collection-group">
                        {{ __('message.tournament.details.collection-group') }}</li>
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
                                                        <a href="{{ asset($v->link) }}" class="sponsor-item">
                                                            <div class="sponsor-inner">
                                                                <div class="sponsor-thumb text-center">
                                                                    <img src="{{ asset($v->logo) }}" alt="sponsor-thumb">
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach


                                            </div>
                                            @if ($tournament->user_id != Auth::user()->id)
                                                <div class="text-center mt-5">
                                                    <a href="{{ route('sponsor.index', ['league_id' => $tournament->id]) }}"
                                                        class="default-button"><span>{{ __('message.tournament.details.about-btn-susponsor') }}
                                                            <i class="icofont-circled-right"></i></span> </a>
                                                </div>
                                            @endif
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
                        @if ($tournament->user_id == Auth::user()->id)
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
                                                <select name="order" id="frm-order_stage" class="text-white" required>
                                                    <option disabled selected value="-1">
                                                        {{ __('message.tournament.details.stage.create.frm-order') }} *
                                                    </option>
                                                    <option value="0">1</option>
                                                    <option value="1">2</option>
                                                    <option value="2">3</option>
                                                    <option value="3">4</option>
                                                    <option value="4">5</option>
                                                    <option value="5">6</option>
                                                </select>
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
                        @endif
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
                                                {{-- <button class="bg-transparent btn text-white fs-6">
                                                    <i class="fa-duotone fa-pen-to-square"></i>
                                                </button> --}}
                                            </div>
                                            <div class="col">
                                                <h5 class="my-2 text-center">
                                                    {{ $stage->order + 1 }} - {{ $stage->name }}
                                                </h5>
                                            </div>
                                            @if ($tournament->user_id == Auth::user()->id)
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
                                            @endif
                                        </div>
                                        <hr>
                                        @foreach ($stage->groups as $group)
                                            <div class="col-12 px-3 my-2" onclick="gotoCollectionGroup()">
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
                                        @if ($tournament->user_id == Auth::user()->id)
                                            <div class="col-12 px-3 my-2">
                                                <div class="accordion-item d-flex product-action-link">
                                                    <a data-bs-toggle="modal" data-bs-target="#new_group"
                                                        data-bs-whatever="{{ $stage->id }}" style="cursor: pointer;"
                                                        class="accordion-header w-100 view-modal">
                                                        <div
                                                            class="accordion-button accordion-button-2 accordion-button-new collapsed">
                                                            <span class="accor-header-inner d-flex align-items-center">
                                                                <span class="accor-thumb d-flex align-items-center"
                                                                    style="width: fit-content">
                                                                    <i
                                                                        class="fa-duotone fa-plus-large fs-1 text-white"></i>
                                                                </span>
                                                                <span class="accor-title fs-4">Bảng đấu mới</span>
                                                            </span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
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
                                <p>{{ __('message.tournament.details.group.head-sub-1') }}</p>
                                <h2 class="mb-3">{{ __('message.tournament.details.group.head-1') }}</h2>
                            </div>
                        </div>

                        <div class="row g-5 justify-content-center">
                            @foreach ($list_all_group as $group)
                                <div class="col-lg-5 border rounded-3 m-3">
                                    <div class="upcome-matches">
                                        <h3 class="upcome-match-header text-warning">{{ $group->name }} -
                                            {{ $group->stage->name }}</h3>
                                        <div class="row g-3">
                                            @if (count($group->matches) < 1)
                                                <h2 class="text-white">
                                                    {{ __('message.tournament.details.group.match-not-found') }} </h2>
                                            @endif
                                            @foreach ($group->matches as $match)
                                                <div class="col-12">
                                                    <div class="match-item-2 item-layer">
                                                        <div class="match-inner">
                                                            <div
                                                                class="match-header d-flex flex-wrap justify-content-between align-items-center">
                                                                <p class="match-team-info">
                                                                    {{ $group->stage->name }}
                                                                </p>
                                                            </div>
                                                            <div
                                                                class="match-content gradient-bg-{{ \Illuminate\Support\Arr::random(['blue', 'pink', 'orange', 'yellow']) }}">
                                                                <div class="row align-items-center justify-content-center">
                                                                    <div class="col-md-2 col-5 p-0">
                                                                        <div class="match-team-thumb text-center">
                                                                            <a href="team-single.html"
                                                                                class="text-center"><img
                                                                                    src="{{ asset('assets/images/match/teamsm/teamsm-1.png') }}"
                                                                                    alt="team-img"></a>
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-2 d-md-none">
                                                                        <img src="assets/images/match/vs.png"
                                                                            alt="vs">
                                                                    </div>
                                                                    <div class="col-md-2 col-5 order-md-3 p-0">
                                                                        <div class="match-team-thumb text-center">
                                                                            <a href="team-single.html"><img
                                                                                    src="{{ asset('assets/images/match/teamsm/teamsm-2.png') }}"
                                                                                    alt="team-img"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-8 order-md-2 mt-4 mt-md-0">
                                                                        <div class="match-game-info text-center">
                                                                            <h4>
                                                                                <a href="team-single.html">
                                                                                    {{ $match->name }}
                                                                                </a>
                                                                            </h4>
                                                                            <p
                                                                                class="d-flex flex-wrap justify-content-center">
                                                                                <span class="match-date">
                                                                                    {{ date('d/m/Y', strtotime($match->match_date)) }}
                                                                                </span>
                                                                                <span class="match-time">
                                                                                    {{ date('H:m A', strtotime($match->match_date)) }}
                                                                                </span>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if ($tournament->user_id == Auth::user()->id)
                                                <div class="col-12">
                                                    <a data-bs-toggle="modal" data-bs-target="#new-matches"
                                                        data-bs-whatever="{{ $group->id }}" style="cursor: pointer;"
                                                        class="accordion-header w-100 view-modal">
                                                        <div class="match-item-2 item-layer">
                                                            <div class="match-inner">
                                                                <div class="d-flex justidy-content-center match-content"
                                                                    style="background-image: -webkit-radial-gradient(50% 50%, circle closest-side, white 100%, #c2c2c2 340%);">
                                                                    <i class="fa-duotone fa-plus text-dark fs-1"></i>
                                                                    <span class="text-dark fs-4 ms-2">New Matches</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach


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

                        @include('client.tournament.bracket')

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

    <!-- Modal New matches-->
    <div id="new-matches" class="modal fade text-white" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: rgba(35, 42, 92);">
                <div class="modal-header ">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">New matches for group</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-white">
                    <form action="{{ route('matches.create') }}" id="frmNewMatches" method="POST">
                        @csrf
                        <input type="hidden" readonly id="league_id" name="league_id" value="{{ $tournament->id }}">
                        <input type="hidden" readonly id="inputStageId" name="group_id">
                        <i class="text-warning">
                            Bạn có thể đặt sân cho trận đấu thông qua thanh toán online:
                            <a href="#">Đặt sân</a>
                        </i>
                        <div class="form-group my-3">
                            <label for="matchesName">Match date *:</label>
                            <input type="datetime-local" class="text-white" id="matchesName" name="match_date" required>
                        </div>

                        <div class="form-group my-3">
                            <label for="team">Team *:</label>
                            <select name="team_id" id="team">
                            </select>
                        </div>

                        <div class="form-group my-3">
                            <label for="opposing-team">Opposing team *:</label>
                            <select name="team_opposing_id" id="opposing-team">
                            </select>
                            <small>
                                <i>Nếu không có team nào hãy thêm team cho mùa giải của bạn:
                                    <u><a href="{{ route('team.create') }}">Tạo team</a></u>
                                </i>
                            </small>
                        </div>

                        <div class="form-group my-3">
                            <label for="location">Location :</label>
                            <input type="text" class="text-white" id="location" name="location">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmNewMatches" class="btn btn-primary">Add new group</button>
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
        // New Group
        const newGroupModal = document.getElementById('new_group')
        newGroupModal.addEventListener('show.bs.modal', event => {

            const button = event.relatedTarget

            const recipient = button.getAttribute('data-bs-whatever')

            const modelInputStageId = newGroupModal.querySelector('.modal-body input[name=stage_id]')

            modelInputStageId.value = recipient
        })

        // New Group
        const newMatchesModal = document.getElementById('new-matches')
        newMatchesModal.addEventListener('show.bs.modal', event => {

            const button = event.relatedTarget

            const recipient = button.getAttribute('data-bs-whatever')

            const modelInputStageId2 = newMatchesModal.querySelector('.modal-body input[name=group_id]')

            modelInputStageId2.value = recipient
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
    <script>
        $.ajax({
            method: 'get',
            url: "{{ route('team.list') }}",
            success: function(res) {
                const selectTem = $('#team');
                const selectOpposingTem = $('#opposing-team');
                selectTem.select2({
                    dropdownParent: $("#new-matches")
                });
                selectOpposingTem.select2({
                    dropdownParent: $("#new-matches")
                });
                res.map(team => {
                    selectTem.append(`<option value='${team.id}'>${team.name}</option>`)
                    selectOpposingTem.append(`<option value='${team.id}'>${team.name}</option>`)
                })
            }
        })
    </script>
    <script>
        function gotoCollectionGroup() {
            $('#collection-group').trigger('click')
        }
    </script>
    <script>
        $('#ground').select2({
            dropdownParent: $("#new-matches")
        });
    </script>
@endsection
