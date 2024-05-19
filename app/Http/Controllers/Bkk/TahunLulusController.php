<?php

namespace App\Http\Controllers\Bkk;

use App\Models\TahunLulus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TahunLulusController extends Controller
{
    //fungsi index
    public function index()
    {
        $tahunLulus = TahunLulus::all();
        $title = 'Hapus Data!';
        $text = "Apakah Anda yakin ingin menghapus nya?";
        confirmDelete($title, $text);
        
        return view('bkk.tahun-lulus.view', [
            'title' => 'Data Tahun Lulus',
            'tahunLulus' => $tahunLulus
        ]);
    }

    // Fungsi untuk menampilkan form penambahan tahun lulus baru
    public function create()
    {
        return view('bkk.tahun-lulus.create', [
            'title' => 'Data Tahun Lulus',
        ]);
    }

    //Fungsi Store
    public function store(Request $request)
    {
        $request->validate([
            'tahun_lulus' => 'required|unique:tahun_lulus,tahun_lulus',
        ]);

        TahunLulus::create([
            'tahun_lulus' => $request->tahun_lulus,
        ]);

        return redirect()->route('tahun-lulus-store')->with('success', 'Data berhasil ditambahkan');
    }

    // Fungsi untuk menampilkan form edit tahun_lulus
    public function edit($id)
    {
        $tahunLulus = TahunLulus::findOrFail($id);

        //    var_dump($tahunLulus->tahun_lulus);
        //    die();

        return view('bkk.tahun-lulus.edit', [
            'title' => 'Data Tahun Lulus',
            'tahunLulus' => $tahunLulus,
        ]);
    }

    // Fungsi untuk memperbarui data tahun_lulus di basis data
    public function update(Request $request)
    {
        $id = $request->id_tahun_lulus;

        $request->validate([
            'tahun_lulus' => 'required|unique:tahun_lulus,tahun_lulus',
        ]);

        $tahunLulus = TahunLulus::findOrFail($id);
        $tahunLulus->update([
            'tahun_lulus' => $request->tahun_lulus,
        ]);

        return redirect()->route('tahun-lulus')->with('success', 'Data berhasil diubah');
    }

    // Fungsi untuk menghapus tahun_lulus dari basis data
    public function destroy($id)
    {
        $tahun_lulus = TahunLulus::findOrFail($id);
        $tahun_lulus->delete();

        return redirect()->route('tahun-lulus')->with('success', 'Data berhasil dihapus');
    }
}
