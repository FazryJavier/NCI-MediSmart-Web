<!DOCTYPE html>
<html lang="id">

<head>
    @php
        // yieldContent() already returns HTML-escaped text (inline @section values and defaults are
        // escaped by Blade), so these are printed with {!! !!} below to avoid double escaping.
        $pageTitle = trim($__env->yieldContent('title', 'NCI Medismart'));
        $pageDescription = trim($__env->yieldContent('description', 'SIMRS NCI Medismart adalah aplikasi yang terintegrasi dengan platform satu sehat, cetak SEP BPJS'));
        $pageImage = trim($__env->yieldContent('og_image', asset('assets/img/logo NCI-01.png')));
        $pageType = trim($__env->yieldContent('og_type', 'website'));
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{!! $pageTitle !!}</title>
    <meta name="description" content="{!! $pageDescription !!}">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo NCI-01.png') }}">
    <meta name="theme-color" content="#1bad4b">

    {{-- Social sharing (Open Graph / Twitter) --}}
    <meta property="og:site_name" content="NCI Medismart">
    <meta property="og:locale" content="id_ID">
    <meta property="og:type" content="{!! $pageType !!}">
    <meta property="og:title" content="{!! $pageTitle !!}">
    <meta property="og:description" content="{!! $pageDescription !!}">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:image" content="{!! $pageImage !!}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{!! $pageTitle !!}">
    <meta name="twitter:description" content="{!! $pageDescription !!}">
    <meta name="twitter:image" content="{!! $pageImage !!}">

    @stack('meta')
    {{-- Mark JS as available so .reveal sections start hidden only when they can be revealed.
         Safety net: if the bundle has not booted after 3s (slow/failed load), show everything. --}}
    <script>
        document.documentElement.classList.add('js');
        setTimeout(function () { if (!window.Alpine) document.documentElement.classList.remove('js'); }, 3000);
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <a href="#konten" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[2000] focus:rounded-lg focus:bg-white focus:px-4 focus:py-2 focus:shadow-lg">Lewati ke konten</a>

    @hasSection('header')
        @yield('header')
    @else
        @include('UserPage.Layouts.header')
    @endif

    <main id="konten">
        @yield('content')
    </main>

    @hasSection('footer')
        @yield('footer')
    @else
        @include('UserPage.Layouts.footer')
    @endif

    @stack('scripts')
</body>

</html>
