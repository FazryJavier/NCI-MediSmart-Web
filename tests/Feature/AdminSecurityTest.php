<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/** Access control and upload-handling hardening of the admin panel (CMS). */
class AdminSecurityTest extends TestCase
{
    use RefreshDatabase;

    private const NEW_ACCOUNT = ['username' => 'newbie', 'password' => 'secret123', 'level' => 'Admin'];

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        Storage::fake('local');
    }

    private function user(string $level): User
    {
        return User::create(['username' => strtolower($level) . '-user', 'password' => 'secret123', 'level' => $level]);
    }

    public function test_guest_cannot_open_or_submit_the_registration_form(): void
    {
        $this->get('/RegistrationJustForAdmin')->assertRedirect('/Admin');
        $this->post('/RegistrationJustForAdmin', self::NEW_ACCOUNT)->assertRedirect('/Admin');

        $this->assertDatabaseMissing('users', ['username' => 'newbie']);
    }

    public function test_editor_cannot_create_accounts(): void
    {
        $this->actingAs($this->user('Editor'))->get('/RegistrationJustForAdmin')->assertForbidden();
        $this->actingAs($this->user('Editor'))->post('/RegistrationJustForAdmin', self::NEW_ACCOUNT)->assertForbidden();

        $this->assertDatabaseMissing('users', ['username' => 'newbie']);
    }

    public function test_admin_can_create_accounts_with_a_hashed_password(): void
    {
        $this->actingAs($this->user('Admin'))
            ->post('/RegistrationJustForAdmin', self::NEW_ACCOUNT)
            ->assertRedirect('/RegistrationJustForAdmin');

        $created = User::where('username', 'newbie')->firstOrFail();
        $this->assertSame('Admin', $created->level);
        $this->assertNotSame('secret123', $created->password);
    }

    public function test_admin_registration_validates_input(): void
    {
        $admin = $this->user('Admin');

        $this->actingAs($admin)->post('/RegistrationJustForAdmin', ['username' => 'x', 'password' => '123', 'level' => 'Root'])
            ->assertSessionHasErrors(['password', 'level']);
        $this->actingAs($admin)->post('/RegistrationJustForAdmin', ['username' => $admin->username, 'password' => 'secret123', 'level' => 'Editor'])
            ->assertSessionHasErrors('username');
    }

    public function test_login_is_rate_limited(): void
    {
        $this->user('Admin');

        for ($i = 0; $i < 5; $i++) {
            $this->post('/Admin', ['username' => 'admin-user', 'password' => 'wrong'])->assertSessionHas('LoginError');
        }

        $this->post('/Admin', ['username' => 'admin-user', 'password' => 'secret123'])->assertStatus(429);
        $this->assertGuest();
    }

    public function test_login_works_with_valid_credentials(): void
    {
        $user = $this->user('Admin');

        $this->post('/Admin', ['username' => 'admin-user', 'password' => 'secret123'])->assertRedirect('/LandingSlider');
        $this->assertAuthenticatedAs($user);
    }

    public function test_update_deletes_the_record_image_and_ignores_a_client_supplied_old_image(): void
    {
        $disk = Storage::disk('local');
        $disk->put('file-image/current.png', 'old');
        $disk->put('testimonial-submissions/keep.json', '{}');
        $disk->put('file-image/other-record.png', 'other');

        $product = Product::create([
            'title' => 'T', 'subTitle' => 'S', 'description' => 'D', 'image' => 'file-image/current.png',
        ]);

        $this->actingAs($this->user('Admin'))->put("/Product/{$product->id}", [
            'title' => 'T2', 'subTitle' => 'S', 'description' => 'D',
            'image' => UploadedFile::fake()->image('new.png'),
            // Forged values must never decide what gets deleted.
            'oldImage' => 'testimonial-submissions/keep.json',
        ])->assertRedirect('/Product');

        $disk->assertMissing('file-image/current.png');
        $disk->assertExists('testimonial-submissions/keep.json');
        $disk->assertExists('file-image/other-record.png');
        $this->assertNotSame('file-image/current.png', $product->fresh()->image);
    }

    public function test_deleting_an_article_removes_its_image_file(): void
    {
        $admin = $this->user('Admin');
        Storage::disk('local')->put('file-image/article.png', 'x');
        $article = Article::create([
            'adminId' => $admin->id, 'title' => 'T', 'description' => 'D', 'image' => 'file-image/article.png',
        ]);

        $this->actingAs($admin)->delete("/Article/{$article->id}")->assertRedirect('/Article');

        $this->assertModelMissing($article);
        Storage::disk('local')->assertMissing('file-image/article.png');
    }

    public function test_stored_file_deletion_is_limited_to_the_upload_directory(): void
    {
        $disk = Storage::disk('local');
        $disk->put('testimonial-submissions/keep.json', '{}');
        $disk->put('file-image/ok.png', 'x');

        $controller = new class extends \App\Http\Controllers\Controller {
            public function run(?string $path): void { $this->deleteStoredFile($path); }
        };

        foreach ([null, '', 'testimonial-submissions/keep.json', 'file-image/../testimonial-submissions/keep.json'] as $path) {
            $controller->run($path);
        }
        $disk->assertExists('testimonial-submissions/keep.json');

        $controller->run('file-image/ok.png');
        $disk->assertMissing('file-image/ok.png');
    }
}
