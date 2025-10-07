@extends('layouts.app')
@section('title','Penjadwalan')
@section('admin.jadwal','active')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Penjadwalan</h5></div>
                <div class="card-body">
                    <table class="table" id="tables">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>SEMESTER</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($semester as $s)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td><a href="{{ route('admin.penjadwalan.semester.index',$s->id) }}">Semester {{ $s->name}}</a></td>
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
