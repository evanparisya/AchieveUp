@extends('admin.layouts.app')

@section('title', 'Tambah Rekomendasi')

@section('content')
    <div class="container">

        <!-- Lomba Header -->
        <div class="highlight-card from-blue-50 to-indigo-50 mb-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-indigo-800">{{ $lomba->judul }}</h1>
                    <div class="flex flex-wrap items-center gap-3 mt-2">
                        <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-sm rounded-full">
                            {{ $lomba->tingkat }}
                        </span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full">
                            Bidang: {{ $lomba->bidang->pluck('nama')->join(', ') }}
                        </span>
                    </div>
                </div>
                <div class="text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>
                            {{ \Carbon\Carbon::parse($lomba->tanggal_daftar)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($lomba->tanggal_daftar_terakhir)->format('d M Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ranking Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
            <!-- ARAS Ranking -->
            <div class="highlight-card from-blue-50 to-purple-50">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <span class="rank-badge bg-purple-100 text-purple-800">A</span>
                        Ranking ARAS
                    </h2>
                    <span class="text-xs px-2 py-1 bg-purple-100 text-purple-800 rounded-full">Nilai Utility</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rank</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mahasiswa</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ki</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($rankAras as $i => $data)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span
                                            class="rank-badge {{ $i < 3 ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $i + 1 }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-gray-900">{{ $data['nama'] }}</div>
                                        <div class="text-sm text-gray-500">{{ $data['nim'] }}</div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-right font-mono">
                                        {{ isset($data['nilaiKi']) ? number_format($data['nilaiKi'], 4) : '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ELECTRE Ranking -->
            <div class="highlight-card from-green-50 to-teal-50">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <span class="rank-badge bg-teal-100 text-teal-800">E</span>
                        Ranking ELECTRE
                    </h2>
                    <span class="text-xs px-2 py-1 bg-teal-100 text-teal-800 rounded-full">Net Flow</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rank</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mahasiswa</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Net Flow</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($rankElectre as $i => $data)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span
                                            class="rank-badge {{ $i < 3 ? 'bg-teal-100 text-teal-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $i + 1 }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-gray-900">{{ $data['nama'] }}</div>
                                        <div class="text-sm text-gray-500">{{ $data['nim'] }}</div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-right font-mono">
                                        {{ isset($data['net_flow']) ? number_format($data['net_flow'], 4) : '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <form action="{{ route('admin.rekomendasi.store') }}" method="POST"
            class="space-y-6 max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
            @csrf
            {{-- Hidden Input Lomba ID--}}
            <input type="hidden" name="lomba_id" value="{{ $lomba->id }}">

            <!-- Step 2: Pilih Mahasiswa -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Pilih Mahasiswa</label>

                <button type="button" onclick="selectAll('mahasiswa_select')"
                    class="text-sm text-indigo-600 hover:underline mb-1">
                    Pilih Semua
                </button>
                |
                <button type="button" onclick="unselectAll('mahasiswa_select')"
                    class="text-sm text-red-600 hover:underline mb-1">
                    Hapus Semua
                </button>


                <select id="mahasiswa_select" name="mahasiswa_id[]" multiple required>
                    @foreach ($mahasiswa as $mhs)
                        <option value="{{ $mhs->id }}">{{ $mhs->nama }} - {{ $mhs->nim }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Step 3: Pilih Dosen Pembimbing -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Pilih Dosen Pembimbing</label>

                <button type="button" onclick="selectAll('dosen_select')"
                    class="text-sm text-indigo-600 hover:underline mb-1">
                    Pilih Semua
                </button>
                |
                <button type="button" onclick="unselectAll('dosen_select')"
                    class="text-sm text-red-600 hover:underline mb-1">
                    Hapus Semua
                </button>


                <select id="dosen_select" name="dosen_id[]" multiple required>
                    @foreach ($dosen as $dsn)
                        <option value="{{ $dsn->id }}">{{ $dsn->nama }} - {{ $dsn->nidn }}</option>
                    @endforeach
                </select>
            </div>




            <!-- Step 4: Submit -->
            <div class="pt-4">
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Simpan Rekomendasi
                </button>
            </div>
        </form>

    </div>

    <script>
        const mahasiswaSelect = new TomSelect('#mahasiswa_select', {
            plugins: ['remove_button'],
            maxItems: null,
        });
        window.mahasiswaSelectInstance = mahasiswaSelect;

        const dosenSelect = new TomSelect('#dosen_select', {
            plugins: ['remove_button'],
            maxItems: null,
        });
        window.dosenSelectInstance = dosenSelect;


        function selectAll(selectId) {
            const instanceMap = {
                'mahasiswa_select': window.mahasiswaSelectInstance,
                'dosen_select': window.dosenSelectInstance
            };

            const selectInstance = instanceMap[selectId];

            if (selectInstance) {
                const allValues = Object.keys(selectInstance.options);
                selectInstance.setValue(allValues);
            } else {
                console.error("Tom Select instance not found for:", selectId);
            }
        }

        function unselectAll(selectId) {
            const instanceMap = {
                'mahasiswa_select': window.mahasiswaSelectInstance,
                'dosen_select': window.dosenSelectInstance
            };

            const selectInstance = instanceMap[selectId];

            if (selectInstance) {
                selectInstance.clear();
            } else {
                console.error("Tom Select instance not found for:", selectId);
            }
        }
    </script>




@endsection
