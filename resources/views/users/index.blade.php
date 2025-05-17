@extends('layouts.app')

@section('title', 'Users')

@section('content')

    <div x-data="{ tab: 'mahasiswa' }">
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
                <button onclick="window.location.href='{{ url('users/create') }}'" class="bg-blue-600 text-white px-4 py-1 rounded text-sm hover:bg-blue-700">
                    + Add
                </button>
            </div>
        </div>
        <!-- Tab Button Group -->
        <div class="flex mb-0">
            <button
                class="px-4 py-2 rounded-t-[12px] focus:outline-none transition-all duration-150 border border-b-0"
                :class="tab === 'mahasiswa' 
                    ? 'bg-white font-semibold text-primary border-gray-200'
                    : 'bg-gray-100 text-gray-500 hover:text-blue-600 border-transparent'"
                @click="tab = 'mahasiswa'">
                Mahasiswa
            </button>
            <button
                class="px-4 py-2 rounded-t-[12px] focus:outline-none transition-all duration-150 ml-1 border border-b-0"
                :class="tab === 'dosen' 
                    ? 'bg-white font-semibold text-primary border-gray-200'
                    : 'bg-gray-100 text-gray-500 hover:text-blue-600 border-transparent'"
                @click="tab = 'dosen'">
                Dosen
            </button>
        </div>

        <!-- Table Wrapper -->
        <div class="overflow-x-auto bg-white shadow rounded-b-[12px] border-t-0 border border-gray-200">
            <!-- Tab Mahasiswa -->
            <div x-show="tab === 'mahasiswa'">
                <table id="table_mahasiswa" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mahasiswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program Studi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                </tbody>
            </table>
            </div>

            <!-- Tab Dosen -->
            <div x-show="tab === 'dosen'">
                <table id="table_dosen" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIDN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        $(document).ready(function() {
            function actionButtons(type, id) {
                return `
                    <a href="/users/${id}" class="text-blue-600 hover:underline mr-2">Detail</a>
                    <a href="/users/${id}/edit" class="text-yellow-600 hover:underline mr-2">Edit</a>
                    <button type="button" class="text-red-600 hover:underline btn-hapus" data-id="${id}" data-type="${type}">Hapus</button>
                `;
            }

            function loadMahasiswa() {
                $.ajax({
                    url: '/users/mahasiswa/getdata',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        let tbody = $('#table_mahasiswa tbody');
                        tbody.empty();
                        $.each(response, function(index, mhs) {
                            let row = `
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${mhs.nim}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${mhs.nama_mhs}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${mhs.username_mhs}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${mhs.email_mhs}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${mhs.program_studi ?? '-'}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        ${actionButtons('mahasiswa', mhs.id_mhs)}
                                    </td>
                                </tr>
                            `;
                            tbody.append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Gagal load data:', error);
                    }
                });
            }

            function loadDosen() {
                $.ajax({
                    url: "{{ url('/users/dosen/getdata') }}",
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        let tbody = $('#table_dosen tbody');
                        tbody.empty();
                        $.each(response, function(index, dsn) {
                            let row = `
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900">${dsn.nidn}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">${dsn.nama_dsn}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">${dsn.username}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">${dsn.email}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">${dsn.role}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        ${actionButtons('dosen', dsn.id_dsn)}
                                    </td>
                                </tr>
                            `;
                            tbody.append(row);
                        });
                    }
                });
            }

            $(document).on('click', '.btn-hapus', function() {
                let id = $(this).data('id');
                let type = $(this).data('type');
                if(confirm('Yakin ingin menghapus?')) {
                    $.ajax({
                        url: `/users/${id}`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(res) {
                            if(type === 'mahasiswa') loadMahasiswa();
                            else loadDosen();
                        },
                        error: function() {
                            alert('Gagal menghapus data.');
                        }
                    });
                }
            });

            loadMahasiswa();
            loadDosen();
        });
        </script>
@endsection