<?php

namespace App\Http\Controllers\Bkk;

use App\Models\Alumni;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BkkController extends Controller
{
    //fungsi index
    public function index()
    {
    //count alumni
    $alumni = Alumni::count();

    //count alumni where kategori bekerja
    $alumni_bekerja = Alumni::where('id_kategori', '1')->count();
    //count alumni where kategori belum bekerja
    $alumni_belum_bekerja = Alumni::where('id_kategori', '2')->count();
    //count alumni where id_kategori wirausaha
    $alumni_wirausaha = Alumni::where('id_kategori', '3')->count();
    //count alumni where id_kategori kuliah
    $alumni_kuliah = Alumni::where('id_kategori', '4')->count();

    return view(
        'bkk.dashboard',
        [
            'title' => 'Dashboard Admin',
            'alumni' => $alumni,
            'alumni_bekerja' => $alumni_bekerja,
            'alumni_belum_bekerja' => $alumni_belum_bekerja,
            'alumni_wirausaha' => $alumni_wirausaha,
            'alumni_kuliah' => $alumni_kuliah

        ]
    );
}
    
}
