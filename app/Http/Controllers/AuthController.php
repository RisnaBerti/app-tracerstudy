<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //fungsi index
    public function index()
    {
        return view('auth.login',
            [
                'title' => 'Login'
            ]
    );
    }

    public function actionLogin(Request $request)
    {
        // untuk menambahkan validasi pada form login
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // mendapatkan data dr request form input
        $credentials = $request->only('username', 'password');

        //jika form terisi sesuai validasi data
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek user aktif atau tidak
            if ($user->is_aktif == 1) {

                // Cek role user 1, 2, 3, 4,
                if ($user->id_role == 1) {
                    return redirect()->route('bkk');
                } elseif ($user->id_role == 2) {
                    return redirect()->route('humas');
                } elseif ($user->id_role == 3) {
                    return redirect()->route('pegawai');
                } else {
                    // Jika bukan admin maka di-redirect ke route default
                    return redirect()->route('alumni'); // Assuming a default dashboard route named 'dashboard'
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
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    //fungsi reset password
    public function resetPassword()
    {
        return view('auth.reset-password');
    }

    //fungsi action reset password
    public function actionResetPassword(Request $request)
    {
        //validasi form reset password
        $request->validate([
            'email' => 'required|email'
        ]);

        //mengirimkan email reset password
        return redirect('/')->with('success', 'Email reset password telah dikirim');
    }

    //fungsi lupa password
    public function forgotPassword()
    {
        return view('auth.forgot-password');
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

    
}
