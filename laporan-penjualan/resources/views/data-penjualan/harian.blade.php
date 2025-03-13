@extends('layouts.app')

@section('content')
    {{-- <h1>Data Harian</h1> --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black mb-3 text-center">Data Penjualan</h6>
            @can('create-sale')
                <button type="button" class="btn" style="background-color: #7E1010; color: white;"
                    onclick="window.location.href='{{ route('penjualan.create') }}'">Tambah</button>
                {{-- <button onclick="printLaporan()" class="btn btn-primary">
                    <i class="fas fa-print"></i> Cetak Laporan</button> --}}
                <form action="{{ url('/report/penjualan') }}" method="GET" target="_blank">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-print"></i> Cetak Laporan
                    </button>
                </form>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Terjual</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualans as $index => $penjualan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $penjualan->barang->name }}</td>
                                <td>{{ $penjualan->jumlah_terjual }}</td>
                                <td>{{ \Carbon\Carbon::parse($penjualan->date)->translatedFormat('d M Y') }}</td>
                                <td>
                                    @can('edit-sale')
                                        <a href="{{ route('penjualan.edit', $penjualan->id) }}"
                                            class="btn btn-primary btn-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('delete-sale')
                                        <form id="delete-form-{{ $penjualan->id }}"
                                            action="{{ route('penjualan.destroy', $penjualan->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-circle"
                                                onclick="confirmDelete({{ $penjualan->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            function printLaporan() {
                window.print();
            }
        </script>
    </div>
@endsection
