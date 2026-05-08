<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;

class DokterController extends Controller
{
    public function index(){
        $data = Dokter::all();
        return view('dokter.index', compact('data'));
    }

    public function create(){
        return view('dokter.create');
    }

    public function store(Request $request){
        Dokter::create($request->all());
        return redirect()->route('dokter.index')->with('success','Data ditambah');
    }

    public function edit($id){
        $data = Dokter::findOrFail($id);
        return view('dokter.edit', compact('data'));
    }

    public function update(Request $request, $id){
        Dokter::findOrFail($id)->update($request->all());
        return redirect()->route('dokter.index')->with('success','Data diupdate');
    }

    public function destroy($id){
        Dokter::findOrFail($id)->delete();
        return back()->with('success','Data dihapus');
    }
}