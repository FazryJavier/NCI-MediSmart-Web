<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Header</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo NCI-01.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-header.css') }}">
</head>

<body>
    {{-- Header --}}
    <header>
        <div class="top-bar">
            <div class="container">
                <div class="top-bar-content">
                    <div class="left-content">
                        <div class="instagram">
                            <a href="https://www.instagram.com/ncimedismart/" target=”_blank”><i
                                    class="fa-brands fa-instagram"></i></a>
                        </div>
                        <div class="youtube">
                            <a href="https://www.youtube.com/@simrsncimedismart2282/featured" target=”_blank”><i
                                    class="fa-brands fa-youtube"></i></a>
                        </div>
                        <div class="linkedin">
                            <a href="https://www.linkedin.com/company/pt-nuansa-cerah-informasi/" target=”_blank”><i
                                    class="fa-brands fa-linkedin-in"></i></a>
                        </div>
                    </div>

                    <div class="right-content">
                        <div class="phone">
                            <i class="fa-solid fa-phone"></i><span>022 8735 6050</span>
                        </div>
                        <div class="location">
                            <button>Kantor Bandung</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-bar">
            <div class="container">
                <div class="bottom-bar-content">
                    <a href="/" class="logo"><img src="{{ asset('assets/img/Logo Medismart.png') }}"
                            alt="Medismart" class="logo" /></a>

                    <input type="checkbox" id="menu-bar">
                    <label for="menu-bar"><i class="fa-solid fa-bars" style="color: #015028;"></i></label>

                    <nav class="navbar">
                        <ul class="nav-list">
                            <li class="nav-item"><a href="#" class="nav-link">Produk <span>&#x25BE;</span></a>
                                <ul class="nav-list-2">
                                    @foreach ($navbarContent as $navbarItem)
                                        <li class="nav-item-2">
                                            <a href="/ProductView/{{ $navbarItem->products->id }}" class="nav-link">
                                                <img src="{{ asset('storage/' . $navbarItem->icon) }}" alt="">
                                                <div class="text">
                                                    <h5>{{ $navbarItem->products->title }}</h5>
                                                    <p>{{ $navbarItem->products->subTitle }}</p>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="nav-item"><a href="#" class="nav-link">Tentang Kami
                                    <span>&#x25BE;</span></a>
                                <ul class="nav-list-2">
                                    <li class="nav-item-2">
                                        <a href="/HealthcareSolution" class="nav-link">
                                            <img src="{{ asset('assets/img/healthcare.png') }}" alt="">
                                            <h5>Healthcare Solution</h5>
                                            <p></p>
                                        </a>
                                    </li>
                                    <li class="nav-item-2">
                                        <a href="http://nuansa.com/2019/" class="nav-link" target="_blank">
                                            <img src="{{ asset('assets/img/pt-nci.png') }}" alt="">
                                            <h5>PT Nuansa Cerah Informasi</h5>
                                            <p></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item"><a href="/Testimoni" class="nav-link">Testimoni</a></li>
                            <li class="nav-item"><a href="/Blog" class="nav-link">Blog</a></li>
                            <li class="nav-item"><a href="/Demo" class="nav-link">Demo</a></li>
                            <li class="nav-item">
                                @foreach ($whatsappContent['whatsappView'] as $phone_number)
                                    <a href="https://api.whatsapp.com/send?phone={{ $phone_number }}"
                                        class="btn-contact">Hubungi Kami</a>
                                @endforeach
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    {{-- End Header --}}
</body>

<script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('js/Script.js') }}"></script>

<script>
    const topBar = document.querySelector('.top-bar');
    const bottomBar = document.querySelector('.bottom-bar');

    let isTopBarHidden = false;

    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;

        if (scrollY > 0 && !isTopBarHidden) {
            // Jika sudah di-scroll, sembunyikan top-bar dan naikkan bottom-bar


            bottomBar.style.transition = 'transform 0.3s ease-out';
            bottomBar.style.transform = 'translateY(-55%)';

            isTopBarHidden = true;
        } else if (scrollY === 0 && isTopBarHidden) {
            // Jika kembali ke atas, tampilkan kembali top-bar dan kembalikan bottom-bar ke posisi awal
            topBar.style.transition = 'transform 0.3s ease-in';
            topBar.style.transform = 'translateY(0)';

            bottomBar.style.transition = 'transform 0.3s ease-in';
            bottomBar.style.transform = 'translateY(0)';

            isTopBarHidden = false;
        }
    });
</script>

</html>
