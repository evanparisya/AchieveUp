<aside class="w-64 bg-white h-screen border-r border-gray-200 flex flex-col flex-shrink-0">
    {{-- Logo --}}
    <div class="p-4 justify-center flex items-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
    </div>

    <nav class="mt-4">
        {{-- Menu Utama --}}
        <div class="px-4 text-xs font-semibold text-gray-500 uppercase mb-2">Menu Utama</div>
        <ul class="space-y-1 px-4">
            <li class="nav-item">
                <a href="{{ route('mahasiswa.dashboard.index') }}"
                    class="sidebar-menu-button {{ $activeMenu == 'dashboard' ? 'sidebar-active' : '' }}">
                    <div class="w-5 h-5 mr-2 inline-block align-middle {{ $activeMenu == 'dashboard' ? 'text-white' : 'text-gray-400' }}">                        
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m0 0h4m-4 0a2 2 0 01-2-2v-4a2 2 0 012-2h4a2 2 0 012 2v4a2 2 0 01-2 2h-4z" />
                        </svg>
                    </div>
                    Dashboard
                </a>
            </li>
        </ul>

        {{-- Menu Lainnya --}}
        <div class="mt-6 px-4 text-xs font-semibold text-gray-500 uppercase mb-2">Menu Lainnya</div>
        <ul class="space-y-1 px-4">
            <li class="nav-item">
                <a href="{{ route('mahasiswa.prestasi.index') }}"
                    class="sidebar-menu-button {{ $activeMenu == 'prestasi' ? 'sidebar-active' : '' }}">
                    <div class="w-5 h-5 mr-2 inline-block align-middle {{ $activeMenu == 'prestasi' ? 'text-white' : 'text-gray-400' }}">                        
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m0 0h4m-4 0a2 2 0 01-2-2v-4a2 2 0 012-2h4a2 2 0 012 2v4a2 2 0 01-2 2h-4z" />
                        </svg>
                    </div>
                    Prestasi Mahasiswa
                </a>
            </li>         
        </ul>
    </nav>
</aside>