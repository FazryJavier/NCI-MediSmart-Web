{{--
    Visible breadcrumb + BreadcrumbList structured data.
    @param array<int, array{0: string, 1: ?string}> $items  [label, url]; the last item is the current page (url null)
    @param bool $light  white text (for use on dark/green backgrounds)
    @param bool $visible  false = structured data only (for designs without a visible breadcrumb)
--}}
@php
    $light = $light ?? false;
    $visible = $visible ?? true;
    $crumbs = array_merge([['Beranda', route('home')]], $items);
@endphp
@if ($visible)
<nav aria-label="Breadcrumb" class="text-sm {{ $light ? 'text-white/80' : 'text-muted' }}">
    <ol class="flex flex-wrap items-center gap-x-2 gap-y-1">
        @foreach ($crumbs as [$label, $url])
            <li class="flex items-center gap-2">
                @if (! $loop->first)
                    <span aria-hidden="true">/</span>
                @endif
                @if ($url && ! $loop->last)
                    <a href="{{ $url }}" class="transition {{ $light ? 'hover:text-white' : 'hover:text-brand-dark' }}">{{ $label }}</a>
                @else
                    <span aria-current="page" class="line-clamp-1 font-medium {{ $light ? 'text-white' : 'text-ink' }}">{{ $label }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
@endif
@push('meta')
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => collect($crumbs)->values()->map(fn ($crumb, $i) => array_filter([
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => $crumb[0],
                'item' => $crumb[1] ?? url()->current(),
            ]))->all(),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}
    </script>
@endpush
