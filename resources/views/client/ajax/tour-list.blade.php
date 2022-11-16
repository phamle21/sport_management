<article>
    <div class="shop-title d-flex flex-wrap justify-content-between">
        <div class="widget widget-search">
            <form action="/" class="search-wrapper">
                <input type="text" name="s" placeholder="Search Here...">
                <button type="submit"><i class="icofont-search-2"></i></button>
            </form>
        </div>
    </div>
    <div class="shop-title d-flex flex-wrap justify-content-between">
        <p>Showing 01 - 12 of 139 Results</p>
        <div class="product-view-mode">
            <a class="active" data-target="grid"><i class="icofont-ghost"></i></a>
            <a data-target="list"><i class="icofont-listine-dots"></i></a>
        </div>
    </div>
    <div class="shop-product-wrap grid row justify-content-center g-4">
        @foreach ($tour_list as $tournament)
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
                            <img src="{{ asset($tournament->logo) }}" style="width: 150px;" alt="shop">
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
    <ul class="default-pagination lab-ul">
        <li>
            <a href="#"><i class="icofont-rounded-left"></i></a>
        </li>
        <li>
            <a href="#">01</a>
        </li>
        <li>
            <a href="#" class="active">02</a>
        </li>
        <li>
            <a href="#">03</a>
        </li>
        <li>
            <a href="#"><i class="icofont-rounded-right"></i></a>
        </li>
    </ul>
</article>
