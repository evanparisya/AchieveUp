@extends('admin.layouts.app')
@section('title', 'Detail Bidang')
@section('content')

    <div class="container mx-auto p-6 max-w-lg">
        <div class="bg-white shadow rounded-lg p-6">

            <h1 class="text-xl font-bold mb-6">Detail Bidang</h1>

            <ul class="space-y-3 text-sm">
                <li><strong>Nama:</strong> {{ $bidang->nama }}</li>
                <li><strong>Kode:</strong> {{ $bidang->kode }}</li>
            </ul>

            <div class="mt-6 flex space-x-3">
                <a href="{{ url('admin/bidang') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
                    Kembali
                </a>
                <a href="{{ url("admin/bidang/edit/{$bidang->id}") }}"
                    class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                    Edit
                </a>
            </div>
        </div>
    </div>

@endsection
