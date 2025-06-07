@extends('dosen.layouts.app')

@section('title', $page->title)

@section('content')
<div class="mx-auto max-w-full h-full flex flex-col">
    <h1 class="text-xl font-bold mb-4">{{ $page->title }}</h1>

    <div class="bg-white shadow rounded border border-gray-200 p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Data Mahasiswa</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 text-sm text-gray-800">
            <div class="flex">
                <div class="w-40 font-medium text-gray-600">Nama</div>
                <div>: {{ $mahasiswa->nama }}</div>
            </div>
            <div class="flex">
                <div class="w-40 font-medium text-gray-600">NIM</div>
                <div>: {{ $mahasiswa->nim }}</div>
            </div>
            <div class="flex">
                <div class="w-40 font-medium text-gray-600">Username</div>
                <div>: {{ $mahasiswa->username }}</div>
            </div>
            <div class="flex">
                <div class="w-40 font-medium text-gray-600">Email</div>
                <div>: {{ $mahasiswa->email }}</div>
            </div>
            <div class="flex">
                <div class="w-40 font-medium text-gray-600">Program Studi</div>
                <div>: {{ $mahasiswa->program_studi }}</div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow rounded border border-gray-200 p-6">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Prestasi yang Pernah Diraih</h2>
        @if($prestasi->count())
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tempat</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tingkat</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Juara</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($prestasi as $p)
                    <tr>
                        <td class="px-4 py-2">{{ $p->judul }}</td>
                        <td class="px-4 py-2">{{ $p->tempat }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M Y') }}</td>
                        <td class="px-4 py-2">{{ ucfirst($p->tingkat) }}</td>
                        <td class="px-4 py-2">{{ $p->juara ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p class="text-gray-500">Belum ada prestasi tercatat.</p>
        @endif
    </div>

    <div class="mt-6">
        <a href="{{ route('dosen.bimbingan.index') }}" class="text-blue-600 hover:underline text-sm">Kembali</a>
    </div>
</div>
@endsection