<?php

namespace App\Services;

use App\Models\OtpCode;
use App\Mail\OtpMail;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function __construct(private UserRepositoryInterface $users) {}

    public function register(array $data): array
    {
        $user = $this->users->create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => $data['password'],
            'no_hp'    => $data['no_hp'] ?? null,
            'role'     => 'orangtua',
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function login(array $credentials): array
    {
        $user = $this->users->findByEmail($credentials['email']);

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau kata sandi tidak sesuai.'],
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function logout(User $user): void
    {
        $user->currentAccessToken()->delete();
    }

    public function sendOtp(string $email): bool
    {
        $user = $this->users->findByEmail($email);
        if (!$user) return false;

        // Invalidate old OTPs
        OtpCode::where('email', $email)->update(['used' => true]);

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        OtpCode::create([
            'email'      => $email,
            'otp'        => $otp,
            'expires_at' => now()->addMinutes(10),
            'used'       => false,
        ]);

        $profil = \App\Models\ProfilSekolah::first();
        Mail::to($email)->send(new OtpMail($otp, $profil?->nama_sekolah ?? 'SD Negeri Warialau'));

        return true;
    }

    public function verifyOtp(string $email, string $otp): bool
    {
        $record = OtpCode::where('email', $email)
            ->where('used', false)
            ->latest()
            ->first();

        if (!$record || !$record->isValid($otp)) return false;

        $record->update(['used' => true]);

        return true;
    }

    public function resetPassword(string $email, string $password): bool
    {
        $user = $this->users->findByEmail($email);
        if (!$user) return false;

        return $this->users->update($user, ['password' => $password]);
    }
}
