<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardMahasiswa extends Controller
{
    public function index()
    {
        $breadcrumb = (object)
        [
            'title' => 'Dashboard',
            'list' => ['Home', 'Dashboard']
        ];

        $page = (object)
        [
            'title' => 'Selamat datang di Dashboard'
        ];

        $activeMenu = 'dashboard';

        return view('mahasiswa.dashboard.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }
}
