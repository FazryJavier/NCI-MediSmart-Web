{{--
    Blog article card in the original blog style (image, title, excerpt, "Pelajari Lanjut" on the right).
    @param \App\Models\Article $article
    @param string $layout  'card' (image on top) | 'row' (image left from md)
--}}
@php
    $layout = $layout ?? 'card';
    $isRow = $layout === 'row';
    // strip_tags + entity decode: rich text often contains &nbsp; which otherwise shows up literally.
    $excerpt = \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags((string) $article->description), ENT_QUOTES | ENT_HTML5, 'UTF-8'))), 260);
@endphp
<article @class(['group flex h-full', 'flex-col' => ! $isRow, 'flex-col gap-5 md:flex-row md:gap-8' => $isRow])>
    <a href="{{ $article->publicUrl() }}" tabindex="-1" aria-hidden="true" @class([
        'block shrink-0 overflow-hidden rounded-xl bg-mist',
        'aspect-video w-full' => ! $isRow,
        'aspect-video w-full md:w-80 lg:w-[420px]' => $isRow,
    ])>
        @if ($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" alt="" class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                loading="lazy" decoding="async">
        @endif
    </a>
    <div @class(['flex flex-1 flex-col', 'pt-4' => ! $isRow, 'md:py-2' => $isRow])>
        <h3 class="line-clamp-2 text-lg font-bold leading-snug text-ink sm:text-xl">
            <a href="{{ $article->publicUrl() }}" class="hover:text-brand-dark">{{ $article->title }}</a>
        </h3>
        @if ($article->created_at)
            <time datetime="{{ $article->created_at->toDateString() }}" class="mt-1 text-sm text-ink/50">
                {{ $article->created_at->locale('id')->translatedFormat('d F Y') }}</time>
        @endif
        <p class="mt-2 line-clamp-4 text-base leading-relaxed text-muted">{{ $excerpt }}</p>
        <div @class(['mt-auto pt-3', 'text-right' => ! $isRow])>
            <a href="{{ $article->publicUrl() }}" class="text-base text-brand-link hover:underline">Pelajari Lanjut<span class="sr-only">: {{ $article->title }}</span></a>
        </div>
    </div>
</article>
