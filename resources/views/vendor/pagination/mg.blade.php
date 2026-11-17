@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex items-center justify-center gap-2 flex-wrap">
        @if ($paginator->onFirstPage())
            <span class="mg-chip !px-4 opacity-40 cursor-not-allowed"><i class="fa-solid fa-chevron-right text-xs"></i></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="mg-chip !px-4" aria-label="السابق"><i class="fa-solid fa-chevron-right text-xs"></i></a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-2 text-[#164E63]/50 font-bold">{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="mg-chip is-active !px-4 cursor-default" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="mg-chip !px-4">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="mg-chip !px-4" aria-label="التالي"><i class="fa-solid fa-chevron-left text-xs"></i></a>
        @else
            <span class="mg-chip !px-4 opacity-40 cursor-not-allowed"><i class="fa-solid fa-chevron-left text-xs"></i></span>
        @endif
    </nav>
@endif
