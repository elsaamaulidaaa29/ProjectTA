@extends('layouts.app')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Penjualan Bulanan</h6>
        </div>
        <div class="card-body">
            <div class="chart-bar">
                <canvas id="myBarChart"></canvas>
            </div>
            <hr>
            {{-- Styling for the bar chart can be found in the --}}
            {{-- <code>/js/demo/chart-bar-demo.js</code> file. --}}
        </div>
    </div>

    {{-- <script>
        <canvas id="salesChart"></canvas>
        

    </script> --}}
@endsection
