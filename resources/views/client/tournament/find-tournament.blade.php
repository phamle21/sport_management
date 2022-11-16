@extends('client.master.template')

@section('body_content')
    <div class="shop-page pt-5 padding-bottom">
        <div class="container">
            <div class="row justify-content-center pb-15">
                <div class="col">
                    <article>
                        <div class="shop-title d-flex flex-wrap justify-content-between">
                            <div class="widget widget-search header-search">
                                <form action="{{ route('tournament.find') }}" id="frmSearchTournament" class="search-wrapper"
                                    method="GET">
                                    <input type="text" name="search"
                                        value="@if (Request::get('search') != null) {{ Request::get('search') }} @endif">
                                    <button form="frmSearchTournament" type="submit"><i
                                            class="icofont-search-2"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="shop-title d-flex flex-wrap justify-content-between">
                            {!! $tournaments->withQueryString()->links('vendor.pagination.header-showing') !!}

                            <div class="product-view-mode">
                                <a class="active" data-target="grid"><i class="icofont-ghost"></i></a>
                                <a data-target="list"><i class="icofont-listine-dots"></i></a>
                            </div>
                        </div>
                        <div class="shop-product-wrap grid row justify-content-center g-4" id="search-suggest">
                            @foreach ($tournaments as $tournament)
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <div class="pro-thumb">
                                                <img src="{{ asset($tournament->logo) }}" alt="shop">
                                            </div>
                                            <div class="product-action-link">
                                                <a class="view-modal" data-target="#quick_view"
                                                    onclick="previewTourDetails({{ $tournament->id }})">
                                                    <i class="icofont-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h5>
                                                <a href="{{ route('tournament.details', ['id' => $tournament->id]) }}">
                                                    {{ $tournament->name }}
                                                </a>
                                            </h5>
                                            <p>
                                                {{ date('d/m/Y', strtotime($tournament->start)) }}
                                                &nbsp;&nbsp;-&nbsp;&nbsp;
                                                {{ date('d/m/Y', strtotime($tournament->end)) }}
                                            </p>
                                            <b>
                                                <i class="fa-duotone fa-trophy"></i> &nbsp;&nbsp;
                                                {!! $tournament->type()->name !!}&nbsp;&nbsp;
                                                <i class="fa-duotone fa-trophy"></i>
                                            </b>
                                        </div>
                                    </div>
                                    <div class="product-list-item">
                                        <div class="product-thumb">
                                            <div class="pro-thumb  text-center">
                                                <img src="{{ asset($tournament->logo) }}" style="width: 150px;"
                                                    alt="shop">
                                            </div>
                                            <div class="product-action-link">
                                                <a class="view-modal" data-target="#quick_view"
                                                    onclick="previewTourDetails({{ $tournament->id }})">
                                                    <i class="icofont-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3>
                                                <a href="{{ route('tournament.details', ['id' => $tournament->id]) }}">
                                                    {{ $tournament->name }}
                                                </a>
                                            </h3>
                                            <p>
                                                {{ __('message.tournament.details.about-startat') }}:
                                                {{ date('d/m/Y', strtotime($tournament->start)) }}
                                                &nbsp;&nbsp;-&nbsp;&nbsp;
                                                {{ __('message.tournament.details.about-endat') }}:
                                                {{ date('d/m/Y', strtotime($tournament->end)) }}
                                            </p>
                                            <p>{{ __('message.tournament.details.about-typename') }}:
                                                {!! $tournament->type()->name !!} </p>
                                            <p>{{ __('message.tournament.details.about-des') }}: {!! $tournament->description !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {!! $tournaments->withQueryString()->links('vendor.pagination.tournament') !!}


                    </article>
                </div>
            </div>
            <div class="modal" id="quick_view">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal"><i class="icofont-close"></i></button>
                        <div class="modal-body">
                            <div class="product-details-inner">
                                <div class="row align-items-center">
                                    <div class="col-lg-5 col-12">
                                        <div class="thumb text-center">
                                            <div class="pro-thumb " id="modal-tour-logo">
                                                <img src="https://media-exp1.licdn.com/dms/image/C5612AQFp-16zT8z5-Q/article-inline_image-shrink_1000_1488/0/1575902798333?e=1673481600&v=beta&t=raXSeTkzkKPVao-ddfdzW1Uz1ns0lN7g894tgGzutLo"
                                                    alt="shop">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="product-content">
                                            <h3><a href="#" id="modal-tour-name"></a></h3>
                                            <p>
                                                {{ __('message.tournament.details.about-startat') }}:
                                                <span id="modal-tour-start"></span>
                                                &nbsp;&nbsp;-&nbsp;&nbsp;
                                                {{ __('message.tournament.details.about-endat') }}:
                                                <span id="modal-tour-end"></span>
                                            </p>
                                            <p>{{ __('message.tournament.details.about-typename') }}:
                                                <span id="modal-tour-type"></span>
                                            </p>
                                            <p>{{ __('message.tournament.details.about-des') }}:
                                                <span id="modal-tour-des"></span>
                                            </p>
                                            <ul class="d-flex flex-wrap justify-content-center player-meta mb-0">
                                                <li class="d-flex align-items-center">
                                                    <span class="left me-3"><i
                                                            class="fa-regular fa-diagram-sankey"></i></span>
                                                    <span class="right"
                                                        id="modal-tour-stage"></span>
                                                    &nbsp;{{ __('message.tournament.details.total-stage') }}
                                                </li>
                                                <li class="d-flex align-items-center">
                                                    <span class="left me-3"><i
                                                            class="fa-solid fa-users-rectangle"></i></span>
                                                    <span class="right"
                                                        id="modal-tour-group"></span>
                                                    &nbsp;{{ __('message.tournament.details.total-group') }}
                                                </li>
                                                <li class="d-flex align-items-center">
                                                    <span class="left me-3"><i class="icofont-game"></i></span>
                                                    <span class="right"
                                                        id="modal-tour-match"></span>
                                                    &nbsp;{{ __('message.tournament.details.total-match') }}
                                                </li>
                                                <li class="d-flex align-items-center">
                                                    <span class="left me-3"><i class="icofont-workers-group"></i></span>
                                                    <span class="right"
                                                        id="modal-tour-team"></span>
                                                    &nbsp;{{ __('message.tournament.details.total-team') }}
                                                </li>
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
@endsection

@section('js')
    {{-- Modal details --}}
    <script>
        function previewTourDetails(id) {

            $('#modal-tour-logo img').attr('src',
                'https://media-exp1.licdn.com/dms/image/C5612AQFp-16zT8z5-Q/article-inline_image-shrink_1000_1488/0/1575902798333?e=1673481600&v=beta&t=raXSeTkzkKPVao-ddfdzW1Uz1ns0lN7g894tgGzutLo'
            );
            $('#modal-tour-name').html('').attr('href', `#`);
            $('#modal-tour-start').html('');
            $('#modal-tour-end').html('');
            $('#modal-tour-des').html('');
            $('#modal-tour-type').html('');
            $('#modal-tour-stage').html('');
            $('#modal-tour-group').html('');
            $('#modal-tour-match').html('');
            $('#modal-tour-team').html('');

            $.ajax({
                type: 'Get',
                url: `/api/tournament/${id}/details`,
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        console.log(data)
                        const tournament = data
                        const {
                            logo,
                            name,
                            id,
                            start,
                            end,
                            description,
                            typeName,
                            totalStage,
                            totalGroup,
                            totalMatch,
                            totalTeam
                        } = tournament;

                        $('#modal-tour-logo img').attr('src', logo);
                        $('#modal-tour-name').html(name).attr('href', `/tournament/${id}/details`);
                        $('#modal-tour-start').html(start);
                        $('#modal-tour-end').html(end);
                        $('#modal-tour-des').html(description);
                        $('#modal-tour-type').html(typeName);
                        $('#modal-tour-stage').html(totalStage);
                        $('#modal-tour-group').html(totalGroup);
                        $('#modal-tour-match').html(totalMatch);
                        $('#modal-tour-team').html(totalTeam);
                    } else {
                        printErrorMsg(data.error);
                    }
                }
            });
        }
    </script>

    {{-- Search --}}
    <script type="text/javascript">
        $('#frmSearchTournament').on('keyup', function() {
            var search = $(this).serialize();
            if ($(this).find('.m-input').val() == '') {
                $('#search-suggest div').hide();
            } else {
                $.ajax({
                        url: '/search',
                        type: 'POST',
                        data: search,
                    })
                    .done(function(res) {
                        $('#search-suggest').html('');
                        $('#search-suggest').append(res)
                    })
            };
        });
    </script>
@endsection
