@extends('layouts.app')
@section('title', 'Mahasiswa')
@section('content')
<table id="table_mahasiswa" class="min-w-full divide-y divide-gray-200">
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Username</th>
            <th>Action</th>
        </tr>
    </thead>
</table>
<script>
$(document).ready(function() {
    $('#table_mahasiswa').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: "{{ url('mahasiswa/listmahasiswa') }}",
            type: "POST",
            dataType: "json",
            dataSrc: function(json) {
                return json.data; 
            }
        },
        columns: [
            { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
            { data: "nim" },
            { data: "nama_mhs" },
            { data: "username_mhs" },
            { data: "aksi", orderable: false, searchable: false }
        ],
        createdRow: function(row, data, dataIndex) {
            // tambahin class Tailwind ke semua <td> di baris ini
            $('td', row).addClass('px-6 py-4 whitespace-nowrap text-sm text-gray-900');
        },
    });
});
</script>
@endsection