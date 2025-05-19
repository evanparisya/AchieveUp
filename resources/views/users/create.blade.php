@extends('layouts.app')

@section('title', 'Create')

@section('content')
<div class="container mx-auto p-4 max-w-lg">

    <h1 class="text-xl font-bold mb-4">Tambah {{ ucfirst($type) }}</h1>

    <form id="form-create" action="{{ url('users/store') }}" method="POST" enctype="multipart/form-data" onsubmit="return confirmSubmit(this)">
        @csrf
        <input type="hidden" name="type" value="{{ $type }}">

        @if($type === 'mahasiswa')
            {{-- FORM MAHASISWA --}}
            <label for="nim" class="block mb-1">NIM</label>
            <input type="text" name="nim" id="nim" class="w-full mb-3 p-2 border rounded" value="{{ old('nim') }}">
            @error('nim')<p class="text-red-500 text-sm mb-2">{{ $message }}</p>@enderror

            <label for="nama_mhs" class="block mb-1">Nama Mahasiswa</label>
            <input type="text" name="nama_mhs" id="nama_mhs" class="w-full mb-3 p-2 border rounded" value="{{ old('nama_mhs') }}">
            @error('nama_mhs')<p class="text-red-500 text-sm mb-2">{{ $message }}</p>@enderror

            <label for="username_mhs" class="block mb-1">Username</label>
            <input type="text" name="username_mhs" id="username_mhs" class="w-full mb-3 p-2 border rounded" value="{{ old('username_mhs') }}">
            @error('username_mhs')<p class="text-red-500 text-sm mb-2">{{ $message }}</p>@enderror

            <label for="email_mhs" class="block mb-1">Email</label>
            <input type="email" name="email_mhs" id="email_mhs" class="w-full mb-3 p-2 border rounded" value="{{ old('email_mhs') }}">
            @error('email_mhs')<p class="text-red-500 text-sm mb-2">{{ $message }}</p>@enderror

            <label for="password_mhs" class="block mb-1">Password</label>
            <input type="password" name="password_mhs" id="password_mhs" class="w-full mb-3 p-2 border rounded">
            @error('password_mhs')<p class="text-red-500 text-sm mb-2">{{ $message }}</p>@enderror

            <label for="password_mhs_confirmation" class="block mb-1">Konfirmasi Password</label>
            <input type="password" name="password_mhs_confirmation" id="password_mhs_confirmation" class="w-full mb-3 p-2 border rounded">
            @error('password_mhs')<p class="text-red-500 text-sm mb-2">{{ $message }}</p>@enderror

            <label for="program_studi" class="block mb-1">Program Studi</label>
            <select name="program_studi" id="program_studi" class="w-full mb-3 p-2 border rounded">
                <option value="">-- Pilih Program Studi --</option>
                @foreach($programStudis as $prodi)
                    <option value="{{ $prodi->id_prodi }}" {{ old('program_studi') == $prodi->id_prodi ? 'selected' : '' }}>
                        {{ $prodi->nama_prodi }}
                    </option>
                @endforeach
            </select>
            @error('program_studi')<p class="text-red-500 text-sm mb-2">{{ $message }}</p>@enderror

            <label for="foto_mhs" class="block mb-1">Foto Mahasiswa (optional)</label>
            <input type="file" name="foto_mhs" id="foto_mhs" class="w-full mb-4 p-2 border rounded">
            @error('foto_mhs')<p class="text-red-500 text-sm mb-2">{{ $message }}</p>@enderror

        @elseif($type === 'dosen')
            {{-- FORM DOSEN --}}
            <label for="nidn">NIDN</label>
            <input type="text" name="nidn" value="{{ old('nidn') }}" class="w-full mb-2 border p-2 rounded">
            @error('nidn') <div class="text-red-500">{{ $message }}</div> @enderror

            <label for="username">Username</label>
            <input type="text" name="username" value="{{ old('username') }}" class="w-full mb-2 border p-2 rounded">
            @error('username') <div class="text-red-500">{{ $message }}</div> @enderror

            <label for="nama_dsn">Nama</label>
            <input type="text" name="nama_dsn" value="{{ old('nama_dsn') }}" class="w-full mb-2 border p-2 rounded">
            @error('nama_dsn') <div class="text-red-500">{{ $message }}</div> @enderror

            <label for="email_dsn">Email</label>
            <input type="email" name="email_dsn" value="{{ old('email_dsn') }}" class="w-full mb-2 border p-2 rounded">
            @error('email_dsn') <div class="text-red-500">{{ $message }}</div> @enderror

            <label for="password_dsn">Password</label>
            <input type="password" name="password_dsn" class="w-full mb-2 border p-2 rounded">
            @error('password_dsn') <div class="text-red-500">{{ $message }}</div> @enderror

            <label for="password_dsn_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_dsn_confirmation" class="w-full mb-2 border p-2 rounded">
            @error('password_dsn') <div class="text-red-500">{{ $message }}</div> @enderror


            <label for="foto_dsn">Foto (Opsional)</label>
            <input type="file" name="foto_dsn" class="w-full mb-2 border p-2 rounded">
            @error('foto_dsn') <div class="text-red-500">{{ $message }}</div> @enderror

            <label for="role_dsn">Role</label>
            <select name="role_dsn" class="w-full mb-4 p-2 border rounded">
                <option value="">-- Pilih Role --</option>
                <option value="admin" {{ old('role_dsn') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="kajur" {{ old('role_dsn') == 'kajur' ? 'selected' : '' }}>Kajur</option>
            </select>
            @error('role_dsn') <div class="text-red-500">{{ $message }}</div> @enderror
        @endif

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
    </form>

</div>

<script>
    const form = document.getElementById('form-create');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Apakah Anda yakin ingin menambahkan data ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if(result.isConfirmed) {
                form.submit(); // <-- gunakan variabel, bukan this
            }
        });
    });

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "{{ session('error') }}",
        });
    @endif
</script>
@endsection

