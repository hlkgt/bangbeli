<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showUpdateView(Request $request)
    {
        $product = Product::where('id', $request->query('product-id'))->first();
        return view('dashboard.product_update', ['product' => $product]);
    }

    public function updateProduct(Request $request)
    {
        $validated = $request->validate([
            'price' => 'required',
            'stock' => 'required'
        ]);
        $product = Product::where('id', $request->product_id)->first();
        $product->price = $validated['price'];
        $product->stock = $validated['stock'];
        $product->save();
        return redirect()->route('dashboard.product')->with('success', 'Berhasil Mengupdate Product');
    }
}
