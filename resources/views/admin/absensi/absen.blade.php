@extends('layouts.app')
@section('title', 'Absensi')
@section('admin.absensi', 'active')
@section('css')
    <style>
        #absensiTable th,
        #absensiTable td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Absensi Mahasiswa Kelas
                            {{ $data['semester']->name . '' . $data['kelas']->name . ' ' . $data['minggu']->name }} </h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.absensi.minggu', [$data['semester']->id, $data['kelas']->id, $data['jadwal']->id]) }}"
                            class="btn btn-secondary">Kembali</a>
                        <a href="javascript:void(0)" onclick="document.getElementById('absenForm').submit()"
                            class="float-right btn btn-primary">Simpan</a>
                        <hr>
                        <form
                            action="{{ route('admin.absen.store', [$data['semester']->id, $data['kelas']->id, $data['jadwal']->id, $data['minggu']->id]) }}"
                            method="POST" id="absenForm">
                            <table class="table table-striped" id="absensiTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                        @foreach ($data['jadwal']->jam as $jam)
                                            <th>Jam {{ $loop->iteration }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                @csrf
                                <input type="hidden" name="week_id" value="{{ $data['minggu']->id }}">
                                <input type="hidden" name="jadwal_id" value="{{ $data['jadwal']->id }}">
                                @foreach ($data['mahasiswa'] as $im => $m)
                                    <tr>
                                        <input type="hidden" name="mahasiswa[{{ $im }}][id]"
                                            value="{{ $m->user->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $m->user->name }}</td>
                                        <td>
                                            <button type="button" onclick="setAll('h', {{ $m->id }})"
                                                class="btn btn-success"><i class="fas fa-user-check"></i></button>
                                            <button type="button" onclick="setAll('i', {{ $m->id }})"
                                                class="btn btn-info"><i class="fas fa-user-clock"></i></button>
                                            <button type="button" onclick="setAll('s', {{ $m->id }})"
                                                class="btn btn-warning"><i class="fas fa-user-injured"></i></button>
                                            <button type="button" onclick="setAll('a', {{ $m->id }})"
                                                class="btn btn-danger alpa-btn"><i class="fas fa-user-times"></i></button>
                                        </td>
                                        @foreach ($data['jadwal']->jam as $ji => $j)
                                            <td>
                                                <div class="form-group">
                                                    {{-- <input type="hidden" name="mahasiswa[{{ $im }}][absensi][{{ $ji }}][mahasiswa_id]" value="{{ $m->id }}"> --}}
                                                    <input type="hidden"
                                                        name="mahasiswa[{{ $im }}][absensi][{{ $ji }}][jam_id]"
                                                        value="{{ $j->id }}">
                                                    <select
                                                        name="mahasiswa[{{ $im }}][absensi][{{ $ji }}][keterangan]"
                                                        class="form-control absen-{{ $m->id }}">
                                                        @php

                                                            $absenMahasiswa = $m->user->absensi
                                                                ->where('jam_id', $j->id)
                                                                ->first();
                                                            $status = data_get($absenMahasiswa, 'status');
                                                        @endphp
                                                        <option value="h" {{ $status == 'h' ? 'selected' : '' }}>Hadir
                                                        </option>
                                                        <option value="s" {{ $status == 's' ? 'selected' : '' }}>Sakit
                                                        </option>
                                                        <option value="i" {{ $status == 'i' ? 'selected' : '' }}>Izin
                                                        </option>
                                                        <option value="a" {{ $status == 'a' ? 'selected' : '' }}>Alpa
                                                        </option>
                                                    </select>
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function setAll(keterangan, mahasiswa_id) {
            $('.absen-' + mahasiswa_id).each(function() {
                $(this).val(keterangan)
            });
        }
    </script>
@endsection
