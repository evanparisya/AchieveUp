@extends('dosen.layouts.app')

@section('title', 'Create')

@section('content')
    <div class="container mx-auto p-4 max-w-lg">

        <h1 class="text-xl font-bold mb-4">Tambah Lomba</h1>

        <form id="form-create" action="{{ route('dosen.lomba.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Judul Lomba --}}
            <label for="judul" class="block mb-1">Judul</label>
            <input type="text" name="judul" id="judul" class="w-full mb-3 p-2 border rounded"
                value="{{ old('judul') }}">
            @error('judul')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            {{-- Tempat --}}
            <label for="tempat" class="block mb-1">Tempat</label>
            <input type="text" name="tempat" id="tempat" class="w-full mb-3 p-2 border rounded"
                value="{{ old('tempat') }}">
            @error('tempat')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            {{-- Tanggal Daftar --}}
            <label for="tanggal_daftar" class="block mb-1">Tanggal Daftar</label>
            <input type="date" name="tanggal_daftar" id="tanggal_daftar" class="w-full mb-3 p-2 border rounded"
                value="{{ old('tanggal_daftar') }}">
            @error('tanggal_daftar')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            {{-- Tanggal Daftar Terakhir --}}
            <label for="tanggal_daftar_terakhir" class="block mb-1">Tanggal Daftar Terakhir</label>
            <input type="date" name="tanggal_daftar_terakhir" id="tanggal_daftar_terakhir"
                class="w-full mb-3 p-2 border rounded" value="{{ old('tanggal_daftar_terakhir') }}">
            @error('tanggal_daftar_terakhir')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            {{-- URL --}}
            <label for="url" class="block mb-1">URL Pendaftaran</label>
            <input type="url" name="url" id="url" class="w-full mb-3 p-2 border rounded"
                value="{{ old('url') }}">
            @error('url')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            {{-- Tingkat --}}
            <label for="tingkat" class="block mb-1">Tingkat</label>
            <select name="tingkat" id="tingkat" class="w-full mb-3 p-2 border rounded">
                <option value="">-- Pilih Tingkat --</option>
                <option value="internasional">Internasional</option>
                <option value="nasional">Nasional</option>
                <option value="regional">Regional</option>
                <option value="provinsi">Provinsi</option>
            </select>
            @error('tingkat')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            {{-- Jenis Lomba --}}
            <label class="block mb-1">Jenis Lomba</label>
            <div class="mb-3">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_individu" value="1" class="mr-2"
                        {{ old('is_individu') ? 'checked' : '' }}>
                    Individu
                </label>
                <label class="inline-flex items-center ml-4">
                    <input type="checkbox" name="is_akademik" value="1" class="mr-2"
                        {{ old('is_akademik') ? 'checked' : '' }}>
                    Akademik
                </label>
            </div>

            {{-- Aktif --}}
            <label class="block mb-1">Status Aktif</label>
            <label class="inline-flex items-center mb-3">
                <input type="checkbox" name="is_active" value="1" class="mr-2"
                    {{ old('is_active', true) ? 'checked' : '' }}>
                Aktif
            </label>

            {{-- File Poster --}}
            <label for="file_poster" class="block mb-1">File Poster</label>
            <input type="file" name="file_poster" id="file_poster" class="w-full mb-4 p-2 border rounded">
            @error('file_poster')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            {{-- Bidang --}}
            <label for="bidang" class="block mb-1">Bidang</label>
            <select name="bidang[]" id="bidang" class="w-full mb-2 p-2 border rounded select2" multiple="multiple">
                @foreach ($bidangs as $bidang)
                    <option value="{{ $bidang->id }}">{{ $bidang->nama }}</option>
                @endforeach
            </select>
            @error('bidang')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            {{-- Container untuk menampilkan tag yang dipilih --}}
            <div id="selected-tags" class="flex flex-wrap gap-2 mt-2">
                {{-- Tag akan ditampilkan di sini --}}
            </div>



            {{-- Submit --}}
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#bidang').select2({
                placeholder: "Pilih bidang lomba",
                tags: true,
                width: '100%'
            });
        });
    </script>


    <script>
        document.getElementById('form-create').addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin ingin menambahkan data ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        });
    </script>
@endsection
