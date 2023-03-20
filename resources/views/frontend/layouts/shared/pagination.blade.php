<style>
    .disabled {
        cursor: no-drop;
    }
</style>
@if($paginator->lastPage() > 1)

@php
    if(! in_array($paginator->currentPage(),[1,2,$paginator->lastPage(),$paginator->lastPage()-1])){
        $link_limit = $link_limit-1;
    }
@endphp

<ul>
    <li class="{{ $paginator->currentPage() == 1 ? 'disabled' : ''}}">
        <a
            @if ($paginator->currentPage() != 1)
                href="{{$paginator->url($paginator->currentPage() - 1)}}"
            @endif
            aria-label="Previous">
            <i class="fa-solid fa-angle-left"></i>
        </a>
    </li>

    <li class="{{ in_array($paginator->currentPage(),[1,2])||$paginator->lastPage() < 5 ? 'd-none' : ''}}">
        <a
            @if ($paginator->currentPage() != 1)
                href="{{$paginator->url(1)}}"
            @endif
            aria-label="Previous">
            1
        </a>
    </li>

    <li class="{{ in_array($paginator->currentPage(),[1,2,3])|| $paginator->lastPage() <= 5 ? 'd-none' : ''}}">
        <i class="fa-solid fa-ellipsis"></i>
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
        <li class="{{ ($paginator->currentPage() == $i) ? 'active' : '' }}">
            <a href="{{ $paginator->url($i) }}">
                {{ $i }}
            </a>
        </li>
        @endfor
    @else
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="{{ ($paginator->currentPage() == $i) ? 'active' : '' }}">
                <a href="{{ $paginator->url($i) }}">
                    {{ $i }}
                </a>
            </li>
        @endfor
    @endif

    <li class="{{in_array($paginator->currentPage(),[$paginator->lastPage(),$paginator->lastPage()-1,$paginator->lastPage()-2])|| $paginator->lastPage() <= 5? 'd-none' : ''}}">
            <i class="fa-solid fa-ellipsis"></i>
    </li>


    <li class="{{in_array($paginator->currentPage(),[$paginator->lastPage(),$paginator->lastPage()-1])|| $paginator->lastPage() < 5? 'd-none' : ''}}">
        <a
            @if ($paginator->currentPage() != $paginator->lastPage())
                href="{{$paginator->url($paginator->lastPage())}}"
            @endif
            aria-label="Next">
            {{ $paginator->lastPage() }}
        </a>
    </li>

    <li class="{{ $paginator->currentPage() == $paginator->lastPage() ? 'disabled' : ''}}">
        <a
            @if ($paginator->currentPage() != $paginator->lastPage())
                href="{{$paginator->url($paginator->currentPage()+1)}}"
            @endif
            aria-label="Next">
            <i class="fa-solid fa-angle-right"></i>
        </a>
    </li>
</ul>
@endif
