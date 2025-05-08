<aside class="w-64 bg-white h-screen border-r border-gray-200 flex flex-col">
    {{-- Logo --}}
    <div class="p-4">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
    </div>

    <nav class="mt-4">
    {{-- Menu Utama --}}
    <div class="px-4 text-xs font-semibold text-gray-500 uppercase mb-2">Menu Utama</div>
    <ul class="space-y-1 px-4">
        <li class="nav-item">
            <a href="{{ url('/') }}"
                class="sidebar-menu-button {{ $activeMenu == 'dashboard' ? 'sidebar-active' : '' }}">
                <svg class="w-5 h-5 mr-2 {{ $activeMenu == 'dashboard' ? 'text-white' : 'text-gray-400' }}"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 13h8V3H3v10zm10 8h8v-6h-8v6zM3 21h8v-6H3v6zm10-8h8V3h-8v10z"/>
                    </svg>
                    Dashboard
                </a>
        </li>
    </ul>

    {{-- Menu Lainnya --}}
    <div class="mt-6 px-4 text-xs font-semibold text-gray-500 uppercase mb-2">Menu Lainnya</div>
    <ul class="space-y-1 px-4">
        <li class="nav-item">
            <a href="{{ url('/users') }}"
                class="sidebar-menu-button {{ $activeMenu == 'users' ? 'sidebar-active' : '' }}">
                <svg class="w-5 h-5 mr-2 {{ $activeMenu == 'users' ? 'text-white' : 'text-gray-400' }}"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 13h8V3H3v10zm10 8h8v-6h-8v6zM3 21h8v-6H3v6zm10-8h8V3h-8v10z"/>
                    </svg>
                    Management Pengguna 
                </a>
        </li>

        {{-- Pencatatan Prestasi --}}
        <li>
            <a href="{{ url('achievements') }}"
            class="flex items-center py-2 px-3 rounded hover:bg-gray-100 text-sm sidebar-menu-button {{ Request::is('achievements*') ? 'text-blue-500 font-bold' : 'text-gray-500' }}">
                <svg class="w-5 h-5 mr-2 {{ Request::is('achievements*') ? 'text-blue-500' : 'text-gray-400' }}"
                    fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M8 21h8M12 17v4M17 8a5 5 0 0 1-10 0V4h10v4z"/>
                </svg>
                Pencatatan Prestasi
            </a>
        </li>

        {{-- Leaderboard --}}
        <li>
            <a href="{{ url('leaderboard') }}"
            class="flex items-center py-2 px-3 rounded hover:bg-gray-100 text-sm sidebar-menu-button {{ Request::is('leaderboard') ? 'text-blue-500 font-bold' : 'text-gray-500' }}">
                <svg class="w-5 h-5 mr-2 {{ Request::is('leaderboard') ? 'text-blue-500' : 'text-gray-400' }}"
                    fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 3h18v18H3V3zm9 14v-4M9 17v-2M15 17v-6"/>
                </svg>
                Leaderboard
            </a>
        </li>

        {{-- Bantuan --}}
        <li>
            <a href="{{ url('help') }}"
            class="flex items-center py-2 px-3 rounded hover:bg-gray-100 text-sm sidebar-menu-button {{ Request::is('help') ? 'text-blue-500 font-bold' : 'text-gray-500' }}">
                <svg class="w-5 h-5 mr-2 {{ Request::is('help') ? 'text-blue-500' : 'text-gray-400' }}"
                    fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 18h.01M12 14a4 4 0 1 0-4-4"/>
                </svg>
                Bantuan
            </a>
        </li>
    </ul>
    </nav>
</aside>
