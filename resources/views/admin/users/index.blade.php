@extends('admin.layouts.app')

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

<script>
    $(document).ready(function () {
        let mahasiswaData = [];
        let currentPage = 1;

        function actionButtonsMahasiswa(id) {
            return `
                <a href="/users/${id}" class="text-blue-600 hover:underline mr-2">Detail</a>
                <a href="/users/${id}/edit" class="text-yellow-600 hover:underline mr-2">Edit</a>
                <button type="button" class="text-red-600 hover:underline btn-hapus" data-id="${id}" data-type="mahasiswa">Hapus</button>
            `;
        }

        function renderMahasiswaTable() {
            let searchQuery = $('#search-bar').val().toLowerCase();
            let entriesToShow = parseInt($('#show-entry').val());
            let tbody = $('#table_mahasiswa tbody');

            let filtered = mahasiswaData.filter(item =>
                Object.values(item).some(val => val && val.toString().toLowerCase().includes(searchQuery))
            );

            let totalData = filtered.length;
            let totalPages = Math.ceil(totalData / entriesToShow);

            // Pagination slice
            let startIndex = (currentPage - 1) * entriesToShow;
            let paginated = filtered.slice(startIndex, startIndex + entriesToShow);

            tbody.empty();
            $.each(paginated, function (index, item) {
                let row = `
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">${item.nim}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">${item.nama}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">${item.username}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">${item.email}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">${item.program_studi ?? '-'}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            ${actionButtonsMahasiswa(item.id_mhs)}
                        </td>
                    </tr>
                `;
                tbody.append(row);
            });

            // Info total
            $("#mahasiswa_info").text(`Menampilkan ${paginated.length} dari ${totalData} data mahasiswa`);

            // Pagination
            let paginationHtml = '';
            for (let i = 1; i <= totalPages; i++) {
                paginationHtml += `<button class="px-2 py-1 rounded ${i === currentPage ? 'bg-blue-500 text-white' : 'bg-gray-200'} page-btn-mhs" data-page="${i}">${i}</button> `;
            }
            $("#mahasiswa_pagination").html(paginationHtml);

            $(".page-btn-mhs").on("click", function () {
                currentPage = parseInt($(this).data("page"));
                renderMahasiswaTable();
            });
        }

        function loadMahasiswa() {
            $.ajax({
                url: '/admin/users/mahasiswa/getdata',      
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    mahasiswaData = response;
                    currentPage = 1;
                    renderMahasiswaTable();
                }
            });
        }

        $('#search-bar, #show-entry').on('input change', function () {
            currentPage = 1;
            renderMahasiswaTable();
        });

        window.loadMahasiswa = loadMahasiswa;
        loadMahasiswa();
    });
</script>

<script>
    $(document).ready(function () {
    let dosenData = [];
    let currentPage = 1;

    function actionButtonsDosen(id) {
        return `
            <a href="/users/${id}" class="text-blue-600 hover:underline mr-2">Detail</a>
            <a href="/users/${id}/edit" class="text-yellow-600 hover:underline mr-2">Edit</a>
            <button type="button" class="text-red-600 hover:underline btn-hapus" data-id="${id}" data-type="dosen">Hapus</button>
        `;
    }

    function renderDosenTable() {
        let searchQuery = $('#search-bar').val().toLowerCase();
        let entriesToShow = parseInt($('#show-entry').val());
        let tbody = $('#table_dosen tbody');
        
        let filtered = dosenData.filter(item =>
            Object.values(item).some(val => val && val.toString().toLowerCase().includes(searchQuery))
        );

        let totalData = filtered.length;
        let totalPages = Math.ceil(totalData / entriesToShow);

        // Hitung slice data berdasarkan halaman aktif
        let startIndex = (currentPage - 1) * entriesToShow;
        let paginated = filtered.slice(startIndex, startIndex + entriesToShow);

        tbody.empty();
        $.each(paginated, function (index, item) {
            let row = `
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">${item.nidn}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">${item.nama}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">${item.username}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">${item.email}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">${item.role}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        ${actionButtonsDosen(item.id_dsn)}
                    </td>
                </tr>
            `;
            tbody.append(row);
        });

        // Tampilkan info jumlah data
        $("#dosen_info").text(`Menampilkan ${paginated.length} dari ${totalData} data dosen`);

        // Tampilkan pagination
        let paginationHtml = '';
        for (let i = 1; i <= totalPages; i++) {
            paginationHtml += `<button class="px-2 py-1 rounded ${i === currentPage ? 'bg-blue-500 text-white' : 'bg-gray-200'} page-btn" data-page="${i}">${i}</button> `;
        }
        $("#dosen_pagination").html(paginationHtml);

        // Event klik halaman
        $(".page-btn").on("click", function () {
            currentPage = parseInt($(this).data("page"));
            renderDosenTable();
        });
    }

    function loadDosen() {
        $.ajax({
            url: 'users/dosen/getdata',
            method: "GET",
            dataType: "json",
            success: function (response) {
                dosenData = response;
                currentPage = 1;
                renderDosenTable();
            }
        });
    }

    $('#search-bar, #show-entry').on('input change', function () {
        currentPage = 1;
        renderDosenTable();
    });

        window.loadDosen = loadDosen;
        loadDosen();
    });
</script>

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
                window.location.href = "{{ url('admin/create?type=mahasiswa') }}";
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                window.location.href = "{{ url('admin/create?type=dosen') }}";
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