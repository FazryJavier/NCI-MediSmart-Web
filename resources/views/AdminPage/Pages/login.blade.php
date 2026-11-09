<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Login Admin | NCI-Medismart</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo NCI-01.png') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('/adminlte//plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/adminlte/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="/" class="logo"><img src="{{ asset('assets/img/Logo Medismart.png') }}" alt="Medismart"
                    class="logo" style="max-width: 200px;" /></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Masuk untuk mengelola website</p>

                @if (session('LoginError'))
                    <div class="alert alert-danger" role="alert">{{ session('LoginError') }}</div>
                @endif

                <form action="/Admin" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="username" id="username" value="{{ old('username') }}"
                            class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                            autocomplete="username" autocapitalize="none" spellcheck="false" autofocus required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                            autocomplete="current-password" required>
                        <div class="input-group-append">
                            <button type="button" class="input-group-text" id="toggle-password"
                                aria-label="Tampilkan password" aria-pressed="false">
                                <span class="fas fa-eye" id="toggle-password-icon"></span>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember" value="1">
                                <label for="remember">Ingat saya</label>
                            </div>
                        </div>
                        <div class="col-5">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            var input = document.getElementById('password');
            var show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            this.setAttribute('aria-pressed', show ? 'true' : 'false');
            this.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
            document.getElementById('toggle-password-icon').className = show ? 'fas fa-eye-slash' : 'fas fa-eye';
        });
    </script>
</body>

</html>
