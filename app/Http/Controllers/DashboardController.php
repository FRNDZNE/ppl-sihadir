<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Jadwal;
use App\Models\Semester;
use App\Models\Kelas;
use App\Models\Day;
use App\Models\Jam;
use App\Models\Ruang;
use App\Models\Matkul;
use App\Models\Absensi;
use Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function admin()
    {
        $data['ruang'] = Ruang::all();
        $data['dosen'] = Dosen::all();
        $data['mahasiswa'] = Mahasiswa::all();
        $data['matkul'] = Matkul::all();
        return view('admin.dashboard',compact('data'));
    }
    public function dosen()
    {
        $data = Jadwal::where('dosen_id', Auth::user()->id)
            ->with(['kelas', 'ruang', 'day', 'jam', 'dosen', 'matkul', 'semester'])
            ->get();

        // return $data;
        $counter = collect([]);
        if ($data->count() > 0) {
            $counter = Mahasiswa::select(['kelas_id', 'semester_id', DB::raw('count(*) as total')])
                ->whereIn('kelas_id', $data->pluck('kelas_id'))
                ->with('semester:id,name', 'kelas:id,name') // for debuging purpose, remove if not needed
                ->groupBy(['kelas_id', 'semester_id'])
                ->get();
        }

        return view('dosen.dashboard', compact('data', 'counter'));
    }
    public function mahasiswa()
    {
        $absensi['hadir'] = Absensi::where([
            ['mahasiswa_id',Auth::user()->id],
            ['status','h'],
        ])->get();
        $absensi['sakit'] = Absensi::where([
            ['mahasiswa_id',Auth::user()->id],
            ['status','s'],
        ])->get();
        $absensi['izin'] = Absensi::where([
            ['mahasiswa_id',Auth::user()->id],
            ['status','i'],
        ])->get();
        $absensi['alpa'] = Absensi::where([
            ['mahasiswa_id',Auth::user()->id],
            ['status','a'],
        ])->get();
        return view('mahasiswa.dashboard',compact('absensi'));
    }
}
