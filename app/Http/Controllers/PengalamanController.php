<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pengalaman;
use Illuminate\Http\Request;

class PengalamanController extends Controller
{
    public function index($id)
    {
        $pegawai = Pegawai::find($id);        
        return  view('pengalaman.index', compact('pegawai'));
    }

    public function store(Request $request)
    {
        $pengalaman = new Pengalaman;
        $pengalaman-> nm_pekerjaan = $request ->nm_pekerjaan;
        $pengalaman-> d_pekerjaan = $request ->d_pekerjaan;
        $pengalaman-> pegawai_id = $request ->pegawai_id;
        $pengalaman-> save();

        return redirect ('/pegawai/'.$pengalaman->pegawai_id.'/pengalaman')->with('success','Data berhasil disimpan');
    }

    public function edit(Pengalaman $pengalaman)
    {
        return view('pengalaman.edit', compact('pengalaman'));
    }

    public function update(Request $request, Pengalaman $pengalaman)
    {
        $pengalaman-> nm_pekerjaan = $request ->nm_pekerjaan;
        $pengalaman-> d_pekerjaan = $request ->d_pekerjaan;
        $pengalaman-> pegawai_id = $request ->pegawai_id;
        $pengalaman-> save();

        return redirect ('/pegawai/'.$pengalaman->pegawai_id.'/pengalaman')->with('success','Data berhasil disimpan');
    }

    public function destroy(Pengalaman $pengalaman)
    {
        $pengalaman->delete();

        return back()->with('error','Data berhasil dihapus');
    }

    public function pel($id)
    {
        $pegawai = Pegawai::find($id);
        return view('pengalaman.create', ['pegawai' => $pegawai]);
    }
}
