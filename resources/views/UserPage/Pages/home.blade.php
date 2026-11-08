@extends('UserPage.Layouts.app')

@section('title', 'NCI Medismart')
@section('description', 'SIMRS NCI Medismart adalah aplikasi yang terintegrasi dengan platform satu sehat, cetak SEP BPJS')

@push('meta')
    <meta name="google-site-verification" content="whvf61-mi-MkaBQzB8XrYdaQeWN33nkeYvJPj2YieAc">
    <meta name="author" content="SIM RS">
    <meta name="keywords" content="simrs, sim rs, sim rumah sakit, satu sehat, bridging bpjs, integrasi satu sehat">
@endpush

@php($waNumber = collect($whatsappContent['whatsappView'])->first())

@section('content')
    @include('UserPage.Layouts.popups')
    @include('UserPage.Layouts.wa-icon')

    {{-- Hero slider (no reveal: it is above the fold) --}}
    <section class="relative bg-ink" aria-label="Sorotan">
        <div class="swiper h-[calc(100svh-6.25rem)] max-h-[820px] min-h-[460px] sm:h-[calc(100svh-7.25rem)]" x-data
            x-init="initSwiper($el, { slidesPerView: 1, loop: {{ count($sliderContent['titleView']) > 1 ? 'true' : 'false' }} })">
            <div class="swiper-wrapper">
                @foreach ($sliderContent['titleView'] as $index => $title)
                    <div class="swiper-slide relative overflow-hidden">
                        <img src="{{ asset('storage/' . $sliderContent['imageView'][$index]) }}" alt=""
                            class="absolute inset-0 h-full w-full object-cover"
                            @if ($loop->first) fetchpriority="high" @else loading="lazy" @endif>
                        <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/45 to-black/10" aria-hidden="true"></div>

                        <div class="relative mx-auto flex h-full w-full max-w-7xl items-center px-5 sm:px-8">
                            <div class="max-w-2xl text-white">
                                <h1 class="text-3xl font-bold leading-tight sm:text-4xl lg:text-5xl lg:leading-tight">
                                    {!! $title !!}</h1>
                                <div class="mt-4 text-base text-white/90 sm:text-lg lg:text-xl">
                                    {!! $sliderContent['captionView'][$index] !!}</div>
                                <div class="mt-8 flex flex-wrap gap-3">
                                    @if ($waNumber)
                                        <a href="https://api.whatsapp.com/send?phone={{ urlencode($waNumber) }}"
                                            target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                                            <i class="fa-brands fa-whatsapp"></i>Hubungi Kami
                                        </a>
                                    @endif
                                    @if ($sliderContent['statusView'][$index] == 1)
                                        <a href="{{ $sliderContent['linkView'][$index] }}" class="btn btn-outline-light">
                                            Pelajari Lanjut<i class="fa-solid fa-arrow-right text-sm"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if (count($sliderContent['titleView']) > 1)
                <div class="swiper-button-prev nav-btn !left-6 !hidden !rounded-full lg:!flex"></div>
                <div class="swiper-button-next nav-btn !right-6 !hidden !rounded-full lg:!flex"></div>
                <div class="swiper-pagination !bottom-6 [--swiper-pagination-bullet-inactive-color:#fff] [--swiper-pagination-bullet-inactive-opacity:0.6] [--swiper-pagination-color:#1bad4b]"></div>
            @endif
        </div>
    </section>

    {{-- Client --}}
    <section class="reveal relative overflow-hidden bg-brand text-white">
        <div class="page-container relative z-10 pb-24 pt-12 sm:pb-32 sm:pt-16">
            <h2 class="text-center text-2xl font-bold sm:text-3xl">{{ $clientContent['titleView'] }}</h2>
            <div class="mx-auto mt-4 h-px w-24 bg-white/70" aria-hidden="true"></div>
            @if ($clientContent['imageView'])
                <img src="{{ $clientContent['imageView'] }}" alt="Klien NCI Medismart" class="mx-auto mt-8 w-full max-w-5xl"
                    loading="lazy">
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

    {{-- Experience --}}
    <section class="reveal bg-mist">
        <div class="page-container py-12 sm:py-16">
            <div class="mx-auto max-w-3xl text-center text-ink">
                <div class="text-2xl leading-snug sm:text-3xl lg:text-[2rem]">{!! $experienceContent['titleView'] !!}</div>
                <div class="mt-4 text-base text-ink/80 sm:text-lg">{!! $experienceContent['descriptionView'] !!}</div>
            </div>

            <div class="mt-10 grid grid-cols-2 gap-4 sm:gap-6 lg:grid-cols-4">
                @foreach ($experiencelistContent['imageView'] as $index => $image)
                    <div class="rounded-2xl bg-white p-5 text-center shadow-sm sm:p-7">
                        <img src="{{ asset('storage/' . $image) }}" alt=""
                            class="mx-auto h-12 w-12 object-contain sm:h-16 sm:w-16" loading="lazy">
                        <h3 class="mt-4 text-base font-bold sm:text-xl">{{ $experiencelistContent['nameView'][$index] }}</h3>
                        <p class="mt-2 text-xs text-muted sm:text-sm">{{ $experiencelistContent['descriptionView'][$index] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 overflow-hidden rounded-3xl bg-brand-dark px-6 pt-10 text-center sm:rounded-[40px] sm:px-10 sm:pt-12">
                <h2 class="text-2xl font-bold text-white sm:text-3xl">{{ $mapContent['titleView'] }}</h2>
                @if ($mapContent['imageView'])
                    <img src="{{ $mapContent['imageView'] }}" alt="Peta sebaran klien di Indonesia"
                        class="mx-auto mt-6 w-full max-w-3xl" loading="lazy">
                @endif
            </div>
        </div>
    </section>

    {{-- Product --}}
    <section class="reveal">
        <div class="page-container py-12 sm:py-16">
            <h2 class="section-title">Produk Kami</h2>
            <div class="mt-10 grid gap-6 md:grid-cols-2 lg:gap-8">
                @foreach ($productContent['imageView'] as $index => $image)
                    <article
                        class="flex flex-col overflow-hidden rounded-2xl border border-black/10 bg-white transition hover:-translate-y-1 hover:shadow-xl">
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $productContent['titleView'][$index] }}"
                            class="aspect-[16/10] w-full object-cover" loading="lazy">
                        <div class="flex flex-1 flex-col p-6 sm:p-8">
                            <h3 class="text-2xl font-bold text-ink sm:text-[1.75rem]">{{ $productContent['titleView'][$index] }}</h3>
                            <p class="mt-1 text-base font-medium text-ink/80 sm:text-lg">{{ $productContent['subtitleView'][$index] }}</p>
                            <p class="mt-4 text-sm leading-relaxed text-muted sm:text-base">{{ $productContent['descriptionView'][$index] }}</p>
                            <ul class="mt-5 space-y-2.5">
                                @foreach ($productContent['modulView'] as $modul)
                                    @if ($modul->productId == $productContent['idView'][$index])
                                        <li class="flex gap-2.5 text-sm text-ink sm:text-base">
                                            <i class="fa-solid fa-circle-check mt-1 shrink-0 text-brand"></i>{{ $modul->title }}
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                            <div class="mt-auto border-t border-black/10 pt-6">
                                <a href="{{ url('/ProductView/' . $productContent['idView'][$index]) }}" class="btn btn-primary mt-6 sm:mt-0">
                                    Pelajari Lanjut<i class="fa-solid fa-arrow-right text-sm"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Video --}}
    <section class="reveal bg-brand-dark">
        <div class="page-container py-12 sm:py-16">
            <div class="grid items-center gap-8 lg:grid-cols-2 lg:gap-12">
                <div class="text-center text-white lg:text-left">
                    <h2 class="text-2xl font-bold sm:text-3xl lg:text-[2rem]">{{ $videoContent['titleView'] }}</h2>
                    <p class="mt-4 text-base leading-relaxed text-white/85 sm:text-lg">{{ $videoContent['descriptionView'] }}</p>
                </div>
                @if ($videoContent['videoView'])
                    <iframe class="aspect-video w-full rounded-2xl shadow-2xl"
                        src="https://www.youtube.com/embed/{{ $videoContent['videoView'] }}"
                        title="{{ $videoContent['titleView'] ?: 'Video NCI Medismart' }}"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen loading="lazy"></iframe>
                @endif
            </div>
        </div>
    </section>

    {{-- Blog --}}
    <section class="reveal">
        <div class="page-container py-12 sm:py-16">
            <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
                <h2 class="section-title">News &amp; Update</h2>
                <a href="{{ url('/Blog') }}" class="text-sm font-medium text-brand-link hover:underline sm:text-base">
                    Lihat semua artikel<i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                </a>
            </div>

            <div class="swiper mt-8 !pb-12" x-data
                x-init="initSwiper($el, { slidesPerView: 1.1, spaceBetween: 16, breakpoints: { 640: { slidesPerView: 2, spaceBetween: 20 }, 1024: { slidesPerView: 3, spaceBetween: 24 } } })">
                <div class="swiper-wrapper">
                    @foreach ($articleContent['imageView'] as $index => $image)
                        <div class="swiper-slide !h-auto">
                            <article class="group flex h-full flex-col overflow-hidden rounded-2xl border border-black/10 bg-white transition hover:shadow-lg">
                                <div class="overflow-hidden">
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $articleContent['titleView'][$index] }}"
                                        class="aspect-video w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                                </div>
                                <div class="flex flex-1 flex-col p-5">
                                    <h3 class="line-clamp-2 text-lg font-bold text-ink">{{ $articleContent['titleView'][$index] }}</h3>
                                    <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-muted">
                                        {{ strip_tags($articleContent['descriptionView'][$index]) }}</p>
                                    <a href="{{ route('detail.show', ['id' => $articleContent['idView'][$index]]) }}"
                                        class="mt-auto pt-4 text-sm font-medium text-brand-link hover:underline">
                                        Pelajari Lanjut<i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
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
@endsection
