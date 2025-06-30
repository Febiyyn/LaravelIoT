<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function viewLogin(){
        return view('auth.login');
    }

    public function viewRegister(){
        return view('auth.register');
    }
    public function register(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Login pengguna setelah registrasi
        Auth::login($user);

        // Redirect ke halaman index
        return redirect('/sensor');
    }

    public function viewChangePassword(){
        return view('auth.ganti-password');
    }

    public function ChangePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required',
        ], [
            'current_password.required' => "Password lama harus diisi",
            'password.required' => "Password baru harus diisi",
        ]);

        $currentUser = User::where('id', Auth::user()->id)->first();

        // Periksa apakah user ditemukan
        if (!$currentUser) {
            return redirect('/ganti-password')->with('danger', "Gagal mengubah password. User tidak ditemukan.");
        }

        $currentPassword = $currentUser->password;
        $currentPasswordIsSame = Hash::check($request->current_password, $currentPassword);

        if ($currentPasswordIsSame) {
            $update = $currentUser->update([
                "name" => Auth::user()->name,
                "role" => Auth::user()->role,
                "email" => Auth::user()->email,
                // Yang diupdate hanya password
                "password" => Hash::make($request->password),
            ]);

            if ($update) {
                return redirect('/ganti-password')->with('success', "Berhasil mengubah password");
            }
        }
        return redirect('/ganti-password')->with('danger', "Gagal mengubah password");
    }
}
