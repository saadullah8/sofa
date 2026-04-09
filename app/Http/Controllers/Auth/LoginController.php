<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     */
    protected function redirectTo()
    {
        if (Auth::user()->role == 1) {
            return '/admin/dashboard'; // admin panel
        }

        return '/login'; // agar role match na kare
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function logout(Request $request)
    {
        $redirect = '/login'; // default

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect($redirect);
    }
}
