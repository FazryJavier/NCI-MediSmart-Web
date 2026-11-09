<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/** CMS account management. Admin level only (see the "admin" middleware on the routes). */
class UserManagementController extends Controller
{
    public const LEVELS = ['Admin', 'Editor'];

    public function index(): View
    {
        return view('AdminPage.Pages.User.index', ['users' => User::query()->orderBy('id')->get()]);
    }

    public function create(): View
    {
        return view('AdminPage.Pages.User.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'alpha_dash', 'max:50', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            'level' => ['required', Rule::in(self::LEVELS)],
        ]);

        // The model casts "password" to a hash.
        User::create($data);

        return redirect('/Users')->with('success', 'Akun berhasil dibuat.');
    }

    public function edit(int $id): View
    {
        return view('AdminPage.Pages.User.update', ['user' => User::findOrFail($id)]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'username' => ['required', 'string', 'alpha_dash', 'max:50', Rule::unique('users', 'username')->ignore($user->id)],
            'level' => ['required', Rule::in(self::LEVELS)],
            // Leave empty to keep the current password.
            'password' => ['nullable', 'string', 'min:8', 'max:255', 'confirmed'],
        ]);

        if ($user->level === 'Admin' && $data['level'] !== 'Admin' && $this->isLastAdmin($user)) {
            return back()->withInput()->withErrors(['level' => 'Admin terakhir tidak boleh diturunkan levelnya.']);
        }

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect('/Users')->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return redirect('/Users')->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        if ($this->isLastAdmin($user)) {
            return redirect('/Users')->with('error', 'Admin terakhir tidak boleh dihapus.');
        }

        $user->delete();

        return redirect('/Users')->with('success', 'Akun berhasil dihapus.');
    }

    private function isLastAdmin(User $user): bool
    {
        return $user->level === 'Admin' && User::where('level', 'Admin')->count() <= 1;
    }
}
