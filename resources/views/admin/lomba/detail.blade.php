@extends('admin.layouts.app')
@section('title', 'Detail Lomba')
@section('content')

    <div class="container mx-auto p-6 max-w-lg">
        <div class="bg-white shadow rounded-lg p-6">

            <h1 class="text-xl font-bold mb-6">Detail Lomba</h1>

            <div class="flex items-center mb-4">
                @if ($lomba['file_poster'])
                    <img src="{{ asset($lomba['file_poster']) }}" alt="Foto Lomba"
                        class="w-20 h-20 rounded-full object-cover mr-4">
                @else
                    <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 mr-4">
                        No Foto
                    </div>
                @endif

                <div>
                    <h2 class="text-lg font-semibold">{{ $lomba['judul'] }}</h2>
                    <p class="text-sm text-gray-500">Lomba</p>
                </div>
            </div>

            <ul class="space-y-3 text-sm">
                <li><strong>Judul:</strong> {{ $lomba['judul'] }}</li>
                <li><strong>Tempat:</strong> {{ $lomba['tempat'] }}</li>
                <li><strong>Pendaftaran:</strong> {{ $lomba['periode_pendaftaran'] }}</li>
                <li><strong>Url:</strong> {{ $lomba['link'] }}</li>
                <li><strong>Tingkat:</strong> {{ $lomba['tingkat'] }}</li>
                <li><strong>Individu:</strong> {{ $lomba['is_individu'] }}</li>
                <li><strong>Tersedia:</strong> {{ $lomba['is_active'] }}</li>
                <li><strong>Akademik:</strong> {{ $lomba['is_akademik'] }}</li>
                <li><strong>Bidang:</strong>
                    @foreach ($lomba['bidang'] as $b)
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs font-medium mr-1 px-1 py-0.5 rounded">
                            {{ $b['nama'] }}
                        </span>
                    @endforeach
                </li>

            </ul>

            <div class="mt-6 flex space-x-3">
                <a href="{{ url('admin/lomba') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
                    Kembali
                </a>
                <a href="{{ url("admin/lomba/edit/{$lomba['id']}") }}"
                    class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                    Edit
                </a>
                <a href="{{ url("admin/rekomendasi/create/{$lomba['id']}") }}"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                    Buat Rekomendasi Lomba
                </a>
                
            </div>
        </div>
    </div>

@endsection
