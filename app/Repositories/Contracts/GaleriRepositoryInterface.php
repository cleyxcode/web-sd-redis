<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface GaleriRepositoryInterface
{
    public function paginate(int $perPage = 12): LengthAwarePaginator;
}
