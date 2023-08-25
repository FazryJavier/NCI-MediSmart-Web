<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Healthcare Solution</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-healthcare.css') }}">
    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
</head>

<body>
    {{-- Header --}}
    @include('UserPage.Layouts.header')
    {{-- End Header --}}

    {{-- WhatsApp Button --}}
    @include('UserPage.Layouts.wa-icon')

    {{-- Video Views --}}
    <section class="section-video">
        <div class="video-view">
            <div class="container">
                <div class="text">
                    <h1>NCI - MediSmart</h1>
                </div>
                <div class="content">
                    <div class="video">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/65pOIFtQUyg"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen controls muted></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Video Views --}}

    {{-- Visi Misi --}}
    <section class="section-visimisi">
        <div class="visimisi">
            <div class="container">
                <div class="content">
                    <img src="{{ asset('assets/img/Logo Medismart.png') }}" alt="">
                    <p><b>NCI-MediSmart</b> memberikan solusi bagi fasilitas kesehatan Indonesia untuk bertransformasi
                        dengan layanan digital dan teknologi terbarukan untuk mendukung fasilitas kesehatan mencapai
                        hasil terbaik dengan skala yang besar.</p>
                </div>
                <div class="text">
                    <div class="columns">
                        <div class="card">
                            <h1>Visi</h1>
                            <p>Menjadi Perusahaan IT Terbaik, Bermanfaat dan Berskala Nasional</p>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="card">
                            <h1>Misi</h1>
                            <p>Menciptakan produk yang mudah digunakan, berkualitas dan mengikuti trend teknologi.</p>
                            <p>Memberikan pelayanan prima dengan menerapkan prosedur kerja standar dan dukungan sumber
                                daya manusia yang handal,berkualitas dan kompeten.</p>
                            <p>Memberikan manfaat bagi semua pihak.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    {{-- End Visi Misi --}}

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
