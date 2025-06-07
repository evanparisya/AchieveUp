@extends('admin.layouts.app')

@section('title', 'Prodi')

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
                <input id="search-bar" type="text" placeholder="Cari..." class="search-list" />
                <button id="btn-add-user"
                    class="button-primary-medium"onclick="window.location.href='{{ url('admin/prodi/create') }}'">
                    <i class="fas fa-plus mr-2"></i>
                    <span>Tambah</span>
                </button>
            </div>
        </div>

        <!-- Table Wrapper -->
        <div class="overflow-x-auto bg-white shadow rounded-b-[12px] border-t-0 border border-gray-200">
            <!-- Tab Prodi -->
            <table id="table_prodi" class="min-w-full divide-y divide-gray-200">
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
            <p id="prodi_info" class="text-sm text-gray-500 mt-2 px-4"></p>
            <div id="prodi_pagination" class="mt-2 flex flex-wrap gap-2 px-4 pb-4"></div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let prodiData = [];
            let currentPage = 1;

            function actionButtonsProdi(id) {
                console.log("Prodi ID:", id);
                return `
                <a href="/admin/prodi/${id}" class="text-blue-600 hover:underline mr-2">Detail</a>
                <a href="/admin/prodi/edit/${id}" class="text-yellow-600 hover:underline mr-2">Edit</a>
                <button type="button" class="text-red-600 hover:underline btn-hapus" data-id="${id}" data-type="prodi">Hapus</button>
            `;
            }

            function renderProdiTable() {
                let searchQuery = $('#search-bar').val().toLowerCase();
                let entriesToShow = parseInt($('#show-entry').val());
                let tbody = $('#table_prodi tbody');

                let filtered = prodiData.filter(item =>
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
                            ${actionButtonsProdi(item.id)}
                        </td>
                    </tr>
                `;
                    tbody.append(row);
                });

                $("#prodi_info").text(`Menampilkan ${paginated.length} dari ${totalData} data prodi`);

                let paginationHtml = '';
                for (let i = 1; i <= totalPages; i++) {
                    paginationHtml +=
                        `<button class="px-3 py-1 rounded ${i === currentPage ? 'bg-primary text-white' : 'bg-gray-200'} page-btn" data-page="${i}">${i}</button>`;
                }
                $("#prodi_pagination").html(paginationHtml);

                $(".page-btn-prodi").on("click", function() {
                    currentPage = parseInt($(this).data("page"));
                    renderProdiTable();
                });
            }

            function loadProdi() {
                $.ajax({
                    url: '/admin/prodi/getall',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        prodiData = response;
                        currentPage = 1;
                        renderProdiTable();
                    }
                });
            }

            $('#search-bar, #show-entry').on('input change', function() {
                currentPage = 1;
                renderProdiTable();
            });

            window.loadProdi = loadProdi;
            loadProdi();
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
                            url: `/admin/prodi/delete/${id}`,
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
                window.loadProdi();
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
