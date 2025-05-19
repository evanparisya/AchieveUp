@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="flex flex-wrap items-center justify-between mb-4 gap-2">
        <div>
            <label class="text-sm text-gray-700 mr-2">Show</label>
            <select id="show-entry" class="border rounded px-2 py-1 text-sm">
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
            <span class="text-sm text-gray-700 ml-2">entries</span>
        </div>
        <div class="flex items-center gap-2">
            <input id="search-bar" type="text" placeholder="Search..." class="border rounded px-2 py-1 text-sm" />
            <button id="btn-add-user" class="bg-blue-600 text-white px-4 py-1 rounded text-sm hover:bg-blue-700">
            + Add
        </button>
        </div>
    </div>
    <div x-data="{ tab: 'mahasiswa' }" x-init="$watch('tab', value => window.tab = value)">
        <!-- Tab Button Group -->
        <div class="flex mb-0">
            <button
                class="px-4 py-2 rounded-t-[12px] focus:outline-none transition-all duration-150 border border-b-0"
                :class="tab === 'mahasiswa' 
                    ? 'bg-white font-semibold text-primary border-gray-200'
                    : 'bg-gray-100 text-gray-500 hover:text-blue-600 border-transparent'"
                @click="tab = 'mahasiswa'">
                Mahasiswa
            </button>
            <button
                class="px-4 py-2 rounded-t-[12px] focus:outline-none transition-all duration-150 ml-1 border border-b-0"
                :class="tab === 'dosen' 
                    ? 'bg-white font-semibold text-primary border-gray-200'
                    : 'bg-gray-100 text-gray-500 hover:text-blue-600 border-transparent'"
                @click="tab = 'dosen'">
                Dosen
            </button>
        </div>

        <!-- Table Wrapper -->
        <div class="overflow-x-auto bg-white shadow rounded-b-[12px] border-t-0 border border-gray-200">
            <!-- Tab Mahasiswa -->
            <div x-show="tab === 'mahasiswa'">
                <table id="table_mahasiswa" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mahasiswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program Studi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                    </tbody>
                </table>
                <p id="mahasiswa_info" class="text-sm text-gray-500 mt-2"></p>
                <div id="mahasiswa_pagination" class="mt-2 flex flex-wrap gap-2"></div>
            </div>

            <!-- Tab Dosen -->
            <div x-show="tab === 'dosen'">
                <table id="table_dosen" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIDN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                    </tbody>
                </table>
                <p id="dosen_info" class="text-sm text-gray-500 mt-2"></p>
                <div id="dosen_pagination" class="mt-2 flex flex-wrap gap-2"></div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '#btn-add-user', function () {
            Swal.fire({
                title: 'Tambah Data',
                text: "Pilih tipe data yang ingin ditambahkan",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Mahasiswa',
                cancelButtonText: 'Dosen',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('users/create?type=mahasiswa') }}";
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    window.location.href = "{{ url('users/create?type=dosen') }}";
                }
            });
        });
    </script>

<script src="//unpkg.com/alpinejs" defer></script>

<script src="{{ asset('js/mahasiswa.js') }}"></script>
<script src="{{ asset('js/dosen.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#show-entry, #search-bar').on('input change', function () {
            let activeTab = window.tab;
            if (activeTab === 'mahasiswa') {
                window.loadMahasiswa();
            } else if (activeTab === 'dosen') {
                window.loadDosen();
            }
        });
    });
</script>

<script>
   $(document).on('click', '#btn-add-user', function () {
    Swal.fire({
        title: 'Tambah Data',
        text: "Pilih tipe data yang ingin ditambahkan",
        icon: 'question',
        showCloseButton: true, // ← ini untuk tombol X
        showCancelButton: true,
        confirmButtonText: 'Mahasiswa',
        cancelButtonText: 'Dosen',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ url('users/create?type=mahasiswa') }}";
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            window.location.href = "{{ url('users/create?type=dosen') }}";
        }
        // Jika ditutup pakai tombol X
        else if (result.dismiss === Swal.DismissReason.close) {
            console.log('Modal ditutup dengan tombol X');
        }
    });
});
</script>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif
@endsection