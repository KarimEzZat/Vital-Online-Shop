@if ($paginator->hasPages())
    <nav class="pagination align-center" >
        {{-- Previous Page Link --}}


        {{-- Pagination Elements --}}
        @foreach ($elements as $element)

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="page-numbers bg-border-color current"><span>{{ $page }}</span></a>
                    @else
                        <a href="{{ $url }}" class="page-numbers bg-border-color"><span>{{ $page }}</span></a>
                    @endif
                @endforeach
            @endif
        @endforeach

    </nav>
@endif