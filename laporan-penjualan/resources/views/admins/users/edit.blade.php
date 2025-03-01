@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">General Form Elements</h5>

            <!-- General Form Elements -->
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" placeholder="name"
                            value="{{ $user->name }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input name="email" type="email" placeholder="Email" class="form-control"
                            value="{{ $user->email }}"></input>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Roles <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="roles[]" class="form-control" multiple>
                            <option value="">Select Roles</option>
                            @foreach ($roles as $role => $roleName)
                                <option value="{{ $role }}" {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                    {{ $roleName }}
                                </option>
                            @endforeach

                    </div>
                </div>


                <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label">Password <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input name="password" type="password" class="form-control" autocomplete="new-password"></input>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-sm-2 col-form-label">Confirm Passowrd <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input name="password_confirmation" type="password" class="form-control"
                            autocomplete="new-password"></input>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block w-100">
                    Simpan
                </button>
            </form><!-- End General Form Elements -->
        </div>
    </div>
@endsection
