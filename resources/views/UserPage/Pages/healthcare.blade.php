@extends('UserPage.Layouts.app')

@section('title', 'Tentang Kami – Healthcare Solution | NCI Medismart')
@if ($about && filled($about->description))
    @section('description', \Illuminate\Support\Str::limit(strip_tags($about->description), 155))
@else
    @section('description', 'NCI Medismart adalah solusi sistem informasi rumah sakit dari PT Nuansa Cerah Informasi, terintegrasi dengan SATUSEHAT dan BPJS.')
@endif

@php
    $misi = $about ? collect(preg_split('/\r\n|\r|\n/', (string) $about->misi))->map(fn ($line) => trim($line))->filter()->values() : collect();
@endphp

@section('content')
    @include('UserPage.Layouts.popups')
    @include('UserPage.Layouts.wa-icon')

    {{-- Intro + video --}}
    <section class="bg-gradient-to-br from-brand-dark to-brand text-white">
        <div class="page-container py-10 sm:py-14">
            @include('UserPage.Layouts.breadcrumb', ['items' => [['Tentang Kami', null]], 'light' => true])
            <div class="mx-auto mt-6 max-w-3xl text-center">
                <h1 class="text-3xl font-bold sm:text-4xl">NCI - MediSmart</h1>
                <p class="mt-3 text-base text-white/85 sm:text-lg">Healthcare Solution dari PT Nuansa Cerah Informasi</p>
            </div>
            @if ($about && filled($about->video))
                <div class="mx-auto mt-8 max-w-4xl">
                    @include('UserPage.Layouts.youtube', ['video' => $about->video, 'title' => 'Profil NCI Medismart', 'class' => 'rounded-2xl shadow-2xl'])
                </div>
            @endif
        </div>
    </section>

    @if ($about)
        {{-- About --}}
        @if (filled($about->description) || $about->image)
            <section class="reveal">
                <div class="page-container py-12 sm:py-16">
                    <div class="mx-auto flex max-w-5xl flex-col items-center gap-8 md:flex-row md:gap-12">
                        @if ($about->image)
                            <img src="{{ asset('storage/' . $about->image) }}" alt="NCI Medismart"
                                class="h-auto w-48 shrink-0 object-contain md:w-64" loading="lazy" decoding="async">
                        @endif
                        @if (filled($about->description))
                            <p class="text-center text-lg leading-relaxed text-ink/80 md:text-left md:text-xl">{{ $about->description }}</p>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        {{-- Vision & mission --}}
        @if (filled($about->visi) || $misi->isNotEmpty())
            <section class="reveal bg-mist">
                <div class="page-container py-12 sm:py-16">
                    <div class="mx-auto grid max-w-5xl gap-6 md:grid-cols-2">
                        @if (filled($about->visi))
                            <div class="rounded-2xl border border-black/10 bg-white p-6 shadow-sm sm:p-8">
                                <span class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-brand/10 text-lg text-brand-dark">
                                    <x-icon name="location-dot" /></span>
                                <h2 class="mt-4 text-2xl font-bold text-ink">Visi</h2>
                                <p class="mt-3 text-base leading-relaxed text-ink/80 sm:text-lg">{{ $about->visi }}</p>
                            </div>
                        @endif
                        @if ($misi->isNotEmpty())
                            <div class="rounded-2xl border border-black/10 bg-white p-6 shadow-sm sm:p-8">
                                <span class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-brand/10 text-lg text-brand-dark">
                                    <x-icon name="circle-check" /></span>
                                <h2 class="mt-4 text-2xl font-bold text-ink">Misi</h2>
                                <ul class="mt-3 space-y-2.5">
                                    @foreach ($misi as $line)
                                        <li class="flex gap-2.5 text-base leading-relaxed text-ink/80 sm:text-lg">
                                            <x-icon name="circle-check" class="mt-1.5 text-sm text-brand" />{{ $line }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif
    @endif

    @include('UserPage.Layouts.question')
@endsection
