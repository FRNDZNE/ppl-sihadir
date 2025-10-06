<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    use HasFactory;
    protected $table ='angkatans';
    protected $guarded =[];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Models\Mahasiswa');
    }
}
