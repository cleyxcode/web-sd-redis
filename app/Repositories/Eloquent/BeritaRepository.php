<?php

namespace App\Repositories\Eloquent;

use App\Models\Berita;
use App\Repositories\Contracts\BeritaRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BeritaRepository implements BeritaRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Berita::where('status', 'publish')
            ->latest('tanggal_publish')
            ->paginate($perPage);
    }

    public function find(int $id): ?Berita
    {
        return Berita::where('status', 'publish')->find($id);
    }

    public function latest(int $limit = 5): Collection
    {
        return Berita::where('status', 'publish')
            ->latest('tanggal_publish')
            ->limit($limit)
            ->get();
    }
}
