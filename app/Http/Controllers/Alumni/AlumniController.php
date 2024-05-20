<?php

namespace App\Http\Controllers\Alumni;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AlumniController extends Controller
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

        return view('alumni.dashboard', [
            'title' => 'Dashboard',
            'alumni' => $total_alumni,
            'alumni_bekerja' => $alumni_bekerja,
            'alumni_belum_bekerja' => $alumni_belum_bekerja,
            'alumni_wirausaha' => $alumni_wirausaha,
            'alumni_kuliah' => $alumni_kuliah,
            'alumni_per_tahun' => $alumni_per_tahun, // Data total alumni per tahun
        ]);
    }

    //fungsii ganti profile
    public function edit($id)
    {
        $alumni = Alumni::findOrFail($id);
        $tahunLulus = TahunLulus::all();
        $jurusan = Jurusan::all();

        return view('humas.profil.edit', [
            'title' => 'Data Alumni',
            'action' => route('profil-update-humas', $id),
            'isCreated' => false,
            'alumni' => $alumni,
            'tahunLulus' => $tahunLulus,
            'jurusan' => $jurusan,
        ]);
    }

    //fungsi update profile
    public function update(Request $request)
    {
        $id = $request->nisn;
        $alumni = Alumni::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nisn' => [
                'required',
                'numeric',
                Rule::unique('users', 'username')->ignore($alumni->user_id, 'id_user')
            ],
            'nama_alumni' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp_alumni' => 'required|numeric',
            'alamat_alumni' => 'required',
            'email_alumni' => 'required|email',
            'id_tahun_lulus' => 'required|exists:tahun_lulus,id_tahun_lulus',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $alumni->update([
            'nisn' => $request->nisn,
            'nama_alumni' => $request->nama_alumni,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp_alumni' => $request->no_hp_alumni,
            'alamat_alumni' => $request->alamat_alumni,
            'email_alumni' => $request->email_alumni,
            'id_tahun_lulus' => $request->id_tahun_lulus,
            'id_jurusan' => $request->id_jurusan,
        ]);

        return redirect()->route('profil-humas', $id)->with('success', 'Data Alumni Berhasil Diubah');
    }

    //fungsi ganti password
    public function editPassword($id)
    {
        $alumni = Alumni::findOrFail($id);

        return view('humas.profil.edit-password', [
            'title' => 'Ganti Password',
            'action' => route('profil-update-password-humas', $id),
            'isCreated' => false,
            'alumni' => $alumni,
        ]);
    }

    //fungsi update password
    public function updatePassword(Request $request)
    {
        $id = $request->nisn;
        $alumni = Alumni::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $alumni->user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profil-humas', $id)->with('success', 'Password Berhasil Diubah');
    }
}
