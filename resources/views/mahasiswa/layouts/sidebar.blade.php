<aside class="fixed top-0 left-0 h-screen w-64 bg-white shadow z-100">
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
                    <div
                        class="w-5 h-5 mr-2 inline-block align-middle {{ $activeMenu == 'dashboard' ? 'text-[#6041CE]' : 'text-gray-400' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-full h-full"
                            stroke="currentColor">
                            <g clip-path="url(#clip0_dashboard)">
                                <path
                                    d="M3.35978 19.2398C3.59978 20.6598 4.95977 21.8098 6.39977 21.8098H17.5998C19.0298 21.8098 20.3998 20.6498 20.6398 19.2398L21.9698 11.2799C22.1298 10.2999 21.6298 8.98983 20.8598 8.36983L13.9298 2.82985C12.8598 1.96985 11.1298 1.96984 10.0698 2.81984L3.13978 8.36983C2.35978 8.98983 1.85978 10.2999 2.02978 11.2799L2.70978 15.3698"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M12 10.5C10.62 10.5 9.5 11.62 9.5 13C9.5 14.38 10.62 15.5 12 15.5C13.38 15.5 14.5 14.38 14.5 13"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_dashboard">
                                    <rect width="24" height="24" fill="white" />
                                </clipPath>
                            </defs>
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
                    <div
                        class="w-5 h-5 mr-2 inline-block align-middle {{ $activeMenu == 'prestasi' ? 'text-[#6041CE]' : 'text-gray-400' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-full h-full"
                            stroke="currentColor">
                            <g clip-path="url(#clip0)">
                                <path
                                    d="M19.39 12.54L18.38 12.77C17.66 12.94 17.09 13.5 16.93 14.22L16.7 15.23C16.68 15.34 16.52 15.34 16.5 15.23L16.27 14.22C16.1 13.5 15.54 12.93 14.82 12.77L13.81 12.54C13.7 12.52 13.7 12.36 13.81 12.34L14.82 12.11C15.54 11.94 16.11 11.38 16.27 10.66L16.5 9.65C16.52 9.54 16.68 9.54 16.7 9.65L16.93 10.66C17.1 11.38 17.66 11.95 18.38 12.11L19.39 12.34C19.5 12.36 19.5 12.52 19.39 12.54Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" />
                                <path
                                    d="M13.47 15.14C13 15.27 12.51 15.34 12 15.34C8.93 15.34 6.44 12.85 6.44 9.78V3.11C6.44 2.5 6.94 2 7.55 2H16.45C17.06 2 17.56 2.5 17.56 3.11V7.08"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M6.91001 12H6.45001C4.00001 12 2.01001 10.01 2.01001 7.55998V5.33998C2.01001 4.72998 2.51001 4.22998 3.12001 4.22998H6.45001"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M21.01 10.34C21.62 9.57998 21.99 8.60998 21.99 7.55998V5.33998C21.99 4.72998 21.49 4.22998 20.88 4.22998H17.55"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M16.07 18.67H7.93003C7.45003 18.67 7.03003 18.98 6.88003 19.43L6.51003 20.54C6.40003 20.88 6.45003 21.25 6.66003 21.54C6.87003 21.83 7.20003 22 7.56003 22H16.45C16.81 22 17.14 21.83 17.35 21.54C17.56 21.25 17.62 20.88 17.5 20.54L17.13 19.43C16.98 18.98 16.55 18.67 16.08 18.67H16.07Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M12 15.33V18.66" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0">
                                    <rect width="24" height="24" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    Prestasi Mahasiswa
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('mahasiswa.lomba.index') }}"
                    class="sidebar-menu-button {{ $activeMenu == 'lomba' ? 'sidebar-active' : '' }}">
                    <div
                        class="w-5 h-5 mr-2 inline-block align-middle {{ $activeMenu == 'lomba' ? 'text-[#6041CE]' : 'text-gray-400' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-full h-full"
                            stroke="currentColor">
                            <g clip-path="url(#clip0_lomba)">
                                <path d="M12.3701 8.88086H17.6201" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6.37988 8.88086L7.12988 9.63086L9.37988 7.38086" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12.3701 15.8809H17.6201" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6.37988 15.8809L7.12988 16.6309L9.37988 14.3809" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M2 12.95V15C2 20 4 22 9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_lomba">
                                    <rect width="24" height="24" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    Lomba
                </a>
            </li>
        </ul>
    </nav>
</aside>
