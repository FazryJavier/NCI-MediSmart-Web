@extends('AdminPage.Layouts.master')

@section('title')
    Ubah Password
@endsection

@section('content')
    <form method="POST" action="/Account/password" style="max-width: 480px;">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="current_password" class="form-label">Password saat ini</label>
            <input type="password" name="current_password" id="current_password"
                class="form-control @error('current_password') is-invalid @enderror" autocomplete="current-password"
                required>
            @error('current_password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password baru</label>
            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror" autocomplete="new-password" required>
            <small class="text-muted">Minimal 8 karakter dan berbeda dari password saat ini.</small>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi password baru</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                autocomplete="new-password" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
@endsection
