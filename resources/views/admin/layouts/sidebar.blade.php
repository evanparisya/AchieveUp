<aside
    class="fixed top-0 left-0 h-screen w-64 bg-gradient-to-b from-slate-50 to-white border-r border-slate-200/60 shadow-xl z-100 backdrop-blur-sm">
    {{-- Logo Section --}}
    <div class="p-6 border-b border-slate-200/50">
        <div class="flex items-center justify-center">
            <div class="relative">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto drop-shadow-sm">
                <div
                    class="absolute -inset-1 bg-gradient-to-r from-[#6041CE]/20 to-purple-500/20 rounded-lg blur opacity-30">
                </div>
            </div>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto px-4 py-6">
        {{-- Menu Utama --}}
        <div class="mb-6">
            <div class="flex items-center mb-4">
                <div class="h-px bg-gradient-to-r from-slate-300 to-transparent flex-1"></div>
                <span class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Menu Utama</span>
                <div class="h-px bg-gradient-to-l from-slate-300 to-transparent flex-1"></div>
            </div>

            <ul class="space-y-2">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard.index') }}"
                        class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 ease-in-out hover:bg-slate-50 hover:shadow-sm {{ $activeMenu == 'dashboard' ? 'bg-gradient-to-r from-[#6041CE]/10 to-purple-500/5 text-[#6041CE] border border-[#6041CE]/20 shadow-sm' : 'text-slate-700 hover:text-slate-900' }}">
                        <div
                            class="flex items-center justify-center w-8 h-8 rounded-lg mr-3 transition-colors duration-200 {{ $activeMenu == 'dashboard' ? 'bg-[#6041CE]/10' : 'bg-slate-100 group-hover:bg-slate-200' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5"
                                class="w-4 h-4 {{ $activeMenu == 'dashboard' ? 'text-[#6041CE]' : 'text-slate-500 group-hover:text-slate-700' }}"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                            </svg>
                        </div>
                        <span class="font-medium">Dashboard</span>
                        @if ($activeMenu == 'dashboard')
                            <div class="ml-auto w-2 h-2 bg-[#6041CE] rounded-full"></div>
                        @endif
                    </a>
                </li>
            </ul>
        </div>

        {{-- Menu Lainnya --}}
        <div>
            <div class="flex items-center mb-4">
                <div class="h-px bg-gradient-to-r from-slate-300 to-transparent flex-1"></div>
                <span class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Menu Lainnya</span>
                <div class="h-px bg-gradient-to-l from-slate-300 to-transparent flex-1"></div>
            </div>

            <ul class="space-y-2">
                <li class="nav-item">
                    <a href="{{ route('admin.prestasi.index') }}"
                        class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 ease-in-out hover:bg-slate-50 hover:shadow-sm {{ $activeMenu == 'prestasi' ? 'bg-gradient-to-r from-[#6041CE]/10 to-purple-500/5 text-[#6041CE] border border-[#6041CE]/20 shadow-sm' : 'text-slate-700 hover:text-slate-900' }}">
                        <div
                            class="flex items-center justify-center w-8 h-8 rounded-lg mr-3 transition-colors duration-200 {{ $activeMenu == 'prestasi' ? 'bg-[#6041CE]/10' : 'bg-slate-100 group-hover:bg-slate-200' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5"
                                class="w-4 h-4 {{ $activeMenu == 'prestasi' ? 'text-[#6041CE]' : 'text-slate-500 group-hover:text-slate-700' }}"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.623 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <span class="font-medium">Verifikasi Prestasi</span>
                        @if ($activeMenu == 'prestasi')
                            <div class="ml-auto w-2 h-2 bg-[#6041CE] rounded-full"></div>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.rekomendasi.index') }}"
                        class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 ease-in-out hover:bg-slate-50 hover:shadow-sm {{ $activeMenu == 'rekomendasi' ? 'bg-gradient-to-r from-[#6041CE]/10 to-purple-500/5 text-[#6041CE] border border-[#6041CE]/20 shadow-sm' : 'text-slate-700 hover:text-slate-900' }}">
                        <div
                            class="flex items-center justify-center w-8 h-8 rounded-lg mr-3 transition-colors duration-200 {{ $activeMenu == 'rekomendasi' ? 'bg-[#6041CE]/10' : 'bg-slate-100 group-hover:bg-slate-200' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="w-4 h-4 {{ $activeMenu == 'rekomendasi' ? 'text-[#6041CE]' : 'text-slate-500 group-hover:text-slate-700' }}"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <span class="font-medium">Rekomendasi Lomba</span>
                        @if ($activeMenu == 'rekomendasi')
                            <div class="ml-auto w-2 h-2 bg-[#6041CE] rounded-full"></div>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.lomba.index') }}"
                        class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 ease-in-out hover:bg-slate-50 hover:shadow-sm {{ $activeMenu == 'lomba' ? 'bg-gradient-to-r from-[#6041CE]/10 to-purple-500/5 text-[#6041CE] border border-[#6041CE]/20 shadow-sm' : 'text-slate-700 hover:text-slate-900' }}">
                        <div
                            class="flex items-center justify-center w-8 h-8 rounded-lg mr-3 transition-colors duration-200 {{ $activeMenu == 'lomba' ? 'bg-[#6041CE]/10' : 'bg-slate-100 group-hover:bg-slate-200' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="w-4 h-4 {{ $activeMenu == 'lomba' ? 'text-[#6041CE]' : 'text-slate-500 group-hover:text-slate-700' }}"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <span class="font-medium">Management Lomba</span>
                        @if ($activeMenu == 'lomba')
                            <div class="ml-auto w-2 h-2 bg-[#6041CE] rounded-full"></div>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}"
                        class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 ease-in-out hover:bg-slate-50 hover:shadow-sm {{ $activeMenu == 'users' ? 'bg-gradient-to-r from-[#6041CE]/10 to-purple-500/5 text-[#6041CE] border border-[#6041CE]/20 shadow-sm' : 'text-slate-700 hover:text-slate-900' }}">
                        <div
                            class="flex items-center justify-center w-8 h-8 rounded-lg mr-3 transition-colors duration-200 {{ $activeMenu == 'users' ? 'bg-[#6041CE]/10' : 'bg-slate-100 group-hover:bg-slate-200' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="w-4 h-4 {{ $activeMenu == 'users' ? 'text-[#6041CE]' : 'text-slate-500 group-hover:text-slate-700' }}"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                        </div>
                        <span class="font-medium">Management Pengguna</span>
                        @if ($activeMenu == 'users')
                            <div class="ml-auto w-2 h-2 bg-[#6041CE] rounded-full"></div>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.prodi.index') }}"
                        class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 ease-in-out hover:bg-slate-50 hover:shadow-sm {{ $activeMenu == 'prodi' ? 'bg-gradient-to-r from-[#6041CE]/10 to-purple-500/5 text-[#6041CE] border border-[#6041CE]/20 shadow-sm' : 'text-slate-700 hover:text-slate-900' }}">
                        <div
                            class="flex items-center justify-center w-8 h-8 rounded-lg mr-3 transition-colors duration-200 {{ $activeMenu == 'prodi' ? 'bg-[#6041CE]/10' : 'bg-slate-100 group-hover:bg-slate-200' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="w-4 h-4 {{ $activeMenu == 'prodi' ? 'text-[#6041CE]' : 'text-slate-500 group-hover:text-slate-700' }}"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </div>
                        <span class="font-medium">Management Prodi</span>
                        @if ($activeMenu == 'prodi')
                            <div class="ml-auto w-2 h-2 bg-[#6041CE] rounded-full"></div>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.periode.index') }}"
                        class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 ease-in-out hover:bg-slate-50 hover:shadow-sm {{ $activeMenu == 'periode' ? 'bg-gradient-to-r from-[#6041CE]/10 to-purple-500/5 text-[#6041CE] border border-[#6041CE]/20 shadow-sm' : 'text-slate-700 hover:text-slate-900' }}">
                        <div
                            class="flex items-center justify-center w-8 h-8 rounded-lg mr-3 transition-colors duration-200 {{ $activeMenu == 'periode' ? 'bg-[#6041CE]/10' : 'bg-slate-100 group-hover:bg-slate-200' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="w-4 h-4 {{ $activeMenu == 'periode' ? 'text-[#6041CE]' : 'text-slate-500 group-hover:text-slate-700' }}"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="font-medium">Management Periode</span>
                        @if ($activeMenu == 'periode')
                            <div class="ml-auto w-2 h-2 bg-[#6041CE] rounded-full"></div>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.bidang.index') }}"
                        class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 ease-in-out hover:bg-slate-50 hover:shadow-sm {{ $activeMenu == 'bidang' ? 'bg-gradient-to-r from-[#6041CE]/10 to-purple-500/5 text-[#6041CE] border border-[#6041CE]/20 shadow-sm' : 'text-slate-700 hover:text-slate-900' }}">
                        <div
                            class="flex items-center justify-center w-8 h-8 rounded-lg mr-3 transition-colors duration-200 {{ $activeMenu == 'bidang' ? 'bg-[#6041CE]/10' : 'bg-slate-100 group-hover:bg-slate-200' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="w-4 h-4 {{ $activeMenu == 'bidang' ? 'text-[#6041CE]' : 'text-slate-500 group-hover:text-slate-700' }}"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <span class="font-medium">Management Bidang</span>
                        @if ($activeMenu == 'bidang')
                            <div class="ml-auto w-2 h-2 bg-[#6041CE] rounded-full"></div>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</aside>
