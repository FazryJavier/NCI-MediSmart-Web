@extends('UserPage.Layouts.app')

@php
    $plain = trim(preg_replace('/\s+/', ' ', strip_tags((string) $article->description)));
    $imageUrl = $article->image ? asset('storage/' . $article->image) : null;
@endphp

@section('title', \Illuminate\Support\Str::limit($article->title, 60, '') . ' | Blog NCI Medismart')
@section('description', \Illuminate\Support\Str::limit($plain, 155))
@section('canonical', $article->publicUrl())
@section('og_type', 'article')
@if ($imageUrl)
    @section('og_image', $imageUrl)
@endif

@push('meta')
    <script type="application/ld+json">
        {!! json_encode(array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => \Illuminate\Support\Str::limit($article->title, 110, ''),
            'description' => \Illuminate\Support\Str::limit($plain, 155),
            'image' => $imageUrl,
            'datePublished' => optional($article->created_at)->toAtomString(),
            'dateModified' => optional($article->updated_at)->toAtomString(),
            'author' => ['@type' => 'Organization', 'name' => 'NCI Medismart'],
            'publisher' => ['@type' => 'Organization', 'name' => 'NCI Medismart', 'logo' => ['@type' => 'ImageObject', 'url' => asset('assets/img/logo NCI-01.png')]],
            'mainEntityOfPage' => $article->publicUrl(),
        ]), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}
    </script>
@endpush

@section('content')
    @include('UserPage.Layouts.wa-icon')

    <article class="page-container py-10 sm:py-14">
        <div class="mx-auto max-w-3xl">
            @include('UserPage.Layouts.breadcrumb', ['items' => [['Blog', route('blog.index')], [$article->title, null]]])

            <h1 class="mt-4 text-3xl font-bold leading-tight text-ink sm:text-4xl">{{ $article->title }}</h1>
            <div class="mt-4 flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-ink/60">
                @if (optional($article->Users)->username)
                    <span class="font-bold text-ink">{{ $article->Users->username }}</span>
                @endif
                @if ($article->created_at)
                    <time datetime="{{ $article->created_at->toDateString() }}">{{ $article->created_at->locale('id')->translatedFormat('d F Y') }}</time>
                @endif
            </div>
        </div>

        @if ($imageUrl)
            <img src="{{ $imageUrl }}" alt="{{ $article->title }}" class="mx-auto mt-8 aspect-video w-full max-w-4xl rounded-2xl object-cover"
                fetchpriority="high" decoding="async">
        @endif

        {{-- Admin-authored rich text. --}}
        <div class="prose prose-lg mx-auto mt-10 max-w-3xl text-ink/90 prose-headings:text-ink prose-a:text-brand-link prose-img:rounded-xl">
            {!! $article->description !!}
        </div>
    </article>

    @include('UserPage.Layouts.question')

    @if ($recommended->isNotEmpty())
        <section class="reveal">
            <div class="page-container py-10 sm:py-14">
                <div class="flex items-end justify-between gap-4">
                    <h2 class="text-2xl font-bold text-ink sm:text-3xl">Rekomendasi</h2>
                    <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-brand-link hover:underline">
                        Semua artikel<x-icon name="arrow-right" class="text-xs" /></a>
                </div>
                <div class="mt-6 flex flex-wrap justify-center gap-6">
                    @foreach ($recommended as $item)
                        <div class="w-full md:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)]">
                            @include('UserPage.Layouts.article-card', ['article' => $item])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
