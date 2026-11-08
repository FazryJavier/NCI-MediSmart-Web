@extends('UserPage.Layouts.form-page')

@section('title', 'Form Testimoni | NCI Medismart')
@section('description', 'Bagikan pengalaman fasilitas kesehatan Anda menggunakan SIMRS NCI Medismart.')

@section('form_intro', 'Ceritakan pengalaman Anda bermitra dengan kami.')

@section('form_body')
    <form action="{{ route('testimoni.store') }}" method="POST" novalidate class="space-y-6">
        @csrf

        @if (session('status'))
            <div role="status" class="flex gap-3 rounded-lg border border-brand/30 bg-brand/10 p-4 text-sm text-brand-dark">
                <x-icon name="circle-check" class="mt-0.5 text-base" />{{ session('status') }}
            </div>
        @endif

        {{-- Honeypot: hidden from people, bots that fill every field are rejected. --}}
        <div class="hidden" aria-hidden="true">
            <label for="website">Website</label>
            <input id="website" type="text" name="website" tabindex="-1" autocomplete="off">
        </div>

        @include('UserPage.Layouts.form-field', ['name' => 'name', 'label' => 'Nama', 'autocomplete' => 'name'])
        @include('UserPage.Layouts.form-field', ['name' => 'position', 'label' => 'Jabatan', 'autocomplete' => 'organization-title'])
        @include('UserPage.Layouts.form-field', ['name' => 'instance_name', 'label' => 'Nama Instansi / Faskes', 'autocomplete' => 'organization'])
        @include('UserPage.Layouts.form-field', ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'autocomplete' => 'email'])
        @include('UserPage.Layouts.form-field', ['name' => 'phone_number', 'label' => 'No Telpon', 'type' => 'tel', 'autocomplete' => 'tel', 'required' => false])
        @include('UserPage.Layouts.form-field', ['name' => 'testimonial', 'label' => 'Testimoni', 'type' => 'textarea',
            'hint' => 'Minimal 20 karakter. Testimoni akan kami tinjau sebelum ditampilkan di website.'])

        <div class="pt-4 text-center">
            <button type="submit" class="btn btn-primary w-full !py-4 !text-lg sm:w-auto sm:!px-20">Kirim Testimoni</button>
        </div>
    </form>
@endsection
