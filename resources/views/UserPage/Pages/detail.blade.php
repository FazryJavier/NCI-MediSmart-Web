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

    {{--
        Follows the article design: image left-aligned at the top, title, "author · dd/mm/yyyy", the body at full
        container width, the CTA, then "Rekomendasi" as three columns with dividers. The breadcrumb is kept as
        structured data only (no visible trail in the design).
    --}}
    @include('UserPage.Layouts.breadcrumb', ['items' => [['Blog', route('blog.index')], [$article->title, null]], 'visible' => false])

    <article class="page-container py-10 sm:py-14">
        @if ($imageUrl)
            <img src="{{ $imageUrl }}" alt="{{ $article->title }}" class="aspect-[3/2] w-full rounded-2xl object-cover md:w-3/4"
                fetchpriority="high" decoding="async">
        @endif

        <h1 class="mt-8 max-w-3xl text-2xl font-bold leading-snug text-ink sm:text-3xl">{{ $article->title }}</h1>
        <p class="mt-4 text-sm">
            @if (optional($article->Users)->username)
                <span class="font-bold text-ink">{{ $article->Users->username }}</span>
            @endif
            @if ($article->created_at)
                <span class="text-ink/40" aria-hidden="true">&nbsp;·&nbsp;</span>
                <time datetime="{{ $article->created_at->toDateString() }}" class="text-ink/50">{{ $article->created_at->format('d/m/Y') }}</time>
            @endif
        </p>

        {{-- Admin-authored rich text, full container width as in the design.
             Justified on wide screens as in the design (long lines keep word gaps even); left-aligned on phones. --}}
        <div class="prose mt-8 max-w-none text-ink/80 prose-headings:font-bold prose-headings:text-ink prose-h2:text-xl prose-h3:text-lg prose-a:text-brand-link prose-li:my-1 prose-img:rounded-xl sm:prose-lg sm:max-w-none md:prose-p:text-justify md:prose-li:text-justify">
            {!! $article->description !!}
        </div>
    </article>

    @include('UserPage.Layouts.question')

    @if ($recommended->isNotEmpty())
        <section class="reveal">
            <div class="page-container py-10 sm:py-14">
                <h2 class="text-xl font-bold text-ink sm:text-2xl">Rekomendasi</h2>
                <div class="mt-6 grid gap-y-10 md:grid-cols-3 md:divide-x md:divide-black/10">
                    @foreach ($recommended as $item)
                        <div class="md:px-5 md:first:pl-0 md:last:pr-0">
                            @include('UserPage.Layouts.article-card', ['article' => $item])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
