@extends('mahasiswa.layouts.app')

@section('title', 'Prestasi')

@section('content')
<div class="container mx-auto p-4 max-w-3xl">
    <div class="flex items-center justify-between mb-4">
    <div>
        <label class="text-sm text-gray-700 mr-2">Show</label>
        <select id="show-entry" class="border rounded px-2 py-1 text-sm">
            <option>5</option>
            <option>10</option>
            <option>25</option>
        </select>
        <span class="text-sm text-gray-700 ml-2">entries</span>
    </div>
    <input id="search-bar" type="text" placeholder="Search..." class="border rounded px-2 py-1 text-sm" />
</div>
    <h1 class="text-xl font-bold mb-4">Daftar Prestasi (5 Terbaru)</h1>
    <div class="overflow-x-auto bg-white shadow rounded border border-gray-200">
        <table id="table_prestasi" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tingkat</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Juara</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200"></tbody>
        </table>
        <p id="prestasi_info" class="text-sm text-gray-500 mt-2"></p>
        <div id="prestasi_pagination" class="mt-2 flex flex-wrap gap-2"></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    let prestasiData = [];
    let currentPage = 1;

    function renderPrestasiTable() {
        let entriesToShow = 5; // Tampilkan 5 data
        let tbody = $('#table_prestasi tbody');
        let totalData = prestasiData.length;
        let totalPages = Math.ceil(totalData / entriesToShow);

        let startIndex = (currentPage - 1) * entriesToShow;
        let paginated = prestasiData.slice(startIndex, startIndex + entriesToShow);

        tbody.empty();
        $.each(paginated, function (index, item) {
            let row = `
                <tr>
                    <td class="px-4 py-2">${item.judul}</td>
                    <td class="px-4 py-2">${item.tingkat}</td>
                    <td class="px-4 py-2">Juara ${item.juara}</td>
                    <td class="px-4 py-2">${item.status}</td>
                    <td class="px-4 py-2">${item.tanggal_pengajuan}</td>
                </tr>
            `;
            tbody.append(row);
        });

        $("#prestasi_info").text(`Menampilkan ${paginated.length} dari ${totalData} data prestasi`);

        // Pagination
        let paginationHtml = '';
        for (let i = 1; i <= totalPages; i++) {
            paginationHtml += `<button class="px-2 py-1 rounded ${i === currentPage ? 'bg-blue-500 text-white' : 'bg-gray-200'} page-btn-prestasi" data-page="${i}">${i}</button> `;
        }
        $("#prestasi_pagination").html(paginationHtml);

        $(".page-btn-prestasi").on("click", function () {
            currentPage = parseInt($(this).data("page"));
            renderPrestasiTable();
        });
    }

    function loadPrestasi() {
        $.ajax({
            url: "{{ route('mahasiswa.prestasi.getdata') }}", // Buat route ini di web.php
            type: "GET",
            dataType: "json",
            success: function (response) {
                prestasiData = response;
                currentPage = 1;
                renderPrestasiTable();
            }
        });
    }

    // Panggil saat halaman siap
    loadPrestasi();
});
</script>
@endpush