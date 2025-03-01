@extends('layouts.app')

@section('content')
    <div class="container-profile">
        {{-- <div class="back-button">&#8592;</div> --}}
        <div class="profile-img">&#128100;</div>
        <div class="name">{{ $user->name }}</div>
        <div class="button-profile">
            <button class="button">{{ $user->email }}</button>
            @if (!empty($user->roles) && $user->roles->count() > 0)
                @foreach ($user->roles as $role)
                    <button class="button">{{ $role->name }}</button>
                @endforeach
            @else
                <span class="badge bg-black">No roles assigned</span>
            @endif

            <button class="button">********</button> {{-- Jangan tampilkan password langsung --}}
        </div>
    </div>
@endsection

@section('style')
    <style>
        /* body {
                                                                                display: flex;
                                                                                justify-content: center;
                                                                                align-items: center;
                                                                                height: 100vh;
                                                                                background-color: #222;
                                                                                margin: 0;
                                                                            } */
        /* .container {
                                                                                background-color: white;
                                                                                width: 300px;
                                                                                padding: 20px;
                                                                                border-radius: 10px;
                                                                                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
                                                                                text-align: center;
                                                                            }  */

        .container-profile {
            text-align: center;
        }

        .button-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* .back-button {
                                text-align: left;
                                font-size: 20px;
                                cursor: pointer;
                                font-weight: bold;
                            } */

        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px auto;
            font-size: 40px;
        }

        .name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .button {
            display: block;
            width: 50%;
            padding: 10px;
            margin: 5px 0;
            background-color: #800000;
            color: white;
            border: none;
            border-radius: 5px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
        }

        .button:hover {
            background-color: #660000;
        }
    </style>
@endsection
