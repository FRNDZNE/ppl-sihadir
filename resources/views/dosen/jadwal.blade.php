@extends('layouts.app')
@section('title','Profil')
@section('dosen.absensi','active')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $jadwal->matkul->name.' '. $jadwal->semester->name.''.$jadwal->kelas->name }}</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('dosen.dashboard') }}" class="btn btn-secondary">Kembali</a>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="font-weight-bold">Ruangan : {{ $jadwal->ruang->name }}</p>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-striped" id="tables">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Minggu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($week as $w)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('dosen.absensi',[$jadwal->id,$w->id]) }}">{{ $w->name }}</a></td>
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