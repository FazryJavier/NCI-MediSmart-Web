<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NCI Medismart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-home.css') }}">
    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
</head>

<body>
    {{-- Header --}}
    @include('UserPage.Layouts.header')
    {{-- End Header --}}

    {{-- WhatsApp Button --}}
    @include('UserPage.Layouts.wa-icon')

    {{-- Home --}}
    <section class="section-header swiper mySwiper">
        <div class="wrapper swiper-wrapper">
            @foreach ($sliderContent['titleView'] as $index => $title)
                <div class="slide swiper-slide">
                    <img src="{{ asset('storage/' . $sliderContent['imageView'][$index]) }}" alt=""
                        class="image">
                    <div class="image-date">
                        <h1>{{ $title }}</h1>
                        <h3>{{ $sliderContent['captionView'][$index] }}</h3>
                        <a href="" class="button-1">Hubungi Kami</a>
                        <a href="" class="button-2">Pelajari Lanjut</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="swiper-button-next nav-btn"></div>
        <div class="swiper-button-prev nav-btn"></div>
        <div class="swiper-pagination"></div>
    </section>
    {{-- End Home --}}

    {{-- Client --}}
    <section class="section-client">
        <div class="client">
            <div class="container">
                <div class="title">
                    @foreach ($clientContent['titleView'] as $title)
                        <h3><b>{{ $title }}</b></h3>
                    @endforeach
                </div>
                <div class="container-line">
                    <div class="center-line"></div>
                </div>
                <div class="image">
                    @foreach ($clientContent['imageView'] as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="Client">
                    @endforeach
                </div>
            </div>

            <div class="custom-shape-divider-bottom-1690273045">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                    preserveAspectRatio="none">
                    <path
                        d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                        class="shape-fill"></path>
                </svg>
            </div>
        </div>
    </section>
    {{-- End Client --}}

    {{-- Experience --}}
    <section class="section-experience">
        <div class="experience">
            <div class="container">
                <div class="text">
                    <div class="title">
                        @foreach ($experienceContent['titleView'] as $title)
                            <p><b>{{ $title }}</b></p>
                        @endforeach
                    </div>
                    <div class="description">
                        @foreach ($experienceContent['descriptionView'] as $description)
                            <p>{{ $description }}</p>
                        @endforeach
                    </div>
                </div>

                <div class="advantage">
                    @foreach ($experiencelistContent['imageView'] as $index => $image)
                        <div class="experience-list">
                            <img src="{{ asset('storage/' . $experiencelistContent['imageView'][$index]) }}"
                                alt="Icon">
                            <h2>{{ $experiencelistContent['nameView'][$index] }}</h2>
                            <p>{{ $experiencelistContent['descriptionView'][$index] }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="client-map">
                    <div class="content">
                        @foreach ($mapContent['titleView'] as $title)
                            <p><b>{{ $title }}</b></p>
                        @endforeach
                    </div>
                    <div class="maps">
                        @foreach ($mapContent['imageView'] as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Indonesia" width="780">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Experience --}}

    {{-- Product --}}
    <section class="section-product">
        <div class="product">
            <div class="container">
                <div class="title">
                    <h1>Produk Kami</h1>
                </div>
                <div class="wrapper">
                    <div class="card">
                        <div class="image">
                            <img src="{{ asset('assets/img/produk-1.png') }}" alt="Product" />
                        </div>
                        <div class="layer">
                            <h1>SIM-RS NCI MediSmart</h1>
                            <h3>Sistem Informasi Manajemen Rumah Sakit</h3>
                            <p>Dikembangkan dengan sistem modular, proses implementasi dilakukan bertahap dan
                                terintegrasi antar modul.Mengelola aktivitas kegiatan dari Front Office sampai dengan
                                Back Office, menghasilkan pelaporan secara lengkap dan cepat
                            </p>
                            <ul>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>SIMRS NCI-MediSmart
                                </li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Integrasi BPJS &
                                    V-Claim</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Keuangan & Akuntansi
                                </li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Picture Archiving
                                    and Communication System (PACS)</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Pendaftaran Online
                                </li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Laboratorium
                                    Informasi System (LIS)</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Pendaftaran Pasien
                                    Online Mandiri</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Pencegahan dan
                                    Pengendalian Infeksi (PPI)</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Perbaikan Mutu dan
                                    Keselamatan Pasien (PMKP)</li>
                            </ul>
                        </div>
                        <div class="bottom">
                            <div class="container-line">
                                <div class="center-line"></div>
                            </div>
                            <div class="button">
                                <a href="#"><i class="fa-solid fa-arrow-right"
                                        style="color: #ffffff;"></i>Pelajari Lanjut</a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="image">
                            <img src="{{ asset('assets/img/produk-2.png') }}" alt="Product" />
                        </div>
                        <div class="layer">
                            <h1>RME NCI MediSmart</h1>
                            <h3>Rekam Medis Elektronik</h3>
                            <p>
                                Dikembangkan dengan sistem modular, proses implementasi dilakukan bertahap dan
                                terintegrasi antar modul.Mengelola aktivitas kegiatan dari Front Office sampai
                                dengan Back Office, menghasilkan pelaporan secara lengkap dan cepat
                            </p>
                            <ul>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Terintegrasi
                                    dengan SIMRS</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Sistem berbasis
                                    web dan mobile</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Kesesuaian dengan
                                    PMK No 24 Tahun 2022</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Siap integrasi
                                    dengan sistem SatuSehat</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Fitur pelayanan
                                    medis dan keperawatan</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Sistem pelaporan
                                    lengkap </li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Tanda tangan
                                    digital </li>
                            </ul>
                        </div>
                        <div class="bottom">
                            <div class="container-line">
                                <div class="center-line"></div>
                            </div>
                            <div class="button">
                                <a href="#"><i class="fa-solid fa-arrow-right"
                                        style="color: #ffffff;"></i>Pelajari Lanjut</a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="image">
                            <img src="{{ asset('assets/img/produk-1.png') }}" alt="Product" />
                        </div>
                        <div class="layer">
                            <h1>SIM-RS NCI MediSmart</h1>
                            <h3>Sistem Informasi Manajemen Rumah Sakit</h3>
                            <p>Dikembangkan dengan sistem modular, proses implementasi dilakukan bertahap dan
                                terintegrasi antar modul.Mengelola aktivitas kegiatan dari Front Office sampai dengan
                                Back Office, menghasilkan pelaporan secara lengkap dan cepat
                            </p>
                            <ul>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>SIMRS
                                    NCI-MediSmart
                                </li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Integrasi BPJS &
                                    V-Claim</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Keuangan &
                                    Akuntansi
                                </li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Picture Archiving
                                    and Communication System (PACS)</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Pendaftaran Online
                                </li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Laboratorium
                                    Informasi System (LIS)</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Pendaftaran Pasien
                                    Online Mandiri</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Pencegahan dan
                                    Pengendalian Infeksi (PPI)</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Perbaikan Mutu dan
                                    Keselamatan Pasien (PMKP)</li>
                            </ul>
                        </div>
                        <div class="bottom">
                            <div class="container-line">
                                <div class="center-line"></div>
                            </div>
                            <div class="button">
                                <a href="#"><i class="fa-solid fa-arrow-right"
                                        style="color: #ffffff;"></i>Pelajari Lanjut</a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="image">
                            <img src="{{ asset('assets/img/produk-2.png') }}" alt="Product" />
                        </div>
                        <div class="layer">
                            <h1>RME NCI MediSmart</h1>
                            <h3>Rekam Medis Elektronik</h3>
                            <p>
                                Dikembangkan dengan sistem modular, proses implementasi dilakukan bertahap dan
                                terintegrasi antar modul.Mengelola aktivitas kegiatan dari Front Office sampai
                                dengan Back Office, menghasilkan pelaporan secara lengkap dan cepat
                            </p>
                            <ul>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Terintegrasi
                                    dengan SIMRS</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Sistem berbasis
                                    web dan mobile</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Kesesuaian dengan
                                    PMK No 24 Tahun 2022</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Siap integrasi
                                    dengan sistem SatuSehat</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Fitur pelayanan
                                    medis dan keperawatan</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Sistem pelaporan
                                    lengkap </li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Tanda tangan
                                    digital </li>
                            </ul>
                        </div>
                        <div class="bottom">
                            <div class="container-line">
                                <div class="center-line"></div>
                            </div>
                            <div class="button">
                                <a href="#"><i class="fa-solid fa-arrow-right"
                                        style="color: #ffffff;"></i>Pelajari Lanjut</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Product --}}

    {{-- Video View --}}
    <section class="section-video">
        <div class="video-view">
            <div class="container">
                <div class="content">
                    <div class="text">
                        <h1>{{ $videoContent['titleView'] }}</h1>
                        <p>{{ $videoContent['descriptionView'] }}</p>
                    </div>

                    <div class="video">
                        <iframe width="560" height="315"
                            src="https://www.youtube.com/embed/{{ $videoContent['videoView'] }}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen controls muted></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Video View --}}

    {{-- Blog --}}
    <section class="section-blog">
        <div class="blog">
            <div class="container">
                <div class="title">
                    <h1><b>News & Update</b></h1>
                </div>

                <div class="content swiper mySwiper-2">
                    <div class="wrapper swiper-wrapper">
                        <div class="card swiper-slide">
                            <div class="line">
                                <div class="image">
                                    <img src="{{ asset('assets/img/blog1.png') }}" alt="">
                                </div>
                                <div class="description">
                                    <h3>Pengalaman Kami menggunakan SIM-RS NCI MediSmart</h3>
                                    <p>Manfaat yang saya rasakan sebagai Direktur Rumah Sakit Al-Islam Bandung dengan
                                        penggunaan SIMRS NCI-MediSmart diantaranya adalah kecepatan dalam pengambilan
                                        keputusan, akurasi dalam mengidentifikasi masalah, kemudahan menyusun
                                        strategi...
                                    </p>
                                    <div class="button">
                                        <a href="#">Pelajari Lanjut</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card swiper-slide">
                            <div class="line">
                                <div class="image">
                                    <img src="{{ asset('assets/img/blog1.png') }}" alt="">
                                </div>
                                <div class="description">
                                    <h3>Pengalaman Kami menggunakan SIM-RS NCI MediSmart</h3>
                                    <p>Manfaat yang saya rasakan sebagai Direktur Rumah Sakit Al-Islam Bandung dengan
                                        penggunaan SIMRS NCI-MediSmart diantaranya adalah kecepatan dalam pengambilan
                                        keputusan, akurasi dalam mengidentifikasi masalah, kemudahan menyusun
                                        strategi...
                                    </p>
                                    <div class="button">
                                        <a href="#">Pelajari Lanjut</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card swiper-slide">
                            <div class="line">
                                <div class="image">
                                    <img src="{{ asset('assets/img/blog1.png') }}" alt="">
                                </div>
                                <div class="description">
                                    <h3>Pengalaman Kami menggunakan SIM-RS NCI MediSmart</h3>
                                    <p>Manfaat yang saya rasakan sebagai Direktur Rumah Sakit Al-Islam Bandung dengan
                                        penggunaan SIMRS NCI-MediSmart diantaranya adalah kecepatan dalam pengambilan
                                        keputusan, akurasi dalam mengidentifikasi masalah, kemudahan menyusun
                                        strategi...
                                    </p>
                                    <div class="button">
                                        <a href="#">Pelajari Lanjut</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card swiper-slide">
                            <div class="line">
                                <div class="image">
                                    <img src="{{ asset('assets/img/blog1.png') }}" alt="">
                                </div>
                                <div class="description">
                                    <h3>Pengalaman Kami menggunakan SIM-RS NCI MediSmart</h3>
                                    <p>Manfaat yang saya rasakan sebagai Direktur Rumah Sakit Al-Islam Bandung dengan
                                        penggunaan SIMRS NCI-MediSmart diantaranya adalah kecepatan dalam pengambilan
                                        keputusan, akurasi dalam mengidentifikasi masalah, kemudahan menyusun
                                        strategi...
                                    </p>
                                    <div class="button">
                                        <a href="#">Pelajari Lanjut</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card swiper-slide">
                            <div class="line">
                                <div class="image">
                                    <img src="{{ asset('assets/img/blog1.png') }}" alt="">
                                </div>
                                <div class="description">
                                    <h3>Pengalaman Kami menggunakan SIM-RS NCI MediSmart</h3>
                                    <p>Manfaat yang saya rasakan sebagai Direktur Rumah Sakit Al-Islam Bandung dengan
                                        penggunaan SIMRS NCI-MediSmart diantaranya adalah kecepatan dalam pengambilan
                                        keputusan, akurasi dalam mengidentifikasi masalah, kemudahan menyusun
                                        strategi...
                                    </p>
                                    <div class="button">
                                        <a href="#">Pelajari Lanjut</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Blog --}}

    {{-- Footer --}}
    @include('UserPage.Layouts.footer')
    {{-- End Footer --}}
</body>

<!-- Swiper JS -->
<script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

<script src="{{ asset('js/Script.js') }}"></script>

<!-- Initialize Swiper Home -->
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
            type: "bullets"
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>

<!-- Initialize Swiper Blog -->
<script>
    var swiper = new Swiper(".mySwiper-2", {
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
            type: "bullets"
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
        },
    });
</script>

</html>
