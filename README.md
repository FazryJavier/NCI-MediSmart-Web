<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Frontend landing page

Landing page publik (`resources/views/UserPage`) dibangun dengan **Tailwind CSS 3**, **Alpine.js 3**, dan **Swiper 10** lewat **Vite**. Panel admin tidak ikut menggunakannya.

- Layout utama: `resources/views/UserPage/Layouts/app.blade.php`. Setiap halaman memakai `@extends` dan `@section('content')`.
- Style: `resources/css/app.css` (`@tailwind` beserta komponen kecil `.page-container`, `.reveal`, dan override Swiper), lalu `tailwind.config.js` (warna `brand`, `ink`, `muted`, `mist`, plus breakpoint `nav` = 1151px).
- Script: `resources/js/app.js` (Alpine `loadMore`, helper `initSwiper`, reveal on scroll, dan `lite-youtube-embed`).
- Ikon: `<x-icon name="phone" />` (SVG inline dari Font Awesome Free, tanpa font ikon). Untuk menambah ikon, daftarkan di `scripts/generate-icons.cjs`, lalu jalankan `npm run icons`.
- Video YouTube: `@include('UserPage.Layouts.youtube', ['video' => $id, 'title' => '...'])`. Awalnya hanya thumbnail yang dimuat; player baru dimuat saat diklik.
- Beranda (`HomeController`): setiap section hanya tampil jika datanya ada, dan grid menyesuaikan jumlah item (1, 2, 3, atau 4+).

```bash
npm install
npm run dev     # pengembangan (HMR); hapus public/hot jika dev server mati tidak normal
npm run build   # hasil di public/build, WAJIB di-commit
```

### URL publik & SEO

| Halaman | URL | URL lama (redirect 301) |
|---|---|---|
| Produk | `/produk/{id}-{slug}` | `/ProductView/{id}` |
| Modul | `/modul/{id}-{slug}` | `/Modul/{id}` |
| Blog / artikel | `/blog`, `/blog/{id}-{slug}` | `/Blog`, `/DetailBlog/{id}` |
| Tentang kami | `/tentang-kami` | `/HealthcareSolution` |
| Testimoni, Demo, Sitemap | `/testimoni`, `/demo`, `/sitemap`, `/sitemap.xml` | `/Testimoni`, `/Demo`, `/Sitemap`, `/Sitemap.xml` |

- Slug dibentuk dari judul (`HasPublicUrl`), jadi **tidak perlu kolom/migrasi baru**. Kalau judul berubah, URL dengan slug lama otomatis di-redirect 301 ke slug yang baru.
- Pakai `$model->publicUrl()` atau `route('...')`, jangan tulis path manual.
- `public/robots.txt` menunjuk ke `/sitemap.xml`. Setiap halaman punya canonical, Open Graph/Twitter, dan JSON-LD (Organization di beranda, BreadcrumbList, serta BlogPosting di artikel).

### Data dummy (lokal)

```bash
php artisan db:seed --class=DemoContentSeeder
```

Perintah ini mengisi semua konten landing page (slider, client, pengalaman, peta, produk + modul, video, artikel, testimoni, about, CTA, footer, WhatsApp, popup nonaktif). Gambarnya disalin ke `storage/app/file-image/demo-*`.

- Hanya mengisi tabel yang **masih kosong**; data yang sudah ada tidak diubah. Aman dijalankan berulang kali.
- **Menolak berjalan di production.**
- Kalau tabel `users` kosong, dibuat user `demo-admin` dengan password acak sebagai penulis artikel.

### Deploy

Production (Hostinger) meng-update kode lewat webhook GitHub (`git pull` dari `main`) dan **tidak menjalankan npm**. Karena itu `public/build` **ikut di-commit**:

1. Setiap kali mengubah `resources/css`, `resources/js`, `tailwind.config.js`, atau view Blade yang memakai class Tailwind baru, jalankan `npm run build`.
2. Commit perubahan `public/build` bersama perubahan source-nya.
3. CI (`.github/workflows/ci.yml`) build ulang dan **gagal** jika `public/build` tidak sama dengan hasil build dari source.

Jangan commit `public/hot`. File ini dibuat oleh `npm run dev`; kalau ada di server, halaman akan mencoba memuat aset dari dev server.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
