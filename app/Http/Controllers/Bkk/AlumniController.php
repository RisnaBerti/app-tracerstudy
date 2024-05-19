<?php

namespace App\Http\Controllers\Bkk;

use App\Models\User;
use App\Models\Alumni;
use App\Models\TahunLulus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Validator;

class AlumniController extends Controller
{
    public function index()
    {
        $alumni = Alumni::with('tahun_lulus', 'jurusan')->get();

        $title = 'Hapus Data!';
        $text = "Apakah Anda yakin ingin menghapus nya?";
        confirmDelete($title, $text);

        return view('bkk.alumni.view', [
            'title' => 'Data Alumni',
            'alumni' => $alumni
        ]);
    }

    //fungsi create
    public function create()
    {
        $tahunLulus = TahunLulus::all();
        $jurusan = Jurusan::all();
        return view('bkk.alumni.create',  [
            'title' => 'Data Alumni',
            'action' => route('alumni-store'),
            'isCreated' => true,
            'tahunLulus' => $tahunLulus,
            'jurusan' => $jurusan,
        ]);
    }

    //fungsi store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nisn' => 'required|numeric|unique:users,username',
            'nama_alumni' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp_alumni' => 'required|numeric',
            'alamat_alumni' => 'required',
            'email_alumni' => 'required|email',
            'foto_alumni' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'id_tahun_lulus' => 'required|exists:tahun_lulus,id_tahun_lulus',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        // Buat user sesuai nisn tersebut
        $user = User::create([
            'username' => $request->nisn,
            'password' => bcrypt('123'), // Gunakan bcrypt untuk mengenkripsi password
            'id_role' => '2',
            'is_aktif' => '1'
        ]);

        // Untuk upload data foto
        $filename = null;
        if ($request->hasFile('foto_alumni')) {
            $file = $request->file('foto_alumni');
            $filename = $request->nisn . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/alumni'), $filename);
        }

        // Buat data alumni
        Alumni::create([
            'nisn' => $request->nisn,
            'nama_alumni' => $request->nama_alumni,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp_alumni' => $request->no_hp_alumni,
            'alamat_alumni' => $request->alamat_alumni,
            'email_alumni' => $request->email_alumni,
            'foto_alumni' => $filename, // Simpan nama file foto
            'user_id' =>  $user->id_user, // Ambil user_id dari user yang baru saja dibuat
            'id_tahun_lulus' =>  $request->id_tahun_lulus,
            'id_jurusan' => $request->id_jurusan,
            'id_kategori' => '1',
        ]);

        return redirect()->route('alumni')->with('success', 'Data Alumni Berhasil Ditambahkan');
    }

    //fungsi edit
    public function edit($id)
    {
        $alumni = Alumni::findOrFail($id);
        $tahunLulus = TahunLulus::all();
        $jurusan = Jurusan::all();

        return view('bkk.alumni.edit', [
            'title' => 'Data Alumni',
            'action' => route('alumni-update', $id),
            'isCreated' => false,
            'alumni' => $alumni,
            'tahunLulus' => $tahunLulus,
            'jurusan' => $jurusan,
        ]);
    }

    //fungsi update
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
            return back()->with('errors', $validator->messages()->all()[0])->withInput();
        }

        $alumni = Alumni::findOrFail($id);

        $data = $request->only(['nisn', 'nama_alumni', 'jenis_kelamin', 'no_hp_alumni', 'alamat_alumni', 'email_alumni', 'id_kategori', 'id_jurusan', 'id_tahun_lulus']);

        if ($request->hasFile('foto_alumni')) {
            // Hapus foto lama jika ada
            if ($alumni->foto_alumni && file_exists(public_path('uploads/alumni/' . $alumni->foto_alumni))) {
                unlink(public_path('uploads/alumni/' . $alumni->foto_alumni));
            }

            // Simpan foto baru
            $file = $request->file('foto_alumni');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/alumni'), $filename);

            $data['foto_alumni'] = $filename;
        }

        $alumni->update($data);

        return redirect()->route('alumni')->with('success', 'Data Alumni Berhasil Diubah');
    }

    public function destroy($id)
    {
        $alumni = Alumni::findOrFail($id);

        // Hapus foto dari server jika ada
        if ($alumni->foto_alumni && file_exists(public_path('uploads/alumni/' . $alumni->foto_alumni))) {
            unlink(public_path('uploads/alumni/' . $alumni->foto_alumni));
        }

        // Simpan user_id sebelum menghapus data alumni
        $user_id = $alumni->user_id;

        // Hapus data alumni
        $alumni->delete();

        // Hapus data user yang berelasi
        $user = User::find($user_id);
        if ($user) {
            $user->delete();
        }

        // Hapus data user yang berelasi
        // Hapus data user yang berelasi
        // if ($alumni->user) {
        //     $alumni->user->delete();
        // }

        // Hapus data alumni
        // $alumni->delete();

       
        return redirect()->route('alumni');


        // return view('bkk.alumni.view',
        //     ['title' => 'Data Alumni']);
    }
}
