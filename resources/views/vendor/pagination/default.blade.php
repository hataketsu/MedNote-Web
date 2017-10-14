@if ($paginator->hasPages())
    <div class="ui center aligned container">

        <div class="ui basic buttons">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="ui disabled button"><span>&laquo;</span></a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="ui button">&laquo;</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a class="ui disabled button"><span>{{ $element }}</span></a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="ui active button"><span>{{ $page }}</span></a>
                        @else
                            <a href="{{ $url }}" class="ui button">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="ui button">&raquo;</a></li>
            @else
                <a class="ui disabled button"><span>&raquo;</span></a>
            @endif
        </div>
    </div>
@endif
