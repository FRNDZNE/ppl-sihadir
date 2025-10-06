<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswas';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function angkatan()
    {
        return $this->belongsTo('App\Models\Angkatan');
    }
    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas');
    }
    public function semester()
    {
        return $this->belongsTo('App\Models\Semester');
    }


}
