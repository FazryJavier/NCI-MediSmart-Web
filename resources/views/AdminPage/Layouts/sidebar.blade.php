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
                                <p>Slider</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/LandingClient" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Client</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/Experience" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Experience</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/ExperienceList" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Experience List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/LandingMap" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Map</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/LandingVideo" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Video</p>
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
                            <a href="/Product" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/DetailProduct" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Detail Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/ClientProduct" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Client Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/AdvantageProduct" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Advantage Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/AdvantageListProduct" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Advantage List Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/Sparasi" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sparasi Product</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- End Product --}}

                {{-- Modul --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Modul
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/ModulProduct" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Modul Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/AdvantageModulProduct" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Advantage Modul</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/FasilitiesModulProduct" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fasilities Modul</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/ImageModulProduct" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Image Modul</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- End Modul --}}

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
                            <a href="/MapFeedback" class="nav-link">
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
                            <a href="/Article" class="nav-link">
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
                            <a href="/Navbar" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Navbar</p>
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
                            <a href="/Footer" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Footer</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- End Footer --}}

                {{-- Demo --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Demo
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/DemoList" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Demo</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- End Demo --}}

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
                            <a href="/CTA" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>CTA</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- End CTA --}}

                {{-- WhatsApp --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            WhatsApp
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/Whatsapp" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>WhatsApp</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- End WhatsApp --}}

                {{-- Pop Up --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Pop Up
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/Popup" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pop Up</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- End Pop up --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
