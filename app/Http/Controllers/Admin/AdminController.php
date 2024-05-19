<?php

namespace App\Http\Controllers\Admin;

use App\Models\Alumni;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
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
            'admin.dashboard',
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
