<?php

namespace App\Services;

use App\Models\Mahasiswa;

class Entrophy
{

    public function getDataMahasiswa()
    {
        // $mahasiswa = Mahasiswa::with([
        //     'prestasi' => function ($q) {
        //         $q->where('tanggal_selesai', '>=', now()->subMonths(6));
        //     },
        //     'profil',
        // ])->get();

        $mahasiswa = Mahasiswa::with([
            'prestasi' => function ($q) {
                $q->where('tanggal_selesai', '>=', now()->subMonths(6));
            },
            'profil',
        ])
            ->limit(10) // ambil 10 data mahasiswa saja
            ->get();

        // dd($mahasiswa);

        return $mahasiswa;
    }

    public function getAllFunction()
    {
        return [
            'getSampleData' => $this->getSampleData(),
            'getScoreLomba' => $this->getScoreLomba(),
            'getDataAlternatif' => $this->getDataAlternatif(),
            'getNormalisasi' => $this->getNormalisasi(),
            'getMaxMin' => $this->getMaxMin(),
            'getTotalKriteria' => $this->getTotalKriteria(),
            'getNilaiProporsional' => $this->getNilaiProporsional(),
            'getNilaiLn' => $this->getNilaiLn(),
            'getNilaiProporsionalKaliLn' => $this->getNilaiProporsionalKaliLn(),
            'getTotalPLn' => $this->getTotalPLn(),
            'getNilaiEj' => $this->getNilaiEj(),
            'getNilaiEntrophy' => $this->getNilaiEntrophy(),
            'getNilaiDispersi' => $this->getNilaiDispersi(),
            'getTotalNilaiDispersi' => $this->getTotalNilaiDispersi(),
            'getBobotKriteria' => $this->getBobotKriteria(),
        ];
    }

    public function getSampleData()
    {
        $mahasiswa = $this->getDataMahasiswa();
        $data = [];
        $counter = 1;

        foreach ($mahasiswa as $mhs) {
            // Inisialisasi counters
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

            // Hitung prestasi
            foreach ($mhs->prestasi as $prestasi) {
                $type = $prestasi->is_akademik ? 'akademik' : 'nonakademik';
                $key = $prestasi->tingkat . '_' . $type;
                $counts[$key]++;
            }

            // Format data untuk tabel
            $data[] = [
                'alternatif' => 'A' . $counter++,
                'lomba_akademik' => implode(',', [
                    $counts['internasional_akademik'],
                    $counts['nasional_akademik'],
                    $counts['regional_akademik'],
                    $counts['provinsi_akademik'],
                ]),
                'lomba_nonakademik' => implode(',', [
                    $counts['internasional_nonakademik'],
                    $counts['nasional_nonakademik'],
                    $counts['regional_nonakademik'],
                    $counts['provinsi_nonakademik'],
                ]),
                'ipk' => $mhs->profil->ips ?? 0,
                'pengalaman_organisasi' => $mhs->profil->pengalaman_organisasi ?? 0,
                'skor_bahasa_inggris' => $mhs->profil->skor_toffle ?? 0,
                'prestasi_kemenangan' => $this->formatPrestasiKemenangan($mhs->prestasi),
                'semester' => 'semester ' . ($mhs->profil->semester ?? 1),
            ];
        }

        return $data;
    }

    protected function formatPrestasiKemenangan($prestasi)
    {
        $prestasiMenang = $prestasi->filter(function ($item) {
            return $item->juara != null;
        });

        if ($prestasiMenang->isEmpty()) {
            return '-';
        }

        return $prestasiMenang->map(function ($item) {
            return implode(', ', [
                ucfirst($item->tingkat),
                'Juara ' . $item->juara,
                $item->is_individu ? 'Individu' : 'Kelompok',
            ]);
        })->implode('; ');
    }

    public function getScoreLomba()
    {
        $mahasiswa = $this->getDataMahasiswa();
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
                'score' => 0,
            ];

            // Hitung hanya jika ada prestasi
            foreach ($mhs->prestasi as $prestasi) {
                $type = $prestasi->is_akademik ? 'akademik' : 'nonakademik';
                $bobot = $prestasi->is_akademik ? 0.1 : 0.05;
                $key = $prestasi->tingkat . '_' . $type;

                $tingkatMap = [
                    'internasional' => 'internasional',
                    'nasional' => 'nasional',
                    'regional' => 'regional',
                    'provinsi' => 'provinsi',
                ];

                $tingkat = $prestasi->tingkat;
                $type = $prestasi->is_akademik ? 'akademik' : 'nonakademik';
                $bobot = $prestasi->is_akademik ? 0.1 : 0.05;

                if (!isset($tingkatMap[$tingkat])) {
                    continue;
                }

                $key = $tingkatMap[$tingkat] . '_' . $type;

                $counts[$key]++;
                $totals[$prestasi->tingkat] += $bobot;
                $totals['score'] += $bobot;
            }
            $totalScoreValue = $totals['score'] == 0 ? 0.01 : $totals['score'];

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
                'totalScore' => $totalScoreValue,
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

        return $data;
    }

    public function getDataAlternatif()
    {
        $mahasiswa = $this->getDataMahasiswa();
        $scoreLomba = $this->getScoreLomba();
        $dataAlternatif = [];

        $scoreLombaMap = [];
        foreach ($scoreLomba as $scoreData) {
            $scoreLombaMap[$scoreData['nim']] = $scoreData['totalScore'];
        }

        // Bobot prestasi berdasarkan tingkat dan pencapaian
        $bobotPrestasi = [
            'internasional' => [
                1 => ['individu' => 10, 'kelompok' => 5],
                2 => ['individu' => 8, 'kelompok' => 4],
                3 => ['individu' => 4, 'kelompok' => 2],
            ],
            'nasional' => [
                1 => ['individu' => 8, 'kelompok' => 4],
                2 => ['individu' => 6, 'kelompok' => 3],
                3 => ['individu' => 3, 'kelompok' => 1.5],
            ],
            'regional' => [
                1 => ['individu' => 6, 'kelompok' => 3],
                2 => ['individu' => 4, 'kelompok' => 2],
                3 => ['individu' => 2, 'kelompok' => 1],
            ],
            'provinsi' => [
                1 => ['individu' => 4, 'kelompok' => 1],
                2 => ['individu' => 2, 'kelompok' => 1],
                3 => ['individu' => 1, 'kelompok' => 0.5],
            ],
        ];

        foreach ($mahasiswa as $index => $mhs) {
            // Hitung bobot ipk
            $bobotIPK = $this->hitungBobotIPK($mhs->profil->ips ?? 0);

            // Hitung bobot bahasa Inggris
            $bobotToefl = $this->hitungBobotToefl($mhs->profil->skor_toffle ?? 0);

            // Hitung bobot organisasi
            $bobotOrganisasi = $this->hitungBobotOrganisasi($mhs->profil->pengalaman_organisasi ?? 0);

            // Hitung bobot semester
            $bobotSemester = $this->hitungBobotSemester($mhs->profil->semester ?? 1);

            // Hitung prestasi kemenangan dan total skor
            $prestasiKemenangan = [];
            $totalSkorPrestasi = 0;

            foreach ($mhs->prestasi as $prestasi) {
                if ($prestasi->juara) {
                    $tingkat = strtolower($prestasi->tingkat);
                    $juara = $prestasi->juara;
                    $jenis = $prestasi->is_team ? 'kelompok' : 'individu';

                    if (isset($bobotPrestasi[$tingkat][$juara][$jenis])) {
                        $skor = $bobotPrestasi[$tingkat][$juara][$jenis];
                        $totalSkorPrestasi += $skor;

                        $prestasiKemenangan[] = [
                            'tingkat' => ucfirst($tingkat),
                            'juara' => $juara,
                            'jenis' => $jenis,
                            'skor' => $skor,
                        ];
                    }
                }
            }
            $prestasiKemenanganValue = $totalSkorPrestasi == 0 ? 0.1 : $totalSkorPrestasi;

            // Format output
            $dataAlternatif[] = [
                'alternatif' => 'A' . ($index + 1),
                'nama' => $mhs->nama,
                'nim' => $mhs->nim,
                'ipk' => $bobotIPK,
                'jumlah_lomba' => $scoreLombaMap[$mhs->nim] ?? 0,
                'pengalaman_organisasi' => $bobotOrganisasi,
                'skor_bahasa_inggris' => $bobotToefl,
                'prestasi_kemenangan' => $prestasiKemenanganValue,
                'semester' => $bobotSemester,
            ];
        }

        return $dataAlternatif;
    }

    protected function hitungBobotIPK($ipk)
    {
        if ($ipk >= 3.5) {
            return 5;
        }

        if ($ipk > 2.5) {
            return 4;
        }

        if ($ipk > 1.5) {
            return 3;
        }

        return 2;
    }

    protected function hitungBobotToefl($skor)
    {
        if ($skor >= 850) {
            return 5;
        }

        if ($skor >= 650) {
            return 4;
        }

        if ($skor >= 450) {
            return 3;
        }

        return 2;
    }

    protected function hitungBobotOrganisasi($pengalaman)
    {
        if ($pengalaman > 3) {
            return 5;
        }

        if ($pengalaman >= 1) {
            return 3;
        }

        return 1;
    }

    protected function hitungBobotSemester($semester)
    {
        if ($semester >= 7) {
            return 2;
        }

        if ($semester >= 5) {
            return 3;
        }

        if ($semester >= 3) {
            return 4;
        }

        return 5;
    }

    public function getNormalisasi()
    {
        $alternatifs = $this->getDataAlternatif();

        $maxMinValues = $this->getMaxMin();

        $matriksNormalisasi = [];

        foreach ($alternatifs as $alt) {
            $matriksNormalisasi[] = [
                'alternatif' => $alt['alternatif'],
                'nama' => $alt['nama'],
                'ipk' => $this->normalisasiBenefit($alt['ipk'], $maxMinValues['max']['ipk']),
                'jumlah_lomba' => $this->normalisasiBenefit($alt['jumlah_lomba'], $maxMinValues['max']['jumlah_lomba']),
                'pengalaman_organisasi' => $this->normalisasiBenefit($alt['pengalaman_organisasi'], $maxMinValues['max']['pengalaman_organisasi']),
                'skor_bahasa_inggris' => $this->normalisasiBenefit($alt['skor_bahasa_inggris'], $maxMinValues['max']['skor_bahasa_inggris']),
                'prestasi_kemenangan' => $this->normalisasiBenefit($alt['prestasi_kemenangan'], $maxMinValues['max']['prestasi_kemenangan']),
                'semester' => $this->normalisasiCost($alt['semester'], $maxMinValues['min']['semester']),
            ];
        }

        return $matriksNormalisasi;
    }

    public function getMaxMin()
    {
        $data = $this->getDataAlternatif();

        // Inisialisasi array max dan min untuk semua kriteria
        $max = [];
        $min = [];

        if (count($data) > 0) {
            // Ambil semua kriteria numerik dari data pertama (kecuali kolom non-kriteria)
            $exclude = ['alternatif', 'nama', 'nim'];
            $kriteria = array_diff(array_keys($data[0]), $exclude);

            // Inisialisasi nilai awal
            foreach ($kriteria as $k) {
                $max[$k] = $data[0][$k];
                $min[$k] = $data[0][$k];
            }

            // Loop data untuk mencari max dan min setiap kriteria
            foreach ($data as $alt) {
                foreach ($kriteria as $k) {
                    if (isset($alt[$k])) {
                        $max[$k] = max($max[$k], $alt[$k]);
                        $min[$k] = min($min[$k], $alt[$k]);
                    }
                }
            }
        }

        return [
            'max' => $max,
            'min' => $min,
        ];
    }

    protected function normalisasiBenefit($value, $max)
    {
        return $max != 0 ? round($value / $max, 4) : 0;
    }

    protected function normalisasiCost($value, $min)
    {
        return $value != 0 ? round($min / $value, 4) : 0;
    }

    public function getTotalKriteria()
    {
        $normalisasi = $this->getNormalisasi();
        $matriks = $normalisasi;

        $totalKriteria = [
            'ipk' => 0,
            'jumlah_lomba' => 0,
            'pengalaman_organisasi' => 0,
            'skor_bahasa_inggris' => 0,
            'prestasi_kemenangan' => 0,
            'semester' => 0,
        ];

        foreach ($matriks as $row) {
            $totalKriteria['ipk'] += $row['ipk'];
            $totalKriteria['jumlah_lomba'] += $row['jumlah_lomba'];
            $totalKriteria['pengalaman_organisasi'] += $row['pengalaman_organisasi'];
            $totalKriteria['skor_bahasa_inggris'] += $row['skor_bahasa_inggris'];
            $totalKriteria['prestasi_kemenangan'] += $row['prestasi_kemenangan'];
            $totalKriteria['semester'] += $row['semester'];
        }

        $data = [
            'ipk' => round($totalKriteria['ipk'], 3),
            'jumlah_lomba' => round($totalKriteria['jumlah_lomba'], 3),
            'pengalaman_organisasi' => round($totalKriteria['pengalaman_organisasi'], 3),
            'skor_bahasa_inggris' => round($totalKriteria['skor_bahasa_inggris'], 3),
            'prestasi_kemenangan' => round($totalKriteria['prestasi_kemenangan'], 3),
            'semester' => round($totalKriteria['semester'], 3),
        ];

        return $data;
    }

    public function getNilaiProporsional()
    {
        // 1. Dapatkan matriks normalisasi dan total kriteria
        $normalisasi = $this->getNormalisasi();
        $matriks = $normalisasi;
        $totalKriteria = $this->getTotalKriteria();

        // 2. Hitung nilai proporsional
        $hasil = [];

        foreach ($matriks as $row) {
            $hasil[] = [
                'alternatif' => $row['alternatif'],
                'nama' => $row['nama'],
                'ipk' => $this->hitungProporsi($row['ipk'], $totalKriteria['ipk']),
                'jumlah_lomba' => $this->hitungProporsi($row['jumlah_lomba'], $totalKriteria['jumlah_lomba']),
                'pengalaman_organisasi' => $this->hitungProporsi($row['pengalaman_organisasi'], $totalKriteria['pengalaman_organisasi']),
                'skor_bahasa_inggris' => $this->hitungProporsi($row['skor_bahasa_inggris'], $totalKriteria['skor_bahasa_inggris']),
                'prestasi_kemenangan' => $this->hitungProporsi($row['prestasi_kemenangan'], $totalKriteria['prestasi_kemenangan']),
                'semester' => $this->hitungProporsi($row['semester'], $totalKriteria['semester']),
            ];
        }

        return $hasil;
    }

    protected function hitungProporsi($nilai, $total)
    {
        return $total != 0 ? round($nilai / $total, 4) : 0;
    }

    public function getNilaiLn()
    {
        $proporsional = $this->getNilaiProporsional();
        $dataProporsional = $proporsional;

        $matriksLn = [];

        foreach ($dataProporsional as $row) {
            $matriksLn[] = [
                'alternatif' => $row['alternatif'],
                'nama' => $row['nama'],
                'ipk' => $this->hitungLn($row['ipk']),
                'jumlah_lomba' => $this->hitungLn($row['jumlah_lomba']),
                'pengalaman_organisasi' => $this->hitungLn($row['pengalaman_organisasi']),
                'skor_bahasa_inggris' => $this->hitungLn($row['skor_bahasa_inggris']),
                'prestasi_kemenangan' => $this->hitungLn($row['prestasi_kemenangan']),
                'semester' => $this->hitungLn($row['semester']),
            ];
        }

        return $matriksLn;
    }

    protected function hitungLn($nilai)
    {
        if ($nilai <= 0) {
            return 0;
        }

        return round(log($nilai), 3);
    }

    public function getNilaiProporsionalKaliLn()
    {
        $matriksLn = $this->getNilaiLn();
        $nilaiProporsional = $this->getNilaiProporsional();

        $hasil = [];

        foreach ($matriksLn as $index => $row) {
            $hasil[] = [
                'alternatif' => $row['alternatif'],
                'nama' => $row['nama'],
                'ipk' => round($row['ipk'] * $nilaiProporsional[$index]['ipk'], 4),
                'jumlah_lomba' => round($row['jumlah_lomba'] * $nilaiProporsional[$index]['jumlah_lomba'], 4),
                'pengalaman_organisasi' => round($row['pengalaman_organisasi'] * $nilaiProporsional[$index]['pengalaman_organisasi'], 4),
                'skor_bahasa_inggris' => round($row['skor_bahasa_inggris'] * $nilaiProporsional[$index]['skor_bahasa_inggris'], 4),
                'prestasi_kemenangan' => round($row['prestasi_kemenangan'] * $nilaiProporsional[$index]['prestasi_kemenangan'], 4),
                'semester' => round($row['semester'] * $nilaiProporsional[$index]['semester'], 4),
            ];
        }

        return $hasil;
    }

    public function getTotalPLn()
    {
        $matriksLn = $this->getNilaiProporsionalKaliLn();
        $total = [
            'ipk' => 0,
            'jumlah_lomba' => 0,
            'pengalaman_organisasi' => 0,
            'skor_bahasa_inggris' => 0,
            'prestasi_kemenangan' => 0,
            'semester' => 0,
        ];
        foreach ($matriksLn as $row) {
            $total['ipk'] += $row['ipk'];
            $total['jumlah_lomba'] += $row['jumlah_lomba'];
            $total['pengalaman_organisasi'] += $row['pengalaman_organisasi'];
            $total['skor_bahasa_inggris'] += $row['skor_bahasa_inggris'];
            $total['prestasi_kemenangan'] += $row['prestasi_kemenangan'];
            $total['semester'] += $row['semester'];
        }
        return $total;
    }

    public function getNilaiEj()
    {
        $jumlahAlternatif = count($this->getDataAlternatif());
        $nilai = round(-1 / log($jumlahAlternatif), 4);
        return $nilai;
    }

    public function getNilaiEntrophy()
    {
        $matriksLn = $this->getTotalPLn();
        $nilaiEj = $this->getNilaiEj();
        $hasil = [];
        $counter = 1;
        foreach ($matriksLn as $key => $value) {
            $hasil['E' . $counter++] = round($value * $nilaiEj, 4);
        }
        return $hasil;
    }

    public function getNilaiDispersi()
    {
        $matriksEntrophy = $this->getNilaiEntrophy();
        $hasil = [];
        $counter = 1;
        foreach ($matriksEntrophy as $key => $value) {
            $hasil['D' . $counter++] = round(1 - $value, 4);
        }
        return $hasil;
    }

    public function getTotalNilaiDispersi()
    {
        $nilaiDispersi = $this->getNilaiDispersi();
        $total = 0;
        foreach ($nilaiDispersi as $value) {
            $total += $value;
        }
        return $total;
    }

    public function getBobotKriteria()
    {
        $totalNilaiDispersi = $this->getTotalNilaiDispersi();
        $nilaiDispersi = $this->getNilaiDispersi();
        $hasil = [];
        $counter = 1;
        $totalBobot = 0;
        foreach ($nilaiDispersi as $value) {
            $hasil['W' . $counter++] = round($value / $totalNilaiDispersi, 4);
        }
        foreach ($hasil as $bobot) {
            $totalBobot += $bobot;
        }

        $data = [
            'ipk' => $hasil['W1'],
            'jumlah_lomba' => $hasil['W2'],
            'pengalaman_organisasi' => $hasil['W3'],
            'skor_bahasa_inggris' => $hasil['W4'],
            'prestasi_kemenangan' => $hasil['W5'],
            'semester' => $hasil['W6'],
        ];

        return [
            'bobot_kriteria' => $hasil,
            'total_bobot' => round($totalBobot, 4),
            'data_bobot' => $data,
            'total_nilai_dispers' => round($totalNilaiDispersi, 4),
        ];
    }
}
