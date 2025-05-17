<?php

namespace App\Http\Controllers;

use App\Models\DosenModel;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswas = MahasiswaModel::all();
        $dosens = DosenModel::all();

        $breadcrumb = (object)[
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object)[
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'users';

        if ($request->ajax()) {
            return view('users.partial-index', compact('mahasiswas', 'dosens', 'breadcrumb', 'page', 'activeMenu'));
        }

        return view('users.index', compact('mahasiswas', 'dosens', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function getMahasiswaData()
    {
        $mahasiswas = MahasiswaModel::with('programStudi')->get();

        $data = $mahasiswas->map(function ($mhs) {
            return [
                'id_mhs' => $mhs->id_mhs,
                'nim' => $mhs->nim,
                'nama_mhs' => $mhs->nama_mhs,
                'username_mhs' => $mhs->username_mhs,
                'email_mhs' => $mhs->email_mhs,
                'program_studi' => $mhs->programStudi->nama_prodi ?? '-',
            ];
        });

        return response()->json($data);
    }

    public function getDosenData()
    {
        $dosens = DosenModel::all();

        $data = $dosens->map(function ($dsn) {
            return [
                'id_dsn' => $dsn->id_dsn,
                'nidn' => $dsn->nidn,
                'nama_dsn' => $dsn->nama_dsn,
                'username' => $dsn->username,
                'email' => $dsn->email_dsn,
                'role' => $dsn->role_dsn,
            ];
        });

        return response()->json($data);
    }
}
