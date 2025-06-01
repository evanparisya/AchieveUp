@extends('admin.layouts.app')

@section('title', 'Rekomendasi')

@section('content')
    <div class="container">

        <a href="{{route('admin.rekomendasi.list')}}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
            List Rekomendasi
        </a>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
            @foreach ($lombaAktif as $lomba)
                <a href="{{ route('admin.lomba.detail', $lomba->id) }}"
                    class="block bg-white rounded-2xl shadow-md hover:shadow-lg hover:scale-105 transition transform duration-200 p-4">
                    <div class="text-xl font-semibold text-indigo-700">{{ $lomba->judul }}</div>
                    <div class="text-sm text-gray-500 mt-1">{{ $lomba->tingkat }}</div>
                    <div class="mt-2 text-sm text-gray-700">
                        Bidang: {{ $lomba->bidang->pluck('nama')->join(', ') }}
                    </div>
                    <div class="mt-1 text-xs text-gray-500 italic">
                        Pendaftaran: {{ \Carbon\Carbon::parse($lomba->tanggal_daftar)->format('d M Y') }} -
                        {{ \Carbon\Carbon::parse($lomba->tanggal_daftar_terakhir)->format('d M Y') }}
                    </div>
                </a>
            @endforeach
        </div>


    </div>


@endsection
