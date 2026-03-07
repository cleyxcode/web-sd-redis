<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProfilSekolahService;
use Illuminate\Http\JsonResponse;

class ProfilSekolahController extends Controller
{
    public function __construct(private ProfilSekolahService $service) {}

    public function profil(): JsonResponse
    {
        return response()->json($this->service->getProfil());
    }

    public function banner(): JsonResponse
    {
        return response()->json($this->service->getBanner());
    }
}
