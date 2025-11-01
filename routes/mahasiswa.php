<?php
Route::middleware(['auth','role:mahasiswa'])->prefix('mahasiswa')->group(function(){
        // Show Dashboard
        Route::get('/dashboard',[App\Http\Controllers\DashboardController::class,'mahasiswa'])->name('mahasiswa.dashboard');
        Route::get('/profil',[App\Http\Controllers\Mahasiswa\MahasiswaController::class,'profil'])->name('mahasiswa.profil');
        Route::post('/profil/update',[App\Http\Controllers\Mahasiswa\MahasiswaController::class,'update'])->name('mahasiswa.update');
    });
