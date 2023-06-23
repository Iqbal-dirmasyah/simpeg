<?php

namespace App\Http\Controllers;

use App\Models\GolonganDarah;
use Illuminate\Http\Request;

class GolonganDarahController extends Controller
{
    public function index()
    {
        $darah = GolonganDarah::all();
        return view('darah.tampil', compact('darah'));
    }

    public function create()
    {
        return view('darah.create');
    }

    public function store(Request $request)
    {
        $darah = new GolonganDarah();
        $darah-> nama_gol_darah = $request ->nama_gol_darah;
        $darah-> save();

        return redirect ('darah')->with('success','Data berhasil disimpan');
    }

    public function edit($id)
    {
        $darah = GolonganDarah::find($id);
        return view('darah.edit', compact('darah'));
    }

    public function update(Request $request, GolonganDarah $golonganDarah)
    {
        $golonganDarah-> nama_gol_darah = $request ->nama_gol_darah;
        $golonganDarah-> save();

        return redirect ('darah')->with('success','Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $golonganDarah = GolonganDarah::find($id);
        $golonganDarah->delete();

        return redirect('darah')->with('error','Data berhasil dihapus');
    }
}
