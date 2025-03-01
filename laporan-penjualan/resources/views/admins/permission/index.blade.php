@extends('layouts.app')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-balck mb-3 text-center">Data Permissions</h6>
            @can('create-permission')
                <button type="button" class="btn" style="background-color: #7E1010; color: white"
                    onclick="window.location.href='{{ route('permissions.create') }}'">Tambah</button>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name permission</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    @can('edit-permission')
                                        <a href="{{ route('permissions.edit', $permission->id) }}"
                                            class="btn btn-primary btn-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('delete-permission')
                                        <form id="delete-form-{{ $permission->id }}"
                                            action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn icon btn-danger btn-circle"
                                                onclick="confirmDelete({{ $permission->id }})">
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
