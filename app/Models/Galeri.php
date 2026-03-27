<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Galeri extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $table = 'galeri';

    protected $fillable = [
        'user_id',
        'judul',
        'foto',
        'keterangan',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
