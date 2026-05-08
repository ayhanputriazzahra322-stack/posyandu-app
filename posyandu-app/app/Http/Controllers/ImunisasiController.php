<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imunisasi;
use App\Models\Anak;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ImunisasiController extends Controller
{
    public function index()
    {
        $data = Imunisasi::with('anak')->get();
        return view('imunisasi.index', compact('data'));
    }

    public function create()
    {
        $anak = Anak::all();
        return view('imunisasi.create', compact('anak'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anak_id' => 'required',
            'tanggal' => 'required|date',
            'jenis_imunisasi' => 'required',
        ]);

        Imunisasi::create([
            'anak_id' => $request->anak_id,
            'tanggal' => $request->tanggal,
            'jenis_imunisasi' => $request->jenis_imunisasi,
        ]);

        return redirect()->route('imunisasi.index')->with('success', 'Data ditambah');
    }

    public function edit($id)
    {
        $data = Imunisasi::findOrFail($id);
        $anak = Anak::all();

        return view('imunisasi.edit', compact('data', 'anak'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'anak_id' => 'required',
            'tanggal' => 'required|date',
            'jenis_imunisasi' => 'required',
        ]);

        $data = Imunisasi::findOrFail($id);

        $data->update([
            'anak_id' => $request->anak_id,
            'tanggal' => $request->tanggal,
            'jenis_imunisasi' => $request->jenis_imunisasi,
        ]);

        return redirect()->route('imunisasi.index')->with('success', 'Data diupdate');
    }

    public function destroy($id)
    {
        Imunisasi::findOrFail($id)->delete();

        return redirect()->route('imunisasi.index')->with('success', 'Data dihapus');
    }

    public function laporanPdf(Request $request)
    {
        $request->validate([
            'anak_id' => 'required',
            'bulan_awal' => 'required',
            'bulan_akhir' => 'required',
        ]);

        $anak = Anak::findOrFail($request->anak_id);

        $bulanAwal = Carbon::parse($request->bulan_awal . '-01')->startOfMonth();
        $bulanAkhir = Carbon::parse($request->bulan_akhir . '-01')->endOfMonth();

        $data = Imunisasi::with('anak')
            ->where('anak_id', $request->anak_id)
            ->whereBetween('tanggal', [$bulanAwal, $bulanAkhir])
            ->orderBy('tanggal', 'asc')
            ->get();

        $pdf = Pdf::loadView('imunisasi.laporan_pdf', [
            'data' => $data,
            'anak' => $anak,
            'bulanAwal' => $bulanAwal,
            'bulanAkhir' => $bulanAkhir,
        ])->setPaper('A4', 'portrait');

        return $pdf->download('laporan-imunisasi-' . $anak->nama . '.pdf');
    }
}