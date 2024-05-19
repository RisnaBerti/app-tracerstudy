<?php

namespace App\Http\Controllers\Bkk;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    //fungsi index
    public function index()
    {
        $kategori = Kategori::all();
        $title = 'Hapus Data!';
        $text = "Apakah Anda yakin ingin menghapus nya?";
        confirmDelete($title, $text);

        return view('bkk.kategori.view', [
            'title' => 'Data Kategori',
            'kategori' => $kategori
        ]);
    }

    //fungsi create
    public function create()
    {
        return view('bkk.kategori.create', [
            'title' => 'Data Kategori',
        ]);
    }

    //fungsi store
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'no_urut_tampil' => $request->no_urut_tampil,
        ]);

        return redirect()->route('kategori-store')->with('success', 'Data berhasil ditambahkan');
    }

    //fungsi edit
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('bkk.kategori.edit', [
            'title' => 'Data Kategori',
            'kategori' => $kategori,
        ]);
    }

    //fungsi update
    public function update(Request $request)
    {
        $id = $request->id_kategori;

        $request->validate([
            'nama_kategori' => 'required',
            'no_urut_tampil' => 'required',
        ]);

        Kategori::findOrFail($id)->update([
            'nama_kategori' => $request->nama_kategori,
            'no_urut_tampil' => $request->no_urut_tampil,
        ]);

        return redirect()->route('kategori')->with('success', 'Data berhasil diubah');
    }

    //fungsi destroy
    public function destroy($id)
    {
        Kategori::findOrFail($id)->delete();

        return redirect()->route('kategori')->with('success', 'Data berhasil dihapus');
    }
}
