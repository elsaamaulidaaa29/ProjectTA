@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Penjualan</h2>

        <form action="{{ route('penjualan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="barang_id">Nama Barang</label>
                <select name="barang_id" id="barang_id" class="form-control">
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah_terjual">Jumlah Terjual</label>
                <input type="number" name="jumlah_terjual" id="jumlah_terjual" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="date" id="tanggal" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambahkan</button>
        </form>



    </div>
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
