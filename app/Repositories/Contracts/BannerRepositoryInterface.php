<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface BannerRepositoryInterface
{
    public function allAktif(): Collection;
}
