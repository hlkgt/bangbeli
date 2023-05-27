<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addCart(Request $request)
    {
        $convertQuantity = (int)$request->quantity;
        if ($convertQuantity === null || $convertQuantity === 0 || $convertQuantity < 0) {
            $message = "Total Pembelian Pada " . $request->name . " Masih Kosong Atau 0 atau < 0";
            return redirect()->back()->with('error', $message);
        } else {
            $product = Product::where('id', $request->id)->first();
            if ($convertQuantity > $product->stock) {
                return redirect()->back()->with('error', 'Pesanan Pada ' . $request->name . ' Lebih Dari Stock Maks ' . $product->stock);
            } else {
                $getIdProduct = Product::where('id', $request->id)->first();
                $getIdProduct->stock = $getIdProduct->stock - $convertQuantity;
                $getIdProduct->save();
                $totalPrice = (int)$request->price * $convertQuantity;
                $convertTotalPrice = $totalPrice * 1000;
                $formatTotalPrize = number_format($convertTotalPrice, 0, ',', '.');
                Cart::insert([
                    'user_id' => auth()->user()->id,
                    'image' => $request->name,
                    'name' => $request->name,
                    'quantity' => $convertQuantity,
                    'price' => $formatTotalPrize,
                    'status' => false,
                ]);
                return redirect()->back()->with('success', 'Product Succesful Add To Cart');
            }
        }
    }
}
