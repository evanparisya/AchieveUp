@extends('mahasiswa.layouts.app')

@section('title', 'Detail Prestasi')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div
            class="col-span-12 lg:col-span-8 bg-white/80 backdrop-blur-lg shadow-md rounded-xl p-6 transition-all duration-300">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center border-b border-gray-200 pb-4 mb-6">
                <h5 class="text-[20px] font-medium text-gray-900">Detail Prestasi</h5>
                <span
                    class="inline-flex items-center gap-2 px-2 py-1 rounded text-xs font-semibold capitalize
                {{ $prestasi->status === 'disetujui'
                    ? 'bg-green-100 text-green-800'
                    : ($prestasi->status === 'pending'
                        ? 'bg-gray-200 text-gray-900'
                        : ($prestasi->status === 'ditolak'
                            ? 'bg-red-100 text-red-800'
                            : 'bg-gray-200 text-gray-900')) }}">

                    @php
                        $icon = '';
                        if ($prestasi->status === 'disetujui') {
                            $icon = 'fas fa-check-circle text-green-500';
                        } elseif ($prestasi->status === 'pending') {
                            $icon = 'fas fa-hourglass-half text-gray-500';
                        } elseif ($prestasi->status === 'ditolak') {
                            $icon = 'fas fa-times-circle text-red-500';
                        } else {
                            $icon = 'fas fa-question-circle text-gray-500';
                        }
                    @endphp

                    <i class="{{ $icon }}"></i>
                    {{ ucfirst($prestasi->status) }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="font-semibold text-gray-700">Judul</p>
                    <p class="text-gray-900">{{ $prestasi->judul }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Tempat</p>
                    <p class="text-gray-900">{{ $prestasi->tempat }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Tanggal Pengajuan</p>
                    <p class="text-gray-900">{{ $prestasi->tanggal_pengajuan }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Tanggal Mulai</p>
                    <p class="text-gray-900">{{ $prestasi->tanggal_mulai }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Tanggal Selesai</p>
                    <p class="text-gray-900">{{ $prestasi->tanggal_selesai }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Tingkat</p>
                    <p class="text-gray-900 capitalize">{{ $prestasi->tingkat }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Juara</p>
                    <p class="text-gray-900">{{ $prestasi->juara }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Jenis Peserta</p>
                    <p class="text-gray-900">{{ $prestasi->is_individu ? 'Individu' : 'Kelompok' }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Jenis Prestasi</p>
                    <p class="text-gray-900">{{ $prestasi->is_akademik ? 'Akademik' : 'Non Akademik' }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">URL</p>
                    @if ($prestasi->url)
                        <a href="{{ $prestasi->url }}" target="_blank"
                            class="text-blue-600 hover:text-blue-800 underline break-all">{{ $prestasi->url }}</a>
                    @else
                        <p class="text-gray-500">-</p>
                    @endif
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Nomor Surat Tugas</p>
                    <p class="text-gray-900">{{ $prestasi->nomor_surat_tugas }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">Tanggal Surat Tugas</p>
                    <p class="text-gray-900">{{ $prestasi->tanggal_surat_tugas }}</p>
                </div>
            </div>

            <hr class="my-6 border-t border-gray-200">

            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">File Berkas</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <p class="font-semibold text-gray-700">File Surat Tugas</p>
                        @if ($prestasi->file_surat_tugas)
                            <a href="{{ asset('storage/' . $prestasi->file_surat_tugas) }}" target="_blank"
                                class="text-blue-600 hover:text-blue-800 underline">Lihat File</a>
                        @else
                            <p class="text-gray-500">-</p>
                        @endif
                    </div>
                    <div>
                        <p class="font-semibold text-gray-700">File Sertifikat</p>
                        @if ($prestasi->file_sertifikat)
                            <a href="{{ asset('storage/' . $prestasi->file_sertifikat) }}" target="_blank"
                                class="text-blue-600 hover:text-blue-800 underline">Lihat File</a>
                        @else
                            <p class="text-gray-500">-</p>
                        @endif
                    </div>
                    <div>
                        <p class="font-semibold text-gray-700">File Poster</p>
                        @if ($prestasi->file_poster)
                            <a href="{{ asset('storage/' . $prestasi->file_poster) }}" target="_blank"
                                class="text-blue-600 hover:text-blue-800 underline">Lihat File</a>
                        @else
                            <p class="text-gray-500">-</p>
                        @endif
                    </div>
                    <div>
                        <p class="font-semibold text-gray-700">Foto Kegiatan</p>
                        @if ($prestasi->foto_kegiatan)
                            <a href="{{ asset('storage/' . $prestasi->foto_kegiatan) }}" target="_blank"
                                class="text-blue-600 hover:text-blue-800 underline">Lihat File</a>
                        @else
                            <p class="text-gray-500">-</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-start">
                <a href="{{ route('mahasiswa.prestasi.index') }}"
                    class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition-colors duration-300 shadow-sm focus:outline-none">
                    ← Kembali
                </a>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-4 space-y-6">
            <div class="bg-white/80 backdrop-blur-lg shadow-md rounded-xl p-5">
                <h4 class="text-lg font-semibold text-gray-800 mb-3">Catatan Penolakan</h4>

                @if ($prestasi->notes->isNotEmpty())
                    <ul class="space-y-3 text-gray-900">
                        @php
                            // Ambil 2 note terakhir
                            $latestNotes = $prestasi->notes->slice(-2);
                        @endphp

                        @foreach ($latestNotes as $note)
                            <li class="border-b pb-3">
                                <div
                                    class="inline-flex items-center gap-2 px-2 py-1 rounded text-xs font-semibold capitalize
                            {{ $note->status === 'disetujui'
                                ? 'bg-green-100 text-green-800'
                                : ($note->status === 'pending'
                                    ? 'bg-gray-200 text-gray-900'
                                    : ($note->status === 'ditolak'
                                        ? 'bg-red-100 text-red-800'
                                        : 'bg-gray-200 text-gray-900')) }}">
                                    {{ $note->status }}
                                </div>

                                <div class="text-xs text-gray-500 mt-1">
                                    {{ \Carbon\Carbon::parse($note->created_at)->format('d M Y, H:i') }}
                                </div>

                                <div class="text-gray-600 mt-1">{{ $note->note }}</div>

                                <div class="text-xs text-gray-500 mt-1">Dosen: {{ $note->dosen->nama ?? 'N/A' }}</div>
                            </li>
                        @endforeach
                    </ul>

                    @if (count($prestasi->notes) > 2)
                        <div class="mt-4">
                            <button onclick="document.getElementById('all-notes').classList.toggle('hidden')"
                                class="text-sm text-blue-600 hover:underline">
                                {{ count($prestasi->notes) - 2 }} catatan lainnya...
                            </button>
                        </div>

                        <ul id="all-notes" class="hidden space-y-3 mt-3 text-gray-900">
                            @foreach ($prestasi->notes as $note)
                                <li class="border-b pb-3">
                                    <div
                                        class="inline-flex items-center gap-2 px-2 py-1 rounded text-xs font-semibold capitalize
                                {{ $note->status === 'disetujui'
                                    ? 'bg-green-100 text-green-800'
                                    : ($note->status === 'pending'
                                        ? 'bg-gray-200 text-gray-900'
                                        : ($note->status === 'ditolak'
                                            ? 'bg-red-100 text-red-800'
                                            : 'bg-gray-200 text-gray-900')) }}">
                                        {{ $note->status }}
                                    </div>

                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ \Carbon\Carbon::parse($note->created_at)->format('d M Y, H:i') }}
                                    </div>

                                    <div class="text-gray-600 mt-1">{{ $note->note }}</div>

                                    <div class="text-xs text-gray-500 mt-1">Dosen: {{ $note->dosen->nama ?? 'N/A' }}</div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                @else
                    <p class="text-gray-500 text-sm">Tidak ada catatan penolakan.</p>
                @endif
            </div>
            <div class="bg-white/80 backdrop-blur-lg shadow-md rounded-xl p-5">
                <h4 class="text-lg font-semibold text-gray-800 mb-3">Dosen Pembimbing</h4>
                @if ($prestasi->dosens->isNotEmpty())
                    <ul class="space-y-2 text-gray-900">
                        @foreach ($prestasi->dosens as $dosen)
                            <li class="flex items-center gap-3">
                                @if ($dosen->foto)
                                    <img src="{{ asset($dosen->foto) }}" alt="Foto Dosen"
                                        class="w-10 h-10 rounded-[12px] object-cover border border-gray-200 flex-shrink-0">
                                @else
                                    <img src="{{ asset('images/default-user.png') }}" alt="Default User"
                                        class="w-10 h-10 rounded-[12px] object-cover border border-gray-200 flex-shrink-0">
                                @endif
                                <div>
                                    <div class="font-semibold">{{ $dosen->nama }}</div>
                                    <div class="text-xs text-gray-500">NIDN: {{ $dosen->nidn }}</div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-sm">Tidak ada dosen pembimbing terlibat.</p>
                @endif
            </div>

            <div class="bg-white/80 backdrop-blur-lg shadow-md rounded-xl p-5">
                <h4 class="text-lg font-semibold text-gray-800 mb-3">Mahasiswa Terlibat</h4>
                @if ($prestasi->mahasiswas->isNotEmpty())
                    <ul class="space-y-2 text-gray-900">
                        @foreach ($prestasi->mahasiswas as $mhs)
                            <li class="flex items-center gap-3">
                                @if ($mhs->foto)
                                    <img src="{{ asset($mhs->foto) }}" alt="Foto Mahasiswa"
                                        class="w-10 h-10 rounded-[12px] object-cover border border-gray-200 flex-shrink-0">
                                @else
                                    <span
                                        class="w-10 h-10 flex items-center justify-center bg-gray-200 text-gray-500 rounded-[12px] border border-gray-200">
                                        <i class="fas fa-user text-xl"></i>
                                    </span>
                                @endif
                                <div>
                                    <div class="font-semibold">{{ $mhs->nama }}</div>
                                    <div class="text-xs text-gray-500">NIM: {{ $mhs->nim }}</div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-sm">Tidak ada mahasiswa terlibat.</p>
                @endif
            </div>
        </div>
    @endsection
