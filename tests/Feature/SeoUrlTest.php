<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\ModulProduct;
use App\Models\Product;
use App\Models\User;
use App\Models\Whatsapp;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/** SEO-friendly URLs, legacy 301 redirects, sitemap.xml, robots.txt and head metadata. */
class SeoUrlTest extends TestCase
{
    use RefreshDatabase;

    private Product $product;

    private ModulProduct $modul;

    private Article $article;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();

        $this->product = Product::create(['title' => 'SIMRS NCI Medismart', 'subTitle' => 'Sistem RS', 'description' => 'Deskripsi', 'image' => 'file-image/p.png']);
        $this->modul = ModulProduct::create(['productId' => $this->product->id, 'title' => 'Rawat Jalan & IGD', 'description' => 'Modul', 'icon' => 'file-image/m.png']);
        $admin = User::create(['username' => 'admin', 'password' => bcrypt('x'), 'level' => 'Admin']);
        $this->article = Article::create(['adminId' => $admin->id, 'title' => 'Mengenal SATUSEHAT!', 'description' => '<p>Isi</p>', 'image' => 'file-image/a.png', 'prioritize' => 1]);
    }

    public function test_public_urls_are_lowercase_id_slug_paths(): void
    {
        $this->assertSame(url("/produk/{$this->product->id}-simrs-nci-medismart"), $this->product->publicUrl());
        $this->assertSame(url("/modul/{$this->modul->id}-rawat-jalan-igd"), $this->modul->publicUrl());
        $this->assertSame(url("/blog/{$this->article->id}-mengenal-satusehat"), $this->article->publicUrl());

        $this->get($this->product->publicUrl())->assertOk();
        $this->get($this->modul->publicUrl())->assertOk();
        $this->get($this->article->publicUrl())->assertOk();
    }

    public function test_outdated_or_missing_slug_redirects_permanently_to_the_canonical_url(): void
    {
        $this->get("/produk/{$this->product->id}")->assertStatus(301)->assertRedirect($this->product->publicUrl());
        $this->get("/produk/{$this->product->id}-judul-lama")->assertStatus(301)->assertRedirect($this->product->publicUrl());
        $this->get("/blog/{$this->article->id}-x")->assertStatus(301)->assertRedirect($this->article->publicUrl());
    }

    public function test_unknown_or_malformed_ids_return_404(): void
    {
        $this->get('/produk/999-tidak-ada')->assertNotFound();
        $this->get('/modul/999')->assertNotFound();
        $this->get('/blog/bukan-angka')->assertNotFound();
    }

    /**
     * @return array<string, array{0: string, 1: string}>
     */
    public static function legacyPages(): array
    {
        return [
            'about' => ['/HealthcareSolution', '/tentang-kami'],
            'testimoni' => ['/Testimoni', '/testimoni'],
            'blog' => ['/Blog', '/blog'],
            'demo' => ['/Demo', '/demo'],
            'sitemap' => ['/Sitemap', '/sitemap'],
            'sitemap xml' => ['/Sitemap.xml', '/sitemap.xml'],
        ];
    }

    /**
     * @dataProvider legacyPages
     */
    public function test_legacy_page_urls_redirect_permanently(string $old, string $new): void
    {
        $this->get($old)->assertStatus(301)->assertRedirect(url($new));
    }

    public function test_legacy_detail_urls_redirect_permanently_to_slug_urls(): void
    {
        $this->get("/ProductView/{$this->product->id}")->assertStatus(301)->assertRedirect($this->product->publicUrl());
        $this->get("/Modul/{$this->modul->id}")->assertStatus(301)->assertRedirect($this->modul->publicUrl());
        $this->get("/DetailBlog/{$this->article->id}")->assertStatus(301)->assertRedirect($this->article->publicUrl());
        $this->get('/ProductView/999')->assertNotFound();
    }

    public function test_legacy_demo_form_post_still_works(): void
    {
        $this->from('/demo')->post('/Demo', [
            'name' => 'Budi', 'position' => 'IT', 'instance_name' => 'RS', 'instance_address' => 'Bandung',
            'email' => 'budi@example.com', 'phone_number' => '08123456789',
        ])->assertRedirect('/demo');

        $this->assertDatabaseHas('demos', ['email' => 'budi@example.com']);
    }

    public function test_sitemap_xml_lists_canonical_urls_only(): void
    {
        Whatsapp::create(['phone_number' => '628111']);

        $response = $this->get('/sitemap.xml')->assertOk();
        $this->assertStringStartsWith('application/xml', $response->headers->get('Content-Type'));

        $xml = simplexml_load_string($response->getContent());
        $this->assertNotFalse($xml, 'sitemap.xml must be well-formed XML');
        $locs = collect();
        foreach ($xml->url as $url) {
            $locs->push((string) $url->loc);
        }

        $this->assertTrue($locs->contains($this->product->publicUrl()));
        $this->assertTrue($locs->contains($this->modul->publicUrl()));
        $this->assertTrue($locs->contains($this->article->publicUrl()));
        $this->assertTrue($locs->contains(route('about')));
        // Only this site's URLs: no WhatsApp links and no legacy paths.
        $this->assertTrue($locs->every(fn ($loc) => str_starts_with($loc, url('/'))));
        $this->assertFalse($locs->contains(fn ($loc) => str_contains($loc, 'ProductView') || str_contains($loc, 'DetailBlog')));
    }

    public function test_robots_txt_points_to_the_sitemap_and_hides_admin(): void
    {
        $robots = file_get_contents(public_path('robots.txt'));

        $this->assertStringContainsString('Sitemap: https://simrsncimedismart.com/sitemap.xml', $robots);
        $this->assertStringContainsString('Disallow: /Admin', $robots);
    }

    public function test_pages_have_canonical_open_graph_and_structured_data(): void
    {
        $html = $this->get($this->article->publicUrl())->assertOk()->getContent();

        $this->assertStringContainsString('<link rel="canonical" href="' . $this->article->publicUrl() . '">', $html);
        $this->assertStringContainsString('<meta property="og:type" content="article">', $html);
        $this->assertStringContainsString('<meta property="og:title" content="Mengenal SATUSEHAT! | Blog NCI Medismart">', $html);
        $this->assertStringContainsString('"@type":"BlogPosting"', $html);
        $this->assertStringContainsString('"@type":"BreadcrumbList"', $html);

        $home = $this->get('/')->assertOk()->getContent();
        // Client-provided meta is kept.
        $this->assertStringContainsString('google-site-verification', $home);
        $this->assertStringContainsString('"@type":"Organization"', $home);
        // Titles are escaped exactly once.
        $this->assertStringNotContainsString('&amp;amp;', $home);
    }
}
