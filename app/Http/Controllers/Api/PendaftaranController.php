<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PendaftaranService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function __construct(private PendaftaranService $service) {}

    public function infoAktif(): JsonResponse
    {
        $info = $this->service->getInfoAktif();

        if (!$info) {
            return response()->json(['message' => 'Pendaftaran sedang tidak dibuka.'], 404);
        }

        return response()->json($info);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nama_anak'      => ['required', 'string', 'max:255'],
            'tempat_lahir'   => ['nullable', 'string', 'max:255'],
            'tanggal_lahir'  => ['required', 'date'],
            'jenis_kelamin'  => ['required', 'in:L,P'],
            'agama'          => ['required', 'string', 'max:100'],
            'anak_ke'        => ['nullable', 'integer', 'min:1'],
            'asal_sekolah'   => ['nullable', 'string', 'max:255'],
            'nik'            => ['nullable', 'string', 'max:20'],
            'no_kk'          => ['nullable', 'string', 'max:20'],
            'alamat'         => ['required', 'string'],
            'nama_ayah'      => ['nullable', 'string', 'max:255'],
            'pekerjaan_ayah' => ['nullable', 'string', 'max:255'],
            'nama_ibu'       => ['nullable', 'string', 'max:255'],
            'pekerjaan_ibu'  => ['nullable', 'string', 'max:255'],
            'nama_wali'      => ['nullable', 'string', 'max:255'],
            'no_hp'          => ['required', 'string', 'max:20'],
            'dokumen'        => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
        ]);

        $pendaftaran = $this->service->submit(
            $request->user(),
            $data,
            $request->file('dokumen')
        );

        if (!$pendaftaran) {
            return response()->json(['message' => 'Pendaftaran sedang tidak dibuka.'], 422);
        }

        return response()->json([
            'message'     => 'Pendaftaran berhasil diajukan.',
            'pendaftaran' => $pendaftaran,
        ], 201);
    }

    public function riwayat(Request $request): JsonResponse
    {
        $data = $this->service->getRiwayat($request->user());

        return response()->json($data);
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $item = $this->service->getDetail($request->user(), $id);

        if (!$item) {
            return response()->json(['message' => 'Data tidak ditemukan.'], 404);
        }

        return response()->json($item);
    }
}
