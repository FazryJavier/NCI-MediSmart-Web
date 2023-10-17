<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Question Section</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-question.css') }}">
    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
</head>

<body>
    {{-- Question --}}
    <section class="section-question scroll-section">
        <div class="question">
            <div class="container">
                <div class="border" style="background-image: url('{{ $ctaContent['imageView'] }}')">
                    <div class="wrapper">
                        <div class="text">
                            <h1>{{ $ctaContent['titleView'] }}</h1>
                            <p>{{ $ctaContent['descriptionView'] }}</p>
                            @foreach ($whatsappContent['whatsappView'] as $phone_number)
                                <a href="https://api.whatsapp.com/send?phone={{ $phone_number }}"
                                    class="btn-konsul">Konsultasi</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Question --}}
</body>

<script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

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
