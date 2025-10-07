@extends('layouts.app')
@section('title','Absensi')
@section('admin.absensi','active')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Absensi Mahasiswa</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($semester as $s)
                            <div class="col-lg-3 col-6">
                                <!-- small card -->
                                @if ($s->name === '1')
                                <div class="small-box bg-purple">  
                                @elseif($s->name === '2')
                                <div class="small-box bg-navy">
                                @elseif ($s->name === '3')
                                <div class="small-box bg-pink">
                                @elseif ($s->name === '4')
                                <div class="small-box bg-indigo">
                                @elseif ($s->name === '5')
                                <div class="small-box bg-lightblue">
                                @elseif ($s->name === '6')
                                <div class="small-box bg-fuchsia">
                                @else
                                <div class="small-box bg-dark">
                                @endif  
                                <div class="inner">
                                    <p>Semester</p>
                                    <h3>{{ $s->name }}</h3>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-folder"></i>
                                </div>
                                <a href="{{ route('admin.absensi.kelas',$s->id) }}" class="small-box-footer">
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