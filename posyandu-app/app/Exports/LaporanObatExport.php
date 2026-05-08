<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanObatExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DB::table('obats')
            ->leftJoin('rekam_medis', 'obats.id', '=', 'rekam_medis.obat_id')
            ->select(
                'obats.nama_obat',
                DB::raw('COALESCE(SUM(rekam_medis.qty), 0) as total_pakai'),
                'obats.stok'
            )
            ->groupBy('obats.id', 'obats.nama_obat', 'obats.stok')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama Obat',
            'Total Dipakai',
            'Stok Saat Ini',
        ];
    }
}