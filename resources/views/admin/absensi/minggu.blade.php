@extends('layouts.app')
@section('title','Absensi')
@section('admin.absensi','active')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Absensi Mahasiswa Kelas {{ $data['semester']->name.''. $data['kelas']->name }} </h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.absensi.jadwal',[$data['semester']->id,$data['kelas']->id]) }}" class="btn btn-secondary">Kembali</a>
                        <hr>
                        @php
                            $jam = count($data['jadwal']->jam);
                            $awal = $data['jadwal']->jam[0];
                            $akhir = $data['jadwal']->jam[$jam-1];
                        @endphp
                        <div class="row">
                            <div class="col-md-6">
                                <p><b>Mata Kuliah :</b> {{ $data['jadwal']->matkul->name }}</p>
                                <p><b>Dosen Pengampu :</b> {{ $data['jadwal']->dosen->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><b>Ruangan :</b> {{ $data['jadwal']->ruang->name }}</p>
                                <p><b>Jam :</b> {{ $awal->awal .' - '. $akhir->akhir }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            @foreach ($data['minggu'] as $w)
                            <div class="col-lg-3 col-6">
                                <!-- small card -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <p>Absensi</p>
                                        <h3>{{ $w->name }}</h3>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <a href="{{ route('admin.absen',[$data['semester']->id, $data['kelas']->id,$data['jadwal']->id,$w->id]) }}" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection