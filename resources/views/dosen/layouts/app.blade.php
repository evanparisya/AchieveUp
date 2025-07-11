<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css ">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    {{-- Select2 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- Select2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @vite('resources/css/app.css')

</head>

<body class="bg-[#fdfcff] text-gray-800">
    <div class="flex min-h-screen">
        @include('dosen.layouts.sidebar')

        <div class="flex-1 flex flex-col ml-64"> 
            @include('dosen.layouts.header')

            <main class="p-8 mt-16 overflow-auto"> 
                <div class="breadcrumb">
                    @include('dosen.layouts.breadcrumb')
                </div>
                <div id="main-content">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>

    @vite('resources/js/app.js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js "></script>
    @stack('js')
</body>

</html>