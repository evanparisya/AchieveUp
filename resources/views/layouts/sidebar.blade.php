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
                <a href="{{ url('/dashboard') }}"
                    class="sidebar-menu-button {{ $activeMenu == 'dashboard' ? 'sidebar-active' : '' }}">
                    <x-heroicon-o-home class="w-5 h-5 mr-2 {{ $activeMenu == 'dashboard' ? 'text-white' : 'text-gray-400' }}" />
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
                    <x-heroicon-o-user class="w-5 h-5 mr-2 {{ $activeMenu == 'users' ? 'text-white' : 'text-gray-400' }}" />
                    Management Pengguna
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/mahasiswa') }}"
                    class="sidebar-menu-button {{ $activeMenu == 'mahasiswa' ? 'sidebar-active' : '' }}">
                    <x-heroicon-o-user class="w-5 h-5 mr-2 {{ $activeMenu == 'mahasiswa' ? 'text-white' : 'text-gray-400' }}" />
                    Mahasiswa
                </a>
            </li>
        </ul>
    </nav>
</aside>