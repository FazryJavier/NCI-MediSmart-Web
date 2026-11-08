@extends('UserPage.Layouts.app')

@section('title', 'Sitemap - NCI Medismart')
@section('description', 'Peta situs NCI Medismart: produk, modul, dan halaman lainnya.')

@php
    $sitemapLink = 'block text-lg text-[#272727] hover:text-brand';
    $sitemapHeading = 'my-5 text-[26px] font-bold text-[#272727]';
@endphp

@section('content')
    <section class="reveal bg-[#f5f5f5]">
        <div class="page-container">
            <h1 class="py-5 text-[42px] font-bold text-[#272727]">Sitemap</h1>
            <div class="grid grid-cols-[repeat(auto-fit,minmax(200px,auto))] justify-between gap-10 pb-10">
                <div>
                    <h2 class="{{ $sitemapHeading }}">Produk</h2>
                    <ul class="space-y-4">
                        @foreach ($products as $product)
                            <li><a href="{{ url('/ProductView/' . $product->id) }}" class="{{ $sitemapLink }}">{{ $product->title }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h2 class="{{ $sitemapHeading }}">Modul</h2>
                    <ul class="space-y-4">
                        @foreach ($moduls as $modul)
                            <li><a href="{{ url('/Modul/' . $modul->id) }}" class="{{ $sitemapLink }}">{{ $modul->title }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h2 class="{{ $sitemapHeading }}">Lainnya</h2>
                    <ul class="space-y-4">
                        <li><a href="{{ url('/HealthcareSolution') }}" class="{{ $sitemapLink }}">About</a></li>
                        <li><a href="{{ url('/Testimoni') }}" class="{{ $sitemapLink }}">Testimoni</a></li>
                        <li><a href="{{ url('/Blog') }}" class="{{ $sitemapLink }}">Blog</a></li>
                        <li><a href="{{ url('/Demo') }}" class="{{ $sitemapLink }}">Demo</a></li>
                        @foreach ($whatsappContent['whatsappView'] as $phone_number)
                            <li><a href="https://api.whatsapp.com/send?phone={{ urlencode($phone_number) }}" target="_blank"
                                    rel="noopener noreferrer" class="{{ $sitemapLink }}">Contact</a></li>
                        @endforeach
                    </ul>
                </div>

                {{-- Blog list intentionally hidden (kept from the previous layout). --}}
                <div class="hidden">
                    <h2 class="{{ $sitemapHeading }}">Blog</h2>
                    <ul class="space-y-4">
                        @foreach ($articles as $article)
                            <li><a href="{{ url('/DetailBlog/' . $article->id) }}" class="{{ $sitemapLink }}">{{ $article->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
