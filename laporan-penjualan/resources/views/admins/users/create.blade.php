@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">General Form Elements</h5>

            <!-- General Form Elements -->
            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" placeholder="Name"
                            value="{{ old('name') }}">
                    </div>
                </div>

                {{-- <div class="row mb-3">
                    <label for="username" class="col-sm-2 col-form-label">Username <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" placeholder="Username"
                            value="{{ old('username') }}">
                    </div>
                </div> --}}

                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input name="email" type="email" class="form-control" placeholder="Email"
                            value="{{ old('email') }}"></input>
                    </div>
                </div>

                {{-- <div class="row mb-3">
                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="jabatan" placeholder="Jabatan"
                            value="{{ old('jabatan') }}">
                    </div>
                </div> --}}


                <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label">Password <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input name="password" type="password" class="form-control" placeholder="Password" required
                            autocomplete="new-password" {{ old('password') }}></input>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-sm-2 col-form-label">Confirm Passowrd <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input name="password_confirmation" type="password" placeholder="Confirm Password"
                            class="form-control" required autocomplete="new-password" {{ old('password-confirm') }}></input>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Roles <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="roles[]" class="form-control" multiple>
                            <option value="">Select Roles</option>
                            @foreach ($roles as $id => $role)
                                <option value="{{ $id }}">{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>



                <button type="submit" class="btn btn-primary btn-block w-100">
                    Simpan
                </button>
            </form><!-- End General Form Elements -->

        </div>
    </div>
@endsection
