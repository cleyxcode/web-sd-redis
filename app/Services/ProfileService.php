<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    public function __construct(private UserRepositoryInterface $users) {}

    public function updateInfo(User $user, array $data): bool
    {
        return $this->users->update($user, [
            'name'  => $data['name'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'] ?? null,
        ]);
    }

    public function updatePassword(User $user, string $password): bool
    {
        return $this->users->update($user, ['password' => $password]);
    }
}
