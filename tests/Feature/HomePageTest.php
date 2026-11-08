<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\ExperienceList;
use App\Models\LandingVideo;
use App\Models\ModulProduct;
use App\Models\Navbar;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * Home page robustness (empty data, variable item counts), query budget and the uploaded-image route.
 */
class HomePageTest extends TestCase
{
    use RefreshDatabase;

    private ?string $imagePath = null;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    protected function tearDown(): void
    {
        if ($this->imagePath && is_file($this->imagePath)) {
            unlink($this->imagePath);
        }
        parent::tearDown();
    }

    public function test_home_with_no_content_shows_fallback_hero_and_hides_empty_sections(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('<h1 class="text-3xl font-bold leading-tight sm:text-4xl lg:text-5xl lg:leading-tight">SIMRS NCI Medismart</h1>', false)
            ->assertDontSee('Produk Kami')
            ->assertDontSee('News &amp; Update', false)
            ->assertDontSee('swiper-slide')
            ->assertDontSee('<lite-youtube', false)
            // No products configured: the "Produk" dropdown is not rendered at all.
            ->assertDontSee('>Produk<', false);
    }

    public function test_three_experience_items_fill_one_centered_row_of_three(): void
    {
        foreach (['Integrasi', 'Profesional', 'Jaminan'] as $name) {
            ExperienceList::create(['image' => 'file-image/x.png', 'name' => $name, 'description' => 'Deskripsi']);
        }

        $html = $this->get('/')->assertOk()->getContent();

        $this->assertSame(3, substr_count($html, 'lg:w-[calc(33.333%-1rem)]'));
        $this->assertStringNotContainsString('lg:w-[calc(25%-1.125rem)]', $html);
    }

    public function test_product_card_lists_ten_modules_and_summarises_the_rest(): void
    {
        $product = Product::create(['title' => 'SIMRS', 'subTitle' => 'Sub', 'description' => 'Desc', 'image' => 'file-image/p.png']);
        foreach (range(1, 12) as $i) {
            ModulProduct::create(['productId' => $product->id, 'title' => "Modul {$i}", 'description' => 'd', 'icon' => 'file-image/i.png']);
        }

        $this->get('/')
            ->assertOk()
            ->assertSee('Produk Kami')
            ->assertSee('Modul 10')
            ->assertDontSee('Modul 11')
            ->assertSee('+2 modul lainnya')
            // A single product is centered at a readable width instead of half a grid.
            ->assertSee('w-full max-w-2xl', false);
    }

    public function test_video_uses_lite_youtube_facade_and_accepts_full_urls(): void
    {
        LandingVideo::create(['title' => 'Kenali kami', 'description' => 'Video profil', 'video' => 'https://www.youtube.com/watch?v=_Gb_KIhc_xI']);

        $this->get('/')
            ->assertOk()
            ->assertSee('<lite-youtube videoid="_Gb_KIhc_xI"', false)
            ->assertDontSee('youtube.com/embed', false);
    }

    public function test_home_query_count_stays_small_with_content(): void
    {
        $admin = User::create(['username' => 'admin', 'password' => bcrypt('x'), 'level' => 'Admin']);
        foreach (range(1, 3) as $i) {
            $product = Product::create(['title' => "P{$i}", 'subTitle' => 's', 'description' => 'd', 'image' => 'file-image/p.png']);
            Navbar::create(['productId' => $product->id, 'icon' => 'file-image/i.png']);
            Article::create(['adminId' => $admin->id, 'title' => "A{$i}", 'description' => 'x', 'image' => 'file-image/a.png', 'prioritize' => 2]);
        }

        DB::enableQueryLog();
        $this->get('/')->assertOk();
        $queries = count(DB::getQueryLog());

        // Shared layout data is loaded once per request and navbar products are eager-loaded.
        $this->assertLessThanOrEqual(20, $queries, "Home ran {$queries} queries");
    }

    public function test_uploaded_image_is_served_cacheable_and_without_cookies(): void
    {
        $dir = storage_path('app/file-image');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $this->imagePath = $dir . '/test-cache-image.png';
        file_put_contents($this->imagePath, base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII='));

        $response = $this->get('/storage/file-image/test-cache-image.png')->assertOk();

        $this->assertStringContainsString('max-age=31536000', $response->headers->get('Cache-Control'));
        $this->assertStringContainsString('immutable', $response->headers->get('Cache-Control'));
        $this->assertEmpty($response->headers->getCookies(), 'Image responses must not start a session or set cookies');
        $this->assertNotEmpty($response->headers->get('ETag'));

        $this->get('/storage/file-image/test-cache-image.png', ['If-None-Match' => $response->headers->get('ETag')])
            ->assertStatus(304);
    }

    public function test_uploaded_image_route_rejects_missing_files_and_path_traversal(): void
    {
        $this->get('/storage/file-image/does-not-exist.png')->assertNotFound();
        $this->get('/storage/file-image/..%2F..%2F.env')->assertNotFound();
        $this->get('/storage/file-image/../../.env')->assertNotFound();
    }
}
