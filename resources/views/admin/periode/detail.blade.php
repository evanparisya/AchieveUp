@extends('admin.layouts.app')

@section('title', 'Detail Periode')

@section('content')

<div class="container mx-auto p-6 max-w-lg">
    <div class="bg-white shadow rounded-lg p-6">

        <h1 class="text-xl font-bold mb-6">Detail Periode</h1>

        <ul class="space-y-3 text-sm">
            <li><strong>Kode:</strong> {{ $periode->kode }}</li>
            <li><strong>Nama:</strong> {{ $periode->nama }}</li>
        </ul>

        <div class="mt-6 flex space-x-3">
            <a href="{{ route('admin.periode.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
                Kembali
            </a>
            <a href="{{ route('admin.periode.edit', $periode->id) }}"
                class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                Update
            </a>
        </div>
    </div>
</div>

@endsection
