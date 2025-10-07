<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Day;
use Illuminate\Support\Facades\Validator;

class DayController extends Controller
{
    public function index(){
        // cek data table day
        $day = Day::all();
        // return $data;
        return view ('admin.data.day',compact('day'));

    }
    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('errors','Masukan Data Terlebih Dahulu');
        }
        $data = $request->all();
        Day::create($data);
        return redirect()->back()->with('success','Berhasil Menambah Data');
    }
    public function update(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if($validate->fails()){
            return redirect()->back()->with('errors','Masukan Data Terlebih Dahulu');
        }
        $data= Day::where('id',$request->id)->first();

        $data->update([
            'name'=>$request->name,
        ]);
        return redirect()->back()->with('success','Berhasil Mengubah Data');
    }
    public function delete($id){
        Day::find($id)->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data');
    }
}