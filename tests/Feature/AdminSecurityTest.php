<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/** Upload-handling hardening of the admin panel (CMS). Login and accounts: see AdminAuthTest. */
class AdminSecurityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        Storage::fake('local');
    }

    private function admin(): User
    {
        return User::create(['username' => 'admin-user', 'password' => 'secret123', 'level' => 'Admin']);
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

        $this->actingAs($this->admin())->put("/Product/{$product->id}", [
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
        $admin = $this->admin();
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
