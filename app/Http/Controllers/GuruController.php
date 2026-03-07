<?php

namespace App\Http\Controllers;

use App\Models\Guru;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::where('status', 'aktif')->orderBy('nama')->get();

        return view('pages.guru', compact('gurus'));
    }
}
