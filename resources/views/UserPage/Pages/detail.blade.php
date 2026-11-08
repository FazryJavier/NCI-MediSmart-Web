@extends('UserPage.Layouts.app')

@section('title', "{$articles->title} - Blog NCI Medismart")
@section('description', \Illuminate\Support\Str::limit(trim(strip_tags((string) $articles->description)), 160))

@push('meta')
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $articles->title }}">
    <meta property="og:image" content="{{ asset('storage/' . $articles->image) }}">
@endpush

@section('content')
    @include('UserPage.Layouts.wa-icon')

    {{-- Article --}}
    <section>
        <div class="page-container">
            <article class="py-12">
                <img src="{{ asset('storage/' . $articles->image) }}" alt="{{ $articles->title }}"
                    class="w-full max-w-[1200px] overflow-hidden">
                <div class="px-2.5 py-7">
                    <h1 class="mb-7 text-[28px] font-bold text-ink min-[581px]:text-[40px]">{{ $articles->title }}</h1>

                    <div class="mb-7 flex gap-5 text-lg">
                        <p class="font-bold text-ink">{{ optional($articles->Users)->username }}</p>
                        <time class="text-[#b9b9b9]" datetime="{{ $articles->created_at?->toIso8601String() }}">
                            {{ $articles->created_at }}</time>
                    </div>

                    {{-- Article body is admin-authored rich text. --}}
                    <div class="text-justify text-base tracking-[2px] text-muted min-[581px]:text-xl">
                        {!! $articles->description !!}
                    </div>
                </div>
            </article>
        </div>
    </section>

    @include('UserPage.Layouts.question')

    {{-- Rekomendasi --}}
    <section>
        <div class="page-container">
            <div class="mt-12 border-b border-muted">
                <h2 class="text-2xl font-bold">Rekomendasi</h2>
                <div class="grid grid-cols-1 gap-x-12 gap-y-[60px] md:grid-cols-2">
                    @foreach ($articles2 as $ar2)
                        <article class="p-5">
                            <div class="overflow-hidden text-center">
                                <img src="{{ asset('storage/' . $ar2->image) }}" alt="{{ $ar2->title }}"
                                    class="mx-auto mb-2.5 w-full max-w-[450px]" loading="lazy">
                            </div>
                            <div class="p-2.5">
                                <h3 class="mb-2.5 text-xl font-bold text-ink">{{ $ar2->title }}</h3>
                                <p class="mb-2.5 line-clamp-4 text-justify text-base text-muted">
                                    {{ strip_tags($ar2->description) }}</p>
                            </div>
                            <div class="text-right">
                                <a href="{{ url('/DetailBlog/' . $ar2->id) }}"
                                    class="text-lg text-brand-link hover:underline">Pelajari Lanjut</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
