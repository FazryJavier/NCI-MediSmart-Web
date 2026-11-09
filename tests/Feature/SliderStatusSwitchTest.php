<?php

namespace Tests\Feature;

use App\Models\LandingSlider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/** Landing slider on/off switch: what it says, what it saves, and that it really hides the slider. */
class SliderStatusSwitchTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        Storage::fake('local');
        $this->actingAs(User::create(['username' => 'admin-user', 'password' => 'secret123', 'level' => 'Admin']));
    }

    private function slider(array $attributes = []): LandingSlider
    {
        return LandingSlider::create(array_merge([
            'title' => 'Slider Judul', 'caption' => 'Isi', 'image' => 'file-image/s.png', 'link' => '/blog', 'status' => 1,
        ], $attributes));
    }

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'title' => 'Baru', 'caption' => 'Isi', 'link' => '/blog', 'status' => '1',
            'image' => UploadedFile::fake()->image('s.png'),
        ], $overrides);
    }

    public function test_forms_use_a_labelled_switch_instead_of_radios(): void
    {
        $slider = $this->slider();

        foreach (['/LandingSlider/create', "/LandingSlider/{$slider->id}/update"] as $url) {
            $html = $this->get($url)->assertOk()->getContent();

            $this->assertStringContainsString('Tampilkan slider di halaman beranda', $html, $url);
            $this->assertStringContainsString('custom-switch', $html, $url);
            $this->assertStringContainsString('<input type="hidden" name="status" value="0">', $html, $url);
            $this->assertStringContainsString('maksimal 8 slider aktif terbaru', $html, $url);
            $this->assertStringNotContainsString('type="radio"', $html, $url);
            $this->assertStringNotContainsString('selected_status', $html, $url);
        }
    }

    public function test_new_sliders_default_to_on_and_existing_ones_show_their_state(): void
    {
        $this->assertMatchesRegularExpression('#name="status" value="1"\s+checked#', $this->get('/LandingSlider/create')->getContent());

        $on = $this->slider(['status' => 1]);
        $off = $this->slider(['status' => 0]);

        $onHtml = $this->get("/LandingSlider/{$on->id}/update")->getContent();
        $offHtml = $this->get("/LandingSlider/{$off->id}/update")->getContent();

        $this->assertMatchesRegularExpression('#name="status" value="1"\s+checked#', $onHtml);
        $this->assertStringContainsString('>Tampil di beranda</label>', $onHtml);
        $this->assertDoesNotMatchRegularExpression('#name="status" value="1"\s+checked#', $offHtml);
        $this->assertStringContainsString('>Disembunyikan</label>', $offHtml);
    }

    public function test_store_saves_the_switch_value(): void
    {
        $this->post('/LandingSlider', $this->payload(['status' => '1']))->assertRedirect('/LandingSlider');
        $this->post('/LandingSlider', $this->payload(['status' => '0', 'title' => 'Off']))->assertRedirect('/LandingSlider');

        $this->assertTrue(LandingSlider::where('title', 'Baru')->firstOrFail()->status == 1);
        $this->assertTrue(LandingSlider::where('title', 'Off')->firstOrFail()->status == 0);
    }

    public function test_update_can_switch_a_slider_off_and_on(): void
    {
        $slider = $this->slider(['status' => 1]);

        $this->put("/LandingSlider/{$slider->id}", ['title' => 'T', 'caption' => 'C', 'link' => '/blog', 'status' => '0'])
            ->assertRedirect('/LandingSlider');
        $this->assertSame(0, (int) $slider->fresh()->status);

        $this->put("/LandingSlider/{$slider->id}", ['title' => 'T', 'caption' => 'C', 'link' => '/blog', 'status' => '1'])
            ->assertRedirect('/LandingSlider');
        $this->assertSame(1, (int) $slider->fresh()->status);
    }

    public function test_status_is_required_and_must_be_boolean(): void
    {
        $slider = $this->slider();

        $this->post('/LandingSlider', $this->payload(['status' => null]))->assertSessionHasErrors('status');
        $this->post('/LandingSlider', $this->payload(['status' => 'maybe']))->assertSessionHasErrors('status');
        $this->put("/LandingSlider/{$slider->id}", ['title' => 'T', 'caption' => 'C', 'link' => '/blog', 'status' => 'x'])
            ->assertSessionHasErrors('status');
    }

    public function test_updating_a_missing_slider_returns_404(): void
    {
        $this->put('/LandingSlider/999', ['title' => 'T', 'caption' => 'C', 'link' => '/blog', 'status' => '1'])->assertNotFound();
    }

    public function test_list_shows_a_clear_status_badge(): void
    {
        $this->slider(['title' => 'Aktif', 'status' => 1]);
        $this->slider(['title' => 'Mati', 'status' => 0]);

        $this->get('/LandingSlider')->assertOk()
            ->assertSee('Tampil di beranda')
            ->assertSee('Disembunyikan');
    }

    public function test_hidden_sliders_are_not_shown_on_the_website(): void
    {
        $this->slider(['title' => 'Slider Terlihat', 'status' => 1]);
        $this->slider(['title' => 'Slider Tersembunyi', 'status' => 0]);

        $this->get('/')->assertOk()
            ->assertSee('Slider Terlihat')
            ->assertDontSee('Slider Tersembunyi');
    }

    public function test_website_shows_at_most_eight_active_sliders_and_ignores_hidden_ones_in_that_count(): void
    {
        // Distinct creation times: the home page takes the newest ones.
        foreach (range(1, 9) as $i) {
            $this->slider(['title' => "Aktif-{$i}-x", 'status' => 1, 'created_at' => now()->subMinutes(20 - $i)]);
        }
        $this->slider(['title' => 'Mati Terbaru', 'status' => 0, 'created_at' => now()]);

        $html = $this->get('/')->assertOk()->getContent();

        $this->assertStringNotContainsString('Mati Terbaru', $html);
        $this->assertStringContainsString('Aktif-9-x', $html);
        $this->assertStringContainsString('Aktif-2-x', $html);
        $this->assertStringNotContainsString('Aktif-1-x', $html);
    }

    public function test_popup_form_uses_the_same_switch_component(): void
    {
        $html = $this->get('/Popup/create')->assertOk()->getContent();

        $this->assertStringContainsString('class="mb-4 admin-switch"', $html);
        $this->assertStringContainsString('Tampilkan popup di website', $html);
        $this->assertStringContainsString('id="switch-status"', $html);
    }
}
