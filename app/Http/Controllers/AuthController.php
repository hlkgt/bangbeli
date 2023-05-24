<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function newUser(Request $request){
        $credential = $request->validate([
            'name' => 'required|max:12',
            'email' =>'required|email:dns|unique:users',
            'password' => 'min:8|max:12',
            'cpassword' => 'min:8|max:12'
        ]);
        if($credential["password"] !== $credential["cpassword"]){
            return redirect()->back()->with('error','Different Confirm Password');
        };
        $user = DB::table('users')->insert([
            'name' => $credential['name'],
            'email' => $credential['email'],
            'password' => Hash::make($credential['password']),
        ]);

        return redirect()->route('login')->with('info','Registration successful, please login.');
    }

    public function login(){
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/dashboard');
        }
 
        return back()->withErrors([
            'email' => 'Login Gagal',
        ])->onlyInput('email');
    }
}