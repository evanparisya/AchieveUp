<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifikasiPrestasiController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Prestasi',
            'list' => ['Home', 'User']
        ];

        $page = (object)[
            'title' => 'Daftar prestasi yang diajukan'
        ];

        $activeMenu = 'prestasi';

        if ($request->ajax()) {
            return view('prestasi.partial-index', compact('breadcrumb', 'page', 'activeMenu'));
        }

        return view('admin.prestasi.index', compact('breadcrumb', 'page', 'activeMenu'));
    }
}
