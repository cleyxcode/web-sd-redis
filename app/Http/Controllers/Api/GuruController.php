<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GuruService;
use Illuminate\Http\JsonResponse;

class GuruController extends Controller
{
    public function __construct(private GuruService $service) {}

    public function index(): JsonResponse
    {
        return response()->json($this->service->getAll());
    }
}
