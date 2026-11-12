<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Pemakaian di route:
     *   ->middleware('role:farmer')
     *   ->middleware('role:customer')
     *   ->middleware('role:customer,farmer')   // boleh lebih dari satu role
     *
     * Dipasang SETELAH 'auth', jadi $request->user() sudah pasti ada.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if ($user && in_array($user->role, $roles, true)) {
            return $next($request);
        }

        // Petani yang nyasar ke halaman customer -> arahkan ke dashboard-nya
        if ($user?->role === 'farmer') {
            return redirect()->route('kebun-saya.index');
        }

        // Role lain (customer ke halaman petani, admin, dst.)
        abort(403);
    }
}
