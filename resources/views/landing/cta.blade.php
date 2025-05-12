<div class="flex flex-col lg:flex-row justify-between lg:justify-between items-center text-center lg:text-left w-full h-[274px] p-8 shrink-0 bg-cover bg-no-repeat bg-center"
     style="
        background-image:
        linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        linear-gradient(0deg, rgba(117, 88, 222, 0.3), rgba(117, 88, 222, 0.3)),
        url('{{ asset('images/cta1.png') }}');
     ">
    <div class="flex flex-col items-center lg:items-start gap-4 w-full max-w-[628px]">
        <p class="text-secondary-text text-base font-normal leading-none">
            Call to Action
        </p>
        <p class="text-white font-epilogue text-3xl font-semibold leading-[50px]">
            Siap menjadikan data prestasi sebagai dasar kemajuan kampus?
        </p>
    </div>

    <div class="button-secondary flex items-center gap-3 mt-6 lg:mt-0">
        <x-uiw-login class="h-[24px]" />
        <p class="text-base font-semibold leading-[28px] text-white">Login ke Sistem</p>
    </div>
</div>