<?php

namespace App\Http\Controllers;

use App\Models\InfoPendaftaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranPublikController extends Controller
{
    public function index()
    {
        $infoPendaftaran = InfoPendaftaran::where('status', 'aktif')->first();
        $isGuest = !auth()->check();

        return view('pages.pendaftaran.index', compact('infoPendaftaran', 'isGuest'));
    }

    public function store(Request $request)
    {
        $infoPendaftaran = InfoPendaftaran::where('status', 'aktif')->firstOrFail();

        $validated = $request->validate([
            'nama_anak'      => 'required|string|max:255',
            'tempat_lahir'   => 'nullable|string|max:255',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|in:L,P',
            'agama'          => 'required|string|max:100',
            'anak_ke'        => 'nullable|integer|min:1',
            'asal_sekolah'   => 'nullable|string|max:255',
            'nik'            => 'nullable|string|max:20',
            'no_kk'          => 'nullable|string|max:20',
            'alamat'         => 'required|string',
            'nama_ayah'      => 'nullable|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'nama_ibu'       => 'nullable|string|max:255',
            'pekerjaan_ibu'  => 'nullable|string|max:255',
            'nama_wali'      => 'nullable|string|max:255',
            'no_hp'          => 'required|string|max:20',
            'dokumen'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'nama_anak.required'     => 'Nama anak wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'agama.required'         => 'Agama wajib diisi.',
            'alamat.required'        => 'Alamat wajib diisi.',
            'no_hp.required'         => 'Nomor HP wajib diisi.',
        ]);

        // Upload dokumen
        $dokumenPath = null;
        if ($request->hasFile('dokumen')) {
            $dokumenPath = $request->file('dokumen')->store('pendaftaran', 'public');
        }

        Pendaftaran::create([
            'user_id'              => auth()->id(),
            'info_pendaftaran_id'  => $infoPendaftaran->id,
            'nama_anak'            => $validated['nama_anak'],
            'tempat_lahir'         => $validated['tempat_lahir'],
            'tanggal_lahir'        => $validated['tanggal_lahir'],
            'jenis_kelamin'        => $validated['jenis_kelamin'],
            'agama'                => $validated['agama'],
            'anak_ke'              => $validated['anak_ke'],
            'asal_sekolah'         => $validated['asal_sekolah'],
            'nik'                  => $validated['nik'],
            'no_kk'                => $validated['no_kk'],
            'alamat'               => $validated['alamat'],
            'nama_ayah'            => $validated['nama_ayah'],
            'pekerjaan_ayah'       => $validated['pekerjaan_ayah'],
            'nama_ibu'             => $validated['nama_ibu'],
            'pekerjaan_ibu'        => $validated['pekerjaan_ibu'],
            'nama_wali'            => $validated['nama_wali'],
            'no_hp'                => $validated['no_hp'],
            'dokumen'              => $dokumenPath,
            'status'               => 'pending',
        ]);

        return redirect()->route('pendaftaran.sukses')
            ->with('nama_anak', $validated['nama_anak'])
            ->with('no_hp', $validated['no_hp']);
    }

    public function sukses()
    {
        return view('pages.pendaftaran.sukses');
    }

    public function riwayat()
    {
        $pendaftaran = Pendaftaran::where('user_id', auth()->id())
            ->with('infoPendaftaran')
            ->latest()
            ->get();

        return view('pages.pendaftaran.riwayat', compact('pendaftaran'));
    }

    public function detail($id)
    {
        $item = Pendaftaran::where('user_id', auth()->id())
            ->with('infoPendaftaran')
            ->findOrFail($id);

        return view('pages.pendaftaran.detail', compact('item'));
    }
}
