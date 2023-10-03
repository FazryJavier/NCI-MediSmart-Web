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

    {{-- Popup --}}
    @include('UserPage.Layouts.popups')
    {{-- End popup --}}

    {{-- WhatsApp Button --}}
    @include('UserPage.Layouts.wa-icon')

    {{-- Home --}}
    <section class="section-home scroll-section">
        <div class="home">
            <div class="container">
                <div class="title">
                    <div class="image">
                        @isset($detailproductContent['logoView'])
                            <img src="{{ asset('storage/' . $detailproductContent['logoView']) }}" alt="">
                        @endisset
                    </div>
                    <div class="description">
                        <div class="text">
                            @isset($detailproductContent['descriptionView'])
                                <p>{{ $detailproductContent['descriptionView'] }}</p>
                            @endisset
                        </div>
                        <div class="button">
                            @foreach ($whatsappContent['whatsappView'] as $phone_number)
                                <a href="https://api.whatsapp.com/send?phone={{ $phone_number }}"
                                    class="btn-call">Hubungi Kami</a>
                            @endforeach
                            @isset($detailproductContent['flyerView'])
                                <a href="{{ $detailproductContent['flyerView'] }}" class="btn-flyer">Download Flyer</a>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Home --}}

    {{-- Video --}}
    <section class="section-video scroll-section">
        <div class="video">
            <div class="container">
                <div class="screen">
                    @isset($detailproductContent['videoView'])
                        <iframe width="1000" height="700"
                            src="https://www.youtube.com/embed/{{ $detailproductContent['videoView'] }}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen controls muted></iframe>
                    @endisset
                </div>
            </div>
        </div>
    </section>
    {{-- End Video --}}


    {{-- Client --}}
    <section class="section-client scroll-section">
        <div class="client">
            <div class="container">
                <div class="title">
                    <h1><b>Mitra {{ optional($detailproductContent['products'])->title }}</b></h1>
                </div>
                <div class="image">
                    @if ($clientproductContent['imageView'])
                        <img src="{{ asset('storage/' . $clientproductContent['imageView']) }}" alt="">
                    @else
                        <img src="{{ asset('storage/placeholder.jpg') }}" alt="Placeholder">
                    @endif
                </div>
            </div>
        </div>
    </section>
    {{-- End Client --}}

    {{-- Advantage --}}
    <section class="section-advantage scroll-section">
        <div class="advantage">
            <div class="container">
                <div class="title">
                    <h1>Kelebihan {{ optional($detailproductContent['products'])->title }}</h1>
                </div>
                <div class="wrapper">
                    @foreach ($advantageproductContent as $advantageProduct)
                        <div class="card">
                            <div class="icon">
                                <img src="{{ asset('storage/' . $advantageProduct->icon) }}" alt="Icon">
                            </div>
                            <div class="description">
                                <h3>{{ $advantageProduct->title }}</h3>
                                <br>
                                @foreach ($advantageProduct->advantageListProducts as $advantageList)
                                    <ul>
                                        <li><i class="fa-solid fa-circle-check"
                                                style="color: #1bad4b;"></i>{{ $advantageList->name }}</li>
                                        <br>
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    {{-- End Advantage --}}

    {{-- Modul --}}
    <section class="section-modul scroll-section">
        <div class="modul">
            <div class="container">
                <div class="title">
                    <h1>Modul {{ optional($detailproductContent['products'])->title }}</h1>
                    <p>Dikembangkan dengan sistem modular, proses implementasi dilakukan bertahap dan terintegrasi antar
                        modul. Mengelola aktivitas kegiatan dari Front Office sampai dengan Back Office, menghasilkan
                        pelaporan secara lengkap dan cepat</p>
                </div>
                <div class="wrapper">
                    @foreach ($modulproductContent as $modulProduct)
                        <div class="card">
                            <a href="{{ route('modul.show', ['id' => $modulProduct['id']]) }}">
                                <div class="title">
                                    <h3>{{ $modulProduct->title }}</h3>
                                </div>
                                <div class="image">
                                    <img src="{{ asset('storage/' . $modulProduct->icon) }}" alt="">
                                </div>
                                <div class="description">
                                    <p>{{ $modulProduct->description }}</p>
                                </div>
                                <div class="btn-more">
                                    <a href="{{ route('modul.show', ['id' => $modulProduct['id']]) }}">Pelajari
                                        Lebih Lanjut...</a>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="btn">
                    <div class="btn-load">Lihat Semua Modul</div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Modul --}}

    {{-- Testimoni --}}
    <section class="section-testimoni scroll-section">
        <div class="testimoni">
            <div class="container">
                <div class="text">
                    <h1>Apa kata klient tentang kami</h1>
                </div>
                <div class="content swiper mySwiper">
                    <div class="wrapper swiper-wrapper">
                        @foreach ($feedbackContent['imageView'] as $index => $image)
                            <div class="card swiper-slide">
                                <div class="image">
                                    <img src="{{ asset('storage/' . $feedbackContent['imageView'][$index]) }}"
                                        alt="Logo">
                                </div>
                                <div class="description">
                                    <h3>{{ $feedbackContent['nameView'][$index] }}</h3>
                                    <p>{{ $feedbackContent['descriptionView'][$index] }}</p>
                                </div>
                            </div>
                        @endforeach
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
        let currentItem = 15;

        loadMoreBtn.addEventListener('click', () => {
            let boxes = document.querySelectorAll('.section-modul .modul .wrapper .card');

            for (var i = currentItem; i < currentItem + 5 && i < boxes.length; i++) {
                boxes[i].style.display = 'block';
            }

            currentItem += 5;

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

{{-- Animation Script --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const scrollSections = document.querySelectorAll(".scroll-section");

        function checkScroll() {
            scrollSections.forEach((section) => {
                const sectionTop = section.getBoundingClientRect().top;
                const sectionBottom = section.getBoundingClientRect().bottom;
                const windowHeight = window.innerHeight;

                // Check if the bottom of the section is above the viewport
                const isAboveViewport = sectionBottom < 0;

                // Check if the top of the section is below the viewport
                const isBelowViewport = sectionTop > windowHeight;

                if (!isAboveViewport && !isBelowViewport) {
                    section.classList.add("animated");
                } else {
                    section.classList.remove("animated");
                }
            });
        }

        window.addEventListener("scroll", checkScroll);
        window.addEventListener("resize", checkScroll);

        checkScroll();
    });
</script>

</html>
