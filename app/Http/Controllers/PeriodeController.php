<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode;

class PeriodeController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = (object)[
            'title' => 'Manajemen Periode',
            'list' => ['Home', 'Manajemen Periode']
        ];

        $page = (object)[
            'title' => 'Daftar Periode'
        ];

        $activeMenu = 'periode';

        if ($request->ajax()) {
            return view('periode.partial-index', compact('breadcrumb', 'page', 'activeMenu'));
        }

        return view('admin.periode.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function getall()
    {
        $periodes = Periode::all();

        $data = $periodes->map(function ($periode) {
            return [
                'id' => $periode->id,
                'kode' => $periode->kode,
                'nama' => $periode->nama,
            ];
        });

        return response()->json($data);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Periode',
            'list' => ['Home', 'Periode', 'Tambah Periode']
        ];

        $page = (object)[
            'title' => 'Tambah Periode'
        ];

        $activeMenu = 'periode';

        return view('admin.periode.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:10',
            'nama' => 'required|string|max:255',
        ]);

        Periode::create($request->all());

        return redirect()->route('admin.periode.index')->with('success', 'Periode berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $periode = Periode::findOrFail($id);

        $breadcrumb = (object)[
            'title' => 'Edit Periode',
            'list' => ['Home', 'Periode', 'Edit Periode']
        ];

        $page = (object)[
            'title' => 'Edit Periode'
        ];

        $activeMenu = 'periode';

        return view('admin.periode.edit', compact('breadcrumb', 'page', 'activeMenu', 'periode'));
    }

    public function show($id)
    {
        $periode = Periode::findOrFail($id);

        $breadcrumb = (object)[
            'title' => 'Detail Periode',
            'list' => ['Home', 'Periode', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail Periode'
        ];

        $activeMenu = 'periode';

        return view('admin.periode.detail', compact('periode', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $periode = Periode::findOrFail($id);

        $request->validate([
            'kode' => 'required|string|max:10',
            'nama' => 'required|string|max:255',
        ]);

        $periode->update($request->all());

        return redirect()->route('admin.periode.index')->with('success', 'Periode berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $periode = Periode::findOrFail($id);

            if ($periode->mahasiswa()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Periode tidak dapat dihapus karena memiliki data mahasiswa.'
                ], 400);
            }

            $periode->delete();

            return response()->json([
                'success' => true,
                'message' => 'Periode berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus Periode: ' . $e->getMessage()
            ], 500);
        }
    }
}
