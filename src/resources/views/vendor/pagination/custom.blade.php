@if ($paginator->hasPages())
    <nav class="pagination-area text-center mt-4">
        <ul class="inline-flex list-none p-0 m-0">
            {{-- 前へ --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-2 py-1 text-xs text-gray-400 border rounded-l cursor-not-allowed">&lt;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="px-2 py-1 text-xs text-gray-700 border rounded-l hover:bg-gray-100">&lt;</a>
                </li>
            @endif

            {{-- ページ番号 --}}
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                @if ($i == $paginator->currentPage())
                    <li>
                        <span class="px-2 py-1 text-xs font-medium text-white bg-blue-500 border">{{ $i }}</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $paginator->url($i) }}" class="px-2 py-1 text-xs text-gray-700 border hover:bg-gray-100">{{ $i }}</a>
                    </li>
                @endif
            @endfor

            {{-- 次へ --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="px-2 py-1 text-xs text-gray-700 border rounded-r hover:bg-gray-100">&gt;</a>
                </li>
            @else
                <li>
                    <span class="px-2 py-1 text-xs text-gray-400 border rounded-r cursor-not-allowed">&gt;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
