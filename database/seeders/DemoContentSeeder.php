<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\AdvantageListProduct;
use App\Models\AdvantageModulProduct;
use App\Models\AdvantageProduct;
use App\Models\AllClient;
use App\Models\Article;
use App\Models\ClientProduct;
use App\Models\CTA;
use App\Models\DetailProduct;
use App\Models\Experience;
use App\Models\ExperienceList;
use App\Models\FacilitiesModulProduct;
use App\Models\Feedback;
use App\Models\Footer;
use App\Models\ImageModulProduct;
use App\Models\LandingSlider;
use App\Models\LandingVideo;
use App\Models\Map;
use App\Models\MapFeedback;
use App\Models\ModulProduct;
use App\Models\Navbar;
use App\Models\Popup;
use App\Models\Product;
use App\Models\Sparasi;
use App\Models\User;
use App\Models\Whatsapp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

/**
 * Demo content for previewing the public landing pages locally.
 *
 *   php artisan db:seed --class=DemoContentSeeder
 *
 * - Refuses to run in production.
 * - Additive and safe to re-run: a table is only seeded while it is EMPTY, existing rows are never
 *   changed or deleted. Product-related tables are only seeded together with fresh demo products.
 * - Images are copied into storage/app/file-image (served by the /storage/file-image route) from
 *   public/assets/img and database/seeders/demo-images.
 */
class DemoContentSeeder extends Seeder
{
    /** @var array<string, string> source file => stored path ("file-image/demo-...") */
    private array $copied = [];

    private const VIDEO_ID = '_Gb_KIhc_xI';

    public function run(): void
    {
        if (app()->environment('production')) {
            throw new RuntimeException('DemoContentSeeder must not run in production.');
        }

        $this->landing();
        $this->products();
        $this->articles();
        $this->testimonials();
        $this->about();
        $this->siteWide();
    }

    private function landing(): void
    {
        $this->seedIfEmpty(LandingSlider::class, fn () => [
            ['title' => 'SIMRS Terintegrasi <b>SATUSEHAT</b>', 'caption' => 'Bridging BPJS, rekam medis elektronik, dan laporan real-time untuk rumah sakit dan klinik.', 'image' => $this->image('background.png'), 'link' => '/HealthcareSolution', 'status' => 1],
            ['title' => 'Klaim BPJS Lebih Cepat dan Akurat', 'caption' => 'Cetak SEP, verifikasi, dan pengajuan klaim langsung dari satu aplikasi.', 'image' => $this->image('bpjs-claim2.png'), 'link' => '/Blog', 'status' => 1],
            ['title' => 'Rekam Medis Elektronik untuk Klinik', 'caption' => 'Sesuai Permenkes 24/2022, siap diintegrasikan dengan SATUSEHAT.', 'image' => $this->image('produk-2.png'), 'link' => '/Demo', 'status' => 0],
        ]);

        $this->seedIfEmpty(AllClient::class, fn () => [
            ['title' => 'Client Medismart', 'image' => $this->image('Client.png')],
        ]);

        $this->seedIfEmpty(Experience::class, fn () => [
            ['title' => '<b>Pengalaman</b> lebih dari <b>30 Tahun</b> di Dunia <b>Teknologi Informasi.</b> Lebih dari <b>100 Fasilitas Kesehatan</b> di Wilayah <b>Indonesia</b> telah Bekerja Sama dengan Kami', 'description' => 'Kami menciptakan pola kemitraan dalam pengembangan sistem informasi untuk menggantikan pola konvensional penjual - pembeli.'],
        ]);

        // Three items on purpose: the layout must not leave an empty fourth column.
        $this->seedIfEmpty(ExperienceList::class, fn () => [
            ['image' => $this->image('icon1.png'), 'name' => 'Integrasi SatuSehat', 'description' => 'Seluruh produk siap diintegrasikan dengan aplikasi nasional SATUSEHAT untuk mendukung kinerja Fasyankes Anda.'],
            ['image' => $this->image('icon2.png'), 'name' => 'Profesional', 'description' => 'Tim terdiri dari SDM yang handal dan berpengalaman untuk menjamin standar kualitas layanan.'],
            ['image' => $this->image('icon3.png'), 'name' => 'Jaminan Keberhasilan', 'description' => 'Dukungan tidak terbatas pada penyediaan solusi tetapi juga keberhasilan implementasinya.'],
        ]);

        $this->seedIfEmpty(Map::class, fn () => [
            ['title' => '100+ Jumlah client di Indonesia', 'image' => $this->image('peta-indonesia.png', demo: true)],
        ]);

        $this->seedIfEmpty(LandingVideo::class, fn () => [
            ['title' => 'Bersama Membangun Layanan Kesehatan', 'description' => 'Kenali bagaimana NCI Medismart membantu fasilitas kesehatan bertransformasi digital, dari pendaftaran hingga klaim BPJS.', 'video' => self::VIDEO_ID],
        ]);
    }

    private function products(): void
    {
        if (Product::query()->exists()) {
            $this->command?->line('  products: already has data, skipped (with all product-related tables)');

            return;
        }

        $catalog = [
            ['SIMRS NCI Medismart', 'Sistem Informasi Manajemen Rumah Sakit', 'produk-1.png', 'simrs.png', 7],
            ['RME Klinik', 'Rekam Medis Elektronik untuk Klinik', 'produk-2.png', 'rme.png', 4],
            ['Bridging BPJS', 'Integrasi V-Claim, Antrean & SATUSEHAT', 'bpjs-claim1.png', 'healthcare.png', 2],
        ];
        $modules = ['Pendaftaran Pasien', 'Rawat Jalan', 'Rawat Inap', 'Farmasi & Apotek', 'Laboratorium', 'Radiologi', 'Kasir & Billing'];

        foreach ($catalog as [$title, $subTitle, $image, $icon, $moduleCount]) {
            $product = Product::create(['title' => $title, 'subTitle' => $subTitle, 'image' => $this->image($image),
                'description' => "{$title} membantu fasilitas kesehatan mengelola pelayanan, administrasi, dan pelaporan dalam satu sistem yang terintegrasi."]);

            Navbar::create(['productId' => $product->id, 'icon' => $this->image($icon)]);
            DetailProduct::create(['productId' => $product->id, 'logo' => $this->image('medismart.png'),
                'description' => "{$title} dirancang untuk mempercepat pelayanan dan meningkatkan akurasi data pasien.",
                'flyer' => '#', 'video' => self::VIDEO_ID,
                'moduldesc' => '<p>Modul-modul berikut dapat diaktifkan sesuai kebutuhan fasilitas kesehatan Anda.</p>']);
            ClientProduct::create(['productId' => $product->id, 'image' => $this->image('client2.png')]);
            Sparasi::create(['productId' => $product->id, 'image' => $this->image('rumah-sakit.png')]);

            foreach (['Terintegrasi' => 'vector1.png', 'Aman' => 'vector2.png', 'Mudah Digunakan' => 'vector3.png'] as $advTitle => $advIcon) {
                $advantage = AdvantageProduct::create(['productId' => $product->id, 'title' => $advTitle, 'icon' => $this->image($advIcon)]);
                foreach (['Akses berbasis peran pengguna', 'Laporan real-time', 'Dukungan teknis 24/7'] as $point) {
                    AdvantageListProduct::create(['advantageId' => $advantage->id, 'name' => $point]);
                }
            }

            foreach (array_slice($modules, 0, $moduleCount) as $moduleTitle) {
                $modul = ModulProduct::create(['productId' => $product->id, 'title' => $moduleTitle, 'icon' => $this->image('modul1.png'),
                    'description' => "Modul {$moduleTitle} mencatat dan memproses data pelayanan secara cepat dan terstruktur."]);

                foreach (['Cepat' => 'icon1.png', 'Akurat' => 'icon2.png', 'Terintegrasi' => 'icon4.png'] as $advTitle => $advIcon) {
                    AdvantageModulProduct::create(['modulId' => $modul->id, 'title' => $advTitle, 'icon' => $this->image($advIcon),
                        'description' => "Proses {$moduleTitle} lebih {$advTitle}."]);
                }
                foreach ([1, 2] as $list) {
                    foreach (['Input data terstruktur', 'Cetak dokumen otomatis', 'Riwayat lengkap pasien'] as $facility) {
                        FacilitiesModulProduct::create(['modulId' => $modul->id, 'list' => $list, 'description' => $facility]);
                    }
                }
                foreach ([1 => 'bpjs-claim1.png', 2 => 'blog1.png', 3 => 'blog2.png'] as $list => $listImage) {
                    ImageModulProduct::create(['modulId' => $modul->id, 'list' => $list, 'image' => $this->image($listImage)]);
                }
            }
        }

        $this->command?->line('  products: seeded 3 products with modules, advantages and details');
    }

    private function articles(): void
    {
        $this->seedIfEmpty(Article::class, function () {
            $adminId = User::query()->value('id') ?? User::create([
                'username' => 'demo-admin',
                // Random, never shown: the demo author is not meant to log in.
                'password' => Hash::make(Str::random(40)),
                'level' => 'Admin',
            ])->id;

            $body = '<p>Transformasi digital rumah sakit dimulai dari data yang rapi dan terintegrasi. Dengan SIMRS yang tepat, pelayanan menjadi lebih cepat dan pelaporan lebih akurat.</p>'
                . '<p>Artikel ini membahas langkah-langkah praktis menuju integrasi SATUSEHAT dan bridging BPJS.</p>';

            return collect(['blog.png', 'blog1.png', 'blog2.png', 'blog3.png', 'bpjs-claim1.png', 'produk-1.png'])
                ->values()
                ->map(fn ($image, $i) => [
                    'adminId' => $adminId,
                    'title' => ['Mengenal SATUSEHAT untuk Rumah Sakit', 'Tips Implementasi SIMRS', 'Bridging BPJS V-Claim', 'Rekam Medis Elektronik Wajib 2024', 'Mempercepat Klaim BPJS', 'Studi Kasus Klinik Pratama'][$i],
                    'description' => $body,
                    'image' => $this->image($image),
                    'prioritize' => $i === 0 ? 1 : ($i <= 3 ? 2 : 3),
                ])
                ->all();
        });
    }

    private function testimonials(): void
    {
        $this->seedIfEmpty(Feedback::class, fn () => collect(range(1, 5))->map(fn ($i) => [
            'image' => $this->image('logo NCI-01.png'),
            'name' => "RSU Sehat Sentosa {$i}",
            'description' => 'Proses pendaftaran dan klaim BPJS kami jauh lebih cepat sejak menggunakan NCI Medismart.',
        ])->all());

        $this->seedIfEmpty(MapFeedback::class, fn () => [
            ['title' => 'Tersebar di Seluruh Indonesia', 'image' => $this->image('peta-indonesia.png', demo: true)],
        ]);
    }

    private function about(): void
    {
        $this->seedIfEmpty(About::class, fn () => [[
            'video' => self::VIDEO_ID,
            'image' => $this->image('logo NCI-01.png'),
            'description' => 'NCI Medismart adalah solusi sistem informasi kesehatan dari PT Nuansa Cerah Informasi.',
            'visi' => 'Menjadi mitra teknologi informasi kesehatan terpercaya di Indonesia.',
            'misi' => "Menyediakan solusi yang terintegrasi\nMendampingi implementasi hingga berhasil\nTerus berinovasi mengikuti regulasi",
        ]]);
    }

    private function siteWide(): void
    {
        $this->seedIfEmpty(Whatsapp::class, fn () => [['phone_number' => '6281234567890']]);

        // Banner with a transparent top: the person's head overflows the green card on purpose.
        $this->seedIfEmpty(CTA::class, fn () => [[
            'image' => $this->image('cta-banner.webp', demo: true),
            'title' => 'Punya Pertanyaan? Kami Siap Membantu',
            'description' => 'NCI - MediSmart didesain dan dikembangkan dengan berbagai fasilitas untuk memberikan kemudahan, kecepatan dan keakuratan proses manajemen rumah sakit.',
        ]]);

        $this->seedIfEmpty(Footer::class, fn () => [[
            'address_head' => 'Jl. Contoh Raya No. 10, Bandung, Jawa Barat 40123',
            'phone_head' => 'Telp. (022) 8735 6050',
            'fax_head' => 'Fax. (022) 8735 6051',
            'address_branch' => 'Jl. Contoh Cabang No. 5, Jakarta Selatan 12345',
            'phone_branch' => 'Telp. (021) 1234 5678',
            'fax_branch' => null,
        ]]);

        // Inactive so it does not cover the page while previewing; enable it in the admin to test.
        $this->seedIfEmpty(Popup::class, fn () => [[
            'image' => $this->image('bpjs-claim1.png'),
            'status' => 0,
            'start_date' => now()->subDay(),
            'end_date' => now()->addMonth(),
            'link' => '/Demo',
        ]]);
    }

    /**
     * @param  class-string<Model>  $model
     * @param  callable(): array<int, array<string, mixed>>  $rows
     */
    private function seedIfEmpty(string $model, callable $rows): void
    {
        $table = (new $model())->getTable();

        if ($model::query()->exists()) {
            $this->command?->line("  {$table}: already has data, skipped");

            return;
        }

        $records = $rows();
        foreach ($records as $attributes) {
            $model::create($attributes);
        }

        $this->command?->line("  {$table}: seeded " . count($records));
    }

    /**
     * Copy a demo image into storage/app/file-image once and return its stored path.
     */
    private function image(string $file, bool $demo = false): string
    {
        if (isset($this->copied[$file])) {
            return $this->copied[$file];
        }

        $source = $demo ? database_path("seeders/demo-images/{$file}") : public_path("assets/img/{$file}");
        if (! is_file($source)) {
            throw new RuntimeException("Demo image not found: {$source}");
        }

        $stored = 'file-image/demo-' . Str::slug(pathinfo($file, PATHINFO_FILENAME)) . '.' . pathinfo($file, PATHINFO_EXTENSION);
        if (! Storage::disk('local')->exists($stored)) {
            Storage::disk('local')->put($stored, file_get_contents($source));
        }

        return $this->copied[$file] = $stored;
    }
}
