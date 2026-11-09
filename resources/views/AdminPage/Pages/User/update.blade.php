@extends('AdminPage.Layouts.master')

@section('title')
    Ubah Pengguna
@endsection

@section('content')
    <form method="POST" action="/Users/{{ $user->id }}">
        @csrf
        @method('PUT')
        @include('AdminPage.Pages.User.form', ['user' => $user, 'passwordRequired' => false])
        <button type="submit" class="btn btn-success">Update</button>
        <a href="/Users" class="btn btn-secondary">Back</a>
    </form>
@endsection
