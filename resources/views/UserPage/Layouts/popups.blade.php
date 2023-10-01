<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pop up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-popup.css') }}">

</head>
<body>
    {{-- Pop Up --}}
    <div class="home-popup">
        <div class="home-popup__background">
            <div class="home-popup__content">
                <div class="popup-container">
                    <img class="banner-image" src="{{ asset('assets/img/background.png') }}" alt="Banner">
                    <button class="close-button">X</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Pop Up --}}
</body>

{{-- pop up --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const homePopup = document.querySelector(".home-popup");
        
        const closeButton = document.querySelector(".close-button");

        // Tampilkan popup saat halaman dimuat
        homePopup.style.display = "flex";

        // Sembunyikan popup saat tombol "Tutup" diklik
        closeButton.addEventListener("click", function () {
            homePopup.style.display = "none";
        });
    });


</script>

</html>