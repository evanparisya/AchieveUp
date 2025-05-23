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
                <a href="{{ route('admin.dashboard.index') }}"
                    class="sidebar-menu-button {{ $activeMenu == 'dashboard' ? 'sidebar-active' : '' }}">
                    <div
                        class="w-5 h-5 mr-2 inline-block align-middle {{ $activeMenu == 'dashboard' ? 'text-white' : 'text-gray-400' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
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
                <a href="{{ route('admin.users.index') }}"
                    class="sidebar-menu-button {{ $activeMenu == 'users' ? 'sidebar-active' : '' }}">
                    <div
                        class="w-5 h-5 mr-2 inline-block align-middle {{ $activeMenu == 'users' ? 'text-white' : 'text-gray-400' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m0 0h4m-4 0a2 2 0 01-2-2v-4a2 2 0 012-2h4a2 2 0 012 2v4a2 2 0 01-2 2h-4z" />
                        </svg>
                    </div>
                    Management Pengguna
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.prestasi.index') }}"
                    class="sidebar-menu-button {{ $activeMenu == 'prestasi' ? 'sidebar-active' : '' }}">
                    <div
                        class="w-5 h-5 mr-2 inline-block align-middle {{ $activeMenu == 'prestasi' ? 'text-white' : 'text-gray-400' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m0 0h4m-4 0a2 2 0 01-2-2v-4a2 2 0 012-2h4a2 2 0 012 2v4a2 2 0 01-2 2h-4z" />
                        </svg>
                    </div>
                    Pencatatan Prestasi
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.periode.index') }}"
                    class="sidebar-menu-button {{ $activeMenu == 'periode' ? 'sidebar-active' : '' }}">
                    <div
                        class="w-5 h-5 mr-2 inline-block align-middle {{ $activeMenu == 'periode' ? 'text-white' : 'text-gray-400' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m0 0h4m-4 0a2 2 0 01-2-2v-4a2 2 0 012-2h4a2 2 0 012 2v4a2 2 0 01-2 2h-4z" />
                        </svg>
                    </div>
                    Management Periode
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.lomba.index') }}"
                    class="sidebar-menu-button {{ $activeMenu == 'lomba' ? 'sidebar-active' : '' }}">
                    <div
                        class="w-5 h-5 mr-2 inline-block align-middle {{ $activeMenu == 'lomba' ? 'text-white' : 'text-gray-400' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m0 0h4m-4 0a2 2 0 01-2-2v-4a2 2 0 012-2h4a2 2 0 012 2v4a2 2 0 01-2 2h-4z" />
                        </svg>
                    </div>
                    Management Lomba
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.prodi.index') }}"
                    class="sidebar-menu-button {{ $activeMenu == 'prodi' ? 'sidebar-active' : '' }}">
                    <div
                        class="w-5 h-5 mr-2 inline-block align-middle {{ $activeMenu == 'prodi' ? 'text-white' : 'text-gray-400' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m0 0h4m-4 0a2 2 0 01-2-2v-4a2 2 0 012-2h4a2 2 0 012 2v4a2 2 0 01-2 2h-4z" />
                        </svg>
                    </div>
                    Management Prodi
                </a>
            </li>
        </ul>
    </nav>
    {{-- Tombol Logout --}}
    <div class="mt-auto px-4">
        <a href="{{ route('logout') }}"
            class="sidebar-menu-button text-red-600 hover:bg-red-100 hover:text-red-700">
            <div class="w-5 h-5 mr-2 inline-block align-middle text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405 1.405A2.002 2.002 0 0117.586 21H6a2 2 0 01-2-2V5a2 2 0 012-2h11.586a2.002 2.002 0 011.415.586L20 4m-5 13v-4m0 0l3-3m-3 3l-3-3" />
                </svg>
            </div>
            Logout
        </a>
</aside>
