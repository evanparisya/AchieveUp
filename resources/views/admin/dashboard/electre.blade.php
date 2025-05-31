@extends('admin.layouts.app')

@section('title', 'Electre')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Fungsi untuk mengupdate chart berdasarkan metode yang dipilih
        function updateChart(metode) {
            const ctx = document.getElementById('chartPrestasi').getContext('2d');
            const data = {
                labels: ['Jan', 'Feb', 'Mar'],
                datasets: [{
                    label: 'Jumlah Prestasi',
                    data: metode === 'entropy' ? [5, 8, 4] : [3, 6, 9],
                    backgroundColor: '#6041CE',
                }]
            };
            ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
            new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Event listener untuk dropdown
        document.getElementById('metode').addEventListener('change', function() {
            updateChart(this.value);
        });

        // Inisialisasi chart dengan metode default
        <<
        << << < Updated upstream
        updateChart('electre'); ===
        === =
        updateChart('entropy'); >>>
        >>> > Stashed changes
    </script>
    <script>
        const ctx = document.getElementById('chartPrestasi').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar'],
                datasets: [{
                    label: 'Jumlah Prestasi',
                    data: [5, 8, 4],
                    backgroundColor: '#6041CE',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
