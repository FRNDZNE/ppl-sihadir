<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Week;
use App\Models\User;
use App\Models\Mahasiswa;
use DB;

class AbsensiController extends Controller
{
    public function index()
    {
        // return 'halaman absensi';
        $semester = Semester::all();
        return view('admin.absensi.index',compact('semester'));
    }

    public function indexKls($smt)
    {
        $data['semester'] = Semester::where('id',$smt)->first();
        $data['kelas'] = Kelas::all();
        return view('admin.absensi.kelas',compact('data'));
    }

    public function indexJdw($smt,$kls)
    {
        $data['semester'] = Semester::where('id',$smt)->first();
        $data['kelas'] = Kelas::where('id',$kls)->first();
        
        $data['jadwal'] = Jadwal::where([
            ['semester_id',$smt],
            ['kelas_id',$kls],
        ])->with(['kelas', 'ruang', 'day', 'jam', 'dosen', 'matkul', 'semester'])->get();
        // return $data;
        $counter = collect([]);
        if ($data['jadwal']->count() > 0) {
            $counter = Mahasiswa::select(['kelas_id', 'semester_id', DB::raw('count(*) as total')])
                ->whereIn('kelas_id', $data['jadwal']->pluck('kelas_id'))
                ->with('semester:id,name', 'kelas:id,name') // for debuging purpose, remove if not needed
                ->groupBy(['kelas_id', 'semester_id'])
                ->get();
        }
        return view('admin.absensi.jadwal',compact('data','counter'));
    }

    public function indexWeek($smt,$kls,$jdw)
    {
        $data['semester'] = Semester::where('id',$smt)->first();
        $data['kelas'] = Kelas::where('id',$kls)->first();
        $data['jadwal'] = Jadwal::where('id',$jdw)->with([
            'kelas', 'ruang', 'day', 'jam', 'matkul', 'semester',
            ])->first();
        $data['minggu'] = Week::all();
        return view('admin.absensi.minggu',compact('data'));
    }

    public function indexAbsensi($smt,$kls,$jdw,$week)
    {
        $data['semester'] = Semester::where('id',$smt)->first();
        $data['kelas'] = Kelas::where('id',$kls)->first();
        $data['jadwal'] = Jadwal::where('id',$jdw)->with('jam')->first();
        $data['minggu'] = Week::where('id',$week)->first();
        $data['mahasiswa'] = Mahasiswa::with(['user.absensi' => function($q) use($jdw, $week) {
            $q->where('jadwal_id',$jdw);
            $q->where('week_id',$week);
        }])
        ->where([
            ['kelas_id', $kls],
            ['semester_id',$smt],
        ])
        ->get();

        return view('admin.absensi.absen',compact('data'));
    }

    public function storeAbsensi($smt,$kls,$jdw,$week, Request $request)
    {
        $request->validate([
            'mahasiswa' => 'required|array'
        ]);

        $jadwal = Jadwal::findOrFail($request->jadwal_id);
        $week = Week::findOrFail($request->week_id);
        $getAbsensi = Absensi::where('jadwal_id', $jadwal->id)
            ->where('week_id', $week->id)
            ->get();

        $upserts=[];
        foreach($request->mahasiswa as $mhs) {
            $mhsId = $mhs['id'];

            foreach($mhs['absensi'] as $absensi) {
                $absen = [
                    'mahasiswa_id' => $mhsId,
                    'jadwal_id'=>$jadwal->id,
                    'week_id' => $week->id,
                    'jam_id' => $absensi['jam_id'],
                    'status' => $absensi['keterangan'],
                ];
                $absenMahasiswa = $getAbsensi->where('mahasiswa_id',$mhsId)
                    ->where('jam_id',$absensi['jam_id'])
                    ->first();

                if ($absenMahasiswa) {
                    $absen['id'] = $absenMahasiswa->id;
                }
                $upserts[] = $absen;
            }
        }

        Absensi::upsert($upserts, ['id'], ['status']);

        return redirect()->back()->with('success', 'Berhasil menyimpan absen');
    }

}
