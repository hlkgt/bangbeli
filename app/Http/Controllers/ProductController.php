<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addCart(Request $request)
    {
        $convertQuantity = (int)$request->quantity;
        $product = Product::where('id', $request->id)->first();
        $cart = Cart::where('product_id', $request->id)->first();
        // dd($cart);
        if ($convertQuantity === null || $convertQuantity === 0 || $convertQuantity < 0) {
            return redirect()->back()->with('error', "Total Pembelian Pada " . $request->name . " Masih Kosong Atau 0 atau < 0");
        } else if ($convertQuantity > $product->stock) {
            return redirect()->back()->with('error', 'Pesanan Pada ' . $request->name . ' Lebih Dari Stock Maks ' . $product->stock);
        } else if ($cart) {
            $cart->quantity = $request->quantity;
            $cart->save();
            return redirect()->back()->with('success', 'Product Succesful Update From Cart');
        } else {
            $totalPrice = (int)$request->price * $convertQuantity;
            $convertTotalPrice = $totalPrice * 1000;
            $formatTotalPrize = number_format($convertTotalPrice, 0, ',', '.');
            $cart = Cart::insert([
                'user_id' => auth()->user()->id,
                'product_id' => $request->id,
                'image' => $request->name,
                'name' => $request->name,
                'quantity' => $convertQuantity,
                'price' => $formatTotalPrize,
                'status' => false,
            ]);
            return redirect()->back()->with('success', 'Product Succesful Add To Cart');
        }
    }

    public function deleteListProduct(Request $request)
    {
        $cart = Cart::where('id', $request->query("cart"))->first();
        $cart->delete();
        return redirect()->back()->with("success", "Delete Order Successfull");
    }
}
