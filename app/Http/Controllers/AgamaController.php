<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use Illuminate\Http\Request;

class AgamaController extends Controller
{
    
    public function index()
    {
        $agama = Agama::all();
        return view('agama.tampil', compact('agama'));
    }

    public function create()
    {
        return view('agama.create');
    }

    public function store(Request $request)
    {
        $agama = new Agama;
        $agama-> nmagama = $request ->nmagama;
        $agama-> save();

        return redirect('agama')->with('success','Data berhasil disimpan');
    }

    public function edit(Agama $agama)
    {
        return view('agama.edit', compact('agama'));
    }

    public function update(Request $request, Agama $agama)
    {
        $agama-> nmagama = $request ->nmagama;
        $agama-> save();

        return redirect ('agama')->with('success','Data berhasil disimpan');
    }

    public function destroy(Agama $agama)
    {
        $agama->delete();

        return redirect('agama')->with('error','Data berhasil dihapus');
    }
}
