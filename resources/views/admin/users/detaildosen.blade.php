@extends('admin.layouts.app')
@section('title', 'Detail Dosen')
@section('content')

<div class="container mx-auto p-6 max-w-lg">
    <div class="bg-white shadow rounded-lg p-6">

        <h1 class="text-xl font-bold mb-6">Detail Dosen</h1>

        <div class="flex items-center mb-4">
            @if ($dosen->foto)
                <img src="{{ asset($dosen->foto) }}" alt="Foto Dosen" class="w-20 h-20 rounded-full object-cover mr-4">
            @else
                <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 mr-4">
                    No Foto
                </div>
            @endif

            <div>
                <h2 class="text-lg font-semibold">{{ $dosen->nama }}</h2>
                <p class="text-sm text-gray-500">{{ ucwords(str_replace('_', ' ', $dosen->role)) }}</p>
            </div>
        </div>

        <ul class="space-y-3 text-sm">
            <li><strong>NIDN:</strong> {{ $dosen->nidn }}</li>
            <li><strong>Nama:</strong> {{ $dosen->nama }}</li>
            <li><strong>Username:</strong> {{ $dosen->username }}</li>
            <li><strong>Email:</strong> {{ $dosen->email }}</li>
            <li><strong>Role:</strong> {{ ucwords(str_replace('_', ' ', $dosen->role)) }}</li>
        </ul>

        <div class="mt-6 flex space-x-3">
            <a href="{{ url('admin/users') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
                Kembali
            </a>
            <a href="{{ url("admin/users/dosen/{$dosen->id}/update") }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                Update
            </a>
        </div>
    </div>
</div>

@endsection