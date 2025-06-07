@extends('mahasiswa.layouts.app')

@section('title', 'Lomba')

@section('content')
    <div class="mx-auto max-w-full h-full flex flex-col" x-data="{ activeTab: 'lomba' }">
        <!-- Tab Navigation -->
        <div class="mb-4">
            <ul class="flex border-b border-gray-200">
                <li class="mr-1">
                    <button class="px-4 py-2 text-sm font-medium"
                        :class="{ 'bg-white border-t border-l border-r border-gray-200 rounded-t-lg': activeTab === 'lomba', 'text-gray-500 hover:text-gray-700': activeTab !== 'lomba' }"
                        @click="activeTab = 'lomba'">Data Lomba</button>
                </li>
                <li class="mr-1">
                    <button class="px-4 py-2 text-sm font-medium"
                        :class="{ 'bg-white border-t border-l border-r border-gray-200 rounded-t-lg': activeTab === 'pengajuan', 'text-gray-500 hover:text-gray-700': activeTab !== 'pengajuan' }"
                        @click="activeTab = 'pengajuan'">Pengajuan Lomba</button>
                </li>
            </ul>
        </div>

        <!-- Filter and Button -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-2">
                <label for="show-entry" class="text-sm font-medium text-gray-700">Tampilkan</label>
                <select id="show-entry"
                    class="appearance-none bg-white border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#6041CE] focus:border-transparent transition-shadow">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="40">40</option>
                </select>
                <span class="text-sm font-medium text-gray-700">data</span>
            </div>
            <div class="flex items-center gap-2">
                <input id="search-bar" type="text" placeholder="Cari..." class="search-list" />
                <a href="{{ route('mahasiswa.lomba.create') }}" id="btn-add-lomba" class="button-primary-medium">
                    <i class="fas fa-plus mr-2"></i>
                    <span>Tambah</span>
                </a>
            </div>
        </div>

        <!-- Tab Content -->
        <div x-show="activeTab === 'lomba'"
            class="overflow-x-auto bg-white shadow rounded-b-[12px] border-t-0 border border-gray-200">
            <!-- Table Lomba -->
            <table id="table_lomba" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tingkat
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode
                            Pendaftaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Link</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bidang
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200"></tbody>
            </table>
            <p id="lomba_info" class="text-sm text-gray-500 mt-2 px-4"></p>
            <div id="lomba_pagination" class="mt-2 flex flex-wrap gap-2 px-4 pb-4"></div>
        </div>

        <div x-show="activeTab === 'pengajuan'"
            class="overflow-x-auto bg-white shadow rounded-b-[12px] border-t-0 border border-gray-200">
            <!-- Table Pengajuan -->
            <table id="table_pengajuan" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tingkat
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode
                            Pendaftaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200"></tbody>
            </table>
            <p id="pengajuan_info" class="text-sm text-gray-500 mt-2 px-4"></p>
            <div id="pengajuan_pagination" class="mt-2 flex flex-wrap gap-2 px-4 pb-4"></div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            let lombaData = [];
            let pengajuanData = [];
            let lombaCurrentPage = 1;
            let pengajuanCurrentPage = 1;

            function actionButtonsLomba(id) {
                return `
            <div class="flex gap-2">
                <a href="/mahasiswa/lomba/${id}" class="action-button detail-button" title="Detail">
                    <i class="fas fa-eye text-[18px]"></i>
                </a>
            </div>
            `;
            }

            function actionButtonsPengajuan(id, status) {
                let buttons = `
                <div class="flex gap-2">
                    <a href="/mahasiswa/pengajuan-lomba/${id}" class="action-button detail-button" title="Detail">
                        <i class="fas fa-eye text-[18px]"></i>
                    </a>
                `;
                    if (status === 'pending') {
                        buttons += `
                    <button type="button" class="action-button delete-button btn-hapus" data-id="${id}" data-type="pengajuan-lomba" title="Hapus">
                        <i class="fas fa-trash text-[18px]"></i>
                    </button>
                    `;
                    } else if (status === 'rejected') {
                        buttons += `
                    <a href="/mahasiswa/pengajuan-lomba/${id}/edit" class="action-button edit-button" title="Edit">
                        <i class="fas fa-edit text-[18px]"></i>
                    </a>
                    `;
                }
                buttons += `</div>`;
                return buttons;
            }

            function renderLombaTable() {
                let searchQuery = $('#search-bar').val().toLowerCase();
                let entriesToShow = parseInt($('#show-entry').val());
                let tbody = $('#table_lomba tbody');

                let filtered = lombaData.filter(item =>
                    Object.values(item).some(val => val && val.toString().toLowerCase().includes(searchQuery))
                );

                let totalData = filtered.length;
                let totalPages = Math.ceil(totalData / entriesToShow);

                let startIndex = (lombaCurrentPage - 1) * entriesToShow;
                let paginated = filtered.slice(startIndex, startIndex + entriesToShow);

                tbody.empty();
                if (totalData === 0) {
                    tbody.append(
                        '<tr><td colspan="6" class="px-6 py-4 text-sm text-gray-500 text-center">Tidak ada data lomba.</td></tr>'
                    );
                } else {
                    $.each(paginated, function(index, item) {
                        let row = `
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">${item.judul}</td>
                        <td class="px-6 py-4 text-sm text-gray-900"><span class="px-1 py-1 rounded text-xs font-semibold ${item.tingkat_warna}">
                            ${item.tingkat.charAt(0).toUpperCase() + item.tingkat.slice(1)}
                        </span></td>
                        <td class="px-6 py-4 text-sm text-gray-900">${item.periode_pendaftaran}</td>
                        <td class="px-6 py-4 text-sm text-gray-900"><a href="${item.link || '#'}" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">${item.link || '-'}</a></td>
                        <td class="px-6 py-4 text-sm text-gray-900">${item.bidang.map(b => `<span class="inline-block bg-blue-100 text-blue-800 text-xs font-medium mr-1 px-1 py-0.5 rounded">${b.nama}</span>`).join(' ')}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            ${actionButtonsLomba(item.id)}
                        </td>
                    </tr>
                    `;
                        tbody.append(row);
                    });
                }

                $("#lomba_info").text(`Menampilkan ${paginated.length} dari ${totalData} data lomba`);

                let paginationHtml = '';
                for (let i = 1; i <= totalPages; i++) {
                    paginationHtml +=
                        `<button class="px-3 py-2 rounded-md text-sm ${i === lombaCurrentPage ? 'bg-[#6041CE] text-white' : 'bg-gray-200'} page-btn-lomba" data-page="${i}">${i}</button>`;
                }
                $("#lomba_pagination").html(paginationHtml);

                $(".page-btn-lomba").on("click", function() {
                    lombaCurrentPage = parseInt($(this).data("page"));
                    renderLombaTable();
                });
            }

            function renderPengajuanTable() {
                let searchQuery = $('#search-bar').val().toLowerCase();
                let entriesToShow = parseInt($('#show-entry').val());
                let tbody = $('#table_pengajuan tbody');

                // Filter only pending and rejected pengajuan
                let filtered = Array.isArray(pengajuanData) ? pengajuanData.filter(item =>
                    (item.status === 'pending' || item.status === 'rejected') &&
                    Object.values(item).some(val => val && val.toString().toLowerCase().includes(searchQuery))
                ) : [];

                let totalData = filtered.length;
                let totalPages = Math.ceil(totalData / entriesToShow);

                let startIndex = (pengajuanCurrentPage - 1) * entriesToShow;
                let paginated = filtered.slice(startIndex, startIndex + entriesToShow);

                tbody.empty();
                if (totalData === 0) {
                    tbody.append(
                        '<tr><td colspan="7" class="px-6 py-4 text-sm text-gray-500 text-center">Tidak ada data pengajuan.</td></tr>'
                    );
                } else {
                    $.each(paginated, function(index, item) {
                        let row = `
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">${item.judul}</td>
                        <td class="px-6 py-4 text-sm text-gray-900"><span class="px-1 py-1 rounded text-xs font-semibold ${item.tingkat_warna}">
                            ${item.tingkat.charAt(0).toUpperCase() + item.tingkat.slice(1)}
                        </span></td>
                        <td class="px-6 py-4 text-sm text-gray-900">${item.periode_pendaftaran}</td>
                        <td class="px-6 py-4 text-sm text-gray-900"><span class="px-1 py-1 rounded text-xs font-semibold ${item.status_warna}">
                            ${item.status.charAt(0).toUpperCase() + item.status.slice(1)}
                        </span></td>
                        <td class="px-6 py-4 text-sm text-gray-900">${item.notes || '-'}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">${item.admin ? item.admin.nama : '-'}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            ${actionButtonsPengajuan(item.id, item.status)}
                        </td>
                    </tr>
                    `;
                        tbody.append(row);
                    });
                }

                $("#pengajuan_info").text(`Menampilkan ${paginated.length} dari ${totalData} data pengajuan`);

                let paginationHtml = '';
                for (let i = 1; i <= totalPages; i++) {
                    paginationHtml +=
                        `<button class="px-3 py-2 rounded-md text-sm ${i === pengajuanCurrentPage ? 'bg-[#6041CE] text-white' : 'bg-gray-200'} page-btn-pengajuan" data-page="${i}">${i}</button>`;
                }
                $("#pengajuan_pagination").html(paginationHtml);

                $(".page-btn-pengajuan").on("click", function() {
                    pengajuanCurrentPage = parseInt($(this).data("page"));
                    renderPengajuanTable();
                });
            }

            function loadLomba() {
                $.ajax({
                    url: '/mahasiswa/lomba/getall',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        lombaData = Array.isArray(response) ? response : [];
                        lombaCurrentPage = 1;
                        renderLombaTable();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading lomba:', status, error);
                        lombaData = [];
                        renderLombaTable();
                    }
                });
            }

            function loadPengajuan() {
                $.ajax({
                    url: '/mahasiswa/lomba/getpengajuan',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        pengajuanData = Array.isArray(response.data) ? response.data : [];
                        pengajuanCurrentPage = 1;
                        renderPengajuanTable();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading pengajuan:', status, error);
                        pengajuanData = [];
                        renderPengajuanTable();
                    }
                });
            }

            $(document).on('click', '.btn-hapus', function() {
                const id = $(this).data('id');
                const type = $(this).data('type');
                if (type === 'pengajuan-lomba') {
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data pengajuan yang dihapus tidak dapat dikembalikan.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#aaa',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `/mahasiswa/lomba/${id}`,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                success: function(res) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Pengajuan berhasil dihapus.',
                                        timer: 1500,
                                        showConfirmButton: false
                                    });
                                    loadPengajuan();
                                },
                                error: function(xhr) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: 'Terjadi kesalahan saat menghapus pengajuan.',
                                    });
                                }
                            });
                        }
                    });
                }
            });

            $('#search-bar, #show-entry').on('input change', function() {
                lombaCurrentPage = 1;
                pengajuanCurrentPage = 1;
                renderLombaTable();
                renderPengajuanTable();
            });

            window.loadLomba = loadLomba;
            window.loadPengajuan = loadPengajuan;
            loadLomba();
            loadPengajuan();
        });
    </script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    showConfirmButton: true
                });
            });
        </script>
    @endif
@endsection
