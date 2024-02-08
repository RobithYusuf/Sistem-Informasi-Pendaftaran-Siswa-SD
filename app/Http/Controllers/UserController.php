<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showProfileForm()
    {
        return view('admin.user.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . Auth::user()->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->nama = $request->input('nama');
        $user->username = $request->input('username');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('profile.form')->with('success', 'Profil berhasil diperbarui.');
    }
}
