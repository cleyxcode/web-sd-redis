<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Pendaftaran extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'user_id',
        'info_pendaftaran_id',
        'nama_anak',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'anak_ke',
        'asal_sekolah',
        'nik',
        'no_kk',
        'alamat',
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'nama_wali',
        'no_hp',
        'dokumen',
        'status',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('dokumen')
            ->singleFile();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function infoPendaftaran()
    {
        return $this->belongsTo(InfoPendaftaran::class);
    }
}
