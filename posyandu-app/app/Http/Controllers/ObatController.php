<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use Illuminate\Support\Facades\DB;
use App\Exports\LaporanObatExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ObatController extends Controller
{
    public function index()
    {
        $data = Obat::all();
        return view('obat.index', compact('data'));
    }

    public function create()
    {
        return view('obat.create');
    }

    public function store(Request $request)
    {
        Obat::create($request->all());

        return redirect()
            ->route('obat.index')
            ->with('success', 'Data ditambah');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('obat.edit', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        Obat::findOrFail($id)->update($request->all());

        return redirect()
            ->route('obat.index')
            ->with('success', 'Data diupdate');
    }

    public function destroy($id)
    {
        Obat::findOrFail($id)->delete();

        return back()
            ->with('success', 'Data dihapus');
    }

    public function laporan()
    {
        $data = DB::table('obats')
            ->leftJoin('rekam_medis', 'obats.id', '=', 'rekam_medis.obat_id')
            ->select(
                'obats.nama_obat as nama_obat',
                'obats.stok as stok',
                DB::raw('COALESCE(SUM(rekam_medis.qty), 0) as total_pakai')
            )
            ->groupBy('obats.id', 'obats.nama_obat', 'obats.stok')
            ->get();

        return view('obat.laporan', compact('data'));
    }

    public function exportExcel()
    {
        return Excel::download(new LaporanObatExport, 'laporan-obat.xlsx');
    }

    public function exportPdf()
    {
        $data = DB::table('obats')
            ->leftJoin('rekam_medis', 'obats.id', '=', 'rekam_medis.obat_id')
            ->select(
                'obats.nama_obat as nama_obat',
                'obats.stok as stok',
                DB::raw('COALESCE(SUM(rekam_medis.qty), 0) as total_pakai')
            )
            ->groupBy('obats.id', 'obats.nama_obat', 'obats.stok')
            ->get();

        $pdf = Pdf::loadView('obat.laporan_pdf', compact('data'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-obat.pdf');
    }
}