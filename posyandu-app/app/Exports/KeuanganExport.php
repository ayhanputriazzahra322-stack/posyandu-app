<?php

namespace App\Exports;

use App\Models\Keuangan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KeuanganExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Keuangan::with('rekamMedis.pasien')
            ->get()
            ->map(function ($item, $index) {
                return [
                    'No' => $index + 1,
                    'Pasien' => $item->rekamMedis->pasien->nama ?? '-',
                    'Tanggal' => $item->rekamMedis->tanggal ?? '-',
                    'Metode' => strtoupper($item->metode),
                    'Total Bayar' => $item->total_bayar ?? 0,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'No',
            'Pasien',
            'Tanggal',
            'Metode',
            'Total Bayar',
        ];
    }
}