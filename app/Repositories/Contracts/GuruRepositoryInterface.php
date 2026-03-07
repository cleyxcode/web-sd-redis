<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface GuruRepositoryInterface
{
    public function allAktif(): Collection;
}
