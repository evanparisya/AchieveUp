<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
</head>

@vite('resources/js/app.js')

<body class="h-screen w-screen grid grid-cols-1 lg:grid-cols-2">

    {{-- kiri --}}
    <div class="hidden lg:flex items-center justify-center p-4">
        <div
            class="w-full h-full bg-[#EFECFB] border-white border-[4px] rounded-[40px] flex items-center justify-center">
            <img src="{{ asset('images/login1.png') }}" alt="Login Illustration" class="w-2/3 h-auto">
        </div>
    </div>

    {{-- kanan --}}
    <div class="flex items-center justify-center relative">
        <div class="absolute w-[400px] h-[400px] bg-[#FEFEFE] rounded-full blur-3xl opacity-30 -z-10 top-1 left-2">
        </div>

        <form method="POST" action="{{ url('/login') }}"
            class="w-3/4 max-w-md bg-white/30 backdrop-blur-md border border-white/20 rounded-2xl p-8">
            @csrf
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-14">
            </div>
            <p class="font-primary text-2xl text-center font-medium text-gray-800 mb-10">Login ke Sistem</p>

            <div class="mb-5">
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username / NIM</label>
                <input type="text" id="username" name="username" required autofocus class="input">
            </div>

            <div class="mb-8">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required class="input">
            </div>

            <button type="submit" class="button-primary w-full">
                Login
            </button>
        </form>
    </div>
</body>
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
        });
    </script>
@endif

@if ($errors->has('login'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: '{{ $errors->first('login') }}',
        });
    </script>
@endif

</html>
