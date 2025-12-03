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
        // Hitung jumlah kelas
        $jumlahKelas = $data->pluck('kelas_id')->unique()->count();

        // Hitung jumlah mata kuliah
        $jumlahMataKuliah = $data->pluck('matkul_id')->unique()->count();
        // Count mahasiswa per kelas and semester;
        $counter = collect([]);
        if ($data->count() > 0) {
            $counter = Mahasiswa::select(['kelas_id', 'semester_id', DB::raw('count(*) as total')])
                ->whereIn('kelas_id', $data->pluck('kelas_id'))
                ->with('semester:id,name', 'kelas:id,name') // for debuging purpose, remove if not needed
                ->groupBy(['kelas_id', 'semester_id'])
                ->get();
        }

        return view('dosen.dashboard', compact('data', 'counter','jumlahKelas','jumlahMataKuliah'));
    }
    public function mahasiswa()
    {
        $userId = Auth::user()->id;

        $absensi['hadir'] = Absensi::where([
            ['mahasiswa_id', $userId],
            ['status', 'h'],
        ])->get();

        $absensi['sakit'] = Absensi::where([
            ['mahasiswa_id', $userId],
            ['status', 's'],
        ])->get();

        $absensi['izin'] = Absensi::where([
            ['mahasiswa_id', $userId],
            ['status', 'i'],
        ])->get();

        $absensi['alpa'] = Absensi::with(['jadwal.day'])
            ->where([
                ['mahasiswa_id', $userId],
                ['status', 'a'],
            ])
            ->get();

        // ===============================
        // 🔢 Hitung total kompensasi
        // ===============================
        $totalKompensasi = 0;

        // Kelompokkan alpa berdasarkan hari
        $groupedByDay = $absensi['alpa']->groupBy(function ($item) {
            return optional($item->jadwal)->day_id;
        });

        foreach ($groupedByDay as $dayId => $alphas) {
            $jumlahAlpha = $alphas->count();

            if ($jumlahAlpha == 1) {
                $kompensasi = 5;
            } elseif ($jumlahAlpha > 1 && $jumlahAlpha < 8) {
                $kompensasi = 8;
            } elseif ($jumlahAlpha >= 8) {
                $kompensasi = $jumlahAlpha * 2;
            } else {
                $kompensasi = 0;
            }

            $totalKompensasi += $kompensasi;
        }

        $absensi['total_kompensasi'] = $totalKompensasi;

        // ===============================
        // 📋 Hitung status SP
        // ===============================
        $jamAlpa = $absensi['alpa']->count();
        if ($jamAlpa >= 38) {
            $absensi['status_sp'] = 'SP 3';
        } elseif ($jamAlpa >= 32 && $jamAlpa <= 37) {
            $absensi['status_sp'] = 'SP 2';
        } elseif ($jamAlpa >= 16 && $jamAlpa <= 31) {
            $absensi['status_sp'] = 'SP 1';
        } else {
            $absensi['status_sp'] = '-';
        }

        return view('mahasiswa.dashboard', compact('absensi'));
    }

}
