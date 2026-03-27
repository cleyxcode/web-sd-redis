<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Siswa extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $table = 'siswa';

    protected $fillable = [
        'nama',
        'nis',
        'kelas',
        'jenis_kelamin',
        'tahun_ajaran',
        'foto',
        'status',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('foto')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->width(150)->height(150)->nonQueued();

        $this->addMediaConversion('preview')
            ->width(400)->height(400)->nonQueued();
    }
}
