@extends('layouts.app')
@section('title','Absensi')
@section('admin.absensi','active')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Absensi Mahasiswa Semester {{ $data['semester']->name }}</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.absensi.index') }}" class="btn btn-secondary">Kembali</a>
                        <hr>
                        <div class="row">
                            @foreach ($data['kelas'] as $k)
                            <div class="col-lg-3 col-6">
                                <!-- small card -->
                                @if ($data['semester']->name === '1')
                                <div class="small-box bg-purple">  
                                @elseif($data['semester']->name === '2')
                                <div class="small-box bg-navy">
                                @elseif ($data['semester']->name === '3')
                                <div class="small-box bg-pink">
                                @elseif ($data['semester']->name === '4')
                                <div class="small-box bg-indigo">
                                @elseif ($data['semester']->name === '5')
                                <div class="small-box bg-lightblue">
                                @elseif ($data['semester']->name === '6')
                                <div class="small-box bg-fuchsia">
                                @else
                                <div class="small-box bg-dark">
                                @endif  
                                <div class="inner">
                                    <p>Kelas</p>
                                    <h3>{{ $data['semester']->name.''.$k->name }}</h3>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-school"></i>
                                </div>
                                <a href="{{ route('admin.absensi.jadwal',[$data['semester']->id, $k->id]) }}" class="small-box-footer">
                                    Masuk <i class="fas fa-arrow-circle-right"></i>
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