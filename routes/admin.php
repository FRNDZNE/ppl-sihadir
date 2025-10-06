<?php
    use App\Http\Controllers\Admin\DosenController;
    use App\Http\Controllers\Admin\MahasiswaController;
    use App\Http\Controllers\Admin\JamController;
    use App\Http\Controllers\Admin\RuanganController;
    use App\Http\Controllers\Admin\KelasController;
    use App\Http\Controllers\Admin\SemesterController;
    use App\Http\Controllers\Admin\AngkatanController;
    use App\Http\Controllers\Admin\DayController;
    use App\Http\Controllers\Admin\WeekController;
    use App\Http\Controllers\Admin\JadwalController;
    use App\Http\Controllers\Admin\MatkulController;
    use App\Http\Controllers\Admin\CetakController;
    use App\Http\Controllers\Admin\AbsensiController;




    Route::middleware(['auth','role:admin'])->prefix('admin')->group(function(){
        // Show Dashboard
        Route::get('/dashboard',[App\Http\Controllers\DashboardController::class,'admin'])->name('admin.dashboard');

        // Route CRUD DOSEN
        Route::prefix('dosen')->group(function(){
            Route::get('/',[DosenController::class,'index'])->name('admin.dosen.index');
            Route::get('/create',[DosenController::class,'create'])->name('admin.dosen.create');
            Route::post('/store',[DosenController::class,'store'])->name('admin.dosen.store');
            Route::get('/edit/{id}',[DosenController::class,'edit'])->name('admin.dosen.edit');
            Route::post('/update/{id}',[DosenController::class,'update'])->name('admin.dosen.update');
            Route::post('/delete/{id}',[DosenController::class,'delete'])->name('admin.dosen.delete');
        });

        // Route CRUD MAHASISWA
        Route::prefix('mahasiswa')->group(function(){
            Route::get('/',[MahasiswaController::class,'index'])->name('admin.mahasiswa.index');
            Route::get('/create',[MahasiswaController::class,'create'])->name('admin.mahasiswa.create');
            Route::post('/store',[MahasiswaController::class,'store'])->name('admin.mahasiswa.store');
            Route::get('/edit/{id}',[MahasiswaController::class,'edit'])->name('admin.mahasiswa.edit');
            Route::post('/update/{id}',[MahasiswaController::class,'update'])->name('admin.mahasiswa.update');
            Route::post('/delete/{id}',[MahasiswaController::class,'delete'])->name('admin.mahasiswa.delete');
        });

        // Route CRUD JAM
        Route::prefix('jam')->group(function(){
            Route::get('/',[JamController::class,'index'])->name('admin.jam.index');
            Route::post('/store',[JamController::class,'store'])->name('admin.jam.store');
            Route::post('/update',[JamController::class,'update'])->name('admin.jam.update');
            Route::post('/delete/{id}',[JamController::class,'delete'])->name('admin.jam.delete');
        });

        // Route CRUD RUANGAN
        Route::prefix('ruangan')->group(function(){
            Route::get('/',[RuanganController::class,'index'])->name('admin.ruangan.index');
            Route::post('/store',[RuanganController::class,'store'])->name('admin.ruangan.store');
            Route::post('/update',[RuanganController::class,'update'])->name('admin.ruangan.update');
            Route::post('/delete/{id}',[RuanganController::class,'delete'])->name('admin.ruangan.delete');
        });

        // Route CRUD KELAS
        Route::prefix('kelas')->group(function(){
            Route::get('/',[KelasController::class,'index'])->name('admin.kelas.index');
            Route::post('/store',[KelasController::class,'store'])->name('admin.kelas.store');
            Route::post('/update',[KelasController::class,'update'])->name('admin.kelas.update');
            Route::post('/delete/{id}',[KelasController::class,'delete'])->name('admin.kelas.delete');
        });

        // Route CRUD SEMESTER
        Route::prefix('semester')->group(function(){
            Route::get('/',[SemesterController::class,'index'])->name('admin.semester.index');
            Route::post('/store',[SemesterController::class,'store'])->name('admin.semester.store');
            Route::post('/update',[SemesterController::class,'update'])->name('admin.semester.update');
            Route::post('/delete/{id}',[SemesterController::class,'delete'])->name('admin.semester.delete');
        });

        // Route CRUD ANGKATAN
        Route::prefix('angkatan')->group(function(){
            Route::get('/',[AngkatanController::class,'index'])->name('admin.angkatan.index');
            Route::post('/store',[AngkatanController::class,'store'])->name('admin.angkatan.store');
            Route::post('/update',[AngkatanController::class,'update'])->name('admin.angkatan.update');
            Route::post('/delete/{id}',[AngkatanController::class,'delete'])->name('admin.angkatan.delete');
        });

        // Route CRUD DAY
        Route::prefix('day')->group(function(){
            Route::get('/',[DayController::class,'index'])->name('admin.day.index');
            Route::post('/store',[DayController::class,'store'])->name('admin.day.store');
            Route::post('/update',[DayController::class,'update'])->name('admin.day.update');
            Route::post('/delete/{id}',[DayController::class,'delete'])->name('admin.day.delete');
        });

        // Route CRUD Week
        Route::prefix('week')->group(function(){
            Route::get('/',[WeekController::class,'index'])->name('admin.week.index');
            Route::post('/store',[WeekController::class,'store'])->name('admin.week.store');
            Route::post('/update',[WeekController::class,'update'])->name('admin.week.update');
            Route::post('/delete/{id}',[WeekController::class,'destroy'])->name('admin.week.delete');
        });

        // Route Mata Kuliah
        Route::prefix('matkul')->group(function(){
            Route::get('/',[MatkulController::class,'index'])->name('admin.matkul.index');
            Route::get('/semester-{smt}',[MatkulController::class,'index_matkul'])->name('admin.matkul.smt.index');
            Route::post('/semester-{smt}/store',[MatkulController::class,'store'])->name('admin.matkul.smt.store');
            Route::post('/semester-{smt}/update',[MatkulController::class,'update'])->name('admin.matkul.smt.update');
            Route::post('/semester-{smt}/delete/{mk}',[MatkulController::class,'delete'])->name('admin.matkul.smt.delete');
        });

        // CRUD PENJADWALAN
        Route::prefix('penjadwalan')->group(function(){
            Route::get('/',[JadwalController::class,'index'])->name('admin.penjadwalan.index');
            Route::get('/{smt}',[JadwalController::class,'index_smt'])->name('admin.penjadwalan.semester.index');
            Route::get('/{smt}/{kls}',[JadwalController::class,'index_kls'])->name('admin.penjadwalan.kelas.index');
            // Penjadwalan based on Semester, Class and Day
            Route::get('/{smt}/{kls}/{day}',[JadwalController::class,'index_jadwal'])->name('admin.penjadwalan.hari.index');
            Route::post('/{smt}/{kls}/{day}/store',[JadwalController::class,'store_jadwal'])->name('admin.penjadwalan.hari.store');
            Route::post('/{smt}/{kls}/{day}/update',[JadwalController::class,'update_jadwal'])->name('admin.penjadwalan.hari.update');
            Route::post('/{smt}/{kls}/{day}/delete/{id}',[JadwalController::class,'delete_jadwal'])->name('admin.penjadwalan.hari.delete');
        });

        // Cetak Absensi
        Route::prefix('cetak')->group(function(){
            Route::get('/',[CetakController::class,'index'])->name('admin.cetak.index');
            Route::get('/{semester}',[CetakController::class,'index_kelas'])->name('admin.cetak.index.kelas');
            Route::get('/{semester}/{kelas}',[CetakController::class,'index_minggu'])->name('admin.cetak.index.minggu');
            Route::get('/{semester}/{kelas}/{minggu}',[CetakController::class,'index_rekap'])->name('admin.rekap');
        });

        Route::get('/test-cetak',[CetakController::class,'testCetak'])->name('cetak');
        Route::get('/test-cetak-sp',[CetakController::class,'testCetakSP'])->name('cetaksp');

        // Absensi Dari Halaman Admin
        Route::prefix('absensi')->group(function(){
            Route::get('/',[AbsensiController::class,'index'])->name('admin.absensi.index');
            Route::get('/{semester}',[AbsensiController::class,'indexKls'])->name('admin.absensi.kelas');
            Route::get('/{semester}/{kelas}',[AbsensiController::class,'indexJdw'])->name('admin.absensi.jadwal');
            Route::get('/{semester}/{kelas}/{jadwal}',[AbsensiController::class,'indexWeek'])->name('admin.absensi.minggu');
            Route::get('/{semester}/{kelas}/{jadwal}/{minggu}',[AbsensiController::class,'indexAbsensi'])->name('admin.absen');
            Route::post('/{semester}/{kelas}/{jadwal}/{minggu}/absen',[AbsensiController::class,'storeAbsensi'])->name('admin.absen.store');
        });

    });
