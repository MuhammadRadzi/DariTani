<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Farm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    public function index(): View
    {
        $customer = Auth::user()->customer;

        $bookmarks = Bookmark::with('farm.farmer.user')
            ->where('id_customer', $customer->id_customer)
            ->latest('id_bookmark')
            ->get();

        return view('markah.index', compact('bookmarks'));
    }

    public function store(Farm $farm)
    {
        $customer = Auth::user()->customer;

        $bookmark = Bookmark::firstOrCreate([
            'id_customer' => $customer->id_customer,
            'id_farm' => $farm->id_farm,
        ]);

        if (request()->wantsJson()) {
            return response()->json(['success' => true, 'bookmarked' => true]);
        }

        return back()->with('success', 'Kebun ditambahkan ke markah.');
    }

    public function destroy(Farm $farm)
    {
        $customer = Auth::user()->customer;

        Bookmark::where('id_customer', $customer->id_customer)
            ->where('id_farm', $farm->id_farm)
            ->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => true, 'bookmarked' => false]);
        }

        return back()->with('success', 'Kebun dihapus dari markah.');
    }

    public function destroyAll(): RedirectResponse
    {
        $customer = Auth::user()->customer;

        Bookmark::where('id_customer', $customer->id_customer)->delete();

        return back()->with('success', 'Semua markah dihapus.');
    }
}
