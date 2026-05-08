<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ibu;

class IbuController extends Controller
{
    public function index(){
        $data = Ibu::all();
        return view('ibu.index', compact('data'));
    }

    public function create(){
        return view('ibu.create');
    }

    public function store(Request $request){
        Ibu::create($request->all());
        return redirect()->route('ibu.index')->with('success','Data ibu ditambah');
    }

    public function edit($id){
        $data = Ibu::findOrFail($id);
        return view('ibu.edit', compact('data'));
    }

    public function update(Request $request, $id){
        Ibu::findOrFail($id)->update($request->all());
        return redirect()->route('ibu.index')->with('success','Data diupdate');
    }

    public function destroy($id){
        Ibu::findOrFail($id)->delete();
        return back()->with('success','Data dihapus');
    }
}