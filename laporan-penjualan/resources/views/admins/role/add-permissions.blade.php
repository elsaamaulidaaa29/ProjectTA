@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Update Role Permissions</h5>

            <!-- General Form Elements -->
            <form action="{{ route('roles.update-permission', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Permissions <span class="text-danger">*</span></label>

                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-md-4 col-sm-6 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permission[]"
                                        value="{{ $permission->id }}" id="perm_{{ $permission->id }}"
                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn w-100 w-md-auto" style="background-color: #7E1010; color: white">
                    Update
                </button>
            </form><!-- End General Form Elements -->
        </div>
    </div>
@endsection
