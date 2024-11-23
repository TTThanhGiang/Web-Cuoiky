@if ($paginator->hasPages())
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="prev-arrow disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                </a>
            @else
                <a class="prev-arrow" href="{{ $paginator->previousPageUrl() }}"  aria-label="@lang('pagination.previous')">
                    <i class="fa fa-long-arrow-left"></i>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a class="active" aria-disabled="true"><span class="">{{ $element }}</span></a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                                <a class="active" aria-current="page">{{ $page }}</a>
                        @else
                                <a class="" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="next-arrow" href="{{ $paginator->nextPageUrl() }}" aria-label="@lang('pagination.next')">
                    <i class="fa fa-long-arrow-right"></i>
                </a>
            @else
                <a class="next-arrow disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                </a>
            @endif

@endif
