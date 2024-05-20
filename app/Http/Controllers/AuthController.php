<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Anda berhasil logout!');;
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
