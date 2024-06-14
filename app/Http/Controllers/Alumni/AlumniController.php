<?php

namespace App\Http\Controllers\Alumni;

use App\Models\User;
use App\Models\Alumni;
use App\Models\Jawaban;
use App\Models\Jurusan;
use App\Models\Kategori;
use App\Models\Kuesioner;
use App\Models\TahunLulus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Pertanyaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

        // $alumni_bekerja = $alumni_per_kategori->get(2) ? $alumni_per_kategori->get(2)->sum('total') : 0;
        // $alumni_belum_bekerja = $alumni_per_kategori->get(1) ? $alumni_per_kategori->get(1)->sum('total') : 0;
        // $alumni_wirausaha = $alumni_per_kategori->get(3) ? $alumni_per_kategori->get(3)->sum('total') : 0;
        // $alumni_kuliah = $alumni_per_kategori->get(4) ? $alumni_per_kategori->get(4)->sum('total') : 0;

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

        $jurusan = Jurusan::all();
        $tahun = TahunLulus::all();
        return view(
            'alumni.profil.edit',
            compact('alumni', 'jurusan', 'tahun'),
            ['title' => 'Edit Profil']
        );
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
                Rule::unique('users', 'username')->ignore($alumni->id_user, 'id_user')
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

        $data = $request->only([
            'nisn',
            'nama_alumni',
            'jenis_kelamin',
            'no_hp_alumni',
            'alamat_alumni',
            'email_alumni',
            'id_tahun_lulus',
            'id_jurusan'
        ]);

        if ($request->hasFile('foto_alumni')) {
            // Hapus foto lama jika ada
            if ($alumni->foto_alumni && file_exists(public_path('uploads/alumni/' . $alumni->foto_alumni))) {
                unlink(public_path('uploads/alumni/' . $alumni->foto_alumni));
            }

            // Simpan foto baru
            $file = $request->file('foto_alumni');
            $filename = $request->nisn . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/alumni'), $filename);

            $data['foto_alumni'] = $filename;
        }

        $alumni->update($data);


        // $alumni->update([
        //     'nisn' => $request->nisn,
        //     'nama_alumni' => $request->nama_alumni,
        //     'jenis_kelamin' => $request->jenis_kelamin,
        //     'no_hp_alumni' => $request->no_hp_alumni,
        //     'alamat_alumni' => $request->alamat_alumni,
        //     'email_alumni' => $request->email_alumni,
        //     'id_tahun_lulus' => $request->id_tahun_lulus,
        //     'id_jurusan' => $request->id_jurusan,
        // ]);

        return redirect()->route('profil-alumni', $id)->with('success', 'Data Alumni Berhasil Diubah');
    }

    //fungsi update password
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

    //fungsi viewKuesioner
    // public function viewKuesioner()
    // {

    //     //ambil tahun lulus alumni dari tabel alumni yang berelasi dengan tabel user, dengan kondisi data user sedang login
    //     $tahun_lulus = Alumni::where('nisn', Auth::user()->username)->first()->tahun_lulus->tahun_lulus;

    //     //get data kuesioner berdasarkan tahun lulus rentang 5tahun sekali
    //     $kuesioner = Kuesioner::where('tahun_lulus_awal', '<=', $tahun_lulus)
    //         ->where('tahun_lulus_akhir', '>=', $tahun_lulus)
    //         ->get();

    //     // Get user ID
    //     $userId = Auth::user()->username;
    //     // Add submission status to each kuesioner item
    //     foreach ($kuesioner as $item) {
    //         $item->isSubmitted = Jawaban::where('nisn', $userId)
    //                                        ->where('id_kuesioner', $item->id_kuesioner)
    //                                        ->exists();
    //     }

    //     return view('alumni.kuesioner.view', [
    //         'title' => 'Data Kuesioner',
    //         'kuesioner' => $kuesioner
    //     ]);
    // }
    public function viewKuesioner()
    {
        // Get the alumni data for the logged-in user
        $tahun_lulus = Alumni::where('nisn', Auth::user()->username)->first()->tahun_lulus->tahun_lulus;

        // if (!$alumni) {
        //     // Handle the case where the alumni data is not found
        //     return redirect()->back()->with('error', 'Alumni data not found.');
        // }

        // $tahun_lulus = $alumni->tahun_lulus;

        // Get questionnaires based on the graduation year within a 5-year range
        $kuesioner = Kuesioner::where('tahun_lulus_awal', '<=', $tahun_lulus)
            ->where('tahun_lulus_akhir', '>=', $tahun_lulus)
            ->get();

        // Get user ID
        $userId = Auth::user()->username;

        // Add submission status to each kuesioner item
        foreach ($kuesioner as $item) {
            $item->isSubmitted = Jawaban::where('nisn', $userId)
                ->where('id_kuesioner', $item->id_kuesioner)
                ->exists();

            // Debug: Log or print the isSubmitted status
            logger("Kuesioner ID: {$item->id_kuesioner}, isSubmitted: " . ($item->isSubmitted ? 'true' : 'false'));
        }

        return view('alumni.kuesioner.view', [
            'title' => 'Data Kuesioner',
            'kuesioner' => $kuesioner
        ]);
    }


    //fungsi showKuesioner
    public function showKuesioner($id)
    {
        $kuesioner = Kuesioner::with(['pertanyaan.opsiJawaban'])->findOrFail($id);

        // Get data alumni
        $alumni = Alumni::with(['jurusan', 'tahun_lulus', 'kategori'])->find(Auth::user()->username);

        // Get all categories
        $categories = Kategori::all();

        // Group questions by category
        $groupedQuestions = $kuesioner->pertanyaan->groupBy('id_kategori');
        // var_dump($groupedQuestions);
        // die();

        return view('alumni.kuesioner.show', compact('kuesioner', 'alumni', 'categories', 'groupedQuestions'), ['title' => 'Data Kuesioner']);
    }

    //fungsi save kuesioner jawaban
    // Fungsi untuk menyimpan jawaban kuesioner
    public function saveKuesioner(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nisn' => 'numeric',
            'id_kuesioner' => 'required',
            'id_kategori' => 'numeric',
            'respons' => 'array',
            'respons.*.id_pertanyaan' => 'numeric',

        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dengan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Loop melalui setiap respons yang diberikan
        if ($request->has('respons')) {
            foreach ($request->respons as $response) {
                // Pastikan 'jawaban' memiliki nilai sebelum menyimpannya ke dalam database
                if (!empty($response['jawaban'])) {
                    $data = [
                        'nisn' => $request->nisn,
                        'id_kuesioner' => $request->id_kuesioner,
                        'id_pertanyaan' => $response['id_pertanyaan'],
                        'id_tahun_lulus' => $request->id_tahun_lulus,
                        'id_kategori' => $request->id_kategori,
                        'jawaban' => $response['jawaban']
                    ];

                    // Buat entri baru di tabel Jawaban
                    Jawaban::create($data);
                }
            }
        }

        // Update kolom id_kategori pada data alumni
        $alumni = Alumni::find($request->nisn);
        $alumni->update(['id_kategori' => $request->id_kategori]);

        // Redirect ke route 'kuesioner-alumni' dengan pesan sukses
        return redirect()->route('kuesioner-alumni')->with('success', 'Data berhasil disimpan');
    }

    //fungsi edit kuesioner jawaban
    public function editKuesioner($id)
    {
        $kuesioner = Kuesioner::with(['pertanyaan.opsiJawaban'])->findOrFail($id);

        // Get data alumni
        $alumni = Alumni::with(['jurusan', 'tahun_lulus', 'kategori'])->find(Auth::user()->username);

        // Get all categories
        $categories = Kategori::all();
        $groupedQuestions = $kuesioner->pertanyaan->groupBy('id_kategori'); // Assuming each question has a 'id_kategori' field

        return view(
            'alumni.kuesioner.edit',
            compact('kuesioner', 'alumni', 'categories', 'groupedQuestions'),
            ['title' => 'Edit Kuesioner']
        );
    }

    // public function updateKuesioner(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'nisn' => 'numeric',
    //         'id_kategori' => 'numeric',
    //         'respons' => 'array',
    //         'respons.*.id_pertanyaan' => 'numeric',
    //     ]);

    //     // Jika validasi gagal, kembali ke halaman sebelumnya dengan error
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     //hapus data jawaban berdarakan nisn username, id_kuesioner, id_pertanyaan, id_jawaban
    //     Jawaban::where('nisn', $request->nisn)
    //         ->where('id_kuesioner', $request->id_kuesioner)
    //         ->delete();


    //     //jalankan private saveKuesionerEdit
    //     $this->saveKuesionerEdit($request);

    //     // Redirect ke route 'kuesioner-alumni' dengan pesan sukses
    //     return redirect()->route('kuesioner-alumni')->with('success', 'Data berhasil disimpan');

    // }

    // //fungsi private save kuesioner
    // private function saveKuesionerEdit($request)
    // {
    //     // Loop melalui setiap respons yang diberikan
    //     if ($request->has('respons')) {
    //         foreach ($request->respons as $response) {
    //             // Pastikan 'jawaban' memiliki nilai sebelum menyimpannya ke dalam database
    //             if (!empty($response['jawaban'])) {
    //                 Jawaban::create([
    //                     'nisn' => $request->nisn,
    //                     'id_pertanyaan' => $response['id_pertanyaan'],
    //                     'id_tahun_lulus' => $request->id_tahun_lulus,
    //                     'id_kategori' => $request->id_kategori,
    //                     'id_kuesioner' => $request->id_kuesioner,
    //                     'jawaban' => $response['jawaban'],
    //                 ]);
    //             }
    //         }
    //     }

    //     // Update kolom id_kategori pada data alumni
    //     $alumni = Alumni::find($request->nisn);
    //     $alumni->update(['id_kategori' => $request->id_kategori]);

    // }


    public function updateKuesioner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nisn' => 'numeric',
            'id_kategori' => 'numeric',
            'respons' => 'array',
            'respons.*.id_pertanyaan' => 'numeric',
        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dengan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            // Delete existing responses based on nisn and id_kuesioner
            Jawaban::where('nisn', $request->nisn)
                ->where('id_kuesioner', $request->id_kuesioner)
                ->delete();

            // Call private function to save updated responses
            $this->saveKuesionerEdit($request);

            // Update id_kategori for the alumni
            $alumni = Alumni::find($request->nisn);
            $alumni->update(['id_kategori' => $request->id_kategori]);

            DB::commit();

            // Redirect with success message
            return redirect()->route('kuesioner-alumni')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error and redirect with error message
            logger('Error updating kuesioner:', [$e->getMessage()]);
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    // Private function to save kuesioner responses
    private function saveKuesionerEdit($request)
    {
        // Loop through each response and save the updated data
        if ($request->has('respons')) {
            foreach ($request->respons as $response) {
                if (!empty($response['jawaban'])) {
                    Jawaban::create([
                        'nisn' => $request->nisn,
                        'id_pertanyaan' => $response['id_pertanyaan'],
                        'id_tahun_lulus' => $request->id_tahun_lulus,
                        'id_kategori' => $request->id_kategori,
                        'id_kuesioner' => $request->id_kuesioner,
                        'jawaban' => $response['jawaban'],
                    ]);
                }
            }
        }
    }



    // public function updateKuesioner(Request $request)
    // {
    //     // Validasi input
    //     $validator = Validator::make($request->all(), [
    //         'nisn' => 'required|numeric',
    //         'id_kuesioner' => 'required|numeric',
    //         'id_kategori' => 'required|numeric',
    //         'respons' => 'required|array',
    //         'respons.*.id_pertanyaan' => 'required|numeric',
    //     ]);

    //     // Jika validasi gagal, kembali ke halaman sebelumnya dengan error
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     try {
    //         DB::beginTransaction();

    //         // Extract pertanyaan IDs from the request
    //         $pertanyaanIds = collect($request->respons)->pluck('id_pertanyaan')->toArray();

    //         // Log the IDs to be deleted
    //         logger('Attempting to delete Jawaban with the following conditions:', [
    //             'nisn' => $request->nisn,
    //             'id_kuesioner' => $request->id_kuesioner,
    //             'id_pertanyaan' => $pertanyaanIds
    //         ]);

    //         // Retrieve and log the existing Jawaban entries before deletion
    //         $existingJawaban = Jawaban::where('nisn', $request->nisn)
    //             ->where('id_kuesioner', $request->id_kuesioner)
    //             ->whereIn('id_pertanyaan', $pertanyaanIds)
    //             ->get();
    //         logger('Existing Jawaban before deletion:', $existingJawaban->toArray());

    //         // Delete previous answers related to the specific kuesioner and pertanyaan IDs
    //         $deleted = Jawaban::where('nisn', $request->nisn)
    //             ->where('id_kuesioner', $request->id_kuesioner)
    //             ->whereIn('id_pertanyaan', $pertanyaanIds)
    //             ->delete();

    //         // Log the result of the deletion
    //         logger('Number of rows deleted:', [$deleted]);

    //         // Loop through each response and save the new answers
    //         if ($request->has('respons')) {
    //             foreach ($request->respons as $response) {
    //                 if (!empty($response['jawaban'])) {
    //                     Jawaban::create([
    //                         'nisn' => $request->nisn,
    //                         'id_pertanyaan' => $response['id_pertanyaan'],
    //                         'id_tahun_lulus' => $request->id_tahun_lulus,
    //                         'id_kategori' => $request->id_kategori,
    //                         'id_kuesioner' => $request->id_kuesioner,
    //                         'jawaban' => $response['jawaban'],
    //                     ]);
    //                 }
    //             }
    //         }

    //         // Update id_kategori for the alumni
    //         $alumni = Alumni::find($request->nisn);
    //         $alumni->update(['id_kategori' => $request->id_kategori]);

    //         DB::commit();

    //         return redirect()->route('kuesioner-alumni')->with('success', 'Data berhasil disimpan');
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         // Log the error message for debugging
    //         logger('Error in updateKuesioner:', [$e->getMessage()]);

    //         // Redirect dengan pesan error jika terjadi kesalahan
    //         return redirect()->back()->withErrors([$e->getMessage()]);
    //     }
    // }








    //fungsi history view
    public function historyKuesioner()
    {
        $nisn = Auth::user()->username;
        $alumni = Alumni::with(['jurusan', 'tahun_lulus', 'kategori'])->find($nisn);

        // Get all the answered kuesioners for the logged-in alumni
        $jawaban = Jawaban::where('nisn', $nisn)
            ->with('pertanyaan.kuesioner')
            ->get();

        // Get unique kuesioners
        $kuesioner = $jawaban->pluck('pertanyaan.kuesioner')->unique('id_kuesioner');

        return view('alumni.kuesioner.history', compact('kuesioner', 'alumni'), ['title' => 'History Kuesioner']);
    }

    //fungsi history pengisian kuesioner
    // public function historyDetailKuesioner()
    // {
    //     $alumni = Alumni::with(['jurusan', 'tahun_lulus', 'kategori'])->find(Auth::user()->username);
    //     $kuesioner = Jawaban::where('nisn', Auth::user()->username)->get();

    //     return view('alumni.kuesioner.history', compact('kuesioner', 'alumni'), ['title' => 'History Kuesioner']);
    // }

    public function historyDetailKuesioner($id)
    {
        $nisn = Auth::user()->username;
        $alumni = Alumni::with(['jurusan', 'tahun_lulus', 'kategori'])->find($nisn);

        // var_dump($alumni->id_kategori);
        // die();

        // Get the specific kuesioner
        $kuesioner = Kuesioner::with(['pertanyaan' => function ($query) use ($alumni, $nisn) {
            // Filter pertanyaan berdasarkan kategori yang dipilih oleh alumni
            $query->where('id_kategori', $alumni->id_kategori)->with(['jawaban' => function ($query) use ($nisn) {
                // Filter jawaban berdasarkan nisn alumni
                $query->where('nisn', $nisn);
            }]);
        }])->find($id);

        return view('alumni.kuesioner.history-detail', compact('kuesioner', 'alumni'), ['title' => 'Detail Kuesioner']);
    }

    //fungsi lupa password
    public function lupaPassword()
    {
        return view('auth.lupa-password', ['title' => 'Lupa Password']);
    }
}
