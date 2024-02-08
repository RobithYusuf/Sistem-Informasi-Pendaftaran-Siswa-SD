<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
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
            // jika berhasil, redirect ke dashboard atau halaman yang diinginkan
            return redirect()->intended('/admin/dashboard');
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
