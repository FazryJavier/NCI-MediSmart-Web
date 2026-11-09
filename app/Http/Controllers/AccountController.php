<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/** Lets any signed-in user change their own password. */
class AccountController extends Controller
{
    public function editPassword(): View
    {
        return view('AdminPage.Pages.Account.password');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed', 'different:current_password'],
        ]);

        $user = $request->user();
        $user->update(['password' => $data['password']]);

        // Other sessions of this account are signed out by the "auth.session" middleware
        // because their stored password hash no longer matches; keep this one alive.
        $request->session()->put('password_hash_' . Auth::getDefaultDriver(), $user->getAuthPassword());

        return redirect('/Account/password')->with('success', 'Password berhasil diubah.');
    }
}
