<?php

namespace App\Http\Controllers;

use App\Models\Categori;
use App\Models\DataUser;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Categori::all();
        $products = Product::where('rate', 5)->paginate(3);
        $testimonis = DB::table('testimonis')
            ->join('users', 'testimonis.user_id', 'users.id')
            ->join('data_users', 'data_users.user_id', 'testimonis.user_id')
            ->select('data_users.photo_profile', 'users.name', 'testimonis.*')
            ->where('rate', 5)
            ->paginate(6);
        return view('dashboard.index', ['categories' => $categories, 'products' => $products, 'testimonis' => $testimonis]);
    }
    public function profile()
    {
        $user = DB::table('data_users')
            ->join('users', 'data_users.user_id', '=', 'users.id')
            ->select('data_users.*', 'users.name', 'users.email')
            ->where('users.id', auth()->user()->id)
            ->get();
        return view('dashboard.profile', ['user' => $user]);
    }
    public function product()
    {
        $products = Product::all();
        return view('dashboard.product', ['products' => $products]);
    }

    public function testimoni()
    {
        $testimonis = DB::table('testimonis')
            ->join('users', 'testimonis.user_id', 'users.id')
            ->join('data_users', 'data_users.user_id', 'testimonis.user_id')
            ->select('data_users.photo_profile', 'users.name', 'testimonis.*')
            ->get();
        return view('dashboard.testimoni', ['testimonis' => $testimonis]);
    }

    public function showTestimoni()
    {
        $dataUser = DataUser::where('user_id', auth()->user()->id)->first();
        if ($dataUser->status === 0) {
            return redirect()->route('dashboard.profile')->with('error', 'Lengkapi Profile Terlebih Dahulu');
        }
        return view('dashboard.create_testimoni');
    }

    public function myTestimoni()
    {
        $myTesimonis = DB::table('testimonis')
            ->join('users', 'testimonis.user_id', 'users.id')
            ->join('data_users', 'data_users.user_id', 'testimonis.user_id')
            ->select('data_users.photo_profile', 'users.name', 'testimonis.*')
            ->where('data_users.user_id', auth()->user()->id)
            ->get();
        return view('dashboard.my_testimoni', ['myTestimonis' => $myTesimonis]);
    }

    public function history()
    {
        $historys = Payment::where('user_id', auth()->user()->id)->get();
        return view('dashboard.history', ["historys" => $historys]);
    }
}
