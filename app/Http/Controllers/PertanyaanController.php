<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PertanyaanController extends Controller
{
    //fungsi index
    public function index()
    {

        $title = 'Hapus Data!';
        $text = "Apakah Anda yakin ingin menghapus nya?";
        confirmDelete($title, $text);
        
        return view(
            'admin.pertanyaan.view',
            [
                'title' => 'Data Pertanyaan',
                'pertanyaan' => Pertanyaan::all()
            ]
        );
    }

    //fungsi create
    public function create()
    {
        return view('admin.pertanyaan.create');
    }

    //fungsi store
    public function store(Request $request)
    {
        $request->validate([
            'id_kuesioner' => 'required',
            'pertanyaan' => 'required',
            'tipe_pertanyaan' => 'required'
        ]);

        Pertanyaan::create([
            'id_kuesioner' => $request->id_kuesioner,
            'pertanyaan' => $request->pertanyaan,
            'tipe_pertanyaan' => $request->tipe_pertanyaan
        ]);

        return redirect()->route('pertanyaan')->with('success', 'Data berhasil ditambahkan');
    }

    //fungsi edit
    public function edit($id)
    {
        $pertanyaan = Pertanyaan::find($id);

        return view('admin.pertanyaan.edit', compact('pertanyaan'));
    }

    //fungsi update
    public function update(Request $request)
    {
        $request->validate([
            'id_kuesioner' => 'required',
            'pertanyaan' => 'required',
        ]);

        $pertanyaan = Pertanyaan::find($request->id_pertanyaan);
        $pertanyaan->update($request->all());

        return redirect()->route('pertanyaan')->with('success', 'Data berhasil diupdate');
    }

    //fungsi destroy
    public function destroy($id)
    {
        $pertanyaan = Pertanyaan::find($id);
        $pertanyaan->delete();

        return redirect()->route('pertanyaan')->with('success', 'Data berhasil dihapus');
    }
}
