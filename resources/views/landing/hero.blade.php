<div
    class="flex flex-col-reverse lg:flex-row w-full h-auto lg:h-auto p-6 lg:p-[128px_64px_190px_64px] sm:pb-[300px] justify-between items-center bg-gradient-to-r from-[#F2EFFE] via-[#FBFAFF] to-[#F2EFFE] max-w-full overflow-hidden gap-12 lg:gap-[115px]">

    {{-- Kiri --}}
    <div class="flex flex-col items-start gap-6 flex-1 text-center lg:text-left">
        <p class="text-primary font-sora text-sm lg:text-base font-normal leading-normal w-full">Welcome</p>
        <h1 class="text-[32px] lg:text-[56px] font-semibold leading-[40px] lg:leading-[64px]">
            <span class="text-ternary">Empowering</span>
            <span class="text-primary">Your Future</span>
            <span class="text-ternary">Through</span>
            <span class="text-primary">Learning</span>
        </h1>
        <div class="flex w-full justify-center lg:justify-start items-start gap-4">
            <div class="w-[8px] h-[8px] rounded-[10px] bg-primary"></div>
            <div class="w-[50px] h-[8px] rounded-[10px] bg-secondary"></div>
        </div>
        <div>
            <p class="text-[16px] lg:text-[20px]">Making learning easier with modern tools and interactive online
                experiences.</p>
        </div>
    </div>

    {{-- Kanan --}}
    <div class="w-full lg:w-[600px] h-auto lg:h-[463px] flex justify-center items-center">
        <img src="{{ asset('images/head_mobile.png') }}" alt="Landing Image" class="max-w-full h-[300px] sm:hidden">
        <img src="{{ asset('images/head.png') }}" alt="Landing Image"
            class="w-[600px] h-auto object-cover hidden sm:block">
    </div>

</div>
