<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = (object)[
            'title' => 'Manajemen Periode',
            'list' => ['Home', 'Manajemen Periode']
        ];

        $page = (object)[
            'title' => 'Daftar peiode'
        ];

        $activeMenu = 'periode';

        if ($request->ajax()) {
            return view('periode.partial-index', compact('breadcrumb', 'page', 'activeMenu'));
        }

        return view('admin.periode.index', compact('breadcrumb', 'page', 'activeMenu'));
    }
}
