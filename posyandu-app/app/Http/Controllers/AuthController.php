<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // LOGIN PAGE
    public function login()
    {
        return view('auth.login');
    }

    // PROSES LOGIN
    public function loginPost(Request $request)
    {
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/dashboard');
        }

        return back()->with('error','Email atau password salah');
    }

    // REGISTER PAGE
    public function register()
    {
        return view('auth.register');
    }

    // PROSES REGISTER
    public function registerPost(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success','Berhasil daftar');
    }

    // LOGOUT
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}