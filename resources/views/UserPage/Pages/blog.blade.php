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
    <section class="section-blog scroll-section">
        <div class="blog">
            <div class="container">
                <div class="text">
                    <h1>NCIMedismart/Blog</h1>
                </div>

                <div class="top-card">
                    <div class="content">
                        <div class="image">
                            <img src="{{ asset('storage/' . $articles->image) }}" alt="">
                        </div>
                        <div class="description">
                            <h3>{{ $articles->title }}</h3>
                            <p>{{ strip_tags($articles->description) }}
                            </p>
                            <a href={{ url('/DetailBlog/' . $articles->id) }}>Pelajari Lanjut...</a>
                            <div class="update">
                                <div class="name">
                                    <p class="admin">{{ $articles->Users->username }}</p>
                                </div>
                                <div class="date">
                                    <p class="admin">{{ $articles->created_at }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bottom-card">
                    <div class="wrapper">
                        @foreach ($articles2 as $ar2)
                            <div class="card">
                                <div class="image">
                                    <img src="{{ asset('storage/' . $ar2->image) }}" alt="">
                                </div>
                                <div class="description">
                                    <h3>{{ $ar2->title }}
                                    </h3>
                                    <p>{{ strip_tags($ar2->description) }}
                                    </p>
                                </div>
                                <div class="button">
                                    <a href={{ url('/DetailBlog/' . $ar2->id) }}>Pelajari Lanjut</a>
                                </div>
                            </div>
                        @endforeach
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
    <section class="section-article scroll-section">
        <div class="article">
            <div class="container">
                <div class="wrapper">
                    @foreach ($articles3 as $ar3)
                        <div class="card">
                            <div class="image">
                                <img src="{{ asset('storage/' . $ar3->image) }}" alt="">
                            </div>
                            <div class="description">
                                <h3>{{ $ar3->title }}</h3>
                                <p>{{ strip_tags($ar3->description) }}</p>
                                <a href={{ url('/DetailBlog/' . $ar3->id) }}>Pelajari Lanjut</a>
                            </div>
                        </div>
                    @endforeach
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
        let currentItem = 3;

        function updateCardDisplay() {
            let boxes = document.querySelectorAll('.section-article .article .card');

            for (var i = 0; i < boxes.length; i++) {
                if (i < currentItem) {
                    boxes[i].style.display = window.innerWidth <= 991 ? 'block' : 'flex';
                } else {
                    boxes[i].style.display = 'none';
                }
            }

            if (currentItem >= boxes.length) {
                loadMoreBtn.style.display = 'none';
            } else {
                loadMoreBtn.style.display = 'inline-block';
            }
        }

        loadMoreBtn.addEventListener('click', () => {
            currentItem += 2;
            updateCardDisplay();
        });

        window.addEventListener('resize', updateCardDisplay);

        updateCardDisplay();

        // loadLessBtn.addEventListener('click', () => {
        //     let boxes = document.querySelectorAll('.section-article .article .card');

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
