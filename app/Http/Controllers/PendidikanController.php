<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pendidikan;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    public function index($id)
    {
        $pegawai = Pegawai::whereId($id)->with('pendidikan')->first();
        return  view('pendidikan.index', compact('pegawai'));
    }


    public function store(Request $request)
    {
        $pendidikan = new Pendidikan;
        $pendidikan-> t_pdk = $request ->t_pdk;
        $pendidikan-> d_pdk = $request ->d_pdk;
        $pendidikan-> pegawai_id = $request ->pegawai_id;
        $pendidikan-> save();

        return redirect ('/pegawai/'.$pendidikan->pegawai_id.'/pendidikan')->with('success','Data berhasil disimpan');
    }

    public function edit(Pendidikan $pendidikan)
    {
        return view('pendidikan.edit', compact('pendidikan'));
    }

    public function update(Request $request, Pendidikan $pendidikan)
    {
        // $pendidikan = \App\Pendidikan::findOrFail($id);
        $pendidikan-> t_pdk = $request ->t_pdk;
        $pendidikan-> d_pdk = $request ->d_pdk;
        $pendidikan-> pegawai_id = $request ->pegawai_id;
        $pendidikan-> save();

        return redirect ('/pegawai/'.$pendidikan->pegawai_id.'/pendidikan')->with('success','Data berhasil disimpan');
    }

    public function destroy(Pendidikan $pendidikan)
    {
        $pendidikan->delete();
        return back()->with('error','Data berhasil dihapus');
    }

    public function pel($id)
    {
        $pegawai = Pegawai::find($id);
        return view('pendidikan.create', ['pegawai' => $pegawai]);
    }
}
