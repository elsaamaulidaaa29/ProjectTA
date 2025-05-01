@extends('layouts.app')


@section('content')
    {{-- <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header text-white" style="background-color: #7E1010; color: white">
                <h4 class="text-center m-0">Edit Penjualan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Pilih Nama Barang -->
                    <div class="mb-3">
                        <label for="barang_id" class="form-label">Nama Menu</label>
                        <select name="barang_id" id="barang_id" class="form-control" required>
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}"
                                    {{ $barang->id == $penjualan->barang_id ? 'selected' : '' }}>
                                    {{ $barang->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('barang_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Jumlah Terjual -->
                    <div class="mb-3">
                        <label for="terjual" class="form-label">Jumlah Terjual</label>
                        <input type="number" id="terjual" name="jumlah_terjual" class="form-control"
                            placeholder="Jumlah Terjual" value="{{ $penjualan->jumlah_terjual }}" required>
                        @error('jumlah_terjual')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Tanggal -->
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" id="tanggal" name="date" class="form-control"
                            value="{{ $penjualan->date }}" required>
                        @error('date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Harga</label>
                        <input type="text" id="harga" name="harga" class="form-control"
                            value="{{ $penjualan->harga }}" required>
                        @error('harga')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                        <select id="metode_pembayaran" name="metode_pembayaran" class="form-control" required>
                            <option value="Cash" {{ $penjualan->metode_pembayaran == 'Cash' ? 'selected' : '' }}>Cash
                            </option>
                            <option value="QRIS" {{ $penjualan->metode_pembayaran == 'QRIS' ? 'selected' : '' }}>QRIS
                            </option>
                            <option value="Transfer" {{ $penjualan->metode_pembayaran == 'Transfer' ? 'selected' : '' }}>
                                Transfer</option>
                        </select>
                        @error('metode_pembayaran')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Tombol Submit -->
                    <div class="text-center">
                        <button type="submit" class="btn px-4" style="background-color: #7E1010; color: white">
                            Edit
                        </button>
                    </div>


                </form>
            </div>
        </div>
    </div> --}}

    @livewire('penjualan-form', ['penjualanId' => $penjualan->id])
@endsection

@section('style')
    <style>
        h2 {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background: #ddd;
            font-size: 16px;
        }

        input[type="date"] {
            appearance: none;
            -webkit-appearance: none;
            position: relative;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            position: absolute;
            right: 10px;
            cursor: pointer;
        }

        button {
            background: orange;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #ccc;
        }
    </style>
@endsection
