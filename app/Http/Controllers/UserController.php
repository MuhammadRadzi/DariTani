<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Farm;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $q         = $request->query('q', '');
        $kategori  = $request->query('kategori', '');

        $farms = Farm::with(['farmer.user', 'products'])
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name_farm', 'like', "%{$q}%")
                        ->orWhere('location', 'like', "%{$q}%")
                        ->orWhereHas('products', fn($p) => $p->where('product_name', 'like', "%{$q}%"))
                        ->orWhereHas('farmer.user', fn($u) => $u->where('name_user', 'like', "%{$q}%"));
                });
            })
            ->when($kategori, function ($query) use ($kategori) {
                $query->whereHas('products', fn($p) => $p->where('id_category', $kategori));
            })
            ->get();

        $categories = Category::all();

        /** @var User $authUser */
        $authUser = Auth::user();
        $customer = $authUser->customer;
        $bookmarkedFarmIds = $customer->bookmarks()->pluck('id_farm')->toArray();

        return view('user.index', compact('farms', 'categories', 'bookmarkedFarmIds', 'q', 'kategori'));
    }

    public function edit(): View
    {
        /** @var User $user */
        $user = Auth::user();
        $customer = $user->customer;

        return view('user.edit', compact('user', 'customer'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name_user' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->update(['name_user' => $validated['name_user']]);

        $user->customer->update([
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);

        return redirect()->route('user.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
