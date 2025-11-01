<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\Week;
use App\Models\Mahasiswa;
use App\Models\Absensi;
use Auth;

class DosenController extends Controller
{
    public function profil()
    {
        $data = User::with('dosen')->where('id', Auth::user()->id)->first();
        // return $data;
        return view('dosen.profil',compact('data'));
    }

    public function update(Request $request)
    {
        $user = User::where('id',Auth::user()->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        if (isset($request->password)) {
            $user->password = bcrypt($request->password);
        } else {
            unset($user->password);
        }
        $user->save();

        $dosen = Dosen::where('user_id',$user->id)->first();
        $dosen->nip = $request->nip;
        $dosen->gender = $request->gender;
        $dosen->save();

        return redirect()->back()->with('success','Berhasil Mengubah Data');
    }

    public function jadwal($jadwal)
    {
        $jadwal = Jadwal::where('id',$jadwal)->with([
            'kelas', 'ruang', 'day', 'jam', 'matkul', 'semester',
        ])->first();
        $week = Week::all();
        return view('dosen.jadwal',compact('jadwal','week'));
    }

    public function index_absensi($jdw,$week)
    {
        $jadwal = Jadwal::where('id',$jdw)->with('jam')->first();
        $minggu = Week::where('id',$week)->first();
        $mahasiswa = Mahasiswa::with(['user.absensi' => function($q) use($jdw, $week) {
            $q->where('jadwal_id',$jdw);
            $q->where('week_id',$week);
        }])
        ->where([
            ['kelas_id', $jadwal->kelas_id],
            ['semester_id',$jadwal->semester->id],
        ])
        ->get();

        // return $mahasiswa;

        return view('dosen.absensi',compact('minggu','jadwal','mahasiswa'));
    }

    public function store_absensi(Request $request)
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
