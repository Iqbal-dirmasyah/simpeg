<?php

namespace App\Http\Controllers;

use App\Models\Negara;
use Illuminate\Http\Request;

class NegaraController extends Controller
{
    public function index()
    {
        $negara = Negara::all();
        return view('negara.tampil', compact('negara'));
    }

    public function create()
    {
        return view('negara.create');
    }

    public function store(Request $request)
    {
        $negara = new Negara;
        $negara-> nm_negara = $request ->nm_negara;
        $negara-> save();

        return redirect ('negara')->with('success','Data berhasil disimpan');
    }

    public function edit(Negara $negara)
    {
        return view('negara.edit', compact('negara'));
    }

    public function update(Request $request, Negara $negara)
    {
        $negara-> nm_negara = $request ->nm_negara;
        $negara-> save();

        return redirect ('negara')->with('success','Data berhasil disimpan');
    }

    public function destroy(Negara $negara)
    {
        $negara->delete();

        return redirect('negara')->with('error','Data berhasil dihapus');
    }
}
