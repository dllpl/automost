@php
    $apiResult = $apiResult ?? [];
	$isPagingable = (!empty(data_get($apiResult, 'links.prev')) || !empty(data_get($apiResult, 'links.next')));
	$paginator = (array)data_get($apiResult, 'links');
	$totalEntries = (int)data_get($apiResult, 'meta.total');
	$currentPage = (int)data_get($apiResult, 'meta.current_page');
	$elements = data_get($apiResult, 'meta.links');
@endphp
@if ($totalEntries > 0 && $isPagingable)
    <style>
        .pagination {
            display: -ms-flexbox;
            flex-wrap: wrap;
            display: flex;
            padding-left: 0;
            list-style: none;
            border-radius: 0.25rem;
        }
    </style>
    <ul class="list-reset pagination__custom" style="display: flex; justify-content: space-between;">
        {{-- Previous Page Link --}}
        @if (!data_get($paginator, 'prev'))
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span aria-hidden="true">Назад</span>
            </li>
        @else
            <li>
                <a class="page-link__custom" href="{{ data_get($paginator, 'prev') }}" rel="prev" data-url="{{ data_get($paginator, 'prev') }}" aria-label="@lang('pagination.previous')">Назад</a>
            </li>
        @endif
        {{-- Pagination Elements --}}
        @if (is_array($elements) && count($elements) > 0)
            @foreach ($elements as $element)
                @continue($loop->first || $loop->last)
                {{-- "Three Dots" Separator --}}
                @if (!data_get($element, 'url'))
                    <li class="disabled" aria-disabled="true">{{ data_get($element, 'label') }}</li>
                @else
                    {{-- Array Of Links --}}
                    @if ((int)data_get($element, 'label') == $currentPage)
                        <li class="active" aria-current="page">{{ data_get($element, 'label') }}</li>
                    @else
                        <li><a href="{{ data_get($element, 'url') }}" data-url="{{ data_get($element, 'url') }}" class="page-link__custom">{{ data_get($element, 'label') }}</a></li>
                    @endif
                @endif
            @endforeach
        @endif
        {{-- Next Page Link --}}
        @if (data_get($paginator, 'next'))
            <li>
                <a data-url="{{ data_get($paginator, 'next') }}" rel="next" aria-label="@lang('pagination.next')" class="page-link__custom">Вперед</a>
            </li>
        @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span aria-hidden="true">Назад</span>
            </li>
        @endif
    </ul>
{{--    <ul class="pagination justify-content-center" role="navigation">--}}
{{--        --}}{{-- Previous Page Link --}}
{{--        @if (!data_get($paginator, 'prev'))--}}
{{--            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">--}}
{{--                <span class="page-link" aria-hidden="true">&lsaquo;</span>--}}
{{--            </li>--}}
{{--        @else--}}
{{--            <li class="page-item">--}}
{{--                <a class="page-link" href="" rel="prev" data-url="{{ data_get($paginator, 'prev') }}" aria-label="@lang('pagination.previous')">&lsaquo;</a>--}}
{{--            </li>--}}
{{--        @endif--}}

{{--        --}}{{-- Pagination Elements --}}
{{--        @if (is_array($elements) && count($elements) > 0)--}}
{{--            @foreach ($elements as $element)--}}
{{--                @continue($loop->first || $loop->last)--}}

{{--                --}}{{-- "Three Dots" Separator --}}
{{--                @if (!data_get($element, 'url'))--}}
{{--                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ data_get($element, 'label') }}</span></li>--}}
{{--                @else--}}
{{--                    --}}{{-- Array Of Links --}}
{{--                    @if ((int)data_get($element, 'label') == $currentPage)--}}
{{--                        <li class="page-item active" aria-current="page"><span class="page-link">{{ data_get($element, 'label') }}</span></li>--}}
{{--                    @else--}}
{{--                        <li class="page-item"><a class="page-link" href="" data-url="{{ data_get($element, 'url') }}">{{ data_get($element, 'label') }}</a></li>--}}
{{--                    @endif--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--        @endif--}}

{{--        --}}{{-- Next Page Link --}}
{{--        @if (data_get($paginator, 'next'))--}}
{{--            <li class="page-item">--}}
{{--                <a class="page-link" href="" rel="next" data-url="{{ data_get($paginator, 'next') }}" aria-label="@lang('pagination.next')">&rsaquo;</a>--}}
{{--            </li>--}}
{{--        @else--}}
{{--            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">--}}
{{--                <span class="page-link" aria-hidden="true">&rsaquo;</span>--}}
{{--            </li>--}}
{{--        @endif--}}
{{--    </ul>--}}
@endif
