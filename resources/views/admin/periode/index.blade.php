@extends('admin.layouts.app')

@section('title', 'Periode')

@section('content')
    <div class="flex flex-wrap items-center justify-between mb-4 gap-2">
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
                <button id="btn-add-user" class="button-primary-medium" onclick="window.location.href='{{ url('admin/periode/create') }}'">
                    <i class="fas fa-plus mr-2"></i>
                    <span>Tambah</span>
                </button>
        </div>
    </div>


    <!-- Table Wrapper -->
    <div class="overflow-x-auto bg-white shadow rounded-b-[12px] border-t-0 border border-gray-200">
        <!-- Tab Periode -->
        <table id="table_periode" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

            </tbody>
        </table>
        <p id="periode_info" class="text-sm text-gray-500 mt-2 px-4"></p>
        <div id="periode_pagination" class="mt-2 flex flex-wrap gap-2 px-4 pb-4"></div>
    </div>


    </div>

    <script>
        $(document).ready(function() {
            let periodeData = [];
            let currentPage = 1;

            function actionButtonsPeriode(id) {
                console.log("Periode ID:", id);
                return `
                 <div class="flex gap-2">
                        <a href="/admin/periode/detail/${id}" class="action-button detail-button" title="Detail">
                            <i class="fas fa-eye text-[18px]"></i>
                        </a>
                        <a href="/admin/periode/edit/${id}" class="action-button edit-button" title="Update">
                            <i class="fas fa-edit text-[18px]"></i>
                        </a>
                        <button type="button" class="action-button activate-button btn-aktifkan" data-id="${id}" title="Aktifkan">
                            <i class="fas fa-check-circle text-green-600 text-[18px]"></i>
                        </button>
                        <button type="button" class="action-button delete-button btn-hapus" data-id="${id}" data-type="mahasiswa" title="Hapus">
                            <i class="fas fa-trash text-[18px]"></i>
                        </button>
                    </div>
            `;
            }

            function renderPeriodeTable() {
                let searchQuery = $('#search-bar').val().toLowerCase();
                let entriesToShow = parseInt($('#show-entry').val());
                let tbody = $('#table_periode tbody');

                let filtered = periodeData.filter(item =>
                    Object.values(item).some(val => val && val.toString().toLowerCase().includes(searchQuery))
                );

                let totalData = filtered.length;
                let totalPages = Math.ceil(totalData / entriesToShow);

                let startIndex = (currentPage - 1) * entriesToShow;
                let paginated = filtered.slice(startIndex, startIndex + entriesToShow);

                tbody.empty();
                $.each(paginated, function(index, item) {
                    let row = `
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">${item.id}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">${item.kode}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">${item.nama}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">${item.is_active ? 'Aktif' : 'Tidak Aktif'}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            ${actionButtonsPeriode(item.id)}
                        </td>
                    </tr>
                `;
                    tbody.append(row);
                });

                $("#periode_info").text(`Menampilkan ${paginated.length} dari ${totalData} data periode`);

                let paginationHtml = '';
                for (let i = 1; i <= totalPages; i++) {
                    paginationHtml +=
                        `<button class="px-3 py-1 rounded ${i === currentPage ? 'bg-primary text-white' : 'bg-gray-200'} page-btn-periode" data-page="${i}">${i}</button> `;
                }
                $("#periode_pagination").html(paginationHtml);

                $(".page-btn-periode").on("click", function() {
                    currentPage = parseInt($(this).data("page"));
                    renderPeriodeTable();
                });
            }

            $(document).on('click', '.btn-aktifkan', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Aktifkan Periode Ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Aktifkan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/periode/${id}/activate`,
                            type: 'PUT',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire('Berhasil', response.message, 'success');
                                loadPeriode();
                            },
                            error: function() {
                                Swal.fire('Gagal', 'Terjadi kesalahan saat mengaktifkan periode.', 'error');
                            }
                        });
                    }
                });
            });


            function loadPeriode() {
                $.ajax({
                    url: '/admin/periode/getall',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        periodeData = response;
                        currentPage = 1;
                        renderPeriodeTable();
                    }
                });
            }

            $('#search-bar, #show-entry').on('input change', function() {
                currentPage = 1;
                renderPeriodeTable();
            });

            window.loadPeriode = loadPeriode;
            loadPeriode();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).on('click', '.btn-hapus', function() {
                const id = $(this).data('id');
                const type = $(this).data('type');

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
                            url: `/admin/periode/delete/${id}`,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire('Berhasil!', response.message, 'success')
                                    .then(() => {
                                        location.reload();
                                    });
                            },
                            error: function(xhr) {
                                let errorMsg = 'Terjadi kesalahan saat menghapus data.';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMsg = xhr.responseJSON.message;
                                }
                                Swal.fire('Gagal!', errorMsg, 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#show-entry, #search-bar').on('input change', function() {
                let activeTab = window.tab;
                window.loadPeriode();
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

