@if ($paginator->hasPages())
    <div class="pagination" style="--i: 3">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="page arrow-btn disabled">
                <img src="{{ asset('icons/black/angle-left.svg') }}" alt="icon">
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page arrow-btn">
                <img src="{{ asset('icons/black/angle-left.svg') }}" alt="icon">
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            @if ($page == $paginator->currentPage())
                <span class="page active">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="page">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page arrow-btn">
                <img src="{{ asset('icons/black/angle-right.svg') }}" alt="icon">
            </a>
        @else
            <span class="page arrow-btn disabled">
                <img src="{{ asset('icons/black/angle-right.svg') }}" alt="icon">
            </span>
        @endif
    </div>
@endif
