<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    protected $fillable = ['rekam_medis_id','metode','total_bayar'];

    public function rekamMedis(){
        return $this->belongsTo(RekamMedis::class);
    }
}