@if ($paginator->hasPages())
    <style>
        .paginate-link-disable {
            background: rgb(123, 123, 123) !important;
        }
    </style>
    <nav class="d-flex justify-items-center justify-content-center">
        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-center">
            <div>
                <ul class="default-pagination lab-ul">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <a class="paginate-link-disable" aria-hidden="true"><i class="icofont-rounded-left"></i></a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="paginate-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                                aria-label="@lang('pagination.previous')"><i class="icofont-rounded-left"></i></a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true">
                                <a class="paginate-link-disable active">{{ $element }}</a>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page">
                                        <a class="paginate-link-disable active">{{ $page }}</a>
                                    </li>
                                @else
                                    <li class="page-item"><a class="paginate-link"
                                            href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="paginate-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                                aria-label="@lang('pagination.next')"><i class="icofont-rounded-right"></i></a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <a class="paginate-link-disable active" aria-hidden="true"><i class="icofont-rounded-right"></i></a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
