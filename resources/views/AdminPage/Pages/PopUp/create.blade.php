@extends('AdminPage.Layouts.master')

@section('title')
    Page Popup
@endsection

@section('content')
    <form action="/Popup" method="POST" enctype="multipart/form-data">
        @csrf
        @include('AdminPage.Pages.PopUp.form', ['popup' => null])
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/Popup" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
