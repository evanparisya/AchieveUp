@extends('admin.layouts.app')

@section('title', 'Prodi')

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
            <button id="btn-add-user" onclick="window.location.href='{{ url('admin/prodi/create') }}'"
                class="bg-blue-600 text-white px-4 py-1 rounded text-sm hover:bg-blue-700">
                + Add
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
        <p id="prodi_info" class="text-sm text-gray-500 mt-2"></p>
        <div id="prodi_pagination" class="mt-2 flex flex-wrap gap-2"></div>
    </div>


    </div>

    <script>
        $(document).ready(function() {
            let prodiData = [];
            let currentPage = 1;

            function actionButtonsProdi(id) {
                console.log("Prodi ID:", id);
                return `
                <a href="/prodi/${id}" class="text-blue-600 hover:underline mr-2">Detail</a>
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
                        `<button class="px-2 py-1 rounded ${i === currentPage ? 'bg-blue-500 text-white' : 'bg-gray-200'} page-btn-mhs" data-page="${i}">${i}</button> `;
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
