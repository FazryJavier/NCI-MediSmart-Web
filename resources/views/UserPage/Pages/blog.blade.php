@extends('UserPage.Layouts.app')

@section('title', 'Blog SIMRS & Kesehatan Digital | NCI Medismart')
@section('description', 'Berita, artikel, dan update terbaru seputar SIMRS, SATUSEHAT, bridging BPJS, dan transformasi digital rumah sakit dari NCI Medismart.')

@section('content')
    @include('UserPage.Layouts.wa-icon')

    <section class="reveal">
        <div class="page-container py-10 sm:py-14">
            @include('UserPage.Layouts.breadcrumb', ['items' => [['Blog', null]]])
            <h1 class="mt-3 text-3xl font-bold text-ink sm:text-4xl">Blog</h1>
            <p class="mt-2 text-base text-ink/70 sm:text-lg">Berita dan update terbaru dari NCI Medismart.</p>

            @if (! $featured)
                <p class="mt-10 rounded-2xl bg-mist p-10 text-center text-ink/70">Belum ada artikel. Silakan kembali lagi nanti.</p>
            @else
                {{-- Featured article --}}
                <article class="group mt-8 grid overflow-hidden rounded-2xl border border-black/10 bg-white lg:grid-cols-2">
                    <a href="{{ $featured->publicUrl() }}" class="block aspect-video overflow-hidden bg-mist lg:aspect-auto lg:min-h-[340px]" tabindex="-1" aria-hidden="true">
                        @if ($featured->image)
                            <img src="{{ asset('storage/' . $featured->image) }}" alt="" class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                fetchpriority="high" decoding="async">
                        @endif
                    </a>
                    <div class="flex flex-col border-b-4 border-brand p-6 sm:p-8 lg:border-b-0 lg:border-l-4 lg:p-10">
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-sm">
                            <span class="rounded-full bg-brand/10 px-3 py-1 font-medium text-brand-dark">Artikel Utama</span>
                            @if ($featured->created_at)
                                <time datetime="{{ $featured->created_at->toDateString() }}" class="text-ink/60">
                                    {{ $featured->created_at->locale('id')->translatedFormat('d F Y') }}</time>
                            @endif
                        </div>
                        <h2 class="mt-4 text-2xl font-bold leading-snug text-ink sm:text-[1.75rem]">
                            <a href="{{ $featured->publicUrl() }}" class="hover:text-brand-dark">{{ $featured->title }}</a>
                        </h2>
                        <p class="mt-4 line-clamp-4 text-base leading-relaxed text-ink/70 sm:text-lg">
                            {{ \Illuminate\Support\Str::limit(trim(strip_tags((string) $featured->description)), 320) }}</p>
                        <div class="mt-auto flex flex-wrap items-center justify-between gap-4 pt-6">
                            @if (optional($featured->Users)->username)
                                <p class="text-sm font-bold text-ink">{{ $featured->Users->username }}</p>
                            @endif
                            <a href="{{ $featured->publicUrl() }}" class="btn btn-primary">Baca selengkapnya<x-icon name="arrow-right" class="text-sm" /></a>
                        </div>
                    </div>
                </article>

                {{-- Highlighted articles --}}
                @if ($highlights->isNotEmpty())
                    <div class="mt-8 flex flex-wrap justify-center gap-6">
                        @foreach ($highlights as $article)
                            <div class="w-full md:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)]">
                                @include('UserPage.Layouts.article-card', ['article' => $article])
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    </section>

    @include('UserPage.Layouts.question')

    {{-- Other articles --}}
    @if ($others->isNotEmpty())
        <section class="reveal">
            <div class="page-container py-10 sm:py-14" x-data="loadMore({ initial: 4, step: 4, total: {{ $others->count() }} })">
                <h2 class="text-2xl font-bold text-ink sm:text-3xl">Artikel Lainnya</h2>
                <div class="mt-6 grid gap-6">
                    @foreach ($others as $article)
                        <div x-show="{{ $loop->index }} < visible" @if ($loop->index >= 4) x-cloak @endif>
                            @include('UserPage.Layouts.article-card', ['article' => $article, 'layout' => 'row'])
                        </div>
                    @endforeach
                </div>
                <div class="mt-8 text-center" x-show="hasMore" x-cloak>
                    <button type="button" @click="more()"
                        class="btn border border-brand text-brand-dark hover:bg-brand hover:text-white">Muat lebih banyak</button>
                </div>
            </div>
        </section>
    @endif
@endsection
