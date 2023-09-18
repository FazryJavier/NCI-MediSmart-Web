<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Demo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-demo.css') }}">
    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    {{-- Header --}}
    <header>
        <nav class="navbar">
            <a href="/" class="btn-back"><i class="fa-solid fa-arrow-left" style="color: #707070;"></i>
                Kembali</a>
            <a href="/"><img src="{{ asset('assets/img/Logo Medismart.png') }}" alt="MediSmart"></a>
            </div>
        </nav>
    </header>
    {{-- End Header --}}

    {{-- Demo --}}
    <section class="section-demo">
        <div class="demo">
            <div class="container">
                <div class="title">
                    <div class="image">
                        <a href="/" class="logo"><img src="{{ asset('assets/img/Logo Medismart.png') }}"
                                alt="MediSmart">
                        </a>
                    </div>
                    <div class="text">
                        <p>Jadwalkan demo dengan tim kami.</p>
                    </div>
                </div>

                <form action="/DemoList" class="form-demo" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="input-form mb-4">
                        <label for="name" class="form-label"><span>*</span> Nama</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="input-form mb-4">
                        <label for="position" class="form-label"><span>*</span> Jabatan</label>
                        <input type="text" name="position" class="form-control" id="position">
                    </div>
                    <div class="input-form mb-4">
                        <label for="instance_name" class="form-label"><span>*</span> Nama Instansi / Faskes</label>
                        <input type="text" name="instance_name" class="form-control" id="instance_name">
                    </div>
                    <div class="input-form mb-4">
                        <label for="instance_address" class="form-label"><span>*</span> Alamat Instansi / Faskes</label>
                        <textarea name="instance_address" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="input-form mb-4">
                        <label for="email" class="form-label"><span>*</span> Email</label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="input-form mb-4">
                        <label for="phone_number" class="form-label"><span>*</span> No Telpon</label>
                        <input type="text" name="phone_number" class="form-control" id="phone_number">
                    </div>
                    <div class="input-form mb-4 btn-submit">
                        <button type="submit" class="btn btn-success">Jadwal Demo</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    {{-- End Demo --}}

    {{-- Footer --}}
    <footer>
        <div class="copyright">
            <p><b>Copyright © 2023 PT NUANSA CERAH INFORMASI</b></p>
        </div>
        </div>
    </footer>
    {{-- End Footer --}}
</body>

<!-- Swiper JS -->
<script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

<script src="{{ asset('js/Script.js') }}"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="./script.js"></script>

{{-- Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

</html>
