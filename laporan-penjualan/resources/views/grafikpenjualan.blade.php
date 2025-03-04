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

            // Setup basic chart
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Jumlah Terjual',
                        data: chartData,
                        backgroundColor: 'rgba(53, 162, 235, 0.6)',
                        borderColor: 'rgba(53, 162, 235, 1)',
                        borderWidth: 1,
                        borderRadius: 4
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
                                    return `Jumlah: ${context.raw}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
