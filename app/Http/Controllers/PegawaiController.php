<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\GolonganDarah;
use App\Models\Keluarga;
use App\Models\Negara;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::orderBy('nama','asc');
        if (request()->nama) {
            $pegawai = $pegawai->where('nama','like','%'.request()->nama.'%');
        }
        $limit = 10;
        if (request()->limit) {
            $limit = request()->limit;
        }
        $pegawai = $pegawai->paginate($limit);
        return view('pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        $data['agama'] = Agama::all();
        $data['negara'] = Negara::all();
        $data['darah'] = GolonganDarah::all();
        $data['keluarga'] = Keluarga::all();
        return view('pegawai.create_edit', $data);
    }

    public function store(Request $request)
    {
        $pegawai = new Pegawai;
        $pegawai->nip = $request ->nip;
        $pegawai->nama = $request ->nama;
        $pegawai->tmpt_lahir = $request ->tmpt_lahir;
        $pegawai->tgl_lahir = $request ->tgl_lahir;
        $pegawai->jenis_kelamin = $request ->jenis_kelamin;
        $pegawai->agama_id = $request ->agama_id;
        $pegawai->negara_id = $request ->negara_id;
        $pegawai->gol_darah_id = $request ->gol_darah_id;
        $pegawai->skeluarga_id = $request ->skeluarga_id;
        $pegawai->alamat = $request ->alamat;        
        $pegawai->foto = $request ->foto;
        $pegawai->nohp = $request ->nohp;        
        $pegawai->save();

        return redirect('pegawai')->with('success', 'Data berhasil disimpan');
    }

    public function show(Pegawai $pegawai)
    {
        return view ('pegawai.show', compact('pegawai'));
    }

    public function edit(Pegawai $pegawai)
    {
        $data['pegawai'] = $pegawai;
        $data['agama'] = Agama::all();
        $data['negara'] = Negara::all();
        $data['darah'] = GolonganDarah::all();
        $data['keluarga'] = Keluarga::all();
        return view('pegawai.create_edit', $data);
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $pegawai->nip = $request ->nip;
        $pegawai->nama = $request ->nama;
        $pegawai->tmpt_lahir = $request ->tmpt_lahir;
        $pegawai->tgl_lahir = $request ->tgl_lahir;
        $pegawai->jenis_kelamin = $request ->jenis_kelamin;
        $pegawai->agama_id = $request ->agama_id;
        $pegawai->negara_id = $request ->negara_id;
        $pegawai->gol_darah_id = $request ->gol_darah_id;
        $pegawai->skeluarga_id = $request ->skeluarga_id;
        $pegawai->alamat = $request ->alamat;        
        $path = $request->file('foto');
        $name_file = $path->hashName();
        $path = Storage::putFileAs(
            'public/foto', $request->file('foto'), $name_file
        );
        $pegawai->foto = $name_file;
        $pegawai->nohp = $request ->nohp;        
        $pegawai->save();

        return redirect('pegawai')->with('success', 'Data berhasil disimpan');
    }

    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        return back()->with('error', 'Data berhasil dihapus');
    }
    
    public function pdf()
    {
        $pegawai=Pegawai::all();
        $pdf = PDF::loadView('pegawai.pdf', ['pegawai'=>$pegawai]);
        return $pdf->download('pegawai.pdf');
    }
}
