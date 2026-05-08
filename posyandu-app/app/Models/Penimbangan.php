<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penimbangan extends Model
{
    protected $fillable = ['anak_id','berat','tinggi','tanggal'];

    public function anak(){
        return $this->belongsTo(Anak::class);
    }
}