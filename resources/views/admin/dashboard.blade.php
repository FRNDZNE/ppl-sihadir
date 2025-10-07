@extends('layouts.app')
@section('title','Dashboard')
@section('admin.dashboard','active')
@section('content')
@php
    $hitungRuang  = count($data['ruang']);
    $hitungDosen  = count($data['dosen']);
    $hitungMahasiswa  = count($data['mahasiswa']);
    $hitungMatkul  = count($data['matkul']);
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Dashboard</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-user-tie"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Dosen</span>
                                    <span class="info-box-number">{{ $hitungDosen }}</span>
                                </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Mahasiswa</span>
                                    <span class="info-box-number">{{ $hitungMahasiswa }}</span>
                                </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fas fa-book-open"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Mata Kuliah</span>
                                <span class="info-box-number">{{ $hitungMatkul }}</span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                            <span class="info-box-icon bg-secondary"><i class="fas fa-door-open"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Ruangan</span>
                                <span class="info-box-number">{{ $hitungRuang }}</span>
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
