@extends('layouts.app')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-balck mb-3 text-center">Data Menu</h6>
            @can('create-barang')
                <button type="button" class="btn text-white" style="background-color: #7E1010;"
                    onclick="window.location.href='{{ route('barang.create') }}'">Tambah</button>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            {{-- <th>Jumlah</th> --}}
                            <th>Tanggal</th>
                            <th>Is Active</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangs as $index => $barang)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $barang->name }}</td>
                                {{-- <td>{{ $barang->stock }}</td> --}}
                                <td>{{ \Carbon\Carbon::parse($barang->date)->translatedFormat('d M Y') }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" disabled
                                            {{ $barang->is_active ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    @can('edit-barang')
                                        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-primary btn-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('delete-barang')
                                        <form id="delete-form-{{ $barang->id }}"
                                            action="{{ route('barang.destroy', $barang->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-circle"
                                                onclick="confirmDelete({{ $barang->id }})">
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
