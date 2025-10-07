@extends('layouts.app')
@section('title','Data Jam')
@section('admin.jam','active')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Data Jam</h5></div>
                <div class="card-body">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modalcreate">
                    <i class="fas fa-plus"></i> Tambah
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalcreate" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title"> Tambah Jam</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('admin.jam.store')}}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="awal">Jam Mulai</label>
                                                <input type="text" name="awal" id="awal" class="form-control" placeholder="Masukkan Jam Mulai" aria-describedby="helpId">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="akhir">Jam Selesai</label>
                                                <input type="text" name="akhir" id="akhir" class="form-control" placeholder="Masukkan Jam Selesai" aria-describedby="helpId">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                                </form>
                        </div>
                    </div>
                    <hr>
                    <table id="tables" class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>JAM MULAI</th>
                                <th>JAM AKHIR</th>
                                <th>OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jam as $j)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $j->awal}}</td>
                                <td>{{ $j->akhir}}</td>
                                <td>
                                    <!-- Button trigger modal  Edit-->
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modaledit-{{$j->id}}">
                                    <i class="fas fa-edit"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modaledit-{{$j->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title"> Edit Jam</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            <form action="{{route('admin.jam.update')}}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{$j->id}}">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="awal">Jam Mulai</label>
                                                                <input type="text" name="awal" id="awal" class="form-control" placeholder="Masukkan Jam Mulai" aria-describedby="helpId" value="{{ $j->awal }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="akhir">Jam Selesai</label>
                                                                <input type="text" name="akhir" id="akhir" class="form-control" placeholder="Masukkan Jam Selesai" aria-describedby="helpId" value="{{ $j->akhir }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-warning">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Button trigger modal  Delete-->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modaldelete-{{$j->id}}">
                                    <i class="fas fa-trash"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modaldelete-{{$j->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title"> Hapus Jam</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah ingin menghapus jam {{$j->awal.' - '.$j->akhir}} ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <form action="{{route('admin.jam.delete',$j->id)}}" method="post">
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
