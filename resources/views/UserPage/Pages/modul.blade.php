<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>V-Claim / BPJS Claim</title>
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
                        <h1><b>V-Claim / BPJS Claim.</b></h1>
                        <p>BPJS Claim System merupakan Software Aplikasi Bridging antara SIM RS dengan Aplikasi INA CBGs
                            untuk claim BPJS, membantu RS memberikan kemudahan melakukan bridging SIM RS dengan aplikasi
                            claim BPJS.</p>
                        <div class="button">
                            <a href="#" class="btn-contact"><b>Hubungi Kami</b></a>
                        </div>
                    </div>
                    <div class="image">
                        <img src="{{ asset('assets/img/bpjs-claim1.png') }}" alt="">
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
                    <h1><b>V-Claim / BPJS Claim.</b>
                        <h1>
                </div>
                <div class="wrapper">
                    <div class="card">
                        <img src="{{ asset('assets/img/vector1.png') }}" alt="">
                        <h3><b>Import data pelayanan dari SIM RS</b></h3>
                        <p>Terintergrasi dengan data pasien pelayanan dari RWJ, RWI, atau IGD.</p>
                    </div>

                    <div class="card">
                        <img src="{{ asset('assets/img/vector2.png') }}" alt="">
                        <h3><b>Export data ke aplikasi klaim BPJS (INA-CBGs)</b></h3>
                        <p>Laporan data dengan format .txt untuk di intergrasi ke aplikasi INA-CBGs.</p>
                    </div>

                    <div class="card">
                        <img src="{{ asset('assets/img/vector3.png') }}" alt="">
                        <h3><b>Cek data hasil export pada aplikasi INA-CBGs Kemenkes</b></h3>
                        <p>Pengecekan data peserta BPJS dan rujukan pasien.</p>
                    </div>
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
                    <h1><b>Fasilitas V-Claim / BPJS Claim</b></h1>
                </div>
                <div class="content">
                    <div class="description-1">
                        <div class="image">
                            <img src="{{ asset('assets/img/bpjs-claim1.png') }}" alt="">
                        </div>
                        <div class="list">
                            <ul>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Import data
                                    pelayanan
                                    Pasien</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Integrasi proses,
                                    grouper tarif dengan software INA-CBGs</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Setup ICD IX</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Laporan Rekap Biaya
                                    Pelayanan vs Tarif INA-CBGs</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Laporan jasa medis
                                    dan
                                    Paramedis</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Laporan perbandingan
                                    SEP
                                    dan Claim</li>
                            </ul>
                        </div>
                    </div>
                    <div class="description-2">
                        <div class="list">
                            <ul>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Verifikasi Data
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
                                    BPJS-Rawat
                                    Jalan</li>
                                <li><i class="fa-solid fa-circle-check" style="color: #1bad4b;"></i>Laporan Individual
                                    Pasien</li>
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

</html>
