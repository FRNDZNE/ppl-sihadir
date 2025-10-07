<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;
use Illuminate\Support\Facades\Validator;

class SemesterController extends Controller
{
    public function index()
    {
        $semester = Semester::all();
        return view('admin.data.semester', compact('semester'));

    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('errors','Masukan Data Terlebih Dahulu');
        }
        $data = $request->all();
        Semester::create($data);
        return redirect()->back()->with('success','Berhasil Menambah Data');
    }
    public function update(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('errors','Masukan Data Terlebih Dahulu');
        }
        $data = Semester::find( $request->id );
        $data->name = $request->name;
        $data->save();
        return redirect()->back()->with('success','Berhasil Mengubah Data');
    }
    
    public function delete($id)
    {
        Semester::find($id)->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data');
    }
}