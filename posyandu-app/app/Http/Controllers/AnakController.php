<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\Ibu;

class AnakController extends Controller
{
    public function index(){
        $data = Anak::with('ibu')->get();
        return view('anak.index', compact('data'));
    }

    public function create(){
        $ibu = Ibu::all();
        return view('anak.create', compact('ibu'));
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'ibu_id' => 'required',
            'tanggal_lahir' => 'required|date',
            'umur' => 'required|numeric',
            'jenis_kelamin' => 'required',
        ]);

        Anak::create([
            'nama' => $request->nama,
            'ibu_id' => $request->ibu_id,
            'tanggal_lahir' => $request->tanggal_lahir,
            'umur' => $request->umur,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('anak.index')->with('success','Data anak ditambah');
    }

    public function edit($id){
        $anak = Anak::findOrFail($id);
        $ibu = Ibu::all();
        return view('anak.edit', compact('anak','ibu'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'ibu_id' => 'required',
            'tanggal_lahir' => 'required|date',
            'umur' => 'required|numeric',
            'jenis_kelamin' => 'required',
        ]);

        $anak = Anak::findOrFail($id);

        $anak->update([
            'nama' => $request->nama,
            'ibu_id' => $request->ibu_id,
            'tanggal_lahir' => $request->tanggal_lahir,
            'umur' => $request->umur,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('anak.index')->with('success','Data diupdate');
    }

    public function destroy($id){
        Anak::findOrFail($id)->delete();
        return back()->with('success','Data dihapus');
    }
}