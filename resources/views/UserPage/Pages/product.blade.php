@extends('UserPage.Layouts.app')

@php($productTitle = optional($detailproductContent['products'] ?? null)->title)

@section('title', $productTitle ? "{$productTitle} - SIMRS NCI Medismart" : 'SIMRS NCI Medismart')
@if (! empty($detailproductContent['descriptionView']))
    @section('description', \Illuminate\Support\Str::limit(strip_tags($detailproductContent['descriptionView']), 160))
@endif

@section('content')
    @include('UserPage.Layouts.wa-icon')

    {{-- Intro --}}
    <section class="reveal">
        <div class="bg-mist py-2.5 text-center min-[361px]:py-5 min-[581px]:py-12">
            <div class="page-container">
                @isset($detailproductContent['logoView'])
                    <div class="py-7">
                        <img src="{{ asset('storage/' . $detailproductContent['logoView']) }}" alt="{{ $productTitle }}"
                            class="mx-auto w-full max-w-[500px]">
                    </div>
                @endisset
                @isset($detailproductContent['descriptionView'])
                    <p class="mb-5 text-sm tracking-[2px] text-ink min-[581px]:text-xl">
                        {{ $detailproductContent['descriptionView'] }}</p>
                @endisset
                <div class="flex flex-wrap justify-center gap-2.5">
                    @foreach ($whatsappContent['whatsappView'] as $phone_number)
                        <a href="https://api.whatsapp.com/send?phone={{ urlencode($phone_number) }}" target="_blank"
                            rel="noopener noreferrer"
                            class="mt-4 inline-block rounded-[10px] border-2 border-brand bg-brand px-2.5 py-2.5 text-xs text-white transition hover:border-brand-dark hover:bg-brand-dark min-[361px]:px-4 min-[361px]:py-4 min-[361px]:text-sm min-[581px]:mt-6 min-[581px]:px-6 min-[581px]:py-5 min-[581px]:text-base">
                            Hubungi Kami
                        </a>
                    @endforeach
                    @isset($detailproductContent['flyerView'])
                        <a href="{{ $detailproductContent['flyerView'] }}" target="_blank" rel="noopener noreferrer"
                            class="mt-4 inline-block rounded-[10px] border-2 border-brand px-2.5 py-2.5 text-xs text-brand transition hover:border-brand-dark hover:bg-brand-dark hover:text-white min-[361px]:px-4 min-[361px]:py-4 min-[361px]:text-sm min-[581px]:mt-6 min-[581px]:px-6 min-[581px]:py-5 min-[581px]:text-base">
                            Download Flyer
                        </a>
                    @endisset
                </div>
            </div>
        </div>
    </section>

    {{-- Video --}}
    @isset($detailproductContent['videoView'])
        <section class="reveal">
            <div
                class="relative overflow-hidden bg-[linear-gradient(to_bottom,#f1f5f9_50%,transparent_50%)] before:absolute before:bottom-0 before:h-1/2 before:w-full before:bg-gradient-to-r before:from-brand before:to-[#28b88d] before:content-['']">
                <div class="page-container">
                    <div class="relative z-10 mx-auto aspect-video max-w-[800px]">
                        <iframe class="h-full w-full rounded-[20px] border-[20px] border-black"
                            src="https://www.youtube.com/embed/{{ $detailproductContent['videoView'] }}"
                            title="Video {{ $productTitle }}"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </section>
    @endisset

    {{-- Client --}}
    <section class="reveal">
        <div class="bg-gradient-to-r from-brand to-[#28b88d] py-5 text-center">
            <div class="page-container">
                <h2 class="text-lg font-bold text-white min-[361px]:text-2xl min-[581px]:text-[32px]">Mitra {{ $productTitle }}</h2>
                @if ($clientproductContent['imageView'])
                    <img src="{{ asset('storage/' . $clientproductContent['imageView']) }}" alt="Mitra {{ $productTitle }}"
                        class="mx-auto w-full max-w-[1500px]" loading="lazy">
                @endif
            </div>
        </div>
    </section>

    {{-- Advantage --}}
    <section class="reveal">
        <div class="py-5">
            <div class="page-container">
                <h2 class="text-center text-2xl font-bold text-ink min-[361px]:text-[32px]">Kelebihan {{ $productTitle }}</h2>
                <div class="grid grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-5 py-7">
                    @foreach ($advantageproductContent as $advantageProduct)
                        <div class="rounded-[10px] bg-[#e7ecf2] p-7 text-ink">
                            <img src="{{ asset('storage/' . $advantageProduct->icon) }}" alt=""
                                class="mb-4 w-full max-w-[35px]" loading="lazy">
                            <h3 class="mb-5 text-xl font-bold min-[361px]:text-2xl">{{ $advantageProduct->title }}</h3>
                            <ul class="space-y-4">
                                @foreach ($advantageProduct->advantageListProducts as $advantageList)
                                    <li class="flex text-base min-[361px]:text-lg">
                                        <i class="fa-solid fa-circle-check mr-2.5 mt-1 shrink-0 text-brand"></i>{{ $advantageList->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Sparasi --}}
    @if ($sparasiContent['imageView'])
        <section class="reveal max-w-full py-4 text-center">
            <img src="{{ asset('storage/' . $sparasiContent['imageView']) }}" alt="Sparasi {{ $productTitle }}"
                class="mx-auto max-w-full" loading="lazy">
        </section>
    @endif

    {{-- Modul --}}
    <section class="reveal">
        <div class="bg-[#fcfcfc] py-5" x-data="loadMore({ initial: 15, step: 5, total: {{ count($modulproductContent) }} })">
            <div class="page-container">
                <div class="text-center text-ink">
                    <h2 class="mb-5 text-2xl font-bold min-[361px]:text-[28px] min-[581px]:text-[32px]">Modul {{ $productTitle }}</h2>
                    @isset($detailproductContent['moduldescView'])
                        <div class="mb-12 px-0 text-sm min-[361px]:text-base min-[581px]:text-xl min-[801px]:px-[50px] min-[1281px]:px-[120px]">
                            {!! $detailproductContent['moduldescView'] !!}</div>
                    @endisset
                </div>

                <div class="grid grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-2.5 py-5">
                    @foreach ($modulproductContent as $modulProduct)
                        <a href="{{ route('modul.show', ['id' => $modulProduct->id]) }}" x-show="{{ $loop->index }} < visible"
                            @if ($loop->index >= 15) x-cloak @endif
                            class="group block rounded-[10px] bg-[#fcfcfc] p-5 text-center text-ink transition hover:-translate-y-7 hover:scale-110 hover:shadow-[0_6px_20px_#000]">
                            <h3 class="mb-2.5 text-lg font-bold group-hover:text-brand min-[581px]:text-xl">{{ $modulProduct->title }}</h3>
                            <img src="{{ asset('storage/' . $modulProduct->icon) }}" alt=""
                                class="mx-auto mb-2.5 w-full max-w-[230px]" loading="lazy">
                            <p class="mb-5 line-clamp-2 text-sm">{{ $modulProduct->description }}</p>
                            <span class="hidden text-sm text-brand group-hover:block">Pelajari Lebih Lanjut...</span>
                        </a>
                    @endforeach
                </div>

                <div class="text-center" x-show="hasMore" x-cloak>
                    <button type="button" @click="more()"
                        class="inline-block rounded-[10px] bg-brand px-12 py-4 text-base text-white transition hover:bg-brand-dark min-[581px]:px-[60px] min-[581px]:text-xl">
                        Lihat Semua Modul
                    </button>
                </div>
            </div>
        </div>
    </section>

    @include('UserPage.Layouts.testimonial-slider', [
        'testimonials' => collect($feedbackContent['imageView'])
            ->map(fn ($image, $i) => [
                'image' => $image,
                'name' => $feedbackContent['nameView'][$i] ?? null,
                'description' => $feedbackContent['descriptionView'][$i] ?? null,
            ])
            ->values()
            ->all(),
    ])

    @include('UserPage.Layouts.question')
@endsection
