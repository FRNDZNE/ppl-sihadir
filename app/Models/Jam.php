<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    use HasFactory;
    protected $table ='jams';
    protected $guarded =[];

    public function jadwal()
    {
        return $this->belongsToMany('App\Models\Jadwal');
    }
}
