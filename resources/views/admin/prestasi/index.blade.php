@extends('admin.layouts.app')

@section('title', 'Verifikasi Prestasi')

@section('content')
    <div class="mx-auto max-w-full h-full flex flex-col">

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
                <select id="status-filter" class="input">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="disetujui">Disetujui</option>
                    <option value="ditolak">Ditolak</option>
                </select>
                <input id="search-bar" type="text" placeholder="Cari..." class="input" />
            </div>
        </div>

        <div class="flex-1 overflow-x-auto bg-white shadow rounded border border-gray-200">
            <table id="prestasi-table" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul
                        </th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                            Mulai</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tempat
                        </th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mahasiswa
                        </th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pembimbing</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody id="prestasi-body" class="bg-white divide-y divide-gray-200 overflow-y-auto"></tbody>
            </table>
            <p id="prestasi_info" class="text-sm text-gray-500 mt-2 px-4"></p>
            <div id="prestasi_pagination" class="mt-2 flex flex-wrap gap-2 px-4 pb-4"></div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            let prestasiData = [];
            let currentPage = 1;

            function actionButtonsPrestasi(id, status) {
                if (status === 'pending') {
                    return `
                        <div class="flex gap-2">
                            <a href="/admin/prestasi/${id}" class="action-button detail-button" title="Detail">
                                <i class="fas fa-eye text-[18px]"></i>
                            </a>
                            <button type="button" class="action-button approve-button" data-id="${id}" title="Setujui">
                                <i class="fas fa-check-circle text-green-500 text-[18px]"></i>
                            </button>
                            <button type="button" class="action-button reject-button" data-id="${id}" title="Tolak">
                                <i class="fas fa-times-circle text-red-500 text-[18px]"></i>
                            </button>
                        </div>
                    `;
                }
                return `
                    <div class="flex gap-2">
                        <a href="/admin/prestasi/${id}" class="action-button detail-button" title="Detail">
                            <i class="fas fa-eye text-[18px]"></i>
                        </a>
                    </div>
                `;
            }

            $(document).on('click', '.approve-button', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Yakin ingin menyetujui prestasi ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#6041CE',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Ya, setujui!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/prestasi/${id}/approve`,
                            type: 'PATCH',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(res) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: res.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                                loadPrestasi();
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan saat menyetujui prestasi.',
                                });
                            }
                        });
                    }
                });
            });

            $(document).on('click', '.reject-button', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Yakin ingin menolak prestasi ini?',
                    icon: 'warning',
                    input: 'textarea',
                    inputLabel: 'Catatan Penolakan',
                    inputPlaceholder: 'Masukkan alasan penolakan...',
                    inputAttributes: {
                        'aria-label': 'Catatan Penolakan'
                    },
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Ya, tolak!',
                    cancelButtonText: 'Batal',
                    preConfirm: (note) => {
                        if (!note) {
                            Swal.showValidationMessage('Catatan penolakan wajib diisi.');
                        }
                        return note;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/prestasi/${id}/reject`,
                            type: 'PATCH',
                            data: {
                                _token: '{{ csrf_token() }}',
                                note: result.value
                            },
                            success: function(res) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: res.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                                loadPrestasi();
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan saat menolak prestasi.',
                                });
                            }
                        });
                    }
                });
            });

            function setTableHeight(entriesToShow) {
                const rowHeight = 48;
                const headerHeight = 40;
                const tableHeight = entriesToShow * rowHeight + headerHeight;
                $('#prestasi-table tbody').css({
                    'max-height': `${entriesToShow * rowHeight}px`
                });
            }

            function renderPrestasiTable() {
                let searchQuery = $('#search-bar').val().toLowerCase();
                let entriesToShow = parseInt($('#show-entry').val()) || 10;
                let tbody = $('#prestasi-body');

                let filtered = prestasiData.sort((a, b) => {
                    if (a.status === 'pending' && b.status !== 'pending') return -1;
                    if (a.status !== 'pending' && b.status === 'pending') return 1;
                    return 0;
                }).filter(item =>
                    item.judul.toLowerCase().includes(searchQuery) ||
                    item.tempat.toLowerCase().includes(searchQuery)
                );

                let totalData = filtered.length;
                let totalPages = Math.ceil(totalData / entriesToShow);
                let startIndex = (currentPage - 1) * entriesToShow;
                let paginated = filtered.slice(startIndex, startIndex + entriesToShow);

                tbody.empty();

                if (paginated.length === 0) {
                    tbody.append(`
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">Tidak ada data ditemukan</td>
                        </tr>
                    `);
                } else {
                    $.each(paginated, function(index, item) {
                        let pembimbing = item.dosens.map(d => d.nama).join(', ') || '-';
                        let mahasiswa = item.mahasiswas && item.mahasiswas.length > 0 ?
                            item.mahasiswas.map(m => m.nama).join(', ') :
                            '-';
                        let statusClass = item.status === 'disetujui' ? 'bg-green-100 text-green-800' :
                            item.status === 'ditolak' ? 'bg-red-100 text-red-800' :
                            'bg-gray-200 text-gray-900';

                        let row = `
                        <tr class="h-12 hover:bg-gray-50">
                            <td class="px-4 py-3 whitespace-nowrap text-sm">${item.judul}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm">${item.tanggal_mulai}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm">${item.tempat}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm">${mahasiswa}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm">${pembimbing}</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="inline-flex items-center gap-2.5 px-2 py-1 rounded text-xs font-semibold capitalize
                                    ${item.status === 'disetujui' ? 'bg-green-100 text-green-800' : 
                                    item.status === 'ditolak' ? 'bg-red-100 text-red-800' : 
                                    'bg-gray-200 text-gray-900'}">
                                    <i class="${
                                        item.status === 'disetujui' ? 'fas fa-check-circle text-green-500' :
                                        item.status === 'ditolak' ? 'fas fa-times-circle text-red-500' :
                                        'fas fa-hourglass-half text-gray-500'
                                    }"></i>
                                    ${item.status}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                ${actionButtonsPrestasi(item.id, item.status)}
                            </td>
                        </tr>
                    `;
                        tbody.append(row);
                    });
                }

                $("#prestasi_info").text(`Menampilkan ${paginated.length} dari ${totalData} data`);

                let paginationHtml = '';
                for (let i = 1; i <= totalPages; i++) {
                    paginationHtml +=
                        `<button class="px-3 py-1 rounded-md text-sm ${i === currentPage ? 'bg-[#6041CE] text-white' : 'bg-gray-200'} page-btn-prestasi" data-page="${i}">${i}</button>`;
                }
                $("#prestasi_pagination").html(paginationHtml);

                $(".page-btn-prestasi").off("click").on("click", function() {
                    currentPage = parseInt($(this).data("page"));
                    renderPrestasiTable();
                });

                setTableHeight(entriesToShow);
            }

            function loadPrestasi() {
                $.ajax({
                    url: '/admin/prestasi/getdata',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        prestasiData = response.data;
                        currentPage = 1;
                        renderPrestasiTable();
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Gagal memuat data prestasi.',
                        });
                    }
                });
            }

            $('#search-bar, #show-entry').on('input change', function() {
                currentPage = 1;
                renderPrestasiTable();
            });

            loadPrestasi();
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
