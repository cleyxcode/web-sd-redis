<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function __construct(private ProfileService $service) {}

    public function show(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }

    public function updateInfo(Request $request): JsonResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'name'  => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'no_hp' => ['nullable', 'string', 'max:20'],
        ]);

        $this->service->updateInfo($user, $data);
        $user->refresh();

        return response()->json([
            'message' => 'Informasi akun berhasil diperbarui.',
            'user'    => $user,
        ]);
    }

    public function updatePassword(Request $request): JsonResponse
    {
        $request->validate([
            'current_password' => ['required'],
            'password'         => ['required', 'confirmed', Password::min(8)],
        ]);

        if (!Hash::check($request->current_password, $request->user()->password)) {
            return response()->json(['message' => 'Kata sandi saat ini tidak sesuai.'], 422);
        }

        $this->service->updatePassword($request->user(), $request->password);

        return response()->json(['message' => 'Kata sandi berhasil diperbarui.']);
    }
}
