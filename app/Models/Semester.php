<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $table = 'semesters';
    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsToMany('App\Models\Mahasiswa');
    }

    public function matkul()
    {
        return $this->hasMany('App\Models\Matkul');
    }
    public function jadwal()
    {
        return $this->hasMany('App\Models\Jadwal');
    }
}
