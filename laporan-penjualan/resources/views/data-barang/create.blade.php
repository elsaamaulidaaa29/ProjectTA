@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header text-white" style="background-color: #7E1010;">
                <h4 class="text-center m-0">Tambah Menu</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('barang.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Menu</label>
                        <input type="text" id="name" name="name" class="form-control"
                            placeholder="Masukkan Nama Barang" required>
                    </div>

                    {{-- <div class="mb-3">
                        <label for="stock" class="form-label">Stok</label>
                        <input type="number" id="stock" name="stock" class="form-control" placeholder="Jumlah Stok"
                            required>
                    </div> --}}

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="date" id="tanggal" class="form-control">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn text-white px-4" style="background-color: #7E1010;">Tambahkan</button>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                checked>
                            <label class="form-check-label" for="is_active">Aktif</label>
                        </div>
                        @error('is_active')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


{{-- @section('style')
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
@endsection --}}
