@extends('UserPage.Layouts.app')

@php
    $img = fn (?string $path) => $path ? asset('storage/' . $path) : null;
    $waNumber = collect($whatsappContent['whatsappView'])->first();
    $advantageWidth = 'w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)]';
@endphp

@section('title', \Illuminate\Support\Str::limit(trim($modul->title . ($product ? ' – ' . $product->title : '')), 60, '') . ' | NCI Medismart')
@section('description', \Illuminate\Support\Str::limit(trim(strip_tags((string) $modul->description)), 155))
@section('canonical', $modul->publicUrl())
@if ($heroImage?->image)
    @section('og_image', $img($heroImage->image))
@endif

@section('content')
    @include('UserPage.Layouts.wa-icon')

    {{-- Intro --}}
    <section class="bg-gradient-to-r from-brand to-[#28b88d] text-white">
        <div class="page-container py-10 sm:py-14">
            @include('UserPage.Layouts.breadcrumb', [
                'light' => true,
                'items' => array_values(array_filter([
                    $product ? [$product->title, $product->publicUrl() . '#modul'] : null,
                    [$modul->title, null],
                ])),
            ])
            <div class="mt-8 grid items-center gap-8 {{ $heroImage ? 'lg:grid-cols-2 lg:gap-12' : 'max-w-3xl' }}">
                <div>
                    <h1 class="text-3xl font-bold leading-tight sm:text-4xl">{{ $modul->title }}</h1>
                    @if (filled($modul->description))
                        <p class="mt-4 text-base leading-relaxed text-white/90 sm:text-lg">{{ $modul->description }}</p>
                    @endif
                    @if ($waNumber)
                        <a href="https://api.whatsapp.com/send?phone={{ urlencode($waNumber) }}" target="_blank" rel="noopener noreferrer"
                            class="btn mt-8 bg-white text-brand-dark hover:bg-brand-dark hover:text-white">
                            <x-icon name="whatsapp" />Hubungi Kami</a>
                    @endif
                </div>
                @if ($heroImage)
                    <img src="{{ $img($heroImage->image) }}" alt="{{ $modul->title }}" class="-order-1 aspect-[4/3] w-full rounded-2xl object-cover shadow-xl lg:order-none"
                        fetchpriority="high" decoding="async">
                @endif
            </div>
        </div>
    </section>

    {{-- Advantages --}}
    @if ($advantages->isNotEmpty())
        <section class="reveal">
            <div class="page-container py-12 sm:py-16">
                <h2 class="section-title">Keunggulan {{ $modul->title }}</h2>
                <div class="mt-10 flex flex-wrap justify-center gap-6">
                    @foreach ($advantages as $advantage)
                        <div class="{{ $advantageWidth }} rounded-2xl border border-black/10 bg-white p-6 text-center shadow-sm sm:p-8">
                            @if ($advantage->icon)
                                <img src="{{ $img($advantage->icon) }}" alt="" class="mx-auto h-14 w-auto max-w-[80px] object-contain"
                                    loading="lazy" decoding="async">
                            @endif
                            <h3 class="mt-4 text-xl font-bold text-ink">{{ $advantage->title }}</h3>
                            @if (filled($advantage->description))
                                <p class="mt-2 text-base leading-relaxed text-ink/75">{{ $advantage->description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Facilities: alternating image / checklist rows --}}
    @if ($facilityBlocks->isNotEmpty())
        <section class="reveal bg-mist">
            <div class="page-container py-12 sm:py-16">
                <h2 class="section-title">Fasilitas {{ $modul->title }}</h2>
                {{-- Image + checklist side by side in a narrow column with a capped image height, so they stay close together. --}}
                <div class="mx-auto mt-10 max-w-5xl space-y-10 sm:space-y-12">
                    @foreach ($facilityBlocks as $block)
                        @php($paired = $block['image'] && $block['items']->isNotEmpty())
                        <div @class([
                            'grid items-center gap-6',
                            'md:grid-cols-[minmax(0,1.1fr)_minmax(0,1fr)] md:gap-10' => $paired,
                        ])>
                            @if ($block['image'])
                                <div @class(['flex h-56 items-center justify-center sm:h-72', 'md:order-2' => $paired && $loop->even])>
                                    <img src="{{ $img($block['image']->image) }}" alt="" class="max-h-full w-auto max-w-full rounded-2xl object-contain"
                                        loading="lazy" decoding="async">
                                </div>
                            @endif
                            @if ($block['items']->isNotEmpty())
                                <ul class="space-y-3.5 px-2 sm:px-0">
                                    @foreach ($block['items'] as $facility)
                                        <li class="flex gap-3 text-base text-ink sm:text-lg">
                                            <x-icon name="circle-check" class="mt-1 text-brand" />{{ $facility->description }}
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

    @include('UserPage.Layouts.testimonial-slider', [
        'testimonials' => $testimonials->map(fn ($t) => ['image' => $t->image, 'name' => $t->name, 'description' => $t->description])->all(),
    ])

    @include('UserPage.Layouts.question')
@endsection
