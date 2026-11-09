<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" aria-label="Buka atau tutup menu">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/LandingSlider" class="nav-link"><i class="fas fa-home mr-1"></i> Beranda</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link" target="_blank" rel="noopener">
                <i class="fas fa-external-link-alt mr-1"></i> Lihat Website
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button" aria-label="Layar penuh">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false">
                <i class="fas fa-user-circle mr-1"></i>
                <span class="d-none d-sm-inline">{{ Auth::user()->username }}</span>
                <span
                    class="badge {{ Auth::user()->level === 'Admin' ? 'badge-primary' : 'badge-secondary' }} ml-1">{{ Auth::user()->level }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="/Account/password" class="dropdown-item">
                    <i class="fas fa-key mr-2"></i> Ubah Password
                </a>
                <div class="dropdown-divider"></div>
                <form action="/logout" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
{{-- End Navbar --}}
