<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfilAkunController extends Controller
{
    public function index()
    {
        return view('pages.profil-akun');
    }

    public function updateInfo(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'no_hp' => ['nullable', 'string', 'max:20'],
        ], [
            'name.required'  => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah digunakan akun lain.',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);

        return back()->with('success_info', 'Informasi akun berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      => ['required'],
            'password'              => ['required', 'confirmed', Password::min(8)],
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'password.required'         => 'Kata sandi baru wajib diisi.',
            'password.confirmed'        => 'Konfirmasi kata sandi tidak cocok.',
            'password.min'              => 'Kata sandi minimal 8 karakter.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak sesuai.'])->with('tab', 'password');
        }

        $user->update(['password' => $request->password]);

        return back()->with('success_password', 'Kata sandi berhasil diperbarui.')->with('tab', 'password');
    }
}
