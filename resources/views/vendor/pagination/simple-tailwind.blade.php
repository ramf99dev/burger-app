@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span
                class="relative my-1.5 flex cursor-pointer items-center rounded-lg bg-gradient-to-tr from-gray-400 to-gray-400 px-3 py-2 font-medium text-white opacity-50 shadow transition-colors">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                class="relative my-1.5 mr-3 flex cursor-pointer items-center rounded-lg bg-gradient-to-tr from-yellow-400 to-yellow-400 px-3 py-2 font-medium text-white shadow transition-colors hover:scale-110">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                class="relative my-1.5 mr-3 flex cursor-pointer items-center rounded-lg bg-gradient-to-tr from-yellow-400 to-yellow-400 px-3 py-2 font-medium text-white shadow transition-colors hover:scale-110">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span
                class="relative my-1.5 flex cursor-pointer items-center rounded-lg bg-gradient-to-tr from-gray-400 to-gray-400 px-3 py-2 font-medium text-white opacity-50 shadow transition-colors">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
