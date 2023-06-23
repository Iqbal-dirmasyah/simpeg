<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use Illuminate\Http\Request;

class KeluargaController extends Controller
{
    public function index()
    {
        $keluarga = Keluarga::all();
        return view('keluarga.tampil', compact('keluarga'));
    }

    public function create()
    {
        return view('keluarga.create');
    }

    public function store(Request $request)
    {
        $keluarga = new keluarga;
        $keluarga-> nmstatusk = $request ->status;
        $keluarga-> save();

        return redirect ('keluarga')->with('success','Data berhasil disimpan');
    }

    public function edit(Keluarga $keluarga)
    {
        return view('keluarga.edit', compact('keluarga'));
    }

    public function update(Request $request, Keluarga $keluarga)
    {
        $keluarga-> nmstatusk = $request ->status;
        $keluarga-> save();

        return redirect ('keluarga')->with('success','Data berhasil disimpan');
    }
    
    public function destroy(Keluarga $keluarga)
    {
        $keluarga->delete();

        return redirect('keluarga')->with('error','Data berhasil dihapus');
    }
}
