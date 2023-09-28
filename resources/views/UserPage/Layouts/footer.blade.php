<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Footer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-footer.css') }}">
</head>

<body>
    <footer>
        <div class="footer">
            <div class="footer-content">
                <img src="{{ asset('assets/img/white-logo.png') }}" alt="Logo">
                <div class="text-1">
                    <p><b>HEAD OFFICE</b></p>
                    <p>{{ $footerContent->address_head }}</p>
                    <p>{{ $footerContent->phone_head }}</p>
                    <p>{{ $footerContent->fax_head }}</p>
                </div>
                <div class="text-2">
                    <p><b>BRANCH OFFICE</b></p>
                    <p>{{ $footerContent->address_branch }}</p>
                    <p>{{ $footerContent->phone_branch }}</p>
                    <p>{{ $footerContent->fax_branch }}</p>
                </div>
                <div class="text-3">
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
            </div>

            <div class="footer-content">
                <h4><b>NCIMEDISMART</b></h4>
                <ul>
                    <li><a href="">Layanan</a></li>
                    <li><a href="">Fitur</a></li>
                </ul>
            </div>

            <div class="footer-content">
                <h4><b>Solusi</b></h4>
                <ul>
                    @foreach ($navbarContent as $navbarItem)
                        <li>
                            <a
                                href="/ProductView/{{ $navbarItem->products->id }}">{{ $navbarItem->products->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="footer-content">
                <h4><b>Perusahaan</b></h4>
                <ul>
                    <li><a href="">Informasi Perusahaan</a></li>
                    <li><a href="/Blog">Blog</a></li>
                    <li><a href="">Syarat & Ketentuan</a></li>
                </ul>
                <div class="image">
                    <a href="https://pse.kominfo.go.id/" target=”_blank”><img src="{{ asset('assets/img/pse.png') }}"
                            alt="PSE Logo"></a>
                </div>
                <div class="image">
                    <a href="https://e-katalog.lkpp.go.id/" target=”_blank”><img
                            src="{{ asset('assets/img/lkpp.png') }}" alt="LKPP Logo"></a>
                </div>
            </div>
        </div>
    </footer>

    <div class="copyright">
        <div class="col-1">
            <img src="{{ asset('assets/img/Logo NCI.png') }}" alt="Logo">
        </div>
        <div class="col-2">
            <p>
                Copyright © 2023 PT NUANSA CERAH INFORMASI
            </p>
        </div>
        <div class="col-3"></div>
    </div>
</body>
<script src="{{ asset('Js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('Js/Script.js') }}"></script>

</html>
