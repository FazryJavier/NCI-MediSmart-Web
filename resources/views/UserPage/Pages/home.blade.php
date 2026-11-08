@extends('UserPage.Layouts.app')

@section('title', 'NCI Medismart')
@section('description', 'SIMRS NCI Medismart adalah aplikasi yang terintegrasi dengan platform satu sehat, cetak SEP BPJS')

{{--
    Every section below renders only when it has content, and every list adapts to its item count
    (1, 2, 3, 4+), so the page stays balanced whatever the admin fills in.
--}}
@php
    $waNumber = collect($whatsappContent['whatsappView'])->first();
    $waUrl = $waNumber ? 'https://api.whatsapp.com/send?phone=' . urlencode($waNumber) : null;
    $img = fn (?string $path) => $path ? asset('storage/' . $path) : null;

    $sliders = $sliders->filter(fn ($s) => filled($s->image) || filled($s->title))->values();
    $hasExperienceIntro = $experience && (filled(strip_tags((string) $experience->title)) || filled(strip_tags((string) $experience->description)));
    $hasMap = $map && (filled($map->title) || filled($map->image));
    $hasClient = $client && (filled($client->title) || filled($client->image));

    // Card widths per item count: always a full, centered row instead of an empty grid cell.
    $experienceWidth = [
        1 => 'w-full max-w-sm',
        2 => 'w-[calc(50%-0.5rem)] sm:w-[calc(50%-0.75rem)] lg:max-w-sm',
        3 => 'w-[calc(50%-0.5rem)] sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)]',
    ][$experienceItems->count()] ?? 'w-[calc(50%-0.5rem)] sm:w-[calc(50%-0.75rem)] lg:w-[calc(25%-1.125rem)]';
    $productWidth = $products->count() === 1 ? 'w-full max-w-2xl' : 'w-full md:w-[calc(50%-0.75rem)] lg:w-[calc(50%-1rem)]';
@endphp

@if ($sliders->isNotEmpty() && $sliders->first()->image)
    @push('meta')
        <link rel="preload" as="image" href="{{ $img($sliders->first()->image) }}" fetchpriority="high">
    @endpush
@endif

@push('meta')
    <meta name="google-site-verification" content="whvf61-mi-MkaBQzB8XrYdaQeWN33nkeYvJPj2YieAc">
    <meta name="author" content="SIM RS">
    <meta name="keywords" content="simrs, sim rs, sim rumah sakit, satu sehat, bridging bpjs, integrasi satu sehat">
    {{-- Structured data: lets Google show the organisation (logo, contact, social profiles). --}}
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'Organization',
                    '@id' => route('home') . '#organization',
                    'name' => 'NCI Medismart',
                    'legalName' => 'PT Nuansa Cerah Informasi',
                    'url' => route('home'),
                    'logo' => asset('assets/img/logo NCI-01.png'),
                    'contactPoint' => [['@type' => 'ContactPoint', 'telephone' => '+62-22-8735-6050', 'contactType' => 'customer service', 'areaServed' => 'ID', 'availableLanguage' => 'id']],
                    'sameAs' => [
                        'https://www.instagram.com/ncimedismart/',
                        'https://www.youtube.com/@simrsncimedismart2282',
                        'https://www.linkedin.com/company/pt-nuansa-cerah-informasi/',
                    ],
                ],
                [
                    '@type' => 'WebSite',
                    'name' => 'NCI Medismart',
                    'url' => route('home'),
                    'inLanguage' => 'id-ID',
                    'publisher' => ['@id' => route('home') . '#organization'],
                ],
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}
    </script>
@endpush

@section('content')
    @include('UserPage.Layouts.popups')
    @include('UserPage.Layouts.wa-icon')

    {{-- Hero (no reveal: it is above the fold) --}}
    <section class="relative bg-ink" aria-label="Sorotan">
        @if ($sliders->isNotEmpty())
            <div class="swiper h-[calc(100svh-6.5rem)] max-h-[820px] min-h-[460px] sm:h-[calc(100svh-7.75rem)]" x-data
                x-init="initSwiper($el, { slidesPerView: 1, loop: {{ $sliders->count() > 1 ? 'true' : 'false' }}, speed: 700 })">
                <div class="swiper-wrapper">
                    @foreach ($sliders as $slide)
                        <div class="swiper-slide relative overflow-hidden">
                            @if ($slide->image)
                                <img src="{{ $img($slide->image) }}" alt="" class="absolute inset-0 h-full w-full object-cover"
                                    decoding="async" @if ($loop->first) fetchpriority="high" @else loading="lazy" @endif>
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-brand-dark to-brand" aria-hidden="true"></div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/45 to-black/10" aria-hidden="true"></div>

                            <div class="relative mx-auto flex h-full w-full max-w-7xl items-center px-5 sm:px-8">
                                <div class="max-w-2xl text-white">
                                    @if (filled($slide->title))
                                        <h1 class="text-3xl font-bold leading-tight sm:text-4xl lg:text-5xl lg:leading-tight">{!! $slide->title !!}</h1>
                                    @endif
                                    @if (filled($slide->caption))
                                        <div class="mt-4 line-clamp-4 text-base text-white/90 sm:text-lg lg:text-xl">{!! $slide->caption !!}</div>
                                    @endif
                                    @if ($waUrl || ($slide->status == 1 && filled($slide->link)))
                                        <div class="mt-8 flex flex-wrap gap-3">
                                            @if ($waUrl)
                                                <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                                                    <x-icon name="whatsapp" />Hubungi Kami
                                                </a>
                                            @endif
                                            @if ($slide->status == 1 && filled($slide->link))
                                                <a href="{{ $slide->link }}" class="btn btn-outline-light">
                                                    Pelajari Lanjut<x-icon name="arrow-right" class="text-sm" />
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($sliders->count() > 1)
                    <div class="swiper-button-prev nav-btn !left-6 !hidden !rounded-full lg:!flex"></div>
                    <div class="swiper-button-next nav-btn !right-6 !hidden !rounded-full lg:!flex"></div>
                    <div class="swiper-pagination !bottom-6 [--swiper-pagination-bullet-inactive-color:#fff] [--swiper-pagination-bullet-inactive-opacity:0.6] [--swiper-pagination-color:#1bad4b]"></div>
                @endif
            </div>
        @else
            {{-- Fallback hero when no slide has been configured yet. --}}
            <div class="bg-gradient-to-br from-brand-dark via-brand-dark to-brand">
                <div class="mx-auto flex min-h-[460px] w-full max-w-7xl items-center px-5 py-20 sm:px-8">
                    <div class="max-w-2xl text-white">
                        <h1 class="text-3xl font-bold leading-tight sm:text-4xl lg:text-5xl lg:leading-tight">SIMRS NCI Medismart</h1>
                        <p class="mt-4 text-base text-white/90 sm:text-lg lg:text-xl">Sistem informasi rumah sakit yang terintegrasi
                            dengan SATUSEHAT dan bridging BPJS untuk fasilitas kesehatan Anda.</p>
                        <div class="mt-8 flex flex-wrap gap-3">
                            @if ($waUrl)
                                <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                                    <x-icon name="whatsapp" />Hubungi Kami
                                </a>
                            @endif
                            <a href="{{ route('demo') }}" class="btn btn-outline-light">Jadwalkan Demo<x-icon name="arrow-right" class="text-sm" /></a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>

    {{-- Client --}}
    @if ($hasClient)
        <section class="reveal relative overflow-hidden bg-brand text-white">
            <div class="page-container relative z-10 pb-24 pt-12 sm:pb-32 sm:pt-16">
                @if (filled($client->title))
                    <h2 class="text-center text-2xl font-bold sm:text-3xl">{{ $client->title }}</h2>
                    <div class="mx-auto mt-4 h-px w-24 bg-white/70" aria-hidden="true"></div>
                @endif
                @if ($client->image)
                    <img src="{{ $img($client->image) }}" alt="Klien NCI Medismart"
                        class="mx-auto mt-8 max-h-[480px] w-full max-w-5xl object-contain" loading="lazy" decoding="async">
                @endif
            </div>

            <div class="absolute bottom-0 left-0 w-full rotate-180 overflow-hidden leading-[0]" aria-hidden="true">
                <svg class="relative block h-16 w-[calc(300%+1.3px)] sm:h-28 lg:h-40" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path class="fill-mist"
                        d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z">
                    </path>
                </svg>
            </div>
        </section>
    @endif

    {{-- Experience + map --}}
    @if ($hasExperienceIntro || $experienceItems->isNotEmpty() || $hasMap)
        <section class="reveal bg-mist">
            <div class="page-container py-12 sm:py-16">
                @if ($hasExperienceIntro)
                    <div class="mx-auto max-w-3xl text-center text-ink">
                        @if (filled(strip_tags((string) $experience->title)))
                            <div class="text-2xl leading-snug sm:text-3xl lg:text-[2rem]">{!! $experience->title !!}</div>
                        @endif
                        @if (filled(strip_tags((string) $experience->description)))
                            <div class="mt-4 text-base text-ink/80 sm:text-lg">{!! $experience->description !!}</div>
                        @endif
                    </div>
                @endif

                @if ($experienceItems->isNotEmpty())
                    <div class="mt-10 flex flex-wrap justify-center gap-4 sm:gap-6">
                        @foreach ($experienceItems as $item)
                            <div class="{{ $experienceWidth }} flex flex-col items-center rounded-2xl bg-white p-5 text-center shadow-sm transition hover:shadow-md sm:p-7">
                                @if ($item->image)
                                    <img src="{{ $img($item->image) }}" alt="" width="64" height="64"
                                        class="h-12 w-12 object-contain sm:h-16 sm:w-16" loading="lazy" decoding="async">
                                @endif
                                <h3 class="mt-4 text-base font-bold sm:text-xl">{{ $item->name }}</h3>
                                @if (filled($item->description))
                                    <p class="mt-2 text-xs leading-relaxed text-muted sm:text-sm">{{ $item->description }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif

                @if ($hasMap)
                    {{-- The card hugs its content: title, then the map at its natural ratio (no forced box, no empty gap). --}}
                    <div class="mt-12 overflow-hidden rounded-3xl bg-brand-dark px-4 text-center sm:rounded-[40px] sm:px-10 {{ $map->image ? 'pt-8 sm:pt-10' : 'py-10 sm:py-12' }}">
                        @if (filled($map->title))
                            <h2 class="px-2 text-2xl font-bold text-white sm:text-3xl">{{ $map->title }}</h2>
                        @endif
                        @if ($map->image)
                            <img src="{{ $img($map->image) }}" alt="Peta sebaran klien di Indonesia"
                                class="mx-auto block h-auto w-full max-w-3xl {{ filled($map->title) ? 'mt-2 sm:mt-4' : '' }}" loading="lazy" decoding="async">
                        @endif
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- Products --}}
    @if ($products->isNotEmpty())
        <section class="reveal scroll-mt-24" id="produk">
            <div class="page-container py-12 sm:py-16">
                <h2 class="section-title">Produk Kami</h2>
                <div class="mt-10 flex flex-wrap justify-center gap-6 lg:gap-8">
                    @foreach ($products as $product)
                        @php
                            $modules = $modulesByProduct->get($product->id, collect());
                            $extraModules = max(0, $modules->count() - \App\Http\Controllers\HomeController::MODULES_PER_PRODUCT);
                        @endphp
                        <article class="{{ $productWidth }} flex flex-col overflow-hidden rounded-2xl border border-black/10 bg-white transition hover:border-brand/40 hover:shadow-xl">
                            <div class="aspect-[16/10] w-full overflow-hidden bg-mist">
                                @if ($product->image)
                                    <img src="{{ $img($product->image) }}" alt="{{ $product->title }}"
                                        class="h-full w-full object-cover" loading="lazy" decoding="async">
                                @endif
                            </div>
                            <div class="flex flex-1 flex-col p-6 sm:p-8">
                                <h3 class="text-2xl font-bold text-ink sm:text-[1.75rem]">{{ $product->title }}</h3>
                                @if (filled($product->subTitle))
                                    <p class="mt-1 text-base font-medium text-ink/80 sm:text-lg">{{ $product->subTitle }}</p>
                                @endif
                                @if (filled($product->description))
                                    <p class="mt-4 line-clamp-4 text-sm leading-relaxed text-muted sm:text-base">{{ $product->description }}</p>
                                @endif
                                @if ($modules->isNotEmpty())
                                    <ul class="mt-5 space-y-2.5">
                                        @foreach ($modules->take(\App\Http\Controllers\HomeController::MODULES_PER_PRODUCT) as $modul)
                                            <li class="flex gap-2.5 text-sm text-ink sm:text-base">
                                                <x-icon name="circle-check" class="mt-1 text-brand" />{{ $modul->title }}
                                            </li>
                                        @endforeach
                                        @if ($extraModules > 0)
                                            <li class="pl-6 text-sm font-medium text-brand-link">+{{ $extraModules }} modul lainnya</li>
                                        @endif
                                    </ul>
                                @endif
                                <div class="mt-auto pt-6">
                                    <div class="border-t border-black/10 pt-6">
                                        <a href="{{ $product->publicUrl() }}" class="btn btn-primary">
                                            Pelajari Lanjut<x-icon name="arrow-right" class="text-sm" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Video --}}
    @if ($video && filled($video->video))
        @php($hasVideoText = filled($video->title) || filled($video->description))
        <section class="reveal bg-brand-dark">
            <div class="page-container py-12 sm:py-16">
                <div class="grid items-center gap-8 {{ $hasVideoText ? 'lg:grid-cols-2 lg:gap-12' : 'mx-auto max-w-4xl' }}">
                    @if ($hasVideoText)
                        <div class="text-center text-white lg:text-left">
                            @if (filled($video->title))
                                <h2 class="text-2xl font-bold sm:text-3xl lg:text-[2rem]">{{ $video->title }}</h2>
                            @endif
                            @if (filled($video->description))
                                <p class="mt-4 text-base leading-relaxed text-white/85 sm:text-lg">{{ $video->description }}</p>
                            @endif
                        </div>
                    @endif
                    @include('UserPage.Layouts.youtube', [
                        'video' => $video->video,
                        'title' => $video->title,
                        'class' => 'rounded-2xl shadow-2xl',
                    ])
                </div>
            </div>
        </section>
    @endif

    {{-- News & Update --}}
    @if ($articles->isNotEmpty())
        <section class="reveal">
            <div class="page-container py-12 sm:py-16">
                <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
                    <h2 class="section-title">News &amp; Update</h2>
                    <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-brand-link hover:underline sm:text-base">
                        Lihat semua artikel<x-icon name="arrow-right" class="text-xs" />
                    </a>
                </div>

                {{-- With fewer articles than fit on screen, Swiper centers them and hides the pagination. --}}
                <div class="swiper mt-8 !pb-12" x-data
                    x-init="initSwiper($el, { slidesPerView: 1.1, spaceBetween: 16, breakpoints: { 640: { slidesPerView: 2, spaceBetween: 20 }, 1024: { slidesPerView: 3, spaceBetween: 24 } } })">
                    <div class="swiper-wrapper">
                        @foreach ($articles as $article)
                            <div class="swiper-slide !h-auto">
                                <article class="group flex h-full flex-col overflow-hidden rounded-2xl border border-black/10 bg-white transition hover:shadow-lg">
                                    <div class="aspect-video overflow-hidden bg-mist">
                                        @if ($article->image)
                                            <img src="{{ $img($article->image) }}" alt="{{ $article->title }}"
                                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                                loading="lazy" decoding="async">
                                        @endif
                                    </div>
                                    <div class="flex flex-1 flex-col p-5">
                                        <h3 class="line-clamp-2 text-lg font-bold text-ink">{{ $article->title }}</h3>
                                        <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-muted">
                                            {{ \Illuminate\Support\Str::limit(trim(strip_tags((string) $article->description)), 220) }}</p>
                                        <a href="{{ $article->publicUrl() }}"
                                            class="mt-auto inline-flex items-center gap-2 pt-4 text-sm font-medium text-brand-link hover:underline">
                                            Pelajari Lanjut<x-icon name="arrow-right" class="text-xs" />
                                        </a>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination !bottom-0"></div>
                </div>
            </div>
        </section>
    @endif
@endsection
