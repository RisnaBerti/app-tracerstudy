<?php

namespace App\Http\Controllers;

use App\Models\Kuesioner;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use App\Models\OpsiPertanyaan;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;

class PertanyaanController extends Controller
{
    //fungsi index
    public function index()
    {

        
        $pertanyaan = Pertanyaan::with('kuesioner', 'jawaban', 'kategori')->get();
        $title = 'Hapus Data!';
        $text = "Apakah Anda yakin ingin menghapus nya?";
        confirmDelete($title, $text);
        return view(
            'bkk.pertanyaan.view',
            [
                'title' => 'Data Pertanyaan',
                'pertanyaan' => $pertanyaan,                
            ]
        );
    }

    //fungsi show
    public function show($id)
    {
        $pertanyaan = Pertanyaan::find($id);
        $opsi = OpsiPertanyaan::where('id_pertanyaan', $id)->get();

        return view('bkk.pertanyaan.show', compact('pertanyaan', 'opsi'));
    }

    //fungsi create
    public function create()
    {
        // get data kuesioner
        $kuesioner = Kuesioner::all();
        //get data kategori
        $kategori = Kategori::all();

        //retrun view
        return view('bkk.pertanyaan.create', compact('kuesioner', 'kategori'),
            ['title' => 'Data Pertanyaan']  
        );

    }

    //fungsi store
    public function store(Request $request)
    {
        $request->validate([
            'id_kuesioner' => 'required',
            'pertanyaan' => 'required',
            'tipe_pertanyaan' => 'required',
            'id_kategori' => 'required'
        ]);

        Pertanyaan::create([
            'id_kuesioner' => $request->id_kuesioner,
            'pertanyaan' => $request->pertanyaan,
            'tipe_pertanyaan' => $request->tipe_pertanyaan,
            'id_kategori' => $request->id_kategori
        ]);

        return redirect()->route('pertanyaan')->with('success', 'Data berhasil ditambahkan');
    }

    //fungsi edit
    public function edit($id)
    {
        $pertanyaan = Pertanyaan::with('kuesioner')->find($id);
        
        $kategori = Kategori::all();

        return view(
            'bkk.pertanyaan.edit',
            compact('pertanyaan', 'kategori'),
            ['title' => 'Data Pertanyaan']
        );
    }

    //fungsi update
    public function update(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'tipe_pertanyaan' => 'required',
            'id_kategori' => 'required'
        ]);
        
        $id = $request->id_pertanyaan;

        $pertanyaan = Pertanyaan::find($id);

        //notifikasi error validasi
        $messages = [
            'pertanyaan.required' => 'Pertanyaan wajib diisi',
            'tipe_pertanyaan.required' => 'Tipe Pertanyaan wajib diisi'
        ];

        //sweetalert error validasi
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required',
            'tipe_pertanyaan' => 'required',
            'id_kategori' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $pertanyaan->update([
            'pertanyaan' => $request->pertanyaan,
            'tipe_pertanyaan' => $request->tipe_pertanyaan,
            'id_kategori' => $request->id_kategori
        ]);


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
