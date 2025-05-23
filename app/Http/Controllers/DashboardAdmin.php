<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\PrestasiMahasiswa;
use Illuminate\Http\Request;

class DashboardAdmin extends Controller
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

        return view('admin.dashboard.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function getScoreLombaMahasiswa()
    {
        $mahasiswa = Mahasiswa::with('prestasi')->get();
        $data = [];
        $counter = 1;

        foreach ($mahasiswa as $mhs) {
            // Inisialisasi default values (termasuk untuk mahasiswa tanpa prestasi)
            $counts = [
                'internasional_akademik' => 0,
                'internasional_nonakademik' => 0,
                'nasional_akademik' => 0,
                'nasional_nonakademik' => 0,
                'regional_akademik' => 0,
                'regional_nonakademik' => 0,
                'provinsi_akademik' => 0,
                'provinsi_nonakademik' => 0,
            ];

            $totals = [
                'internasional' => 0,
                'nasional' => 0,
                'regional' => 0,
                'provinsi' => 0,
                'score' => 0
            ];

            // Hitung hanya jika ada prestasi
            foreach ($mhs->prestasi as $prestasi) {
                $type = $prestasi->is_akademik ? 'akademik' : 'nonakademik';
                $bobot = $prestasi->is_akademik ? 0.1 : 0.05;
                $key = $prestasi->tingkat . '_' . $type;

                $tingkatMap = [
                    'internasional' => 'inter',
                    'nasional' => 'nasional',
                    'regional' => 'regional',
                    'provinsi' => 'provinsi'
                ];

                $tingkat = $prestasi->tingkat;
                $type = $prestasi->is_akademik ? 'akademik' : 'nonakademik';
                $bobot = $prestasi->is_akademik ? 0.1 : 0.05;

                if (!isset($tingkatMap[$tingkat])) {
                    continue; // Lewati jika tingkat tidak valid
                }

                $key = $tingkatMap[$tingkat] . '_' . $type;


                $counts[$key]++;
                $totals[$prestasi->tingkat] += $bobot;
                $totals['score'] += $bobot;
            }

            // Masukkan data mahasiswa (DENGAN atau TANPA prestasi)
            $data[] = [
                'alternatif' => 'A' . $counter++,
                'nim' => $mhs->nim,
                'nama' => $mhs->nama,
                ...$counts,
                'total_internasional' => $totals['internasional'],
                'total_nasional' => $totals['nasional'],
                'total_regional' => $totals['regional'],
                'total_provinsi' => $totals['provinsi'],
                'totalScore' => $totals['score'],
                'internasional_akademik_bobot' => $counts['internasional_akademik'] * 0.1,
                'internasional_nonakademik_bobot' => $counts['internasional_nonakademik'] * 0.05,
                'nasional_akademik_bobot' => $counts['nasional_akademik'] * 0.1,
                'nasional_nonakademik_bobot' => $counts['nasional_nonakademik'] * 0.05,
                'regional_akademik_bobot' => $counts['regional_akademik'] * 0.1,
                'regional_nonakademik_bobot' => $counts['regional_nonakademik'] * 0.05,
                'provinsi_akademik_bobot' => $counts['provinsi_akademik'] * 0.1,
                'provinsi_nonakademik_bobot' => $counts['provinsi_nonakademik'] * 0.05,
            ];
        }

        return response()->json($data);
    }

    public function entropy()
    {
        $breadcrumb = (object)
        [
            'title' => 'Entropy',
            'list' => ['Home', 'Dashboard', 'Entropy']
        ];

        $page = (object)
        [
            'title' => 'Entropy'
        ];

        $getScoreLombaMahasiswa = $this->getScoreLombaMahasiswa();
        $getScoreLombaMahasiswa = json_decode($getScoreLombaMahasiswa->getContent(), true);

        $activeMenu = 'dashboard';

        return view('admin.dashboard.entropy', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'getScoreLombaMahasiswa' => $getScoreLombaMahasiswa,
        ]);
    }


    public function electre()
    {
        $breadcrumb = (object)
        [
            'title' => 'Electre',
            'list' => ['Home', 'Dashboard', 'Electre']
        ];

        $page = (object)
        [
            'title' => 'Electre'
        ];

        $activeMenu = 'dashboard';

        return view('admin.dashboard.electre', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }
}
