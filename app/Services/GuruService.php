<?php

namespace App\Services;

use App\Repositories\Contracts\GuruRepositoryInterface;

class GuruService
{
    public function __construct(private GuruRepositoryInterface $repo) {}

    public function getAll()
    {
        return $this->repo->allAktif();
    }
}
