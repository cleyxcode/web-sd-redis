<?php

namespace App\Repositories\Eloquent;

use App\Models\ProfilSekolah;
use App\Repositories\Contracts\ProfilSekolahRepositoryInterface;

class ProfilSekolahRepository implements ProfilSekolahRepositoryInterface
{
    public function get(): ?ProfilSekolah
    {
        return ProfilSekolah::first();
    }
}
