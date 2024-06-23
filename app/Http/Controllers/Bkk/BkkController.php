<?php

namespace App\Http\Controllers\Bkk;

use App\Models\User;
use App\Models\Alumni;

use App\Models\Jawaban;
use App\Models\Pegawai;
use App\Models\Kuesioner;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use App\Exports\JawabanExport;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Validator;

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

        $title = 'Hapus Data!';
        $text = "Apakah Anda yakin ingin menghapus nya?";
        confirmDelete($title, $text);

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

        return view('bkk.profil.edit', [
            'title' => 'Data Profil',
            // 'action' => route('profil-update-bkk', $id),
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

        return redirect()->route('profil-bkk', $id)->with('success', 'Data Profil Berhasil Diubah');
    }

    //fungsi hasil kuesioner
    public function hasil()
    {
        //get data kuesioner dan jumlahkan berapa siswa yang sudah mengisi
        // Ambil semua data kuesioner
        $kuesioner = Kuesioner::all();

        // Buat array untuk menyimpan jumlah siswa yang sudah mengisi setiap kuesioner
        $jumlahMengisi = [];
        // Loop melalui setiap kuesioner
        foreach ($kuesioner as $item) {
            // Hitung jumlah unik NISN yang telah mengisi kuesioner ini
            $jumlahMengisi[$item->id_kuesioner] = DB::table('jawaban')
                ->where('id_kuesioner', $item->id_kuesioner)
                ->distinct('nisn')
                ->count('nisn');
        }

        return view(
            'bkk.kuesioner.hasil',
            compact('kuesioner', 'jumlahMengisi'),
            ['title' => 'Hasil Kuesioner']
        );
    }

    //fungsi kirim notifikasi wa ke alumni jika ada kueioner baru
    public function kirimNotifikasi()
    {
        // Ambil semua data alumni
        $alumni = Alumni::all();

        // Pesan notifikasi
        $message = "*Kuesioner Alumni SMK*\n" .
            "==============================\n" .
            "Tanggal: " . date("d F Y") . "\n" .
            "Halo, ada kuesioner baru yang harus kamu isi. Silahkan cek aplikasi Kuesioner Alumni untuk mengisi kuesioner tersebut.\n" .
            "Terima kasih\n" .
            "==============================";

        // Token API Wablas
        $token = "MnFvh9He2K3dTHl6lIXVDCDKTbq0lo8PmmNxodK6jLkn0ls4THEM5E9SsQ0k1y3o";

        foreach ($alumni as $item) {
            // Nomor telepon alumni
            $phone = $item->no_hp_alumni;

            // var_dump($phone);
            // die();

            // Encode message
            $encodedMessage = urlencode($message);

            // URL API Wablas
            $url = "https://pati.wablas.com/api/send-message?phone=$phone&message=$encodedMessage&token=$token";

            // Inisialisasi cURL
            $curl = curl_init($url);

            // Set cURL options
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            // Execute cURL request
            $result = curl_exec($curl);

            // Close cURL
            curl_close($curl);
        }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Notifikasi berhasil dikirim');
    }

    //fungsi statistik alumni 
    public function statistik2()
    {
        //jawaban
        $jawaban = Jawaban::all();
        // // Ambil semua data alumni
        $alumni = Alumni::all();

        //hitung jumlah alumni per kategori
        $alumniPerKategori = $jawaban->groupBy('id_kategori')->map(function ($item) {
            return $item->count();
        });

        //hitung alumni per kategori per tahun lulus
        $alumniPerTahun = $jawaban->groupBy('id_tahun_lulus')->map(function ($item) {
            return $item->count();
        });

        //hitung alumni per kategori per jurusan per tahun lulus
        $alumniPerKategoriPerJurusanPerTahunLulus = $alumni->groupBy('id_jurusan')->map(function ($item) {
            return $item->groupBy('id_tahun_lulus')->map(function ($item) {
                return $item->groupBy('id_kategori')->map(function ($item) {
                    return $item->count();
                });
            });
        });

        //hitung alumni yang bekerja berdasarkan jurusan, jawaban kolom jawaban <= 6 Bulan, jawaban kolom jawaban >6 bulan
        $alumniBekerja = $jawaban->where('id_kategori', 2)->groupBy('id_jurusan')->map(function ($item) {
            return $item->groupBy('id_tahun_lulus')->map(function ($item) {
                return $item->groupBy('bekerja')->map(function ($item) {

                    return $item->count();
                });
            });
        });





        return view('bkk.kuesioner.statistik', [
            'title' => 'Statistik Alumni',
            // 'alumniPerKategori' => $alumniPerKategori,
            // 'alumniPerTahun' => $alumniPerTahun,
        ]);
    }

    //fungsi statistik
    public function statistik_old(Request $request)
    {
        // Ambil input tahun dari formulir
        $tahun = $request->input('tahun');

        // Query untuk menghitung jumlah alumni berdasarkan jurusan dan tahun lulus
        $query = "SELECT 
                    a.id_tahun_lulus, 
                    a.id_jurusan, 
                    COUNT(nisn) AS jumlah_alumni, 
                    j.nama_jurusan, 
                    tl.tahun_lulus
                FROM 
                    alumni a
                JOIN 
                    jurusan j ON a.id_jurusan = j.id_jurusan
                JOIN 
                    tahun_lulus tl ON a.id_tahun_lulus = tl.id_tahun_lulus";

        // Jika input tahun tidak kosong, tambahkan kondisi WHERE untuk memfilter tahun
        if ($tahun) {
            $query .= " WHERE tl.tahun_lulus = $tahun";
        }

        $query .= " GROUP BY 
                    a.id_jurusan, 
                    a.id_tahun_lulus,
                    j.nama_jurusan,
                    tl.tahun_lulus
                ORDER BY 
                    j.nama_jurusan ASC, 
                    tl.tahun_lulus ASC";

        // Eksekusi query
        $alumniPerJurusanPerTahun = DB::select($query);

        return view('bkk.kuesioner.statistik', [
            'title' => 'Statistik Alumni',
            'alumniPerJurusanPerTahun' => $alumniPerJurusanPerTahun,
            'tahun' => $tahun, // Sertakan tahun dalam data yang dikirim ke view
        ]);
    }

    //fungsi statistika print
    public function statistikPrint_old(Request $request)
    {
        // Ambil input tahun dari formulir
        $tahun = $request->input('tahun');

        // Query untuk menghitung jumlah alumni berdasarkan jurusan dan tahun lulus
        $query = "SELECT 
                    a.id_tahun_lulus, 
                    a.id_jurusan, 
                    COUNT(nisn) AS jumlah_alumni, 
                    j.nama_jurusan, 
                    tl.tahun_lulus
                FROM 
                    alumni a
                JOIN 
                    jurusan j ON a.id_jurusan = j.id_jurusan
                JOIN 
                    tahun_lulus tl ON a.id_tahun_lulus = tl.id_tahun_lulus";

        // Jika input tahun tidak kosong, tambahkan kondisi WHERE untuk memfilter tahun
        if ($tahun) {
            $query .= " WHERE tl.tahun_lulus = $tahun";
        }

        $query .= " GROUP BY 
                    a.id_jurusan, 
                    a.id_tahun_lulus,
                    j.nama_jurusan,
                    tl.tahun_lulus
                ORDER BY 
                    j.nama_jurusan ASC, 
                    tl.tahun_lulus ASC";

        // Eksekusi query
        $alumniPerJurusanPerTahun = DB::select($query);

        return view('bkk.kuesioner.statistik-print', [
            'title' => 'Statistik Alumni',
            'alumniPerJurusanPerTahun' => $alumniPerJurusanPerTahun,
            'tahun' => $tahun, // Sertakan tahun dalam data yang dikirim ke view
        ]);
    }

    //fungsi preview hasil
    public function preview($id)
    {
        $query = "
            SELECT 
                kt.nama_kategori,
                p.pertanyaan, 
                MAX(p.tipe_pertanyaan) AS tipe_pertanyaan,
                j.jawaban, 
                COUNT(j.jawaban) AS jumlah_jawaban
            FROM
                kuesioner k
                JOIN pertanyaan p ON k.id_kuesioner = p.id_kuesioner        
                JOIN jawaban j ON p.id_pertanyaan = j.id_pertanyaan
                JOIN kategori kt ON j.id_kategori = kt.id_kategori
            WHERE
                k.id_kuesioner = $id
            GROUP BY
                kt.nama_kategori,
                p.pertanyaan,
                j.jawaban
            ORDER BY
                kt.nama_kategori,
                p.pertanyaan
            ";

        $results = DB::select($query);

        // Group data by kategori and pertanyaan
        $data = [];
        foreach ($results as $row) {
            $data[$row->nama_kategori][$row->pertanyaan]['jawaban'][] = $row->jawaban;
            $data[$row->nama_kategori][$row->pertanyaan]['jumlah_jawaban'][] = $row->jumlah_jawaban;
            $data[$row->nama_kategori][$row->pertanyaan]['tipe'] = $row->tipe_pertanyaan;
        }

        return view('bkk.kuesioner.preview', ['title' => 'Preview Hasil Kuesioner', 'id' => $id, 'data' => $data]);
    }

    //fungsi print preview hasil
    public function previewPrint($id)
    {
        $query = "
                    SELECT 
                        kt.nama_kategori,
                        p.pertanyaan, 
                        MAX(p.tipe_pertanyaan) AS tipe_pertanyaan,
                        j.jawaban, 
                        COUNT(j.jawaban) AS jumlah_jawaban
                    FROM
                        kuesioner k
                        JOIN pertanyaan p ON k.id_kuesioner = p.id_kuesioner        
                        JOIN jawaban j ON p.id_pertanyaan = j.id_pertanyaan
                        JOIN kategori kt ON j.id_kategori = kt.id_kategori
                    WHERE
                        k.id_kuesioner = $id
                    GROUP BY
                        kt.nama_kategori,
                        p.pertanyaan,
                        j.jawaban
                    ORDER BY
                        kt.nama_kategori,
                        p.pertanyaan
                ";

        $results = DB::select($query);

        // Group data by kategori and pertanyaan
        $data = [];
        foreach ($results as $row) {
            $data[$row->nama_kategori][$row->pertanyaan]['jawaban'][] = $row->jawaban;
            $data[$row->nama_kategori][$row->pertanyaan]['jumlah_jawaban'][] = $row->jumlah_jawaban;
            $data[$row->nama_kategori][$row->pertanyaan]['tipe'] = $row->tipe_pertanyaan;
        }


        return view('bkk.kuesioner.preview-print', ['title' => 'Preview Hasil Kuesioner', 'id' => $id, 'data' => $data]);
    }


    //fungsi preview hasil2
    public function preview2($id)
    {
        // Get data jumlah alumni per tahun per jurusan
        $query = "
        SELECT 
            tl.tahun_lulus,
            j.nama_jurusan,
            COUNT(a.nisn) AS jumlah_alumni
        FROM
            alumni a
            JOIN jurusan j ON a.id_jurusan = j.id_jurusan
            JOIN tahun_lulus tl ON a.id_tahun_lulus = tl.id_tahun_lulus
        GROUP BY
            tl.tahun_lulus,
            j.nama_jurusan
        ORDER BY
            tl.tahun_lulus,
            j.nama_jurusan
        ";

        $results = DB::select($query);
        $data = [];
        $chartData = [];
        $categories = [];

        foreach ($results as $row) {
            $data[$row->tahun_lulus][$row->nama_jurusan] = $row->jumlah_alumni;
            $chartData[$row->nama_jurusan][$row->tahun_lulus] = $row->jumlah_alumni;
            if (!in_array($row->nama_jurusan, $categories)) {
                $categories[] = $row->nama_jurusan;
            }
        }

        $seriesData = [];
        foreach ($chartData as $jurusan => $years) {
            $yearsData = [];
            foreach (array_keys($data) as $year) {
                $yearsData[] = $years[$year] ?? 0;
            }
            $seriesData[] = [
                'name' => $jurusan,
                'data' => $yearsData
            ];
        }

        return view('bkk.kuesioner.preview-2', [
            'title' => 'Preview Hasil Kuesioner',
            'id' => $id,
            'data' => $data,
            'seriesData' => $seriesData,
            'categories' => array_keys($data)
        ]);
    }


    //fungsi preview3 Bekerja
    public function preview3($id)
    {
        $query = "
            SELECT 
                a.nama_alumni,
                kt.nama_kategori,
                p.pertanyaan,
                j.jawaban
            FROM
                kuesioner k
                JOIN pertanyaan p ON k.id_kuesioner = p.id_kuesioner
                JOIN jawaban j ON p.id_pertanyaan = j.id_pertanyaan
                JOIN kategori kt ON j.id_kategori = kt.id_kategori
                JOIN alumni a ON j.nisn = a.nisn
            WHERE
                k.id_kuesioner = :id
                AND p.pertanyaan IN (
                    'Dalam jabatan atau posisi apa anda saat ini bekerja?',
                    'Nama perusahaan/kantor tempat anda bekerja saat ini?'
                )
                AND kt.nama_kategori = 'Bekerja'
            ORDER BY
                a.nama_alumni,
                kt.nama_kategori,
                p.pertanyaan
            ";

        $results = DB::select($query, ['id' => $id]);

        // Group data by alumni
        $data = [];
        foreach ($results as $row) {
            $data[$row->nama_alumni][$row->pertanyaan] = $row->jawaban;
        }

        return view('bkk.kuesioner.preview-3', ['title' => 'Preview Hasil Kuesioner', 'id' => $id,  'data' => $data]);
    }

    //fungsi preview4 Kuliah
    public function preview4($id)
    {
        //get data nama alumni, kategori kuliah, pertanyaan jawaban kuliah dimana

        $query = "
            SELECT 
                a.nama_alumni,
                kt.nama_kategori,
                p.pertanyaan,
                j.jawaban
            FROM
                kuesioner k
                JOIN pertanyaan p ON k.id_kuesioner = p.id_kuesioner
                JOIN jawaban j ON p.id_pertanyaan = j.id_pertanyaan
                JOIN kategori kt ON j.id_kategori = kt.id_kategori
                JOIN alumni a ON j.nisn = a.nisn
            WHERE
                k.id_kuesioner = :id
                AND p.pertanyaan IN (
                    'Di perguruan tinggi mana anda melanjutkan pendidikan?',
                    'Jurusan apa yang anda ambil di perguruan tinggi tersebut?'
                )
                AND kt.nama_kategori = 'Kuliah'
            ORDER BY
                a.nama_alumni,
                kt.nama_kategori,
                p.pertanyaan
            ";

        $results = DB::select($query, ['id' => $id]);

        // Group data by alumni
        $data = [];
        foreach ($results as $row) {
            $data[$row->nama_alumni][$row->pertanyaan] = $row->jawaban;
        }

        return view('bkk.kuesioner.preview-4', ['title' => 'Preview Hasil Kuesioner', 'id' => $id,  'data' => $data]);
    }

    //fungsi preview6 Wirausaha
    public function preview5($id)
    {
        //get data nama alumni, kategori kuliah, pertanyaan jawaban kuliah dimana

        $query = "
            SELECT 
                a.nama_alumni,
                kt.nama_kategori,
                p.pertanyaan,
                j.jawaban
            FROM
                kuesioner k
                JOIN pertanyaan p ON k.id_kuesioner = p.id_kuesioner
                JOIN jawaban j ON p.id_pertanyaan = j.id_pertanyaan
                JOIN kategori kt ON j.id_kategori = kt.id_kategori
                JOIN alumni a ON j.nisn = a.nisn
            WHERE
                k.id_kuesioner = :id
                AND p.pertanyaan IN (
                    'Wirausaha bidang apa yang sedang anda jalankan saat ini?',
                    'Apa nama usaha yang anda jalankan?'
                )
                AND kt.nama_kategori = 'Wirausaha'
            ORDER BY
                a.nama_alumni,
                kt.nama_kategori,
                p.pertanyaan
            ";

        $results = DB::select($query, ['id' => $id]);

        // Group data by alumni
        $data = [];
        foreach ($results as $row) {
            $data[$row->nama_alumni][$row->pertanyaan] = $row->jawaban;
        }

        return view('bkk.kuesioner.preview-5', ['title' => 'Preview Hasil Kuesioner', 'id' => $id,  'data' => $data]);
    }

    //fungsi preview5 Belum Bekerja
    public function preview6($id)
    {
        //get data nama alumni, kategori kuliah, pertanyaan jawaban kuliah dimana

        $query = "
            SELECT 
                a.nama_alumni,
                kt.nama_kategori,
                p.pertanyaan,
                j.jawaban
            FROM
                kuesioner k
                JOIN pertanyaan p ON k.id_kuesioner = p.id_kuesioner
                JOIN jawaban j ON p.id_pertanyaan = j.id_pertanyaan
                JOIN kategori kt ON j.id_kategori = kt.id_kategori
                JOIN alumni a ON j.nisn = a.nisn
            WHERE
                k.id_kuesioner = :id
                AND p.pertanyaan IN (
                    'Hal apa yang menyebabkan anda belum bekerja hingga saat ini?',
                    'Dimana anda sekarang bekerja?'
                )
                AND kt.nama_kategori = 'Belum Bekerja'
            ORDER BY
                a.nama_alumni,
                kt.nama_kategori,
                p.pertanyaan
            ";

        $results = DB::select($query, ['id' => $id]);

        // Group data by alumni
        $data = [];
        foreach ($results as $row) {
            $data[$row->nama_alumni][$row->pertanyaan] = $row->jawaban;
        }

        return view('bkk.kuesioner.preview-6', ['title' => 'Preview Hasil Kuesioner', 'id' => $id,  'data' => $data]);
    }

    //fungsi data dari tabel jawaban

    // public function dataJawaban(Request $request)
    // {
    //     try {
    //         $tahun = $request->input('tahun');

    //         if ($request->ajax()) {
    //             $pertanyaan_array = DB::table('pertanyaan')->pluck('pertanyaan')->toArray();

    //             $query = "
    //             SELECT 
    //                 alumni.nama_alumni, 
    //                 alumni.nisn, 
    //                 jurusan.nama_jurusan, 
    //                 tahun_lulus.tahun_lulus, 
    //                 kuesioner.judul_kuesioner,
    //                 kategori.nama_kategori,
    //                 GROUP_CONCAT(CONCAT(pertanyaan.pertanyaan, ': ', jawaban.jawaban) ORDER BY pertanyaan.id_pertanyaan SEPARATOR '; ') AS jawaban_pertanyaan
    //             FROM jawaban
    //             JOIN alumni ON jawaban.nisn = alumni.nisn
    //             JOIN jurusan ON alumni.id_jurusan = jurusan.id_jurusan
    //             JOIN tahun_lulus ON alumni.id_tahun_lulus = tahun_lulus.id_tahun_lulus
    //             JOIN kategori ON jawaban.id_kategori = kategori.id_kategori
    //             JOIN pertanyaan ON jawaban.id_pertanyaan = pertanyaan.id_pertanyaan
    //             JOIN kuesioner ON pertanyaan.id_kuesioner = kuesioner.id_kuesioner
    //             GROUP BY alumni.nisn, alumni.nama_alumni, jurusan.nama_jurusan, tahun_lulus.tahun_lulus, kuesioner.judul_kuesioner, kategori.nama_kategori
    //             ORDER BY alumni.nama_alumni";

    //             $data = DB::select($query);

    //             // Tambahkan kolom 'no' secara manual
    //             foreach ($data as $index => $item) {
    //                 $item->no = $index + 1;
    //             }


    //             return response()->json(['data' => $data, 'pertanyaan' => $pertanyaan_array]);
    //         }

    //         return view('bkk.kuesioner.statistik', [
    //             'title' => 'STATISTIK ALUMNI',
    //             'tahun' => $tahun
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('Error fetching data: ' . $e->getMessage());
    //         return response()->json(['error' => 'Terjadi kesalahan dalam mengambil data. Silakan coba lagi nanti.'], 500);
    //     }
    // }

    public function dataJawaban(Request $request)
    {
        try {
            $tahun = $request->input('tahun');

            if ($request->ajax()) {
                $pertanyaan_array = DB::table('pertanyaan')->pluck('pertanyaan')->toArray();

                $query = "
            SELECT 
                alumni.nama_alumni, 
                alumni.nisn, 
                jurusan.nama_jurusan, 
                tahun_lulus.tahun_lulus, 
                kuesioner.judul_kuesioner,
                kategori.nama_kategori,
                GROUP_CONCAT(CONCAT(pertanyaan.pertanyaan, ': ', jawaban.jawaban) ORDER BY pertanyaan.id_pertanyaan SEPARATOR '; ') AS jawaban_pertanyaan
            FROM jawaban
            JOIN alumni ON jawaban.nisn = alumni.nisn
            JOIN jurusan ON alumni.id_jurusan = jurusan.id_jurusan
            JOIN tahun_lulus ON alumni.id_tahun_lulus = tahun_lulus.id_tahun_lulus
            JOIN kategori ON jawaban.id_kategori = kategori.id_kategori
            JOIN pertanyaan ON jawaban.id_pertanyaan = pertanyaan.id_pertanyaan
            JOIN kuesioner ON pertanyaan.id_kuesioner = kuesioner.id_kuesioner
            GROUP BY alumni.nisn, alumni.nama_alumni, jurusan.nama_jurusan, tahun_lulus.tahun_lulus, kuesioner.judul_kuesioner, kategori.nama_kategori
            ORDER BY alumni.nama_alumni";

                $data = DB::select($query);

                // Inisialisasi array untuk data yang akan diekspor
                $dataExport = [];

                foreach ($data as $index => $item) {
                    $row = [
                        'no' => $index + 1,
                        'nama_alumni' => $item->nama_alumni,
                        'nisn' => $item->nisn,
                        'nama_jurusan' => $item->nama_jurusan,
                        'tahun_lulus' => $item->tahun_lulus,
                        'judul_kuesioner' => $item->judul_kuesioner,
                        'nama_kategori' => $item->nama_kategori,
                    ];

                    // Pisahkan jawaban pertanyaan menjadi array asosiatif
                    $jawabanPertanyaan = [];
                    $jawabanPairs = explode('; ', $item->jawaban_pertanyaan);
                    foreach ($jawabanPairs as $pair) {
                        list($pertanyaan, $jawaban) = explode(': ', $pair);
                        $jawabanPertanyaan[$pertanyaan] = $jawaban;
                    }

                    // Gabungkan ke dalam data yang akan diekspor dengan urutan yang benar
                    foreach ($pertanyaan_array as $pertanyaan) {
                        $row[$pertanyaan] = $jawabanPertanyaan[$pertanyaan] ?? '-';
                    }

                    $dataExport[] = $row;
                }

                return response()->json(['data' => $dataExport, 'pertanyaan' => $pertanyaan_array]);
            }

            return view('bkk.kuesioner.statistik', [
                'title' => 'STATISTIK ALUMNI',
                'tahun' => $tahun
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching data: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan dalam mengambil data. Silakan coba lagi nanti.'], 500);
        }
    }



    //fungsi data dari tabel jawaban print excel
    public function dataJawabanPrintExcel(Request $request)
    {
        try {
            $tahun = $request->input('tahun');

            // Ambil daftar pertanyaan dari database
            $pertanyaan_array = DB::table('pertanyaan')->pluck('pertanyaan')->toArray();

            $query = "
                SELECT 
                    alumni.nama_alumni, 
                    alumni.nisn, 
                    jurusan.nama_jurusan, 
                    tahun_lulus.tahun_lulus, 
                    kuesioner.judul_kuesioner,
                    kategori.nama_kategori,
                    GROUP_CONCAT(CONCAT(pertanyaan.pertanyaan, ': ', jawaban.jawaban) ORDER BY pertanyaan.id_pertanyaan SEPARATOR '; ') AS jawaban_pertanyaan
                FROM jawaban
                JOIN alumni ON jawaban.nisn = alumni.nisn
                JOIN jurusan ON alumni.id_jurusan = jurusan.id_jurusan
                JOIN tahun_lulus ON alumni.id_tahun_lulus = tahun_lulus.id_tahun_lulus
                JOIN kategori ON jawaban.id_kategori = kategori.id_kategori
                JOIN pertanyaan ON jawaban.id_pertanyaan = pertanyaan.id_pertanyaan
                JOIN kuesioner ON pertanyaan.id_kuesioner = kuesioner.id_kuesioner
                GROUP BY alumni.nisn, alumni.nama_alumni, jurusan.nama_jurusan, tahun_lulus.tahun_lulus, kuesioner.judul_kuesioner, kategori.nama_kategori
                ORDER BY alumni.nama_alumni";

            $data = DB::select($query);

            // Inisialisasi array untuk data yang akan diekspor
            $dataExport = [];

            foreach ($data as $index => $item) {
                $row = [
                    'no' => $index + 1,
                    'nama_alumni' => $item->nama_alumni,
                    'nisn' => $item->nisn,
                    'nama_jurusan' => $item->nama_jurusan,
                    'tahun_lulus' => $item->tahun_lulus,
                    'judul_kuesioner' => $item->judul_kuesioner,
                    'nama_kategori' => $item->nama_kategori,
                ];

                // Pisahkan jawaban pertanyaan menjadi array asosiatif
                $jawabanPertanyaan = [];
                $jawabanPairs = explode('; ', $item->jawaban_pertanyaan);
                foreach ($jawabanPairs as $pair) {
                    list($pertanyaan, $jawaban) = explode(': ', $pair);
                    $jawabanPertanyaan[$pertanyaan] = $jawaban;
                }

                // Gabungkan ke dalam data yang akan diekspor
                $row = array_merge($row, $jawabanPertanyaan);

                $dataExport[] = $row;
            }

            // Panggil class JawabanExport untuk meng-generate file Excel
            return Excel::download(new JawabanExport($dataExport, $pertanyaan_array), 'jawaban.xlsx');
        } catch (\Exception $e) {
            Log::error('Error fetching data: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan dalam mengambil data. Silakan coba lagi nanti.'], 500);
        }
    }
}
