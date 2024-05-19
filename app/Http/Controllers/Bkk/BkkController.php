<?php

namespace App\Http\Controllers\Bkk;

use App\Models\Alumni;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BkkController extends Controller
{
   //fungsi index dashboard
   public function index()
   {
       // Mengambil data alumni dan menghitung berdasarkan id_kategori dan id_tahun_lulus
       $alumni_counts = Alumni::select('id_kategori', 'id_tahun_lulus', DB::raw('count(*) as total'))
           ->groupBy('id_kategori', 'id_tahun_lulus')
           ->get();

       // Menghitung total alumni
       $total_alumni = Alumni::count();

       // Menghitung jumlah alumni per kategori
       $alumni_per_kategori = $alumni_counts->groupBy('id_kategori');

       $alumni_bekerja = $alumni_per_kategori->get(1) ? $alumni_per_kategori->get(1)->sum('total') : 0;
       $alumni_belum_bekerja = $alumni_per_kategori->get(2) ? $alumni_per_kategori->get(2)->sum('total') : 0;
       $alumni_wirausaha = $alumni_per_kategori->get(3) ? $alumni_per_kategori->get(3)->sum('total') : 0;
       $alumni_kuliah = $alumni_per_kategori->get(4) ? $alumni_per_kategori->get(4)->sum('total') : 0;

       // Menghitung jumlah alumni per tahun lulus
       $alumni_per_tahun = Alumni::join('tahun_lulus', 'alumni.id_tahun_lulus', '=', 'tahun_lulus.id_tahun_lulus')
           ->select('tahun_lulus.tahun_lulus', DB::raw('count(*) as total'))
           ->groupBy('tahun_lulus.tahun_lulus')
           ->get()
           ->pluck('total', 'tahun_lulus');

       return view('bkk.dashboard', [
           'title' => 'Dashboard',
           'alumni' => $total_alumni,
           'alumni_bekerja' => $alumni_bekerja,
           'alumni_belum_bekerja' => $alumni_belum_bekerja,
           'alumni_wirausaha' => $alumni_wirausaha,
           'alumni_kuliah' => $alumni_kuliah,
           'alumni_per_tahun' => $alumni_per_tahun, // Data total alumni per tahun
       ]);
   }
}
    
