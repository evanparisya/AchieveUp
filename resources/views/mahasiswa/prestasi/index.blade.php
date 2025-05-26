@extends('mahasiswa.layouts.app')

@section('title', 'Prestasi')

@section('content')
<div class="mx-auto max-w-full h-full flex flex-col">
    <h1 class="text-xl font-bold mb-4">Daftar Semua Prestasi</h1>

    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center space-x-2">
            <label for="show-entry" class="text-sm font-medium text-gray-700">Tampilkan</label>
            <select id="show-entry"
                class="appearance-none bg-white border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#6041CE] focus:border-transparent transition-shadow">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
            </select>
            <span class="text-sm font-medium text-gray-700">data</span>
        </div>
        <div class="flex items-center gap-2">
            <input id="search-bar" type="text" placeholder="Cari..." class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#6041CE] focus:border-transparent transition-shadow" />
            <button id="btn-add-prestasi" class="button-primary-medium">
                    <i class="fas fa-plus mr-2"></i>
                    <span>Tambah</span>
                </button>
        </div>
    </div>
    
    <div class="flex-1 overflow-x-auto bg-white shadow rounded border border-gray-200">
        <table id="table_prestasi" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tingkat</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Juara</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200"></tbody>
        </table>
        <p id="prestasi_info" class="text-sm text-gray-500 mt-2 px-4"></p>
        <div id="prestasi_pagination" class="mt-2 flex flex-wrap gap-2 px-4 pb-4"></div>
    </div>
</div>
@endsection

@push('js')
<script>
$(document).ready(function () {
    let prestasiData = [];
    let originalData = [];
    let currentPage = 1;

    function renderPrestasiTable() {
        let entriesToShow = parseInt($("#show-entry").val()) || 5;
        let tbody = $('#table_prestasi tbody');
        let searchQuery = $('#search-bar').val().toLowerCase();

        if (!Array.isArray(prestasiData)) {
            console.error('prestasiData is not an array:', prestasiData);
            prestasiData = [];
        }

        let filtered = prestasiData.filter(item =>
            (item.judul || '').toLowerCase().includes(searchQuery) ||
            (item.tingkat || '').toLowerCase().includes(searchQuery) ||
            (item.juara || '').toString().toLowerCase().includes(searchQuery) ||
            (item.status || '').toLowerCase().includes(searchQuery)
        );

        let totalData = filtered.length;
        let totalPages = Math.ceil(totalData / entriesToShow);

        let startIndex = (currentPage - 1) * entriesToShow;
        let paginated = filtered.slice(startIndex, startIndex + entriesToShow);

        tbody.empty();

        // Calculate table height: (entriesToShow * row height) + header height
        const rowHeight = 48; // 48px per row
        const headerHeight = 40; // Approximate header height (can adjust based on actual height)
        const tableHeight = (entriesToShow * rowHeight) + headerHeight;
        $('#table_prestasi').css('height', `${tableHeight}px`);

        if (paginated.length === 0) {
            tbody.append('<tr class="h-12"><td colspan="5" class="px-4 py-2 text-center text-gray-400">Tidak ada prestasi yang ditemukan.</td></tr>');
            // Fill remaining rows to maintain table height
            for (let i = 1; i < entriesToShow; i++) {
                tbody.append('<tr class="h-12"><td colspan="5" class="px-4 py-2"></td></tr>');
            }
        } else {
            $.each(paginated, function (index, item) {
                let formattedDate = item.tanggal_pengajuan
                    ? new Date(item.tanggal_pengajuan).toLocaleDateString('id-ID', {
                          day: '2-digit',
                          month: '2-digit',
                          year: 'numeric'
                      })
                    : 'Tidak tersedia';
                let row = `
                    <tr class="h-12 hover:bg-gray-50 transition">
                        <td class="px-4 py-2 align-middle">${item.judul || 'N/A'}</td>
                        <td class="px-4 py-2 align-middle">${item.tingkat || 'N/A'}</td>
                        <td class="px-4 py-2 align-middle">Juara ${item.juara || 'N/A'}</td>
                        <td class="px-4 py-2 align-middle">${item.status || 'N/A'}</td>
                        <td class="px-4 py-2 align-middle">${formattedDate}</td>
                    </tr>
                `;
                tbody.append(row);
            });

            const remainingRows = entriesToShow - paginated.length;
            for (let i = 0; i < remainingRows; i++) {
                tbody.append('<tr class="h-12"><td colspan="5" class="px-4 py-2"></td></tr>');
            }
        }

        $("#prestasi_info").text(`Menampilkan ${paginated.length} dari ${totalData} data prestasi`);

        let paginationHtml = '';
        for (let i = 1; i <= totalPages; i++) {
            paginationHtml += `<button class="px-2 py-1 rounded ${i === currentPage ? 'bg-[#6041CE] text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'} page-btn-prestasi" data-page="${i}">${i}</button> `;
        }
        $("#prestasi_pagination").html(paginationHtml);

        $(".page-btn-prestasi").on("click", function () {
            currentPage = parseInt($(this).data("page"));
            renderPrestasiTable();
        });
    }

    function loadPrestasi() {
        $.ajax({
            url: '/mahasiswa/prestasi/getdata',
            type: "GET",
            dataType: "json",
            success: function (response) {
                prestasiData = response || [];
                originalData = [...prestasiData];
                currentPage = 1;
                renderPrestasiTable();
            },
            error: function (xhr, status, error) {
                console.error('Error fetching prestasi data:', error, xhr.status, xhr.responseText);
                $("#prestasi_info").text("Gagal memuat data prestasi. Silakan coba lagi.");
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal memuat data prestasi. Silakan coba lagi.',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        });
    }

    $('#show-entry, #search-bar').on('input change', function () {
        currentPage = 1;
        renderPrestasiTable();
    });

    loadPrestasi();
});
</script>
@endpush