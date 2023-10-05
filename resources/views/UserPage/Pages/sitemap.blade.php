<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sitemap</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-sitemap.css') }}">
    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
</head>

<body>
    {{-- Header --}}
    @include('UserPage.Layouts.header')
    {{-- End Header --}}

    {{-- Sitemap --}}
    <section class="section-sitemap scroll-section">
        <div class="sitemap">
            <div class="container">
                <h1><b>Sitemap</b></h1>
                <div class="wrapper">
                    <div class="sitemap-content">
                        <div class="title">
                            <h4><b>Produk</b></h4>
                        </div>
                        <div class="list">
                            <ul>
                                @foreach ($products as $product)
                                    <li><a href="{{ url('/ProductView/' . $product->id) }}">{{ $product->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="sitemap-content">
                        <div class="title">
                            <h4><b>Modul</b></h4>
                        </div>
                        <div class="list">
                            <ul>
                                @foreach ($moduls as $modul)
                                    <li><a href="{{ url('/Modul/' . $modul->id) }}">{{ $modul->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="sitemap-content">
                        <div class="title">
                            <h4><b>Lainnya</b></h4>
                        </div>
                        <div class="list">
                            <ul>
                                <li><a href="/HealthcareSolution">About</a></li>
                                <li><a href="/Testimoni">Testimoni</a></li>
                                <li><a href="/Blog">Blog</a></li>
                                <li><a href="/Demo">Demo</a></li>
                                @foreach ($whatsappContent['whatsappView'] as $phone_number)
                                    <li><a href="https://api.whatsapp.com/send?phone={{ $phone_number }}">Contact</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Sitemap --}}

    {{-- Footer --}}
    @include('UserPage.Layouts.footer')
    {{-- End Footer --}}
</body>

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
