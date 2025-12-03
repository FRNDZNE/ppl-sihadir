@extends('layouts.app')
@section('title', 'Rekap Absensi')
@section('admin.rekap', 'active')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Rekap Absensi Mahasiswa Semester {{ $data['semester']->name }} Kelas {{ $data['kelas']->name }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.cetak.index.kelas', [$data['semester']->id]) }}"
                            class="btn btn-secondary">Kembali</a>
                        <hr>
                        <div class="row">
                            @foreach ($data['week'] as $w)
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <p>Rekap</p>
                                            <h3>{{ $w->name }}</h3>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-file-pdf"></i>
                                        </div>
                                        <a href="{{ route('admin.rekap', [$data['semester']->id, $data['kelas']->id, $w->id]) }}"
                                            class="small-box-footer" target="_blank">
                                            Cetak <i class="fas fa-arrow-circle-right"></i>
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
