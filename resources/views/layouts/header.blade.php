<header class="bg-white px-8 py-4 flex items-center justify-between">
    <div class="text-base font-medium text-gray-700">
           
        </div>
        <div class="flex items-center space-x-3 justify-end">
            <div class="flex flex-col text-right leading-tight">
                <span class="text-sm font-medium text-gray-800">{{ Auth::user()->name ?? 'Nama Pengguna' }}</span>
                <span class="text-sm text-gray-500">NIM/NIDN</span>
            </div>
            <img src="{{ Auth::user()->foto ?? asset('images/default-user.png') }}"
                onerror="this.onerror=null;this.src='{{ asset('images/default-user.png') }}';"
                alt="User Image"
                class="w-10 h-10 rounded-lg object-cover">
        </div>
</header>