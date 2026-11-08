@extends('UserPage.Layouts.app')

@section('title', 'Testimoni Klien SIMRS | NCI Medismart')
@section('description', 'Apa kata rumah sakit dan fasilitas kesehatan tentang SIMRS NCI Medismart: pengalaman nyata klien kami di seluruh Indonesia.')

@section('content')
    @include('UserPage.Layouts.wa-icon')

    <section class="reveal">
        <div class="page-container py-10 sm:py-14" x-data="loadMore({ initial: 9, step: 6, total: {{ $testimonials->count() }} })">
            @include('UserPage.Layouts.breadcrumb', ['items' => [['Testimoni', null]]])
            <div class="mx-auto mt-4 max-w-2xl text-center">
                <h1 class="text-3xl font-bold text-ink sm:text-4xl">Apa Kata Klien Tentang Kami</h1>
                <p class="mt-3 text-base text-ink/70 sm:text-lg">Pengalaman fasilitas kesehatan yang telah menggunakan NCI Medismart.</p>
            </div>

            @if ($testimonials->isEmpty())
                <p class="mx-auto mt-10 max-w-xl rounded-2xl bg-mist p-10 text-center text-ink/70">Belum ada testimoni.</p>
            @else
                <div class="mt-10 flex flex-wrap justify-center gap-6">
                    @foreach ($testimonials as $testimonial)
                        <figure class="flex w-full flex-col rounded-2xl border border-black/10 bg-white p-6 text-center shadow-sm md:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)] sm:p-8"
                            x-show="{{ $loop->index }} < visible" @if ($loop->index >= 9) x-cloak @endif>
                            @if ($testimonial->image)
                                <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Logo {{ $testimonial->name }}"
                                    class="mx-auto h-16 w-auto max-w-[160px] object-contain" loading="lazy" decoding="async">
                            @endif
                            <blockquote class="mt-5 flex-1 text-base leading-relaxed text-ink/80">
                                <p>&ldquo;{{ $testimonial->description }}&rdquo;</p>
                            </blockquote>
                            <figcaption class="mt-5 font-bold text-ink">{{ $testimonial->name }}</figcaption>
                        </figure>
                    @endforeach
                </div>
                <div class="mt-10 text-center" x-show="hasMore" x-cloak>
                    <button type="button" @click="more()" class="btn border border-brand text-brand-dark hover:bg-brand hover:text-white">
                        Muat lebih banyak</button>
                </div>
            @endif
        </div>
    </section>

    @if ($map && (filled($map->title) || filled($map->image)))
        <section class="reveal bg-mist">
            <div class="page-container py-12 sm:py-16 text-center">
                @if (filled($map->title))
                    <h2 class="section-title">{{ $map->title }}</h2>
                @endif
                @if ($map->image)
                    <img src="{{ asset('storage/' . $map->image) }}" alt="Peta sebaran klien di Indonesia"
                        class="mx-auto mt-8 block h-auto w-full max-w-4xl" loading="lazy" decoding="async">
                @endif
            </div>
        </section>
    @endif

    @include('UserPage.Layouts.question')
@endsection
