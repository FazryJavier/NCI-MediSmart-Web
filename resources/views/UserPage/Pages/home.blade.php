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
                @if ($sliderContent['statusView'][$index] == 1)
                    <div class="slide swiper-slide">
                        <img src="{{ asset('storage/' . $sliderContent['imageView'][$index]) }}" alt=""
                            class="image">
                        {{-- @endif --}}
                        <div class="image-date">
                            <h1>{{ $title }}</h1>
                            <h3>{{ $sliderContent['captionView'][$index] }}</h3>
                            {{-- <a href="" class="button-1">Hubungi Kami</a>
                        <a href="" class="button-2">Pelajari Lanjut</a> --}}
                            <a href="" class="button-1" data-index="{{ $index }}">Hubungi Kami</a>
                            <a href="" class="button-2" data-index="{{ $index }}">Pelajari Lanjut</a>
                        </div>
                    </div>
                @endif
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
                    <h3><b>{{ $clientContent['titleView'] }}</b></h3>
                </div>
                <div class="container-line">
                    <div class="center-line"></div>
                </div>
                <div class="image">
                    <img src="{{ $clientContent['imageView'] }}" alt="Client">
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
                        <p><b>{{ $experienceContent['titleView'] }}</b></p>
                    </div>
                    <div class="description">
                        <p>{{ $experienceContent['descriptionView'] }}</p>
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
                        <p><b>{{ $mapContent['titleView'] }}</b></p>
                    </div>
                    <div class="maps">
                        <img src="{{ $mapContent['imageView'] }}" alt="Indonesia" width="780">
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
                    @foreach ($productContent['imageView'] as $index => $image)
                        <div class="card">
                            <div class="image">
                                <img src="{{ asset('storage/' . $productContent['imageView'][$index]) }}"
                                    alt="Product" />
                            </div>
                            <div class="layer">
                                <h1>{{ $productContent['titleView'][$index] }}</h1>
                                <h3>{{ $productContent['subtitleView'][$index] }}</h3>
                                <p>{{ $productContent['descriptionView'][$index] }}</p>
                                @foreach ($productContent['modulView'] as $modul)
                                    @if ($modul->productId == $productContent['idView'][$index])
                                        <ul>
                                            <li><i class="fa-solid fa-circle-check"
                                                    style="color: #1bad4b;"></i>{{ $modul->title }}
                                            </li>
                                        </ul>
                                    @endif
                                @endforeach
                            </div>
                            <div class="bottom">
                                <div class="container-line">
                                    <div class="center-line"></div>
                                </div>
                                <div class="button">
                                    <a href={{ url('/ProductView/' . $productContent['idView'][$index]) }}><i class="fa-solid fa-arrow-right"
                                            style="color: #ffffff;"></i>Pelajari Lanjut</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
                        @foreach ($articleContent['imageView'] as $index => $image)
                            <div class="card swiper-slide">
                                <div class="line">
                                    <div class="image">
                                        <img src="{{ asset('storage/' . $articleContent['imageView'][$index]) }}"
                                            alt="Image">
                                    </div>
                                    <div class="description">
                                        <h3>{{ $articleContent['titleView'][$index] }}</h3>
                                        <p>{{ strip_tags($articleContent['descriptionView'][$index]) }}</p>
                                        <div class="button">
                                            <a
                                                href={{ route('detail.show', ['id' => $articleContent['idView'][$index]]) }}>Pelajari
                                                Lanjut</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
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
<script>
    function showButtons() {
        const buttons = document.querySelectorAll('data-index="${index}"');
        buttons.forEach(button => {
            button.style.display = 'block';
        });
    }

    function hideButtons(index) {
        const buttons = document.querySelectorAll('[data-index]="${index}"');
        buttons.forEach(button => {
            button.style.display = 'none';
        });

    }

    const slides = document.querySelectorAll('.slide');
    slides.forEach((slide, index) => {
        slide.addEventListener('mouseenter', () => {
            showButtons(index);
        });
        slide.addEventListener('mouseleave', () => {
            hideButtons(index);
        });
    });
</script>

</html>
