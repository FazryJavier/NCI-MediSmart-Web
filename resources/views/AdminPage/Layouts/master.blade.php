@php
    /*
     * Page titles are written by each view as "Page <Group> - <Name>" (or just "<Name>").
     * Derive a short heading, the breadcrumb trail and the card label from it, so the header
     * does not repeat the same long text three times.
     */
    $rawTitle = trim(preg_replace('/^Page\s+/i', '', trim($__env->yieldContent('title'))));
    $crumbs = array_values(array_filter(array_map('trim', explode(' - ', $rawTitle))));
    $pageTitle = $crumbs ? end($crumbs) : 'Admin';
    // "Home" is the same place as the "Beranda" crumb that is always shown first.
    $parentCrumbs = array_values(array_filter(array_slice($crumbs, 0, -1), fn ($c) => strcasecmp($c, 'Home') !== 0));

    $segments = request()->segments();
    $listUrl = isset($segments[0]) ? '/' . $segments[0] : null;
    $mode = match (true) {
        in_array('create', $segments, true) => 'Tambah',
        in_array('update', $segments, true) => 'Ubah',
        default => null,
    };
    $titleHasMode = (bool) preg_match('/^(Tambah|Ubah)\b/i', $pageTitle);
    $heading = ($mode && ! $titleHasMode) ? $mode . ' ' . $pageTitle : $pageTitle;
    $cardLabel = match (true) {
        $mode === 'Tambah' => 'Form Tambah Data',
        $mode === 'Ubah' => 'Form Ubah Data',
        count($segments) === 1 => 'Daftar Data',
        default => $pageTitle,
    };
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $pageTitle }} | Admin NCI-Medismart</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo NCI-01.png') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/adminlte/dist/css/adminlte.min.css') }}">
    @stack('style')
    <!-- Shared admin look (after AdminLTE and the page styles so it can refine them) -->
    @php($adminCss = public_path('assets/admin/admin.css'))
    <link rel="stylesheet" href="{{ asset('assets/admin/admin.css') }}{{ is_file($adminCss) ? '?v=' . filemtime($adminCss) : '' }}">
    <script>
        // Shared DataTables options (Indonesian labels); pages pass this to DataTable().
        window.adminDataTableOptions = {
            autoWidth: false,
            language: {
                search: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                infoEmpty: 'Tidak ada data',
                infoFiltered: '(disaring dari _MAX_ data)',
                zeroRecords: 'Data tidak ditemukan',
                emptyTable: 'Belum ada data.',
                paginate: { previous: 'Sebelumnya', next: 'Berikutnya' }
            }
        };
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        @include('/AdminPage/Layouts/navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('/AdminPage/Layouts/sidebar')
        <!-- /.sidebar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $heading }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/LandingSlider">Beranda</a></li>
                                @foreach ($parentCrumbs as $crumb)
                                    <li class="breadcrumb-item">{{ $crumb }}</li>
                                @endforeach
                                @if ($mode && $listUrl && ! $titleHasMode)
                                    <li class="breadcrumb-item"><a href="{{ $listUrl }}">{{ $pageTitle }}</a></li>
                                    <li class="breadcrumb-item active">{{ $mode }}</li>
                                @else
                                    <li class="breadcrumb-item active">{{ $pageTitle }}</li>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $cardLabel }}</h3>
                        </div>
                        <div class="card-body">
                            @include('AdminPage.Layouts.flash-message')
                            @yield('content')
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>&copy; {{ date('Y') }} NCI Medismart.</strong> Admin panel.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    </div>
    <!-- ./wrapper -->

    <script src="{{ asset('/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/adminlte/dist/js/adminlte.min.js') }}"></script>

    @stack('script')

</body>

</html>
