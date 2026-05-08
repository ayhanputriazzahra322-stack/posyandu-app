<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
   protected $fillable = [
    'nama',
    'nik',
    'tanggal_lahir',
    'jenis_kelamin',
    'alamat',
];

    public function rekamMedis(){
        return $this->hasMany(RekamMedis::class);
    }
}