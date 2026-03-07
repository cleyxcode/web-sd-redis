<?php

namespace App\Repositories\Eloquent;

use App\Models\Guru;
use App\Repositories\Contracts\GuruRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GuruRepository implements GuruRepositoryInterface
{
    public function allAktif(): Collection
    {
        return Guru::where('status', 'aktif')->orderBy('nama')->get();
    }
}
