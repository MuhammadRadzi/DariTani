<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfilPetaniController extends Controller
{
    public function edit(): View
    {
        $user = Auth::user();
        $farmer = $user->farmer;
        abort_unless($farmer, 403);

        return view('profil-petani.edit', compact('user', 'farmer'));
    }

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $farmer = $user->farmer;
        abort_unless($farmer, 403);

        // Panjang max di bawah ini tebakan; samakan dengan panjang kolom di tabel farmer.
        $data = $request->validate([
            'name_user'       => ['required', 'string', 'max:100'],
            'farm_name'       => ['required', 'string', 'max:100'],
            'whatsapp_number' => ['required', 'regex:/^\+?[0-9\s\-]{9,20}$/'],
            'address'         => ['required', 'string', 'max:255'],
        ], [
            'whatsapp_number.regex' => 'Nomor WhatsApp hanya boleh berisi angka, spasi, atau tanda -.',
        ]);

        // CartController memakai nilai ini apa adanya di https://wa.me/<nomor>,
        // jadi simpan sebagai angka saja dengan awalan 62 (bukan 08xx atau +62).
        $wa = preg_replace('/\D+/', '', $data['whatsapp_number']);
        $wa = match (true) {
            str_starts_with($wa, '0') => '62' . substr($wa, 1),
            str_starts_with($wa, '8') => '62' . $wa,
            default                   => $wa,
        };

        if (strlen($wa) < 10 || strlen($wa) > 15) {
            return back()
                ->withErrors(['whatsapp_number' => 'Nomor WhatsApp tidak valid.'])
                ->withInput();
        }

        $user->update(['name_user' => $data['name_user']]);

        $farmer->update([
            'farm_name'       => $data['farm_name'],
            'whatsapp_number' => $wa,
            'address'         => $data['address'],
        ]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
