<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->query('kategori');

        $query = Berita::where('status', 'publish')->latest('tanggal_publish');

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        $beritas    = $query->paginate(9)->withQueryString();
        $kategoris  = Berita::where('status', 'publish')
                        ->whereNotNull('kategori')
                        ->distinct()
                        ->pluck('kategori');

        return view('pages.berita.index', compact('beritas', 'kategoris', 'kategori'));
    }

    public function show($id)
    {
        $berita  = Berita::where('status', 'publish')->findOrFail($id);
        $lainnya = Berita::where('status', 'publish')
                    ->where('id', '!=', $id)
                    ->latest('tanggal_publish')
                    ->take(3)
                    ->get();

        return view('pages.berita.show', compact('berita', 'lainnya'));
    }
}
