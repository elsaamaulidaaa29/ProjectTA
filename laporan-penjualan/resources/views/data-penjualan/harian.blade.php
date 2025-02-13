@extends('layouts.app')

@section('content')
    {{-- <h1>Data Harian</h1> --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black mb-3 text-center">Data Penjualan</h6>
            <button type="button" class="btn btn-primary"
                onclick="window.location.href='{{ route('penjualan.create') }}'">Tambah</button>
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
                                <td>{{ $penjualan->date }}</td>
                                <td>
                                    <a href="{{ route('penjualan.edit', $penjualan->id) }}"
                                        class="btn btn-primary btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('penjualan.destroy', $penjualan->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-circle">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
