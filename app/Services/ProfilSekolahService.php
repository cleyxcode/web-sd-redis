<?php

namespace App\Services;

use App\Repositories\Contracts\BannerRepositoryInterface;
use App\Repositories\Contracts\ProfilSekolahRepositoryInterface;

class ProfilSekolahService
{
    public function __construct(
        private ProfilSekolahRepositoryInterface $profilRepo,
        private BannerRepositoryInterface $bannerRepo,
    ) {}

    public function getProfil()
    {
        return $this->profilRepo->get();
    }

    public function getBanner()
    {
        return $this->bannerRepo->allAktif();
    }
}
