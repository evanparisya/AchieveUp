@extends('admin.layouts.app')

@section('title', 'Bidang')

@section('content')
    <div class="mx-auto max-w-full h-full flex flex-col">
        <h1 class="text-xl font-bold mb-4">Daftar Bidang</h1>

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
                <a href="{{ route('admin.bidang.create') }}" id="btn-add-bidang" class="button-primary-medium">
                    <i class="fas fa-plus mr-2"></i>
                    <span>Tambah</span>
                </a>
            </div>
        </div>


    <!-- Table Wrapper -->
    <div class="overflow-x-auto bg-white shadow rounded-b-[12px] border-t-0 border border-gray-200">
        <!-- Tab Bidang -->
        <table id="table_bidang" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

            </tbody>
        </table>
        <p id="bidang_info" class="text-sm text-gray-500 mt-2"></p>
        <div id="bidang_pagination" class="mt-2 flex flex-wrap gap-2"></div>
    </div>

    </div>

    <script>
        $(document).ready(function() {
            let bidangData = [];
            let currentPage = 1;

            function actionButtonsBidang(id) {
                console.log("Bidang ID:", id);
                return `
                <div class="flex gap-2">
                        <a href="/admin/bidang/${id}" class="action-button detail-button" title="Detail">
                            <i class="fas fa-eye text-[18px]"></i>
                        </a>
                        <a href="/admin/bidang/edit/${id}" class="action-button edit-button" title="Update">
                            <i class="fas fa-edit text-[18px]"></i>
                        </a>
                        <button type="button" class="action-button delete-button btn-hapus" data-id="${id}" data-type="bidang" title="Hapus">
                            <i class="fas fa-trash text-[18px]"></i>
                        </button>
                    </div>
            `;
            }

            function renderBidangTable() {
                let searchQuery = $('#search-bar').val().toLowerCase();
                let entriesToShow = parseInt($('#show-entry').val());
                let tbody = $('#table_bidang tbody');

                let filtered = bidangData.filter(item =>
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
                        <td class="px-6 py-4 text-sm text-gray-900">
                            ${actionButtonsBidang(item.id)}
                        </td>
                    </tr>
                `;
                    tbody.append(row);
                });

                $("#bidang_info").text(`Menampilkan ${paginated.length} dari ${totalData} data bidang`);

                let paginationHtml = '';
                for (let i = 1; i <= totalPages; i++) {
                    paginationHtml +=
                        `<button class="px-2 py-1 rounded ${i === currentPage ? 'bg-blue-500 text-white' : 'bg-gray-200'} page-btn-bidang" data-page="${i}">${i}</button> `;
                }
                $("#bidang_pagination").html(paginationHtml);

                $(".page-btn-bidang").on("click", function() {
                    currentPage = parseInt($(this).data("page"));
                    renderBidangTable();
                });
            }

            function loadBidang() {
                $.ajax({
                    url: '/admin/bidang/getall',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        bidangData = response;
                        currentPage = 1;
                        renderBidangTable();
                    }
                });
            }

            $('#search-bar, #show-entry').on('input change', function() {
                currentPage = 1;
                renderBidangTable();
            });

            window.loadBidang = loadBidang;
            loadBidang();
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
                            url: `/admin/bidang/delete/${id}`,
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
                window.loadBidang();
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
