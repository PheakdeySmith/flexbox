<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Show the login page.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('backend.auth.login.index');
    }

    /**
     * Handle login request (static for now).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Static login for now
        return redirect()->route('backend.dashboard');
    }

    /**
     * Show the registration page.
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        return view('backend.auth.register.index');
    }

    /**
     * Handle registration request (static for now).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Static registration for now
        return redirect()->route('backend.login');
    }

    /**
     * Handle logout request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        // Static logout for now
        return redirect()->route('backend.login');
    }
}
