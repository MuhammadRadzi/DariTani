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
    public function index(): View
    {
        $farms = Farm::with('farmer.user')->get();
        $categories = Category::all();

        /** @var User $authUser */
        $authUser = Auth::user();
        $customer = $authUser->customer;
        $bookmarkedFarmIds = $customer->bookmarks()->pluck('id_farm')->toArray();

        return view('user.index', compact('farms', 'categories', 'bookmarkedFarmIds'));
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
