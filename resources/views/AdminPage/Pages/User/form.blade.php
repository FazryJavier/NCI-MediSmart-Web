@php($currentLevel = old('level', $user?->level ?? 'Editor'))

<div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror"
        value="{{ old('username', $user?->username) }}" autocomplete="off" required>
    <small class="text-muted">Huruf, angka, strip (-), dan garis bawah (_).</small>
    @error('username')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="level" class="form-label">Level</label>
    <select name="level" id="level" class="form-control @error('level') is-invalid @enderror">
        @foreach (\App\Http\Controllers\UserManagementController::LEVELS as $level)
            <option value="{{ $level }}" @selected($currentLevel === $level)>{{ $level }}</option>
        @endforeach
    </select>
    @error('level')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="password" class="form-label">{{ $passwordRequired ? 'Password' : 'Password baru' }}</label>
    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
        autocomplete="new-password" @required($passwordRequired)>
    <small class="text-muted">
        Minimal 8 karakter.{{ $passwordRequired ? '' : ' Kosongkan jika tidak ingin mengubah password.' }}
    </small>
    @error('password')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="password_confirmation" class="form-label">Konfirmasi password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
        autocomplete="new-password" @required($passwordRequired)>
</div>
