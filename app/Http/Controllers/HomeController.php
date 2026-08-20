<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Farm;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $farms = Farm::with('farmer.user')->get();
        $categories = Category::all();

        $authUser = Auth::user();
        $customer = $authUser ? $authUser->customer : null;
        $bookmarkedFarmIds = $customer ? $customer->bookmarks()->pluck('id_farm')->toArray() : [];

        return view('user.index', compact('farms', 'categories', 'bookmarkedFarmIds'));
    }
}
