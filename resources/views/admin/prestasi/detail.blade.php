@extends('admin.layouts.app')

@section('title', 'Detail Prestasi')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <!-- Left Column: 8 Grids (Main Content) -->
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

            <!-- Main Info Grid -->
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

            <!-- Separator Line -->
            <hr class="my-6 border-t border-gray-200">

            <!-- Files Section -->
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

            <!-- Back Button -->
            <div class="mt-8 flex justify-start">
                <a href="{{ route('admin.prestasi.index') }}"
                    class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition-colors duration-300 shadow-sm focus:outline-none">
                    ← Kembali
                </a>
            </div>
        </div>

        <!-- Right Column: 4 Grids (Dosen & Mahasiswa) -->
        <div class="col-span-12 lg:col-span-4 space-y-6">
            <!-- Catatan Prestasi yang Ditolak -->
            <div class="bg-white/80 backdrop-blur-lg shadow-md rounded-xl p-5">
                @if ($prestasi->status === 'ditolak')
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Catatan Penolakan</h4>
                    @if ($prestasi->notes->isNotEmpty())
                        <ul class="space-y-2 text-gray-900">
                            @foreach ($prestasi->notes as $note)
                                <li class="border-b pb-2">
                                    <div class="font-semibold">Status: {{ $note->status }}</div>
                                    <div class="text-gray-600">{{ $note->note }}</div>
                                    <div class="text-xs text-gray-500">Dosen: {{ $note->dosen->nama ?? 'N/A' }}</div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 text-sm">Tidak ada catatan penolakan.</p>
                    @endif
                @elseif($prestasi->status === 'pending')
                    <div class="flex gap-2">
                        <button id="approve-btn" type="button" class="button-approve">
                            <i class="fas fa-check mr-1"></i> Approve
                        </button>
                        <button id="reject-btn" type="button" class="button-reject">
                            <i class="fas fa-times mr-1"></i> Reject
                        </button>
                    </div>
                @endif
            </div>

            <!-- Dosen Pembimbing -->
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

            <!-- Mahasiswa Terlibat -->
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
    </div>

    <script>
        $(document).ready(function() {
            // Approve
            $('#approve-btn').on('click', function() {
                Swal.fire({
                    title: 'Yakin ingin menyetujui prestasi ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#6041CE',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Ya, setujui!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/prestasi/{{ $prestasi->id }}/approve`,
                            type: 'PATCH',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(res) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: res.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan saat menyetujui prestasi.',
                                });
                            }
                        });
                    }
                });
            });

            // Reject
            $('#reject-btn').on('click', function() {
                Swal.fire({
                    title: 'Yakin ingin menolak prestasi ini?',
                    icon: 'warning',
                    input: 'textarea',
                    inputLabel: 'Catatan Penolakan',
                    inputPlaceholder: 'Masukkan alasan penolakan...',
                    inputAttributes: {
                        'aria-label': 'Catatan Penolakan'
                    },
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Ya, tolak!',
                    cancelButtonText: 'Batal',
                    preConfirm: (note) => {
                        if (!note) {
                            Swal.showValidationMessage('Catatan penolakan wajib diisi.');
                        }
                        return note;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/prestasi/{{ $prestasi->id }}/reject`,
                            type: 'PATCH',
                            data: {
                                _token: '{{ csrf_token() }}',
                                note: result.value
                            },
                            success: function(res) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: res.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan saat menolak prestasi.',
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
