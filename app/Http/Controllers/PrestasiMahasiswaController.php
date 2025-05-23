<?php

namespace App\Http\Controllers;

use App\Models\PrestasiMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function getData()
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();

        $prestasi = PrestasiMahasiswa::whereHas('mahasiswas', function ($q) use ($mahasiswa) {
            $q->where('mahasiswa_id', $mahasiswa->id);
        })
            ->select('id', 'judul', 'tingkat', 'juara', 'status', 'tanggal_pengajuan')
            ->latest()
            ->get();

        return response()->json($prestasi);
    }
}
