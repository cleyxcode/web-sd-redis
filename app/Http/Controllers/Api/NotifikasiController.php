<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    /**
     * GET /api/v1/notifikasi
     * Daftar notifikasi milik user yang sedang login, terbaru di atas.
     */
    public function index(Request $request)
    {
        $notifikasi = Notifikasi::where('user_id', $request->user()->id)
            ->latest()
            ->paginate(20);

        return response()->json($notifikasi);
    }

    /**
     * GET /api/v1/notifikasi/unread-count
     * Jumlah notifikasi yang belum dibaca (untuk badge di icon notifikasi).
     */
    public function unreadCount(Request $request)
    {
        $count = Notifikasi::where('user_id', $request->user()->id)
            ->where('dibaca', false)
            ->count();

        return response()->json(['unread' => $count]);
    }

    /**
     * PATCH /api/v1/notifikasi/{id}/baca
     * Tandai satu notifikasi sebagai sudah dibaca.
     */
    public function baca(Request $request, $id)
    {
        $notifikasi = Notifikasi::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $notifikasi->update(['dibaca' => true]);

        return response()->json(['message' => 'Notifikasi ditandai sudah dibaca.']);
    }

    /**
     * PATCH /api/v1/notifikasi/baca-semua
     * Tandai semua notifikasi sebagai sudah dibaca.
     */
    public function bacaSemua(Request $request)
    {
        Notifikasi::where('user_id', $request->user()->id)
            ->where('dibaca', false)
            ->update(['dibaca' => true]);

        return response()->json(['message' => 'Semua notifikasi ditandai sudah dibaca.']);
    }
}
