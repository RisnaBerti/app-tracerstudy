<?php

namespace App\Http\Controllers\Humas;

use App\Models\User;
use App\Models\Alumni;
use App\Models\Jurusan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HumasController extends Controller
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

        //alumni count id_kategori "Bekerja"
        $alumni_bekerja = $alumni_counts->where('id_kategori', 1)->sum('total');

        //alumni count id_kategori "Belum Bekerja"
        $alumni_belum_bekerja = $alumni_counts->where('id_kategori', 2)->sum('total');

        //alumni count id_kategori "Wirausaha"
        $alumni_wirausaha = $alumni_counts->where('id_kategori', 4)->sum('total');

        //alumni count id_kategori "Kuliah"
        $alumni_kuliah = $alumni_counts->where('id_kategori', 3)->sum('total');

        // Menghitung jumlah alumni per kategori
        // $alumni_per_kategori = $alumni_counts->groupBy('id_kategori');

        // $alumni_bekerja = $alumni_per_kategori->get(1) ? $alumni_per_kategori->get(1)->sum('total') : 0;
        // $alumni_belum_bekerja = $alumni_per_kategori->get(2) ? $alumni_per_kategori->get(2)->sum('total') : 0;
        // $alumni_wirausaha = $alumni_per_kategori->get(3) ? $alumni_per_kategori->get(3)->sum('total') : 0;
        // $alumni_kuliah = $alumni_per_kategori->get(4) ? $alumni_per_kategori->get(4)->sum('total') : 0;

        // Menghitung jumlah alumni per tahun lulus
        $alumni_per_tahun = Alumni::join('tahun_lulus', 'alumni.id_tahun_lulus', '=', 'tahun_lulus.id_tahun_lulus')
            ->select('tahun_lulus.tahun_lulus', DB::raw('count(*) as total'))
            ->groupBy('tahun_lulus.tahun_lulus')
            ->get()
            ->pluck('total', 'tahun_lulus');

        return view('humas.dashboard', [
            'title' => 'Dashboard',
            'alumni' => $total_alumni,
            'alumni_bekerja' => $alumni_bekerja,
            'alumni_belum_bekerja' => $alumni_belum_bekerja,
            'alumni_wirausaha' => $alumni_wirausaha,
            'alumni_kuliah' => $alumni_kuliah,
            'alumni_per_tahun' => $alumni_per_tahun, // Data total alumni per tahun
        ]);
    }

    //fungsi melihat data jurusan
    public function jurusan()
    {
        // Ambil semua data jurusan beserta data terkaitnya
        $data = Alumni::with('jurusan', 'tahun_lulus')->get();

        return view('humas.jurusan.view', [
            'title' => 'Data Jurusan',
            'data' => $data
        ]);
    }

    //fungsi melihat data alumni
    public function alumni()
    {
        $alumni = Alumni::with('tahun_lulus', 'jurusan')->get();
        return view('humas.alumni.view', [
            'title' => 'Data Alumni',
            'alumni' => $alumni
        ]);
    }


    public function gantiPassword(Request $request)
    {
        // Validasi input
        $rules = [
            'passwordLama' => 'required',
            'passwordBaru' => 'required|between:8,16',
            'konfirmasiPasswordBaru' => 'required|same:passwordBaru'
        ];

        $customMessages = [
            'passwordLama.required' => 'Password lama wajib diisi!',
            'passwordBaru.required' => 'Password baru wajib diisi!',
            'passwordBaru.between' => 'Password harus terdiri dari 8 sampai dengan 16 karakter!',
            'konfirmasiPasswordBaru.required' => 'Konfirmasi password harus diisi!',
            'konfirmasiPasswordBaru.same' => 'Konfirmasi password tidak cocok dengan password baru!',
        ];

        $this->validate($request, $rules, $customMessages);

        // Cek apakah password lama sesuai
        if (!Hash::check($request->passwordLama, Auth::user()->password)) {
            return back()->with("error", "Password lama yang dimasukkan salah!");
        } else {
            // Update password baru
            User::where('id_user', Auth::user()->id_user)->update([
                'password' => bcrypt($request->passwordBaru)
            ]);

            return redirect()->back()->with("success", "Password berhasil diganti");
        }
    }

    //fungsii ganti profile
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        return view('humas.profil.edit', [
            'title' => 'Data Profil',
            // 'action' => route('profil-update-humas', $id),
            // 'isCreated' => false,
            'pegawai' => $pegawai,
        ]);
    }

    //fungsi update profile
    public function update(Request $request)
    {
        $id = $request->nip;
        $pegawai = Pegawai::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nip' => [
                'required',
                'numeric',
                Rule::unique('users', 'username')->ignore($pegawai->id_user, 'id_user')
            ],
            'nama_pegawai' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp_pegawai' => 'required|numeric',
            'alamat_pegawai' => 'required',
            'email_pegawai' => 'required|email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //edit foto_pegawai
        // if ($request->hasFile('foto_pegawai')) {
        //     $file = $request->file('foto_pegawai');
        //     $filename = $request->nip . '.' . $file->getClientOriginalExtension();
        //     $file->move('uploads/pegawai/', $filename);
        //     $pegawai->foto_pegawai = $filename;
        // }

        $data = $request->only(['nip', 'nama_pegawai', 'jenis_kelamin', 'no_hp_pegawai', 'alamat_pegawai', 'email_pegawai']);

        if ($request->hasFile('foto_pegawai')) {
            // Hapus foto lama jika ada
            if ($pegawai->foto_pegawai && file_exists(public_path('uploads/pegawai/' . $pegawai->foto_pegawai))) {
                unlink(public_path('uploads/pegawai/' . $pegawai->foto_pegawai));
            }

            // Simpan foto baru
            $file = $request->file('foto_pegawai');
            $filename = $request->nip . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pegawai'), $filename);

            $data['foto_pegawai'] = $filename;
        }

        $pegawai->update($data);


        // $pegawai->update([
        //     'nisn' => $request->nisn,
        //     'nama_pegawai' => $request->nama_pegawai,
        //     'jenis_kelamin' => $request->jenis_kelamin,
        //     'no_hp_pegawai' => $request->no_hp_pegawai,
        //     'alamat_pegawai' => $request->alamat_pegawai,
        //     'email_pegawai' => $request->email_pegawai
        // ]);

        return redirect()->route('profil-humas', $id)->with('success', 'Data Profil Berhasil Diubah');
    }
}
