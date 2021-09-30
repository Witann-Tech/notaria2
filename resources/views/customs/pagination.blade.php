@if ($paginator->hasPages())
    <nav class="app-pagination mt-5">
        <ul class="pagination justify-content-center">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1"
                        aria-disabled="true">Anterior</a>
                </li>
            @endif

            <?php $paginator->hasMorePages(); ?>

            @foreach ($elements as $element)

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link"
                                    href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif

                @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">Siguiente</a></li>
                @else
                <li class="page-item disabled"><a class="page-link" href="#">Siguiente</a></li>
                @endif

            @endforeach
        </ul>
    </nav>
@endif
