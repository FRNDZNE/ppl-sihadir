<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwals';
    protected $guarded = [];

    public function dosen()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas');
    }
    public function semester()
    {
        return $this->belongsTo('App\Models\Semester');
    }
    public function ruang()
    {
        return $this->belongsTo('App\Models\Ruang');
    }
    public function day()
    {
        return $this->belongsTo('App\Models\Day');
    }
    public function matkul()
    {
        return $this->belongsTo('App\Models\Matkul');
    }

    public function jam()
    {
        return $this->belongsToMany('App\Models\Jam');
    }

}
