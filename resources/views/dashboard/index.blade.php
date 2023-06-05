@extends('app')

@section('content')
    <div class="grid grid-cols-12 gap-12">
        <div class="col-span-12 grid grid-cols-12 gap-3">
            <h1 class="col-span-12 text-center text-2xl font-bold">--- Kategori Pesanan ---</h1>
            @foreach ($categories as $categori)
                <div
                    class="h-12 col-span-12 md:col-span-4 rounded-xl flex gap-2 flex items-center justify-center bg-yellow-400 text-xl capitalize font-bold text-white py-8">
                    <i class="fa-solid {{ $categori->icon }}"></i>
                    <h1>{{ $categori->categori }}</h1>
                </div>
            @endforeach
        </div>
        <div class="col-span-12 grid grid-cols-12 gap-3 rounded-xl">
            <h1 class="col-span-12 text-center text-2xl font-bold">--- Menu Unggulan ---</h1>
            @foreach ($products as $product)
                <div class="col-span-12 md:col-span-4 rounded-xl shadow-xl p-6 flex flex-col gap-2">
                    <img src="{{ asset('storage/' . $product->url_image) }}" alt="food-image" width="200" class="mx-auto">
                    <h1 class="text-center font-semibold text-xl">{{ $product->name }}</h1>
                    <p>{{ $product->description }}</p>
                    <p><b>Price :</b> {{ $product->price }}</p>
                    <p><b>Stock :</b> {{ $product->stock }}</p>
                    <p><b>Terjual :</b> {{ $product->sold }}</p>
                    <x-star :rate="$product->rate"></x-star>
                    <a href="{{ route('dashboard.product') }}"
                        class="text-center bg-yellow-400 py-4 text-white font-semibold rounded-lg w-full capitalize">beli
                        sekarang</a>
                </div>
            @endforeach
        </div>
        <div class="col-span-12 grid grid-cols-12 gap-12 md:gap-3 rounded-xl">
            <h1 class="col-span-12 text-center text-2xl font-bold">--- Ulasan Pelanggan ---</h1>
            @foreach ($testimonis as $testimoni)
                <div class="col-span-12 md:col-span-4 flex flex-col rounded-lg shadow-lg">
                    <div class="flex items-center gap-4 p-4">
                        <img src="{{ asset('storage/' . $testimoni->photo_profile) }}" alt="foto-profile"
                            class="w-16 rounded-full">
                        <div class="flex flex-col">
                            <h1 class="text-lg font-semibold">{{ $testimoni->name }}</h1>
                            <x-star :rate="$testimoni->rate"></x-star>
                        </div>
                    </div>
                    <p class="px-4 py-2">{{ $testimoni->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
