@extends('UserPage.Layouts.app')

@section('title', 'Blog SIMRS & Kesehatan Digital | NCI Medismart')
@section('description', 'Berita, artikel, dan update terbaru seputar SIMRS, SATUSEHAT, bridging BPJS, dan transformasi digital rumah sakit dari NCI Medismart.')

{{--
    Follows the blog design: "NCIMedismart/Blog" heading, featured article (rounded image left; title, excerpt,
    "Pelajari Lanjut...", author · date and a green rule on the right), three highlight cards separated by
    vertical dividers with a grey rule underneath, the CTA, then the article list (image left ~1/3) with an
    outlined "Load More". Excerpts are left-aligned (justified small text leaves large gaps).
--}}
@php
    $plain = fn ($article) => trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags((string) $article->description), ENT_QUOTES | ENT_HTML5, 'UTF-8')));
@endphp

@section('content')
    @include('UserPage.Layouts.wa-icon')

    <section class="reveal">
        <div class="page-container py-10 sm:py-12">
            <h1 class="text-lg text-ink sm:text-xl">
                <a href="{{ route('home') }}" class="hover:text-brand-dark">NCIMedismart</a>/Blog
            </h1>

            @if (! $featured)
                <p class="mt-10 text-ink/70">Belum ada artikel. Silakan kembali lagi nanti.</p>
            @else
                {{-- Featured article --}}
                <article class="group mt-6 grid items-start gap-6 lg:grid-cols-2 lg:gap-10">
                    <a href="{{ $featured->publicUrl() }}" class="block aspect-video overflow-hidden rounded-2xl bg-mist" tabindex="-1" aria-hidden="true">
                        @if ($featured->image)
                            <img src="{{ asset('storage/' . $featured->image) }}" alt="" class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                fetchpriority="high" decoding="async">
                        @endif
                    </a>
                    <div class="flex flex-col border-b-2 border-brand pb-5 lg:min-h-full lg:pt-4">
                        <h2 class="text-xl font-bold leading-snug text-ink sm:text-2xl">
                            <a href="{{ $featured->publicUrl() }}" class="hover:text-brand-dark">{{ $featured->title }}</a>
                        </h2>
                        <p class="mt-5 line-clamp-5 text-base leading-relaxed text-muted">{{ \Illuminate\Support\Str::limit($plain($featured), 400) }}</p>
                        <a href="{{ $featured->publicUrl() }}" class="mt-5 text-sm text-brand-link hover:underline sm:text-base">Pelajari Lanjut...</a>
                        <p class="mt-auto pt-6 text-sm">
                            @if (optional($featured->Users)->username)
                                <span class="font-bold text-ink">{{ $featured->Users->username }}</span>
                            @endif
                            @if ($featured->created_at)
                                <span class="text-ink/40" aria-hidden="true">&nbsp;·&nbsp;</span>
                                <time datetime="{{ $featured->created_at->toDateString() }}" class="text-ink/50">{{ $featured->created_at->format('d/m/Y') }}</time>
                            @endif
                        </p>
                    </div>
                </article>

                {{-- Highlights: up to three columns separated by vertical dividers --}}
                @if ($highlights->isNotEmpty())
                    <div class="mt-10 grid gap-y-10 border-b border-black/10 pb-10 md:grid-cols-3 md:divide-x md:divide-black/10">
                        @foreach ($highlights as $article)
                            <div class="md:px-5 md:first:pl-0 md:last:pr-0">
                                @include('UserPage.Layouts.article-card', ['article' => $article])
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    </section>

    @include('UserPage.Layouts.question')

    {{-- Article list --}}
    @if ($others->isNotEmpty())
        <section class="reveal">
            <div class="page-container py-10 sm:py-12" x-data="loadMore({ initial: 3, step: 3, total: {{ $others->count() }} })">
                <div class="grid gap-8">
                    @foreach ($others as $article)
                        <div x-show="{{ $loop->index }} < visible" @if ($loop->index >= 3) x-cloak @endif>
                            @include('UserPage.Layouts.article-card', ['article' => $article, 'layout' => 'row'])
                        </div>
                    @endforeach
                </div>
                <div class="mt-12 text-center" x-show="hasMore" x-cloak>
                    <button type="button" @click="more()"
                        class="rounded-lg border border-brand px-12 py-2.5 text-sm text-brand transition hover:bg-brand hover:text-white">
                        Load More</button>
                </div>
            </div>
        </section>
    @endif
@endsection
