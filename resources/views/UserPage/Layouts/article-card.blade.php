{{--
    Blog article card in the blog design (image, title, excerpt, "Pelajari Lanjut" on the right).
    @param \App\Models\Article $article
    @param string $layout  'card' (image on top) | 'row' (image left from md, ~1/3 width)
--}}
@php
    $layout = $layout ?? 'card';
    $isRow = $layout === 'row';
    // strip_tags + entity decode: rich text often contains &nbsp; which otherwise shows up literally.
    $excerpt = \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags((string) $article->description), ENT_QUOTES | ENT_HTML5, 'UTF-8'))), 260);
@endphp
<article @class(['group flex h-full', 'flex-col' => ! $isRow, 'flex-col gap-5 md:flex-row md:items-center md:gap-10' => $isRow])>
    <a href="{{ $article->publicUrl() }}" tabindex="-1" aria-hidden="true" @class([
        'block shrink-0 overflow-hidden rounded-xl bg-mist',
        'aspect-video w-full' => ! $isRow,
        'aspect-video w-full md:w-[38%]' => $isRow,
    ])>
        @if ($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" alt="" class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                loading="lazy" decoding="async">
        @endif
    </a>
    <div @class(['flex flex-1 flex-col', 'pt-4' => ! $isRow, 'self-stretch md:py-4' => $isRow])>
        <h3 @class(['font-bold leading-snug text-ink', 'line-clamp-3 text-base' => ! $isRow, 'line-clamp-2 text-lg' => $isRow])>
            <a href="{{ $article->publicUrl() }}" class="hover:text-brand-dark">{{ $article->title }}</a>
        </h3>
        <p @class(['mt-3 text-muted', 'line-clamp-5 text-sm leading-relaxed' => ! $isRow, 'line-clamp-4 text-base leading-relaxed' => $isRow])>{{ $excerpt }}</p>
        <div class="mt-auto pt-4 text-right">
            <a href="{{ $article->publicUrl() }}" class="text-sm text-brand-link hover:underline sm:text-base">Pelajari Lanjut<span class="sr-only">: {{ $article->title }}</span></a>
        </div>
    </div>
</article>
