@extends('layouts.app')
@section('title','Data Minggu')
@section('admin.minggu','active')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Data Minggu</h5></div>
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
                                    <h5 class="modal-title"> Tambah Minggu</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <form action="{{route('admin.week.store')}}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="minggu">Minggu</label>
                                        <input type="text" name="name" id="minggu" class="form-control" placeholder="Masukkan Minggu" aria-describedby="helpId">
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
                                <th>MINGGU</th>
                                <th>OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($week as $w)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $w->name}}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modaledit-{{$w->id}}">
                                        <i class="fas fa-edit"></i> 
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modaledit-{{$w->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title"> Edit Minggu</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{route('admin.week.update')}}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="{{$w->id}}">
                                                        <div class="form-group">
                                                            <label for="minggu">Minggu</label>
                                                            <input type="text" name="name" id="minggu" value="{{$w->name}}" class="form-control" placeholder="Masukkan Minggu" aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-warning">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>  
                                    </div>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modaldelete-{{$w->id}}">
                                    <i class="fas fa-trash"></i>
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="modaldelete-{{$w->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title">Hapus Minggu</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah ingin menghapus {{$w->name}} ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <form action="{{route('admin.week.delete',$w->id)}}" method="post">
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
