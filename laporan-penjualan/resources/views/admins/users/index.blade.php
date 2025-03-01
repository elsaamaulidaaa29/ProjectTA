@extends('layouts.app')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-balck mb-3 text-center">Data Users</h6>
            @can('create-user')
                <button type="button" class="btn" style="background-color: #7E1010; color: white;"
                    onclick="window.location.href='{{ route('user.create') }}'">Tambah</button>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if (!empty($user->roles) && $user->roles->count() > 0)
                                        @foreach ($user->roles as $role)
                                            <span class="badge bg-primary text-white">{{ $role->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="badge bg-black">No roles assigned</span>
                                    @endif
                                </td>
                                <td>

                                    @can('edit-user')
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('delete-user')
                                        <form id="delete-form-{{ $user->id }}"
                                            action="{{ route('user.destroy', $user->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn icon btn-danger btn-circle"
                                                onclick="confirmDelete({{ $user->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
