@extends('dosen.layouts.app')

@section('title', 'Daftar Bimbingan')

@section('content')
    <div class="mx-auto max-w-full h-full flex flex-col">
        {{-- <h1 class="text-xl font-bold mb-4">Daftar Mahasiswa Bimbingan</h1> --}}

        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-2">
                <label for="show-entry" class="text-sm font-medium text-gray-700">Tampilkan</label>
                <select id="show-entry"
                    class="appearance-none bg-white border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#6041CE] focus:border-transparent transition-shadow">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="40">40</option>
                </select>
                <span class="text-sm font-medium text-gray-700">data</span>
            </div>
        </div>

        <div class="overflow-x-auto bg-white shadow rounded border border-gray-200">
            <table id="table_mahasiswa" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50" style="height: 40px;">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mahasiswa</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program Studi</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-body" class="bg-white divide-y divide-gray-200">
                    @forelse ($mahasiswaBimbingan as $index => $mahasiswa)
                        <tr class="data-row" data-index="{{ $index }}">
                            <td class="px-4 py-2 text-sm text-gray-900">{{ $mahasiswa->nim }}</td>
                            <td class="px-4 py-2 text-sm text-gray-900">{{ $mahasiswa->nama }}</td>
                            <td class="px-4 py-2 text-sm text-gray-900">{{ $mahasiswa->username }}</td>
                            <td class="px-4 py-2 text-sm text-gray-900">{{ $mahasiswa->email }}</td>
                            <td class="px-4 py-2 text-sm text-gray-900">{{ $mahasiswa->program_studi }}</td>
                            <td class="px-4 py-2 text-sm text-gray-900">
                                <a href="{{ route('dosen.bimbingan.detail', $mahasiswa->id) }}" class="action-button detail-button" title="Detail">
                                    <i class="fas fa-eye text-[18px]"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-4">Tidak ada mahasiswa bimbingan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-4 py-3 text-sm text-gray-600">
                Menampilkan <span id="shown-count">{{ count($mahasiswaBimbingan) }}</span> mahasiswa dari {{ count($mahasiswaBimbingan) }} data {{ \Illuminate\Support\Str::plural('mahasiswa', count($mahasiswaBimbingan)) }}.
            </div>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const dropdown = document.getElementById("show-entry");
            const rows = document.querySelectorAll(".data-row");
            const shownCount = document.getElementById("shown-count");

            function paginateData(perPage) {
                let shown = 0;
                rows.forEach((row, index) => {
                    if (index < perPage) {
                        row.style.display = "";
                        shown++;
                    } else {
                        row.style.display = "none";
                    }
                });
                shownCount.textContent = shown;
            }

            dropdown.addEventListener("change", function () {
                const perPage = parseInt(this.value);
                paginateData(perPage);
            });

            // Initial load
            paginateData(parseInt(dropdown.value));
        });
    </script>
@endsection
