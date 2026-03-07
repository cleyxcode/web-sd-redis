<?php

namespace App\Repositories\Eloquent;

use App\Models\Banner;
use App\Repositories\Contracts\BannerRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BannerRepository implements BannerRepositoryInterface
{
    public function allAktif(): Collection
    {
        return Banner::where('status', 'aktif')->orderBy('urutan')->get();
    }
}
