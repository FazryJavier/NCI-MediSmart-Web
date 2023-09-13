<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Testimoni</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-testimoni.css') }}">
    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
</head>

<body>
    {{-- Header --}}
    @include('UserPage.Layouts.header')
    {{-- End Header --}}

    {{-- WhatsApp Button --}}
    {{-- @include('UserPage.Layouts.wa-icon') --}}

    {{-- Testimoni --}}
    <section class="section-testimoni">
        <div class="testimoni">
            <div class="container">
                <div class="text">
                    <h1>Apa kata klient tentang kami</h1>
                </div>
                <div class="content">
                    <div class="wrapper">
                        @foreach ($feedbackContent['imageView'] as $index => $image)
                            <div class="card">
                                <img src="{{ asset('storage/' . $feedbackContent['imageView'][$index]) }}"
                                    alt="">
                                <h3>{{ $feedbackContent['nameView'][$index] }}</h3>
                                <p>{{ $feedbackContent['descriptionView'][$index] }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="btn-load">load More</div>
                    <div class="btn-less">load Less</div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Testimoni --}}

    {{-- Client --}}
    <section class="section-client">
        <div class="client">
            <div class="container">
                <div class="text">
                    <h1>Sebaran klient kami di Provinsi Indonesia</h1>
                </div>
                @foreach ($mapContent['imageView'] as $image)
                    <img src="{{ asset('storage/' . $image) }}" alt="Indonesia">
                @endforeach
            </div>
        </div>
    </section>
    {{-- End Client --}}

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
