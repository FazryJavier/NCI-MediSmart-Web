@extends('UserPage.Layouts.app')

@php
    $img = fn (?string $path) => $path ? asset('storage/' . $path) : null;
    $waNumber = collect($whatsappContent['whatsappView'])->first();
    $intro = filled($detail?->description) ? $detail->description : $product->description;
    $flyer = filled($detail?->flyer) && $detail->flyer !== '#' ? $detail->flyer : null;
    // Count-aware widths: any number of cards forms full rows centred on the page.
    // Design: advantages 4 per row, modules 5 per row (first 3 rows shown, "Lihat Semua Modul" shows the rest).
    $advantageWidth = $advantages->count() === 3
        ? 'w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)]'
        : 'w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(25%-1.125rem)]';
    $modulWidth = 'w-[calc(50%-0.5rem)] sm:w-[calc(33.333%-0.667rem)] lg:w-[calc(20%-0.8rem)]';
@endphp

@section('title', \Illuminate\Support\Str::limit(trim($product->title . (filled($product->subTitle) ? ' – ' . $product->subTitle : '')), 60, '') . ' | NCI Medismart')
@section('description', \Illuminate\Support\Str::limit(trim(strip_tags((string) $intro)), 155))
@section('canonical', $product->publicUrl())
@if ($product->image)
    @section('og_image', $img($product->image))
@endif

@section('content')
    @include('UserPage.Layouts.wa-icon')

    {{-- Breadcrumb as structured data only: the design has no visible trail. --}}
    @include('UserPage.Layouts.breadcrumb', ['items' => [['Produk', route('home') . '#produk'], [$product->title, null]], 'visible' => false])

    {{-- Intro --}}
    <section class="bg-white">
        <div class="page-container pb-10 pt-12 text-center sm:pb-14 sm:pt-16">
            @if ($detail?->logo)
                <h1>
                    <img src="{{ $img($detail->logo) }}" alt="{{ $product->title }}" class="mx-auto h-auto max-h-28 w-auto max-w-full sm:max-h-36"
                        fetchpriority="high" decoding="async">
                </h1>
            @else
                <h1 class="text-3xl font-bold text-ink sm:text-4xl">{{ $product->title }}</h1>
            @endif
            {{-- The design shows only the logo (which carries the tagline); the subtitle is a fallback without a logo. --}}
            @if (! $detail?->logo && filled($product->subTitle))
                <p class="mt-4 text-lg font-medium text-brand-dark sm:text-xl">{{ $product->subTitle }}</p>
            @endif
            @if (filled($intro))
                <p class="mx-auto mt-4 max-w-3xl text-base leading-relaxed text-ink/80 sm:text-lg">{{ $intro }}</p>
            @endif
            @if ($waNumber || $flyer)
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    @if ($waNumber)
                        <a href="https://api.whatsapp.com/send?phone={{ urlencode($waNumber) }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                            <x-icon name="whatsapp" />Hubungi Kami</a>
                    @endif
                    @if ($flyer)
                        <a href="{{ $flyer }}" target="_blank" rel="noopener noreferrer" class="btn border-2 border-brand text-brand-dark hover:bg-brand hover:text-white">
                            Download Flyer</a>
                    @endif
                </div>
            @endif
        </div>
    </section>

    {{-- Video: framed player straddling the grey/green background split --}}
    @if (filled($detail?->video))
        <section class="reveal relative bg-[linear-gradient(to_bottom,#fff_50%,transparent_50%)]">
            <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-r from-brand to-[#28b88d]" aria-hidden="true"></div>
            <div class="page-container relative py-0">
                <div class="mx-auto max-w-4xl rounded-2xl bg-ink p-2 shadow-2xl sm:rounded-3xl sm:p-3">
                    @include('UserPage.Layouts.youtube', ['video' => $detail->video, 'title' => 'Video ' . $product->title, 'class' => 'rounded-xl sm:rounded-2xl'])
                </div>
            </div>
        </section>
    @endif

    {{-- Clients --}}
    @if ($client?->image)
        <section class="reveal bg-gradient-to-r from-brand to-[#28b88d]">
            <div class="page-container py-12 text-center sm:py-16">
                <h2 class="text-xl font-bold text-white sm:text-2xl">Mitra {{ $product->title }}</h2>
                <img src="{{ $img($client->image) }}" alt="Mitra {{ $product->title }}" class="mx-auto mt-8 h-auto w-full max-w-5xl"
                    loading="lazy" decoding="async">
            </div>
        </section>
    @endif

    {{-- Advantages --}}
    @if ($advantages->isNotEmpty())
        <section class="reveal">
            <div class="page-container py-12 sm:py-16">
                <h2 class="section-title">Kelebihan {{ $product->title }}</h2>
                <div class="mt-10 flex flex-wrap justify-center gap-6">
                    @foreach ($advantages as $advantage)
                        <div class="{{ $advantageWidth }} rounded-2xl bg-[#e7ecf2] p-6 text-ink">
                            @if ($advantage->icon)
                                <img src="{{ $img($advantage->icon) }}" alt="" width="36" height="36" class="h-9 w-9 object-contain"
                                    loading="lazy" decoding="async">
                            @endif
                            <h3 class="mt-3 text-lg font-bold">{{ $advantage->title }}</h3>
                            @if ($advantage->advantageListProducts->isNotEmpty())
                                <ul class="mt-3 space-y-2">
                                    @foreach ($advantage->advantageListProducts as $point)
                                        <li class="flex gap-2.5 text-sm text-ink/85">
                                            <x-icon name="circle-check" class="mt-1 text-brand" />{{ $point->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Sparasi --}}
    @if ($sparasi?->image)
        <section class="reveal">
            <div class="page-container pb-12 text-center sm:pb-16">
                <img src="{{ $img($sparasi->image) }}" alt="Arsitektur {{ $product->title }}" class="mx-auto h-auto max-w-full"
                    loading="lazy" decoding="async">
            </div>
        </section>
    @endif

    {{-- Modules --}}
    @if ($moduls->isNotEmpty())
        <section class="reveal bg-[#fcfcfc]" id="modul">
            <div class="page-container py-12 sm:py-16" x-data="loadMore({ initial: 15, step: {{ max(1, $moduls->count()) }}, total: {{ $moduls->count() }} })">
                <div class="mx-auto max-w-3xl text-center text-ink">
                    <h2 class="section-title">Modul {{ $product->title }}</h2>
                    @if (filled(strip_tags((string) $detail?->moduldesc)))
                        <div class="prose mx-auto mt-4 text-ink/80">{!! $detail->moduldesc !!}</div>
                    @endif
                </div>

                {{-- As in the design: plain tiles (title above the image); hovering lifts the tile into a white card
                     and reveals "Pelajari Lebih Lanjut". --}}
                <div class="mt-10 flex flex-wrap justify-center gap-4">
                    @foreach ($moduls as $modul)
                        <a href="{{ $modul->publicUrl() }}" x-show="{{ $loop->index }} < visible" @if ($loop->index >= 15) x-cloak @endif
                            class="{{ $modulWidth }} group flex flex-col items-center rounded-2xl p-3 text-center transition duration-200 hover:bg-white hover:shadow-xl focus-visible:bg-white focus-visible:shadow-xl focus-visible:outline-none sm:p-4">
                            <h3 class="flex min-h-[2.5rem] items-center text-sm font-medium leading-snug text-ink group-hover:text-brand-dark">{{ $modul->title }}</h3>
                            @if ($modul->icon)
                                <img src="{{ $img($modul->icon) }}" alt="" class="mt-2 aspect-[4/3] w-full object-contain"
                                    loading="lazy" decoding="async">
                            @endif
                            @if (filled($modul->description))
                                <p class="mt-2 line-clamp-3 text-xs leading-relaxed text-ink/60">{{ $modul->description }}</p>
                            @endif
                            <span class="mt-2 inline-flex items-center gap-1 text-xs font-medium text-brand-link opacity-0 transition group-hover:opacity-100 group-focus-visible:opacity-100">
                                Pelajari Lebih Lanjut<x-icon name="arrow-right" class="text-[10px]" /></span>
                        </a>
                    @endforeach
                </div>

                <div class="mt-10 text-center" x-show="hasMore" x-cloak>
                    <button type="button" @click="more()" class="btn btn-primary !px-8 !py-2.5 !text-sm">Lihat Semua Modul</button>
                </div>
            </div>
        </section>
    @endif

    @include('UserPage.Layouts.testimonial-slider', [
        'testimonials' => $testimonials->map(fn ($t) => ['image' => $t->image, 'name' => $t->name, 'description' => $t->description])->all(),
    ])

    @include('UserPage.Layouts.question')
@endsection
