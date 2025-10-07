<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\Kelas;
use App\Models\Week;
use App\Models\Mahasiswa;
use App\Models\User;
use PDF;

class CetakController extends Controller
{
    public function index()
    {
        $data = Semester::all();
        return view('admin.cetak.semester',compact('data'));
    }

    public function index_kelas($smt)
    {
        $data['semester'] = Semester::where('id',$smt)->first();
        $data['kelas'] = Kelas::all();
        return view('admin.cetak.kelas',compact('data'));
    }

    public function index_minggu($smt,$kls)
    {
        $data['semester'] = Semester::where('id',$smt)->first();
        $data['kelas'] = Kelas::where('id',$kls)->first();
        $data['week'] = Week::all();
        return view('admin.cetak.minggu',compact('data'));
    }

    public function index_rekap($smt,$kls,$week)
    {
        $data['semester'] = Semester::where('id',$smt)->first();
        $data['kelas'] = Kelas::where('id',$kls)->first();
        $data['week'] = Week::where('id',$week)->first();

        $data['mahasiswa'] = User::with(['mahasiswa'])->whereHas(
            'mahasiswa', function($q)use($smt,$kls){
                $q->where([
                    ['semester_id',$smt],
                    ['kelas_id',$kls],
                ]);
            }
        )->withCount([
            'absensi as sakit' => function($q)use($week){
                $q->where([
                    ['status','s'],
                    ['week_id',$week],
                ]);
            },
            'absensi as alpa' => function($q)use($week){
                $q->where([
                    ['status','a'],
                    ['week_id',$week],
                ]);
            },
            'absensi as izin' => function($q)use($week){
                $q->where([
                    ['status','i'],
                    ['week_id',$week],
                ]);
            }
        ])
        ->get();
        // return $data['mahasiswa'];

        $pdf = PDF::loadView('admin.cetak.absensi',compact('data'))->setPaper('a4','portrait');
        return $pdf->stream();
    }

    // GPT core
    


    public function testCetak()
    {
        $paper = array(0,0,950,1650);
        $pdf = PDF::loadView('admin.cetak.test')->setPaper($paper);
        return $pdf->download();
    }
    public function testCetakSP(){
        $pdf = PDF::loadView('admin.cetak.test2')->setPaper('a4','portrait');
        return $pdf->stream();
    }
}
