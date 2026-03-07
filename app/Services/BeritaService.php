<?php

namespace App\Services;

use App\Repositories\Contracts\BeritaRepositoryInterface;

class BeritaService
{
    public function __construct(private BeritaRepositoryInterface $repo) {}

    public function getAll(int $perPage = 10)
    {
        return $this->repo->paginate($perPage);
    }

    public function getById(int $id)
    {
        return $this->repo->find($id);
    }

    public function getLatest(int $limit = 5)
    {
        return $this->repo->latest($limit);
    }
}
