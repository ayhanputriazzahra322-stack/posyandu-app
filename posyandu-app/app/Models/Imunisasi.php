<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Anak;

class Imunisasi extends Model
{
    protected $table = 'imunisisasis';

    protected $fillable = [
        'anak_id',
        'tanggal',
        'jenis_imunisasi',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }
}