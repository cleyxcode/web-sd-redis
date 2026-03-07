<?php

namespace App\Repositories\Contracts;

use App\Models\ProfilSekolah;

interface ProfilSekolahRepositoryInterface
{
    public function get(): ?ProfilSekolah;
}
