@extends('UserPage.Layouts.app')

@section('title', 'Tentang Kami – Healthcare Solution | NCI Medismart')
@if ($about && filled($about->description))
    @section('description', \Illuminate\Support\Str::limit(strip_tags($about->description), 155))
@else
    @section('description', 'NCI Medismart adalah solusi sistem informasi rumah sakit dari PT Nuansa Cerah Informasi, terintegrasi dengan SATUSEHAT dan BPJS.')
@endif

{{--
    Layout follows the "Tentang Kami" design: green band with the title and video, logo + description,
    two outlined Visi / Misi boxes, then the CTA. Every block hides itself when its content is empty.
--}}
@php
    $misi = $about ? collect(preg_split('/\r\n|\r|\n/', (string) $about->misi))->map(fn ($line) => trim($line))->filter()->values() : collect();
@endphp

@section('content')
    @include('UserPage.Layouts.popups')
    @include('UserPage.Layouts.wa-icon')

    {{-- Title + video --}}
    <section class="bg-gradient-to-r from-brand via-brand to-[#28b88d] text-white">
        <div class="page-container py-10 sm:py-12">
            <h1 class="text-center text-2xl font-bold sm:text-3xl">NCI-MediSmart</h1>
            @if ($about && filled($about->video))
                <div class="mx-auto mt-8 max-w-3xl">
                    @include('UserPage.Layouts.youtube', ['video' => $about->video, 'title' => 'Profil NCI Medismart', 'class' => 'rounded-[28px] shadow-xl'])
                </div>
            @endif
        </div>
    </section>

    @if ($about)
        {{-- Logo + description --}}
        @if (filled($about->description) || $about->image)
            <section class="reveal">
                <div class="page-container py-14 sm:py-20">
                    <div class="mx-auto flex max-w-5xl flex-col items-center gap-8 md:flex-row md:gap-12">
                        @if ($about->image)
                            <img src="{{ asset('storage/' . $about->image) }}" alt="NCI Medismart"
                                class="h-auto w-56 shrink-0 object-contain md:w-72" loading="lazy" decoding="async">
                        @endif
                        @if (filled($about->description))
                            <p class="text-center text-lg leading-relaxed text-ink md:text-left md:text-2xl md:leading-relaxed">{{ $about->description }}</p>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        {{-- Visi & Misi: two outlined boxes, centred text --}}
        @if (filled($about->visi) || $misi->isNotEmpty())
            <section class="reveal">
                <div class="page-container pb-14 sm:pb-20">
                    <div class="mx-auto grid max-w-5xl gap-4 md:grid-cols-2">
                        @if (filled($about->visi))
                            <div class="rounded-2xl border border-black/20 bg-white px-6 py-7 text-center sm:px-10">
                                <h2 class="text-2xl font-bold text-ink">Visi</h2>
                                <p class="mt-4 text-base font-medium leading-relaxed text-ink/90 sm:text-lg">{{ $about->visi }}</p>
                            </div>
                        @endif
                        @if ($misi->isNotEmpty())
                            <div class="rounded-2xl border border-black/20 bg-white px-6 py-7 text-center sm:px-10">
                                <h2 class="text-2xl font-bold text-ink">Misi</h2>
                                <div class="mt-4 space-y-2 text-base font-medium leading-relaxed text-ink/90 sm:text-lg">
                                    @foreach ($misi as $line)
                                        <p>{{ $line }}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif
    @endif

    @include('UserPage.Layouts.question')
@endsection
