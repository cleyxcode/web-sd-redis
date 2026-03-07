<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\OtpCode;
use App\Models\ProfilSekolah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    // ── Step 1: Tampilkan form email ──────────────────────────────
    public function showForm()
    {
        return view('auth.forgot-password');
    }

    // ── Step 2: Kirim OTP ke email ────────────────────────────────
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.exists'   => 'Email tidak terdaftar dalam sistem kami.',
        ]);

        $email = $request->email;

        // Hapus OTP lama yang belum digunakan untuk email ini
        OtpCode::where('email', $email)->delete();

        // Buat OTP 6 digit
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        OtpCode::create([
            'email'      => $email,
            'otp'        => $otp,
            'expires_at' => now()->addMinutes(10),
            'used'       => false,
        ]);

        $profil = ProfilSekolah::first();

        Mail::to($email)->send(new OtpMail($otp, $profil->nama_sekolah ?? 'SD Negeri Warialau'));

        // Simpan email di session untuk step berikutnya
        session(['otp_email' => $email]);

        return redirect()->route('password.verify')
            ->with('info', 'Kode OTP telah dikirim ke ' . $email . '. Periksa inbox atau folder spam Anda.');
    }

    // ── Step 3: Tampilkan form OTP ────────────────────────────────
    public function showVerify()
    {
        if (!session('otp_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.verify-otp', [
            'email' => session('otp_email'),
        ]);
    }

    // ── Step 4: Verifikasi OTP ────────────────────────────────────
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ], [
            'otp.required' => 'Kode OTP wajib diisi.',
            'otp.size'     => 'Kode OTP harus 6 digit.',
        ]);

        $email = session('otp_email');

        if (!$email) {
            return redirect()->route('password.request')
                ->withErrors(['otp' => 'Sesi habis. Mulai ulang proses reset.']);
        }

        $otpRecord = OtpCode::where('email', $email)
            ->where('used', false)
            ->latest()
            ->first();

        if (!$otpRecord || !$otpRecord->isValid($request->otp)) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kedaluwarsa.']);
        }

        // Tandai OTP sebagai sudah digunakan
        $otpRecord->update(['used' => true]);

        // Simpan token reset di session
        session(['reset_verified_email' => $email]);
        session()->forget('otp_email');

        return redirect()->route('password.reset.form');
    }

    // ── Step 5: Tampilkan form reset password ─────────────────────
    public function showReset()
    {
        if (!session('reset_verified_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password', [
            'email' => session('reset_verified_email'),
        ]);
    }

    // ── Step 6: Update password ────────────────────────────────────
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.required'  => 'Kata sandi baru wajib diisi.',
            'password.min'       => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $email = session('reset_verified_email');

        if (!$email) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Sesi habis. Mulai ulang proses reset.']);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('password.request');
        }

        $user->update(['password' => Hash::make($request->password)]);

        session()->forget('reset_verified_email');

        return redirect()->route('login')
            ->with('success', 'Kata sandi berhasil diubah! Silakan masuk dengan kata sandi baru Anda.');
    }

    // ── Kirim ulang OTP ────────────────────────────────────────────
    public function resendOtp(Request $request)
    {
        $email = session('otp_email');

        if (!$email) {
            return redirect()->route('password.request');
        }

        // Cek cooldown: jangan kirim ulang jika OTP terakhir dibuat < 60 detik lalu
        $last = OtpCode::where('email', $email)->latest()->first();
        if ($last && $last->created_at->diffInSeconds(now()) < 60) {
            return back()->withErrors(['otp' => 'Tunggu ' . (60 - $last->created_at->diffInSeconds(now())) . ' detik sebelum kirim ulang.']);
        }

        OtpCode::where('email', $email)->delete();

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        OtpCode::create([
            'email'      => $email,
            'otp'        => $otp,
            'expires_at' => now()->addMinutes(10),
            'used'       => false,
        ]);

        $profil = ProfilSekolah::first();
        Mail::to($email)->send(new OtpMail($otp, $profil->nama_sekolah ?? 'SD Negeri Warialau'));

        return back()->with('info', 'Kode OTP baru telah dikirim ke ' . $email . '.');
    }
}
