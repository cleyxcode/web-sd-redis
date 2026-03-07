<?php

namespace App\Repositories\Eloquent;

use App\Models\Pendaftaran;
use App\Repositories\Contracts\PendaftaranRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PendaftaranRepository implements PendaftaranRepositoryInterface
{
    public function getByUser(int $userId): Collection
    {
        return Pendaftaran::where('user_id', $userId)
            ->with('infoPendaftaran')
            ->latest()
            ->get();
    }

    public function findByUser(int $id, int $userId): ?Pendaftaran
    {
        return Pendaftaran::where('user_id', $userId)
            ->with('infoPendaftaran')
            ->find($id);
    }

    public function create(array $data): Pendaftaran
    {
        return Pendaftaran::create($data);
    }
}
