<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DosenPembimbingRekomendasi;
use Illuminate\Http\Request;
use App\Models\Lomba;
use App\Models\Mahasiswa;
use App\Models\MahasiswaRekomendasi;
use App\Models\RekomendasiLomba;
use App\Services\Aras;
use App\Services\Electre;
use App\Services\Entrophy;
use Illuminate\Support\Carbon;

class NotifikasiMahasiswa extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Semua Notifikasi',
            'list' => ['Notifikasi']
        ];

        $page = (object)[
            'title' => 'Semua Notifikasi'
        ];

        $activeMenu = '';

        $pesan = $this->getAllRekomendasi();

        return view('mahasiswa.notifikasi.index', compact('breadcrumb', 'page', 'activeMenu', 'pesan'));
    }

    public function show($id)
    {
        // Ambil semua mahasiswa yang direkomendasikan pada rekomendasi lomba ini
        $mahasiswaRekom = MahasiswaRekomendasi::with('mahasiswa')->findOrFail($id);
        // dd($mahasiswaRekom);

        // Ambil data rekomendasi lomba beserta lomba dan bidangnya
        $rekomendasi = RekomendasiLomba::with('lomba.bidang')
            ->where('id', $mahasiswaRekom->rekomendasi_lomba_id)
            ->first();

        // Jika rekomendasi tidak ditemukan, tampilkan 404
        if (!$rekomendasi) {
            abort(404, 'Rekomendasi lomba tidak ditemukan atau lomba tidak aktif.');
        }

        $mahasiswa = MahasiswaRekomendasi::with('mahasiswa')
            ->where('rekomendasi_lomba_id', $rekomendasi->id)
            ->get();

        // Ambil dosen pembimbing yang terkait dengan rekomendasi ini
        $dosen = DosenPembimbingRekomendasi::with('dosen')
            ->where('rekomendasi_lomba_id', $rekomendasi->id)
            ->get();

        $breadcrumb = (object)[
            'title' => 'Detail Notifikasi',
            'list' => ['Notifikasi', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail Notifikasi'
        ];

        $activeMenu = '';

        // Tampilkan view detail notifikasi (bukan index)
        return view('mahasiswa.notifikasi.detail', compact(
            'breadcrumb',
            'page',
            'activeMenu',
            'rekomendasi',
            'mahasiswa',
            'dosen',
            'mahasiswaRekom'
        ));
    }


    public function getAllRekomendasi()
    {
        // Ambil mahasiswa yang sedang login
        $mahasiswa = Mahasiswa::where('id', auth('mahasiswa')->id())->first();
        // dd($mahasiswa);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa tidak ditemukan.'
            ], 404);
        }

        // Ambil semua rekomendasi untuk mahasiswa ini
        $rekomendasi = MahasiswaRekomendasi::with(['rekomendasiLomba.lomba.bidang'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->latest()
            ->get()
            ->map(function ($item) {
                $rekom = $item->rekomendasiLomba;
                $lomba = $rekom ? $rekom->lomba : null;

                $isAccepted = $item->is_accepted;
                $pesan = $isAccepted == 0 ? 'Rekomendasi Lomba Terbaru' : 'Rekomendasi Lomba';

                return [
                    'id' => $item->id,
                    'rekomendasi_id' => $rekom->id ?? null,
                    'lomba_id' => $lomba->id ?? null,
                    'judul' => $lomba->judul ?? '-',
                    'tempat' => $lomba->tempat ?? '-',
                    'periode_pendaftaran' => $lomba
                        ? (Carbon::parse($lomba->tanggal_daftar)->format('d M Y') . ' s.d. ' . Carbon::parse($lomba->tanggal_daftar_terakhir)->format('d M Y'))
                        : '-',
                    'tingkat' => $lomba->tingkat ?? '-',
                    'bidang' => $lomba && $lomba->bidang
                        ? $lomba->bidang->map(function ($b) {
                            return [
                                'id' => $b->id,
                                'kode' => $b->kode,
                                'nama' => $b->nama
                            ];
                        })->values()
                        : [],
                    'pesan' => $pesan,
                    'note' => $item->note,
                    'is_accepted' => $isAccepted,
                    'created_at' => $item->created_at ? $item->created_at->format('d-m-Y H:i') : null,
                    'status' => $lomba && $lomba->is_active ? 'Aktif' : 'Tidak Aktif',
                ];
            });
        // dd($rekomendasi);

        return response()->json([
            'success' => true,
            'data' => $rekomendasi
        ]);
    }

    public function markAsRead(Request $request)
    {
        $id = $request->input('id');
        $mahasiswaId = auth('mahasiswa')->id();

        $notif = MahasiswaRekomendasi::where('id', $id)
            ->where('mahasiswa_id', $mahasiswaId)
            ->first();

        if (!$notif) {
            return response()->json([
                'success' => false,
                'message' => 'Notifikasi tidak ditemukan.'
            ], 404);
        }

        if (!$notif->is_accepted) {
            $notif->is_accepted = true;
            $notif->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi telah ditandai sebagai dibaca.'
        ]);
    }

    public function markAllAsRead()
    {
        $mahasiswaId = auth('mahasiswa')->id();

        $updated = MahasiswaRekomendasi::where('mahasiswa_id', $mahasiswaId)
            ->where('is_accepted', false)
            ->update(['is_accepted' => true]);

        return response()->json([
            'success' => true,
            'updated_count' => $updated,
            'message' => 'Semua notifikasi telah ditandai sebagai dibaca.'
        ]);
    }

    public function destroy($id)
    {
        $mahasiswaId = auth('mahasiswa')->id();

        // Cari notifikasi berdasarkan id dan mahasiswa yang sedang login
        $notif = MahasiswaRekomendasi::where('id', $id)
            ->where('mahasiswa_id', $mahasiswaId)
            ->first();

        if (!$notif) {
            return response()->json([
                'success' => false,
                'message' => 'Notifikasi tidak ditemukan.'
            ], 404);
        }

        try {
            $notif->delete();
            return response()->json([
                'success' => true,
                'message' => 'Notifikasi berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus notifikasi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroyIsAccpeptedMessege()
    {
        $mahasiswaId = auth('mahasiswa')->id();

        // Hapus semua notifikasi yang sudah dibaca (is_accepted = true) milik mahasiswa yang sedang login
        $deleted = MahasiswaRekomendasi::where('mahasiswa_id', $mahasiswaId)
            ->where('is_accepted', true)
            ->delete();

        return response()->json([
            'success' => true,
            'deleted_count' => $deleted,
            'message' => 'Semua notifikasi yang sudah dibaca berhasil dihapus.'
        ]);
    }
}
