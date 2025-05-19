<header class="flex w-full h-[80px] px-6 lg:px-[64px] py-[24px] justify-between items-center flex-shrink-0 bg-gradient-to-b from-[rgba(255, 255, 255, 0.80)] to-[rgba(255, 255, 255, 0.80)] backdrop-blur-[25px] bg-[rgba(234, 229, 241, 0.05)]">
    {{-- Logo --}}
    <div class="flex items-center gap-4 lg:gap-[56px]">
        <img src="{{ asset('images/logo.png') }}" class="h-10" alt="Logo">
    </div>

    {{-- Menu --}}
    <div class="hidden lg:flex items-center gap-[56px]">
        <a href="#section-id" class="text-[#949494] font-sora text-[16px] font-normal leading-[28px] cursor-pointer no-underline hover:text-[#03045E]">
            Home
        </a>
        <a href="#section-id" class="text-[#949494] font-sora text-[16px] font-normal leading-[28px] cursor-pointer no-underline hover:text-[#03045E]">
            About
        </a>
        <a href="#section-id" class="text-[#949494] font-sora text-[16px] font-normal leading-[28px] cursor-pointer no-underline hover:text-[#03045E]">
            Services
        </a>
        <a href="#section-id" class="text-[#949494] font-sora text-[16px] font-normal leading-[28px] cursor-pointer no-underline hover:text-[#03045E]">
            Contact
        </a>
    </div>

    {{-- Login Button --}}
    <div class="hidden lg:flex items-center gap-[24px]">
        <a href="{{ url('/login') }}">
        <div class="button-primary flex items-center gap-2">
            
            <p class="text-base font-semibold leading-[28px]">Login ke Sistem</p>
        </div>
    </a>
    </div>

    {{-- Mobile Button --}}
    <div class="lg:hidden">
        <button id="mobile-menu-toggle" class="text-[#03045E]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden absolute top-[80px] left-0 w-full bg-white shadow-lg z-50 transition-all duration-300 transform -translate-y-full opacity-0">
        <div class="flex flex-col items-start gap-4 p-6">
            <a href="#section-id" class="text-[#949494] font-sora text-[16px] font-normal leading-[28px] cursor-pointer no-underline hover:text-[#03045E]">
                Home
            </a>
            <a href="#section-id" class="text-[#949494] font-sora text-[16px] font-normal leading-[28px] cursor-pointer no-underline hover:text-[#03045E]">
                About
            </a>
            <a href="#section-id" class="text-[#949494] font-sora text-[16px] font-normal leading-[28px] cursor-pointer no-underline hover:text-[#03045E]">
                Services
            </a>
            <a href="#section-id" class="text-[#949494] font-sora text-[16px] font-normal leading-[28px] cursor-pointer no-underline hover:text-[#03045E]">
                Contact
            </a>
            <div class="button-primary flex items-center gap-2">
                
                <p class="text-base font-semibold leading-[28px]">Login ke Sistem</p>
            </div>
        </div>
    </div>
</header>

<script>
    const toggleButton = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const toggleIcon = toggleButton.querySelector('svg');

    toggleButton.addEventListener('click', () => {
        if (mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.remove('hidden');
            setTimeout(() => {
                mobileMenu.classList.remove('-translate-y-full', 'opacity-0');
                mobileMenu.classList.add('translate-y-0', 'opacity-100');
            }, 10);

            // Tambahkan animasi rotasi pada ikon
            toggleIcon.classList.add('rotate-180');
        } else {
            mobileMenu.classList.add('-translate-y-full', 'opacity-0');
            mobileMenu.classList.remove('translate-y-0', 'opacity-100');
            setTimeout(() => {
                mobileMenu.classList.add('hidden');
            }, 300);

            toggleIcon.classList.remove('rotate-180');
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) { 
            mobileMenu.classList.add('hidden', '-translate-y-full', 'opacity-0');
            mobileMenu.classList.remove('translate-y-0', 'opacity-100');

            toggleIcon.classList.remove('rotate-180');
        }
    });
</script>