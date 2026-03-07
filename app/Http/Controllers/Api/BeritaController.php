<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BeritaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function __construct(private BeritaService $service) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->get('per_page', 10);
        $data    = $this->service->getAll($perPage);

        return response()->json($data);
    }

    public function show(int $id): JsonResponse
    {
        $berita = $this->service->getById($id);

        if (!$berita) {
            return response()->json(['message' => 'Berita tidak ditemukan.'], 404);
        }

        return response()->json($berita);
    }
}
