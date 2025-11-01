@extends('layouts.app')
@section('title','Profil')
@section('mahasiswa.profil','active')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info"><h5>Profil</h5></div>
                <form action="{{ route('mahasiswa.update') }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="NIM">NIM</label>
                                    <input type="text" name="nim" id="nim" class="form-control" value="{{ $data->mahasiswa->nim }}" disabled>
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
                                            <input class="form-check-input" type="radio" name="gender" id="laki" value="pria" @if($data->mahasiswa->gender == 'pria') checked @endif>
                                            <label class="form-check-label" for="laki">
                                                Pria
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="perempuan" value="wanita" @if($data->mahasiswa->gender == 'wanita') checked @endif>
                                            <label class="form-check-label" for="perempuan">
                                                Wanita
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <select name="semester" id="" class="form-control" disabled>
                                        <option value="{{ $data->mahasiswa->semester_id }}">{{ $data->mahasiswa->semester->name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select name="kelas" id="" class="form-control" disabled>
                                        <option value="{{ $data->mahasiswa->kelas_id }}">{{ $data->mahasiswa->kelas->name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="angkatan">Angkatan</label>
                                    <select name="angkatan" id="" class="form-control" disabled>
                                        <option value="{{ $data->mahasiswa->angkatan_id }}">{{ $data->mahasiswa->angkatan->name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection