<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Dosen;

class ProfilDosenController extends Controller
{
    public function index(){
        $breadcrumb = (object)
        [
            'title' => 'Profil Dosen',
            'list' => ['Profil']
        ];
        

        $page = (object)
        [
            'title' => 'Halaman Profil Dosen'
        ];

        $activeMenu = 'dashboard';

        return view('admin.profil.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'dosen' => $this->getDataDosen(),
        ]);
    }

    public function getDataDosen()
    {
        $dosen = Auth::guard('dosen')->user();
        $data = [
            'id' => $dosen->id,
            'nama' => $dosen->nama,
            'username' => $dosen->username,
            'nidn' => $dosen->nidn,
            'email' => $dosen->email,
            'role' => $dosen->role,
            'foto' => $dosen->foto ? asset('storage/' . $dosen->foto) : asset('img/default-avatar.png'),
        ];

        return $data;
    }

    public function edit(){
        $breadcrumb = (object)
        [
            'title' => 'Edit Profil Dosen',
            'list' => ['Profil', 'Edit']
        ];

        $page = (object)
        [
            'title' => 'Halaman Edit Profil Dosen'
        ];

        $activeMenu = 'dashboard';

        return view('admin.profil.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'dosen' => $this->getDataDosen(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:dosen,username,' . $dosen->id,
            'email' => 'required|email|max:255|unique:dosen,email,' . $dosen->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update data dosen
        $dosen->nama = $validated['nama'];
        $dosen->username = $validated['username'];
        $dosen->email = $validated['email'];

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            if ($dosen->foto) {
                Storage::disk('public')->delete($dosen->foto);
            }
            $dosen->foto = $request->file('foto')->store('foto_dosen', 'public');
        }

        $dosen->save();

        return redirect()->route('admin.profil.index')->with('success', 'Profil berhasil diperbarui.');
    }

    
        
}
