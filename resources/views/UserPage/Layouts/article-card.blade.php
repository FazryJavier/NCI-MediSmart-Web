{{--
    Blog article card (blog list, recommendations).
    @param \App\Models\Article $article
    @param string $layout  'card' (image on top) | 'row' (image left from md)
--}}
@php
    $layout = $layout ?? 'card';
    $isRow = $layout === 'row';
    $excerpt = \Illuminate\Support\Str::limit(trim(strip_tags((string) $article->description)), 220);
@endphp
<article @class([
    'group flex overflow-hidden rounded-2xl border border-black/10 bg-white transition hover:border-brand/40 hover:shadow-lg',
    'h-full flex-col' => ! $isRow,
    'flex-col md:flex-row' => $isRow,
])>
    <a href="{{ $article->publicUrl() }}" tabindex="-1" aria-hidden="true" @class([
        'block shrink-0 overflow-hidden bg-mist',
        'aspect-video' => ! $isRow,
        'aspect-video md:aspect-auto md:w-80 lg:w-96' => $isRow,
    ])>
        @if ($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" alt="" class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                loading="lazy" decoding="async">
        @endif
    </a>
    <div class="flex flex-1 flex-col p-5 sm:p-6">
        @if ($article->created_at)
            <time datetime="{{ $article->created_at->toDateString() }}" class="text-xs font-medium uppercase tracking-wide text-brand-link">
                {{ $article->created_at->locale('id')->translatedFormat('d F Y') }}</time>
        @endif
        <h3 class="mt-1.5 line-clamp-2 text-lg font-bold leading-snug text-ink">
            <a href="{{ $article->publicUrl() }}" class="hover:text-brand-dark">{{ $article->title }}</a>
        </h3>
        <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-ink/70">{{ $excerpt }}</p>
        <a href="{{ $article->publicUrl() }}" class="mt-auto inline-flex items-center gap-2 pt-4 text-sm font-medium text-brand-link hover:underline">
            Baca selengkapnya<x-icon name="arrow-right" class="text-xs" /><span class="sr-only">: {{ $article->title }}</span>
        </a>
    </div>
</article>
