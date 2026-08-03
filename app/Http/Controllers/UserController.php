<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('user.index');
    }

    public function edit(): View
    {
        return view('user.edit');
    }

    public function update(Request $request): RedirectResponse
    {
        // TODO: implementasi update profil customer.
        return back();
    }
}
