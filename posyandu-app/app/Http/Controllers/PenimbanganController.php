<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penimbangan;
use App\Models\Anak;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PenimbanganController extends Controller
{
    public function index()
    {
        $data = Penimbangan::with('anak')->get();
        return view('penimbangan.index', compact('data'));
    }

    public function create()
    {
        $anak = Anak::all();
        return view('penimbangan.create', compact('anak'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'berat' => 'required|numeric',
            'tinggi' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        Penimbangan::create([
            'anak_id' => $request->anak_id,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('penimbangan.index')
            ->with('success', 'Data ditambah');
    }

    public function edit($id)
    {
        $data = Penimbangan::findOrFail($id);
        $anak = Anak::all();

        return view('penimbangan.edit', compact('data', 'anak'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'berat' => 'required|numeric',
            'tinggi' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        Penimbangan::findOrFail($id)->update([
            'anak_id' => $request->anak_id,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('penimbangan.index')
            ->with('success', 'Data diupdate');
    }

    public function destroy($id)
    {
        Penimbangan::findOrFail($id)->delete();

        return back()->with('success', 'Data dihapus');
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

        $data = Penimbangan::with('anak')
            ->where('anak_id', $request->anak_id)
            ->whereBetween('tanggal', [$bulanAwal, $bulanAkhir])
            ->orderBy('tanggal', 'asc')
            ->get();

        $pdf = Pdf::loadView('penimbangan.laporan_pdf', [
            'data' => $data,
            'anak' => $anak,
            'bulanAwal' => $bulanAwal,
            'bulanAkhir' => $bulanAkhir,
        ])->setPaper('A4', 'portrait');

        return $pdf->download('laporan-penimbangan-' . $anak->nama . '.pdf');
    }
}