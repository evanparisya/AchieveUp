<?php

namespace App\Http\Controllers;

use App\Models\PrestasiMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PrestasiMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Prestasi',
            'list' => ['Home', 'User']
        ];

        $page = (object)[
            'title' => 'Daftar prestasi yang terdaftar dalam sistem'
        ];

        $activeMenu = 'prestasi';

        return view('mahasiswa.prestasi.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function getData(Request $request)
    {
        $mahasiswaId = Auth::guard('mahasiswa')->id();
        if (!$mahasiswaId) {
            return response()->json([], 401);
        }

        $prestasi = PrestasiMahasiswa::whereHas('mahasiswas', function ($query) use ($mahasiswaId) {
            $query->where('mahasiswa_id', $mahasiswaId);
        })->select('id', 'judul', 'tingkat', 'juara', 'status', 'tanggal_pengajuan')
            ->latest()
            ->get();

        return response()->json($prestasi);
    }
}
