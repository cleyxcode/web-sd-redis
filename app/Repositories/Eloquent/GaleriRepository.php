<?php

namespace App\Repositories\Eloquent;

use App\Models\Galeri;
use App\Repositories\Contracts\GaleriRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GaleriRepository implements GaleriRepositoryInterface
{
    public function paginate(int $perPage = 12): LengthAwarePaginator
    {
        return Galeri::latest()->paginate($perPage);
    }
}
