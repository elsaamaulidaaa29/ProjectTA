@extends('layouts.app')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-balck mb-3 text-center">Data Roles</h6>
            @can('create-role')
                <button type="button" class="btn" style="background-color: #7E1010; color: white;"
                    onclick="window.location.href='{{ route('roles.create') }}'">Tambah</button>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name Role</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @can('give-permission')
                                        <a href="{{ route('roles.give-permission', $role->id) }}"
                                            class="btn btn-circle btn-success"><i class="fas fa-shield-virus"></i></a>
                                    @endcan
                                    @can('edit-role')
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('delete-role')
                                        <form id="delete-form-{{ $role->id }}"
                                            action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn icon btn-danger btn-circle"
                                                onclick="confirmDelete({{ $role->id }})">
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
