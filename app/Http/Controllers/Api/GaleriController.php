<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GaleriService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function __construct(private GaleriService $service) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->get('per_page', 12);

        return response()->json($this->service->getAll($perPage));
    }
}
