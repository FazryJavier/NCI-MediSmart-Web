<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NCI Medismart')</title>
    <meta name="description" content="@yield('description', 'SIMRS NCI Medismart adalah aplikasi yang terintegrasi dengan platform satu sehat, cetak SEP BPJS')">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo NCI-01.png') }}">
    @stack('meta')
    {{-- Mark JS as available so .reveal sections start hidden only when they can be revealed. --}}
    <script>document.documentElement.classList.add('js')</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @hasSection('header')
        @yield('header')
    @else
        @include('UserPage.Layouts.header')
    @endif

    <main>
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
