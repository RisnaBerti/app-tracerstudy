<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use App\Models\OpsiPertanyaan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OpsiController extends Controller
{
    //fungsi index
    public function index()
    {
        //get data pertanyaan

        $title = 'Hapus Data!';
        $text = "Apakah Anda yakin ingin menghapus nya?";
        confirmDelete($title, $text);

        $opsi = OpsiPertanyaan::with('pertanyaan')->get();

        return view('bkk.opsi.view', [
            'title' => 'Data Opsi',
            'opsi' => $opsi
        ]);
    }

    //fungsi create
    public function create()
    {
        //get data pertanyaan yang berelasi dengan tabel kuesioner
        $pertanyaan = Pertanyaan::with('kuesioner')->get();

        return view('bkk.opsi.create', ['title' => 'Data Opsi', 'pertanyaan' => $pertanyaan]);
    }

    //fungsi store
    public function store(Request $request)
    {

        //validator
        $validator = Validator::make($request->all(), [
            'id_pertanyaan' => 'required',
            'opsi' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        OpsiPertanyaan::create($request->all());

        return redirect()->route('opsi')->with('success', 'Data berhasil ditambahkan');
    }

    //fungsi edit
    public function edit($id)
    {
        // Dapatkan data opsi pertanyaan berdasarkan ID
        // $opsi = OpsiPertanyaan::with('pertanyaan')->findOrFail($id);
        // Dapatkan semua data pertanyaan
        // $pertanyaan = Pertanyaan::all();

        // $qry = "SELECT p.id_pertanyaan, p.pertanyaan, o.id_opsi, o.opsi
        // FROM pertanyaan p
        // INNER JOIN opsi_jawaban o ON o.id_pertanyaan = p.id_pertanyaan";

        // $opsi = DB::select($qry);

        // Dapatkan data opsi pertanyaan berdasarkan ID
        $opsi = OpsiPertanyaan::findOrFail($id);
        // Dapatkan semua data pertanyaan
        $pertanyaan = Pertanyaan::all();

        return view('bkk.opsi.edit', [
            'title' => 'Data Opsi',
            'opsi' => $opsi,
            'pertanyaan' => $pertanyaan
        ]);
    }

    //fungsi update
    public function update(Request $request)
    {
        $request->validate([
            'id_pertanyaan' => 'required',
            'opsi' => 'required',
        ]);
    
        $id = $request->id_opsi;
        $opsi = OpsiPertanyaan::findOrFail($id);
    
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_pertanyaan' => 'required',
            'opsi' => 'required'
        ]);
    
        // Jika validasi gagal, kembali dengan pesan error
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
    
        // Update data opsi pertanyaan
        $opsi->update([
            'id_pertanyaan' => $request->id_pertanyaan,
            'opsi' => $request->opsi
        ]);
    
        // Redirect ke halaman opsi dengan pesan sukses
        return redirect()->route('opsi')->with('success', 'Data berhasil diubah');
    }
    

    //fungsi destroy
    public function destroy($id)
    {
        $opsi = OpsiPertanyaan::findOrFail($id);
        $opsi->delete();

        return redirect()->route('opsi')->with('success', 'Data berhasil dihapus');
    }
}
