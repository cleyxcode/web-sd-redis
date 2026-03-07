<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\InfoPendaftaranRepositoryInterface;
use App\Repositories\Contracts\PendaftaranRepositoryInterface;
use Illuminate\Http\UploadedFile;

class PendaftaranService
{
    public function __construct(
        private PendaftaranRepositoryInterface $repo,
        private InfoPendaftaranRepositoryInterface $infoRepo,
    ) {}

    public function getInfoAktif()
    {
        return $this->infoRepo->getActive();
    }

    public function getRiwayat(User $user)
    {
        return $this->repo->getByUser($user->id);
    }

    public function getDetail(User $user, int $id)
    {
        return $this->repo->findByUser($id, $user->id);
    }

    public function submit(User $user, array $data, ?UploadedFile $dokumen = null)
    {
        $info = $this->infoRepo->getActive();

        if (!$info) {
            return null;
        }

        $dokumenPath = null;
        if ($dokumen) {
            $dokumenPath = $dokumen->store('pendaftaran', 'public');
        }

        return $this->repo->create([
            'user_id'             => $user->id,
            'info_pendaftaran_id' => $info->id,
            'nama_anak'           => $data['nama_anak'],
            'tempat_lahir'        => $data['tempat_lahir'] ?? null,
            'tanggal_lahir'       => $data['tanggal_lahir'],
            'jenis_kelamin'       => $data['jenis_kelamin'],
            'agama'               => $data['agama'],
            'anak_ke'             => $data['anak_ke'] ?? null,
            'asal_sekolah'        => $data['asal_sekolah'] ?? null,
            'nik'                 => $data['nik'] ?? null,
            'no_kk'               => $data['no_kk'] ?? null,
            'alamat'              => $data['alamat'],
            'nama_ayah'           => $data['nama_ayah'] ?? null,
            'pekerjaan_ayah'      => $data['pekerjaan_ayah'] ?? null,
            'nama_ibu'            => $data['nama_ibu'] ?? null,
            'pekerjaan_ibu'       => $data['pekerjaan_ibu'] ?? null,
            'nama_wali'           => $data['nama_wali'] ?? null,
            'no_hp'               => $data['no_hp'],
            'dokumen'             => $dokumenPath,
            'status'              => 'pending',
        ]);
    }
}
