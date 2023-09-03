<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.index');
    }

    public function postLogin(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'Username wajib diisi',
                'password.required' => 'Password wajib diisi',
            ]
        );
        // Mencoba untuk otentikasi pengguna
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // jika berhasil, cek role pengguna dan redirect ke dashboard yang sesuai
            $userRole = Auth::user()->role->role; // asumsi Anda memiliki relasi 'role' di model User

            switch ($userRole) {
                case 'admin':
                    return redirect('/admin/dashboard');
                case 'arsiparis':
                    return redirect('/arsiparis/dashboard');
                case 'pimpinan':
                    return redirect('/pimpinan/dashboard');
                default:
                    return redirect('/home'); // atau halaman default lainnya
            }
        }

        // Jika otentikasi gagal, kembali ke halaman login dengan pesan kesalahan
        return redirect()->back()->withErrors(['error' => 'Username atau password salah!']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
