<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::all();
        return view('pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
        ]);

        Pasien::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('pasien.index')->with('success', 'Data berhasil ditambah');
    }

    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
        ]);

        $pasien = Pasien::findOrFail($id);

        $pasien->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('pasien.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Data berhasil dihapus');
    }

    public function riwayatObat($id)
    {
        $pasien = Pasien::findOrFail($id);

        $data = DB::table('rekam_medis')
            ->join('obat_rekam_medis', 'rekam_medis.id', '=', 'obat_rekam_medis.rekam_medis_id')
            ->join('obats', 'obats.id', '=', 'obat_rekam_medis.obat_id')
            ->where('rekam_medis.pasien_id', $id)
            ->select(
                'obats.nama_obat',
                'obat_rekam_medis.qty',
                'obat_rekam_medis.harga',
                'rekam_medis.tanggal'
            )
            ->orderBy('rekam_medis.tanggal', 'desc')
            ->get();

        return view('pasien.riwayat_obat', compact('data', 'pasien'));
    }
}