<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\User;
use Auth;

class MahasiswaController extends Controller
{
    public function profil()
    {
        $data = User::with('mahasiswa')->where('id', Auth::user()->id)->first();
        return view('mahasiswa.profil',compact('data'));
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

        $mahasiswa = Mahasiswa::where('user_id',$user->id)->first();
        $mahasiswa->gender = $request->gender;
        $mahasiswa->save();

        return redirect()->back()->with('success','Berhasil Mengubah Data');
    }
}
