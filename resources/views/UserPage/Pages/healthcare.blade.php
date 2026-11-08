@extends('UserPage.Layouts.app')

@section('title', 'Healthcare Solution - NCI Medismart')
@if (! empty($aboutContent['descriptionView']))
    @section('description', \Illuminate\Support\Str::limit(strip_tags($aboutContent['descriptionView']), 160))
@endif

@section('content')
    @include('UserPage.Layouts.popups')
    @include('UserPage.Layouts.wa-icon')

    {{-- Video --}}
    <section class="reveal">
        <div class="w-full bg-brand-link p-7 text-center text-white">
            <h1 class="pb-2.5 text-[32px] font-bold tracking-[2px]">NCI - MediSmart</h1>
            @if ($aboutContent['videoView'])
                <div class="mx-auto w-full max-w-[1000px] p-5">
                    <iframe class="aspect-video w-full overflow-hidden rounded-[20px]"
                        src="https://www.youtube.com/embed/{{ $aboutContent['videoView'] }}" title="Profil NCI Medismart"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen loading="lazy"></iframe>
                </div>
            @endif
        </div>
    </section>

    {{-- Visi Misi --}}
    <section class="reveal">
        <div class="bg-white py-[60px] text-ink">
            <div class="page-container">
                <div class="mb-[100px] flex flex-col items-center justify-center gap-7 min-[992px]:flex-row min-[992px]:gap-0">
                    @if ($aboutContent['imageView'])
                        <img src="{{ $aboutContent['imageView'] }}" alt="NCI Medismart" class="w-full max-w-[370px]">
                    @endif
                    <p class="text-justify text-lg tracking-[2px] min-[992px]:px-12 min-[992px]:text-[30px] min-[992px]:leading-snug">
                        {{ $aboutContent['descriptionView'] }}</p>
                </div>

                <div class="flex flex-col justify-center gap-5 text-center min-[992px]:flex-row">
                    <div class="rounded-[20px] border border-ink px-7 py-5 min-[992px]:basis-1/2 min-[992px]:px-12">
                        <h2 class="mb-5 text-[28px] font-bold min-[992px]:text-[38px]">Visi</h2>
                        <p class="mb-5 text-lg min-[992px]:text-2xl">{{ $aboutContent['visiView'] }}</p>
                    </div>
                    <div class="rounded-[20px] border border-ink px-7 py-5 min-[992px]:basis-1/2 min-[992px]:px-12">
                        <h2 class="mb-5 text-[28px] font-bold min-[992px]:text-[38px]">Misi</h2>
                        <p class="mb-5 text-lg min-[992px]:text-2xl">{!! nl2br(e($aboutContent['misiView'])) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('UserPage.Layouts.question')
@endsection
