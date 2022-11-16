@if ($paginator->hasPages())
    <p class="small text-white">
        @lang('pagination.Showing')
        <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
        @lang('pagination.to')
        <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
        @lang('pagination.of')
        <span class="fw-semibold">{{ $paginator->total() }}</span>
        @lang('pagination.results')
    </p>
@else
    <p class="small text-white">
        @lang('pagination.Showing')
        @lang('pagination.all')
        <span class="fw-semibold">{{ isset($paginator) ? $paginator->total() : 0 }}</span>
        @lang('pagination.results')
        @if (Request::get('search') != null)
            @lang('pagination.with')
            <b>{{ Request::get('search') }}</b>
        @endif
    </p>
@endif
