<?php

namespace App\Http\Controllers;

use App\Models\DosenModel;
use App\Models\MahasiswaModel;
use App\Models\ProgramStudiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function create(Request $request)
    {
        $type = $request->query('type', 'mahasiswa'); 

        $breadcrumb = (object)[
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah User']
        ];

        $page = (object)[
            'title' => 'Tambah user baru'
        ];

        $programStudis = ProgramStudiModel::all(); 

        $activeMenu = 'users';

        return view('users.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'programStudis' => $programStudis,
            'activeMenu' => $activeMenu,
            'type' => $type,
        ]);
    }

    public function store(Request $request)
    {
        $type = $request->input('type');

        if ($type == 'mahasiswa') {
            $request->validate([
                'nim' => 'required|unique:mahasiswa,nim',
                'nama_mhs' => 'required|string|max:255',
                'username_mhs' => 'required|string|max:100',
                'email_mhs' => 'required|email|unique:mahasiswa,email_mhs',
                'password_mhs' => 'required|min:6|confirmed',
                'program_studi' => 'required|exists:program_studi,id_prodi',
                'foto_mhs' => 'nullable|image|max:2048',
            ]);

            $password_mhs = Hash::make($request->password_mhs);

            $fotoPath = null;
            if ($request->hasFile('foto_mhs')) {
                $file = $request->file('foto_mhs');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('foto_mahasiswa'), $filename);
                $fotoPath = 'foto_mahasiswa/' . $filename;
            }

            $fotoPath = null;
            if ($request->hasFile('foto_dsn')) {
                $file = $request->file('foto_dsn');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('foto_dosen'), $filename);
                $fotoPath = 'foto_dosen/' . $filename;
            }

            MahasiswaModel::create([
                'nim' => $request->nim,
                'nama_mhs' => $request->nama_mhs,
                'username_mhs' => $request->username_mhs,
                'email_mhs' => $request->email_mhs,
                'password_mhs' => $password_mhs,
                'program_studi' => $request->program_studi,
                'foto_mhs' => $fotoPath,
            ]);

            return redirect()->route('users.index')->with('success', 'Data mahasiswa berhasil ditambahkan!');
        }

        if ($type == 'dosen') {
            $request->validate([
                'nidn' => 'required|unique:dosen,nidn',
                'username' => 'required|string|max:100',
                'nama_dsn' => 'required|string|max:255',
                'email_dsn' => 'required|email|unique:dosen,email_dsn',
                'password_dsn' => 'required|min:6|confirmed',
                'role_dsn' => 'required|in:admin,kajur',
                'foto_dsn' => 'nullable|image|max:2048',
            ]);

            $password_dsn = Hash::make($request->password_dsn);

            $fotoPath = null;
            if ($request->hasFile('foto_dsn')) {
                $file = $request->file('foto_dsn');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('foto_dosen'), $filename);
                $fotoPath = 'foto_dosen/' . $filename;
            }

            DosenModel::create([
                'nidn' => $request->nidn,
                'username' => $request->username,
                'nama_dsn' => $request->nama_dsn,
                'email_dsn' => $request->email_dsn,
                'password_dsn' => $password_dsn,
                'foto_dsn' => $fotoPath,
                'role_dsn' => $request->role_dsn,
            ]);

            return redirect()->route('users.index')->with('success', 'Data dosen berhasil ditambahkan!');
        }

        return back()->with('error', 'Tipe user tidak valid')->withInput();
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
