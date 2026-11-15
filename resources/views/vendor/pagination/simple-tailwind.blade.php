@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex gap-2 items-center justify-between text-xs">

        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center px-3 py-1.5 font-medium text-gray-400 bg-white border border-gray-200 cursor-not-allowed rounded-lg">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center px-3 py-1.5 font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-brand-50 hover:text-brand-400 hover:border-brand-200 transition">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center px-3 py-1.5 font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-brand-50 hover:text-brand-400 hover:border-brand-200 transition">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="inline-flex items-center px-3 py-1.5 font-medium text-gray-400 bg-white border border-gray-200 cursor-not-allowed rounded-lg">
                {!! __('pagination.next') !!}
            </span>
        @endif

    </nav>
@endif
