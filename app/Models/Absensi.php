<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function week()
    {
        return $this->belongsTo('App\Models\Week');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
}
