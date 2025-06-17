<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:warga',
        'password' => 'required|string|min:8|confirmed',
        'no_hp' => 'required|string|max:15',
        'alamat' => 'required|string'
    ]);

    $warga = Warga::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'no_hp' => $request->no_hp,
        'alamat' => $request->alamat
    ]);

    // Kirim email verifikasi
    event(new Registered($warga));
    Auth::guard('warga')->login($warga);

    return redirect()->route('verification.notice')
        ->with('show_verification_popup', true)
        ->with('registered_email', $warga->email);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Login sebagai admin
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        // Login sebagai warga
        if (Auth::guard('warga')->attempt($credentials)) {
            $request->session()->regenerate();

            // Jika belum verifikasi email
            if (!Auth::guard('warga')->user()->hasVerifiedEmail()) {
                return redirect()->route('verification.notice');
            }

            return redirect()->route('warga.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak cocok dengan data kami.',
        ]);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('warga')->check()) {
            Auth::guard('warga')->logout();
        } elseif (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT');
    }
}
