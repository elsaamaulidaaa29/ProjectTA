@extends('layouts.app')

@section('content')
    @livewire('penjualan-form')
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
