<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIMRS NCI MediSmart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-product.css') }}">
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
    <section class="section-home">
        <div class="home">
            <div class="container">
                <div class="title">
                    <div class="image">
                        <img src="{{ asset('assets/img/medismart.png') }}" alt="">
                    </div>
                    <div class="description">
                        <div class="text">
                            <p>SIMRS Medismart merupakan Sistem Informasi Manajemen Rumah Sakit yang sudah ada sejak
                                tahun 1991 dan terus dilakukan pembaharuan terkait dengan perkembangan teknologi dan
                                regulasi, sehingga dapat menyesuaikan dengan kebutuhan Rumah Sakit sebagai pengguna
                                SIMRS.</p>
                        </div>
                        <div class="button">
                            <a href="#" class="btn-call">Hubungi Kami</a>
                            <a href="#" class="btn-flyer">Download Flyer</a>
                        </div>
                    </div>
                </div>
                <div class="screen">
                    <div class="video">
                        <iframe width="1000" height="700" src="https://www.youtube.com/embed/65pOIFtQUyg"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen controls muted></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Home --}}

    {{-- Client --}}
    <section class="section-client">
        <div class="client">
            <div class="container">
                <div class="title">
                    <h1><b>Mitra SIMRS NCI - Medismart</b></h1>
                </div>
                <div class="image">
                    <img src="{{ asset('assets/img/Client.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    {{-- End Client --}}

    {{-- Advantage --}}
    <section class="section-advantage">
        <div class="advantage">
            <div class="container">
                <div class="title">
                    <h1>Kelebihan SIMRS NCI - Medismart</h1>
                </div>
                <div class="wrapper">
                    <div class="card">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon1.png') }}" alt="Icon">
                        </div>
                        <div class="description">
                            <h3>Teknologi</h3>
                            <ul>
                                <li>Multi Operating System (Windows, Linux)</li>
                                <li>Multiplatform (Dekstop, Web based, Android)</li>
                                <li>Teknologi LIS dan PACS</li>
                                <li>Teknologi Barcode & RFID</li>
                            </ul>
                        </div>
                    </div>

                    <div class="card">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon2.png') }}" alt="Icon">
                        </div>
                        <div class="description">
                            <h3>Integrasi</h3>
                            <ul>
                                <li>Integrasi modul layanan front office - Back Office</li>
                                <li>Integrasi BPJS & V-Claim</li>
                                <li>Integrasi LIS dab PACS</li>
                                <li>Integrasi Pendaftaran Online Mandiri - SIMRS</li>
                                <li>Integrasi Aplikasi</li>
                                <li>KEMENKES (SISRUTE, SIRANAP)</li>
                            </ul>
                        </div>
                    </div>

                    <div class="card">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon3.png') }}" alt="Icon">
                        </div>
                        <div class="description">
                            <h3>Modular</h3>
                            <ul>
                                <li>Multi Operating System (Windows, Linux)</li>
                                <li>Multiplatform (Dekstop, Web based, Android)</li>
                                <li>Teknologi LIS dan PACS</li>
                                <li>Teknologi Barcode & RFID</li>
                            </ul>
                        </div>
                    </div>

                    <div class="card">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon4.png') }}" alt="Icon">
                        </div>
                        <div class="description">
                            <h3>Purna Jual</h3>
                            <ul>
                                <li>Multi Operating System (Windows, Linux)</li>
                                <li>Multiplatform (Dekstop, Web based, Android)</li>
                                <li>Teknologi LIS dan PACS</li>
                                <li>Teknologi Barcode & RFID</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Advantage --}}

    {{-- Modul --}}
    <section class="section-modul">
        <div class="modul">
            <div class="container">
                <div class="title">
                    <h1>Modul SIMRS NCI - Medismart</h1>
                    <p>Dikembangkan dengan sistem modular, proses implementasi dilakukan bertahap dan terintegrasi antar
                        modul. Mengelola aktivitas kegiatan dari Front Office sampai dengan Back Office, menghasilkan
                        pelaporan secara lengkap dan cepat</p>
                </div>
                <div class="wrapper">
                    <div class="card">
                        <div class="title">
                            <h3>Modul Rawat Jalan (Pendaftaran dan Kasir)</h3>
                        </div>
                        <div class="image">
                            <img src="{{ asset('assets/img/modul1.png') }}" alt="">
                        </div>
                        <div class="description">
                            <p>Aplikasi pelayanan rawat darurat yang bisa membantu pelayanan UGD mulai dari proses
                                pendaftaran dan kasir
                            </p>
                        </div>
                        <div class="btn-more">
                            <a href="/Modul">Pelajari Lebih Lanjut...</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="title">
                            <h3>Modul Rawat Jalan (Pendaftaran dan Kasir)</h3>
                        </div>
                        <div class="image">
                            <img src="{{ asset('assets/img/modul1.png') }}" alt="">
                        </div>
                        <div class="description">
                            <p>Aplikasi pelayanan rawat darurat yang bisa membantu pelayanan UGD mulai dari proses
                                pendaftaran dan kasir
                            </p>
                        </div>
                        <div class="btn-more">
                            <a href="/Modul">Pelajari Lebih Lanjut...</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="title">
                            <h3>Modul Rawat Jalan (Pendaftaran dan Kasir)</h3>
                        </div>
                        <div class="image">
                            <img src="{{ asset('assets/img/modul1.png') }}" alt="">
                        </div>
                        <div class="description">
                            <p>Aplikasi pelayanan rawat darurat yang bisa membantu pelayanan UGD mulai dari proses
                                pendaftaran dan kasir
                            </p>
                        </div>
                        <div class="btn-more">
                            <a href="/Modul">Pelajari Lebih Lanjut...</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="title">
                            <h3>Modul Rawat Jalan (Pendaftaran dan Kasir)</h3>
                        </div>
                        <div class="image">
                            <img src="{{ asset('assets/img/modul1.png') }}" alt="">
                        </div>
                        <div class="description">
                            <p>Aplikasi pelayanan rawat darurat yang bisa membantu pelayanan UGD mulai dari proses
                                pendaftaran dan kasir
                            </p>
                        </div>
                        <div class="btn-more">
                            <a href="/Modul">Pelajari Lebih Lanjut...</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="title">
                            <h3>Modul Rawat Jalan (Pendaftaran dan Kasir)</h3>
                        </div>
                        <div class="image">
                            <img src="{{ asset('assets/img/modul1.png') }}" alt="">
                        </div>
                        <div class="description">
                            <p>Aplikasi pelayanan rawat darurat yang bisa membantu pelayanan UGD mulai dari proses
                                pendaftaran dan kasir
                            </p>
                        </div>
                        <div class="btn-more">
                            <a href="/Modul">Pelajari Lebih Lanjut...</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="title">
                            <h3>Modul Rawat Jalan (Pendaftaran dan Kasir)</h3>
                        </div>
                        <div class="image">
                            <img src="{{ asset('assets/img/modul1.png') }}" alt="">
                        </div>
                        <div class="description">
                            <p>Aplikasi pelayanan rawat darurat yang bisa membantu pelayanan UGD mulai dari proses
                                pendaftaran dan kasir
                            </p>
                        </div>
                        <div class="btn-more">
                            <a href="/Modul">Pelajari Lebih Lanjut...</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="title">
                            <h3>Modul Rawat Jalan (Pendaftaran dan Kasir)</h3>
                        </div>
                        <div class="image">
                            <img src="{{ asset('assets/img/modul1.png') }}" alt="">
                        </div>
                        <div class="description">
                            <p>Aplikasi pelayanan rawat darurat yang bisa membantu pelayanan UGD mulai dari proses
                                pendaftaran dan kasir
                            </p>
                        </div>
                        <div class="btn-more">
                            <a href="/Modul">Pelajari Lebih Lanjut...</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="title">
                            <h3>Modul Rawat Jalan (Pendaftaran dan Kasir)</h3>
                        </div>
                        <div class="image">
                            <img src="{{ asset('assets/img/modul1.png') }}" alt="">
                        </div>
                        <div class="description">
                            <p>Aplikasi pelayanan rawat darurat yang bisa membantu pelayanan UGD mulai dari proses
                                pendaftaran dan kasir
                            </p>
                        </div>
                        <div class="btn-more">
                            <a href="/Modul">Pelajari Lebih Lanjut...</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="title">
                            <h3>Modul Rawat Jalan (Pendaftaran dan Kasir)</h3>
                        </div>
                        <div class="image">
                            <img src="{{ asset('assets/img/modul1.png') }}" alt="">
                        </div>
                        <div class="description">
                            <p>Aplikasi pelayanan rawat darurat yang bisa membantu pelayanan UGD mulai dari proses
                                pendaftaran dan kasir
                            </p>
                        </div>
                        <div class="btn-more">
                            <a href="/Modul">Pelajari Lebih Lanjut...</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="title">
                            <h3>Modul Rawat Jalan (Pendaftaran dan Kasir)</h3>
                        </div>
                        <div class="image">
                            <img src="{{ asset('assets/img/modul1.png') }}" alt="">
                        </div>
                        <div class="description">
                            <p>Aplikasi pelayanan rawat darurat yang bisa membantu pelayanan UGD mulai dari proses
                                pendaftaran dan kasir
                            </p>
                        </div>
                        <div class="btn-more">
                            <a href="/Modul">Pelajari Lebih Lanjut...</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="title">
                            <h3>Modul Rawat Jalan (Pendaftaran dan Kasir)</h3>
                        </div>
                        <div class="image">
                            <img src="{{ asset('assets/img/modul1.png') }}" alt="">
                        </div>
                        <div class="description">
                            <p>Aplikasi pelayanan rawat darurat yang bisa membantu pelayanan UGD mulai dari proses
                                pendaftaran dan kasir
                            </p>
                        </div>
                        <div class="btn-more">
                            <a href="/Modul">Pelajari Lebih Lanjut...</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="title">
                            <h3>Modul Rawat Jalan (Pendaftaran dan Kasir)</h3>
                        </div>
                        <div class="image">
                            <img src="{{ asset('assets/img/modul1.png') }}" alt="">
                        </div>
                        <div class="description">
                            <p>Aplikasi pelayanan rawat darurat yang bisa membantu pelayanan UGD mulai dari proses
                                pendaftaran dan kasir
                            </p>
                        </div>
                        <div class="btn-more">
                            <a href="/Modul">Pelajari Lebih Lanjut...</a>
                        </div>
                    </div>
                </div>
                <div class="btn">
                    <div class="btn-load">Lihat Semua Modul</div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Modul --}}

    {{-- Testimoni --}}
    <section class="section-testimoni">
        <div class="testimoni">
            <div class="container">
                <div class="text">
                    <h1>Apa kata klient tentang kami</h1>
                </div>
                <div class="content swiper mySwiper">
                    <div class="wrapper swiper-wrapper">
                        <div class="card swiper-slide">
                            <div class="image">
                                <img src="{{ asset('assets/img/rumah-sakit.png') }}" alt="">
                            </div>
                            <div class="description">
                                <h3>RSU Bhaksi Asih</h3>
                                <p>"Mudah digunakan (user friendly), sangat membantu dalam proses pencatatan, pencarian
                                    dan pelaporan. Support personil site dan dukungan purna jual dari kantor pusat,
                                    sangat membantu rumah sakit dalam memberikan usulan solusi dari setiap permasalahan"
                                </p>
                            </div>
                        </div>

                        <div class="card swiper-slide">
                            <div class="image">
                                <img src="{{ asset('assets/img/rumah-sakit.png') }}" alt="">
                            </div>
                            <div class="description">
                                <h3>RSU Bhaksi Asih</h3>
                                <p>"Mudah digunakan (user friendly), sangat membantu dalam proses pencatatan, pencarian
                                    dan pelaporan. Support personil site dan dukungan purna jual dari kantor pusat,
                                    sangat membantu rumah sakit dalam memberikan usulan solusi dari setiap permasalahan"
                                </p>
                            </div>
                        </div>

                        <div class="card swiper-slide">
                            <div class="image">
                                <img src="{{ asset('assets/img/rumah-sakit.png') }}" alt="">
                            </div>
                            <div class="description">
                                <h3>RSU Bhaksi Asih</h3>
                                <p>"Mudah digunakan (user friendly), sangat membantu dalam proses pencatatan, pencarian
                                    dan pelaporan. Support personil site dan dukungan purna jual dari kantor pusat,
                                    sangat membantu rumah sakit dalam memberikan usulan solusi dari setiap permasalahan"
                                </p>
                            </div>
                        </div>

                        <div class="card swiper-slide">
                            <div class="image">
                                <img src="{{ asset('assets/img/rumah-sakit.png') }}" alt="">
                            </div>
                            <div class="description">
                                <h3>RSU Bhaksi Asih</h3>
                                <p>"Mudah digunakan (user friendly), sangat membantu dalam proses pencatatan, pencarian
                                    dan pelaporan. Support personil site dan dukungan purna jual dari kantor pusat,
                                    sangat membantu rumah sakit dalam memberikan usulan solusi dari setiap permasalahan"
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-next nav-btn"></div>
                    <div class="swiper-button-prev nav-btn"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Testimoni --}}

    {{-- Konsultasi --}}
    @include('UserPage.Layouts.question')
    {{-- End Konsultasi --}}

    {{-- Footer --}}
    @include('UserPage.Layouts.footer')
    {{-- End Footer --}}
</body>

<!-- Swiper JS -->
<script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

<script src="{{ asset('js/Script.js') }}"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        loop: true,
        spaceBetween: 10,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
            type: "bullets"
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>

{{-- Load More --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let loadMoreBtn = document.querySelector('.btn-load');
        let loadLessBtn = document.querySelector('.btn-less');
        let currentItem = 8;

        loadMoreBtn.addEventListener('click', () => {
            let boxes = document.querySelectorAll('.section-modul .modul .wrapper .card');

            for (var i = currentItem; i < currentItem + 4 && i < boxes.length; i++) {
                boxes[i].style.display = 'block';
            }

            currentItem += 4;

            if (currentItem >= boxes.length) {
                loadMoreBtn.style.display = 'none';
                // loadLessBtn.style.display = 'inline-block';
            }
        });

        // loadLessBtn.addEventListener('click', () => {
        //     let boxes = document.querySelectorAll('.section-modul .modul .wrapper .card');

        //     for (var i = boxes.length - 1; i >= currentItem - 3; i--) {
        //         boxes[i].style.display = 'none';
        //     }

        //     currentItem -= 3;

        //     if (currentItem <= 3) {
        //         loadMoreBtn.style.display = 'inline-block';
        //         loadLessBtn.style.display = 'none';
        //     }
        // });
    });
</script>

</html>
