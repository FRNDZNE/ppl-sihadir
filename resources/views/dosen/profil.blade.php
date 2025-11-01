@extends('layouts.app')
@section('title','Profil')
@section('dosen.profil','active')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-warning"><h5>Profil</h5></div>
                <form action="{{ route('dosen.update') }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nip">Nip</label>
                                    <input type="text" name="nip" id="nip" class="form-control" value="{{ $data->dosen->nip }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="name" id="nama" class="form-control" value="{{ $data->name }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ $data->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                    <small>Abaikan Jika Tidak Ingin Mengganti Password</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Jenis Kelamin</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="laki" value="pria" @if($data->dosen->gender == 'pria') checked @endif>
                                            <label class="form-check-label" for="laki">
                                                Pria
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="perempuan" value="wanita" @if($data->dosen->gender == 'wanita') checked @endif>
                                            <label class="form-check-label" for="perempuan">
                                                Wanita
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection