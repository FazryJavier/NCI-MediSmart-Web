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
    <section class="section-question">
        <div class="question">
            <div class="container">
                @foreach ($ctaContent['imageView'] as $index => $image)
                    <div class="border" style="background-image: url('{{ $ctaContent['imageView'][$index] }}')">
                        <div class="text">
                            <h1>{{ $ctaContent['titleView'][$index] }}</h1>
                            <p>{{ $ctaContent['descriptionView'][$index] }}</p>
                            <a href="" class="btn-konsul">Konsultasi</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- End Question --}}
</body>

<script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

</html>
