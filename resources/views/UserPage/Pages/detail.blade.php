<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Blog</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-detail.css') }}">
    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
</head>

<body>
    {{-- Header --}}
    @include('UserPage.Layouts.header')
    {{-- End Header --}}

    {{-- WhatsApp Button --}}
    @include('UserPage.Layouts.wa-icon')

    {{-- Article --}}
    <section class="section-article">
        <div class="article">
            <div class="container">
                <article>
                    <img src="" alt="">
                    <div class="content">
                        <div class="title">
                            <h1>Mengenal Orthorexia Nervosa, Obsesi Terhadap Makanan Sehat</h1>
                        </div>

                        <div class="date">
                            <p>Admin 25/07/2023</p>
                        </div>

                        <div class="text">
                            <p>Di era modern ini, semakin banyak orang yang mulai peduli dengan kesehatan dan pola makan
                                yang sehat. Hal ini merupakan langkah positif untuk mencapai gaya hidup sehat dan
                                menjaga keseimbangan tubuh. Namun, ada juga kondisi yang mengkhawatirkan yang dapat
                                berkembang dari obsesi terhadap makanan sehat, yaitu Orthorexia Nervosa.</p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
    {{-- End Article --}}

    {{-- Konsultasi --}}
    @include('UserPage.Layouts.question')
    {{-- End Konsultasi --}}

    {{-- Rekomendasi --}}
    <section class="section-rekomendasi">
        <div class="rekomendasi">
            <div class="container">
                <h1>Rekomendasi</h1>
                <div class="wrapper">
                    <div class="card">
                        <img src="" alt="">
                        <div class="description">
                            <h3>Optimalkan Pelayanan, RS Suaka Insan Terapkan Pendaftaran Pasien Secara Online</h3>
                            <p>Pelayanan yang kurang optimal dan masa tunggu yang panjang, dapat menjadikan citra rumah
                                sakit kurang baik dalam masyarakat. Untungnya, saat ini sudah banyak teknologi digital
                                berupa aplikasi pelayanan kesehatan yang bisa digunakan Rumah Sakit...</p>
                        </div>
                        <a href="#">Pelajari Lanjut</a>
                    </div>

                    <div class="card">
                        <img src="" alt="">
                        <div class="description">
                            <h3>Optimalkan Pelayanan, RS Suaka Insan Terapkan Pendaftaran Pasien Secara Online</h3>
                            <p>Pelayanan yang kurang optimal dan masa tunggu yang panjang, dapat menjadikan citra rumah
                                sakit kurang baik dalam masyarakat. Untungnya, saat ini sudah banyak teknologi digital
                                berupa aplikasi pelayanan kesehatan yang bisa digunakan Rumah Sakit...</p>
                        </div>
                        <a href="#">Pelajari Lanjut</a>
                    </div>

                    <div class="card">
                        <img src="" alt="">
                        <div class="description">
                            <h3>Optimalkan Pelayanan, RS Suaka Insan Terapkan Pendaftaran Pasien Secara Online</h3>
                            <p>Pelayanan yang kurang optimal dan masa tunggu yang panjang, dapat menjadikan citra rumah
                                sakit kurang baik dalam masyarakat. Untungnya, saat ini sudah banyak teknologi digital
                                berupa aplikasi pelayanan kesehatan yang bisa digunakan Rumah Sakit...</p>
                        </div>
                        <a href="#">Pelajari Lanjut</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Rekomendasi --}}

    {{-- Footer --}}
    @include('UserPage.Layouts.footer')
    {{-- End Footer --}}
</body>

<!-- Swiper JS -->
<script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

<script src="{{ asset('js/Script.js') }}"></script>

</html>
