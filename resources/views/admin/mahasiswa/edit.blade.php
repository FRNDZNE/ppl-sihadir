@extends('layouts.app')
@section('title','Edit Data Mahasiswa')
@section('admin.mahasiswa','active')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-warning"><h5>Edit Mahasiswa</h5></div>
                <form action="{{ route('admin.mahasiswa.update', $data['user']->id) }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nim">NIM</label>
                                    <input type="text" name="nim" id="nim" class="form-control" value="{{ $data['user']->mahasiswa->nim }}" placeholder="Masukkan NIM">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="name" id="nama" class="form-control" value="{{ $data['user']->name }}" placeholder="Masukkan Nama">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Jenis Kelamin</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="laki" value="pria" @if ($data['user']->mahasiswa->gender == 'pria') checked @endif>
                                            <label class="form-check-label" for="laki">
                                                Pria
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="perempuan" value="wanita" @if ($data['user']->mahasiswa->gender == 'wanita') checked @endif>
                                            <label class="form-check-label" for="perempuan">
                                                Wanita
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ $data['user']->email }}" placeholder="Masukkan Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                    <small>Abaikan jika tidak ingin mengganti password</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <select name="semester" id="semester" class="custom-select">
                                        <option value="">Pilih</option>
                                        @foreach ($data['semester'] as $smt)
                                            <option value="{{ $smt->id }}" class="form-control" @if ($data['user']->mahasiswa->semester_id == $smt->id) selected @endif>{{ $smt->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select name="kelas" id="kelas" class="custom-select">
                                        <option value="">Pilih</option>
                                        @foreach ($data['kelas'] as $kelas)
                                            <option value="{{ $kelas->id }}" class="form-control" @if ($data['user']->mahasiswa->kelas_id == $kelas->id) selected @endif>{{ $kelas->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="angkatan">Angkatan</label>
                                    <select name="angkatan" id="angkatan" class="custom-select">
                                        <option value="">Pilih</option>
                                        @foreach ($data['angkatan'] as $angkatan)
                                            <option value="{{ $angkatan->id }}" class="form-control" @if ($data['user']->mahasiswa->angkatan_id == $angkatan->id) selected @endif>{{ $angkatan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Update</button>
                        <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
