<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    protected $fillable = ['ibu_id','nama','tanggal_lahir','jenis_kelamin'];

    public function ibu(){
        return $this->belongsTo(Ibu::class);
    }

    public function imunisasi(){
        return $this->hasMany(Imunisasi::class);
    }

    public function penimbangan(){
        return $this->hasMany(Penimbangan::class);
    }
}