<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use App\Models\Setting;

class ProfilController extends Controller
{
    public function index()
    {
        $profil   = ProfilSekolah::first();
        $settings = Setting::all()->pluck('value', 'key');

        return view('pages.profil', compact('profil', 'settings'));
    }
}
