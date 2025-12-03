<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Models\Kelas;
use App\Models\Week;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Jadwal;
use Carbon\Carbon;
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

    public function index_rekap($smt, $kls, $week)
    {
        $data['semester'] = Semester::findOrFail($smt);
        $data['kelas'] = Kelas::findOrFail($kls);
        $data['week'] = Week::findOrFail($week);

        $data['mahasiswa'] = User::with(['mahasiswa'])
            ->whereHas('mahasiswa', function ($q) use ($smt, $kls) {
                $q->where([
                    ['semester_id', $smt],
                    ['kelas_id', $kls],
                ]);
            })
            ->get();

        foreach ($data['mahasiswa'] as $mhs) {

            $totalKompensasi = 0;
            $totalAlpa = 0;
            $totalIzin = 0;
            $totalSakit = 0;

            // 🔁 loop minggu
            for ($i = 1; $i <= $week; $i++) {

                // ============================
                //      ALPA per minggu
                // ============================
                $absensiAlpa = Absensi::where('mahasiswa_id', $mhs->id)
                    ->where('week_id', $i)
                    ->where('status', 'a')
                    ->with(['jadwal.day'])
                    ->get();

                $groupedByDay = $absensiAlpa->groupBy(
                    fn($item) => optional($item->jadwal)->day_id
                );

                $kompenMinggu = 0;

                foreach ($groupedByDay as $alphas) {
                    $jumlahAlpha = $alphas->count();

                    if ($jumlahAlpha == 1) {
                        $kompenMinggu += 5;
                    } elseif ($jumlahAlpha >= 2 && $jumlahAlpha <= 7) {
                        $kompenMinggu += 8;
                    } elseif ($jumlahAlpha >= 8) {
                        $kompenMinggu += $jumlahAlpha * 2;
                    }
                }

                $totalKompensasi += $kompenMinggu;
                $totalAlpa += $absensiAlpa->count();


                // ============================
                //      IZIN per minggu
                // ============================
                $izinMinggu = Absensi::where('mahasiswa_id', $mhs->id)
                    ->where('week_id', $i)
                    ->where('status', 'i')
                    ->count();

                $totalIzin += $izinMinggu;


                // ============================
                //      SAKIT per minggu
                // ============================
                $sakitMinggu = Absensi::where('mahasiswa_id', $mhs->id)
                    ->where('week_id', $i)
                    ->where('status', 's')
                    ->count();

                $totalSakit += $sakitMinggu;
            }

            // Set nilai ke object
            $mhs->alpa = $totalAlpa;
            $mhs->izin = $totalIzin;
            $mhs->sakit = $totalSakit;
            $mhs->kompensasi = $totalKompensasi;

            // Hitung SP
            if ($totalAlpa >= 38) {
                $mhs->status_sp = 'SP 3';
            } elseif ($totalAlpa >= 32) {
                $mhs->status_sp = 'SP 2';
            } elseif ($totalAlpa >= 16) {
                $mhs->status_sp = 'SP 1';
            } else {
                $mhs->status_sp = '-';
            }
        }

        $pdf = PDF::loadView('admin.cetak.absensi', compact('data'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream();
    }


    // public function testCetak()
    // {
    //     $paper = array(0,0,950,1650);
    //     $pdf = PDF::loadView('admin.cetak.test')->setPaper($paper);
    //     return $pdf->stream();
    // }
    // public function testCetakSP(){
    //     $pdf = PDF::loadView('admin.cetak.testcetak')->setPaper('a4','portrait');
    //     return $pdf->stream();
    // }

    // GPT MODE ON Cetak Surat Peringatan

    public function cetakSp($mahasiswa_id)
    {
        $mahasiswa = Mahasiswa::with(['kelas', 'semester', 'user'])->where('user_id',$mahasiswa_id)->first();
        // return $mahasiswa;
        // Hitung total jam alpa
        $totalAlpa = Absensi::where('mahasiswa_id', $mahasiswa_id)
            ->where('status', 'a')
            ->count();

        // Ambil minggu terakhir dari absensi mahasiswa
        $latestWeek = Absensi::where('mahasiswa_id', $mahasiswa_id)
            ->with('week')
            ->latest('week_id')
            ->first();

        $mingguKe = $latestWeek ? $latestWeek->week->name : '-';

        // Tahun akademik (otomatis mengikuti tahun berjalan)
        $tahunSekarang = \Carbon\Carbon::now()->year;
        $bulanSekarang = \Carbon\Carbon::now()->month;
        $tahunAkademik = $bulanSekarang >= 7
            ? $tahunSekarang . '/' . ($tahunSekarang + 1)
            : ($tahunSekarang - 1) . '/' . $tahunSekarang;

        // Tentukan level SP berdasarkan total jam alpa
        if ($totalAlpa >= 46) {
            $spLevel = 'Drop Out';
            $spName = 'Surat Pemberhentian dari Politeknik';
            $pasal = 'Pasal 18 ayat 6 (huruf d)';
        } elseif ($totalAlpa > 38) {
            $spLevel = 'SP 3';
            $spName = 'Surat Peringatan Ketiga (SP-III)';
            $pasal = 'Pasal 18 ayat 6 (huruf c)';
        } elseif ($totalAlpa > 32) {
            $spLevel = 'SP 2';
            $spName = 'Surat Peringatan Kedua (SP-II)';
            $pasal = 'Pasal 18 ayat 6 (huruf b)';
        } elseif ($totalAlpa > 16) {
            $spLevel = 'SP 1';
            $spName = 'Surat Peringatan Pertama (SP-I)';
            $pasal = 'Pasal 18 ayat 6 (huruf a)';
        } else {
            return redirect()->back()->with('errors', 'Mahasiswa belum mencapai batas Surat Peringatan.');
        }

        // Buat PDF
        $pdf = \PDF::loadView('admin.cetak.cetak-sp', [
            'mahasiswa' => $mahasiswa,
            'totalAlpa' => $totalAlpa,
            'spLevel' => $spLevel,
            'spName' => $spName,
            'pasal' => $pasal,
            'mingguKe' => $mingguKe,
            'tahunAkademik' => $tahunAkademik,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream("Surat_Peringatan_{$mahasiswa->nama}_{$spLevel}.pdf");
    }

    public function cetakJadwal($id)
    {
        // Ambil semua jadwal dalam semester tersebut
        $jadwals = Jadwal::with([
            'kelas',
            'ruang',
            'dosen',
            'day',
            'matkul',
            'jam',
            'semester'
        ])
        ->where('semester_id', $id)
        ->orderBy('kelas_id')
        ->orderBy('day_id')
        ->orderBy('matkul_id')
        ->get();

        // Kirim ke view untuk DOMPDF
        $pdf = Pdf::loadView('admin.cetak.jadwal', [
            'jadwals' => $jadwals
        ]);

        return $pdf->stream('jadwal-semester.pdf');
    }


}
