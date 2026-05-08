<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ibu extends Model
{
    protected $fillable = ['nama','alamat','no_hp'];

    public function anak(){
        return $this->hasMany(Anak::class);
    }

    public function kehamilan(){
        return $this->hasMany(Kehamilan::class);
    }
}