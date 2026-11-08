@extends('UserPage.Layouts.app')

{{--
    Shared layout for the public forms (Demo, Testimoni), following the form design: grey page, slim header
    with "< Kembali" and the logo, large centred logo, an intro line, a white bordered card with the fields,
    and a centred copyright line. Pages provide @section('form_intro') and @section('form_body').
--}}

@section('header')
    <header class="bg-[#f5f5f5] shadow-[0_4px_12px_rgba(0,0,0,0.08)]">
        <nav class="mx-auto flex h-20 w-full max-w-7xl items-center justify-between px-5 sm:px-8 lg:px-12">
            <a href="{{ route('home') }}"
                class="inline-flex items-center gap-1.5 text-base text-muted transition hover:text-brand-dark">
                <x-icon name="chevron-down" class="rotate-90 text-xs" />Kembali
            </a>
            <a href="{{ route('home') }}" aria-label="Beranda NCI Medismart">
                <img src="{{ asset('assets/img/Logo Medismart.png') }}" alt="NCI Medismart" width="600" height="312" class="h-12 w-auto sm:h-14">
            </a>
        </nav>
    </header>
@endsection

@section('footer')
    <footer class="bg-[#f5f5f5] pb-8 pt-4 text-center text-sm font-medium text-muted">
        <p>Copyright &copy; {{ now()->year }} PT NUANSA CERAH INFORMASI</p>
    </footer>
@endsection

@section('content')
    <section class="min-h-[70vh] bg-[#f5f5f5] px-5 pb-16 pt-12 sm:pt-16">
        <div class="mx-auto max-w-3xl">
            <img src="{{ asset('assets/img/Logo Medismart.png') }}" alt="" width="600" height="312" class="mx-auto h-28 w-auto sm:h-40">
            <p class="mt-8 text-lg text-muted sm:text-xl">@yield('form_intro')</p>

            <div class="mt-4 rounded-xl border border-black/10 bg-white p-6 shadow-sm sm:px-16 sm:py-12">
                @yield('form_body')
            </div>
        </div>
    </section>
@endsection
