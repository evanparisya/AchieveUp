@extends('admin.layouts.app')
@section('title', 'Detail Mahasiswa')
@section('content')

<div class="container mx-auto p-6 max-w-lg">
    <div class="bg-white shadow rounded-lg p-6">

        <h1 class="text-xl font-bold mb-6">Detail Mahasiswa</h1>

        <div class="flex items-center mb-4">
            @if ($mahasiswa->foto)
                <img src="{{ asset($mahasiswa->foto) }}" alt="Foto Mahasiswa" class="w-20 h-20 rounded-full object-cover mr-4">
            @else
                <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 mr-4">
                    No Foto
                </div>
            @endif

            <div>
                <h2 class="text-lg font-semibold">{{ $mahasiswa->nama }}</h2>
                <p class="text-sm text-gray-500">Mahasiswa</p>
            </div>
        </div>

        <ul class="space-y-3 text-sm">
            <li><strong>NIM:</strong> {{ $mahasiswa->nim }}</li>
            <li><strong>Nama:</strong> {{ $mahasiswa->nama }}</li>
            <li><strong>Username:</strong> {{ $mahasiswa->username }}</li>
            <li><strong>Email:</strong> {{ $mahasiswa->email }}</li>
            <li><strong>Program Studi:</strong> {{ optional($mahasiswa->programStudi)->nama ?? '-' }}</li>
        </ul>

        <div class="mt-6 flex space-x-3">
            <a href="{{ url('admin/users') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
                Kembali
            </a>
            <a href="{{ url("admin/users/mahasiswa/{$mahasiswa->id}/update") }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                Update
            </a>
        </div>
    </div>
</div>

@endsection