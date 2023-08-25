<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog Thumbnails</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-blog.css') }}">
    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
</head>

<body>
    {{-- Header --}}
    @include('UserPage.Layouts.header')
    {{-- End Header --}}

    {{-- WhatsApp Button --}}
    @include('UserPage.Layouts.wa-icon')

    {{-- Blog --}}
    <section class="section-blog">
        <div class="blog">
            <div class="container">
                <div class="text">
                    <h1>NCIMedismart/Blog</h1>
                </div>

                <div class="top-card">
                    <div class="content">
                        <div class="image">
                            <img src="{{ asset('assets/img/blog.png') }}" alt="">
                        </div>
                        <div class="description">
                            <h3>Pengalaman Kami menggunakan SIM-RS NCI MediSmart</h3>
                            <p>Manfaat yang saya rasakan sebagai Direktur Rumah Sakit Al-Islam Bandung dengan
                                penggunaan SIMRS NCI-MediSmart diantaranya adalah kecepatan dalam pengambilan
                                keputusan, akurasi dalam mengidentifikasi masalah, kemudahan menyusun strategi...
                            </p>
                            <a href="/DetailBlog">Pelajari Lanjut...</a>
                            <div class="update">
                                <div class="name">
                                    <p class="admin">Admin</p>
                                </div>
                                <div class="date">
                                    <p class="admin">25/07/2023</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bottom-card">
                    <div class="wrapper">
                        <div class="card">
                            <div class="image">
                                <img src="{{ asset('assets/img/blog1.png') }}" alt="">
                            </div>
                            <div class="description">
                                <h3>Optimalkan Pelayanan, RS Suaka Insan Terapkan Pendaftaran Pasien Secara Online
                                </h3>
                                <p>Pelayanan yang kurang optimal dan masa tunggu yang panjang, dapat menjadikan
                                    citra rumah sakit kurang baik dalam masyarakat. Untungnya, saat ini sudah banyak
                                    teknologi digital berupa aplikasi pelayanan kesehatan yang bisa digunakan Rumah
                                    Sakit...
                                </p>
                            </div>
                            <div class="button">
                                <a href="#">Pelajari Lanjut</a>
                            </div>
                        </div>

                        <div class="card">
                            <div class="image">
                                <img src="{{ asset('assets/img/blog2.png') }}" alt="">
                            </div>
                            <div class="description">
                                <h3>Uji Coba Implementasi Rekam Medis Elektronik di RS Bolaang
                                </h3>
                                <p>
                                    Pada hari Senin (03/07/2023), RS Bolaang telah menyelesaikan periode uji coba
                                    implementasi Rekam Medis Elektronik dengan baik. Inisiasi uji coba ini dilatar
                                    belakangi dengan adanya peraturan pemerintah yang mewajibkan pemakaian Rekam Medis
                                    Elektronik yang..
                                </p>
                            </div>
                            <div class="button">
                                <a href="#">Pelajari Lanjut</a>
                            </div>
                        </div>

                        <div class="card">
                            <div class="image">
                                <img src="{{ asset('assets/img/blog3.png') }}" alt="">
                            </div>
                            <div class="description">
                                <h3>Mengenal Orthorexia Nervosa, Obsesi Terhadap Makanan Sehat
                                </h3>
                                <p>
                                    Makanan sehat adalah hal yang penting untuk menjaga kesehatan tubuh. Karena itu
                                    mengkonsumsi makanan sehat adalah keharusan untuk setiap orang. Namun keinginan kuat
                                    yang berujung menjadi obsesi terhadap makanan sehat justru mengindikasikan suatu
                                    kelainan....
                                </p>
                            </div>
                            <div class="button">
                                <a href="#">Pelajari Lanjut</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Blog --}}

    {{-- Konsultasi --}}
    @include('UserPage.Layouts.question')
    {{-- End Konsultasi --}}

    {{-- Article --}}
    <section class="section-article">
        <div class="article">
            <div class="container">
                <div class="wrapper">
                    <div class="card">
                        <img src="{{ asset('assets/img/blog3.png') }}" alt="">
                        <div class="description">
                            <h3>Mengenal Orthorexia Nervosa, Obsesi Terhadap Makanan Sehat</h3>
                            <p>Makanan sehat adalah hal yang penting untuk menjaga kesehatan tubuh. Karena itu
                                mengkonsumsi makanan sehat adalah keharusan untuk setiap orang. Namun keinginan kuat
                                yang berujung menjadi obsesi terhadap makanan sehat justru mengindikasikan suatu
                                kelainan....</p>
                            <a href="#">Pelajari Lanjut</a>
                        </div>
                    </div>

                    <div class="card">
                        <img src="{{ asset('assets/img/blog3.png') }}" alt="">
                        <div class="description">
                            <h3>Mengenal Orthorexia Nervosa, Obsesi Terhadap Makanan Sehat</h3>
                            <p>Makanan sehat adalah hal yang penting untuk menjaga kesehatan tubuh. Karena itu
                                mengkonsumsi makanan sehat adalah keharusan untuk setiap orang. Namun keinginan kuat
                                yang berujung menjadi obsesi terhadap makanan sehat justru mengindikasikan suatu
                                kelainan....</p>
                            <a href="#">Pelajari Lanjut</a>
                        </div>
                    </div>

                    <div class="card">
                        <img src="{{ asset('assets/img/blog3.png') }}" alt="">
                        <div class="description">
                            <h3>Mengenal Orthorexia Nervosa, Obsesi Terhadap Makanan Sehat</h3>
                            <p>Makanan sehat adalah hal yang penting untuk menjaga kesehatan tubuh. Karena itu
                                mengkonsumsi makanan sehat adalah keharusan untuk setiap orang. Namun keinginan kuat
                                yang berujung menjadi obsesi terhadap makanan sehat justru mengindikasikan suatu
                                kelainan....</p>
                            <a href="#">Pelajari Lanjut</a>
                        </div>
                    </div>

                    <div class="card">
                        <img src="{{ asset('assets/img/blog3.png') }}" alt="">
                        <div class="description">
                            <h3>Mengenal Orthorexia Nervosa, Obsesi Terhadap Makanan Sehat</h3>
                            <p>Makanan sehat adalah hal yang penting untuk menjaga kesehatan tubuh. Karena itu
                                mengkonsumsi makanan sehat adalah keharusan untuk setiap orang. Namun keinginan kuat
                                yang berujung menjadi obsesi terhadap makanan sehat justru mengindikasikan suatu
                                kelainan....</p>
                            <a href="#">Pelajari Lanjut</a>
                        </div>
                    </div>
                </div>

                <div class="button">
                    <div class="btn-load">load More</div>
                    <div class="btn-less">load Less</div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Article --}}

    {{-- Footer --}}
    @include('UserPage.Layouts.footer')
    {{-- End Footer --}}
</body>

<!-- Swiper JS -->
<script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

<script src="{{ asset('js/Script.js') }}"></script>

{{-- Load More --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let loadMoreBtn = document.querySelector('.btn-load');
        let loadLessBtn = document.querySelector('.btn-less');
        let currentItem = 6;

        loadMoreBtn.addEventListener('click', () => {
            let boxes = document.querySelectorAll('.section-testimoni .content .wrapper .card');

            for (var i = currentItem; i < currentItem + 3 && i < boxes.length; i++) {
                boxes[i].style.display = 'block';
            }

            currentItem += 3;

            if (currentItem >= boxes.length) {
                loadMoreBtn.style.display = 'none';
                // loadLessBtn.style.display = 'inline-block';
            }
        });

        // loadLessBtn.addEventListener('click', () => {
        //     let boxes = document.querySelectorAll('.section-testimoni .content .wrapper .card');

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
