<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;
    protected $table ='days';
    protected $guarded =[];

    public function jadwal()
    {
        return $this->hasMany('App\Models\Jadwal');
    }
}