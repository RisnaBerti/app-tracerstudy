<?php

namespace App\Http\Controllers;

use App\Models\Kuesioner;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KuesionerController extends Controller
{
    //fungsi index
    public function index()
    {
        $title = 'Hapus Data!';
        $text = "Apakah Anda yakin ingin menghapus nya?";
        confirmDelete($title, $text);
        
        return view(
            'admin.kuesioner.view',
            [   'title' => 'Data Kuesioner',
                'kuesioner' => Kuesioner::all()]
        );
    }

    //fungsi create
    public function create()
    {
        return view(
            'admin.kuesioner.create',
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
        ]);

        Kuesioner::create($request->all());

        return redirect()->route('kuesioner')->with('success', 'Data berhasil ditambahkan');
    }

    //fungsi show
    public function show($id)
    {
        $kuesioner = Kuesioner::find($id);
        $pertanyaan = Pertanyaan::where('id_kuesioner', $id)->with('opsiJawaban')->get();

        return view('admin.kuesioner.show', compact('kuesioner', 'pertanyaan'));
    }

    //fungsi edit
    public function edit($id)
    {
        $kuesioner = Kuesioner::find($id);

        return view(
            'admin.kuesioner.edit',
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
