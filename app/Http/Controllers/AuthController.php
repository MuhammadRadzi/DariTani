<?php

namespace App\Http\Controllers;

use App\Mail\OtpVerificationMail;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

        if (! $user->email_verified_at) {
            $request->session()->put('unverified_user_id', $user->id_user);

            return redirect()->route('verify')
                ->withErrors(['verification_code' => 'Akun kamu belum diverifikasi. Cek email untuk kode verifikasinya.']);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('user.index');
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

        $this->sendVerificationCode($user);

        // Belum login -- user harus verifikasi kode dulu.
        $request->session()->put('unverified_user_id', $user->id_user);

        return redirect()->route('verify');
    }

    public function showVerify(Request $request): RedirectResponse|View
    {
        $user = $this->resolvePendingUser($request);

        if (! $user) {
            return redirect()->route('register');
        }

        return view('auth.verify', ['email' => $user->email_user]);
    }

    public function verify(Request $request): RedirectResponse
    {
        $user = $this->resolvePendingUser($request);

        if (! $user) {
            return redirect()->route('register');
        }

        $request->validate([
            'verification_code' => ['required', 'string', 'size:6'],
        ]);

        if ($user->verification_code !== $request->input('verification_code')) {
            return back()->withErrors(['verification_code' => 'Kode verifikasi salah.']);
        }

        if (now()->greaterThan($user->verification_code_expires_at)) {
            return back()->withErrors(['verification_code' => 'Kode verifikasi sudah kedaluwarsa. Silakan kirim ulang.']);
        }

        $user->forceFill([
            'email_verified_at' => now(),
            'verification_code' => null,
            'verification_code_expires_at' => null,
        ])->save();

        $request->session()->forget('unverified_user_id');

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('user.index');
    }

    public function resend(Request $request): RedirectResponse
    {
        $user = $this->resolvePendingUser($request);

        if (! $user) {
            return redirect()->route('register');
        }

        $this->sendVerificationCode($user);

        return back()->with('status', 'Kode verifikasi baru sudah dikirim ke email kamu.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    /**
     * Generate kode OTP 6 digit, simpan ke user (berlaku 10 menit), lalu kirim via email.
     */
    private function sendVerificationCode(User $user): void
    {
        $code = (string) random_int(100000, 999999);

        $user->forceFill([
            'verification_code' => $code,
            'verification_code_expires_at' => now()->addMinutes(10),
        ])->save();

        Mail::to($user->email_user)->send(new OtpVerificationMail($user));
    }

    /**
     * Ambil user yang sedang menunggu verifikasi dari session.
     */
    private function resolvePendingUser(Request $request): ?User
    {
        $id = $request->session()->get('unverified_user_id');

        if (! $id) {
            return null;
        }

        return User::whereNull('email_verified_at')->find($id);
    }
}
