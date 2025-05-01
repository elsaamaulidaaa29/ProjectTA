@extends('layouts.app')

@section('content')
    {{-- <h1>Data Harian</h1> --}}
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="mb-4 m-0 font-weight-bold text-primary">Data Penjualan</h6>

            @can('create-sale')
                <button type="button" class="btn" style="background-color: #7E1010; color: white;"
                    onclick="window.location.href='{{ route('penjualan.create') }}'">Tambah</button>

                <form action="{{ url('/report/penjualan') }}" method="GET" target="_blank" class="d-inline">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-print"></i> Cetak Laporan
                    </button>
                </form>
            @endcan

            <form method="GET" action="{{ route('penjualan.index') }}" class="mt-3 row g-4 align-items-center">
                <div class="col-md-3">
                    <label for="tanggal_awal" class="form-label">Dari Tanggal</label>
                    <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
                </div>
                <div class="col-md-3">
                    <label for="tanggal_akhir" class="form-label">Sampai Tanggal</label>
                    <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                </div>
                <div class="col-md-3 mt-4 d-flex align-items-end gap-2">
                    <button type="submit" class="btn me-4" style="background-color: #7E1010; color: white;">Filter</button>
                    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Jumlah Terjual</th>
                            <th>Total Harga</th>
                            <th>Metode Pembayaran</th>
                            <th>Tanggal</th>
                            @canany(['edit-sale', 'delete-sale'])
                                <th>Tindakan</th>
                            @endcanany
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($penjualans as $index => $penjualan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if ($penjualan->barang)
                                        {{ $penjualan->barang->name }}
                                    @else
                                        <em class="text-muted">Barang tidak ditemukan</em>
                                    @endif
                                </td>
                                <td>{{ $penjualan->jumlah_terjual }}</td>
                                <td>{{ number_format($penjualan->total_harga, 0, ' ') }}</td>
                                <td>{{ $penjualan->metode_pembayaran }}</td>
                                <td>{{ \Carbon\Carbon::parse($penjualan->date)->translatedFormat('d M Y') }}</td>
                                @canany(['edit-sale', 'delete-sale'])
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
                                @endcanany
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
