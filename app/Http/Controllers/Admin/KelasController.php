<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller

{
    public function index()
    {
        $kelas = Kelas::all();
        return view('admin.data.kelas', compact('kelas'));

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
        Kelas::create($data);
        return redirect()->back()->with('success','Berhasil Menambah Data');
    }
    public function update(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('errors','Masukan Data Terlebih Dahulu');
        }
        $data = $request->all();
        $kelas = Kelas::find($request->id)->update($data);
        return redirect()->back()->with('success','Berhasil Mengubah Data');
    }
    
    public function delete($id)
    {
        Kelas::find($id)->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data');
    }
       
}