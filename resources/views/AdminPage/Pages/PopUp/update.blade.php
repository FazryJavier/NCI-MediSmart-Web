@extends('AdminPage.Layouts.master')

@section('title')
    Page Popup
@endsection

@section('content')
    <form action="/Popup/{{ $popup->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('AdminPage.Pages.PopUp.form', ['popup' => $popup])
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="/Popup" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
