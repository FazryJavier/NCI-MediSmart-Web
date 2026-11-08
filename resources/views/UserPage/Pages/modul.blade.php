@extends('UserPage.Layouts.app')

@php
    $img = fn (?string $path) => $path ? asset('storage/' . $path) : null;
    $waNumber = collect($whatsappContent['whatsappView'])->first();
@endphp

@section('title', \Illuminate\Support\Str::limit(trim($modul->title . ($product ? ' – ' . $product->title : '')), 60, '') . ' | NCI Medismart')
@section('description', \Illuminate\Support\Str::limit(trim(strip_tags((string) $modul->description)), 155))
@section('canonical', $modul->publicUrl())
@if ($heroImage?->image)
    @section('og_image', $img($heroImage->image))
@endif

{{--
    Follows the module design: green hero (title, description, white "Hubungi Kami" button, screenshot on the
    right), the module's advantages as columns separated by dividers, alternating screenshot / checklist rows
    for the facilities, testimonials, then the CTA. Breadcrumb is structured data only.
--}}
@section('content')
    @include('UserPage.Layouts.wa-icon')

    @include('UserPage.Layouts.breadcrumb', [
        'visible' => false,
        'items' => array_values(array_filter([
            $product ? [$product->title, $product->publicUrl() . '#modul'] : null,
            [$modul->title, null],
        ])),
    ])

    {{-- Hero --}}
    <section class="bg-gradient-to-r from-brand to-[#28b88d] text-white">
        <div class="page-container py-12 sm:py-16">
            <div class="grid items-center gap-10 {{ $heroImage ? 'lg:grid-cols-2' : 'max-w-3xl' }}">
                <div>
                    <h1 class="text-2xl font-bold leading-tight sm:text-3xl">{{ $modul->title }}</h1>
                    @if (filled($modul->description))
                        <p class="mt-4 text-base leading-relaxed text-white/90">{{ $modul->description }}</p>
                    @endif
                    @if ($waNumber)
                        <a href="https://api.whatsapp.com/send?phone={{ urlencode($waNumber) }}" target="_blank" rel="noopener noreferrer"
                            class="btn mt-8 bg-white !px-6 !py-2.5 !text-sm text-brand-dark hover:bg-brand-dark hover:text-white">Hubungi Kami</a>
                    @endif
                </div>
                @if ($heroImage)
                    {{-- Framed: uploaded photos may have their own background, the frame keeps them tidy. --}}
                    <div class="aspect-[16/10] w-full overflow-hidden rounded-2xl border-4 border-white/70 bg-white shadow-xl">
                        <img src="{{ $img($heroImage->image) }}" alt="{{ $modul->title }}" class="h-full w-full object-contain"
                            fetchpriority="high" decoding="async">
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Advantages: columns separated by vertical dividers, a rule between rows --}}
    @if ($advantages->isNotEmpty())
        <section class="reveal">
            <div class="page-container py-12 sm:py-16">
                <h2 class="text-center text-2xl font-bold text-ink sm:text-3xl">{{ $modul->title }}</h2>
                <div class="mx-auto mt-10 grid max-w-5xl md:grid-cols-3">
                    @foreach ($advantages as $advantage)
                        <div class="flex flex-col items-center border-black/10 px-6 py-6 text-center [&:not(:first-child)]:border-t md:[&:not(:first-child)]:border-t-0 md:[&:nth-child(3n+2)]:border-x md:[&:nth-child(n+4)]:border-t">
                            {{-- Fixed icon box and title height so the descriptions line up across columns. --}}
                            <div class="flex h-14 w-full items-center justify-center">
                                @if ($advantage->icon)
                                    <img src="{{ $img($advantage->icon) }}" alt="" class="max-h-14 w-auto max-w-[72px] object-contain opacity-60 grayscale"
                                        loading="lazy" decoding="async">
                                @endif
                            </div>
                            <h3 class="mt-5 flex min-h-[3rem] items-center text-base font-bold leading-snug text-ink">{{ $advantage->title }}</h3>
                            @if (filled($advantage->description))
                                <p class="mt-2 max-w-xs text-sm leading-relaxed text-ink/70">{{ $advantage->description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Facilities: alternating screenshot / checklist rows --}}
    @if ($facilityBlocks->isNotEmpty())
        <section class="reveal bg-mist">
            <div class="page-container py-12 sm:py-16">
                <h2 class="text-center text-2xl font-bold text-ink sm:text-3xl">Fasilitas {{ $modul->title }}</h2>
                <div class="mx-auto mt-10 max-w-5xl space-y-12">
                    @foreach ($facilityBlocks as $block)
                        @php($paired = $block['image'] && $block['items']->isNotEmpty())
                        {{-- Every row: same 2-column grid and the same framed 16:10 image, so rows line up. --}}
                        <div @class([
                            'grid items-center gap-8',
                            'md:grid-cols-2 md:gap-12' => $paired,
                            'mx-auto max-w-2xl' => ! $paired,
                        ])>
                            @if ($block['image'])
                                <div @class(['aspect-[16/10] w-full overflow-hidden rounded-2xl border border-black/10 bg-white p-2 shadow-sm', 'md:order-2' => $paired && $loop->even])>
                                    <img src="{{ $img($block['image']->image) }}" alt="" class="h-full w-full rounded-xl object-contain"
                                        loading="lazy" decoding="async">
                                </div>
                            @endif
                            @if ($block['items']->isNotEmpty())
                                <ul class="space-y-4 px-2 md:px-4">
                                    @foreach ($block['items'] as $facility)
                                        <li class="flex gap-3 text-sm text-ink sm:text-base">
                                            <x-icon name="check" class="mt-1 text-brand/80" />{{ $facility->description }}
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
