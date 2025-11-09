@extends('layouts.app')
@section('title','Penjadwalan')
@section('admin.jadwal','active')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Penjadwalan Semester {{ $semester->name }} Kelas {{ $kelas->name }} Hari {{ $day->name }}</h5></div>
                <div class="card-body">
                    <a href="{{ route('admin.penjadwalan.kelas.index', [$semester->id,$kelas->id]) }}" class="btn btn-secondary">Kembali</a>
                    
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modelCreate">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="modelCreate" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title">Tambah Jadwal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="{{ route('admin.penjadwalan.hari.store', [$semester->id, $kelas->id, $day->id]) }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="semester">Semester</label>
                                                    <input type="text" class="form-control" id="semester" value="{{ $semester->name }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="kelas">Kelas</label>
                                                    <input type="text" class="form-control" id="kelas" value="{{ $kelas->name }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="day">Hari</label>
                                                    <input type="text" class="form-control" id="day" value="{{ $day->name }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="dosen">Dosen Pengampu</label>
                                                    <select name="dosen" id="dosen" class="form-control">
                                                        <option value="0">Pilih</option>
                                                        @foreach ($dosen as $d)
                                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="matkul">Mata Kuliah</label>
                                                    <select name="matkul" id="matkul" class="form-control">
                                                        <option value="0">Pilih</option>
                                                        @foreach ($matkul as $mk)
                                                            <option value="{{ $mk->id }}">{{ $mk->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="ruang">Ruangan</label>
                                                    <select name="ruang" id="ruang" class="form-control">
                                                        <option value="0">Pilih</option>
                                                        @foreach ($ruang as $r)
                                                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @foreach ($jam as $j)
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input type="checkbox" name="jam[]" id="jam-{{ $j->id }}" class="form-check-input" value="{{ $j->id }}">
                                                    <label for="jam-{{ $j->id }}" class="form-check-label">{{ $j->awal }} - {{ $j->akhir }}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <table id="tables" class="table text-center align-middle">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>MATA KULIAH</th>
                                <th>DOSEN PENGAMPU</th>
                                <th>OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $jdw)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jdw->matkul->name }}</td>
                                <td>{{ $jdw->dosen->name }}</td>
                                <td>
                                    {{-- Edit Jadwal --}}
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#modelEdit-{{ $jdw->id }}">
                                    <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="modelEdit-{{ $jdw->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title">Edit Jadwal</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>
                                                <form action="{{ route('admin.penjadwalan.hari.update', [$semester->id, $kelas->id, $day->id]) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $jdw->id }}">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="semester">Semester</label>
                                                                    <input type="text" class="form-control" id="semester" value="{{ $semester->name }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="kelas">Kelas</label>
                                                                    <input type="text" class="form-control" id="kelas" value="{{ $kelas->name }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="day">Hari</label>
                                                                    <input type="text" class="form-control" id="day" value="{{ $day->name }}" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="dosen">Dosen Pengampu</label>
                                                                    <select name="dosen" id="dosen" class="form-control">
                                                                        <option value="0">Pilih</option>
                                                                        @foreach ($dosen as $d)
                                                                            <option value="{{ $d->id }}" @if ($jdw->dosen_id == $d->id) selected @endif>{{ $d->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="matkul">Mata Kuliah</label>
                                                                    <select name="matkul" id="matkul" class="form-control">
                                                                        <option value="0">Pilih</option>
                                                                        @foreach ($matkul as $mk)
                                                                            <option value="{{ $mk->id }}" @if ($jdw->matkul_id == $mk->id) selected @endif>{{ $mk->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="ruang">Ruangan</label>
                                                                    <select name="ruang" id="ruang" class="form-control">
                                                                        <option value="0">Pilih</option>
                                                                        @foreach ($ruang as $r)
                                                                            <option value="{{ $r->id }}" @if ($jdw->ruang_id == $r->id) selected @endif>{{ $r->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            @php
                                                                $jadwalJam = $jdw->jam->pluck('id')->toArray();
                                                            @endphp
                                                            @foreach ($jam as $j)
                                                            <div class="col-md-3">
                                                                <div class="form-check">
                                                                    <input type="checkbox" name="jam[]" id="jam-{{ $j->id }}" class="form-check-input" value="{{ $j->id }}" @if (in_array($j->id, $jadwalJam)) checked @endif>
                                                                    <label for="jam-{{ $j->id }}" class="form-check-label">{{ $j->awal }} - {{ $j->akhir }}</label>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-warning">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Edit Jadwal --}}
                                    {{-- Hapus Jadwal --}}
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#modelDelete-{{ $jdw->id }}">
                                    <i class="fas fa-trash"></i>
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="modelDelete-{{ $jdw->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title">Hapus Jadwal</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah ingin menghapus jadwal mata kuliah {{ $jdw->matkul->name }} ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <form action="{{ route('admin.penjadwalan.hari.delete',[$semester->id, $kelas->id, $day->id, $jdw->id]) }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Hapus Jadwal --}}
                                </td>
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
