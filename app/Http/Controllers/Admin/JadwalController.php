<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\Kelas;
use App\Models\Day;
use App\Models\Jam;
use App\Models\Matkul;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\Ruang;
use Illuminate\Support\Facades\Url;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    public function index()
    {
        $semester = Semester::all();
        return view('admin.jadwal.semester',compact('semester'));
    }

    public function index_smt($smt)
    {
        $semester = Semester::where('id',$smt)->first();
        $kelas = Kelas::all();
        return view('admin.jadwal.kelas')->with([
            'semester' => $semester,
            'kelas' => $kelas,
        ]);
    }

    public function index_kls($smt,$kls)
    {
        $semester = Semester::where('id',$smt)->first();
        $kelas = Kelas::where('id',$kls)->first();
        $day = Day::all();
        return view('admin.jadwal.hari')->with([
            'semester' => $semester,
            'kelas' => $kelas,
            'day' => $day,
        ]);
    }

    public function index_jadwal($smt,$kls,$day)
    {
        $data['semester'] = Semester::where('id',$smt)->first();
        $data['kelas'] = Kelas::where('id',$kls)->first();
        $data['day'] = Day::where('id',$day)->first();
        $data['matkul'] = Matkul::where('semester_id',$smt)->get();
        $data['dosen'] = User::with('dosen')->whereHas('dosen')->get();
        $data['ruang'] = Ruang::all();
        $data['jam'] = Jam::all();
        $data['jadwal'] = Jadwal::where([
            ['semester_id', $smt],
            ['kelas_id', $kls],
            ['day_id', $day],
        ])->with([
            'matkul',
            'dosen',
            'ruang',
            'jam',
        ])->get();
        // return $data['jadwal'];
        return view('admin.jadwal.jadwal',$data);
    }

    public function store_jadwal(Request $request, $smt, $kls, $day)
    {
        $validate = Validator::make($request->all(), [
            'ruang' => 'required|min:0|not_in:0',
            'dosen' => 'required|min:0|not_in:0',
            'matkul' => 'required|min:0|not_in:0',
            'jam' => 'required|min:0|not_in:0',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('errors','Masukan Data Terlebih Dahulu');
        }
        $semester = Semester::where('id',$smt)->first();
        $kelas = Kelas::where('id',$kls)->first();
        $day = Day::where('id',$day)->first();

        $jadwal = new Jadwal;
        $jadwal->semester_id = $semester->id;
        $jadwal->kelas_id = $kelas->id;
        $jadwal->ruang_id = $request->ruang;
        $jadwal->dosen_id = $request->dosen;
        $jadwal->day_id = $day->id;
        $jadwal->matkul_id = $request->matkul;
        $jadwal->save();

        foreach ($request->jam as $jam) {
            $jadwal->jam()->attach($jam);
        }

        return redirect()->back()->with('success','Berhasil Menambah Data');
    }

    public function update_jadwal(Request $request, $smt, $kls, $day)
    {
        $validate = Validator::make($request->all(), [
            'ruang' => 'required|min:0|not_in:0',
            'dosen' => 'required|min:0|not_in:0',
            'matkul' => 'required|min:0|not_in:0',
            'jam' => 'required|min:0|not_in:0',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('errors','Masukan Data Terlebih Dahulu');
        }
        $semester = Semester::where('id',$smt)->first();
        $kelas = Kelas::where('id',$kls)->first();
        $day = Day::where('id',$day)->first();

        $jadwal = Jadwal::where('id', $request->id)->first();
        $jadwal->semester_id = $semester->id;
        $jadwal->kelas_id = $kelas->id;
        $jadwal->ruang_id = $request->ruang;
        $jadwal->dosen_id = $request->dosen;
        $jadwal->day_id = $day->id;
        $jadwal->matkul_id = $request->matkul;
        $jadwal->save();

        foreach ($jadwal->jam as $jamLama) {
            $jadwal->jam()->detach($jamLama);
        }

        foreach ($request->jam as $jam) {
            $jadwal->jam()->attach($jam);
        }

        return redirect()->back()->with('success','Berhasil Mengubah Data');
        
    }

    public function delete_jadwal($smt ,$kls, $day, $id)
    {
        $jadwal = Jadwal::find($id)->delete();
        // return $jadwal;
        return redirect()->back()->with('success','Berhasil Menghapus Data');
    }
}