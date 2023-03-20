<style>
    .disabled {
        cursor: no-drop;
    }
</style>
@if($paginator->lastPage() > 1)
<ul class="pagination pagination-rounded justify-content-end my-2">
    <li class="page-item {{ $paginator->currentPage() == 1 ? 'disabled' : ''}}">
        <a
            class="page-link"
            @if ($paginator->currentPage() != 1)
                href="{{$paginator->url($paginator->currentPage() - 1)}}"
            @endif
            aria-label="Previous">
            <span aria-hidden="true">«</span>
            <span class="sr-only">Previous</span>
        </a>
    </li>

    @if (isset($link_limit))
        @php
            $half_total_links = floor($link_limit / 2);
            $from = ($paginator->currentPage() - $half_total_links) < 1 ? 1 : $paginator->currentPage() - $half_total_links;
            $to = ($paginator->currentPage() + $half_total_links) > $paginator->lastPage() ? $paginator->lastPage() : ($paginator->currentPage() + $half_total_links);
            if ($from > $paginator->lastPage() - $link_limit) {
                $from = ($paginator->lastPage() - $link_limit) + 1;
                $to = $paginator->lastPage();
            }
            if ($to <= $link_limit) {
                $from = 1;
                $to = $link_limit < $paginator->lastPage() ? $link_limit : $paginator->lastPage();
            }
        @endphp

        @for ($i = $from; $i <= $to; $i++)
        <li class="page-item {{ ($paginator->currentPage() == $i) ? 'active' : '' }}">
            <a class="page-link" href="{{ $paginator->url($i) }}">
                {{ $i }}
            </a>
        </li>
        @endfor
    @else
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="page-item {{ ($paginator->currentPage() == $i) ? 'active' : '' }}">
                <a class="page-link" href="{{ $paginator->url($i) }}">
                    {{ $i }}
                </a>
            </li>
        @endfor
    @endif

    <li class="page-item {{ $paginator->currentPage() == $paginator->lastPage() ? 'disabled' : ''}}">
        <a
            class="page-link"
            @if ($paginator->currentPage() != $paginator->lastPage())
                href="{{$paginator->url($paginator->currentPage()+1)}}"
            @endif
            aria-label="Next">
            <span aria-hidden="true">»</span>
            <span class="sr-only">Next</span>
        </a>
    </li>
</ul>
@endif
