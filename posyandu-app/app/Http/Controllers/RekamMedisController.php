<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekamMedis;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Obat;

class RekamMedisController extends Controller
{
    public function index()
    {
        $data = RekamMedis::with('pasien', 'dokter', 'obat')->get();
        return view('rekam_medis.index', compact('data'));
    }

    public function create()
    {
        $pasien = Pasien::all();
        $dokter = Dokter::all();
        $obat = Obat::all();

        return view('rekam_medis.create', compact('pasien', 'dokter', 'obat'));
    }

    public function store(Request $request)
    {
        $obat = Obat::findOrFail($request->obat_id);

        if ($obat->stok < $request->qty) {
            return back()->with('error', 'Stok obat tidak mencukupi');
        }

        $harga = $obat->harga;
        $total = $request->metode == 'bpjs' ? 0 : $harga * $request->qty;

        RekamMedis::create([
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'tanggal' => $request->tanggal,
            'keluhan' => $request->keluhan,
            'diagnosa' => $request->diagnosa,
            'tindakan' => $request->tindakan,
            'obat_id' => $request->obat_id,
            'qty' => $request->qty,
            'harga' => $harga,
            'total' => $total,
            'metode' => $request->metode,
        ]);

        $obat->decrement('stok', $request->qty);

        return redirect()
            ->route('rekam-medis.index')
            ->with('success', 'Data rekam medis berhasil disimpan');
    }

    public function edit($id)
    {
        $data = RekamMedis::findOrFail($id);
        $pasien = Pasien::all();
        $dokter = Dokter::all();
        $obat = Obat::all();

        return view('rekam_medis.edit', compact('data', 'pasien', 'dokter', 'obat'));
    }

    public function update(Request $request, $id)
    {
        $rekam = RekamMedis::findOrFail($id);

        $obatLama = Obat::findOrFail($rekam->obat_id);
        $obatBaru = Obat::findOrFail($request->obat_id);

        $obatLama->increment('stok', $rekam->qty);

        if ($obatBaru->stok < $request->qty) {
            $obatLama->decrement('stok', $rekam->qty);

            return back()->with('error', 'Stok obat tidak mencukupi');
        }

        $harga = $obatBaru->harga;
        $total = $request->metode == 'bpjs' ? 0 : $harga * $request->qty;

        $rekam->update([
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'tanggal' => $request->tanggal,
            'keluhan' => $request->keluhan,
            'diagnosa' => $request->diagnosa,
            'tindakan' => $request->tindakan,
            'obat_id' => $request->obat_id,
            'qty' => $request->qty,
            'harga' => $harga,
            'total' => $total,
            'metode' => $request->metode,
        ]);

        $obatBaru->decrement('stok', $request->qty);

        return redirect()
            ->route('rekam-medis.index')
            ->with('success', 'Data rekam medis berhasil diupdate');
    }

    public function destroy($id)
    {
        $rekam = RekamMedis::findOrFail($id);

        if ($rekam->obat_id) {
            $obat = Obat::find($rekam->obat_id);

            if ($obat) {
                $obat->increment('stok', $rekam->qty);
            }
        }

        $rekam->delete();

        return back()->with('success', 'Data rekam medis berhasil dihapus');
    }

    public function riwayatObat($id)
    {
        $pasien = Pasien::findOrFail($id);

        $data = RekamMedis::with('pasien', 'dokter', 'obat')
            ->where('pasien_id', $id)
            ->get();

        return view('pasien.riwayat_obat', compact('data', 'pasien'));
    }
}