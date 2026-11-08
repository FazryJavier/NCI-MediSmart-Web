@extends('UserPage.Layouts.form-page')

@section('title', 'Jadwalkan Demo SIMRS | NCI Medismart')
@section('description', 'Jadwalkan demo SIMRS NCI Medismart bersama tim kami: lihat langsung integrasi SATUSEHAT, bridging BPJS, dan rekam medis elektronik.')

@section('form_intro', 'Jadwalkan demo dengan tim kami.')

@section('form_body')
    <form action="{{ route('demo.store') }}" method="POST" novalidate class="space-y-6">
        @csrf

        @if (session('status'))
            <div role="status" class="flex gap-3 rounded-lg border border-brand/30 bg-brand/10 p-4 text-sm text-brand-dark">
                <x-icon name="circle-check" class="mt-0.5 text-base" />{{ session('status') }}
            </div>
        @endif

        @include('UserPage.Layouts.form-field', ['name' => 'name', 'label' => 'Nama', 'autocomplete' => 'name'])
        @include('UserPage.Layouts.form-field', ['name' => 'position', 'label' => 'Jabatan', 'autocomplete' => 'organization-title'])
        @include('UserPage.Layouts.form-field', ['name' => 'instance_name', 'label' => 'Nama Instansi / Faskes', 'autocomplete' => 'organization'])
        @include('UserPage.Layouts.form-field', ['name' => 'instance_address', 'label' => 'Alamat Instansi / Faskes', 'autocomplete' => 'street-address'])
        @include('UserPage.Layouts.form-field', ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'autocomplete' => 'email'])
        @include('UserPage.Layouts.form-field', ['name' => 'phone_number', 'label' => 'No Telpon', 'type' => 'tel', 'autocomplete' => 'tel'])

        <div class="pt-4 text-center">
            <button type="submit" class="btn btn-primary w-full !py-4 !text-lg sm:w-auto sm:!px-20">Jadwal Demo</button>
        </div>
    </form>
@endsection
