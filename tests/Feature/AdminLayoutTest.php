<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/** The admin layout must stay fast: no page-load animation and no references to files that do not exist. */
class AdminLayoutTest extends TestCase
{
    use RefreshDatabase;

    private function adminPage(string $url): string
    {
        $user = User::firstOrCreate(['username' => 'admin-user'], ['password' => 'secret123', 'level' => 'Admin']);

        return $this->actingAs($user)->get($url)->assertOk()->getContent();
    }

    public function test_admin_pages_have_no_preloader(): void
    {
        foreach (['/LandingSlider', '/CTA', '/Users'] as $url) {
            $html = $this->adminPage($url);

            $this->assertStringNotContainsString('class="preloader', $html, $url);
            $this->assertStringNotContainsString('animation__shake', $html, $url);
        }
    }

    public function test_admin_layout_only_references_assets_that_exist(): void
    {
        $html = $this->adminPage('/LandingSlider');

        preg_match_all('#(?:href|src)="(?!https?:|//|\#|/logout|mailto:)([^"]+)"#', $html, $matches);

        foreach (array_unique($matches[1]) as $path) {
            // Only static assets; page links such as /Product are routes.
            if (! preg_match('#\.(css|js|png|jpg|jpeg|webp|svg|ico)(\?|$)#i', $path)) {
                continue;
            }

            $relative = ltrim((string) parse_url($path, PHP_URL_PATH), '/');
            $relative = preg_replace('#^.*?(adminlte/|assets/)#', '$1', rawurldecode($relative));

            $this->assertFileExists(public_path($relative), "Missing asset referenced by the admin layout: {$path}");
        }
    }
}
