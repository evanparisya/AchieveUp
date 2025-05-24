<header class="bg-white px-8 py-4 flex items-center justify-between">
    <div class="text-base font-medium text-gray-700">

    </div>

    <div class="flex items-center space-x-3 justify-end">
        <a href="{{ route('admin.profil.index') }}" class="flex items-center space-x-3">
            <img src="{{ Auth::guard('dosen')->user()->foto ? asset('storage/' . Auth::guard('dosen')->user()->foto) : asset('images/default-user.png') }}"
                onerror="this.onerror=null;this.src='{{ asset('images/default-user.png') }}';" alt="User Image"
                class="w-10 h-10 rounded-lg object-cover">
            <div class="flex flex-col text-right leading-tight">
                <span class="text-sm font-medium text-gray-800">
                    {{ Auth::guard('dosen')->user()->nama ?? 'Nama Pengguna' }}
                </span>
                <span class="text-sm text-gray-500">
                    {{ Auth::guard('dosen')->user()->nidn ?? 'NIDN' }}
                </span>
            </div>
        </a>
    </div>
</header>
