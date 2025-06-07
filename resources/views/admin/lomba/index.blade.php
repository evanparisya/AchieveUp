@extends('admin.layouts.app')

@section('title', 'Lomba')

@section('content')
    <div class="mx-auto max-w-full h-full flex flex-col">
        <!-- Filter and Tabs -->
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
                <a href="{{ route('admin.lomba.create') }}" id="btn-add-lomba" class="button-primary-medium">
                    <i class="fas fa-plus mr-2"></i>
                    <span>Tambah</span>
                </a>
            </div>
        </div>

        <!-- Tabs -->
        <div class="mb-4">
            <ul class="flex border-b border-gray-200">
                <li class="mr-1">
                    <button id="tab-lomba"
                        class="tab-button active px-4 py-2 text-sm font-medium text-gray-700 bg-white border-b-2 border-[#6041CE]">
                        Lomba
                    </button>
                </li>
                <li>
                    <button id="tab-pengajuan"
                        class="tab-button px-4 py-2 text-sm font-medium text-gray-700 bg-white border-b-2 border-transparent hover:border-gray-300">
                        Pengajuan
                    </button>
                </li>
            </ul>
        </div>

        <!-- Table Wrapper -->
        <div class="flex-1 overflow-x-auto bg-white shadow rounded border border-gray-200">
            <!-- Tab Lomba -->
            <div id="content-lomba" class="tab-content">
                <table id="table_lomba" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tingkat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Periode Pendaftaran</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Link
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Bidang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200"></tbody>
                </table>
                <p id="lomba_info" class="text-sm text-gray-500 mt-2 px-4"></p>
                <div id="lomba_pagination" class="mt-2 flex flex-wrap gap-2 px-4 pb-4"></div>
            </div>

            <!-- Tab Pengajuan -->
            <div id="content-pengajuan" class="tab-content hidden">
                <table id="table_pengajuan" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pengaju</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tingkat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Periode Pendaftaran</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Link
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Bidang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y"></tbody>
                </table>
                <p id="pengajuan_info" class="text-sm text-gray-500 mt-2 px-4"></p>
                <div id="pengajuan_pagination" class="mt-2 flex flex-wrap gap-2 px-4 pb-4"></div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let lombaData = [];
            let pengajuanData = [];
            let lombaCurrentPage = 1;
            let pengajuanCurrentPage = 1;
            let activeTab = 'lomba';

            function actionButtonsLomba(id) {
                return `
                <div class="flex gap-2">
                    <a href="/admin/lomba/${id}" class="action-button detail-button" title="Detail">
                        <i class="fas fa-eye text-blue-500"></i>
                    </a>
                    <a href="/admin/lomba/edit/${id}" class="action-button edit-button" title="Edit">
                        <i class="fas fa-edit text-yellow-500"></i>
                    </a>
                    <button type="button" class="action-button delete-button btn-hapus" data-id="${id}" data-type="lomba" title="Hapus">
                        <i class="fas fa-trash text-red-500"></i>
                    </button>
                </div>
                `;
            }

            function actionButtonsPengajuan(id, status) {
                let buttons = `
                <div class="flex gap-2">
                    <a href="/admin/pengajuan-lomba/${id}" class="action-button detail-button" title="Detail">
                        <i class="fas fa-eye text-[18px]"></i>
                    </a>
                `;
                if (status === 'pending') {
                    buttons += `
                    <div class="flex gap-2">
            <button type="button" class="action-button approve-button btn-approve" data-id="${id}" title="Setujui">
                <i class="fas fa-check-circle text-green-500 text-[18px]"></i>
            </button>
            <button type="button" class="action-button reject-button btn-reject" data-id="${id}" title="Tolak">
                <i class="fas fa-times-circle text-red-500 text-[18px]"></i>
            </button>
        </div>
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
                        `<button class="px-3 py-1 rounded ${i === lombaCurrentPage ? 'bg-[#6041CE] text-white' : 'bg-gray-200'} page-btn-lomba" data-page="${i}">${i}</button> `;
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

                // Filter dulu sesuai search
                let filtered = pengajuanData.filter(item =>
                    Object.values(item).some(val => val && val.toString().toLowerCase().includes(searchQuery))
                );

                // Sort supaya status 'pending' muncul paling atas
                filtered.sort((a, b) => {
                    if (a.status === 'pending' && b.status !== 'pending') return -1;
                    if (a.status !== 'pending' && b.status === 'pending') return 1;
                    return 0;
                });

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
                            <td class="px-6 py-4 text-sm text-gray-900">${item.mahasiswa.nama}</td>
                            <td class="px-6 py-4 text-sm text-gray-900"><span class="px-1 py-1 rounded text-xs font-semibold ${item.tingkat_warna}">
                                ${item.tingkat.charAt(0).toUpperCase() + item.tingkat.slice(1)}
                            </span></td>
                            <td class="px-6 py-4 text-sm text-gray-900">${item.periode_pendaftaran}</td>
                            <td class="px-6 py-4 text-sm text-gray-900"><a href="${item.link || '#'}" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">${item.link || '-'}</a></td>
                            <td class="px-6 py-4 text-sm text-gray-900">${item.bidang.map(b => `<span class="inline-block bg-blue-100 text-blue-800 text-xs font-medium mr-1 px-1 py-0.5 rounded">${b.nama}</span>`).join(' ')}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <span class="px-1 py-1 rounded text-xs font-semibold ${item.status_warna}">
                                    ${item.status.charAt(0).toUpperCase() + item.status.slice(1)}
                                </span>
                            </td>
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
                        `<button class="px-3 py-1 rounded ${i === pengajuanCurrentPage ? 'bg-[#6041CE] text-white' : 'bg-gray-200'} page-btn-pengajuan" data-page="${i}">${i}</button> `;
                }
                $("#pengajuan_pagination").html(paginationHtml);

                $(".page-btn-pengajuan").on("click", function() {
                    pengajuanCurrentPage = parseInt($(this).data("page"));
                    renderPengajuanTable();
                });
            }

            function loadLomba() {
                $.ajax({
                    url: '/admin/lomba/getall',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        lombaData = response;
                        lombaCurrentPage = 1;
                        renderLombaTable();
                    },
                    error: function(xhr) {
                        console.error('Error loading lomba:', xhr);
                    }
                });
            }

            function loadPengajuan() {
                $.ajax({
                    url: '/admin/lomba/getpengajuan',
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
            // Tab switching
            $('.tab-button').on('click', function() {
                $('.tab-button').removeClass('active border-[#6041CE]').addClass(
                    'border-transparent hover:border-gray-300');
                $(this).addClass('active border-[#6041CE]').removeClass(
                    'border-transparent hover:border-gray-300');

                $('.tab-content').addClass('hidden');
                let tabId = $(this).attr('id').replace('tab-', 'content-');
                $(`#${tabId}`).removeClass('hidden');

                activeTab = $(this).attr('id').replace('tab-', '');
                if (activeTab === 'lomba') {
                    renderLombaTable();
                } else if (activeTab === 'pengajuan') {
                    loadPengajuan();
                }
            });

            // Handle approve
            $(document).on('click', '.btn-approve', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Setujui Pengajuan?',
                    text: 'Lomba akan diaktifkan setelah disetujui.',
                    input: 'textarea',
                    inputLabel: 'Catatan (Opsional)',
                    inputPlaceholder: 'Masukkan catatan jika ada...',
                    showCancelButton: true,
                    confirmButtonText: 'Setujui',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/lomba/pengajuan/approve/${id}`,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                notes: result.value
                            },
                            success: function(response) {
                                Swal.fire('Berhasil!', response.message, 'success')
                                    .then(() => {
                                        loadPengajuan();
                                        loadLomba(); // Refresh tabel lomba
                                    });
                            },
                            error: function(xhr) {
                                Swal.fire('Gagal!',
                                    'Terjadi kesalahan saat menyetujui pengajuan.',
                                    'error');
                            }
                        });
                    }
                });
            });

            // Handle reject
            $(document).on('click', '.btn-reject', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Tolak Pengajuan?',
                    text: 'Pengajuan akan ditolak dan tidak diaktifkan.',
                    input: 'textarea',
                    inputLabel: 'Catatan (Opsional)',
                    inputPlaceholder: 'Masukkan alasan penolakan jika ada...',
                    showCancelButton: true,
                    confirmButtonText: 'Tolak',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#dc3545',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/lomba/pengajuan/reject/${id}`,
                            type: 'POST',
                            data: {
                                notes: result.value || ''
                            },
                            success: function(response) {
                                Swal.fire('Berhasil!', response.message, 'success')
                                    .then(() => {
                                        loadPengajuan();
                                    });
                            },
                            error: function(xhr) {
                                Swal.fire('Gagal!',
                                    'Terjadi kesalahan saat menolak pengajuan.',
                                    'error');
                            }
                        });
                    }
                });
            });

            // Handle delete lomba
            $(document).on('click', '.btn-hapus', function() {
                const id = $(this).data('id');
                const type = $(this).data('type');
                if (type === 'lomba') {
                    Swal.fire({
                        title: 'Yakin hapus data ini?',
                        text: "Data yang dihapus tidak bisa dikembalikan.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `/admin/lomba/delete/${id}`,
                                type: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    Swal.fire('Berhasil!', response.message, 'success')
                                        .then(() => {
                                            loadLomba();
                                        });
                                },
                                error: function(xhr) {
                                    Swal.fire('Gagal!',
                                        'Terjadi kesalahan saat menghapus data.',
                                        'error');
                                }
                            });
                        }
                    });
                }
            });

            $('#show-entry, #search-bar').on('input change', function() {
                if (activeTab === 'lomba') {
                    renderLombaTable();
                } else if (activeTab === 'pengajuan') {
                    renderPengajuanTable();
                }
            });

            window.loadLomba = loadLomba;
            window.loadPengajuan = loadPengajuan;
            loadLomba();
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
