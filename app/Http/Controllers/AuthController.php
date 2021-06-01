<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AuthModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function index()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu harus login!');
        }else{
            return view('anonim/peramalan');        
        }
    }

    public function login()
    {
        return view('anonim/index');
    }

    public function loginPost(Request $request)
    {
        $email = $request->email_l;
        $password = $request->password_l;

        
        $data = AuthModel::where('email', $email)->first();

        if ($data) { //cek email ada atau tidak
            if (Hash::check($password, $data->password)) {
                Session::put('email', $data->email);
                Session::put('status_login', TRUE);
                return redirect('/');
            }else {
                return redirect('/')->with('alert', 'Password atau email salah!');
            }
        }else {
            return redirect('/')->with('alert', 'Password atau email salah!');
        }
        
    }

    public function logout(){
        Session::flush();
        return redirect('/')->with('alert','Kamu sudah logout');
    }

    public function register(){
        $data =  new AuthModel();
        $data->email = 'alceoritter0@gmail.com';
        $data->password = bcrypt('1234');
        $data->save();
        return redirect('/')->with('alert-success','Kamu berhasil Register');
    }

}
