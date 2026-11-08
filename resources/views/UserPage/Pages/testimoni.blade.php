@extends('UserPage.Layouts.app')

@section('title', 'Testimoni Klien SIMRS | NCI Medismart')
@section('description', 'Apa kata rumah sakit dan fasilitas kesehatan tentang SIMRS NCI Medismart: pengalaman nyata klien kami di seluruh Indonesia.')

{{--
    Original design kept (centred logo, name and quote in a 3-column layout, outlined "load more"),
    tidied: equal logo boxes so names line up, consistent type sizes, full rows centred.
--}}
@section('content')
    @include('UserPage.Layouts.wa-icon')

    <section class="reveal">
        <div class="page-container py-12 sm:py-16" x-data="loadMore({ initial: 6, step: 3, total: {{ $testimonials->count() }} })">
            <h1 class="text-center text-3xl text-ink sm:text-4xl lg:text-[2.5rem]">Apa kata klien tentang kami</h1>

            @if ($testimonials->isEmpty())
                <p class="mt-10 text-center text-ink/70">Belum ada testimoni.</p>
            @else
                <div class="mt-10 flex flex-wrap justify-center gap-x-8 gap-y-12 sm:mt-14">
                    @foreach ($testimonials as $testimonial)
                        <figure class="flex w-full flex-col items-center text-center md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.334rem)]"
                            x-show="{{ $loop->index }} < visible" @if ($loop->index >= 6) x-cloak @endif>
                            <div class="flex h-24 w-full items-center justify-center">
                                @if ($testimonial->image)
                                    <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Logo {{ $testimonial->name }}"
                                        class="max-h-24 w-auto max-w-[140px] object-contain" loading="lazy" decoding="async">
                                @endif
                            </div>
                            <figcaption class="mt-5 text-xl font-medium text-ink">{{ $testimonial->name }}</figcaption>
                            <blockquote class="mt-3 max-w-sm text-base leading-relaxed text-ink/80">{{ $testimonial->description }}</blockquote>
                        </figure>
                    @endforeach
                </div>

                <div class="mt-12 text-center" x-show="hasMore" x-cloak>
                    <button type="button" @click="more()"
                        class="rounded-[10px] border border-brand px-12 py-3.5 text-lg text-brand transition hover:bg-brand hover:text-white">
                        Muat lebih banyak</button>
                </div>
            @endif
        </div>
    </section>

    @if ($map && (filled($map->title) || filled($map->image)))
        <section class="reveal">
            <div class="page-container pb-12 text-center sm:pb-16">
                @if (filled($map->title))
                    <h2 class="text-2xl text-ink sm:text-3xl lg:text-[2rem]">{{ $map->title }}</h2>
                @endif
                @if ($map->image)
                    <img src="{{ asset('storage/' . $map->image) }}" alt="Peta sebaran klien di Indonesia"
                        class="mx-auto mt-8 block h-auto w-full max-w-5xl" loading="lazy" decoding="async">
                @endif
            </div>
        </section>
    @endif

    @include('UserPage.Layouts.question')
@endsection
