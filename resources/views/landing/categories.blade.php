<div
    class="flex flex-col w-full h-auto px-4 sm:px-8 lg:px-16 py-32 items-center gap-16 bg-gradient-to-r from-[rgba(118,88,222,0.10)] to-[rgba(23,37,78,0.10)] relative">

    {{-- Background Image --}}
    <img src="{{ asset('images/absolute1.png') }}" class="absolute left-[64px] top-[50px] w-[120px] opacity-40 z-0" alt="">

    {{-- Judul --}}
    <div class="text-center z-10">
        <p class="text-[#6041CE] text-sm lg:text-base font-normal leading-normal">Course Categories</p>
        <h1 class="text-[32px] lg:text-[48px] font-semibold leading-[40px] lg:leading-[64px] text-dark-text">
            Top Categories
        </h1>
    </div>

    {{-- Card List --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8 w-full max-w-6xl z-10">

        @php
            $categories = [
                ['title' => 'Hackathon', 'icon' => 'users'],
                ['title' => 'UI/UX Design', 'icon' => 'pen-tool'],
                ['title' => 'Mobile App Dev', 'icon' => 'smartphone'],
                ['title' => 'Cybersecurity', 'icon' => 'shield-check'],
                ['title' => 'AI & ML', 'icon' => 'brain'],
                ['title' => 'IoT Innovation', 'icon' => 'cpu'],
                ['title' => 'Game Dev', 'icon' => 'gamepad-2'],
                ['title' => 'Data Analytics', 'icon' => 'bar-chart-2'],
            ];
        @endphp

        @foreach ($categories as $category)
            <div class="flex w-full p-4 items-center gap-4 rounded-[12px] bg-white shadow-sm hover:shadow-md transition-all duration-300">
                <div
                    class="flex w-[64px] h-[64px] justify-center items-center rounded-[8px] border border-[#6041CE] bg-[rgba(23,37,78,0.12)]">
                    <i data-lucide="{{ $category['icon'] }}" class="w-6 h-6 text-[#6041CE]"></i>
                </div>
                <div class="flex flex-col gap-1">
                    <p class="font-medium text-dark-text text-[16px] lg:text-[18px]">{{ $category['title'] }}</p>
                    <p class="text-sm text-gray-500">51 Course</p>
                </div>
            </div>
        @endforeach

    </div>

    {{-- Tombol View All --}}
    <div class="z-10">
        <a href="#"
            class="px-6 py-3 bg-[#6041CE] hover:bg-[#4d33aa] text-white text-sm lg:text-base rounded-full font-semibold shadow transition duration-300 flex items-center gap-2">
            View All Categories
            <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
    </div>
</div>

@push('scripts')
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
@endpush