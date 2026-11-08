@extends('UserPage.Layouts.app')

@section('title', 'Jadwalkan Demo SIMRS | NCI Medismart')
@section('description', 'Jadwalkan demo SIMRS NCI Medismart bersama tim kami: lihat langsung integrasi SATUSEHAT, bridging BPJS, dan rekam medis elektronik.')

@section('header')
    <header class="bg-white shadow-[0_4px_12px_rgba(0,0,0,0.06)]">
        <nav class="mx-auto flex h-16 w-full max-w-7xl items-center justify-between px-5 sm:px-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-medium text-muted transition hover:text-brand-dark">
                <x-icon name="arrow-left" />Kembali
            </a>
            <a href="{{ route('home') }}" aria-label="Beranda NCI Medismart">
                <img src="{{ asset('assets/img/Logo Medismart.png') }}" alt="NCI Medismart" width="600" height="312" class="h-10 w-auto">
            </a>
        </nav>
    </header>
@endsection

@section('footer')
    <footer class="bg-white py-5 text-center text-sm text-ink/70">
        <p>Copyright &copy; {{ now()->year }} PT Nuansa Cerah Informasi. All rights reserved.</p>
    </footer>
@endsection

@php
    // [name, label, type, autocomplete, full width]
    $fields = [
        ['name', 'Nama', 'text', 'name', false],
        ['position', 'Jabatan', 'text', 'organization-title', false],
        ['instance_name', 'Nama Instansi / Faskes', 'text', 'organization', true],
        ['instance_address', 'Alamat Instansi / Faskes', 'textarea', 'street-address', true],
        ['email', 'Email', 'email', 'email', false],
        ['phone_number', 'No. Telepon / WhatsApp', 'tel', 'tel', false],
    ];
    $inputClass = 'block w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-base text-ink outline-none transition placeholder:text-gray-400 focus:border-brand focus:ring-2 focus:ring-brand/30';
@endphp

@section('content')
    <section class="bg-mist px-5 pb-20 pt-10 sm:pt-14">
        <div class="mx-auto max-w-2xl text-center">
            <img src="{{ asset('assets/img/Logo Medismart.png') }}" alt="" width="600" height="312" class="mx-auto h-20 w-auto sm:h-24">
            <h1 class="mt-6 text-2xl font-bold text-ink sm:text-3xl">Jadwalkan Demo</h1>
            <p class="mt-2 text-base text-muted sm:text-lg">Isi data berikut, tim kami akan menghubungi Anda untuk menjadwalkan demo.</p>
        </div>

        <form action="{{ route('demo.store') }}" method="POST" novalidate
            class="mx-auto mt-8 grid max-w-2xl gap-5 rounded-2xl bg-white p-6 shadow-sm sm:grid-cols-2 sm:p-10">
            @csrf

            @if (session('status'))
                <div role="status" class="flex gap-3 rounded-lg border border-brand/30 bg-brand/10 p-4 text-sm text-brand-dark sm:col-span-2">
                    <x-icon name="circle-check" class="mt-0.5 text-base" />{{ session('status') }}
                </div>
            @endif

            @foreach ($fields as [$name, $label, $type, $autocomplete, $full])
                <div class="{{ $full ? 'sm:col-span-2' : '' }}">
                    <label for="{{ $name }}" class="mb-1.5 block text-sm font-medium text-ink">
                        {{ $label }} <span class="text-red-600" aria-hidden="true">*</span>
                    </label>
                    @if ($type === 'textarea')
                        <textarea id="{{ $name }}" name="{{ $name }}" rows="4" required autocomplete="{{ $autocomplete }}"
                            class="{{ $inputClass }}"
                            @error($name) aria-invalid="true" aria-describedby="{{ $name }}-error" @enderror>{{ old($name) }}</textarea>
                    @else
                        <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" value="{{ old($name) }}" required
                            autocomplete="{{ $autocomplete }}" class="{{ $inputClass }}"
                            @error($name) aria-invalid="true" aria-describedby="{{ $name }}-error" @enderror>
                    @endif
                    @error($name)
                        <p id="{{ $name }}-error" class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach

            <div class="pt-2 sm:col-span-2">
                <button type="submit" class="btn btn-primary w-full sm:w-auto">Jadwalkan Demo</button>
            </div>
        </form>
    </section>
@endsection
