<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matkul;
use App\Models\Semester;
use Illuminate\Support\Facades\Validator;

class MatkulController extends Controller
{
    public function index()
    {
        $semester = Semester::all();
        return view('admin.matkul.semester',compact('semester'));
    }

    public function index_matkul($smt)
    {
        $semester = Semester::where('id',$smt)->first();
        $matkul = Matkul::where('semester_id',$smt)->get();
        return view('admin.matkul.matkul')->with([
            'semester' => $semester,
            'matkul' => $matkul,
        ]);
    }

    public function store(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('errors','Masukan Data Terlebih Dahulu');
        }
        $semester = Semester::where('id',$id)->first();
        $matkul = new Matkul;
        $matkul->semester_id = $semester->id;
        $matkul->name = $request->name;
        $matkul->save();
        return redirect()->back()->with('success','Berhasil Menambah Data');
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('errors','Masukan Data Terlebih Dahulu');
        }
        $semester = Semester::where('id',$id)->first();
        $matkul = Matkul::where('semester_id',$id)->first();
        $matkul->name = $request->name;
        $matkul->save();
        return redirect()->back()->with('success','Berhasil Mengubah Data');
    }

    public function delete($id,$mk)
    {
        Matkul::where('id',$mk)->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data');
    }
}