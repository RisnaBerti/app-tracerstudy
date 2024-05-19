<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OpsiController extends Controller
{
    //fungsi index
    public function index()
    {
        //get data pertanyaan

        $title = 'Hapus Data!';
        $text = "Apakah Anda yakin ingin menghapus nya?";
        confirmDelete($title, $text);
        
        return view('admin.opsi.view', ['title' => 'Data Opsi']);
    }
}
