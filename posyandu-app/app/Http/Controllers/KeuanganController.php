<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keuangan;
use App\Models\RekamMedis;
use App\Exports\KeuanganExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class KeuanganController extends Controller
{
    public function index()
    {
        $rekam = RekamMedis::with('pasien')->get();
        $data = Keuangan::with('rekamMedis.pasien')->get();

        return view('keuangan.index', compact('rekam', 'data'));
    }

    public function store(Request $request)
    {
        $rekamMedis = RekamMedis::findOrFail($request->rekam_medis_id);

        $total = $request->metode == 'bpjs' ? 0 : $rekamMedis->total;

        Keuangan::create([
            'rekam_medis_id' => $request->rekam_medis_id,
            'metode' => $request->metode,
            'total_bayar' => $total,
        ]);

        return redirect()->route('keuangan.index')
            ->with('success', 'Pembayaran berhasil disimpan');
    }

    public function destroy($id)
    {
        Keuangan::findOrFail($id)->delete();
        return back();
    }

    public function exportExcel()
    {
        return Excel::download(new KeuanganExport, 'data-keuangan.xlsx');
    }

    public function exportPdf()
    {
        $data = Keuangan::with('rekamMedis.pasien')->get();

        $pdf = Pdf::loadView('keuangan.pdf', compact('data'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('data-keuangan.pdf');
    }
}