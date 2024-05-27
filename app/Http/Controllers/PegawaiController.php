<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();

        $title = 'Hapus Data!';
        $text = "Apakah Anda yakin ingin menghapus nya?";
        confirmDelete($title, $text);

        return view('humas.pegawai.view', [
            'title' => 'Data Pegawai',
            'pegawai' => $pegawai
        ]);
    }

    //fungsi create
    public function create()
    {
        return view('humas.pegawai.create', [
            'title' => 'Data Pegawai',
            'action' => route('pegawai-store'),
            'isCreated' => true,
        ]);
    }

    //fungsi store
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|numeric|unique:users,username',
            'nama_pegawai' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp_pegawai' => 'required|numeric',
            'alamat_pegawai' => 'required',
            'email_pegawai' => 'required|email',
            'foto_pegawai' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Buat user sesuai nip tersebut
        $user = User::create([
            'username' => $request->nip,
            'password' => bcrypt('123'), // Gunakan bcrypt untuk mengenkripsi password
            'id_role' => $request->id_role,
            'is_aktif' => '1'
        ]);

        // Untuk upload data foto
        $filename = null;
        if ($request->hasFile('foto_pegawai')) {
            $file = $request->file('foto_pegawai');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pegawai'), $filename);
        }

        // Buat data pegawai
        Pegawai::create([
            'nip' => $request->nip,
            'nama_pegawai' => $request->nama_pegawai,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp_pegawai' => $request->no_hp_pegawai,
            'alamat_pegawai' => $request->alamat_pegawai,
            'email_pegawai' => $request->email_pegawai,
            'foto_pegawai' => $filename, // Simpan nama file foto
            'jabatan' => '-',
            'id_user' =>  $user->id_user, // Ambil user_id dari user yang baru saja dibuat
        ]);

        return redirect()->route('pegawai')->with('success', 'Data Pegawai Berhasil Ditambahkan');
    }

    //fungsi edit
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        return view('humas.pegawai.edit', [
            'title' => 'Data Pegawai',
            'action' => route('pegawai-update', $id),
            'isCreated' => false,
            'pegawai' => $pegawai,
        ]);
    }

    //fungsi update
    public function update(Request $request)
    {
        $id = $request->nip;
        $pegawai = Pegawai::findOrFail($id);
        $request->validate([
            'nip' => [
                'required',
                'numeric',
                Rule::unique('users', 'username')->ignore($pegawai->id_user, 'id_user')
            ],
            'nama_pegawai' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp_pegawai' => 'required|numeric',
            'alamat_pegawai' => 'required',
            'email_pegawai' => 'required|email',
            'foto_pegawai' => 'image|mimes:jpeg,png,jpg|max:2048', // tidak required untuk update
        ]);

        $pegawai = Pegawai::findOrFail($id);

        $data = $request->only(['nip', 'nama_pegawai', 'jenis_kelamin', 'no_hp_pegawai', 'alamat_pegawai', 'email_pegawai']);

        if ($request->hasFile('foto_pegawai')) {
            // Hapus foto lama jika ada
            if ($pegawai->foto_pegawai && file_exists(public_path('uploads/pegawai/' . $pegawai->foto_pegawai))) {
                unlink(public_path('uploads/pegawai/' . $pegawai->foto_pegawai));
            }

            // Simpan foto baru
            $file = $request->file('foto_pegawai');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pegawai'), $filename);

            $data['foto_pegawai'] = $filename;
        }

        $pegawai->update($data);

        return redirect()->route('pegawai')->with('success', 'Data Pegawai Berhasil Diubah');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        // Hapus foto dari server jika ada
        if ($pegawai->foto_pegawai && file_exists(public_path('uploads/pegawai/' . $pegawai->foto_pegawai))) {
            unlink(public_path('uploads/pegawai/' . $pegawai->foto_pegawai));
        }

        // Hapus data user yang berelasi
        $user = User::find($pegawai->user_id);
        if ($user) {
            $user->delete();
        }

        // Hapus data pegawai
        $pegawai->delete();

        return redirect()->route('pegawai')->with('success', 'Data Pegawai Berhasil Dihapus');
    }
}
