<?php

namespace Tests\Feature;

use App\Models\CTA;
use App\Models\ExperienceList;
use App\Models\Feedback;
use App\Models\Product;
use Database\Seeders\DemoContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Tests\TestCase;

class DemoContentSeederTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        Storage::fake('local');
    }

    public function test_it_seeds_every_landing_page_with_images(): void
    {
        $this->seed(DemoContentSeeder::class);

        $this->assertSame(3, Product::count());
        $this->assertSame(3, ExperienceList::count());
        Storage::disk('local')->assertExists('file-image/demo-cta-banner.webp');
        Storage::disk('local')->assertExists('file-image/demo-peta-indonesia.png');

        $product = Product::first();
        $article = \App\Models\Article::first();
        $modul = \App\Models\ModulProduct::first();
        foreach (['/', '/tentang-kami', '/testimoni', '/blog', '/sitemap', '/demo', $product->publicUrl(), $modul->publicUrl(), $article->publicUrl()] as $uri) {
            $this->get($uri)->assertOk();
        }
    }

    public function test_it_is_additive_and_never_duplicates_or_overwrites(): void
    {
        Feedback::create(['image' => 'file-image/real.png', 'name' => 'Klien Asli', 'description' => 'Data asli']);

        $this->seed(DemoContentSeeder::class);
        $this->seed(DemoContentSeeder::class);

        $this->assertSame(1, Feedback::count(), 'Existing table data must be left untouched');
        $this->assertSame('Klien Asli', Feedback::first()->name);
        $this->assertSame(3, Product::count(), 'Re-running must not duplicate demo rows');
    }

    public function test_it_refuses_to_run_in_production(): void
    {
        $this->app['env'] = 'production';

        $this->expectException(RuntimeException::class);
        (new DemoContentSeeder())->run();
    }

    public function test_cta_banner_is_shown_as_is_on_desktop_with_a_text_only_card_on_mobile(): void
    {
        CTA::create(['image' => 'file-image/banner.webp', 'title' => 'Punya Pertanyaan?', 'description' => 'Kami siap membantu']);

        $html = $this->get('/testimoni')->assertOk()->getContent();

        // Desktop: the uploaded banner is an <img> (not a cropped background), so its transparent top
        // lets the person's head overflow the card.
        $this->assertStringContainsString('storage/file-image/banner.webp" alt="" class="block h-auto w-full"', $html);
        $this->assertStringNotContainsString('background-image: url(', $html);
        // Mobile: a text-only gradient card.
        $this->assertStringContainsString('lg:hidden rounded-3xl bg-gradient-to-r', $html);
    }
}
