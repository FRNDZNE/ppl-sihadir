<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jam;
use Illuminate\Support\Facades\Validator;

class JamController extends Controller
{
    public function index(){
        // cek data table jam
        $jam = Jam::all();
        // return $data;
        return view ('admin.data.jam',compact('jam'));

    }
    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'awal' => 'required',
            'akhir' => 'required',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('errors','Masukan Data Terlebih Dahulu');
        }
        $data = $request->all();
        Jam::create($data);
        return redirect()->back()->with('success','Berhasil Menambah Data');
    }
    public function update(Request $request){
        $validate = Validator::make($request->all(), [
            'awal' => 'required',
            'akhir' => 'required',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('errors','Masukan Data Terlebih Dahulu');
        }
        $data = Jam::find($request->id);
        $data->update($request->all());
        return redirect()->back()->with('success','Berhasil Mengubah Data');
    }
    public function delete($id){
        Jam::find($id)->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data');
    }

}