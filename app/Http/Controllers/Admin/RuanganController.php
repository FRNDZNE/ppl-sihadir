<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ruang;
use Illuminate\Support\Facades\Validator;

class RuanganController extends Controller
{
    public function index(){
        $data = Ruang::all();
        // return $data;

        return view('admin.data.ruang', compact('data'));
    }
    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('errors','Masukan Data Terlebih Dahulu');
        }
        $data = $request->all();
        Ruang::create($data);
        return redirect()->back()->with('success','Berhasil Menambah Data');
    }
    public function update(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('errors','Masukan Data Terlebih Dahulu');
        }
        $data = Ruang::find($request->id);

        $data->update([
            'name' => $request->name,
        ]);
        return redirect()->back()->with('success','Berhasil Mengubah Data');
    }
    public function delete($id){
        
        Ruang::find($id)->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data');
    }
}