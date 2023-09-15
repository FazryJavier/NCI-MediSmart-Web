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
                        <iframe width="560" height="315"
                            src="https://www.youtube.com/embed/{{ $aboutContent['videoView'] }}"
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
                    <img src="{{ $aboutContent['imageView'] }}" alt="Logo">
                    <p>{{ $aboutContent['descriptionView'] }}</p>
                </div>
                <div class="text">
                    <div class="columns">
                        <div class="card">
                            <h1>Visi</h1>
                            <p>{{ $aboutContent['visiView'] }}</p>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="card">
                            <h1>Misi</h1>
                            <p>{{ $aboutContent['misiView'] }}</p>
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
