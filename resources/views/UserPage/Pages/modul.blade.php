<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modul NCI Medismart</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-modul.css') }}">
    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
</head>

<body>
    {{-- Header --}}
    @include('UserPage.Layouts.header')
    {{-- End Header --}}

    {{-- WhatsApp Button --}}
    @include('UserPage.Layouts.wa-icon')

    {{-- Modul Description --}}
    <section class="section-modul">
        <div class="modul">
            <div class="container">
                <div class="first-page">
                    <div class="description">
                        <h1><b>{{ $modul->title }}</b></h1>
                        <p>{{ $modul->description }}</p>
                        <div class="button">
                            <a href="#" class="btn-contact"><b>Hubungi Kami</b></a>
                        </div>
                    </div>
                    <div class="image">
                        <img src="{{ asset('storage/' . $modul->icon) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Modul Description --}}

    {{-- Advantage --}}
    <section class="section-advantage">
        <div class="advantage">
            <div class="container">
                <div class="title">
                    <h1><b>{{ $modul->title }}</b>
                        <h1>
                </div>
                <div class="wrapper">
                    @foreach ($advantageModulProducts as $advantageModul)
                        <div class="card">
                            <img src="{{ asset('storage/' . $advantageModul->icon) }}" alt="">
                            <h3><b>{{ $advantageModul->title }}</b></h3>
                            <p>{{ $advantageModul->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    {{-- End Advantage --}}

    {{-- Fasilitas --}}
    <section class="section-fasilitas">
        <div class="fasilitas">
            <div class="container">
                <div class="title">
                    <h1><b>Fasilitas {{ $modul->title }}</b></h1>
                </div>
                <div class="content">
                    <div class="description-1">
                        <div class="image">
                            <img src="{{ asset('assets/img/bpjs-claim1.png') }}" alt="">
                        </div>
                        <div class="list">
                            <ul>
                                @foreach ($listfasilitasModulProducts1 as $fs1)
                                    <li><i class="fa-solid fa-circle-check"
                                            style="color: #1bad4b;"></i>{{ $fs1->description }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="description-2">
                        <div class="list">
                            <ul>
                                {{-- <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Verifikasi Data
                                    Pasien
                                </li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Setup ICD X</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Laporan Klaim per
                                    Pasien
                                </li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Laporan Rekap Claim
                                    BPJS
                                </li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Laporan Rekapitulasi
                                    Tarif Per Pasien</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Rekap Claim
                                    BPJS-Rawat Jalan</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Laporan Individual
                                    Pasien</li> --}}
                                @foreach ($listfasilitasModulProducts2 as $fs2)
                                    <li><i class="fa-solid fa-circle-check"
                                            style="color: #1bad4b;"></i>{{ $fs2->description }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="image">
                            <img src="{{ asset('assets/img/bpjs-claim2.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Fasilitas --}}

    {{-- Testimoni --}}
    <section class="section-testimoni">
        <div class="testimoni">
            <div class="container">
                <div class="text">
                    <h1>Apa kata klient tentang kami</h1>
                </div>
                <div class="content swiper mySwiper">
                    <div class="wrapper swiper-wrapper">
                        @foreach ($feedback as $fd)
                            <div class="card swiper-slide">
                                <div class="image">
                                    <img src="{{ asset('storage/' . $fd->image) }}" alt="">
                                </div>
                                <div class="description">
                                    <h3>{{ $fd->title }}</h3>
                                    <p>{{ $fd->description }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="card swiper-slide">
                                <div class="image">
                                    <img src="{{ asset('assets/img/rumah-sakit.png') }}" alt="">
                                </div>
                                <div class="description">
                                    <h3>RSU Bhaksi Asih</h3>
                                    <p>"Mudah digunakan (user friendly), sangat membantu dalam proses pencatatan,
                                        pencarian
                                        dan pelaporan. Support personil site dan dukungan purna jual dari kantor pusat,
                                        sangat membantu rumah sakit dalam memberikan usulan solusi dari setiap
                                        permasalahan"
                                    </p>
                                </div>
                            </div>

                            <div class="card swiper-slide">
                                <div class="image">
                                    <img src="{{ asset('assets/img/rumah-sakit.png') }}" alt="">
                                </div>
                                <div class="description">
                                    <h3>RSU Bhaksi Asih</h3>
                                    <p>"Mudah digunakan (user friendly), sangat membantu dalam proses pencatatan,
                                        pencarian
                                        dan pelaporan. Support personil site dan dukungan purna jual dari kantor pusat,
                                        sangat membantu rumah sakit dalam memberikan usulan solusi dari setiap
                                        permasalahan"
                                    </p>
                                </div>
                            </div>

                            <div class="card swiper-slide">
                                <div class="image">
                                    <img src="{{ asset('assets/img/rumah-sakit.png') }}" alt="">
                                </div>
                                <div class="description">
                                    <h3>RSU Bhaksi Asih</h3>
                                    <p>"Mudah digunakan (user friendly), sangat membantu dalam proses pencatatan,
                                        pencarian
                                        dan pelaporan. Support personil site dan dukungan purna jual dari kantor pusat,
                                        sangat membantu rumah sakit dalam memberikan usulan solusi dari setiap
                                        permasalahan"
                                    </p>
                                </div>
                            </div> --}}
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

</html>
