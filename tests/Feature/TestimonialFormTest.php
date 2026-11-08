<?php

namespace Tests\Feature;

use App\Http\Controllers\Landing\TestimonialSubmissionController;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/** Public testimonial form (stored for review, never auto-published) and the admin review list. */
class TestimonialFormTest extends TestCase
{
    use RefreshDatabase;

    private const VALID = [
        'name' => 'Budi',
        'position' => 'Direktur',
        'instance_name' => 'RS Sehat Sentosa',
        'email' => 'budi@example.com',
        'phone_number' => '0812 3456 7890',
        'testimonial' => 'Pelayanan pendaftaran jauh lebih cepat sejak memakai NCI Medismart.',
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        Storage::fake('local');
    }

    public function test_form_renders_with_the_form_design(): void
    {
        $this->get('/testimoni/form')
            ->assertOk()
            ->assertSee('Ceritakan pengalaman Anda bermitra dengan kami.')
            ->assertSee('name="testimonial"', false)
            ->assertSee('name="website"', false) // honeypot
            ->assertSee('Kirim Testimoni');
    }

    public function test_valid_submission_is_stored_for_review_and_not_published(): void
    {
        $this->from('/testimoni/form')->post('/testimoni/form', self::VALID)
            ->assertRedirect('/testimoni/form')
            ->assertSessionHas('status');

        $files = Storage::disk('local')->files(TestimonialSubmissionController::DIRECTORY);
        $this->assertCount(1, $files);
        $stored = json_decode(Storage::disk('local')->get($files[0]), true);
        $this->assertSame('RS Sehat Sentosa', $stored['instance_name']);
        $this->assertArrayHasKey('submitted_at', $stored);
        $this->assertArrayNotHasKey('website', $stored);

        // Not auto-published.
        $this->assertSame(0, Feedback::count());
    }

    public function test_invalid_submission_shows_errors_and_keeps_input(): void
    {
        $this->from('/testimoni/form')
            ->post('/testimoni/form', ['name' => 'Budi', 'email' => 'bukan-email', 'testimonial' => 'pendek'])
            ->assertRedirect('/testimoni/form')
            ->assertSessionHasErrors(['position', 'instance_name', 'email', 'testimonial']);

        $this->get('/testimoni/form')->assertSee('value="Budi"', false)->assertSee('aria-invalid="true"', false);
        $this->assertSame([], Storage::disk('local')->files(TestimonialSubmissionController::DIRECTORY));
    }

    public function test_honeypot_submission_is_rejected(): void
    {
        $this->from('/testimoni/form')
            ->post('/testimoni/form', self::VALID + ['website' => 'http://spam.example'])
            ->assertSessionHasErrors('website');

        $this->assertSame([], Storage::disk('local')->files(TestimonialSubmissionController::DIRECTORY));
    }

    public function test_submissions_are_rate_limited(): void
    {
        foreach (range(1, 5) as $i) {
            $this->post('/testimoni/form', self::VALID)->assertRedirect();
        }

        $this->post('/testimoni/form', self::VALID)->assertStatus(429);
    }

    public function test_review_list_requires_login_and_shows_submissions(): void
    {
        $this->post('/testimoni/form', self::VALID);

        $this->get('/TestimoniMasuk')->assertRedirect(route('Admin'));

        $admin = User::create(['username' => 'admin', 'password' => bcrypt('x'), 'level' => 'Admin']);
        $this->actingAs($admin)->get('/TestimoniMasuk')
            ->assertOk()
            ->assertSee('RS Sehat Sentosa')
            ->assertSee('Pelayanan pendaftaran jauh lebih cepat')
            ->assertSee('<meta name="robots" content="noindex, nofollow">', false);
    }

    public function test_demo_page_uses_the_shared_form_design(): void
    {
        $this->get('/demo')
            ->assertOk()
            ->assertSee('Jadwalkan demo dengan tim kami.')
            ->assertSee('Jadwal Demo')
            ->assertSee('Copyright &copy; ' . now()->year . ' PT NUANSA CERAH INFORMASI', false);
    }
}
