<div class="paginaction--section">
    <nav aria-label="...">
        <ul class="pagination">
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $paginator->onFirstPage() ? 'true' : 'false' }}">&laquo;</a>
            </li>

            @php
            $currentPage = $paginator->currentPage();
            $lastPage = $paginator->lastPage();
            $range = 5; // Change this to set the range of visible page links
            $start = max(1, $currentPage - $range);
            $end = min($lastPage, $currentPage + $range);
            @endphp

            @for ($page = $start; $page <= $end; $page++)
                <li class="page-item {{ $paginator->currentPage() == $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                </li>
            @endfor

            <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
            </li>
        </ul>
    </nav>
    <div class="sholing--sec">
        <span>Showing</span>
        <span>{{ (($paginator->currentPage() - 1) * $paginator->perPage()) + 1 }}</span>
        <span>to</span>
        <span>{{ ($paginator->currentPage() == $paginator->lastPage()) ? $paginator->total() : ($paginator->currentPage() * $paginator->perPage()) }}</span>
        <span>of</span>
        <span>{{ $paginator->total() }}</span>
        <span> entries</span>
    </div>
</div>
