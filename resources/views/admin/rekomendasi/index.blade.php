@extends('admin.layouts.app')

@section('title', 'Rekomendasi')

@section('content')
    <div class="mx-auto max-w-full h-full flex flex-col">
        <!-- Tab-like header -->
        <div class="flex border-b-0">
            <div
                class="inline-block px-5 py-2.5 text-sm font-medium bg-white border-t border-l border-r border-gray-200 rounded-t-lg text-[#6041CE] font-semibold">
                Rekomendasi Lomba
            </div>
        </div>

        <!-- Controls section -->
        <div class="bg-white border-t border-l border-r border-gray-200 px-6 py-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center space-x-3">
                    <label for="filter-bidang" class="text-sm font-medium text-gray-700">Filter Bidang</label>
                    <select id="filter-bidang"
                        class="appearance-none bg-white border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#6041CE] focus:border-transparent transition-all">
                        <option value="">Semua Bidang</option>
                        @foreach ($bidangList ?? [] as $bidang)
                            <option value="{{ $bidang->id }}">{{ $bidang->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center gap-3 w-full md:w-auto">
                    <div class="relative flex-1 md:flex-none md:min-w-[240px]">
                        <input id="search-bar" type="text" placeholder="Cari lomba..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#6041CE] focus:border-transparent transition-all" />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.rekomendasi.list') }}"
                        class="flex items-center justify-center px-4 py-2 bg-[#6041CE] hover:bg-[#4e35a5] text-white rounded-lg transition-colors duration-200 text-sm font-medium">
                        <i class="fas fa-list mr-2"></i>
                        <span>List Rekomendasi</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card Container -->
        <div class="bg-white shadow-md border border-gray-200 rounded-b-lg p-6">
            <div id="lomba-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($lombaAktif as $lomba)
                    <div class="lomba-card" data-bidang="{{ $lomba->bidang->pluck('id')->join(',') }}"
                        data-title="{{ $lomba->judul }}">
                        <a href="{{ route('admin.lomba.detail', $lomba->id) }}"
                            class="block bg-white rounded-xl border border-gray-200 shadow hover:shadow-lg transition-all duration-200 overflow-hidden">

                            <div class="p-5">
                                <div class="flex items-center justify-between mb-3">
                                    <span
                                        class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold 
                                        {{ $lomba->tingkat == 'internasional'
                                            ? 'bg-purple-100 text-purple-800'
                                            : ($lomba->tingkat == 'nasional'
                                                ? 'bg-blue-100 text-blue-800'
                                                : ($lomba->tingkat == 'regional'
                                                    ? 'bg-green-100 text-green-800'
                                                    : 'bg-yellow-100 text-yellow-800')) }}">
                                        {{ ucfirst($lomba->tingkat) }}
                                    </span>
                                    <i class="fas fa-trophy text-amber-500"></i>
                                </div>

                                <h3 class="text-lg font-semibold text-gray-900 line-clamp-2 h-14">{{ $lomba->judul }}</h3>

                                <div class="mt-3 flex flex-wrap gap-1 mb-3">
                                    @foreach ($lomba->bidang as $bidang)
                                        <span
                                            class="inline-flex px-2 py-1 bg-blue-50 text-blue-700 text-xs font-medium rounded">
                                            {{ $bidang->nama }}
                                        </span>
                                    @endforeach
                                </div>

                                <div class="flex items-center text-gray-500 text-sm mt-4 border-t pt-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-alt mr-1.5 text-gray-400"></i>
                                        <span>
                                            {{ \Carbon\Carbon::parse($lomba->tanggal_daftar)->format('d M Y') }} -
                                            {{ \Carbon\Carbon::parse($lomba->tanggal_daftar_terakhir)->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 px-5 py-3 flex justify-between items-center border-t">
                                <span class="text-xs">
                                    @if (\Carbon\Carbon::parse($lomba->tanggal_daftar_terakhir)->diffInDays(now()) < 7)
                                        <span class="text-red-500 font-medium">
                                            <i class="fas fa-clock mr-1"></i>
                                            Segera ditutup
                                        </span>
                                    @else
                                        <span class="text-green-500 font-medium">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Tersedia
                                        </span>
                                    @endif
                                </span>
                                <span class="text-[#6041CE] font-medium text-sm">Detail <i
                                        class="fas fa-chevron-right ml-1 text-xs"></i></span>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-12 text-gray-500">
                        <i class="fas fa-trophy text-gray-300 text-5xl mb-4"></i>
                        <p class="text-xl font-medium mb-2">Tidak ada lomba aktif</p>
                        <p class="text-sm text-gray-400">Belum ada rekomendasi lomba yang tersedia saat ini</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                function filterCards() {
                    const searchTerm = $('#search-bar').val().toLowerCase();
                    const bidangFilter = $('#filter-bidang').val();

                    $('.lomba-card').each(function() {
                        const card = $(this);
                        const title = card.data('title').toLowerCase();
                        const bidangs = card.data('bidang').toString().split(',');

                        const matchesSearch = title.includes(searchTerm);
                        const matchesBidang = !bidangFilter || bidangs.includes(bidangFilter);

                        if (matchesSearch && matchesBidang) {
                            card.show();
                        } else {
                            card.hide();
                        }
                    });

                    const visibleCards = $('.lomba-card:visible').length;
                    if (visibleCards === 0) {
                        if ($('#no-results').length === 0) {
                            $('#lomba-container').append(`
                            <div id="no-results" class="col-span-full flex flex-col items-center justify-center py-12 text-gray-500">
                                <i class="fas fa-search text-gray-300 text-5xl mb-4"></i>
                                <p class="text-xl font-medium mb-2">Tidak ada hasil</p>
                                <p class="text-sm text-gray-400">Tidak ada lomba yang sesuai dengan pencarian Anda</p>
                            </div>
                        `);
                        }
                    } else {
                        $('#no-results').remove();
                    }
                }

                $('#search-bar').on('input', filterCards);
                $('#filter-bidang').on('change', filterCards);
            });
        </script>
    @endpush


    <style>
        .lomba-card {
            transition: transform 0.2s;
        }

        .lomba-card:hover {
            transform: translateY(-4px);
        }
    </style>
@endsection
