@extends('admin.layouts.app')

@section('title', 'Entropy')

@section('content')
    <div class="space-y-8">
        {{-- Tabel kriteria dan jenis kriteria --}}
        <div class="overflow-x-auto bg-white shadow rounded-b-[12px] border-t-0 border border-gray-200">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Kriteria dan Jenis Kriteria</h5>
            <!-- Tab Kriteria -->
            <table id="table_kriteria" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kriteria
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">IPK</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Benefit</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Jumlah Lomba yang Diikuti</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Benefit</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Pengalaman Organisasi</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Benefit</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Skor Bahasa Inggris</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Benefit</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Prestasi Kemenangan Lomba</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Benefit</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Semester</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Cost</td>
                    </tr>
                </tbody>
            </table>
            <p id="kriteria_info" class="text-sm text-gray-500 mt-2"></p>
            <div id="kriteria_pagination" class="mt-2 flex flex-wrap gap-2"></div>
        </div>

        {{-- Tabel Prestasi Kemenangan Lomba --}}
        <div class="overflow-x-auto bg-white shadow rounded-b-[12px] border-t-0 border border-gray-200">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Prestasi Kemenangan Lomba</h5>
            <!-- Tab Kriteria -->
            <table id="table_prestasi_kemenangan_lomba" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tingkat
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pencapaian</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Individu
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelompok
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Internasional -->
                    <tr>
                        <td rowspan="3" class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Internasional</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Juara 1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">10</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">5</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Juara 2</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">8</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">4</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Juara 3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">4</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">2</td>
                    </tr>

                    <!-- Nasional -->
                    <tr>
                        <td rowspan="3" class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Nasional</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Juara 1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">8</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">4</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Juara 2</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">6</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">3</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Juara 3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">1,5</td>
                    </tr>

                    <!-- Regional -->
                    <tr>
                        <td rowspan="3" class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Regional</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Juara 1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">6</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">3</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Juara 2</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">4</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">2</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Juara 3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">2</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">1</td>
                    </tr>

                    <!-- Provinsi -->
                    <tr>
                        <td rowspan="3" class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Provinsi</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Juara 1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">4</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">1</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Juara 2</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">2</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">1</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">Juara 3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">0,5</td>
                    </tr>
                </tbody>
            </table>

            <p id="prestasi_kemenangan_lomba_info" class="text-sm text-gray-500 mt-2"></p>
            <div id="prestasi_kemenangan_lomba_pagination" class="mt-2 flex flex-wrap gap-2"></div>
        </div>

        {{-- Tabel Bobot Kriteria IPK --}}
        <div class="overflow-x-auto bg-white shadow rounded-b-[12px] border-t-0 border border-gray-200">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Bobot Kriteria IPK</h5>
            <!-- Tab Kriteria IPK-->
            <table id="table_bobot_ipk" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Presentase
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bobot
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Row 1 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">≥ 3,5</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">5</td>
                    </tr>

                    <!-- Row 2 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">3,5 &lt; IPK ≤ 2,5</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">4</td>
                    </tr>

                    <!-- Row 3 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">2,5 &lt; IPK ≤ 1,5</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">3</td>
                    </tr>

                    <!-- Row 4 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">&lt; 1,5</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">2</td>
                    </tr>
                </tbody>
            </table>
            <p id="bobot_ipk_info" class="text-sm text-gray-500 mt-2"></p>
            <div id="bobot_ipk_pagination" class="mt-2 flex flex-wrap gap-2"></div>
        </div>
        {{-- Tabel Bobot Kriteria Skor Bahasa Inggris --}}
        <div class="overflow-x-auto bg-white shadow rounded-b-[12px] border-t-0 border border-gray-200">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Bobot Kriteria Bahasa Inggris</h5>
            <!-- Tab Kriteria Skor Bahasa Inggris-->
            <table id="table_skor_bahasa_inggris" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Presentase</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bobot
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Row 1 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">≥ 850</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">5</td>
                    </tr>

                    <!-- Row 2 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">850 &lt; skor ≤ 650</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">4</td>
                    </tr>

                    <!-- Row 3 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">650 &lt; skor ≤ 450</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">3</td>
                    </tr>

                    <!-- Row 4 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">&lt; 450</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">2</td>
                    </tr>
                </tbody>
            </table>
            <p id="skor_bahasa_inggris_info" class="text-sm text-gray-500 mt-2"></p>
            <div id="skor_bahasa_inggris_pagination" class="mt-2 flex flex-wrap gap-2"></div>
        </div>
        {{-- Tabel Bobot Pengalaman Organisasi --}}
        <div class="overflow-x-auto bg-white shadow rounded-b-[12px] border-t-0 border border-gray-200">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Bobot Pengalaman Organisasi</h5>
            <!-- Tab Kriteria Pengalaman Organisasi-->
            <table id="table_pengalaman_organisasi" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Presentase</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bobot
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Row 1 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">&gt; 3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">3</td>
                    </tr>

                    <!-- Row 2 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">3 ≤ jml ≤ 1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">2</td>
                    </tr>

                    <!-- Row 3 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">&lt; 1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">1</td>
                    </tr>
                </tbody>
            </table>

            <p id="pengalaman_organisasi_info" class="text-sm text-gray-500 mt-2"></p>
            <div id="pengalaman_organisasi_pagination" class="mt-2 flex flex-wrap gap-2"></div>
        </div>
        {{-- Tabel Bobot Semester --}}
        <div class="overflow-x-auto bg-white shadow rounded-b-[12px] border-t-0 border border-gray-200">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Bobot Semester</h5>
            <!-- Tab Kriteria Semester-->
            <table id="table_semester" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th colspan="2"
                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Semester</th>
                    </tr>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Presentase</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bobot
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Row 1 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">7-8</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">1</td>
                    </tr>

                    <!-- Row 2 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">5-6</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">2</td>
                    </tr>

                    <!-- Row 3 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">3-4</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">3</td>
                    </tr>

                    <!-- Row 4 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">1-2</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">4</td>
                    </tr>
                </tbody>
            </table>

            <p id="semester_info" class="text-sm text-gray-500 mt-2"></p>
            <div id="semester_pagination" class="mt-2 flex flex-wrap gap-2"></div>
        </div>

        {{-- Tabel Perhitungan Skor Lomba Mahasiswa --}}
        @foreach ($getScoreLombaMahasiswa as $item)
            <div class="mb-10">
                <h5 class="text-lg font-semibold text-gray-800 mb-3">Jumlah Lomba yang Diikuti ({{ $item['alternatif'] }})
                </h5>
                <div class="overflow-x-auto rounded-lg shadow-md border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200 bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Tingkat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Akademik</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Non-Akademik</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Bobot Akademik</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Bobot Non-Akademik</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $rowTotal = function ($ak, $nak) {
                                    return number_format($ak * 0.1 + $nak * 0.05, 2);
                                };
                            @endphp

                            <!-- Internasional Row -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Internasional</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item['internasional_akademik'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item['internasional_nonakademik'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-blue-600">
                                    {{ number_format($item['internasional_akademik_bobot'], 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-blue-600">
                                    {{ number_format($item['internasional_nonakademik_bobot'], 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold">
                                    {{ $rowTotal($item['internasional_akademik'], $item['internasional_nonakademik']) }}
                                </td>
                            </tr>

                            <!-- Nasional Row -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Nasional</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item['nasional_akademik'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item['nasional_nonakademik'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-blue-600">
                                    {{ number_format($item['nasional_akademik_bobot'], 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-blue-600">
                                    {{ number_format($item['nasional_nonakademik_bobot'], 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold">
                                    {{ $rowTotal($item['nasional_akademik'], $item['nasional_nonakademik']) }}</td>
                            </tr>

                            <!-- Regional Row -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Regional</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item['regional_akademik'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item['regional_nonakademik'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-blue-600">
                                    {{ number_format($item['regional_akademik_bobot'], 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-blue-600">
                                    {{ number_format($item['regional_nonakademik_bobot'], 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold">
                                    {{ $rowTotal($item['regional_akademik'], $item['regional_nonakademik']) }}</td>
                            </tr>

                            <!-- Provinsi Row -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Provinsi</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item['provinsi_akademik'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item['provinsi_nonakademik'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-blue-600">
                                    {{ number_format($item['provinsi_akademik_bobot'], 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-blue-600">
                                    {{ number_format($item['provinsi_nonakademik_bobot'], 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold">
                                    {{ $rowTotal($item['provinsi_akademik'], $item['provinsi_nonakademik']) }}</td>
                            </tr>

                            <!-- Total Row -->
                            <tr class="bg-gray-100 hover:bg-gray-200 transition-colors">
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-right font-bold text-gray-700">
                                    Total</td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-lg text-blue-700">
                                    {{ number_format($item['totalScore'], 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Fungsi untuk mengupdate chart berdasarkan metode yang dipilih
            function updateChart(metode) {
                const ctx = document.getElementById('chartPrestasi').getContext('2d');
                const data = {
                    labels: ['Jan', 'Feb', 'Mar'],
                    datasets: [{
                        label: 'Jumlah Prestasi',
                        data: metode === 'entropy' ? [5, 8, 4] : [3, 6, 9],
                        backgroundColor: '#6041CE',
                    }]
                };
                ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
                new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            // Event listener untuk dropdown
            document.getElementById('metode').addEventListener('change', function() {
                updateChart(this.value);
            });

            // Inisialisasi chart dengan metode default
            updateChart('entropy');
        </script>
        <script>
            const ctx = document.getElementById('chartPrestasi').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar'],
                    datasets: [{
                        label: 'Jumlah Prestasi',
                        data: [5, 8, 4],
                        backgroundColor: '#6041CE',
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endsection
