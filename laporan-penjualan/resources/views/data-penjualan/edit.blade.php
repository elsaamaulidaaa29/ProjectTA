@extends('layouts.app')


@section('content')
    <div class="container">
        <h2>Edit Barang</h2>
        <form>
            <label for="nama">Nama Barang</label>
            <input type="text" id="nama" placeholder="Masukkan Nama Barang">

            <label for="terjual">Terjual</label>
            <input type="text" id="terjual" placeholder="Jumlah Terjual">

            <label for="tanggal">Tanggal</label>
            <input type="date" id="tanggal">

            <button type="submit">Edit</button>
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
