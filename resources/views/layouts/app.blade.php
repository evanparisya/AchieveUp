<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite('resources/css/app.css')

</head>
<body class="bg-[#f7f5ff] text-gray-800">
    <div class="flex min-h-screen">
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col">
            @include('layouts.header')

            <main class="p-8">
                <div class="breadcrumb">
                    @include('layouts.breadcrumb')
                </div>
                <div id="main-content">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    @vite('resources/js/app.js')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
</body>
</html>