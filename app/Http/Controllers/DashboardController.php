<?php

namespace App\Http\Controllers;

use App\Models\Categori;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Categori::all();
        return view('dashboard.index',['categories' => $categories]);
    }
    public function profile()
    {
        $user = DB::table('data_users')
        ->join('users', 'data_users.user_id', '=', 'users.id')
        ->select('data_users.*','users.name','users.email')
        ->where('users.id',auth()->user()->id)
        ->get();
        return view('dashboard.profile',['user'=>$user]);
    }
}
