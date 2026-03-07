<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct(private AuthService $service) {}

    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'                  => ['required', 'string', 'max:100'],
            'email'                 => ['required', 'email', 'unique:users,email'],
            'password'              => ['required', 'confirmed', Password::min(8)],
            'no_hp'                 => ['nullable', 'string', 'max:20'],
        ]);

        $result = $this->service->register($data);

        return response()->json([
            'message' => 'Registrasi berhasil.',
            'user'    => $result['user'],
            'token'   => $result['token'],
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        try {
            $result = $this->service->login($data);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Email atau kata sandi salah.'], 401);
        }

        return response()->json([
            'message' => 'Login berhasil.',
            'user'    => $result['user'],
            'token'   => $result['token'],
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $this->service->logout($request->user());

        return response()->json(['message' => 'Logout berhasil.']);
    }

    public function sendOtp(Request $request): JsonResponse
    {
        $request->validate(['email' => ['required', 'email']]);

        $sent = $this->service->sendOtp($request->email);

        if (!$sent) {
            return response()->json(['message' => 'Email tidak terdaftar.'], 404);
        }

        return response()->json(['message' => 'Kode OTP telah dikirim ke email Anda.']);
    }

    public function verifyOtp(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp'   => ['required', 'string', 'size:6'],
        ]);

        $valid = $this->service->verifyOtp($request->email, $request->otp);

        if (!$valid) {
            return response()->json(['message' => 'Kode OTP tidak valid atau sudah kedaluwarsa.'], 422);
        }

        return response()->json([
            'message'          => 'OTP valid. Silakan buat kata sandi baru.',
            'reset_email'      => $request->email,
        ]);
    }

    public function resetPassword(Request $request): JsonResponse
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $reset = $this->service->resetPassword($request->email, $request->password);

        if (!$reset) {
            return response()->json(['message' => 'Email tidak ditemukan.'], 404);
        }

        return response()->json(['message' => 'Kata sandi berhasil diperbarui.']);
    }
}
