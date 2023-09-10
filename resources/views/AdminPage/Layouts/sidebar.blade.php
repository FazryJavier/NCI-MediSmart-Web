<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src={{ asset('adminlte/dist/img/AdminLTELogo.png') }} alt="Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin NCI-Medismart</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-header">HALAMAN</li>

                {{-- Landing Page --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Landing Page
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/LandingSlider" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Landing Slider</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/LandingVideo" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Landing Video</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/LandingClient" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Client</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/LandingMap" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Map</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- End Landing Page --}}

                {{-- Product --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Product
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="admin-home" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Header</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/boxed.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Video</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Client</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-topnav.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kelebihan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-footer.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Modul</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Testimoni</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- End Product --}}

                {{-- Healthcare Solution --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Healthcare Solution
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/AboutUs" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>About Us</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- End Healthcare Solution --}}

                {{-- Detail Modul --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Detail Modul
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="admin-home" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Header</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/boxed.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kelebihan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fasilitas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-topnav.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Testimoni</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- End Detail Modul --}}

                {{-- Testimoni --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Testimoni
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/Feedback" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Feedback</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Map</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- End Testimoni --}}

                {{-- Blog --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Blog
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="admin-home" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Article</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- End Blog --}}

                {{-- Header --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Navbar
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="admin-home" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top Navbar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bottom Bar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- End Header --}}

                {{-- Footer --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Footer
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="admin-home" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Footer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Copyright</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- End Footer --}}

                {{-- CTA --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            CTA
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="admin-home" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>CTA</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- End CTA --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
