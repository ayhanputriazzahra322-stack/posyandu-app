<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obats'; // 🔥 ini penting
    protected $fillable = ['nama_obat','stok','harga'];
    
    public function rekamMedis()
    {
        return $this->belongsToMany(\App\Models\RekamMedis::class, 'obat_rekam_medis')
            ->withPivot('qty','harga')
            ->withTimestamps();
    }
}