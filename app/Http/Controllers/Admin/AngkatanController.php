<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Angkatan;
use Illuminate\Support\Facades\Validator;

class AngkatanController extends Controller
{
    public function index()
    {
        $angkatan = Angkatan::all();
        return view('admin.data.angkatan', compact('angkatan'));

    }
    public function store(Request $request)
    {
        // Angkatan::create([
        //     'name' => $request->name,
        // ]);
        // return redirect()->back()->with('success','Berhasil Menambah Data');

        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('errors','Masukan Data Terlebih Dahulu');
        }
        $data = $request->all();
        Angkatan::create($data);
        return redirect()->back()->with('success','Berhasil Menambah Data');
    }
    public function update(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('errors','Masukan Data Terlebih Dahulu');
        }
        $data = Angkatan::find( $request->id );
        $data->name = $request->name;
        $data->save();
        return redirect()->back()->with('success','Berhasil Mengubah Data');
    }

    public function delete($id)
    {
        Angkatan::find($id)->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data');
    }
}