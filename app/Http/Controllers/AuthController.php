<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\View\View;

/** Admin panel sign in / sign out. */
class AuthController extends Controller
{
    public const HOME = '/LandingSlider';

    private const MAX_ATTEMPTS = 5;

    private const LOCKOUT_SECONDS = 60;

    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect(self::HOME);
        }

        return view('AdminPage.Pages.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        // Limit per username + IP, so one account cannot be locked out from everywhere
        // and one IP cannot guess many accounts.
        $key = Str::lower($credentials['username']) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, self::MAX_ATTEMPTS)) {
            return $this->failed($request, 'Terlalu banyak percobaan login. Coba lagi dalam ' . RateLimiter::availableIn($key) . ' detik.');
        }

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::hit($key, self::LOCKOUT_SECONDS);
            // Never log the submitted username or password: people sometimes type one into the other field.
            Log::warning('Admin login failed', ['ip' => $request->ip()]);

            return $this->failed($request, 'Username atau password salah.');
        }

        RateLimiter::clear($key);
        $request->session()->regenerate();

        return redirect()->intended(self::HOME);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/Admin');
    }

    private function failed(Request $request, string $message): RedirectResponse
    {
        return back()->withInput($request->only('username'))->with('LoginError', $message);
    }
}
