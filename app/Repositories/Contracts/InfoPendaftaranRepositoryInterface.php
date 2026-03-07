<?php

namespace App\Repositories\Contracts;

use App\Models\InfoPendaftaran;

interface InfoPendaftaranRepositoryInterface
{
    public function getActive(): ?InfoPendaftaran;
}
