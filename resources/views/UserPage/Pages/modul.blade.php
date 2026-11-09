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
                    {{--
                        No white box: a transparent PNG sits directly on the green, with a shadow that follows its
                        shape. An image with its own background shows as a rounded card at its real size.
                    --}}
                    <div class="flex justify-center">
                        <img src="{{ $img($heroImage->image) }}" alt="{{ $modul->title }}"
                            class="max-h-[22rem] w-auto max-w-full rounded-2xl object-contain drop-shadow-2xl"
                            fetchpriority="high" decoding="async">
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{--
        Advantages: columns separated by vertical dividers, a rule between rows. The column count follows the
        number of items (1-4 in one row, 5-6 as rows of 3, 7+ as rows of 4) and an unfinished last row is centred.
        Phone: one column; tablet: two.
    --}}
    @if ($advantages->isNotEmpty())
        @php
            $advCount = $advantages->count();
            $advCols = $advCount <= 4 ? $advCount : ($advCount <= 6 ? 3 : 4);
            $advWidth = [1 => 'lg:w-full', 2 => 'lg:w-1/2', 3 => 'lg:w-1/3', 4 => 'lg:w-1/4'][$advCols];
            $advMax = [1 => 'max-w-md', 2 => 'max-w-3xl', 3 => 'max-w-5xl', 4 => 'max-w-6xl'][$advCols];
            // Dividers per breakpoint: a left rule unless the item starts a row, a top rule unless it is in the first row.
            $advBorders = fn (int $i) => implode(' ', array_filter([
                $i > 0 ? 'border-t' : null,
                $advCount > 1 ? ($i % 2 ? 'sm:border-l' : null) : null,
                $advCount > 1 && $i === 1 ? 'sm:border-t-0' : null,
                $i % $advCols ? 'lg:border-l' : 'lg:border-l-0',
                $i >= $advCols ? 'lg:border-t' : 'lg:border-t-0',
            ]));
        @endphp
        <section class="reveal">
            <div class="page-container py-12 sm:py-16">
                <h2 class="text-center text-2xl font-bold text-ink sm:text-3xl">{{ $modul->title }}</h2>
                <div class="mx-auto mt-10 flex flex-wrap justify-center {{ $advMax }}">
                    @foreach ($advantages as $advantage)
                        <div class="flex w-full flex-col items-center border-black/10 px-6 py-6 text-center {{ $advCount > 1 ? 'sm:w-1/2' : '' }} {{ $advWidth }} {{ $advBorders($loop->index) }}">
                            {{-- Fixed icon box and title height so the descriptions line up across columns. --}}
                            <div class="flex h-14 w-full items-center justify-center">
                                @if ($advantage->icon)
                                    <img src="{{ $img($advantage->icon) }}" alt="" class="max-h-14 w-auto max-w-[72px] object-contain"
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
