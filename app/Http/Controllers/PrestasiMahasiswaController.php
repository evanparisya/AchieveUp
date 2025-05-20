<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        if ($request->ajax()) {
            return view('prestasi.partial-index', compact('breadcrumb', 'page', 'activeMenu'));
        }

        return view('mahasiswa.prestasi.index', compact('breadcrumb', 'page', 'activeMenu'));
    }
}
