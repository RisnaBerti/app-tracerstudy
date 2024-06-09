<?php

namespace App\Http\Controllers;

use Log;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //fungsi index
    public function index()
    {
        return view(
            'auth.login',
            [
                'title' => 'Login'
            ]
        );
    }

    public function actionLogin(Request $request)
    {
        // untuk menambahkan validasi pada form login
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        // mendapatkan data dr request form input
        $credentials = $request->only('username', 'password');

        //jika form terisi sesuai validasi data
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek user aktif atau tidak
            if ($user->is_aktif == 1) {

                // Cek role user 1, 2, 3, 4,
                if ($user->id_role == 1) {
                    return redirect()->route('bkk')->with('success', 'Anda berhasil login!');
                } elseif ($user->id_role == 2) {
                    return redirect()->route('humas')->with('success', 'Anda berhasil login!');
                } elseif ($user->id_role == 3) {
                    return redirect()->route('pegawai')->with('success', 'Anda berhasil login!');
                } else {
                    // Jika bukan admin maka di-redirect ke route default
                    return redirect()->route('alumni')->with('success', 'Anda berhasil login!'); // Assuming a default dashboard route named 'dashboard'
                }
            } else {
                Auth::logout(); //jika akun user is_aktif = 0
                return redirect('/')->with('error', 'Akun anda tidak aktif');
            }
        }

        // jika email/password yg dimasukan salahh
        return redirect('/')->with('error', 'Email atau Password Salah');
    }

    //fungsi logout
    // public function logout()
    // {
    //     Auth::logout();
    //     return redirect('/')->with('success', 'Anda berhasil logout!');;
    // }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    //funsi ganti password
    public function changePassword()
    {
        return view('auth.change-password');
    }

    //fungsi action ganti password
    public function actionChangePassword(Request $request)
    {
        //validasi form ganti password
        $request->validate([
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);



        //mengirimkan pesan sukses
        return redirect('/')->with('success', 'Password berhasil diubah');
    }

    //fungsi lupa password
    public function lupaPassword()
    {
        return view('auth.lupa-password', ['title' => 'Lupa Password']);
    }

    //fungsi action lupa password
    public function actionLupaPassword(Request $request)
    {
        // Validasi form lupa password
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;

        // Periksa email di tabel alumni
        $alumni = DB::table('alumni')->where('email_alumni', $email)->first();

        // Periksa email di tabel pegawai
        $pegawai = DB::table('pegawai')->where('email_pegawai', $email)->first();

        if (!$alumni && !$pegawai) {
            return back()->withErrors(['email' => 'Email tidak ditemukan di data alumni atau pegawai.']);
        }

        // Generate token
        $token = Str::random(60);

        // Insert ke tabel password_resets
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now()
        ]);

        // Mengirim link reset password ke email
        try {
            Mail::to($email)->send(new ResetPasswordMail($token));
            return back()->with('success', 'Kami telah mengirimkan tautan pengaturan ulang kata sandi Anda melalui email!');
        } catch (\Exception $e) {
            Log::error('Kesalahan saat mengirim email setel ulang kata sandi:' . $e->getMessage());
            return back()->with('error', 'Gagal mengirim email setel ulang kata sandi.');
        }
    }

    //fungsi update password lupa password
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function actionResetPassword(Request $request, $token)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $passwordReset = DB::table('password_resets')
            ->where('token', $token)
            ->first();

        if (!$passwordReset) {
            return back()->withErrors(['token' => 'Token pengaturan ulang kata sandi ini tidak valid.']);
        }

        // Cari email di tabel alumni dan pegawai
        $alumni = DB::table('alumni')->where('email_alumni', $passwordReset->email)->first();
        $pegawai = DB::table('pegawai')->where('email_pegawai', $passwordReset->email)->first();

        if (!$alumni && !$pegawai) {
            return back()->withErrors(['email' => 'Kami tidak dapat menemukan pengguna dengan alamat email tersebut.']);
        }

        // Dapatkan id_user dari tabel alumni atau pegawai
        $userId = $alumni ? $alumni->id_user : $pegawai->id_user;

        // Update password di tabel users
        DB::table('users')->where('id_user', $userId)->update([
            'password' => Hash::make($request->password)
        ]);

        // Hapus token setelah digunakan
        DB::table('password_resets')->where('email', $passwordReset->email)->delete();

        return redirect('/')->with('success', 'Kata sandi Anda telah diubah!');
    }
}
