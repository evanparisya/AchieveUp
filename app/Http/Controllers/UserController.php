<?php

namespace App\Http\Controllers;

use App\Models\DosenModel;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $mahasiswas = MahasiswaModel::all();
        $dosens = DosenModel::all();

        $breadcrumb = (object)
        [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object)
        [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'users';

        return view('users.index', [
            'mahasiswas' => $mahasiswas,
            'dosens' => $dosens,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }
}
