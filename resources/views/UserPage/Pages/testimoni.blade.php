@extends('UserPage.Layouts.app')

@section('title', 'Testimoni - NCI Medismart')
@section('description', 'Apa kata klien rumah sakit dan fasilitas kesehatan tentang SIMRS NCI Medismart.')

@section('content')
    @include('UserPage.Layouts.wa-icon')

    {{-- Testimoni --}}
    <section class="reveal">
        <div class="py-12" x-data="loadMore({ initial: 6, step: 3, total: {{ count($feedbackContent['imageView']) }} })">
            <div class="page-container">
                <h1 class="mb-10 text-center text-[28px] text-ink min-[581px]:text-[40px]">Apa kata klien tentang kami</h1>
                <div class="text-center">
                    <div class="grid grid-cols-1 gap-x-12 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($feedbackContent['imageView'] as $index => $image)
                            <div class="mb-12 p-5" x-show="{{ $loop->index }} < visible"
                                @if ($loop->index >= 6) x-cloak @endif>
                                <img src="{{ asset('storage/' . $image) }}"
                                    alt="Logo {{ $feedbackContent['nameView'][$index] }}"
                                    class="mx-auto w-full max-w-[100px]" loading="lazy">
                                <h3 class="py-2.5 text-xl font-medium">{{ $feedbackContent['nameView'][$index] }}</h3>
                                <p class="text-base">{{ $feedbackContent['descriptionView'][$index] }}</p>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" x-show="hasMore" x-cloak @click="more()"
                        class="inline-block rounded-[10px] border border-brand px-[60px] py-4 text-xl text-brand transition hover:bg-brand hover:text-white">
                        Muat Lebih Banyak
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Client map --}}
    <section class="reveal">
        <div class="py-12">
            <div class="page-container">
                <h2 class="mb-12 text-center text-2xl text-ink min-[581px]:text-[32px]">{{ $mapfeedbackContent['titleView'] }}</h2>
                @if ($mapfeedbackContent['imageView'])
                    <img src="{{ $mapfeedbackContent['imageView'] }}" alt="Peta sebaran klien di Indonesia"
                        class="mx-auto w-full max-w-[1300px]" loading="lazy">
                @endif
            </div>
        </div>
    </section>

    @include('UserPage.Layouts.question')
@endsection
