@if ($paginator->hasPages())
<div class="row">
    <div class="col-xxl-12">
        <div class="basic-pagination wow fadeInUp mt-30" data-wow-delay=".2s">
            <ul class="d-flex align-items-center">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="prev disabled" aria-disabled="true">
                        <span class="link-btn link-prev">
                            Prev
                            <i class="fal fa-long-arrow-left"></i>
                            <i class="fal fa-long-arrow-left"></i>
                        </span>
                    </li>
                @else
                    <li class="prev">
                        <a href="{{ $paginator->previousPageUrl() }}" class="link-btn link-prev">
                            Prev
                            <i class="fal fa-long-arrow-left"></i>
                            <i class="fal fa-long-arrow-left"></i>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                    @endif

                    {{-- Page Number Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active">
                                    <a href="#"><span>{{ $page }}</span></a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}"><span>{{ $page }}</span></a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="next">
                        <a href="{{ $paginator->nextPageUrl() }}" class="link-btn">
                            Next
                            <i class="fal fa-long-arrow-right"></i>
                            <i class="fal fa-long-arrow-right"></i>
                        </a>
                    </li>
                @else
                    <li class="next disabled" aria-disabled="true">
                        <span class="link-btn">
                            Next
                            <i class="fal fa-long-arrow-right"></i>
                            <i class="fal fa-long-arrow-right"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
@endif
