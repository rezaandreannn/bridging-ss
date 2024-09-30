<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
    
        // Tentukan kredensial yang akan digunakan
        $credentials = [
            'password' => $request->password,
        ];
    
        // Cek apakah input adalah email atau username
        if (filter_var($request->login, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->login;
        } else {
            $credentials['username'] = $request->login;
        }
    
        // Coba autentikasi dengan kredensial yang ditentukan
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'login' => ['The provided credentials are incorrect.'],
            ]);
        }
    
        $request->session()->regenerate();

    if ((auth()->user()->roles->pluck('name')[0]) == 'dokter') {
        return redirect()->intended(RouteServiceProvider::DOKTER);
    } else if ((auth()->user()->roles->pluck('name')[0]) == 'dokter fisioterapi'){
        return redirect()->intended(RouteServiceProvider::DOKTER_FISIO);
    }else if ((auth()->user()->roles->pluck('name')[0]) == 'perawat'){
        return redirect()->intended(RouteServiceProvider::PERAWAT);
    } else {
        return redirect()->intended(RouteServiceProvider::HOME);
    }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
