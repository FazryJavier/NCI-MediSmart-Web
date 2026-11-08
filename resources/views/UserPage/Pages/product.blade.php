@extends('UserPage.Layouts.app')

@php
    $img = fn (?string $path) => $path ? asset('storage/' . $path) : null;
    $waNumber = collect($whatsappContent['whatsappView'])->first();
    $intro = filled($detail?->description) ? $detail->description : $product->description;
    $flyer = filled($detail?->flyer) && $detail->flyer !== '#' ? $detail->flyer : null;
    // Count-aware widths: any number of cards forms full rows centred on the page.
    $advantageWidth = 'w-full md:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)]';
    $modulWidth = 'w-[calc(50%-0.5rem)] sm:w-[calc(33.333%-1rem)] lg:w-[calc(25%-1.125rem)]';
@endphp

@section('title', \Illuminate\Support\Str::limit(trim($product->title . (filled($product->subTitle) ? ' – ' . $product->subTitle : '')), 60, '') . ' | NCI Medismart')
@section('description', \Illuminate\Support\Str::limit(trim(strip_tags((string) $intro)), 155))
@section('canonical', $product->publicUrl())
@if ($product->image)
    @section('og_image', $img($product->image))
@endif

@section('content')
    @include('UserPage.Layouts.wa-icon')

    {{-- Intro --}}
    <section class="bg-mist">
        <div class="page-container py-10 text-center sm:py-14">
            <div class="text-left">
                @include('UserPage.Layouts.breadcrumb', ['items' => [['Produk', route('home') . '#produk'], [$product->title, null]]])
            </div>
            @if ($detail?->logo)
                <h1 class="mt-8">
                    <img src="{{ $img($detail->logo) }}" alt="{{ $product->title }}" class="mx-auto h-auto max-h-28 w-auto max-w-full sm:max-h-36"
                        fetchpriority="high" decoding="async">
                </h1>
            @else
                <h1 class="mt-8 text-3xl font-bold text-ink sm:text-4xl">{{ $product->title }}</h1>
            @endif
            @if (filled($product->subTitle))
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
        <section class="reveal relative bg-[linear-gradient(to_bottom,#f1f5f9_50%,transparent_50%)]">
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
                <h2 class="text-2xl font-bold text-white sm:text-3xl">Mitra {{ $product->title }}</h2>
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
                        <div class="{{ $advantageWidth }} rounded-2xl bg-[#e7ecf2] p-6 text-ink sm:p-8">
                            @if ($advantage->icon)
                                <img src="{{ $img($advantage->icon) }}" alt="" width="40" height="40" class="h-10 w-10 object-contain"
                                    loading="lazy" decoding="async">
                            @endif
                            <h3 class="mt-4 text-xl font-bold">{{ $advantage->title }}</h3>
                            @if ($advantage->advantageListProducts->isNotEmpty())
                                <ul class="mt-4 space-y-2.5">
                                    @foreach ($advantage->advantageListProducts as $point)
                                        <li class="flex gap-2.5 text-base text-ink/85">
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
            <div class="page-container py-12 sm:py-16" x-data="loadMore({ initial: 12, step: 8, total: {{ $moduls->count() }} })">
                <div class="mx-auto max-w-3xl text-center text-ink">
                    <h2 class="section-title">Modul {{ $product->title }}</h2>
                    @if (filled(strip_tags((string) $detail?->moduldesc)))
                        <div class="prose mx-auto mt-4 text-ink/80 sm:prose-lg">{!! $detail->moduldesc !!}</div>
                    @endif
                </div>

                <div class="mt-10 flex flex-wrap justify-center gap-4 sm:gap-6">
                    @foreach ($moduls as $modul)
                        <a href="{{ $modul->publicUrl() }}" x-show="{{ $loop->index }} < visible" @if ($loop->index >= 12) x-cloak @endif
                            class="{{ $modulWidth }} group flex flex-col items-center rounded-2xl border border-black/10 bg-white p-4 text-center transition hover:border-brand/50 hover:shadow-lg sm:p-6">
                            @if ($modul->icon)
                                <img src="{{ $img($modul->icon) }}" alt="" class="aspect-square w-full max-w-[160px] object-contain"
                                    loading="lazy" decoding="async">
                            @endif
                            <h3 class="mt-3 text-base font-bold text-ink group-hover:text-brand-dark sm:text-lg">{{ $modul->title }}</h3>
                            @if (filled($modul->description))
                                <p class="mt-1.5 line-clamp-2 text-sm text-ink/70">{{ $modul->description }}</p>
                            @endif
                            <span class="mt-auto inline-flex items-center gap-1.5 pt-3 text-sm font-medium text-brand-link">
                                Pelajari<x-icon name="arrow-right" class="text-xs transition group-hover:translate-x-0.5" /></span>
                        </a>
                    @endforeach
                </div>

                <div class="mt-10 text-center" x-show="hasMore" x-cloak>
                    <button type="button" @click="more()" class="btn btn-primary">Lihat semua modul</button>
                </div>
            </div>
        </section>
    @endif

    @include('UserPage.Layouts.testimonial-slider', [
        'testimonials' => $testimonials->map(fn ($t) => ['image' => $t->image, 'name' => $t->name, 'description' => $t->description])->all(),
    ])

    @include('UserPage.Layouts.question')
@endsection
