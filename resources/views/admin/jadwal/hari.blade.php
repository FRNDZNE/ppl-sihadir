@extends('layouts.app')
@section('title','Penjadwalan')
@section('admin.jadwal','active')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Penjadwalan Semester {{ $semester->name }} Kelas {{ $kelas->name }}</h5></div>
                <div class="card-body">
                    <a href="{{ route('admin.penjadwalan.semester.index', [$semester->id,$kelas->id]) }}" class="btn btn-secondary ">Kembali</a>
                    <hr>
                    <table id="tables" class="table text-center align-middle">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>HARI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($day as $d)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td><a href="{{ route('admin.penjadwalan.hari.index', [$semester->id, $kelas->id, $d->id]) }}">{{ $d->name }}</a></td>
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
