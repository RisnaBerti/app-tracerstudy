<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Jawaban;
use App\Models\Kuesioner;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KuesionerController extends Controller
{
    //fungsi index
    public function index()
    {
        $title = 'Hapus Data!';
        $text = "Apakah Anda yakin ingin menghapus nya?";
        confirmDelete($title, $text);

        return view(
            'bkk.kuesioner.view',
            [
                'title' => 'Data Kuesioner',
                'kuesioner' => Kuesioner::all()
            ]
        );
    }

    //fungsi create
    public function create()
    {
        return view(
            'bkk.kuesioner.create',
            ['title' => 'Data Kuesioner']
        );
    }

    //fungsi store
    public function store(Request $request)
    {
        $request->validate([
            'judul_kuesioner' => 'required',
            'deskripsi_kuesioner' => 'required',
            'tgl_kuesioner' => 'required',
            'tahun_lulus_awal' => 'required',
            'tahun_lulus_akhir' => 'required',
        ]);

        Kuesioner::create($request->all());

        return redirect()->route('kuesioner')->with('success', 'Data berhasil ditambahkan');
    }

    //fungsi show
    public function show($id)
    {
        $kuesioner = Kuesioner::with(['pertanyaan.opsiJawaban'])->findOrFail($id);
        //get data alumni
        $alumni = Alumni::find(Auth::user()->username);

        return view('bkk.kuesioner.show', compact('kuesioner', 
        'alumni'), ['title' => 'Data Kuesioner']);
    }

    //fungsi edit
    public function edit($id)
    {
        $kuesioner = Kuesioner::find($id);

        return view(
            'bkk.kuesioner.edit',
            compact('kuesioner'),
            ['title' => 'Data Kuesioner']

        );
    }

    //fungsi update
    public function update(Request $request)
    {
        $request->validate([
            'judul_kuesioner' => 'required',
            'deskripsi_kuesioner' => 'required',
            'tgl_kuesioner' => 'required',
            'tahun_lulus_awal' => 'required',
            'tahun_lulus_akhir' => 'required',
        ]);

        Kuesioner::find($request->id_kuesioner)->update($request->all());

        return redirect()->route('kuesioner')->with('success', 'Data berhasil diupdate');
    }

    //fungsi destroy
    public function destroy($id)
    {
        Kuesioner::find($id)->delete();

        return redirect()->route('kuesioner')->with('success', 'Data berhasil dihapus');
    }
}
