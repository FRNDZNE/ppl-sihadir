@extends('layouts.app')
@section('title','Dashboard')
@section('mahasiswa.dashboard','active')
@section('content')
@php
    $hadir = count($absensi['hadir']);
    $sakit = count($absensi['sakit']);
    $izin = count($absensi['izin']);
    $alpa = count($absensi['alpa']);
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Dashboard Mahasiswa</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-user-check"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Kehadiran</span>
                                    <span class="info-box-number">{{ $hadir }} JAM</span>
                                </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fas fa-user-injured"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Sakit</span>
                                    <span class="info-box-number">{{ $sakit }} JAM</span>
                                </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="fas fa-user-clock"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Izin</span>
                                <span class="info-box-number">{{ $izin }} JAM</span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="fas fa-user-times"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Tanpa Keterangan</span>
                                <span class="info-box-number">{{ $alpa }} JAM</span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
