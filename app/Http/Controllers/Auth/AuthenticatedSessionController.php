<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {

        // Store the intended URL in the session
        if ($request->has('redirectTo')) {
            Session::put('url.intended', $request->input('redirectTo'));
        } elseif (!Session::has('url.intended')) {
            Session::put('url.intended', url()->previous());
        }

        return view('backend.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if ($request->user()->role === User::USER) {
            $intendedUrl = Session::pull('url.intended', RouteServiceProvider::HOME);
            return redirect()->to($intendedUrl);
        }

        return redirect()->to(RouteServiceProvider::DASHBOARD);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $role = Auth::user()->role;

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($role == User::USER) {
            return redirect(RouteServiceProvider::HOME);
        }

        return redirect('/login');
    }
}
