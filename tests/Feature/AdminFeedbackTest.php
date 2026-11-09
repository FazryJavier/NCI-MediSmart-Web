<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Whatsapp;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/** Toast notifications after create / update / delete, delete confirmation, and validation display. */
class AdminFeedbackTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        Storage::fake('local');
        $this->actingAs(User::create(['username' => 'admin-user', 'password' => 'secret123', 'level' => 'Admin']));
    }

    /** @return array<int, array{type: string, message: string}> */
    private function flash(string $html): array
    {
        $this->assertMatchesRegularExpression('#<div id="admin-flash" hidden data-flash="([^"]*)"#', $html, 'No flash payload found');
        preg_match('#<div id="admin-flash" hidden data-flash="([^"]*)"#', $html, $m);

        return json_decode(html_entity_decode($m[1], ENT_QUOTES), true, flags: JSON_THROW_ON_ERROR);
    }

    // ---- toasts after actions ----------------------------------------------------------------

    public function test_create_update_and_delete_each_show_a_success_toast(): void
    {
        $html = $this->followingRedirects()->post('/Whatsapp', ['phone_number' => '6281234567890'])->getContent();
        $this->assertSame([['type' => 'success', 'message' => 'Data berhasil ditambahkan.']], $this->flash($html));

        $id = Whatsapp::firstOrFail()->id;

        $html = $this->followingRedirects()->put("/Whatsapp/{$id}", ['phone_number' => '6281111111111'])->getContent();
        $this->assertSame([['type' => 'success', 'message' => 'Data berhasil diperbarui.']], $this->flash($html));

        // Deleting is a success, not an error banner.
        $html = $this->followingRedirects()->delete("/Whatsapp/{$id}")->getContent();
        $this->assertSame([['type' => 'success', 'message' => 'Data berhasil dihapus.']], $this->flash($html));
    }

    public function test_pages_without_messages_have_no_toast_payload(): void
    {
        $this->get('/Whatsapp')->assertOk()->assertDontSee('id="admin-flash"', false);
    }

    public function test_error_and_warning_messages_become_toasts_with_their_type(): void
    {
        $html = $this->withSession(['error' => 'Gagal.', 'warning' => 'Hati-hati.', 'info' => 'Catatan.'])
            ->get('/Whatsapp')->assertOk()->getContent();

        $this->assertSame(
            [['type' => 'error', 'message' => 'Gagal.'], ['type' => 'warning', 'message' => 'Hati-hati.'], ['type' => 'info', 'message' => 'Catatan.']],
            $this->flash($html),
        );
    }

    public function test_toast_payload_is_escaped_so_messages_cannot_inject_markup(): void
    {
        $html = $this->withSession(['success' => '"><script>alert(1)</script>'])->get('/Whatsapp')->getContent();

        $this->assertStringNotContainsString('<script>alert(1)</script>', $html);
        $this->assertSame('"><script>alert(1)</script>', $this->flash($html)[0]['message']);
    }

    public function test_the_old_alert_banners_with_the_bootstrap5_close_button_are_gone(): void
    {
        $html = $this->withSession(['success' => 'Ok'])->get('/Whatsapp')->getContent();

        $this->assertStringNotContainsString('btn-close', $html);
        $this->assertStringNotContainsString('data-bs-dismiss', $html);
        $this->assertStringNotContainsString('alert-dismissible', $html);
        $this->assertStringContainsString('assets/admin/admin.js', $html);
        $this->assertFileExists(public_path('assets/admin/admin.js'));
    }

    // ---- validation --------------------------------------------------------------------------

    public function test_validation_failure_shows_a_toast_a_summary_and_the_field_message(): void
    {
        $html = $this->followingRedirects()->from('/Whatsapp/create')->post('/Whatsapp', ['phone_number' => ''])->getContent();

        $this->assertSame([['type' => 'error', 'message' => 'Data belum tersimpan. Periksa isian yang ditandai merah.']], $this->flash($html));
        $this->assertStringContainsString('form-error-summary', $html);
        $this->assertStringContainsString('Periksa kembali isian Anda (1 kesalahan)', $html);
        $this->assertStringContainsString('<div class="field-error" role="alert">Nomor telepon wajib diisi.</div>', $html);
        // The old red box under the field is gone (the <noscript> fallback is the only place that still uses alerts).
        $this->assertStringNotContainsString('alert alert-danger" role="alert">Nomor telepon', $html);
        $this->assertStringContainsString('<noscript>', $html);
    }

    public function test_validation_messages_are_in_indonesian_with_readable_field_names(): void
    {
        $this->assertSame('id', app()->getLocale());

        $errors = $this->post('/Users', ['username' => 'x y', 'password' => '123', 'level' => 'Root'])
            ->assertSessionHasErrors(['username', 'password', 'level'])
            ->baseResponse->getSession()->get('errors')->getBag('default');

        $this->assertSame('Username hanya boleh berisi huruf, angka, strip (-), dan garis bawah (_).', $errors->first('username'));
        $this->assertSame('Password minimal 8 karakter.', $errors->first('password'));
        $this->assertSame('Level yang dipilih tidak valid.', $errors->first('level'));
    }

    public function test_upload_errors_use_the_field_name_and_limits(): void
    {
        $errors = $this->post('/Popup', ['status' => '1', 'link' => '/blog'])
            ->assertSessionHasErrors('image')
            ->baseResponse->getSession()->get('errors')->getBag('default');

        $this->assertSame('Gambar wajib diisi.', $errors->first('image'));
    }

    // ---- delete confirmation -----------------------------------------------------------------

    public function test_delete_buttons_ask_for_confirmation_through_the_shared_modal(): void
    {
        Whatsapp::create(['phone_number' => '6281234567890']);

        $html = $this->get('/Whatsapp')->assertOk()->getContent();

        $this->assertStringContainsString('data-confirm="Data yang dihapus tidak bisa dikembalikan."', $html);
        $this->assertStringNotContainsString('onclick="return confirm(', $html);
    }

    public function test_deleting_an_account_asks_for_confirmation_with_the_username(): void
    {
        User::create(['username' => 'to-remove', 'password' => 'secret123', 'level' => 'Editor']);

        $this->get('/Users')->assertOk()->assertSee('data-confirm="Hapus akun to-remove?"', false);
    }

    public function test_no_admin_view_uses_the_old_error_boxes_or_native_confirm(): void
    {
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(resource_path('views/AdminPage'), \FilesystemIterator::SKIP_DOTS));

        foreach ($files as $file) {
            if (! str_ends_with($file->getFilename(), '.blade.php')) {
                continue;
            }
            $source = file_get_contents($file->getPathname());

            $this->assertStringNotContainsString('alert alert-danger">{{ $message }}', $source, $file->getPathname());
            $this->assertStringNotContainsString('return confirm(', $source, $file->getPathname());
        }
    }
}
