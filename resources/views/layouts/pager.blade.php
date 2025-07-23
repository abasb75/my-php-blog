 @if ($pagination['total_page'] > 1)
    <div id="blog-pager">
        <ul>
            @for ($i = 1; $i <= $pagination['total_page']; $i++)
                <li>
                    <a href="/blog?page={{ $i }}"
                       class="{{ $pagination['current_page'] == $i ? 'active' : '' }}"
                       title="نوشته‌های عباس باقری{{ $i > 1 ? ' - صفحه ' . $i : '' }}">
                        <span>{{ $i }}</span>
                    </a>
                </li>
            @endfor
        </ul>
    </div>
@endif