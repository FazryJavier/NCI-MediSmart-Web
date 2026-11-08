@extends('UserPage.Layouts.app')

@section('title', 'Sitemap | NCI Medismart')
@section('description', 'Peta situs NCI Medismart: produk, modul, artikel, dan halaman lainnya.')

@php
    $sitemapLink = 'text-base text-ink/80 transition hover:text-brand-dark hover:underline underline-offset-4';
    $sitemapHeading = 'text-lg font-bold text-ink';
    $waNumber = collect($whatsappContent['whatsappView'])->first();
@endphp

@section('content')
    <section class="bg-mist">
        <div class="page-container py-10 sm:py-14">
            @include('UserPage.Layouts.breadcrumb', ['items' => [['Sitemap', null]]])
            <h1 class="mt-3 text-3xl font-bold text-ink sm:text-4xl">Sitemap</h1>

            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @if ($products->isNotEmpty())
                    <div class="rounded-2xl bg-white p-6 shadow-sm">
                        <h2 class="{{ $sitemapHeading }}">Produk</h2>
                        <ul class="mt-4 space-y-3">
                            @foreach ($products as $product)
                                <li><a href="{{ $product->publicUrl() }}" class="{{ $sitemapLink }}">{{ $product->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($moduls->isNotEmpty())
                    <div class="rounded-2xl bg-white p-6 shadow-sm">
                        <h2 class="{{ $sitemapHeading }}">Modul</h2>
                        <ul class="mt-4 space-y-3">
                            @foreach ($moduls as $modul)
                                <li><a href="{{ $modul->publicUrl() }}" class="{{ $sitemapLink }}">{{ $modul->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <h2 class="{{ $sitemapHeading }}">Lainnya</h2>
                    <ul class="mt-4 space-y-3">
                        <li><a href="{{ route('about') }}" class="{{ $sitemapLink }}">Tentang Kami</a></li>
                        <li><a href="{{ route('testimoni') }}" class="{{ $sitemapLink }}">Testimoni</a></li>
                        <li><a href="{{ route('blog.index') }}" class="{{ $sitemapLink }}">Blog</a></li>
                        <li><a href="{{ route('demo') }}" class="{{ $sitemapLink }}">Demo</a></li>
                        @if ($waNumber)
                            <li><a href="https://api.whatsapp.com/send?phone={{ urlencode($waNumber) }}" target="_blank"
                                    rel="noopener noreferrer" class="{{ $sitemapLink }}">Kontak (WhatsApp)</a></li>
                        @endif
                    </ul>
                </div>

                {{-- Blog list kept hidden as in the previous layout (articles are listed in sitemap.xml). --}}
                <div class="hidden">
                    <h2 class="{{ $sitemapHeading }}">Blog</h2>
                    <ul class="mt-4 space-y-3">
                        @foreach ($articles as $article)
                            <li><a href="{{ $article->publicUrl() }}" class="{{ $sitemapLink }}">{{ $article->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
