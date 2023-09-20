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
                            <img src="{{ asset('storage/' . $articles->image) }}" alt="">
                        </div>
                        <div class="description">
                            <h3>{{ $articles->title }}</h3>
                            <p>{!! $articles->description !!}
                            </p>
                            <a href={{ url('/DetailBlog/'.$articles->id)}}>Pelajari Lanjut...</a>
                            <div class="update">
                                <div class="name">
                                    <p class="admin">{{ $articles->Users->level }}</p>
                                </div>
                                <div class="date">
                                    <p class="admin">{{$articles->created_at }}</p>
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
                                <p>{!! $ar2->description !!}
                                </p>
                            </div>
                            <div class="button">
                                <a href={{ url('/DetailBlog/'.$ar2->id)}}>Pelajari Lanjut</a>
                            </div>
                        </div>

                        {{-- <div class="card">
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
                        </div> --}}
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
    <section class="section-article">
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
                            <p>{!! $ar3->description !!}</p>
                            <a href={{ url('/DetailBlog/'.$ar3->id)}}>Pelajari Lanjut</a>
                        </div>
                    </div>
                    @endforeach
                    {{-- <div class="card">
                        <div class="image">
                            <img src="{{ asset('assets/img/blog3.png') }}" alt="">
                        </div>
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
                        <div class="image">
                            <img src="{{ asset('assets/img/blog3.png') }}" alt="">
                        </div>
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
                        <div class="image">
                            <img src="{{ asset('assets/img/blog3.png') }}" alt="">
                        </div>
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
                        <div class="image">
                            <img src="{{ asset('assets/img/blog3.png') }}" alt="">
                        </div>
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
                        <div class="image">
                            <img src="{{ asset('assets/img/blog3.png') }}" alt="">
                        </div>
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
                        <div class="image">
                            <img src="{{ asset('assets/img/blog3.png') }}" alt="">
                        </div>
                        <div class="description">
                            <h3>Mengenal Orthorexia Nervosa, Obsesi Terhadap Makanan Sehat</h3>
                            <p>Makanan sehat adalah hal yang penting untuk menjaga kesehatan tubuh. Karena itu
                                mengkonsumsi makanan sehat adalah keharusan untuk setiap orang. Namun keinginan kuat
                                yang berujung menjadi obsesi terhadap makanan sehat justru mengindikasikan suatu
                                kelainan....</p>
                            <a href="#">Pelajari Lanjut</a>
                        </div>
                    </div>
                </div> --}}

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

</html>
