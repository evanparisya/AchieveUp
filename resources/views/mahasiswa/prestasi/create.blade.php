@extends('mahasiswa.layouts.app')

@section('title', 'Prestasi')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-xl font-bold mb-4">Tambah Prestasi</h1>
    <form action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="tanggal_pengajuan" class="block mb-1">Tanggal Pengajuan</label>
        <input type="date" name="tanggal_pengajuan" class="w-full mb-3 p-2 border rounded" required>

        <label for="judul" class="block mb-1">Judul</label>
        <input type="text" name="judul" class="w-full mb-3 p-2 border rounded" required>

        <label for="tempat" class="block mb-1">Tempat</label>
        <input type="text" name="tempat" class="w-full mb-3 p-2 border rounded" required>

        <label for="tanggal_mulai" class="block mb-1">Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" class="w-full mb-3 p-2 border rounded" required>

        <label for="tanggal_selesai" class="block mb-1">Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" class="w-full mb-3 p-2 border rounded" required>

        <label for="url" class="block mb-1">URL Kompetisi (opsional)</label>
        <input type="url" name="url" class="w-full mb-3 p-2 border rounded">

        <label for="tingkat" class="block mb-1">Tingkat</label>
        <select name="tingkat" class="w-full mb-3 p-2 border rounded" required>
            <option value="nasional">Nasional</option>
            <option value="internasional">Internasional</option>
            <option value="regional">Regional</option>
            <option value="provinsi">Provinsi</option>
        </select>

        <label for="juara" class="block mb-1">Juara</label>
        <select name="juara" class="w-full mb-3 p-2 border rounded" required>
            <option value="1">Juara 1</option>
            <option value="2">Juara 2</option>
            <option value="3">Juara 3</option>
        </select>

        <label for="is_individu" class="block mb-1">Tipe</label>
        <select name="is_individu" class="w-full mb-3 p-2 border rounded">
            <option value="1">Individu</option>
            <option value="0">Kelompok</option>
        </select>

        <label for="nomor_surat_tugas" class="block mb-1">Nomor Surat Tugas</label>
        <input type="text" name="nomor_surat_tugas" class="w-full mb-3 p-2 border rounded" required>

        <label for="tanggal_surat_tugas" class="block mb-1">Tanggal Surat Tugas</label>
        <input type="date" name="tanggal_surat_tugas" class="w-full mb-3 p-2 border rounded" required>

        <label for="file_surat_tugas" class="block mb-1">File Surat Tugas</label>
        <input type="file" name="file_surat_tugas" class="w-full mb-3 p-2 border rounded" required>

        <label for="file_sertifikat" class="block mb-1">File Sertifikat</label>
        <input type="file" name="file_sertifikat" class="w-full mb-3 p-2 border rounded" required>

        <label for="file_poster" class="block mb-1">File Poster (opsional)</label>
        <input type="file" name="file_poster" class="w-full mb-3 p-2 border rounded">

        <label for="foto_kegiatan" class="block mb-1">Foto Kegiatan (opsional)</label>
        <input type="file" name="foto_kegiatan" class="w-full mb-3 p-2 border rounded">

        <label for="is_akademik" class="block mb-1">Kategori</label>
        <select name="is_akademik" class="w-full mb-3 p-2 border rounded">
            <option value="1">Akademik</option>
            <option value="0">Non-akademik</option>
        </select>

        <label for="mahasiswa_id[]" class="block mb-1">Pilih Mahasiswa</label>
        <select name="mahasiswa_id[]" class="w-full mb-3 p-2 border rounded" multiple required>
            @foreach($mahasiswaList as $mahasiswa)
                <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->nama }}</option>
            @endforeach
        </select>

        <label for="dosen_id[]" class="block mb-1">Pilih Dosen Pembimbing</label>
        <select name="dosen_id[]" class="w-full mb-4 p-2 border rounded" multiple required>
            @foreach($dosenList as $dosen)
                <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
    </form>
</div>
@endsection