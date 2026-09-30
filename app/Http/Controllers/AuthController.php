<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman/form login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Memproses autentikasi pengguna (Login).
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'login_key'  => 'required|string',
            'kata_sandi' => 'required|string',
        ], [
            'login_key.required'  => 'Email atau Nama Pengguna wajib diisi.',
            'kata_sandi.required' => 'Kata sandi wajib diisi.',
        ]);

        // 2. Tentukan login menggunakan Email atau Nama Pengguna
        $fieldType = filter_var($request->login_key, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'nama_pengguna';

        // 3. Susun kredensial
        $authData = [
            $fieldType => $request->login_key,
            'password' => $request->kata_sandi,
            'status'   => 'aktif',
        ];

        // 4. Eksekusi Login
        if (Auth::attempt($authData, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.home')
                    ->with('success', 'Selamat datang kembali, ' . Auth::user()->nama . '!');
            }

            if (Auth::user()->role === 'karyawan') {
                return redirect()->route('home')
                    ->with('success', 'Selamat datang, ' . Auth::user()->nama . '!');
            }

            // Jika role tidak dikenali
            Auth::logout();

            return redirect()->route('login')
                ->withErrors([
                    'login_key' => 'Role pengguna tidak dikenali.',
                ]);
        }

        // 5. Jika gagal login
        return back()->withErrors([
            'login_key' => 'Kredensial yang diberikan tidak cocok atau akun Anda sedang nonaktif.',
        ])->onlyInput('login_key');
    }

    /**
     * Memproses logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Anda telah berhasil keluar.');
    }
}