<?php

namespace Tests\Feature;

use App\Models\Popup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/** Public popup on the company profile: markup, link handling, per-session dismissal key and the built script. */
class LandingPopupTest extends TestCase
{
    use RefreshDatabase;

    private function livePopup(array $attributes = []): Popup
    {
        return Popup::create(array_merge([
            'image' => 'file-image/popup.png', 'status' => 1, 'link' => '/blog',
        ], $attributes));
    }

    public function test_live_popup_renders_an_accessible_dialog_with_close_and_call_to_action(): void
    {
        $this->livePopup();

        $html = $this->get('/')->assertOk()->getContent();

        $this->assertStringContainsString('x-data="promoPopup(', $html);
        $this->assertStringContainsString('role="dialog"', $html);
        $this->assertStringContainsString('aria-modal="true"', $html);
        $this->assertStringContainsString('aria-label="Promo"', $html);
        $this->assertStringContainsString('aria-label="Tutup promo"', $html);
        $this->assertStringContainsString('Lihat selengkapnya', $html);
        $this->assertStringContainsString('Nanti saja', $html);
        $this->assertStringContainsString('x-on:keydown.escape.window="close()"', $html);
        $this->assertStringContainsString('alt="Banner promo"', $html);
        // The old plain overlay is gone.
        $this->assertStringNotContainsString('bg-black/50', $html);
    }

    public function test_dismissal_key_changes_when_the_popup_is_replaced_or_edited(): void
    {
        $popup = $this->livePopup();
        $first = $this->get('/')->getContent();
        preg_match("#key: '(promo-popup-[^']+)'#", $first, $a);

        $this->assertNotEmpty($a, 'Dismissal key not found');
        $this->assertStringContainsString('promo-popup-' . $popup->id . '-', $a[1]);

        $newer = $this->livePopup();
        $second = $this->get('/')->getContent();
        preg_match("#key: '(promo-popup-[^']+)'#", $second, $b);

        $this->assertNotSame($a[1], $b[1]);
        $this->assertStringContainsString('promo-popup-' . $newer->id . '-', $b[1]);
    }

    public function test_site_links_open_in_the_same_tab_and_other_sites_in_a_new_one(): void
    {
        $this->livePopup(['link' => '/blog']);
        $internal = $this->get('/')->getContent();
        $this->assertStringContainsString('href="/blog"', $internal);
        $this->assertStringNotContainsString('target="_blank"', $this->popupMarkup($internal));

        $this->livePopup(['link' => 'https://promo.example.org/penawaran']);
        $external = $this->popupMarkup($this->get('/')->getContent());
        $this->assertStringContainsString('href="https://promo.example.org/penawaran"', $external);
        $this->assertStringContainsString('target="_blank" rel="noopener noreferrer"', $external);
    }

    public function test_popup_without_a_link_shows_only_the_image(): void
    {
        $this->livePopup(['link' => '']);

        $markup = $this->popupMarkup($this->get('/')->getContent());

        $this->assertStringContainsString('alt="Banner promo"', $markup);
        $this->assertStringNotContainsString('Lihat selengkapnya', $markup);
        $this->assertStringNotContainsString('<a href=', $markup);
    }

    public function test_hidden_scheduled_and_expired_popups_render_nothing(): void
    {
        $this->livePopup(['status' => 0]);
        $this->get('/')->assertOk()->assertDontSee('promoPopup', false);

        $this->livePopup(['start_date' => now()->addDays(3)]);
        $this->get('/')->assertOk()->assertDontSee('promoPopup', false);

        $this->livePopup(['end_date' => now()->subDays(3)]);
        $this->get('/')->assertOk()->assertDontSee('promoPopup', false);
    }

    public function test_popup_is_also_rendered_on_the_other_page_that_includes_it(): void
    {
        $this->livePopup();

        $this->get('/tentang-kami')->assertOk()->assertSee('promoPopup', false);
    }

    public function test_the_committed_build_contains_the_popup_behaviour(): void
    {
        $manifest = json_decode((string) file_get_contents(public_path('build/manifest.json')), true);
        $js = (string) file_get_contents(public_path('build/' . $manifest['resources/js/app.js']['file']));

        $this->assertStringContainsString('promoPopup', $js);
        $this->assertStringContainsString('sessionStorage', $js);
    }

    /** The popup dialog only: from its root element to the start of the page content (the hero section). */
    private function popupMarkup(string $html): string
    {
        $start = strpos($html, 'x-data="promoPopup');
        $end = strpos($html, 'aria-label="Sorotan"');

        $this->assertNotFalse($start, 'Popup markup not found');
        $this->assertNotFalse($end, 'Hero section not found');
        $this->assertGreaterThan($start, $end);

        return substr($html, $start, $end - $start);
    }
}
