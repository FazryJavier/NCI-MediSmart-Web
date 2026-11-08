@extends('UserPage.Layouts.app')

@section('title', 'NCI Medismart')
@section('description', 'SIMRS NCI Medismart adalah aplikasi yang terintegrasi dengan platform satu sehat, cetak SEP BPJS')

@push('meta')
    <meta name="google-site-verification" content="whvf61-mi-MkaBQzB8XrYdaQeWN33nkeYvJPj2YieAc">
    <meta name="author" content="SIM RS">
    <meta name="keywords" content="simrs, sim rs, sim rumah sakit, satu sehat, bridging bpjs, integrasi satu sehat">
@endpush

@section('content')
    @include('UserPage.Layouts.popups')
    @include('UserPage.Layouts.wa-icon')

    {{-- Hero slider --}}
    <section class="reveal h-screen w-full bg-white">
        <div class="swiper h-full" x-data x-init="initSwiper($el, { slidesPerView: 1, loop: {{ count($sliderContent['titleView']) > 1 ? 'true' : 'false' }} })">
            <div class="swiper-wrapper">
                @foreach ($sliderContent['titleView'] as $index => $title)
                    <div class="swiper-slide relative overflow-hidden">
                        <img src="{{ asset('storage/' . $sliderContent['imageView'][$index]) }}" alt=""
                            class="h-full w-full object-cover" @if (! $loop->first) loading="lazy" @endif>
                        <div class="absolute left-[10%] top-[15%] w-[80%] text-left min-[581px]:top-[20%] lg:w-[55%] xl:w-[45%]">
                            <h1
                                class="text-[28px] font-bold leading-tight text-white [text-shadow:2px_2px_4px_rgba(105,105,105,0.5)] min-[361px]:text-[38px] min-[581px]:text-5xl">
                                {!! $title !!}</h1>
                            <p class="py-2.5 text-base text-white [text-shadow:2px_2px_4px_rgba(105,105,105,0.5)] min-[581px]:text-xl">
                                {!! $sliderContent['captionView'][$index] !!}</p>
                            <div class="flex flex-wrap gap-2.5">
                                @foreach ($whatsappContent['whatsappView'] as $phone_number)
                                    <a href="https://api.whatsapp.com/send?phone={{ urlencode($phone_number) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="mt-2.5 inline-block rounded-[10px] border-2 border-brand bg-brand px-4 py-2.5 text-xs text-white transition hover:border-brand-dark hover:bg-brand-dark min-[361px]:px-5 min-[361px]:py-4 min-[361px]:text-sm min-[581px]:mt-6 min-[581px]:px-6 min-[581px]:py-5 min-[581px]:text-base">
                                        Hubungi Kami
                                    </a>
                                @endforeach
                                @if ($sliderContent['statusView'][$index] == 1)
                                    <a href="{{ $sliderContent['linkView'][$index] }}"
                                        class="mt-2.5 inline-block rounded-[10px] border-2 border-white px-4 py-2.5 text-xs text-ink transition hover:border-brand-dark hover:bg-brand-dark hover:text-white min-[361px]:px-5 min-[361px]:py-4 min-[361px]:text-sm min-[581px]:mt-6 min-[581px]:px-6 min-[581px]:py-5 min-[581px]:text-base">
                                        Pelajari Lanjut
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="swiper-button-next nav-btn !right-6 max-[680px]:!hidden"></div>
            <div class="swiper-button-prev nav-btn !left-6 max-[680px]:!hidden"></div>
            <div class="swiper-pagination [&_.swiper-pagination-bullet]:!h-2.5"></div>
        </div>
    </section>

    {{-- Client --}}
    <section class="reveal">
        <div class="relative overflow-hidden bg-brand pb-2.5 pt-2.5 text-white min-[501px]:pt-12">
            <div class="page-container">
                <h2 class="text-center text-xl font-bold min-[361px]:text-[26px] min-[501px]:text-3xl">
                    {{ $clientContent['titleView'] }}</h2>
                <div class="grid place-items-center p-2.5">
                    <div class="mt-1 h-px w-[45%] bg-white"></div>
                </div>
                @if ($clientContent['imageView'])
                    <img src="{{ $clientContent['imageView'] }}" alt="Klien NCI Medismart" class="relative z-10 mb-[100px] w-full"
                        loading="lazy">
                @endif
            </div>

            <div class="absolute bottom-0 left-0 w-full rotate-180 overflow-hidden leading-[0]" aria-hidden="true">
                <svg class="relative block h-[200px] w-[calc(300%+1.3px)]" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path class="fill-mist"
                        d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z">
                    </path>
                </svg>
            </div>
        </div>
    </section>

    {{-- Experience --}}
    <section class="reveal">
        <div class="bg-mist py-5">
            <div class="page-container">
                <div class="mx-0 text-center text-ink min-[681px]:mx-[50px] min-[1201px]:mx-20 min-[1501px]:mx-[150px]">
                    <div class="mb-7 text-[22px] min-[361px]:text-[28px] min-[581px]:text-[32px]">
                        {!! $experienceContent['titleView'] !!}</div>
                    <div class="text-sm min-[361px]:text-base min-[581px]:text-xl">
                        {!! $experienceContent['descriptionView'] !!}</div>
                </div>

                <div class="mt-5 grid grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-10 text-center">
                    @foreach ($experiencelistContent['imageView'] as $index => $image)
                        <div class="p-5 min-[501px]:p-10">
                            <img src="{{ asset('storage/' . $image) }}" alt=""
                                class="mx-auto mb-2.5 w-full max-w-[70px] min-[501px]:max-w-[100px]" loading="lazy">
                            <h3 class="mb-4 text-xl font-bold min-[501px]:mb-6 min-[501px]:text-2xl">
                                {{ $experiencelistContent['nameView'][$index] }}</h3>
                            <p class="text-sm min-[501px]:text-base">{{ $experiencelistContent['descriptionView'][$index] }}
                            </p>
                        </div>
                    @endforeach
                </div>

                <div class="relative flex min-h-[281px] w-full rounded-[55px] bg-brand-dark">
                    <p class="absolute top-1/2 w-full -translate-y-1/2 px-5 text-center text-2xl font-bold text-white sm:text-[32px]">
                        {{ $mapContent['titleView'] }}</p>
                    @if ($mapContent['imageView'])
                        <div class="m-auto overflow-hidden">
                            <img src="{{ $mapContent['imageView'] }}" alt="Peta sebaran klien di Indonesia"
                                class="-mt-6 w-full max-w-[750px]" loading="lazy">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Product --}}
    <section class="reveal">
        <div class="py-12">
            <div class="page-container">
                <h2 class="text-center text-[32px] font-bold text-ink">Produk Kami</h2>
                <div class="mt-12 grid grid-cols-1 gap-10 lg:grid-cols-2">
                    @foreach ($productContent['imageView'] as $index => $image)
                        <div class="flex flex-col p-5 transition hover:rounded-[20px] hover:shadow-[1px_1px_5px_0px_grey]">
                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $productContent['titleView'][$index] }}"
                                class="mb-5 w-full rounded-[10px]" loading="lazy">
                            <div>
                                <h3 class="text-[26px] font-bold text-ink min-[501px]:text-[32px]">
                                    {{ $productContent['titleView'][$index] }}</h3>
                                <p class="mb-4 text-xl font-medium text-ink min-[501px]:text-2xl">
                                    {{ $productContent['subtitleView'][$index] }}</p>
                                <p class="mb-7 text-xs text-muted min-[501px]:text-base">
                                    {{ $productContent['descriptionView'][$index] }}</p>
                                <ul class="space-y-2.5">
                                    @foreach ($productContent['modulView'] as $modul)
                                        @if ($modul->productId == $productContent['idView'][$index])
                                            <li class="flex text-sm text-ink min-[501px]:text-xl">
                                                <i class="fa-solid fa-circle-check mr-2.5 mt-1 shrink-0 text-brand"></i>{{ $modul->title }}
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mt-auto px-5">
                                <div class="py-5">
                                    <div class="h-px w-full bg-gray-400"></div>
                                </div>
                                <div class="py-2.5 min-[501px]:py-5">
                                    <a href="{{ url('/ProductView/' . $productContent['idView'][$index]) }}"
                                        class="inline-block rounded-[10px] bg-brand px-4 py-4 text-xs text-white transition hover:bg-brand-dark min-[501px]:px-6 min-[501px]:text-xl">
                                        <i class="fa-solid fa-arrow-right mr-2.5 min-[501px]:mr-5"></i>Pelajari Lanjut
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Video --}}
    <section class="reveal">
        <div class="bg-brand-dark">
            <div class="page-container">
                <div class="my-[3%] grid grid-cols-1 items-center gap-10 text-center min-[801px]:grid-cols-2 min-[801px]:text-left">
                    <div class="text-white min-[1351px]:mr-[10%]">
                        <h2 class="mb-5 text-[32px] font-bold">{{ $videoContent['titleView'] }}</h2>
                        <p class="mt-[2%] text-xl">{{ $videoContent['descriptionView'] }}</p>
                    </div>
                    @if ($videoContent['videoView'])
                        <iframe class="aspect-video w-full rounded-[20px]"
                            src="https://www.youtube.com/embed/{{ $videoContent['videoView'] }}"
                            title="{{ $videoContent['titleView'] ?: 'Video NCI Medismart' }}"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen loading="lazy"></iframe>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Blog --}}
    <section class="reveal">
        <div class="page-container">
            <h2 class="py-5 text-center text-[30px] font-bold min-[361px]:text-[42px]">News &amp; Update</h2>

            <div class="swiper" x-data
                x-init="initSwiper($el, { slidesPerView: 1, spaceBetween: 10, breakpoints: { 768: { slidesPerView: 2, spaceBetween: 20 }, 1024: { slidesPerView: 3, spaceBetween: 20 } } })">
                <div class="swiper-wrapper">
                    @foreach ($articleContent['imageView'] as $index => $image)
                        <div class="swiper-slide !h-auto pb-8">
                            <article class="flex h-full flex-col rounded-[20px] border border-[#bcbcbc] bg-[#f5f5f5] text-ink">
                                <div class="overflow-hidden rounded-[20px]">
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $articleContent['titleView'][$index] }}"
                                        class="h-full w-full object-cover" loading="lazy">
                                </div>
                                <div class="flex flex-1 flex-col px-5">
                                    <h3 class="py-2.5 text-xl font-bold">{{ $articleContent['titleView'][$index] }}</h3>
                                    <p class="line-clamp-5 text-justify text-base text-muted">
                                        {{ strip_tags($articleContent['descriptionView'][$index]) }}</p>
                                    <div class="mt-auto py-5 text-right">
                                        <a href="{{ route('detail.show', ['id' => $articleContent['idView'][$index]]) }}"
                                            class="text-lg text-brand-link hover:underline">Pelajari Lanjut</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
@endsection
