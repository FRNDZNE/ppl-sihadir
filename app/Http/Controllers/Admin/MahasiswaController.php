<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\Angkatan;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data = User::with('mahasiswa')->whereHas('mahasiswa')->get();
        return view('admin.mahasiswa.index',compact('data'));
    }

    public function create()
    {
        $data['kelas'] = Kelas::all();
        $data['angkatan'] = Angkatan::all();
        $data['semester'] = Semester::all();
        return view('admin.mahasiswa.create',compact('data'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email'=> 'required',
            'password'=> 'required',
            'nim'=> 'required',
            'kelas'=> 'required',
            'angkatan'=> 'required',
            'semester'=> 'required',
            'gender'=> 'required',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('errors','Masukan Data Terlebih Dahulu');
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $mhs = new Mahasiswa;
        $mhs->user_id = $user->id;
        $mhs->nim = $request->nim;
        $mhs->kelas_id = $request->kelas;
        $mhs->angkatan_id = $request->angkatan;
        $mhs->semester_id = $request->semester;
        $mhs->gender = $request->gender;
        $mhs->save();

        $role = Role::where('name','mahasiswa')->first();
        $user->addRole($role);
        return redirect()->route('admin.mahasiswa.index')->with('success','Berhasil Menambah Data');
    }

    public function edit($id)
    {
        $data['user'] = User::where('id',$id)->with('mahasiswa')->first();
        $data['kelas'] = Kelas::all();
        $data['angkatan'] = Angkatan::all();
        $data['semester'] = Semester::all();
        return view('admin.mahasiswa.edit',compact('data'));

    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email'=> 'required',
            'nim'=> 'required',
            'kelas'=> 'required',
            'angkatan'=> 'required',
            'semester'=> 'required',
            'gender'=> 'required',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('errors','Masukan Data Terlebih Dahulu');
        }
        $user = User::where('id',$id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        if (isset($request->password)) {
            $user->password = bcrypt($request->password);
        } else {
            unset($user->password);
        }
        $user->save();

        $mhs = Mahasiswa::where('user_id',$id)->first();
        $mhs->nim = $request->nim;
        $mhs->kelas_id = $request->kelas;
        $mhs->angkatan_id = $request->angkatan;
        $mhs->semester_id = $request->semester;
        $mhs->gender = $request->gender;
        $mhs->save();

        return redirect()->route('admin.mahasiswa.index')->with('success','Berhasil Mengubah Data');

    }

    public function delete($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data');
    }
}