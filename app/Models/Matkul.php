<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;
    protected $table = 'matkuls';
    protected $guarded = [];

    public function semester()
    {
        return $this->belongsTo('App\Models\Semester');
    }

    public function jadwal()
    {
        return $this->hasMany('App\Models\Jadwal');
    }
}
