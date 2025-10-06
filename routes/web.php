<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home',function(){
    
    if (Auth::user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }else if (Auth::user()->hasRole('dosen')) {
        return redirect()->route('dosen.dashboard');
    }else if(Auth::user()->hasRole('mahasiswa')){
        return redirect()->route('mahasiswa.dashboard');
    }

    
})->middleware('auth');
@include('admin.php');
@include('dosen.php');
@include('mahasiswa.php');
