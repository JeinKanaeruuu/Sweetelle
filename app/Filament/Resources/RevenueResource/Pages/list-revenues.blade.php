@extends('filament::page')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Pendapatan</h1>

        <!-- Grafik Pendapatan -->
        <canvas id="revenueChart" class="mt-4"></canvas>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('revenueChart').getContext('2d');
            const monthlyData = @json($monthlyData);
            const labels = Object.keys(monthlyData);
            const data = Object.values(monthlyData);

            const revenueChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels.map(month => `Bulan ${month}`), // Label bulan
                    datasets: [{
                        label: 'Pendapatan Bulanan',
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
@endsection
