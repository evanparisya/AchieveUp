@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-8">
        <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
            <h1 class="text-2xl font-bold mb-4">ADMIN</h1>
        </div>

        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Statistik Prestasi Mahasiswa</h5>
            <p class="mb-4 font-normal text-gray-700">Grafik perkembangan prestasi mahasiswa tahun ini.</p>
            <canvas id="chartPrestasi" class="w-full h-40"></canvas>
        </div>
        {{-- Tampilkan Tabel peringkat mahasiswa dengan 2 pilihan metode pemeringkatan entropy dan electre --}}
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
            {{-- Dropdown untuk memilih metode pemeringkatan --}}
            <label for="metode" class="block mb-2 text-sm font-medium text-gray-900">Pilih Metode Pemeringkatan</label>
            <select id="metode"
                class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="entropy">Entropy</option>
                <option value="electre">Electre</option>
            </select>
            {{-- Tampilkan tabel peringkat mahasiswa --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama Mahasiswa</th>
                            <th scope="col" class="px-6 py-3">Peringkat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4">John Doe</td>
                            <td class="px-6 py-4">1</td>
                        </tr>
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4">Jane Smith</td>
                            <td class="px-6 py-4">2</td>
                        </tr>
                    </tbody>
                    {{-- Route ke langkah-langkah metode pemeringkatan entropy atau electre--}}
                    <tfoot>
                        <tr class="bg-white border-b">
                            <td colspan="2" class="px-6 py-4 text-center">
                                <a href="{{ route('admin.dashboard.entropy') }}"
                                    class="text-blue-600 hover:underline">Langkah-langkah Entropy</a>
                                |
                                <a href="{{ route('admin.dashboard.electre') }}"
                                    class="text-blue-600 hover:underline">Langkah-langkah Electre</a>
                                |
                                    <a href="{{ route('admin.dashboard.aras') }}"
                                    class="text-blue-600 hover:underline">Langkah-langkah Aras</a>
                                
                            </td>
                        </tr>

                </table>

            </div>

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
