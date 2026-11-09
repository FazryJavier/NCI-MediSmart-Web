<?php

namespace Tests\Feature;

use App\Models\Popup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/** Admin popup menu: show/hide switch, optional schedule, validation, and what the list reports. */
class PopupAdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        Storage::fake('local');
        $this->actingAs(User::create(['username' => 'admin-user', 'password' => 'secret123', 'level' => 'Admin']));
    }

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'image' => UploadedFile::fake()->image('promo.png'),
            'status' => '1',
            'start_date' => '',
            'end_date' => '',
            'link' => '/blog',
        ], $overrides);
    }

    private function popup(array $attributes = []): Popup
    {
        return Popup::create(array_merge([
            'image' => 'file-image/popup.png', 'status' => 1, 'link' => '/blog',
        ], $attributes));
    }

    // ---- forms -------------------------------------------------------------------------------

    public function test_form_uses_a_single_status_switch_with_a_hidden_off_value(): void
    {
        $html = $this->get('/Popup/create')->assertOk()->getContent();

        $this->assertStringContainsString('custom-switch', $html);
        $this->assertStringContainsString('<input type="hidden" name="status" value="0">', $html);
        $this->assertStringNotContainsString('type="radio"', $html);
        $this->assertStringContainsString('id="popup-summary"', $html);
        $this->assertStringContainsString('Jadwal tayang', $html);
        // Dead demo plugin scripts and the stray tags before the layout are gone.
        $this->assertStringNotContainsString('select2', $html);
        $this->assertStringNotContainsString('Dropzone', $html);
        $this->assertStringStartsWith('<!DOCTYPE html>', ltrim($html));
    }

    public function test_edit_form_reflects_the_current_state(): void
    {
        $off = $this->popup(['status' => 0, 'start_date' => '2026-12-01', 'end_date' => '2026-12-31']);

        $html = $this->get("/Popup/{$off->id}/update")->assertOk()->getContent();

        $this->assertDoesNotMatchRegularExpression('#name="status" value="1"\s+checked#', $html);
        $this->assertStringContainsString('value="2026-12-01"', $html);
        $this->assertStringContainsString('value="2026-12-31"', $html);
        $this->assertStringContainsString('Nonaktif', $html);
    }

    // ---- store -------------------------------------------------------------------------------

    public function test_popup_can_be_created_without_dates(): void
    {
        $this->post('/Popup', $this->payload())->assertRedirect('/Popup');

        $popup = Popup::firstOrFail();
        $this->assertTrue($popup->status);
        $this->assertNull($popup->start_date);
        $this->assertNull($popup->end_date);
        Storage::disk('local')->assertExists($popup->image);
    }

    public function test_switch_off_creates_a_hidden_popup(): void
    {
        $this->post('/Popup', $this->payload(['status' => '0']))->assertRedirect('/Popup');

        $popup = Popup::firstOrFail();
        $this->assertFalse($popup->status);
        $this->assertSame(Popup::STATE_HIDDEN, $popup->state());
    }

    public function test_image_is_required_when_creating(): void
    {
        $this->post('/Popup', $this->payload(['image' => null]))->assertSessionHasErrors('image');
        $this->assertSame(0, Popup::count());
    }

    public function test_end_date_cannot_be_before_start_date(): void
    {
        $this->post('/Popup', $this->payload(['start_date' => '2026-12-10', 'end_date' => '2026-12-01']))
            ->assertSessionHasErrors('end_date');
        $this->post('/Popup', $this->payload(['start_date' => '2026-12-10', 'end_date' => '2026-12-10']))
            ->assertSessionHasNoErrors();
    }

    public function test_link_must_be_a_site_path_or_http_url(): void
    {
        foreach (['javascript:alert(1)', 'data:text/html;base64,AAAA', 'blog', 'ftp://x.test'] as $bad) {
            $this->post('/Popup', $this->payload(['link' => $bad]))->assertSessionHasErrors('link');
        }
        foreach (['/blog', 'https://contoh.com/promo', 'http://contoh.com'] as $good) {
            $this->post('/Popup', $this->payload(['link' => $good]))->assertSessionHasNoErrors();
        }
    }

    public function test_status_must_be_zero_or_one(): void
    {
        $this->post('/Popup', $this->payload(['status' => 'maybe']))->assertSessionHasErrors('status');
    }

    // ---- update ------------------------------------------------------------------------------

    public function test_update_without_a_new_image_keeps_the_current_one(): void
    {
        Storage::disk('local')->put('file-image/popup.png', 'x');
        $popup = $this->popup();

        $this->put("/Popup/{$popup->id}", ['status' => '0', 'link' => '/testimoni', 'start_date' => '', 'end_date' => ''])
            ->assertRedirect('/Popup');

        $popup->refresh();
        $this->assertSame('file-image/popup.png', $popup->image);
        $this->assertFalse($popup->status);
        $this->assertSame('/testimoni', $popup->link);
        Storage::disk('local')->assertExists('file-image/popup.png');
    }

    public function test_update_with_a_new_image_removes_the_old_file(): void
    {
        Storage::disk('local')->put('file-image/popup.png', 'x');
        $popup = $this->popup();

        $this->put("/Popup/{$popup->id}", [
            'status' => '1', 'link' => '/blog', 'image' => UploadedFile::fake()->image('new.png'),
        ])->assertRedirect('/Popup');

        Storage::disk('local')->assertMissing('file-image/popup.png');
        $this->assertNotSame('file-image/popup.png', $popup->fresh()->image);
    }

    public function test_update_can_clear_the_schedule(): void
    {
        $popup = $this->popup(['start_date' => '2026-01-01', 'end_date' => '2026-02-01']);

        $this->put("/Popup/{$popup->id}", ['status' => '1', 'link' => '/blog', 'start_date' => '', 'end_date' => ''])
            ->assertRedirect('/Popup');

        $this->assertNull($popup->fresh()->start_date);
        $this->assertNull($popup->fresh()->end_date);
    }

    public function test_updating_a_missing_popup_returns_404(): void
    {
        $this->put('/Popup/999', ['status' => '1', 'link' => '/blog'])->assertNotFound();
    }

    // ---- list --------------------------------------------------------------------------------

    public function test_list_shows_the_effective_state_and_marks_the_popup_used_by_the_website(): void
    {
        $this->popup(['status' => 0]);
        $this->popup(['start_date' => now()->addDays(5)]);
        $this->popup(['end_date' => now()->subDays(2)]);
        $latest = $this->popup();

        $html = $this->get('/Popup')->assertOk()->getContent();

        foreach (['Dinonaktifkan', 'Terjadwal', 'Kedaluwarsa', 'Tampil'] as $label) {
            $this->assertStringContainsString($label, $html);
        }
        $this->assertSame(1, substr_count($html, 'Popup terbaru (dipakai website)'));
        $this->assertStringContainsString('Langsung', $html);
        $this->assertStringContainsString('Tanpa batas', $html);
        $this->assertNotNull($latest->id);
    }

    // ---- state rules -------------------------------------------------------------------------

    public function test_end_date_is_the_last_day_the_popup_is_shown(): void
    {
        $popup = $this->popup(['start_date' => '2026-12-01', 'end_date' => '2026-12-10']);

        $this->assertSame(Popup::STATE_SCHEDULED, $popup->state(Carbon::parse('2026-11-30 23:59')));
        $this->assertSame(Popup::STATE_LIVE, $popup->state(Carbon::parse('2026-12-01 00:00')));
        $this->assertSame(Popup::STATE_LIVE, $popup->state(Carbon::parse('2026-12-10 23:30')));
        $this->assertSame(Popup::STATE_EXPIRED, $popup->state(Carbon::parse('2026-12-11 00:00')));
    }

    public function test_popup_without_an_image_or_switched_off_is_never_live(): void
    {
        $this->assertSame(Popup::STATE_HIDDEN, Popup::resolveState(1, null, null, null));
        $this->assertSame(Popup::STATE_HIDDEN, Popup::resolveState(0, null, null, 'file-image/x.png'));
        $this->assertSame(Popup::STATE_LIVE, Popup::resolveState(1, null, null, 'file-image/x.png'));
    }

    public function test_website_shows_the_popup_on_its_last_day(): void
    {
        $this->popup(['start_date' => now()->subDays(3)->startOfDay(), 'end_date' => now()->startOfDay()]);

        $this->get('/')->assertOk()->assertSee('aria-label="Promo"', false);
    }

    // ---- access ------------------------------------------------------------------------------

    public function test_guests_cannot_reach_the_popup_menu(): void
    {
        auth()->logout();

        $this->get('/Popup')->assertRedirect('/Admin');
        $this->post('/Popup', [])->assertRedirect('/Admin');
    }
}
