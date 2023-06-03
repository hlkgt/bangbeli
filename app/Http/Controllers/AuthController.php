<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function newUser(Request $request)
    {
        $credential = $request->validate([
            'name' => 'required|max:12',
            'email' => 'required|email|unique:users',
            'password' => 'min:8|max:12',
            'cpassword' => 'min:8|max:12'
        ]);
        if ($credential["password"] !== $credential["cpassword"]) {
            return redirect()->back()->with('error', 'Different Confirm Password');
        };

        $user = DB::table('users')->insert([
            'name' => $credential['name'],
            'email' => $credential['email'],
            'password' => Hash::make($credential['password']),
            'role' => 'client'
        ]);

        return redirect()->route('login')->with('info', 'Registration successful, please login.');
    }

    public function login()
    {
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

            $getDataUser = DataUser::where('user_id', auth()->user()->id)->first();

            if ($getDataUser === null) {
                DataUser::insert([
                    'user_id' => auth()->user()->id,
                    'status' => false
                ]);
            }

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Login Gagal',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function deleteProfile(Request $request)
    {
        $validated = $request->validate([
            'delete-account' => 'required'
        ]);
        if ($validated['delete-account'] === "DELETE") {
            $user = User::where('id', auth()->user()->id)->first();
            $getPathImage = DataUser::where('user_id', $user->id)->first();
            Storage::delete($getPathImage->photo_profile);
            $user->delete();
            return redirect()->route('welcome');
        } else {
            return redirect()->back()->with('error', 'Type Not Matched');
        }
    }
}
