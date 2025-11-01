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

    // public function index_rekap($smt,$kls,$week)
    // {
    //     $data['semester'] = Semester::where('id',$smt)->first();
    //     $data['kelas'] = Kelas::where('id',$kls)->first();
    //     $data['week'] = Week::where('id',$week)->first();

    //     $data['mahasiswa'] = User::with(['mahasiswa'])->whereHas(
    //         'mahasiswa', function($q)use($smt,$kls){
    //             $q->where([
    //                 ['semester_id',$smt],
    //                 ['kelas_id',$kls],
    //             ]);
    //         }
    //     )->withCount([
    //         'absensi as sakit' => function($q)use($week){
    //             $q->where([
    //                 ['status','s'],
    //                 ['week_id',$week],
    //             ]);
    //         },
    //         'absensi as alpa' => function($q)use($week){
    //             $q->where([
    //                 ['status','a'],
    //                 ['week_id',$week],
    //             ]);
    //         },
    //         'absensi as izin' => function($q)use($week){
    //             $q->where([
    //                 ['status','i'],
    //                 ['week_id',$week],
    //             ]);
    //         }
    //     ])
    //     ->get();
    //     // return $data['mahasiswa'];

    //     $pdf = PDF::loadView('admin.cetak.absensi',compact('data'))->setPaper('a4','portrait');
    //     return $pdf->stream();
    // }

    // GPT core
    public function index_rekap($smt, $kls, $week)
    {
        $data['semester'] = Semester::where('id', $smt)->first();
        $data['kelas'] = Kelas::where('id', $kls)->first();
        $data['week'] = Week::where('id', $week)->first();

        // Ambil data mahasiswa dengan absensi alpha sampai minggu ke-n
        $data['mahasiswa'] = User::with(['mahasiswa'])
            ->whereHas('mahasiswa', function ($q) use ($smt, $kls) {
                $q->where([
                    ['semester_id', $smt],
                    ['kelas_id', $kls],
                ]);
            })
            ->with([
                'absensi' => function ($q) use ($week) {
                    $q->where('week_id', '<=', $week)
                    ->where('status', 'a')
                    ->with(['jadwal.day']); // penting: ambil day_id lewat jadwal
                }
            ])
            ->withCount([
                'absensi as sakit' => function ($q) use ($week) {
                    $q->where('status', 's')->where('week_id', '<=', $week);
                },
                'absensi as izin' => function ($q) use ($week) {
                    $q->where('status', 'i')->where('week_id', '<=', $week);
                },
                'absensi as alpa' => function ($q) use ($week) {
                    $q->where('status', 'a')->where('week_id', '<=', $week);
                },
            ])
            ->get();

        foreach ($data['mahasiswa'] as $mhs) {
            /** ===============================
             * 1️⃣ Hitung total kompensasi
             * =============================== */
            $totalKompensasi = 0;

            // Kelompokkan berdasarkan hari (via jadwal->day_id)
            $groupedByDay = $mhs->absensi->groupBy(function ($item) {
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

            $mhs->kompensasi = $totalKompensasi;

            /** ===============================
             * 2️⃣ Tentukan status SP
             * =============================== */
            $jamAlpa = $mhs->alpa;
            if ($jamAlpa >= 38) {
                $mhs->status_sp = 'SP 3';
            } elseif ($jamAlpa >= 32 && $jamAlpa <= 37) {
                $mhs->status_sp = 'SP 2';
            } elseif ($jamAlpa >= 16 && $jamAlpa <= 31) {
                $mhs->status_sp = 'SP 1';
            } else {
                $mhs->status_sp = '-';
            }
        }

        $pdf = PDF::loadView('admin.cetak.absensi', compact('data'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream();
    }



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
