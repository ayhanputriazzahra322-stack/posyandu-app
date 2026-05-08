<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kehamilan;
use App\Models\Ibu;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class KehamilanController extends Controller
{
    // TAMPIL DATA
    public function index()
    {
        $data = Kehamilan::with('ibu')->get();
        return view('kehamilan.index', compact('data'));
    }

    // FORM TAMBAH
    public function create()
    {
        $ibu = Ibu::all();
        return view('kehamilan.create', compact('ibu'));
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        Kehamilan::create([
            'ibu_id' => $request->ibu_id,
            'usia_kehamilan' => $request->usia_kehamilan,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal
        ]);

        return redirect()->route('kehamilan.index')
            ->with('success','Data kehamilan berhasil ditambah');
    }

    // FORM EDIT
    public function edit($id)
    {
        $data = Kehamilan::findOrFail($id);
        $ibu = Ibu::all();

        return view('kehamilan.edit', compact('data','ibu'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $data = Kehamilan::findOrFail($id);

        $data->update([
            'ibu_id' => $request->ibu_id,
            'usia_kehamilan' => $request->usia_kehamilan,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal
        ]);

        return redirect()->route('kehamilan.index')
            ->with('success','Data kehamilan berhasil diupdate');
    }

    // HAPUS
    public function destroy($id)
    {
        Kehamilan::findOrFail($id)->delete();

        return redirect()->route('kehamilan.index')
            ->with('success','Data kehamilan berhasil dihapus');
    }

    // CETAK LAPORAN PDF KEHAMILAN
    public function laporanPdf(Request $request)
    {
        $request->validate([
            'ibu_id' => 'required',
            'bulan_awal' => 'required',
            'bulan_akhir' => 'required',
        ]);

        $ibu = Ibu::findOrFail($request->ibu_id);

        $bulanAwal = Carbon::parse($request->bulan_awal . '-01')->startOfMonth();
        $bulanAkhir = Carbon::parse($request->bulan_akhir . '-01')->endOfMonth();

        $data = Kehamilan::with('ibu')
            ->where('ibu_id', $request->ibu_id)
            ->whereBetween('tanggal', [$bulanAwal, $bulanAkhir])
            ->orderBy('tanggal', 'asc')
            ->get();

        $pdf = Pdf::loadView('kehamilan.laporan_pdf', [
            'data' => $data,
            'ibu' => $ibu,
            'bulanAwal' => $bulanAwal,
            'bulanAkhir' => $bulanAkhir,
        ])->setPaper('A4', 'portrait');

        return $pdf->download('laporan-kehamilan-' . $ibu->nama . '.pdf');
    }
}