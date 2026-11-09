<?php

namespace Tests\Feature;

use App\Models\About;
use App\Models\Article;
use App\Models\DetailProduct;
use App\Models\Feedback;
use App\Models\ModulProduct;
use App\Models\Navbar;
use App\Models\Popup;
use App\Models\Product;
use App\Models\User;
use App\Models\Whatsapp;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Vite;
use Tests\TestCase;

/**
 * Smoke tests for the public landing pages after the move to Tailwind + Vite + Alpine.
 */
class LandingPageTest extends TestCase
{
    use RefreshDatabase;

    private Product $product;

    private ModulProduct $modul;

    private Article $article;

    protected function setUp(): void
    {
        parent::setUp();

        // Do not require a built manifest in tests.
        $this->withoutVite();

        $admin = User::create(['username' => 'admin-test', 'password' => bcrypt('secret'), 'level' => 'Admin']);

        $this->product = Product::create([
            'title' => 'SIMRS Test',
            'subTitle' => 'Sub title',
            'description' => 'Deskripsi produk',
            'image' => 'file-image/product.png',
        ]);

        Navbar::create(['productId' => $this->product->id, 'icon' => 'file-image/icon.png']);
        Whatsapp::create(['phone_number' => '628123456789']);

        $this->modul = ModulProduct::create([
            'productId' => $this->product->id,
            'title' => 'Modul Rawat Jalan',
            'description' => 'Deskripsi modul',
            'icon' => 'file-image/modul.png',
        ]);

        Feedback::create(['image' => 'file-image/fb.png', 'name' => 'RS Sehat', 'description' => 'Mantap']);

        // Both pages intentionally 404 without their content record.
        DetailProduct::create([
            'productId' => $this->product->id,
            'logo' => 'file-image/logo.png',
            'description' => 'Detail produk',
            'flyer' => 'https://example.com/flyer.pdf',
            'video' => 'abc123',
            'moduldesc' => '<p>Deskripsi modul</p>',
        ]);

        About::create([
            'video' => 'abc123',
            'image' => 'file-image/about.png',
            'description' => 'Tentang kami',
            'visi' => 'Visi kami',
            'misi' => "Misi satu\nMisi dua",
        ]);

        $this->article = Article::create([
            'adminId' => $admin->id,
            'title' => 'Artikel Utama',
            'description' => '<p>Isi artikel</p>',
            'image' => 'file-image/article.png',
            'prioritize' => 1,
        ]);
    }

    /**
     * @return array<string, array{0: string}>
     */
    public static function landingRoutes(): array
    {
        return [
            'home' => ['/'],
            'tentang-kami' => ['/tentang-kami'],
            'testimoni' => ['/testimoni'],
            'blog' => ['/blog'],
            'demo' => ['/demo'],
            'sitemap' => ['/sitemap'],
        ];
    }

    /**
     * @dataProvider landingRoutes
     */
    public function test_static_landing_pages_render_with_single_document_and_no_legacy_assets(string $uri): void
    {
        $response = $this->get($uri)->assertOk();

        $html = $response->getContent();

        // One layout = exactly one <html>/<body>, instead of one per included partial.
        $this->assertSame(1, substr_count($html, '<html'));
        $this->assertSame(1, substr_count($html, '<body'));
        $this->assertStringNotContainsString('css/style-', $html);
        $this->assertStringNotContainsString('swiper-bundle', $html);
        $this->assertStringNotContainsString('Script.js', $html);
        $this->assertStringNotContainsString('”_blank”', $html);
    }

    public function test_product_page_renders_product_and_modul(): void
    {
        $this->get($this->product->publicUrl())
            ->assertOk()
            ->assertSee('<title>SIMRS Test – Sub title | NCI Medismart</title>', false)
            ->assertSee('Modul Rawat Jalan')
            ->assertSee('RS Sehat');
    }

    public function test_modul_page_shows_testimonial_names(): void
    {
        $this->get($this->modul->publicUrl())
            ->assertOk()
            ->assertSee('Modul Rawat Jalan')
            ->assertSee('RS Sehat');
    }

    public function test_blog_detail_page_renders_article(): void
    {
        $this->get($this->article->publicUrl())
            ->assertOk()
            ->assertSee('Artikel Utama')
            ->assertSee('<p>Isi artikel</p>', false);
    }

    public function test_header_links_are_safe_external_links(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('rel="noopener noreferrer"', false)
            ->assertSee('https://api.whatsapp.com/send?phone=628123456789', false)
            ->assertSee($this->product->publicUrl(), false);
    }

    public function test_header_has_desktop_and_mobile_navigation_and_footer_lists_products(): void
    {
        $html = $this->get('/')->assertOk()->getContent();

        // Desktop and mobile menus are separate landmarks; the mobile one starts hidden (x-cloak).
        $this->assertSame(2, substr_count($html, 'aria-label="Navigasi utama"'));
        $this->assertStringContainsString('id="mobile-nav" x-show="open" x-cloak', $html);
        // The product is linked from the desktop menu, mobile menu, home product card and footer.
        $this->assertSame(4, substr_count($html, 'href="' . $this->product->publicUrl() . '"'));
        $this->assertStringContainsString('Copyright &copy; ' . now()->year, $html);
    }

    public function test_current_page_is_marked_active_in_navigation(): void
    {
        $blog = $this->get('/blog')->assertOk()->getContent();
        // Desktop + mobile menu entries for Blog are both marked as the current page.
        $this->assertSame(2, substr_count($blog, 'aria-current="page"'));

        $this->get('/')->assertOk()->assertDontSee('aria-current="page"', false);
    }

    public function test_blog_page_follows_the_design_structure(): void
    {
        foreach (range(1, 3) as $i) {
            Article::create(['adminId' => $this->article->adminId, 'title' => "Sorotan {$i}", 'description' => "<p>Isi&nbsp;{$i}</p>",
                'image' => 'file-image/a.png', 'prioritize' => 2]);
        }

        $html = $this->get('/blog')->assertOk()->getContent();

        $this->assertStringContainsString('NCIMedismart</a>/Blog', $html);
        // Featured author line uses the dd/mm/yyyy date from the design.
        $this->assertStringContainsString('>' . $this->article->created_at->format('d/m/Y') . '</time>', $html);
        // Three highlight columns with vertical dividers.
        $this->assertStringContainsString('md:grid-cols-3 md:divide-x', $html);
        $this->assertSame(3, substr_count($html, 'md:px-5 md:first:pl-0 md:last:pr-0'));
        // Rich-text entities are decoded in excerpts.
        $this->assertStringNotContainsString('&amp;nbsp;', $html);
    }

    public function test_blog_detail_follows_the_design_structure(): void
    {
        Article::create(['adminId' => $this->article->adminId, 'title' => 'Rekomendasi Satu', 'description' => '<p>Isi</p>',
            'image' => 'file-image/a.png', 'prioritize' => 2]);

        $html = $this->get($this->article->publicUrl())->assertOk()->getContent();

        // No visible breadcrumb trail, but the BreadcrumbList structured data is kept.
        $this->assertStringNotContainsString('aria-label="Breadcrumb"', $html);
        $this->assertStringContainsString('"@type":"BreadcrumbList"', $html);
        $this->assertStringContainsString('>' . $this->article->created_at->format('d/m/Y') . '</time>', $html);
        $this->assertStringContainsString('Rekomendasi</h2>', $html);
        $this->assertStringContainsString('Rekomendasi Satu', $html);
    }

    public function test_testimonial_page_follows_the_design_structure(): void
    {
        $html = $this->get('/testimoni')->assertOk()->getContent();

        $this->assertStringContainsString('Apa kata klien tentang kami</h1>', $html);
        $this->assertStringContainsString('md:grid-cols-3', $html);
        $this->assertStringContainsString('&ldquo;Mantap&rdquo;', $html);
        // Thank-you section links to the testimonial form.
        $this->assertStringContainsString('Terima Kasih telah mempercayai Kami sebagai Mitra Anda', $html);
        $this->assertStringContainsString('href="' . route('testimoni.form') . '" class="btn btn-primary mt-8 !px-8">Form Testimoni</a>', $html);
    }

    public function test_product_page_follows_the_design_structure(): void
    {
        $html = $this->get($this->product->publicUrl())->assertOk()->getContent();

        $this->assertStringNotContainsString('aria-label="Breadcrumb"', $html);
        $this->assertStringContainsString('"@type":"BreadcrumbList"', $html);
        // Modules: 5 per row on desktop, first 15 shown.
        $this->assertStringContainsString('lg:grid-cols-5', $html);
        $this->assertStringContainsString('loadMore({ initial: 15', $html);
        $this->assertStringContainsString('Apa kata <strong>Klien</strong> tentang <strong>Kami</strong>', $html);
    }

    public function test_modul_page_follows_the_design_structure(): void
    {
        \App\Models\AdvantageModulProduct::create(['modulId' => $this->modul->id, 'title' => 'Import data', 'icon' => 'file-image/i.png', 'description' => 'Import dari SIM RS']);
        \App\Models\FacilitiesModulProduct::create(['modulId' => $this->modul->id, 'list' => 1, 'description' => 'Verifikasi Data Pasien']);

        $html = $this->get($this->modul->publicUrl())->assertOk()->getContent();

        $this->assertStringNotContainsString('aria-label="Breadcrumb"', $html);
        $this->assertStringContainsString('"@type":"BreadcrumbList"', $html);
        // Advantages headed by the module title, in divider columns.
        $this->assertStringContainsString('text-ink sm:text-3xl">Modul Rawat Jalan</h2>', $html);
        $this->assertStringContainsString('md:[&:nth-child(3n+2)]:border-x', $html);
        // Advantage icons keep their original colours.
        $this->assertStringContainsString('max-w-[72px] object-contain"', $html);
        $this->assertStringNotContainsString('grayscale', $html);
        $this->assertStringContainsString('Fasilitas Modul Rawat Jalan', $html);
        // Testimonial band is white (design).
        $this->assertStringContainsString('<section class="reveal bg-white py-12 sm:py-14">', $html);
        $this->assertStringContainsString('Verifikasi Data Pasien', $html);
    }

    public function test_about_page_shows_vision_mission_and_highlights_its_menu(): void
    {
        $this->get('/tentang-kami')
            ->assertOk()
            ->assertSee('<h1 class="text-center text-2xl font-bold sm:text-3xl">NCI-MediSmart</h1>', false)
            ->assertSee('Visi kami')
            // Each mission line is its own paragraph.
            ->assertSee('<p>Misi satu</p>', false)
            ->assertSee('<p>Misi dua</p>', false)
            // The "Tentang Kami" dropdown trigger gets the active style on its own page.
            ->assertSee('bg-brand/10 text-brand-dark" aria-haspopup="true"', false);

        $this->get('/')->assertOk()->assertDontSee('bg-brand/10 text-brand-dark" aria-haspopup="true"', false);
    }

    public function test_popup_is_rendered_only_inside_its_date_window(): void
    {
        Popup::create([
            'image' => 'file-image/popup.png',
            'status' => 1,
            'start_date' => now()->subDay(),
            'end_date' => now()->addDay(),
            'link' => 'https://example.com/promo',
        ]);

        $this->get('/')->assertOk()->assertSee('aria-label="Promo"', false);
    }

    public function test_popup_is_hidden_when_expired_or_inactive(): void
    {
        Popup::create([
            'image' => 'file-image/popup.png',
            'status' => 1,
            'start_date' => now()->subDays(3),
            'end_date' => now()->subDay(),
            'link' => 'https://example.com/promo',
        ]);

        $this->get('/')->assertOk()->assertDontSee('aria-label="Promo"', false);

        Popup::create([
            'image' => 'file-image/popup.png',
            'status' => 0,
            'start_date' => now()->subDay(),
            'end_date' => now()->addDay(),
            'link' => 'https://example.com/promo',
        ]);

        $this->get('/')->assertOk()->assertDontSee('aria-label="Promo"', false);
    }

    public function test_demo_form_shows_validation_errors_and_keeps_old_input(): void
    {
        $this->from('/demo')
            ->post('/demo', ['name' => 'Budi'])
            ->assertRedirect('/demo')
            ->assertSessionHasErrors(['position', 'instance_name', 'instance_address', 'email', 'phone_number']);

        $this->get('/demo')
            ->assertOk()
            ->assertSee('value="Budi"', false)
            ->assertSee('aria-invalid="true"', false);
    }

    public function test_demo_form_stores_a_valid_request(): void
    {
        $payload = [
            'name' => 'Budi',
            'position' => 'IT',
            'instance_name' => 'RS Sehat',
            'instance_address' => 'Bandung',
            'email' => 'budi@example.com',
            'phone_number' => '08123456789',
        ];

        $this->from('/demo')->post('/demo', $payload)->assertRedirect('/demo')->assertSessionHas('status');

        $this->assertDatabaseHas('demos', ['email' => 'budi@example.com', 'instance_name' => 'RS Sehat']);
    }
}
