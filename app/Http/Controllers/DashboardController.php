<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Categori;
use App\Models\Link;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Categori::all();
        return view('dashboard.index', ['categories' => $categories]);
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

    public function cart()
    {
        $countPrice = 0;
        $productLists = Cart::where('user_id', auth()->user()->id)->get();
        for ($i = 0; $i < count($productLists); $i++) {
            $countPrice += $productLists[$i]->price;
        }
        $totalPrice = $countPrice * 1000;
        $formatPrice = number_format($totalPrice, 0, ',', '.');
        return view('dashboard.cart', ['productLists' => $productLists, 'price' => $formatPrice]);
    }
}
