<?php

namespace App\Services;

use App\Repositories\Contracts\GaleriRepositoryInterface;

class GaleriService
{
    public function __construct(private GaleriRepositoryInterface $repo) {}

    public function getAll(int $perPage = 12)
    {
        return $this->repo->paginate($perPage);
    }
}
