<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email_user' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Login hanya untuk role customer -- sesuai keputusan tim,
        // halaman ini bukan untuk petani/admin.
        $user = User::where('email_user', $credentials['email_user'])
            ->where('role', 'customer')
            ->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password_hash)) {
            return back()
                ->withErrors(['email_user' => 'Email atau password salah.'])
                ->onlyInput('email_user');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/user');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name_user' => ['required', 'string', 'max:100'],
            'email_user' => ['required', 'email', 'max:150', 'unique:user,email_user'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name_user' => $validated['name_user'],
            'email_user' => $validated['email_user'],
            'role' => 'customer',
            'is_active' => true,
            'login_with' => 'email',
            'password_hash' => Hash::make($validated['password']),
        ]);

        Customer::create([
            'id_user' => $user->id_user,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/user');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
