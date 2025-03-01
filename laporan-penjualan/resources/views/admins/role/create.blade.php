@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header text-white" style="background-color: #7E1010; color: white">
                <h4 class="text-center m-0">Tambah Role</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="POST" class="form">
                    @csrf

                    <div class="mb-3">
                        <label for="role-name" class="form-label">Nama Role</label>
                        <input type="text" id="role-name" name="name" class="form-control"
                            placeholder="Masukkan Nama Role" value="{{ old('name') }}" required>

                        <!-- Error Validation -->
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn px-4" style="background-color: #7E1010; color: white">
                            Submit
                        </button>
                        <button type="reset" class="btn btn-secondary px-4" onclick="window.history.back();">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
