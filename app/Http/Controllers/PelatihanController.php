<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pelatihan;
use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    public function index($id)
    {
        $pegawai = Pegawai::whereId($id)->with('pelatihan')->first();
        // dd($pegawai);
        return view('pelatihan.index', compact('pegawai'));
    }

    public function pel($id)
    {
        $pegawai = Pegawai::find($id);
        return view('pelatihan.create', ['pegawai' => $pegawai]);
    }

    public function store(Request $request)
    {
        $pelatihan = new Pelatihan();
        $pelatihan-> tgl_pelatihan = $request ->tgl_pelatihan;
        $pelatihan-> topik_pelatihan = $request ->topik_pelatihan;
        $pelatihan-> pegawai_id = $request ->pegawai_id;
        $pelatihan-> save();

        return redirect('/pegawai/'.$pelatihan->pegawai_id.'/pelatihan')->with('success', 'Data berhasil disimpan');

    }

    public function edit(Pelatihan $pelatihan)
    {
        //
        
        // $pelatihan = Pelatihan::find($id);
        return view('pelatihan.edit', compact('pelatihan'));
    }

    public function update(Request $request, Pelatihan $pelatihan)
    {
        $pelatihan-> tgl_pelatihan = $request ->tgl_pelatihan;
        $pelatihan-> topik_pelatihan = $request ->topik_pelatihan;
        $pelatihan-> pegawai_id = $request ->pegawai_id;
        $pelatihan-> save();

        return redirect('/pegawai/'.$pelatihan->pegawai_id.'/pelatihan')->with('success', 'Data berhasil disimpan');
    
    }

    public function destroy(Pelatihan $pelatihan)
    {
        $pelatihan->delete();
        return back()->with('error', 'Data berhasil dihapus');
    }
}
