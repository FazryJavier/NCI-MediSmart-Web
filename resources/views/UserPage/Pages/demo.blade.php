@extends('UserPage.Layouts.app')

@section('title', 'Jadwalkan Demo - NCI Medismart')
@section('description', 'Jadwalkan demo SIMRS NCI Medismart bersama tim kami.')

@section('header')
    <header>
        <nav class="flex items-center justify-between bg-[#f5f5f5] px-[5%] py-2.5 shadow-[0_0_20px_0_rgba(0,0,0,0.2),0_5px_5px_0_rgba(0,0,0,0.1)]">
            <a href="{{ url('/') }}" class="text-base text-muted"><i class="fa-solid fa-arrow-left mr-1"></i> Kembali</a>
            <a href="{{ url('/') }}"><img src="{{ asset('assets/img/Logo Medismart.png') }}" alt="Medismart"
                    class="w-full max-w-[100px]"></a>
        </nav>
    </header>
@endsection

@section('footer')
    <footer class="bg-white py-4 text-center text-sm font-bold min-[501px]:text-base">
        <p>Copyright &copy; {{ now()->year }} PT NUANSA CERAH INFORMASI</p>
    </footer>
@endsection

@php
    $fields = [
        ['name' => 'name', 'label' => 'Nama', 'type' => 'text', 'autocomplete' => 'name'],
        ['name' => 'position', 'label' => 'Jabatan', 'type' => 'text', 'autocomplete' => 'organization-title'],
        ['name' => 'instance_name', 'label' => 'Nama Instansi / Faskes', 'type' => 'text', 'autocomplete' => 'organization'],
        ['name' => 'instance_address', 'label' => 'Alamat Instansi / Faskes', 'type' => 'textarea', 'autocomplete' => 'street-address'],
        ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'autocomplete' => 'email'],
        ['name' => 'phone_number', 'label' => 'No Telpon', 'type' => 'tel', 'autocomplete' => 'tel'],
    ];
    $inputClass = 'block w-full rounded-md border border-gray-300 px-3 py-2 text-lg text-ink outline-none transition focus:border-brand focus:ring-2 focus:ring-brand/30';
@endphp

@section('content')
    <section class="min-h-screen bg-[#f5f5f5] px-[5%] pb-[100px]">
        <div class="mx-auto max-w-[800px] pt-[8%] text-center">
            <a href="{{ url('/') }}"><img src="{{ asset('assets/img/Logo Medismart.png') }}" alt="MediSmart"
                    class="mx-auto w-full max-w-[320px]"></a>
            <p class="mt-10 text-xl text-muted">Jadwalkan demo dengan tim kami.</p>
        </div>

        <form action="{{ url('/Demo') }}" method="POST" novalidate
            class="relative z-10 mx-auto mt-4 max-w-[800px] bg-white p-6 shadow-[0_0_20px_0_rgba(0,0,0,0.2),0_5px_5px_0_rgba(0,0,0,0.24)] min-[581px]:p-[45px]">
            @csrf

            @foreach ($fields as $field)
                <div class="mb-6">
                    <label for="{{ $field['name'] }}" class="mb-2 block text-xl text-ink">
                        <span class="text-red-600" aria-hidden="true">*</span> {{ $field['label'] }}
                    </label>
                    @if ($field['type'] === 'textarea')
                        <textarea id="{{ $field['name'] }}" name="{{ $field['name'] }}" rows="5" required
                            autocomplete="{{ $field['autocomplete'] }}" class="{{ $inputClass }}"
                            @error($field['name']) aria-invalid="true" aria-describedby="{{ $field['name'] }}-error" @enderror>{{ old($field['name']) }}</textarea>
                    @else
                        <input id="{{ $field['name'] }}" type="{{ $field['type'] }}" name="{{ $field['name'] }}"
                            value="{{ old($field['name']) }}" required autocomplete="{{ $field['autocomplete'] }}"
                            class="{{ $inputClass }}"
                            @error($field['name']) aria-invalid="true" aria-describedby="{{ $field['name'] }}-error" @enderror>
                    @endif
                    @error($field['name'])
                        <p id="{{ $field['name'] }}-error" class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach

            <div class="mt-12 text-center">
                <button type="submit"
                    class="rounded-[10px] bg-brand px-8 py-4 text-xl text-white transition hover:bg-brand-dark">
                    Jadwal Demo
                </button>
            </div>
        </form>
    </section>
@endsection
