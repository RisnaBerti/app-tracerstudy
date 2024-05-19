<?php

namespace App\Http\Controllers\Bkk;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class JurusanController extends Controller
{
    //fungsi index
    public function index()
    {
        $jurusan = Jurusan::all();
        
        $title = 'Hapus Data!';
        $text = "Apakah Anda yakin ingin menghapus nya?";
        confirmDelete($title, $text);

        return view('bkk.jurusan.view', [
            'title' => 'Data Jurusan',
            'jurusan' => $jurusan
        ]);
    }

    // Fungsi untuk menampilkan form penambahan jurusan baru
    public function create()
    {
        return view('bkk.jurusan.create', [
            'title' => 'Data Jurusan',
        ]);
    }

    // Fungsi untuk menyimpan jurusan baru ke dalam basis data
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jurusan' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->route('jurusan')->with('success', 'Data berhasil ditambahkan');
    }

    // Fungsi untuk menampilkan form edit jurusan
    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);

        // var_dump($jurusan->id_jurusan);
        // die();

        return view('bkk.jurusan.edit', [
            'title' => 'Data Jurusan',
            'jurusan' => $jurusan,
        ]);
    }

    // Fungsi untuk memperbarui data jurusan di basis data
    public function update(Request $request)
    {
        $id = $request->id_jurusan;

        $validator = Validator::make($request->all(), [
            'nama_jurusan' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $jurusan = Jurusan::findOrFail($id);
        $jurusan->update([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->route('jurusan')->with('success', 'Data berhasil diubah');
    }

    // Fungsi untuk menghapus jurusan dari basis data
    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        return redirect()->route('jurusan')->with('success', 'Data berhasil dihapus');
    }
}
