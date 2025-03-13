@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header text-white" style="background-color: #7E1010; color: white">
                <h4 class="text-center m-0">Edit Barang</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nama Barang -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Barang</label>
                        <input type="text" id="nama" name="name"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama Barang"
                            value="{{ old('name', $barang->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Jumlah Terjual -->
                    {{-- <div class="mb-3">
                        <label for="terjual" class="form-label">Terjual</label>
                        <input type="number" id="terjual" name="stock"
                            class="form-control @error('stock') is-invalid @enderror" placeholder="Jumlah Terjual"
                            value="{{ old('stock', $barang->stock) }}" required>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <!-- Tanggal -->
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" id="tanggal" name="date"
                            class="form-control @error('date') is-invalid @enderror"
                            value="{{ old('date', $barang->formatted_date) }}">
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn px-4"
                            style="background-color: #7E1010; color: white">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
