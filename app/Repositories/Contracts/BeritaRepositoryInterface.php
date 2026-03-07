<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Berita;

interface BeritaRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function find(int $id): ?Berita;
    public function latest(int $limit = 5): \Illuminate\Database\Eloquent\Collection;
}
