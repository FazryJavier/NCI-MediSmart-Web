@extends('AdminPage.Layouts.master')

@section('title')
    Tambah Pengguna
@endsection

@section('content')
    <form method="POST" action="/Users">
        @csrf
        @include('AdminPage.Pages.User.form', ['user' => null, 'passwordRequired' => true])
        <button type="submit" class="btn btn-success">Create</button>
        <a href="/Users" class="btn btn-secondary">Back</a>
    </form>
@endsection
