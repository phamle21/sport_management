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
        <span class="fw-semibold">{{ $paginator->total() }}</span>
        @lang('pagination.results')
    </p>
@endif
