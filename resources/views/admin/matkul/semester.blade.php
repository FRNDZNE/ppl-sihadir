@extends('layouts.app')
@section('title','Mata Kuliah')
@section('admin.matkul','active')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5>Mata Kuliah</h5></div>
                <div class="card-body">
                    <table id="tables" class="table">
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
                                <td><a href="{{ route('admin.matkul.smt.index', $s->id) }}">Semester {{ $s->name}}</a></td>
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
