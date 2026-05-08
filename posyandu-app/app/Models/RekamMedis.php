<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';

    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'tanggal',
        'keluhan',
        'diagnosa',
        'tindakan',
        'obat_id',
        'qty',
        'harga',
        'total',
        'metode',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function keuangan()
    {
        return $this->hasOne(Keuangan::class);
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    public function riwayatObat($id)
{
    $data = RekamMedis::with('pasien', 'dokter', 'obat')
        ->where('pasien_id', $id)
        ->get();

    $pasien = Pasien::findOrFail($id);

    return view('rekam_medis.riwayat_obat', compact('data', 'pasien'));
}
}