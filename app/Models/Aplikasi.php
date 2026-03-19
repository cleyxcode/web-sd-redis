<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aplikasi extends Model
{
    protected $table = 'aplikasi';

    protected $fillable = [
        'nama_aplikasi',
        'versi',
        'deskripsi',
        'link_download',
        'ukuran_file',
        'status',
    ];
}
