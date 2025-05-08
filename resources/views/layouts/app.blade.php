<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')

</head>
<body class="bg-[#EFECFB] text-gray-800">
    <div class="flex min-h-screen">
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col">
            @include('layouts.header')

            <main class="p-8">
                @include('layouts.breadcrumb') 
                @yield('content')
            </main>
        </div>
    </div>
    @vite('resources/js/app.js')
</body>
</html>