<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

/** Admin sidebar and header. */
class AdminNavigationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    private function signIn(string $level = 'Admin'): User
    {
        $user = User::create(['username' => 'nav-user', 'password' => 'secret123', 'level' => $level]);
        $this->actingAs($user);

        return $user;
    }

    /** @return array<int, array{href: string, icon: string}> */
    private function sidebarLinks(string $html): array
    {
        preg_match('#<aside class="main-sidebar.*?</aside>#s', $html, $aside);
        preg_match_all('#<a href="(/[^"]*)"[^>]*>\s*<i class="nav-icon ([^"]+)"#', $aside[0] ?? '', $m, PREG_SET_ORDER);

        return array_map(fn ($x) => ['href' => $x[1], 'icon' => $x[2]], $m);
    }

    public function test_every_sidebar_link_has_its_own_icon_and_points_to_a_real_route(): void
    {
        $this->signIn();
        $html = $this->get('/LandingSlider')->assertOk()->getContent();
        $links = $this->sidebarLinks($html);

        $this->assertGreaterThan(20, count($links));

        $icons = array_column($links, 'icon');
        $this->assertSame(count($icons), count(array_unique($icons)), 'Sidebar icons must be unique: ' . implode(', ', array_diff_assoc($icons, array_unique($icons))));

        $uris = collect(Route::getRoutes()->getRoutes())->map(fn ($r) => '/' . ltrim($r->uri(), '/'))->all();
        foreach ($links as $link) {
            $this->assertContains($link['href'], $uris, "Sidebar link {$link['href']} has no route");
        }
    }

    public function test_the_current_page_is_highlighted_and_its_group_opened(): void
    {
        $this->signIn();

        $html = $this->get('/Product/create')->assertOk()->getContent();

        $this->assertMatchesRegularExpression('#<a href="/Product"\s+class="nav-link active"#', $html);
        $this->assertMatchesRegularExpression('#<li class="nav-item menu-open">\s*<a href="\#" class="nav-link active">\s*<i class="nav-icon fas fa-box-open"#', $html);
        $this->assertDoesNotMatchRegularExpression('#<a href="/Footer"\s+class="nav-link active"#', $html);
    }

    public function test_sidebar_groups_menu_sections(): void
    {
        $this->signIn();

        $this->get('/CTA')->assertOk()
            ->assertSeeInOrder(['KONTEN WEBSITE', 'INTERAKSI', 'PENGATURAN'])
            ->assertSee('Permintaan Demo')
            ->assertSee('Testimoni Masuk');
    }

    public function test_users_menu_is_only_listed_for_admins(): void
    {
        $this->signIn('Editor');
        $this->get('/LandingSlider')->assertOk()->assertDontSee('href="/Users"', false)->assertDontSee('AKUN');
    }

    public function test_admins_see_the_users_menu(): void
    {
        $this->signIn('Admin');
        $this->get('/LandingSlider')->assertOk()->assertSee('href="/Users"', false)->assertSee('AKUN');
    }

    public function test_header_has_an_account_dropdown_with_password_and_logout(): void
    {
        $this->signIn();

        $this->get('/LandingSlider')->assertOk()
            ->assertSee('nav-user')
            ->assertSee('href="/Account/password"', false)
            ->assertSee('action="/logout"', false)
            ->assertSee('Lihat Website');
    }
}
