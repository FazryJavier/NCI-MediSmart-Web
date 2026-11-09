<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

/** Admin login, account management ("Pengguna"), own password change and the admin:create command. */
class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    private const NEW_ACCOUNT = [
        'username' => 'newbie', 'password' => 'secret123', 'password_confirmation' => 'secret123', 'level' => 'Editor',
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        RateLimiter::clear('admin-user|127.0.0.1');
    }

    private function user(string $level = 'Admin', string $username = null): User
    {
        return User::create([
            'username' => $username ?? strtolower($level) . '-user', 'password' => 'secret123', 'level' => $level,
        ]);
    }

    // ---- login -------------------------------------------------------------------------------

    public function test_login_page_renders_and_shows_errors(): void
    {
        $this->get('/Admin')->assertOk()->assertSee('name="remember"', false)->assertSee('type="text" name="username"', false);

        $this->user();
        $this->from('/Admin')->post('/Admin', ['username' => 'admin-user', 'password' => 'wrong'])
            ->assertRedirect('/Admin')
            ->assertSessionHas('LoginError', 'Username atau password salah.');

        $this->followingRedirects()->from('/Admin')->post('/Admin', ['username' => 'admin-user', 'password' => 'wrong'])
            ->assertSee('Username atau password salah.')
            ->assertSee('value="admin-user"', false) // username kept, password never echoed
            ->assertDontSee('value="wrong"', false);
    }

    public function test_login_with_valid_credentials_and_remember_me(): void
    {
        $user = $this->user();

        $this->post('/Admin', ['username' => 'admin-user', 'password' => 'secret123', 'remember' => '1'])
            ->assertRedirect('/LandingSlider');
        $this->assertAuthenticatedAs($user);
        $this->assertNotNull($user->fresh()->remember_token);
    }

    public function test_login_requires_both_fields(): void
    {
        $this->post('/Admin', [])->assertSessionHasErrors(['username', 'password']);
    }

    public function test_login_is_locked_per_username_after_five_failures(): void
    {
        $this->user();

        for ($i = 0; $i < 5; $i++) {
            $this->post('/Admin', ['username' => 'admin-user', 'password' => 'wrong'])
                ->assertSessionHas('LoginError', 'Username atau password salah.');
        }

        // Even the correct password is refused while locked.
        $this->post('/Admin', ['username' => 'admin-user', 'password' => 'secret123'])
            ->assertSessionHas('LoginError');
        $this->assertGuest();
        $this->assertStringContainsString('Terlalu banyak percobaan', session('LoginError'));

        // Another username from the same IP is not affected.
        $this->user('Editor', 'someone-else');
        $this->post('/Admin', ['username' => 'someone-else', 'password' => 'secret123'])->assertRedirect('/LandingSlider');
    }

    public function test_successful_login_resets_the_failure_counter(): void
    {
        $this->user();

        for ($i = 0; $i < 4; $i++) {
            $this->post('/Admin', ['username' => 'admin-user', 'password' => 'wrong']);
        }
        $this->post('/Admin', ['username' => 'admin-user', 'password' => 'secret123'])->assertRedirect('/LandingSlider');
        $this->post('/logout');

        $this->post('/Admin', ['username' => 'admin-user', 'password' => 'wrong'])
            ->assertSessionHas('LoginError', 'Username atau password salah.');
    }

    public function test_signed_in_user_is_redirected_away_from_the_login_page(): void
    {
        $this->actingAs($this->user())->get('/Admin')->assertRedirect('/LandingSlider');
    }

    public function test_logout_ends_the_session(): void
    {
        $this->actingAs($this->user())->post('/logout')->assertRedirect('/Admin');
        $this->assertGuest();
    }

    // ---- account management ------------------------------------------------------------------

    public function test_guest_and_editor_cannot_manage_accounts(): void
    {
        $this->get('/Users')->assertRedirect('/Admin');
        $this->post('/Users', self::NEW_ACCOUNT)->assertRedirect('/Admin');

        $editor = $this->user('Editor');
        $this->actingAs($editor)->get('/Users')->assertForbidden();
        $this->actingAs($editor)->get('/Users/create')->assertForbidden();
        $this->actingAs($editor)->post('/Users', self::NEW_ACCOUNT)->assertForbidden();
        $this->actingAs($editor)->put("/Users/{$editor->id}", ['username' => 'x', 'level' => 'Admin'])->assertForbidden();
        $this->actingAs($editor)->delete("/Users/{$editor->id}")->assertForbidden();

        $this->assertDatabaseMissing('users', ['username' => 'newbie']);
        $this->assertSame('Editor', $editor->fresh()->level);
    }

    public function test_legacy_registration_url_redirects_and_is_not_public(): void
    {
        $this->get('/RegistrationJustForAdmin')->assertRedirect('/Users/create');
        $this->post('/RegistrationJustForAdmin', self::NEW_ACCOUNT)->assertStatus(405);
    }

    public function test_admin_sees_the_user_list_and_menu(): void
    {
        $this->user('Editor');

        $this->actingAs($this->user())
            ->get('/Users')->assertOk()->assertSee('admin-user')->assertSee('editor-user');
        $this->get('/Users/create')->assertOk()->assertSee('Konfirmasi password');
        $this->get('/LandingSlider')->assertOk()->assertSee('/Users', false); // sidebar menu
    }

    public function test_editor_does_not_see_the_users_menu(): void
    {
        $this->actingAs($this->user('Editor'))->get('/LandingSlider')->assertOk()->assertDontSee('href="/Users"', false);
    }

    public function test_sessions_end_when_the_password_changes_elsewhere(): void
    {
        $editor = $this->user('Editor');

        $this->post('/Admin', ['username' => 'editor-user', 'password' => 'secret123']);
        $this->get('/Account/password')->assertOk();

        // e.g. an admin resets this account's password from another browser.
        $editor->update(['password' => 'reset-by-admin-1']);
        $this->app['auth']->forgetGuards(); // a real second request would not share the guard's cached user

        $this->get('/Account/password')->assertRedirect('/Admin');
        $this->assertGuest();
    }

    public function test_own_password_change_keeps_the_current_session(): void
    {
        $this->user('Editor');

        $this->post('/Admin', ['username' => 'editor-user', 'password' => 'secret123']);
        $this->put('/Account/password', [
            'current_password' => 'secret123', 'password' => 'brandnew123', 'password_confirmation' => 'brandnew123',
        ])->assertRedirect('/Account/password');

        $this->get('/Account/password')->assertOk();
    }

    public function test_admin_creates_an_account_with_a_hashed_password(): void
    {
        $this->actingAs($this->user())->post('/Users', self::NEW_ACCOUNT)->assertRedirect('/Users');

        $created = User::where('username', 'newbie')->firstOrFail();
        $this->assertSame('Editor', $created->level);
        $this->assertNotSame('secret123', $created->password);
        $this->assertTrue(\Hash::check('secret123', $created->password));
    }

    public function test_account_creation_validates_input(): void
    {
        $admin = $this->user();

        $this->actingAs($admin)->post('/Users', ['username' => 'bad name!', 'password' => '1234567', 'level' => 'Root'])
            ->assertSessionHasErrors(['username', 'password', 'level']);
        $this->actingAs($admin)->post('/Users', [...self::NEW_ACCOUNT, 'password_confirmation' => 'different'])
            ->assertSessionHasErrors('password');
        $this->actingAs($admin)->post('/Users', [...self::NEW_ACCOUNT, 'username' => 'admin-user'])
            ->assertSessionHasErrors('username');
    }

    public function test_admin_can_update_level_and_reset_a_password(): void
    {
        $admin = $this->user();
        $editor = $this->user('Editor');
        $oldHash = $editor->password;

        $this->actingAs($admin)->put("/Users/{$editor->id}", [
            'username' => 'editor-renamed', 'level' => 'Admin', 'password' => 'brandnew123', 'password_confirmation' => 'brandnew123',
        ])->assertRedirect('/Users');

        $editor->refresh();
        $this->assertSame('editor-renamed', $editor->username);
        $this->assertSame('Admin', $editor->level);
        $this->assertNotSame($oldHash, $editor->password);
    }

    public function test_blank_password_on_update_keeps_the_current_password(): void
    {
        $admin = $this->user();
        $editor = $this->user('Editor');
        $oldHash = $editor->password;

        $this->actingAs($admin)->put("/Users/{$editor->id}", ['username' => 'editor-user', 'level' => 'Editor', 'password' => ''])
            ->assertRedirect('/Users');

        $this->assertSame($oldHash, $editor->fresh()->password);
    }

    public function test_the_last_admin_cannot_be_demoted_or_deleted(): void
    {
        $admin = $this->user();

        $this->actingAs($admin)->from('/Users')->put("/Users/{$admin->id}", ['username' => 'admin-user', 'level' => 'Editor'])
            ->assertSessionHasErrors('level');
        $this->assertSame('Admin', $admin->fresh()->level);

        // Another admin deleting the last remaining admin is impossible; deleting self is blocked too.
        $this->actingAs($admin)->delete("/Users/{$admin->id}")->assertSessionHas('error');
        $this->assertModelExists($admin);
    }

    public function test_admin_can_delete_other_accounts_but_not_themselves(): void
    {
        $admin = $this->user();
        $other = $this->user('Admin', 'other-admin');

        $this->actingAs($admin)->delete("/Users/{$admin->id}")->assertSessionHas('error');
        $this->assertModelExists($admin);

        $this->actingAs($admin)->delete("/Users/{$other->id}")->assertRedirect('/Users')->assertSessionHas('success');
        $this->assertModelMissing($other);
    }

    public function test_unknown_user_returns_404(): void
    {
        $admin = $this->user();

        $this->actingAs($admin)->get('/Users/9999/update')->assertNotFound();
        $this->actingAs($admin)->delete('/Users/9999')->assertNotFound();
    }

    // ---- own password ------------------------------------------------------------------------

    public function test_user_changes_their_own_password(): void
    {
        $editor = $this->user('Editor');

        $this->actingAs($editor)->get('/Account/password')->assertOk();
        $this->actingAs($editor)->put('/Account/password', [
            'current_password' => 'secret123', 'password' => 'brandnew123', 'password_confirmation' => 'brandnew123',
        ])->assertRedirect('/Account/password')->assertSessionHas('success');

        $this->assertTrue(\Hash::check('brandnew123', $editor->fresh()->password));
    }

    public function test_own_password_change_requires_the_current_password(): void
    {
        $editor = $this->user('Editor');

        $this->actingAs($editor)->put('/Account/password', [
            'current_password' => 'wrong', 'password' => 'brandnew123', 'password_confirmation' => 'brandnew123',
        ])->assertSessionHasErrors('current_password');
        $this->actingAs($editor)->put('/Account/password', [
            'current_password' => 'secret123', 'password' => 'secret123', 'password_confirmation' => 'secret123',
        ])->assertSessionHasErrors('password');

        $this->assertTrue(\Hash::check('secret123', $editor->fresh()->password));
    }

    public function test_guest_cannot_change_a_password(): void
    {
        $this->get('/Account/password')->assertRedirect('/Admin');
        $this->put('/Account/password', ['password' => 'brandnew123'])->assertRedirect('/Admin');
    }

    // ---- admin:create ------------------------------------------------------------------------

    public function test_admin_create_command_creates_an_account(): void
    {
        $this->artisan('admin:create', ['username' => 'cli-admin', '--password' => 'secret123'])
            ->expectsOutputToContain('created')
            ->assertSuccessful();

        $created = User::where('username', 'cli-admin')->firstOrFail();
        $this->assertSame('Admin', $created->level);
        $this->assertTrue(\Hash::check('secret123', $created->password));
    }

    public function test_admin_create_command_rejects_bad_input(): void
    {
        $this->user();

        $this->artisan('admin:create', ['username' => 'admin-user', '--password' => 'secret123'])->assertFailed();
        $this->artisan('admin:create', ['username' => 'short', '--password' => '123'])->assertFailed();
        $this->artisan('admin:create', ['username' => 'weird', '--password' => 'secret123', '--level' => 'Root'])->assertFailed();

        $this->assertSame(1, User::count());
    }
}
