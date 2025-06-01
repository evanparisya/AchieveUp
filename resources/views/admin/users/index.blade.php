@extends('admin.layouts.app')

@section('title', 'Pengguna')

@section('content')
    <div class="mx-auto max-w-full h-full flex flex-col">
        <h1 class="text-xl font-bold mb-4">Daftar Pengguna</h1>

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
            <div class="flex items-center gap-2">
                <input id="search-bar" type="text" placeholder="Cari..." class="input" />
                <button id="btn-add-user" class="button-primary-medium">
                    <i class="fas fa-plus mr-2"></i>
                    <span>Tambah</span>
                </button>
            </div>
        </div>

        <div x-data="{ tab: 'mahasiswa' }" x-init="$watch('tab', value => window.tab = value)">
            <div class="flex mb-0">
                <button class="px-4 py-2 rounded-t-[12px] focus:outline-none transition-all duration-150 border border-b-0"
                    :class="tab === 'mahasiswa'
                        ?
                        'bg-white font-semibold text-primary border-gray-200' :
                        'bg-gray-100 text-gray-500 hover:text-blue-600 border-transparent'"
                    @click="tab = 'mahasiswa'">
                    Mahasiswa
                </button>
                <button
                    class="px-4 py-2 rounded-t-[12px] focus:outline-none transition-all duration-150 ml-1 border border-b-0"
                    :class="tab === 'dosen'
                        ?
                        'bg-white font-semibold text-primary border-gray-200' :
                        'bg-gray-100 text-gray-500 hover:text-blue-600 border-transparent'"
                    @click="tab = 'dosen'">
                    Dosen
                </button>
            </div>

            <div class="flex-1 overflow-x-auto bg-white shadow rounded border border-gray-200">
                <div x-show="tab === 'mahasiswa'">
                    <table id="table_mahasiswa" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NIM</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Mahasiswa</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Username</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Program Studi</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table_mahasiswa_body" class="bg-white divide-y divide-gray-200 overflow-y-auto">
                        </tbody>
                    </table>
                    <p id="mahasiswa_info" class="text-sm text-gray-500 mt-2 px-4"></p>
                    <div id="mahasiswa_pagination" class="mt-2 flex flex-wrap gap-2 px-4 pb-4"></div>
                </div>

                <div x-show="tab === 'dosen'">
                    <table id="table_dosen" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NIDN</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Username</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table_dosen_body" class="bg-white divide-y divide-gray-200 overflow-y-auto">
                        </tbody>
                    </table>
                    <p id="dosen_info" class="text-sm text-gray-500 mt-2 px-4"></p>
                    <div id="dosen_pagination" class="mt-2 flex flex-wrap gap-2 px-4 pb-4"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '#btn-add-user', function() {
            Swal.fire({
                title: 'Tambah Data',
                text: "Pilih tipe data yang ingin ditambahkan",
                icon: 'question',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'Mahasiswa',
                cancelButtonText: 'Dosen',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('admin/users/create?type=mahasiswa') }}";
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    window.location.href = "{{ url('admin/users/create?type=dosen') }}";
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let mahasiswaData = [];
            let currentPage = 1;

            function actionButtonsMahasiswa(id) {
                return `
                    <div class="flex gap-2">
                        <a href="/admin/users/${id}" class="action-button detail-button" title="Detail">
                            <i class="fas fa-eye text-[18px]"></i>
                        </a>
                        <a href="/admin/users/mahasiswa/${id}/update" class="action-button edit-button" title="Update">
                            <i class="fas fa-edit text-[18px]"></i>
                        </a>
                        <button type="button" class="action-button delete-button btn-hapus" data-id="${id}" data-type="mahasiswa" title="Hapus">
                            <i class="fas fa-trash text-[18px]"></i>
                        </button>
                    </div>
                `;
            }

            function setTableHeightMahasiswa(entriesToShow) {
                const rowHeight = 48;
                const headerHeight = 40;
                const tableHeight = entriesToShow * rowHeight + headerHeight;
                $('#table_mahasiswa').css('max-height', `${tableHeight}px`);
                $('#table_mahasiswa thead').css('height', `${headerHeight}px`);
                $('#table_mahasiswa tbody').css('max-height', `${entriesToShow * rowHeight}px`);
            }

            function renderMahasiswaTable() {
                let searchQuery = $('#search-bar').val().toLowerCase();
                let entriesToShow = parseInt($('#show-entry').val()) || 5;
                let tbody = $('#table_mahasiswa tbody');

                let filtered = mahasiswaData.filter(item =>
                    Object.values(item).some(val => val && val.toString().toLowerCase().includes(searchQuery))
                );

                let totalData = filtered.length;
                let totalPages = Math.ceil(totalData / entriesToShow);
                let startIndex = (currentPage - 1) * entriesToShow;
                let paginated = filtered.slice(startIndex, startIndex + entriesToShow);

                tbody.empty();

                $.each(paginated, function(index, item) {
                    let row = `
                        <tr class="h-12">
                            <td class="px-6 py-4 text-sm text-gray-900">${item.nim}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">${item.nama}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">${item.username}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">${item.email}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">${item.program_studi ?? '-'}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                ${actionButtonsMahasiswa(item.id)}
                            </td>
                        </tr>
                    `;
                    tbody.append(row);
                });

                let remaining = entriesToShow - paginated.length;
                for (let i = 0; i < remaining; i++) {
                    tbody.append(
                        '<tr class="h-12"><td colspan="6" class="px-6 py-4 text-sm text-gray-400"></td></tr>');
                }

                $("#mahasiswa_info").text(`Menampilkan ${paginated.length} dari ${totalData} data mahasiswa`);

                let paginationHtml = '';
                for (let i = 1; i <= totalPages; i++) {
                    paginationHtml +=
                        `<button class="px-3 py-1 rounded ${i === currentPage ? 'bg-primary text-white' : 'bg-gray-200'} page-btn-mhs" data-page="${i}">${i}</button> `;
                }

                $("#mahasiswa_pagination").html(paginationHtml);

                $(".page-btn-mhs").off("click").on("click", function() {
                    currentPage = parseInt($(this).data("page"));
                    renderMahasiswaTable();
                });

                setTableHeightMahasiswa(entriesToShow);
            }

            function loadMahasiswa() {
                $.ajax({
                    url: '/admin/users/mahasiswa/getdata',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        mahasiswaData = response;
                        currentPage = 1;
                        renderMahasiswaTable();
                    }
                });
            }

            $('#search-bar, #show-entry').on('input change', function() {
                currentPage = 1;
                renderMahasiswaTable();
            });

            window.loadMahasiswa = loadMahasiswa;
            loadMahasiswa();
        });
    </script>

    <script>
        $(document).ready(function() {
            let dosenData = [];
            let currentPage = 1;

            function actionButtonsDosen(id) {
                return `
                    <div class="flex gap-2">
                        <a href="/admin/users/${id}" class="action-button detail-button" title="Detail">
                            <i class="fas fa-eye text-[18px]"></i>
                        </a>
                        <a href="/admin/users/dosen/${id}/update" class="action-button edit-button" title="Update">
                            <i class="fas fa-edit text-[18px]"></i>
                        </a>
                        <button type="button" class="action-button delete-button btn-hapus" data-id="${id}" data-type="dosen" title="Hapus">
                            <i class="fas fa-trash text-[18px]"></i>
                        </button>
                    </div>
                `;
            }

            function setTableHeightDosen(entriesToShow) {
                const rowHeight = 48;
                const headerHeight = 40;
                const tableHeight = entriesToShow * rowHeight + headerHeight;
                $('#table_dosen').css('max-height', `${tableHeight}px`);
                $('#table_dosen thead').css('height', `${headerHeight}px`);
                $('#table_dosen tbody').css('max-height', `${entriesToShow * rowHeight}px`);
            }

            function renderDosenTable() {
                let searchQuery = $('#search-bar').val().toLowerCase();
                let entriesToShow = parseInt($('#show-entry').val()) || 5;
                let tbody = $('#table_dosen tbody');

                let filtered = dosenData.filter(item =>
                    Object.values(item).some(val => val && val.toString().toLowerCase().includes(searchQuery))
                );

                let totalData = filtered.length;
                let totalPages = Math.ceil(totalData / entriesToShow);
                let startIndex = (currentPage - 1) * entriesToShow;
                let paginated = filtered.slice(startIndex, startIndex + entriesToShow);

                tbody.empty();

                $.each(paginated, function(index, item) {
                    let row = `
                        <tr class="h-12">
                            <td class="px-6 py-4 text-sm text-gray-900">${item.nidn}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">${item.nama}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">${item.username}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">${item.email}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">${item.role}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                ${actionButtonsDosen(item.id)}
                            </td>
                        </tr>
                    `;
                    tbody.append(row);
                });

                let remaining = entriesToShow - paginated.length;
                for (let i = 0; i < remaining; i++) {
                    tbody.append(
                        '<tr class="h-12"><td colspan="6" class="px-6 py-4 text-sm text-gray-400"></td></tr>');
                }

                $("#dosen_info").text(`Menampilkan ${paginated.length} dari ${totalData} data dosen`);

                let paginationHtml = '';
                for (let i = 1; i <= totalPages; i++) {
                    paginationHtml +=
                        `<button class="px-2 py-1 rounded ${i === currentPage ? 'bg-primary text-white' : 'bg-gray-200'} page-btn" data-page="${i}">${i}</button> `;
                }

                $("#dosen_pagination").html(paginationHtml);

                $(".page-btn").off("click").on("click", function() {
                    currentPage = parseInt($(this).data("page"));
                    renderDosenTable();
                });

                setTableHeightDosen(entriesToShow);
            }

            function loadDosen() {
                $.ajax({
                    url: '/admin/users/dosen/getdata',
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        dosenData = response;
                        currentPage = 1;
                        renderDosenTable();
                    }
                });
            }

            $('#search-bar, #show-entry').on('input change', function() {
                currentPage = 1;
                renderDosenTable();
            });

            window.loadDosen = loadDosen;
            loadDosen();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#show-entry, #search-bar').on('input change', function() {
                let activeTab = window.tab;
                if (activeTab === 'mahasiswa') {
                    window.loadMahasiswa();
                } else if (activeTab === 'dosen') {
                    window.loadDosen();
                }
            });
        });

        $(document).on('click', '.btn-hapus', function() {
            let id = $(this).data('id');
            let type = $(this).data('type');
            let url = `/admin/users/${type}/${id}`;
            let method = 'DELETE';

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: method,
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Terhapus!',
                                response.success || 'Data berhasil dihapus.',
                                'success'
                            ).then(() => {
                                if (type === 'mahasiswa') {
                                    window.loadMahasiswa();
                                } else if (type === 'dosen') {
                                    window.loadDosen();
                                }
                            });
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Gagal!',
                                xhr.responseJSON.error || 'Tidak dapat menghapus data.',
                                'error'
                            );
                        }
                    });
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
