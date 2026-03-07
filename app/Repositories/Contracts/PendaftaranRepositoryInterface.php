<?php

namespace App\Repositories\Contracts;

use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Collection;

interface PendaftaranRepositoryInterface
{
    public function getByUser(int $userId): Collection;
    public function findByUser(int $id, int $userId): ?Pendaftaran;
    public function create(array $data): Pendaftaran;
}
