@extends('layouts.app')

@section('content')
    <div
        style="width: 80%; margin: 20px auto; background-color: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h4 style="text-align: center; margin-bottom: 15px; color: #333;">Grafik Penjualan Bulanan</h4>
        <div style="height: 400px;">
            <canvas id="penjualanChart"></canvas>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('penjualanChart').getContext('2d');

            // Pastikan data tersedia
            const chartData = @json($data);
            const chartLabels = @json($labels);

            // Setup Pie Chart
            new Chart(ctx, {
                type: 'pie', // Ubah dari 'bar' ke 'pie'
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Jumlah Terjual',
                        data: chartData,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)'
                        ],
                        borderColor: 'rgba(255, 255, 255, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let total = chartData.reduce((a, b) => a + b, 0);
                                    let value = context.raw;
                                    let percentage = ((value / total) * 100).toFixed(2);
                                    return ` ${context.label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
