@extends('layouts.app')
@section('title', 'Data Mahasiswa')
@section('admin.mahasiswa', 'active')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Mahasiswa</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary btn-md"><i
                                class="fas fa-plus"></i> Tambah</a>
                        <hr>
                        <table id="tables" class="table text-center align-middle">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NIM</th>
                                    <th>NAMA</th>
                                    <th>OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->mahasiswa->nim }}</td>
                                        <td>{{ $d->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.cetak.sp', $d->mahasiswa->id) }}"
                                                class="btn btn-info btn-md"><i class="fas fa-print"></i></a>
                                            <a href="{{ route('admin.mahasiswa.edit', $d->id) }}" class="btn btn-warning"><i
                                                    class="fas fa-edit"></i></a>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger btn-md" data-toggle="modal"
                                                data-target="#modeldelete-{{ $d->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="modeldelete-{{ $d->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger">
                                                            <h5 class="modal-title">Hapus Mahasiswa</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah ingin menghapus {{ $d->name }} dari daftar mahasiswa
                                                            ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batal</button>
                                                            <form action="{{ route('admin.mahasiswa.delete', $d->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
