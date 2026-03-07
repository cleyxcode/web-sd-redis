<?php

namespace App\Repositories\Eloquent;

use App\Models\InfoPendaftaran;
use App\Repositories\Contracts\InfoPendaftaranRepositoryInterface;

class InfoPendaftaranRepository implements InfoPendaftaranRepositoryInterface
{
    public function getActive(): ?InfoPendaftaran
    {
        return InfoPendaftaran::where('status', 'aktif')->first();
    }
}
