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

    public function test_list_page_uses_a_short_heading_breadcrumb_and_card_label(): void
    {
        $html = $this->adminPage('/LandingSlider');

        $this->assertStringContainsString('<h1 class="m-0">Landing Slider</h1>', $html);
        $this->assertStringContainsString('<title>Landing Slider | Admin NCI-Medismart</title>', $html);
        $this->assertStringContainsString('<h3 class="card-title">Daftar Data</h3>', $html);
        $this->assertStringContainsString('>Beranda</a>', $html);
        $this->assertStringNotContainsString('Page Home - Landing Slider', $html);
        $this->assertStringNotContainsString('breadcrumb-item">Home<', $html);
    }

    public function test_form_pages_show_the_action_in_heading_and_breadcrumb(): void
    {
        $create = $this->adminPage('/LandingSlider/create');
        $this->assertStringContainsString('<h1 class="m-0">Tambah Landing Slider</h1>', $create);
        $this->assertStringContainsString('<h3 class="card-title">Form Tambah Data</h3>', $create);
        $this->assertStringContainsString('<li class="breadcrumb-item active">Tambah</li>', $create);

        // The title already says "Tambah": it must not be doubled.
        $this->assertStringContainsString('<h1 class="m-0">Tambah Pengguna</h1>', $this->adminPage('/Users/create'));
    }

    public function test_create_button_is_consistent_and_the_stylesheet_is_loaded(): void
    {
        $html = $this->adminPage('/LandingSlider');

        $this->assertStringContainsString('href="/LandingSlider/create"><i class="fas fa-plus mr-1"></i> Tambah Data</a>', $html);
        $this->assertStringContainsString('assets/admin/admin.css', $html);
        $this->assertFileExists(public_path('assets/admin/admin.css'));
        $this->assertStringContainsString('window.adminDataTableOptions', $html);
    }

    public function test_datatables_length_select_keeps_room_for_its_arrow(): void
    {
        $css = (string) file_get_contents(public_path('assets/admin/admin.css'));

        preg_match('#\.dataTables_length select \{(.*?)\}#s', $css, $rule);

        $this->assertNotEmpty($rule, 'Missing .dataTables_length select rule');
        // Right padding must stay wide (arrow) and the select must not shrink to one digit.
        $this->assertMatchesRegularExpression('#padding:\s*[\d.]+rem\s+1\.75rem\s+[\d.]+rem\s+[\d.]+rem#', $rule[1]);
        $this->assertStringContainsString('min-width', $rule[1]);
    }

    public function test_article_list_does_not_turn_table_cells_into_scroll_boxes(): void
    {
        $user = User::create(['username' => 'admin-user', 'password' => 'secret123', 'level' => 'Admin']);
        \App\Models\Article::create(['adminId' => $user->id, 'title' => 'T', 'description' => '<p>Isi artikel</p>', 'image' => 'file-image/x.png', 'prioritize' => 1]);

        $html = $this->actingAs($user)->get('/Article')->assertOk()->getContent();

        $this->assertStringContainsString('<div class="cell-clamp">Isi artikel</div>', $html);
        $this->assertStringNotContainsString('class="des"', $html);
        $this->assertStringNotContainsString('-webkit-box', $html);
    }

    public function test_empty_lists_render_without_the_old_stray_heading(): void
    {
        foreach (['/LandingSlider', '/Product', '/Whatsapp', '/CTA', '/Users'] as $url) {
            $this->assertStringNotContainsString('Data is Empty', $this->adminPage($url), $url);
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
