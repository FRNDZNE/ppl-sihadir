<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function profile()
    {
        $data = User::where('id', auth()->user()->id)->first();
        return view('admin.profile', compact('data'));
    }

    public function update_admin(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $user->email = $request->email;
        if (isset($request->password)) {
            $user->password = bcrypt($request->password);
        } else {
            unset($user->password);
        }
        $user->save();

        return redirect()->back()->with('success', 'Berhasil Mengubah Data');
    }
}
