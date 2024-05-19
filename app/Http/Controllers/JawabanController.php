<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JawabanController extends Controller
{
    //fungsi index
    public function index()
    {
        $title = 'Hapus Data!';
        $text = "Apakah Anda yakin ingin menghapus nya?";
        confirmDelete($title, $text);
        
        return view('admin.jawaban.view');
    }

    //fungsi create
    public function create()
    {
        return view('admin.jawaban.create');
    }

    //fungsi store
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'id_pertanyaan' => 'required',
    //         'nisn' => 'required',
    //         'id_tahun_lulus' => 'required',
    //         'id_kategori' => 'required',
    //         'jawaban' => 'required',
    //     ]);

    //     Jawaban::create($request->all());

    //     return redirect()->route('jawaban')->with('success', 'Data berhasil ditambahkan');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'id_pertanyaan' => 'required|array',
            'id_pertanyaan.*' => 'exists:pertanyaan,id_pertanyaan',
            'jawaban' => 'required|array',
            'jawaban.*' => 'string|max:255',
            'nisn' => 'required|exists:alumni,nisn',
            'id_tahun_lulus' => 'required|exists:tahun_lulus,id_tahun_lulus',
            'id_kategori' => 'required|exists:kategori,id_kategori',
        ]);

        $idPertanyaan = $request->input('id_pertanyaan');
        $jawabanList = $request->input('jawaban');
        $nisn = $request->input('nisn');
        $idTahunLulus = $request->input('id_tahun_lulus');
        $idKategori = $request->input('id_kategori');

        foreach ($idPertanyaan as $index => $idPertanyaanValue) {
            Jawaban::create([
                'id_pertanyaan' => $idPertanyaanValue,
                'nisn' => $nisn,
                'id_tahun_lulus' => $idTahunLulus,
                'id_kategori' => $idKategori,
                'jawaban' => $jawabanList[$index],
            ]);
        }

        return redirect()->back()->with('success', 'Jawaban berhasil disimpan');
    }
}
