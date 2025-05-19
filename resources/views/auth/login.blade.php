@extends('auth.head')
<body class="h-screen w-screen grid grid-cols-1 lg:grid-cols-2">
    
    {{-- kiri --}}
    <div class="hidden lg:flex items-center justify-center p-4">
        <div class="w-full h-full bg-[#EFECFB] border-white border-[4px] rounded-[40px] flex items-center justify-center">
            <img src="{{ asset('images/login1.png') }}" alt="Login Illustration" class="w-2/3 h-auto">
        </div>
    </div>

    {{-- kanan --}}
    <div class="flex items-center justify-center relative">
        <div class="absolute w-[400px] h-[400px] bg-[#FEFEFE] rounded-full blur-3xl opacity-30 -z-10 top-1 left-2"></div>

        <form method="POST" action="{{url('/login')}}"
            class="w-3/4 max-w-md bg-white/30 backdrop-blur-md border border-white/20 rounded-2xl p-8">
            @csrf
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-14">
            </div>
            <p class="font-primary text-2xl text-center font-medium text-gray-800 mb-10">Login ke Sistem</p>

            <div class="mb-5">
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username / NIM</label>
                <input type="text" id="username" name="username" required autofocus
                    class="input">
            </div>

            <div class="mb-8">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required
                    class="input">
            </div>

            <button type="submit"
                class="button-primary w-full">
                Login
            </button>
        </form>
    </div>
</body>
</html>