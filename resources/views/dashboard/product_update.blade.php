@extends('app')

@section('content')
    <div class="rounded-lg shadow-lg p-8">
        <form action="{{ route('update.product') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" class="w-full p-2 outline-2 border-2 rounded-lg" value="{{ $product->id }}"
                readonly>
            <div class="mb-4">
                <label for="name" class="text-xl font-semibold capitalize mb-2">harga</label>
                <input type="number" name="price"
                    class="w-full p-2 outline-2 border-2 rounded-lg @error('price')
                  border-red-400
                @enderror"
                    placeholder="Masukkan Harga" value="{{ $product->price }}">
                @error('price')
                    <p class="text-red-400 text-lg">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="address" class="text-xl font-semibold capitalize mb-2">stock</label>
                <input type="number" name="stock"
                    class="w-full p-2 outline-2 border-2 rounded-lg @error('stock')
                  border-red-400
                @enderror"
                    placeholder="Masukkan Stock" value="{{ $product->stock }}">
                @error('stock')
                    <p class="text-red-400 text-lg">{{ $message }}</p>
                @enderror
            </div>
            <button class="py-3 bg-teal-400 text-lg w-full rounded-lg font-semibold text-white">Update Sekarang</button>
        </form>
    </div>
@endsection
