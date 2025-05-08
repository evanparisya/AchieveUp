@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Selamat datang di Dashboard</h1>
    <p>Konten utama dashboard bisa ditampilkan di sini.</p>

    <canvas id="myChart" class="w-full max-w-md mx-auto"></canvas>
    <script>
    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar'],
        datasets: [{
        label: 'Prestasi',
        data: [12, 19, 3],
        backgroundColor: '#6041CE'
        }]
    }
    });
    </script>
@endsection
