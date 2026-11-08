@extends('UserPage.Layouts.app')

@section('title', 'Blog SIMRS & Kesehatan Digital | NCI Medismart')
@section('description', 'Berita, artikel, dan update terbaru seputar SIMRS, SATUSEHAT, bridging BPJS, dan transformasi digital rumah sakit dari NCI Medismart.')

{{--
    Original blog design kept: "NCIMedismart/Blog" heading, featured article (image left, text right,
    green underline), a 2-column grid, the CTA, then the article list with "load more".
    Tidied: consistent image ratios, left-aligned text (justify left big gaps), readable letter spacing,
    Indonesian dates, decoded &nbsp; in excerpts.
--}}
@php
    $plain = fn ($article) => trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags((string) $article->description), ENT_QUOTES | ENT_HTML5, 'UTF-8')));
@endphp

@section('content')
    @include('UserPage.Layouts.wa-icon')

    <section class="reveal">
        <div class="page-container py-10 sm:py-12">
            <h1 class="text-2xl font-bold text-ink">
                <a href="{{ route('home') }}" class="hover:text-brand-dark">NCIMedismart</a>/Blog
            </h1>

            @if (! $featured)
                <p class="mt-10 text-ink/70">Belum ada artikel. Silakan kembali lagi nanti.</p>
            @else
                {{-- Featured article --}}
                <article class="group mt-8 grid gap-6 lg:grid-cols-2 lg:gap-0">
                    <a href="{{ $featured->publicUrl() }}" class="block aspect-video overflow-hidden rounded-xl bg-mist lg:rounded-none" tabindex="-1" aria-hidden="true">
                        @if ($featured->image)
                            <img src="{{ asset('storage/' . $featured->image) }}" alt="" class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                fetchpriority="high" decoding="async">
                        @endif
                    </a>
                    <div class="flex flex-col border-b-2 border-brand pb-6 lg:px-10 lg:py-4">
                        <h2 class="text-2xl font-bold leading-snug text-ink">
                            <a href="{{ $featured->publicUrl() }}" class="hover:text-brand-dark">{{ $featured->title }}</a>
                        </h2>
                        <p class="mt-4 line-clamp-5 text-base leading-relaxed text-muted sm:text-lg">{{ \Illuminate\Support\Str::limit($plain($featured), 400) }}</p>
                        <a href="{{ $featured->publicUrl() }}" class="mt-4 text-base text-brand-link hover:underline">Pelajari Lanjut...</a>
                        <div class="mt-auto flex flex-wrap items-center gap-x-5 gap-y-1 pt-6 text-base">
                            @if (optional($featured->Users)->username)
                                <span class="font-bold text-ink">{{ $featured->Users->username }}</span>
                            @endif
                            @if ($featured->created_at)
                                <time datetime="{{ $featured->created_at->toDateString() }}" class="text-ink/50">
                                    {{ $featured->created_at->locale('id')->translatedFormat('d F Y') }}</time>
                            @endif
                        </div>
                    </div>
                </article>

                {{-- Highlighted articles: original 2-column grid --}}
                @if ($highlights->isNotEmpty())
                    <div class="mt-10 grid gap-x-12 gap-y-10 border-b border-muted/60 pb-10 md:grid-cols-2">
                        @foreach ($highlights as $article)
                            @include('UserPage.Layouts.article-card', ['article' => $article])
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
                <div class="grid gap-10">
                    @foreach ($others as $article)
                        <div x-show="{{ $loop->index }} < visible" @if ($loop->index >= 3) x-cloak @endif>
                            @include('UserPage.Layouts.article-card', ['article' => $article, 'layout' => 'row'])
                        </div>
                    @endforeach
                </div>
                <div class="mt-10 text-center" x-show="hasMore" x-cloak>
                    <button type="button" @click="more()"
                        class="rounded-[10px] border border-brand px-12 py-3.5 text-lg text-brand transition hover:bg-brand hover:text-white">
                        Muat lebih banyak</button>
                </div>
            </div>
        </section>
    @endif
@endsection
