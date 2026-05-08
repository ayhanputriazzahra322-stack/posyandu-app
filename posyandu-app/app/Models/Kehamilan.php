<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehamilan extends Model
{
    // WAJIB karena kamu pakai plural manual
    protected $table = 'kehamilans';

    protected $fillable = [
        'ibu_id',
        'usia_kehamilan',
        'keterangan',
        'tanggal'
    ];

    // RELASI KE IBU
    public function ibu()
    {
        return $this->belongsTo(\App\Models\Ibu::class, 'ibu_id');
    }

    // AUTO FORMAT TANGGAL (BIAR RAPI)
    protected $casts = [
        'tanggal' => 'date'
    ];
}