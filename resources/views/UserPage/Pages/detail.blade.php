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
                    <div class="image">
                        <img src="{{ asset('storage/' . $articles->image) }}" alt="">
                    </div>
                    <div class="content">
                        <div class="title">
                            <h1><b>{{ $articles->title }}</b></h1>
                        </div>

                        <div class="posting">
                            <div class="admin">
                                <p><b>{{ $articles->Users->username }}</b></p>
                            </div>
                            <div class="date">
                                <p>{{ $articles->created_at }}</p>
                            </div>
                        </div>

                        <div class="text">
                            <p>
                                {!! $articles->description !!}
                            </p>
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
