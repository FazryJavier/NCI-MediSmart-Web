@extends('UserPage.Layouts.app')

@section('title', 'Testimoni Klien SIMRS | NCI Medismart')
@section('description', 'Apa kata rumah sakit dan fasilitas kesehatan tentang SIMRS NCI Medismart: pengalaman nyata klien kami di seluruh Indonesia.')

{{--
    Follows the testimonial design: 3-column grid with vertical dividers and a rule between rows (logo, name,
    quoted text), small outlined "Load More", the client map, the CTA, then a "Terima Kasih" section inviting
    clients to share a testimonial.
--}}
@php
    $testimonialUrl = route('testimoni.form');
@endphp

@section('content')
    @include('UserPage.Layouts.wa-icon')

    <section class="reveal">
        <div class="page-container py-12 sm:py-16" x-data="loadMore({ initial: 6, step: 3, total: {{ $testimonials->count() }} })">
            <h1 class="text-center text-2xl font-medium text-ink sm:text-3xl">Apa kata klien tentang kami</h1>

            @if ($testimonials->isEmpty())
                <p class="mt-10 text-center text-ink/70">Belum ada testimoni.</p>
            @else
                {{-- Vertical dividers between columns, a continuous rule between rows (md+); stacked with rules on phones. --}}
                <div class="mt-10 grid sm:mt-12 md:grid-cols-3">
                    @foreach ($testimonials as $testimonial)
                        <figure x-show="{{ $loop->index }} < visible" @if ($loop->index >= 6) x-cloak @endif
                            class="flex flex-col items-center border-black/10 px-4 py-8 text-center [&:not(:first-child)]:border-t md:px-6 md:[&:not(:first-child)]:border-t-0 md:[&:nth-child(3n+2)]:border-x md:[&:nth-child(n+4)]:border-t">
                            <div class="flex h-16 w-full items-center justify-center">
                                @if ($testimonial->image)
                                    <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Logo {{ $testimonial->name }}"
                                        class="max-h-16 w-auto max-w-[120px] object-contain" loading="lazy" decoding="async">
                                @endif
                            </div>
                            <figcaption class="mt-4 text-base font-medium text-ink">{{ $testimonial->name }}</figcaption>
                            <blockquote class="mt-3 max-w-xs text-sm leading-relaxed text-ink/75">&ldquo;{{ $testimonial->description }}&rdquo;</blockquote>
                        </figure>
                    @endforeach
                </div>

                <div class="mt-10 text-center" x-show="hasMore" x-cloak>
                    <button type="button" @click="more()"
                        class="rounded-lg border border-brand px-12 py-2.5 text-sm text-brand transition hover:bg-brand hover:text-white">
                        Load More</button>
                </div>
            @endif
        </div>
    </section>

    {{-- Client map --}}
    @if ($map && (filled($map->title) || filled($map->image)))
        <section class="reveal">
            <div class="page-container pb-14 text-center sm:pb-20">
                @if (filled($map->title))
                    <h2 class="text-xl font-bold text-ink sm:text-2xl">{{ $map->title }}</h2>
                @endif
                @if ($map->image)
                    <img src="{{ asset('storage/' . $map->image) }}" alt="Peta sebaran klien di Indonesia"
                        class="mx-auto mt-8 block h-auto w-full max-w-5xl" loading="lazy" decoding="async">
                @endif
            </div>
        </section>
    @endif

    @include('UserPage.Layouts.question')

    {{-- Thank-you / invite to share a testimonial --}}
    <section class="reveal overflow-hidden bg-mist">
        <div class="page-container grid items-end gap-8 pt-12 md:grid-cols-[minmax(0,2fr)_minmax(0,3fr)] md:pt-16">
            <div class="relative mx-auto w-full max-w-xs md:max-w-sm" aria-hidden="true">
                {{-- Decorative circles behind the cut-out photo. --}}
                <span class="absolute left-[8%] top-[18%] h-28 w-28 rounded-full bg-brand sm:h-36 sm:w-36"></span>
                <span class="absolute right-[2%] top-[4%] h-24 w-24 rounded-full bg-brand sm:h-32 sm:w-32"></span>
                <span class="absolute bottom-[10%] left-[2%] h-24 w-24 rounded-full bg-gray-300 sm:h-32 sm:w-32"></span>
                <span class="absolute bottom-[16%] right-[6%] h-24 w-24 rounded-full bg-brand sm:h-28 sm:w-28"></span>
                <img src="{{ asset('assets/img/img-question.png') }}" alt="" width="812" height="1356"
                    class="relative mx-auto h-auto w-3/4" loading="lazy" decoding="async">
            </div>
            <div class="pb-12 text-center md:pb-20">
                <img src="{{ asset('assets/img/Logo Medismart.png') }}" alt="NCI Medismart" width="600" height="312" class="mx-auto h-16 w-auto sm:h-20">
                <h2 class="mx-auto mt-6 max-w-lg text-2xl font-bold leading-tight text-ink sm:text-3xl">Terima Kasih telah mempercayai Kami sebagai Mitra Anda</h2>
                <p class="mx-auto mt-4 max-w-md text-base text-ink/75">Izinkan kami untuk sedikit mengetahui pengalaman anda dalam bermitra dengan kami.</p>
                <a href="{{ $testimonialUrl }}" class="btn btn-primary mt-8 !px-8">Form Testimoni</a>
            </div>
        </div>
    </section>
@endsection
