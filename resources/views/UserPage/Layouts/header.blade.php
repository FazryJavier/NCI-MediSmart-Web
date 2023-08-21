<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Header</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-header.css') }}">
</head>

<body>
    {{-- Header --}}
    <header>
        <div class="top-bar">
            <div class="container">
                <div class="top-bar-content">
                    <div class="left-content">
                        <div class="instagram">
                            <a href="https://www.instagram.com/ncimedismart/" target=”_blank”><i
                                    class="fa-brands fa-instagram"></i></a>
                        </div>
                        <div class="youtube">
                            <a href="https://www.youtube.com/@simrsncimedismart2282/featured" target=”_blank”><i
                                    class="fa-brands fa-youtube"></i></a>
                        </div>
                        <div class="linkedin">
                            <a href="https://www.linkedin.com/company/pt-nuansa-cerah-informasi/" target=”_blank”><i
                                    class="fa-brands fa-linkedin-in"></i></a>
                        </div>
                    </div>

                    <div class="right-content">
                        <div class="phone">
                            <i class="fa-solid fa-phone"></i><span>022 8735 6050</span>
                        </div>
                        <div class="location">
                            <button>Kantor Bandung</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-bar">
            <div class="container">
                <div class="bottom-bar-content">
                    <a href="/" class="logo"><img src="{{ asset('assets/img/Logo Medismart.png') }}"
                            alt="Medismart" class="logo" /></a>

                    <input type="checkbox" id="menu-bar">
                    <label for="menu-bar"><i class="fa-solid fa-bars" style="color: #015028;"></i></label>

                    <nav class="navbar">
                        <ul class="nav-list">
                            <li class="nav-item"><a href="#" class="nav-link">Produk <span>&#x25BE;</span></a>
                                <ul class="nav-list-2">
                                    <li class="nav-item-2">
                                        <a href="#" class="nav-link">
                                            <img src="{{ asset('assets/img/simrs.png') }}" alt="">
                                            <div class="text">
                                                <h5>SIMRS NCI MEDISMART</h5>
                                                <p>Sistem Informasi Manajemen Rumah Sakit </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item-2">
                                        <a href="#" class="nav-link">
                                            <img src="{{ asset('assets/img/rme.png') }}" alt="">
                                            <div class="text">
                                                <h5>RME NCI MEDISMART</h5>
                                                <p>Rekam Medis Elektronik</p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item"><a href="#" class="nav-link">Tentang Kami
                                    <span>&#x25BE;</span></a>
                                <ul class="nav-list-2">
                                    <li class="nav-item-2">
                                        <a href="/HealthcareSolution" class="nav-link">
                                            <img src="{{ asset('assets/img/healthcare.png') }}" alt="">
                                            <h5>Healthcare Solution</h5>
                                            <p></p>
                                        </a>
                                    </li>
                                    <li class="nav-item-2">
                                        <a href="http://nuansa.com/2019/" class="nav-link" target="_blank">
                                            <img src="{{ asset('assets/img/pt-nci.png') }}" alt="">
                                            <h5>PT Nuansa Cerah Informasi</h5>
                                            <p></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item"><a href="/Testimoni" class="nav-link">Testimoni</a></li>
                            <li class="nav-item"><a href="/Blog" class="nav-link">Blog</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">Demo</a></li>
                            <li class="nav-item"><a href="#" class="btn-contact">Hubungi Kami</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    {{-- End Header --}}
</body>
<script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('js/Script.js') }}"></script>

</html>
