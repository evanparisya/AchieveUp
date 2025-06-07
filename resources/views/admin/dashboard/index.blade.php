@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 p-6">
        <div class="lg:col-span-4 flex flex-col h-auto lg:h-[548px] p-6 items-center gap-6 rounded-xl bg-white shadow-md">
            <div class="flex flex-col items-center gap-4">
                <div
                    class="relative flex w-[124px] h-[124px] justify-center items-center rounded-full border border-[rgba(0,0,0,0.1)] bg-white overflow-hidden">
                    <img src="{{ Auth::guard('dosen')->user() && Auth::guard('dosen')->user()->foto ? asset(Auth::guard('dosen')->user()->foto) : asset('images/default-user.png') }}"
                        onerror="this.onerror=null; this.src='{{ asset('images/default-user.png') }}';" alt="User Image"
                        class="object-cover w-[95px] h-[95px] rounded-full" />
                </div>
                <span class="text-lg font-semibold text-gray-800 text-center">Selamat Datang,
                    {{ Auth::guard('dosen')->user()->nama ?? '-' }}</span>
            </div>

            <div class="w-full h-[1px] bg-[rgba(0,0,0,0.1)]"></div>

            <div class="flex justify-between items-center self-stretch">
                <p class="text-black text-md font-medium leading-normal">
                    Top 3 Partisipasi Lomba
                </p>
                <a href="" class="text-[#6041CE] text-right text-sm font-semibold leading-normal">
                    Lihat Semua
                </a>
            </div>

            <div class="flex flex-col justify-center items-center gap-2 self-stretch">
                <div
                    class="flex items-center gap-2.5 flex-1 self-stretch rounded-[12px] border border-[rgba(0,0,0,0.1)] bg-[rgba(222,197,252,0.1)] p-2.5">
                    <div class="w-[48px] h-[48px] rounded-[8px] border-[3px] border-[#AF7026] overflow-hidden"> <img
                            src="{{ Auth::guard('dosen')->user() && Auth::guard('dosen')->user()->foto ? asset(Auth::guard('dosen')->user()->foto) : asset('images/default-user.png') }}"
                            onerror="this.onerror=null; this.src='{{ asset('images/default-user.png') }}';" alt="User Image"
                            class="w-full h-full object-cover rounded-[5px]" /> </div>
                    <div class="flex justify-between items-center flex-1">
                        <span class="text-[#414651] text-md font-medium leading-normal">
                            nama anak orang
                        </span>
                        <div class="flex items-center gap-2 rounded px-[8px] py-[4px] bg-purple-500/10">
                            <span class="text-md font-bold text-purple-700">0</span>
                        </div>
                    </div>
                </div>
                <div
                    class="flex items-center gap-2.5 flex-1 self-stretch rounded-[12px] border border-[rgba(0,0,0,0.1)] bg-[rgba(222,197,252,0.1)] p-2.5">
                    <div class="w-[48px] h-[48px] rounded-[8px] border-[3px] border-[#AF7026] overflow-hidden">
                        <img src="{{ Auth::guard('dosen')->user() && Auth::guard('dosen')->user()->foto ? asset(Auth::guard('dosen')->user()->foto) : asset('images/default-user.png') }}"
                            onerror="this.onerror=null; this.src='{{ asset('images/default-user.png') }}';" alt="User Image"
                            class="w-full h-full object-cover rounded-[5px]" />
                    </div>
                    <div class="flex justify-between items-center flex-1">
                        <span class="text-[#414651] text-md font-medium leading-normal">
                            nama anak orang
                        </span>
                        <div class="flex items-center gap-2 rounded px-[8px] py-[4px] bg-purple-500/10">
                            <span class="text-md font-bold text-purple-700">0</span>
                        </div>
                    </div>
                </div>
                <div
                    class="flex items-center gap-2.5 flex-1 self-stretch rounded-[12px] border border-[rgba(0,0,0,0.1)] bg-[rgba(222,197,252,0.1)] p-2.5">
                    <div class="w-[48px] h-[48px] rounded-[8px] border-[3px] border-[#AF7026] overflow-hidden">
                        <img src="{{ Auth::guard('dosen')->user() && Auth::guard('dosen')->user()->foto ? asset(Auth::guard('dosen')->user()->foto) : asset('images/default-user.png') }}"
                            onerror="this.onerror=null; this.src='{{ asset('images/default-user.png') }}';" alt="User Image"
                            class="w-full h-full object-cover rounded-[5px]" />
                    </div>
                    <div class="flex justify-between items-center flex-1">
                        <span class="text-[#414651] text-md font-medium leading-normal">
                            nama anak orang
                        </span>
                        <div class="flex items-center gap-2 rounded px-[8px] py-[4px] bg-purple-500/10">
                            <span class="text-md font-bold text-purple-700">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-8 flex flex-col items-start gap-6 ">
            <div
                class="flex flex-col sm:flex-row justify-start sm:justify-end gap-6 w-full p-6 lg:pt-10 lg:pb-6 lg:pl-6 lg:pr-6 rounded-xl border border-purple-200 bg-purple-200/50">
                <div
                    class="flex flex-col justify-start items-start gap-2.5 flex-1 self-stretch rounded-tl-none rounded-tr-[8px] rounded-br-[8px] rounded-bl-[8px] border-t-[4px] border-t-gray-700 bg-white px-6 py-4">
                    <h5 class="font-medium">Pengajuan Verifikasi</h5>
                    <p class="text-[28px] font-bold">100</p>
                </div>
                <div
                    class="flex flex-col justify-start items-start gap-2.5 flex-1 self-stretch rounded-tl-none rounded-tr-[8px] rounded-br-[8px] rounded-bl-[8px] border-t-[4px] border-t-green-700 bg-white px-6 py-4">
                    <h5 class="font-medium">Pengajuan Di-Verifikasi</h5>
                    <p class="text-[28px] font-bold">100</p>
                </div>
                <div
                    class="flex flex-col justify-start items-start gap-2.5 flex-1 self-stretch rounded-tl-none rounded-tr-[8px] rounded-br-[8px] rounded-bl-[8px] border-t-[4px] border-t-red-700 bg-white px-6 py-4">
                    <h5 class="font-medium">Pengajuan Ditolak</h5>
                    <p class="text-[28px] font-bold">100</p>
                </div>
            </div>
            <div class="flex flex-col md:flex-row justify-center items-stretch gap-6 self-stretch">
                <div class="flex flex-col items-center p-6 gap-5 flex-[1_0_0] bg-white rounded-[12px] shadow-md">
                    <h5 class="font-medium">Total Prestasi Mahasiswa</h5>
                    <canvas id="myBarChart" style="height: 242px; width: 100%;"></canvas>
                </div>
                <div class="flex flex-col items-center p-6 gap-5 flex-[1_0_0] bg-white rounded-[12px] shadow-md">
                    <h5 class="font-medium">Jenis Prestasi</h5>
                    <div class="chart-container" style="position: relative; height:250px; width:100%; margin: auto;">
                        <canvas id="myDonutChart" style="display: block; width: 100%; height: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const Utils = {
            CHART_COLORS: {
                red: 'rgb(255, 99, 132)',
                orange: 'rgb(255, 159, 64)',
                yellow: 'rgb(255, 205, 86)',
                green: 'rgb(75, 192, 192)',
                blue: 'rgb(54, 162, 235)',
                purple: 'rgb(153, 102, 255)',
                grey: 'rgb(201, 203, 207)'
            },
            transparentize: function(color, opacity) {
                var alpha = opacity === undefined ? 0.5 : 1 - opacity;
                if (typeof color === 'string' && color.startsWith('rgb(')) {
                    return color.replace('rgb(', 'rgba(').replace(')', `, ${alpha})`);
                }
                console.warn(
                    "Utils.transparentize expects an rgb string for best results with current implementation.");
                return color;
            }
        };

        const ctx = document.getElementById('myBarChart').getContext('2d');

        const newBorderColor = '#6041CE';
        const newBackgroundColor = 'rgba(96, 65, 206, 0.5)';

        const myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Pengajuan',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    borderColor: newBorderColor,
                    backgroundColor: newBackgroundColor,
                    borderWidth: 2,
                    barPercentage: 0.8,
                    categoryPercentage: 0.7,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: 100,
                        ticks: {
                            stepSize: 20
                        }
                    }
                },
                elements: {
                    bar: {
                        borderRadius: {
                            topLeft: 8,
                            topRight: 8,
                            bottomLeft: 8,
                            bottomRight: 8
                        }
                    }
                }
            }
        });
    </script>

    <script>
        const donutData = {
            labels: ['Akademik', 'Non-Akademik'],
            datasets: [{
                label: 'Jenis Prestasi',
                data: [70, 30],
                backgroundColor: [
                    '#6041CE',
                    '#FB8500'
                ],
                hoverOffset: 8,
                borderRadius: 8,
            }]
        };

        const donutConfig = {
            type: 'doughnut',
            data: donutData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: {
                        position: 'right',
                        align: 'center',
                        labels: {
                            boxWidth: 12,
                            padding: 20,
                            font: {
                                size: 14
                            }
                        }
                    },
                    title: {
                        display: false,
                        text: 'Jenis Prestasi'
                    },
                }
            }
        };

        const ctxDonut = document.getElementById('myDonutChart');
        if (ctxDonut) {
            const myDonutChart = new Chart(ctxDonut.getContext('2d'), donutConfig);
        } else {
            console.error("Peringatan: Elemen canvas dengan id 'myDonutChart' tidak ditemukan saat mencoba membuat chart.");
        }
    </script>

    {{-- Tampilkan Tabel peringkat mahasiswa dengan 2 pilihan metode pemeringkatan entropy dan electre --}}
    <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm">

        <label for="metode" class="block mb-2 text-sm font-medium text-gray-900">Pilih Metode Pemeringkatan</label>
        <select id="metode"
            class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="entropy">Entropy</option>
            <option value="electre">Electre</option>
        </select>
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
    </div>

    <script>
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

        document.getElementById('metode').addEventListener('change', function() {
            updateChart(this.value);
        });

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
